<?php

if(count($_POST)>0){

	$ingredient = new IngredientData();

	$ingredient->code 			= $_POST["code"];
	$ingredient->name 			= $_POST["name"];
	$ingredient->price_in 		= $_POST["price_in"];
	$ingredient->price_out 		= $_POST["price_out"];
	$ingredient->unit 			= $_POST["unit"];
	$ingredient->proveedor_id 	= $_POST["proveedor_id"];
	$ingredient->user_id 		= Session::getUID();
	$ingredient->add();
	print "<script>window.location='index.php?view=ingredients';</script>";


}


?>