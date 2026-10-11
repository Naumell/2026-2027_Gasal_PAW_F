<?php
$students = [
    ["Alex","220401","0812345678"],
    ["Bianca","220402","0812345687"],
    ["Candice","220403","0812345665"]
];
echo "data awal : <br>";
for ($i=0; $i<count($students); $i++){
    for ($j=0; $j<count($students[$i]); $j++){
        echo $students[$i][$j]." ";
    }
    echo "<br>";

}
echo "<br> data setelah ditambah 5 data lain : <br>";
array_push($students,["Daniel","220404","0812345611"]);
array_push($students,["Elena","220405","0812345622"]);
array_push($students,["Fiona","220406","0812345633"]);
array_push($students,["Gabe","220407","0812345644"]);
array_push($students,["Hannah","220408","0812345655"]);

for ($i=0; $i<count($students); $i++){
    for ($j=0; $j<count($students[$i]); $j++){
        echo $students[$i][$j]." ";
    }
    echo "<br>";
}

echo "<br> <table border='1'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
for ($i=0; $i<count($students); $i++){
    echo "<tr>";
    for ($j=0; $j<count($students[$i]); $j++){
        echo "<td>".$students[$i][$j]."</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>