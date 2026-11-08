<?php
// Daftar barang + hapus dengan pengecekan data terkait (Tugas 3)
require 'koneksi.php';
$pesan = "";

if (isset($_POST['hapus'])) {
    $id = (int)$_POST['id'];

    // 1. cek apakah barang sudah dipakai di transaksi_detail
    $c = mysqli_prepare($koneksi, "SELECT COUNT(*) AS n FROM transaksi_detail WHERE barang_id = ?");
    mysqli_stmt_bind_param($c, "i", $id);
    mysqli_stmt_execute($c);
    $n = mysqli_fetch_assoc(mysqli_stmt_get_result($c))['n'];

    if ($n > 0) {
        // 2a. sudah dipakai -> tolak
        $pesan = "<div class='err'>Barang tidak dapat dihapus karena masih digunakan pada $n transaksi.</div>";
    } else {
        // 2b. belum dipakai -> boleh dihapus
        $h = mysqli_prepare($koneksi, "DELETE FROM barang WHERE id = ?");
        mysqli_stmt_bind_param($h, "i", $id);
        mysqli_stmt_execute($h);
        $pesan = "<div class='ok'>Data barang berhasil dihapus.</div>";
    }
}

$data = mysqli_query($koneksi,
    "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS supplier
     FROM barang b LEFT JOIN supplier s ON s.id = b.supplier_id ORDER BY b.id");
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Data Barang</title>
<link rel="stylesheet" href="style.css"></head>
<body>
<nav><a href="transaksi.php">Transaksi</a><a href="barang.php">Barang</a></nav>
<h2>Data Barang</h2>
<?= $pesan ?>
<table>
<tr><th>ID</th><th>Kode</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th></tr>
<?php while ($r = mysqli_fetch_assoc($data)): ?>
<tr>
  <td><?= e($r['id']) ?></td>
  <td><?= e($r['kode_barang']) ?></td>
  <td><?= e($r['nama_barang']) ?></td>
  <td><?= rp($r['harga']) ?></td>
  <td><?= e($r['stok']) ?></td>
  <td><?= e($r['supplier']) ?></td>
  <td>
    <form method="post" onsubmit="return confirm('Hapus barang ini?')" style="margin:0">
      <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
      <button type="submit" name="hapus">Hapus</button>
    </form>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body></html>
