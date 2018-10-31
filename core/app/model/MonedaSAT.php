<?php
class MonedaSAT {
	public static $tablename = "lls_moneda";

	public function MonedaSAT(){

        $this->rowid            ="";
        $this->c_moneda         ="";
        $this->descripcion      ="";
        $this->decimal          ="";
        $this->porcentaje_var   ="";
        $this->fecha_ini_vig    ="";
        $this->fecha_fin_vig    ="";

    }
    

    public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename."";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
            $array[$cnt]    = new MonedaSAT();
            
			$array[$cnt]->c_moneda  = $r['c_moneda'];
            $array[$cnt]->descripcion   = utf8_encode($r['descripcion']);
            
			$cnt++;
		}
		return $array;
	}

	




}

?>