<?php
class FormaPagoSAT {
	public static $tablename = "lls_formapago";

	public function FormaPagoSAT(){

        $this->rowid                    ="";
        $this->c_formapago              ="";
        $this->descripcion              ="";
        $this->bancarizado              ="";
        $this->numero_operacion         ="";
        $this->rfc_emisor_c_orden       ="";
        $this->cuenta_orden             ="";
        $this->patron_cuenta_orden      ="";
        $this->rfc_emisor_cuenta_ben    ="";
        $this->cuenta_beneficiario      ="";
        $this->patron_cuenta_benef      ="";
        $this->tipo_cadena_pago         ="";
        $this->nom_banco_emisor_co_ext  ="";
        $this->fecha_ini_vig            ="";
        $this->fecha_fin_vig            ="";


    }
    

    public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename."";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
            $array[$cnt]    = new FormaPagoSAT();
            
			$array[$cnt]->c_formapago  = $r['c_formapago'];
            $array[$cnt]->descripcion   = utf8_encode($r['descripcion']);
            
			$cnt++;
		}
		return $array;
	}

	




}

?>