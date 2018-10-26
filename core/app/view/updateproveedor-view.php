<?php

if(count($_POST)>0){
	$product = ProveedorData::getById($_POST["product_id"]);
	$product->nombres = $_POST["nombres"];
	$product->empresa = $_POST["empresa"];

	$product->direccion = $_POST["direccion"];
	$product->telefono = $_POST["telefono"];
	
	$product->update();
	setcookie("prdupd","true");
	print "<script>window.location='index.php?view=editproveedor&id=$_POST[product_id]';</script>";


}


?>