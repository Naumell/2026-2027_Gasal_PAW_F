<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
mysqli_set_charset($koneksi, "utf8mb4");

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function rp($n) { return "Rp " . number_format((int)$n, 0, ',', '.'); }
