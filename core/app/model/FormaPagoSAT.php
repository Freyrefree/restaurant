<?php
class FormaPagoSAT {
	public static $tablename = "lls_metodopago";

	public function FormaPagoSAT(){

        $this->rowid        ="";
        $this->c_metodopago ="";
        $this->descripcion  ="";
        $this->fecha_ini_vig="";
        $this->fecha_fin_vig="";

    }
    

    public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename."";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
            $array[$cnt]    = new FormaPagoSAT();
            
			$array[$cnt]->c_metodopago  = $r['c_metodopago'];
            $array[$cnt]->descripcion   = utf8_encode($r['descripcion']);
            
			$cnt++;
		}
		return $array;
	}

	




}

?>