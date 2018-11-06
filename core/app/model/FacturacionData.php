<?php
class FacturacionData {
    public static $tablename    = "lla_conceptos";
    public static $tablename2   = "lla_conceptos";

	public function FacturacionData(){
        $this->created_at = "NOW()";
        $this->id_empresa       ="";
    }
    


	public static function getSellRFCReceptor($id){
		$sql = "SELECT 
		s.id AS id,
		c.rfc AS rfc,
		c.cfdi AS cfdi,
		scfdi.descripcion AS descripcion 
		FROM sell s INNER JOIN cliente c ON s.cliente_id = c.id
		INNER JOIN lls_c_usocfdi scfdi ON c.cfdi = scfdi.c_UsoCFDI
		WHERE s.id = $id";

		$query = Executor::doit($sql);
		return Model::many($query[0],new FacturacionData());
	}


	public static function getSellConceptos($id){

		// $sql = "SELECT o.id AS id,
		// o.product_id AS idProducto,
		// o.q AS cantidad,
		// p.codigoSAT AS codigoSAT,
		// p.code AS codigoInterno,
		// p.description AS descripcionInterna,
		// p.unit AS unidad,
		// p.price_out AS precio,
		// cs.descripcion AS descripcionSAT,
		// cv.nombre AS nombreUnidadSAT
		// FROM operation o LEFT JOIN product p ON o.product_id = p.id
		// LEFT JOIN lls_clave_prodserv cs ON p.codigoSAT = cs.clave_prodserv
		// LEFT JOIN lls_clave_unidad cv ON cv.clave_unidad = p.unit
        // WHERE o.sell_id = $id";

        $sql = "SELECT llaC.*,
        cv.nombre AS nombreUnidad 
        FROM lla_conceptos llaC 
        LEFT JOIN lls_clave_unidad cv ON cv.clave_unidad = llaC.clave_unidad
        WHERE idVenta = $id";
        

		$query = Executor::doit($sql);
		return Model::many($query[0],new FacturacionData());
    }


    public static function getSellExists($id){

        $sql = "SELECT * FROM ".self::$tablename." WHERE idVenta = $id";
        $query = Executor::doit($sql);
        if(($query[0]->num_rows) > 0):
            return true;
        else:
            return false;
        endif;
    }
        


    public static function addConcepto($idVenta,$idUsuario){
        $sql = "INSERT INTO lla_conceptos 
        ( 
        idVenta, 
        usuario, 
        id_prod_serv, 
        clave_sat, 
        clave_unidad, 
        valor_unitario,
        cantidad, 
        importe_total, 
        descripcionProd
        )
        SELECT
        o.sell_id AS idVenta,
        '$idUsuario' AS usuario,
        o.product_id AS idProducto,
        p.codigoSAT AS codigoSAT,
        p.unit AS unidad,
        p.price_out AS precio,
        o.q AS cantidad,
        (o.q * p.price_out) AS importe_total,
        p.description AS descripcionInterna
        FROM operation o LEFT JOIN product p ON o.product_id = p.id
        LEFT JOIN lls_clave_prodserv cs ON p.codigoSAT = cs.clave_prodserv
        LEFT JOIN lls_clave_unidad cv ON cv.clave_unidad = p.unit
        WHERE o.sell_id = $idVenta";

        $query = Executor::doit($sql);
    }


    public function insertaFactura(){
        $sql="INSERT INTO lla_registro_factura(metodo,
        forma,condicionPago,rfc_emisor,
        rfc_receptor,idCliente,concepto_clave,
        fecha_registro,fecha_facturacion,moneda,
        tipo_documento,usuario,estatus_factura,
        usocfdi) VALUES('{$this->metodoPago}','{$this->formaPago}','{$this->condicion}','{$this->emisor}','{$this->receptor}','{$this->idCliente}','{$this->folioC}',NOW(),NOW(),'{$this->moneda}','{$this->tc}','{$this->usuario}','1','{$this->usocfdi}')";
        return Executor::doit($sql);
    }


}

?>