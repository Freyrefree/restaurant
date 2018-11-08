<?php
class FacturacionData {
    public static $tablename    = "lla_conceptos";
    public static $tablename2   = "lla_registro_factura";

	public function FacturacionData(){
        $this->created_at = "NOW()";

        $this->usuario = "";

        $this->id               ="";
        $this->serie            = "";
        $this->folio            = "";
        $this->metodo           = "";
        $this->forma            = "";
        $this->condicionPago    = "";
        $this->rfc_emisor       = "";
        $this->rfc_receptor     = "";
        $this->idCliente        = "";
        $this->concepto_clave   = "";
        $this->fecha_registro   = "";
        $this->fecha_facturacion= "";
        $this->folio_fiscal     = "";
        $this->moneda           = "";
        $this->tipo_documento   = "";
        $this->usuario          = "";
        $this->estatus_envio    = "";
        $this->estatus_pago     = "";
        $this->estatus_factura  = "";
        $this->solicitud_cancelacion = "";
        $this->id_documento     = "";
        $this->fecha_modificacion = "";
        $this->total_iva        = "";
        $this->total_retencion  = "";
        $this->subtotal         = "";
        $this->total            = "";
        $this->usocfdi          = "";

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
        $sql="INSERT INTO lla_registro_factura(
        metodo,
        forma,
        condicionPago,
        rfc_emisor,
        rfc_receptor,
        idCliente,
        concepto_clave,
        fecha_registro,
        fecha_facturacion,
        moneda,
        tipo_documento,
        usuario,
        estatus_factura,
        usocfdi
        ) VALUES
        (
        \"$this->metodo\",
        \"$this->forma\",
        \"$this->condicionPago\",
        \"$this->rfc_emisor\",
        \"$this->rfc_receptor\",
        \"$this->idCliente\",
        \"$this->concepto_clave\",
        NOW(),
        NOW(),
        \"$this->moneda\",
        \"$this->tipo_documento\",
        \"$this->usuario\",
        1,
        \"$this->usocfdi\"
        )";

        return Executor::doit($sql);
    }


    public static function getFacturaByID($id){
        $sql = "SELECT * FROM ".self::$tablename2." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new FacturacionData());
    }

    public static function getUltimoFolio($rfc,$documento){
        $sql ="SELECT folio+1 AS folio,serie FROM ".self::$tablename2." 
        WHERE tipo_documento='$documento' AND rfc_emisor='$rfc' ORDER BY folio DESC LIMIT 1";

        $query = Executor::doit($sql);
		return Model::one($query[0],new FacturacionData());
    }

    public static function getSerieFolio($rfc,$documento){
        $sql="SELECT serie, folio+1 AS folio FROM ".self::$tablename2." 
        WHERE tipo_documento='$documento' AND empresa='$rfc' order by folio desc limit 1";
        return Model::one($query[0],new FacturacionData()); 
    }

    public  function updateSerieFolio($serie,$folio,$idFactura){
        $sql="UPDATE lla_registro_factura SET serie='$serie', folio='$folio'  WHERE id='$idFactura'";
        Executor::doit($sql);

    }

    public static function getConceptos($idConcepto){
        $sql="SELECT lc.* FROM lla_conceptos AS lc WHERE lc.idVenta=$idConcepto";
        $query = Executor::doit($sql);
		return Model::many($query[0],new SellData());

    }

    public  function update_factura($id,$tipoDocumento){

        $sql="UPDATE ".self::$tablename2." SET 
        folio_fiscal=\"$this->folio_fiscal\",
        estatus_factura=\"$this->estatus_factura\"
        WHERE id=$id 
        AND  tipo_documento = '$tipoDocumento'";
        return Executor::doit($sql);
        	
    }

    public static function buscatotal($id){
        $sql="SELECT c.* FROM lla_registro_factura AS lrf,lla_conceptos AS c WHERE  lrf.concepto_clave=c.idVenta AND lrf.id= $id";
        $query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
    }

    public function updateTotales($id){
        $sql="UPDATE ".self::$tablename2." SET 
        total_iva       = \"$this->traslado\",
        total_retencion =\"$this->retencion\",
        subtotal        =\"$this->subtotal\",
        total           = \"$this->total\" 
        WHERE id= $id ";

        return Executor::doit($sql);
    }

    public function update_timbresbyRFCem($rfc){
        $sql="UPDATE lla_timbres SET consumido_real=consumido_real+1, consumido_total=consumido_total+1 where rfc='$rfc'";
        return Executor::doit($sql);	
    }

    public function update_f($id){
			
        $sql="UPDATE ".self::$tablename2." SET
        serie=\"$this->serie\", folio=\"$this->folio\"  
        WHERE id = $id";
        return Executor::doit($sql);	
    }




}

?>