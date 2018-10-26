<?php

$grade = ProveedorData::getById($_GET["id"]);
$grade->del();
header("Location: index.php?view=proveedor");

?>