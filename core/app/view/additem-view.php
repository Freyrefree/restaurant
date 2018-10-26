<?php

$grade = new ItemData();
$grade->name = $_POST["name"];
$grade->add();

// setcookie("gradeadded",$grade->name);

header("Location: index.php?view=item");

?>