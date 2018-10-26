<?php

$claveUnidadSAT = new ClaveUnidadSAT;

$criterio = $_POST['criterio'];

$data = $claveUnidadSAT->autoCompleteUnidadSAT($criterio);

echo json_encode($data);

?>