<?php

if(count($_POST)>0){
	$product = new ProveedorData();
	$product->nombres = $_POST["nombres"];
	$product->empresa = $_POST["empresa"];

	$product->direccion = $_POST["direccion"];
	$product->telefono = $_POST["telefono"];
	
	$product->add();
	print "<script>window.location='index.php?view=proveedor';</script>";


}


?>