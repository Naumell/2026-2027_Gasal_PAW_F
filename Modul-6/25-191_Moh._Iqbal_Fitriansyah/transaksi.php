<?php
// Halaman MASTER: daftar & tambah transaksi
require 'koneksi.php';
$pesan = "";

if (isset($_POST['tambah'])) {
    $tgl = $_POST['waktu_transaksi'];
    $ket = trim($_POST['keterangan']);
    $pel = $_POST['pelanggan_id'];
    $stmt = mysqli_prepare($koneksi,
        "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $tgl, $ket, $pel);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: detail.php?id=" . mysqli_insert_id($koneksi));
        exit;
    }
    $pesan = "<div class='err'>Gagal menambah transaksi.</div>";
}

$pelanggan = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan ORDER BY nama");
$data = mysqli_query($koneksi,
    "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama
     FROM transaksi t JOIN pelanggan p ON p.id = t.pelanggan_id
     ORDER BY t.id DESC");
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Transaksi (Master)</title>
<link rel="stylesheet" href="style.css"></head>
<body>
<nav><a href="transaksi.php">Transaksi</a><a href="barang.php">Barang</a></nav>
<h2>Data Transaksi (Master)</h2>
<?= $pesan ?>

<fieldset><legend>Tambah Transaksi</legend>
<form method="post">
  <label>Tanggal</label><input type="date" name="waktu_transaksi" value="<?= date('Y-m-d') ?>" required><br>
  <label>Pelanggan</label>
  <select name="pelanggan_id" required>
    <option value="">-- pilih pelanggan --</option>
    <?php while ($p = mysqli_fetch_assoc($pelanggan)): ?>
      <option value="<?= e($p['id']) ?>"><?= e($p['id'] . " - " . $p['nama']) ?></option>
    <?php endwhile; ?>
  </select><br>
  <label>Keterangan</label><input type="text" name="keterangan" size="40" required><br>
  <button type="submit" name="tambah">Simpan &amp; isi detail</button>
</form>
</fieldset>

<table>
<tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th><th>Total</th><th>Aksi</th></tr>
<?php while ($r = mysqli_fetch_assoc($data)): ?>
<tr>
  <td><?= e($r['id']) ?></td>
  <td><?= e($r['waktu_transaksi']) ?></td>
  <td><?= e($r['nama']) ?></td>
  <td><?= e($r['keterangan']) ?></td>
  <td><?= rp($r['total']) ?></td>
  <td><a href="detail.php?id=<?= (int)$r['id'] ?>">Lihat / Isi Detail</a></td>
</tr>
<?php endwhile; ?>
</table>
</body></html>
