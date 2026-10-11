<?php
$fruits = array("Avocado","Blueberry","Cherry");
array_push($fruits,"Durian");
array_push($fruits,"Elderberry");
array_push($fruits,"Fig");
array_push($fruits,"Grape");
array_push($fruits,"Honeydew");
var_dump($fruits);
echo "<br><br>";
unset($fruits[1]);
$fruits = array_values($fruits);
var_dump($fruits);
echo "<br><br>";
$terakhir = $fruits[count($fruits)-1];
echo $terakhir;
?>