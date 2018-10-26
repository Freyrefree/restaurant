<?php
class ClaveProdSAT {
	public static $tablename = "lls_clave_prodserv";

	public function ClienteData(){

		$this->rowid 			    = "";
        $this->clave_prodserv 		= "";   
		$this->descripcion 	        = "";
		$this->fecha_ini_vigencia 	= "";
		$this->fecha_fin_vigencia 	= "";
		$this->iva_traslado 		= "";
		$this->ieps_trasalado 		= "";
		$this->complemento_incluir 	= "";
		
    }

    public static function autoCompleteProdSAT($criterio){
		$sql = "SELECT clave_prodserv, descripcion FROM ".self::$tablename. " WHERE descripcion LIKE '%$criterio%' OR clave_prodserv LIKE '%$criterio%'";
		$query = Executor::doit($sql);
		$array = array();
        $cnt = 0;

        while($r = $query[0]->fetch_array())
        {
			$array[$cnt] = new ClaveProdSAT();
			$array[$cnt]->rowid         = $r['clave_prodserv'];
            $array[$cnt]->descripcion   = utf8_encode($r['descripcion']);
            
			$cnt++;
		}
		return $array;
    }
    

    public static function getById($id){
		$sql = "SELECT clave_prodserv, descripcion FROM ".self::$tablename. " WHERE clave_prodserv = $id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ClaveProdSAT());
	}
    



	

	
	


	




}

?>