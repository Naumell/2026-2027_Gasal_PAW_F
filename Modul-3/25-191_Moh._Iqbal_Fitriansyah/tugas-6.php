<?php
// --- DEKLARASI FUNGSI ---
function ar_push($a, $b) {
    array_push($a, $b);
    return $a;
}

function ar_merge($a, $b) {
    return array_merge($a, $b);
}

function ar_values($a) {
    return array_values($a);
}

function ar_search($a, $b) {
    return array_search($a, $b);
}

function ar_filter($a) {
    return array_filter($a);
}

function ar_sort($a) {
    sort($a);
    return $a;
}

function ar_rsort($a) {
    rsort($a);
    return $a;
}

function ar_asort($a) {
    asort($a);
    return $a;
}

function ar_ksort($a) {
    ksort($a);
    return $a;
}

function ar_arsort($a) {
    arsort($a);
    return $a;
}

function ar_krsort($a) {
    krsort($a);
    return $a;
}

function format_assoc($arr) {
    $res = "";
    foreach ($arr as $k => $v) {
        $res .= "$k=> $v, ";
    }
    return $res;
}



$hasil_push = ar_push(["A"], "B");
echo "Hasil array_push: " . implode(" ", $hasil_push) . "<br><br>";

$hasil_merge = ar_merge(["A", "B"], ["C"]);
echo "Hasil array_merge: " . implode(" ", $hasil_merge) . "<br><br>";

$hasil_values = ar_values(["x" => 1, "y" => 2]);
echo "Hasil array_values: " . implode(" ", $hasil_values) . "<br><br>";

$hasil_search = ar_search("B", ["A", "B", "C"]);
echo "Hasil array_search: " . $hasil_search . "<br><br>";

$hasil_filter = ar_filter([0, 1, false, 2, "", 3, "array"]);
echo "Hasil array_filter: " . implode(" ", $hasil_filter) . "<br><br>";

$arr_sort = [3, 1, 2];
echo "Hasil sort: " . implode(" ", ar_sort($arr_sort)) . "<br>";
echo "Hasil rsort: " . implode(" ", ar_rsort($arr_sort)) . "<br><br>";

$arr_assoc = ["Peter" => 35, "Ben" => 37, "Joe" => 43];
echo "Hasil asort: " . format_assoc(ar_asort($arr_assoc)) . "<br>";
echo "Hasil ksort: " . format_assoc(ar_ksort($arr_assoc)) . "<br>";
echo "Hasil arsort: " . format_assoc(ar_arsort($arr_assoc)) . "<br>";
echo "Hasil krsort: " . format_assoc(ar_krsort($arr_assoc)) . "<br>";
?>