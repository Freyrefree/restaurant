<?php

$alumn = IngredientData::getById($_GET["id"]);
$alumn->del();
header("Location: index.php?view=ingredients");


?>