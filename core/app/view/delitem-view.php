<?php

$alumn = ItemData::getById($_GET["id"]);
$alumn->del();
header("Location: index.php?view=item");


?>