<?php
class EmpresaData {
	public static $tablename = "lla_empresa";

	public function EmpresaData(){

        $this->id_empresa       ="";
        $this->rfc              ="";
        $this->razon_social     ="";
        $this->pais             ="";
        $this->estado           ="";
        $this->municipio        ="";
        $this->colonia          ="";
        $this->calle            ="";
        $this->cp               ="";
        $this->next             ="";
        $this->nint             ="";
        $this->correo           ="";
        $this->telefono         ="";
        $this->celular          ="";
        $this->num_certificado  ="";
        $this->archivo_cer      ="";
        $this->archivo_pem      ="";
        $this->user_id          ="";
        $this->user_pass        ="";
        $this->regimen          ="";
        $this->referencia       ="";
        $this->regimen_fiscal   ="";
        $this->logo             ="";

	}

	

	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE  id_empresa = $id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EmpresaData());
    }
        
    public static function getByRFC($rfc){
        $sql = "SELECT * FROM ".self::$tablename." WHERE  rfc = \"$rfc\" ";
        $query = Executor::doit($sql);
        return Model::one($query[0],new EmpresaData());
	}


}

?>