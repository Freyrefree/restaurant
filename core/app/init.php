<?php


/// en caso de que el parametro action este definido evitamos que se muestre
/// el layout por defecto y ejecutamos el action sin mostrar nada de vista
// print_r($_GET);
if(!isset($_GET["action"])){
//	Bootload::load("default");

$vistaTrue = isset($_GET['view']);
if($vistaTrue){

	$vista = $_GET["view"];
	if($vista == "addcliente"){
		
		View::load("addcliente");
	}else if($vista == "autoCompleteCodSat"){

		View::load("autoCompleteCodSat");
	}else if($vista == "autoCompleteClaveUnidad"){

		View::load("autoCompleteClaveUnidad");
	}else{
		Module::loadLayout("index");
	}


}else{
	Module::loadLayout("index");
}

//  if(isset($_GET["view"]) == "addcliente"){
// 	View::load("addcliente");
//  }else{

// 	Module::loadLayout("index");
//  }

	
}else{
	Action::load($_GET["action"]);
}

?>