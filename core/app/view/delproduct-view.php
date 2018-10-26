<?php

$alumn = ProductData::getById($_GET["id"]);
$alumn->del();
header("Location: index.php?view=products");


?>