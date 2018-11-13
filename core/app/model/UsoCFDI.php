<?php
class UsoCFDI {
	public static $tablename = "lls_c_usocfdi";


	public function CFDIData(){
        $this->rowid            = "";
		$this->c_UsoCFDI        = "";
		$this->descripcion      = "";
		$this->persona_fisica   = "";
		$this->persona_moral    = "";
		$this->fecha_inicio_vig = "";
		$this->fecha_fin_vig    = "";
	}

	
// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto

	
    public static function getAllUsoCFDI()
    {
		$sql = "SELECT * FROM ".self::$tablename ." "."ORDER BY descripcion ASC";
		$query = Executor::doit($sql);
		$array = array();
        $cnt = 0;
        
		while($r = $query[0]->fetch_array()){

            $array[$cnt] = new UsoCFDI();
            
			$array[$cnt]->rowid             = $r['rowid'];
			$array[$cnt]->c_UsoCFDI         = $r['c_UsoCFDI'];
			$array[$cnt]->descripcion       = $r['descripcion'];
			$array[$cnt]->persona_fisica    = $r['persona_fisica'];
			$array[$cnt]->persona_moral     = $r['persona_moral'];
			$array[$cnt]->fecha_inicio_vig  = $r['fecha_inicio_vig'];
			$array[$cnt]->fecha_fin_vig     = $r['fecha_fin_vig'];
			
			$cnt++;
		}
		return $array;
	}


	public static function getByCFDI($cfdi)
    {
		$sql = "SELECT * FROM ".self::$tablename ."WHERE c_UsoCFDI = '$cfdi'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EmpresaData());
	}



}

?>