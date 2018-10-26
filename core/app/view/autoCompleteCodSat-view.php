<?php

$claveProdSAT = new ClaveProdSAT;

$criterio = $_POST['criterio'];

$data = $claveProdSAT->autoCompleteProdSAT($criterio);

echo json_encode($data);

?>