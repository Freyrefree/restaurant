<?php

if(count($_POST)>0){
	//$product = ProductData::getById($_POST["product_id"]);
	$product = new ProductData();
	$product_id 				= $_POST["product_id"];
	$product->name 				= $_POST["name"];
	$product->code 				= $_POST["code"];
	$product->codigoSAT			= $_POST["idCodSAT"];
	$product->description 		= $_POST["description"];
	$product->preparation 		= $_POST["preparation"];
	$product->use_ingredient 	= isset($_POST["use_ingredient"]) ? 1 :0 ;
	$product->price_in 			= $_POST["price_in"];
	$product->price_out 		= $_POST["price_out"];
	$product->unit 				= $_POST["idUnidadSAT"];
	$product->duration			= $_POST["duration"];
	$product->category_id 		= $_POST["category_id"];
	$product->user_id 			= Session::getUID();
	$product->update($product_id);
	setcookie("prdupd","true");
	print "<script>window.location='index.php?view=editproduct&id=$_POST[product_id]';</script>";


}


?>