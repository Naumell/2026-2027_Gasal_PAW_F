<?php
$fruits = array("Avocado","Blueberry","Cherry");

for ($i =1; $i < 6; $i++){
    $fruits[] = "buah tambahan ke $i";
}

$arrlength = count($fruits);
echo "Jumlah array saat ini: ".$arrlength."<br>";

for($x = 0; $x < $arrlength; $x++) {
    
    echo $fruits[$x];
    echo "<br>";
}

$vegies = array("Carrot","Broccoli","Spinach");
for ($x = 0; $x < count($vegies); $x++) {
    echo $vegies[$x];
    echo "<br>";
}
?>