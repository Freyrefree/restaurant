<?php

$cliente = new ClienteData();
// $grade->nombres = $_POST["nombres"];
// $grade->ruc = $_POST["dni"];
// $grade->direccion = $_POST["direccion"];
// $id=$_POST["id_resumen"];
// $grade->add_resumen();

// // setcookie("gradeadded",$grade->name);

// header("Location: index.php?view=resumen&id=$id");


$rfc            = $_POST["rfc"];
$razonSocial    = $_POST["razonSocial"];
$telefono       = $_POST["telefono"];
$contacto       = $_POST["contacto"];
$correo         = $_POST["correo"];
$pais           = $_POST["pais"];
$estado         = $_POST["estado"];
$municipio      = $_POST["municipio"];
$cp             = $_POST["cp"];
$colonia        = $_POST["colonia"];
$calle          = $_POST["calle"];
$numEx          = $_POST["numEx"];
$numIn          = $_POST["numIn"];
$cfdi           = $_POST["cfdi"];


$cliente->rfc           = addslashes(trim($rfc));
$cliente->razonSocial   = addslashes(trim(utf8_decode($razonSocial)));
$cliente->telefono      = addslashes(trim($telefono));
$cliente->contacto      = addslashes(trim(utf8_decode($contacto)));
$cliente->correo        = addslashes(trim($correo));
$cliente->pais          = addslashes(trim(utf8_decode($pais)));
$cliente->estado        = addslashes(trim(utf8_decode($estado)));
$cliente->municipio     = addslashes(trim(utf8_decode($municipio)));
$cliente->cp            = addslashes(trim($cp));
$cliente->colonia       = addslashes(trim(utf8_decode($colonia)));
$cliente->calle         = addslashes(trim(utf8_decode($calle)));
$cliente->numEx         = addslashes(trim($numEx));
$cliente->numIn         = addslashes(trim($numIn));
$cliente->cfdi          = addslashes(trim(utf8_decode($cfdi)));



if($respuesta[0] = $cliente->add_Cliente()):
    
    echo 1;

endif;






?>