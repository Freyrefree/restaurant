<?php
class ClienteData {
	public static $tablename = "cliente";

	public function ClienteData(){
		$this->nombres = "";
		$this->ruc = "";
		$this->dni = "";
		$this->direccion = "";
		$this->email = "";



		$this->id 			= "";
		$this->rfc 			= "";
		$this->razonSocial 	= "";
		$this->telefono 	= "";
		$this->contacto 	= "";
		$this->correo 		= "";
		$this->pais 		= "";
		$this->estado 		= "";
		$this->municipio 	= "";
		$this->cp 			= "";
		$this->colonia 		= "";
		$this->calle 		= "";
		$this->numEx 		= "";
		$this->numIn 		= "";
		$this->cfdi 		= "";
		$this->activo 		= "";

	}


	public function add_Cliente()
	{
		$sql = "INSERT INTO cliente 
		(
		rfc, 
		razonSocial, 
		telefono, 
		contacto, 
		correo, 
		pais, 
		estado, 
		municipio, 
		cp, 
		colonia, 
		calle, 
		numEx, 
		numIn, 
		cfdi, 
		activo
		)
		VALUES
		( 
		'$this->rfc', 
		'$this->razonSocial', 
		'$this->telefono', 
		'$this->contacto', 
		'$this->correo', 
		'$this->pais', 
		'$this->estado', 
		'$this->municipio', 
		'$this->cp', 
		'$this->colonia', 
		'$this->calle', 
		'$this->numEx', 
		'$this->numIn', 
		'$this->cfdi', 
		'si'
		);";
		return Executor::doit($sql);
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (nombres,ruc,dni,direccion,email) ";
		$sql .= "value (\"$this->nombres\",\"$this->ruc\",\"$this->dni\",\"$this->direccion\",\"$this->email\")";
		return Executor::doit($sql);
	}
	public function add_resumen(){
		$sql = "insert into ".self::$tablename." (nombres,ruc,direccion) ";
		$sql .= "value (\"$this->nombres\",\"$this->ruc\",\"$this->direccion\")";
		return Executor::doit($sql);
	}



	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombres=\"$this->nombres\",ruc=\"$this->ruc\",dni=\"$this->dni\",direccion=\"$this->direccion\",email=\"$this->email\" where id=$this->id";
		Executor::doit($sql);
	}

	


	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ClienteData());
	}




	public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ClienteData());
	}

	




}

?>