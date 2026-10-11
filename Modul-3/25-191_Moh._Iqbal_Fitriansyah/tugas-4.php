<?php
$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

foreach($height as $name => $cm) {
    echo "$name is $cm cm tall.<br>";
}


$weight = array("Andy"=>"70","Barry"=>"65","Charlie"=>"75");
$key = array_keys($weight);
$jumlah = count($weight);
for($i=0; $i<$jumlah; $i++){
    $nama = $key[$i];
    $berat = $weight[$nama];
    echo "$nama is $berat kg.<br>";
}

?>