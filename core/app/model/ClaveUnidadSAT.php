<?php
class ClaveUnidadSAT {
	public static $tablename = "lls_clave_unidad";

	public function ClienteData(){

		$this->rowid 			    = "";
        $this->clave_unidad 		= "";   
		$this->nombre 	            = "";
		$this->descripcion 	        = "";
		$this->nota 	            = "";
		$this->fecha_inicio_vig 	= "";
		$this->fecha_fin_vig 		= "";
		$this->simbolo 	            = "";
		
    }

    public static function autoCompleteUnidadSAT($criterio){
		$sql = "SELECT clave_unidad, nombre FROM ".self::$tablename. " WHERE nombre LIKE '%$criterio%' OR clave_unidad LIKE '%$criterio%'";
		$query = Executor::doit($sql);
		$array = array();
        $cnt = 0;

        while($r = $query[0]->fetch_array())
        {
			$array[$cnt] = new ClaveProdSAT();
			$array[$cnt]->clave_unidad  = $r['clave_unidad'];
            $array[$cnt]->nombre   = utf8_encode($r['nombre']);
            
			$cnt++;
		}
		return $array;
    }
    

    public static function getById($id){
		$sql = "SELECT clave_unidad, nombre FROM ".self::$tablename. " WHERE clave_unidad = '$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ClaveProdSAT());
	}
    



	

	
	


	




}

?>