<?php


class ProveedorData {
	public static $tablename = "proveedor";
	public function ProveedorData(){
		$this->nombres = "";
		$this->empresa = "";
		$this->direccion = "";
		$this->telefono = "";

	}



	public function add(){
		$sql = "insert into ".self::$tablename." (nombres,empresa,direccion,telefono) ";
		$sql .= "value (\"$this->nombres\",\"$this->empresa\",\"$this->direccion\",\"$this->telefono\")";
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

// partiendo de que ya tenemos creado un objecto PostData previamente utilizamos el contexto
	public function update(){
	//	print_r($this->country);
		$sql = "update ".self::$tablename." set nombres=\"$this->nombres\",empresa=\"$this->empresa\",direccion=\"$this->direccion\",telefono=\"$this->telefono\" where id=".$this->id;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProveedorData());
	}
	
	public static function getAlla(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProveedorData());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombres like '%$q%' or empresa like '%$q%' ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProveedorData());
	}
	
	public static function getAll(){
 		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ProveedorData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombres = $r['nombres'];
			$array[$cnt]->empresa = $r['empresa'];
			$array[$cnt]->direccion = $r['direccion'];
			$array[$cnt]->telefono = $r['telefono'];
			$cnt++;
		}
		return $array;
	}


}

?>