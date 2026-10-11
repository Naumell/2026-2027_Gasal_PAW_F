<?php
$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
echo "Andy is " . $height['Andy'] ." cm tall."."<br>";

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";
var_dump($height);
echo "<br> Nilai indeks terakhir ".end($height)."<br>";

unset($height["Barry"]);
var_dump($height);
echo "<br>Nilai indeks terakhir setelah dihapus ".end($height)."<br>";

$weight = array("Andy"=>"70","Barry"=>"65","Charlie"=>"75");
var_dump($weight);
echo "<br>" . "Data kedua: " . $weight["Barry"] . "<br>";
?>