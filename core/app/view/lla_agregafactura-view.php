<?php

$TComprobante   =$_POST['tc'];
$folio          ="";
$serie          ="";
$emisor         =$_POST['r_emisor'];
$receptor       =$_POST['r_receptor'];
$formaPago      =$_POST['forma'];
$metodoPago     =$_POST['metodo'];
$fecha          =$_POST['fecha'];
$moneda         =$_POST['moneda'];
$condicion      =$_POST['condicion'];
$idReceptor     =$_POST['idReceptor'];
$usoCFDI        =$_POST['usocfdi'];




$grade = new CategoryData();
$grade->name = $_POST["name"];
$grade->add();







?>