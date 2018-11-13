<?php
class RegimenFiscal {
	public static $tablename = "lls_regimenfiscal";

	public function RegimenFiscal(){

        $this->id_regimenFiscal ="";
        $this->clave            ="";
        $this->descripcion      ="";
        $this->fisica           ="";
        $this->moral            ="";
    }
    

	public static function getByClave($clave){
		$sql = "SELECT * FROM ".self::$tablename." WHERE  clave = $clave";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EmpresaData());
    }
        
}

?>