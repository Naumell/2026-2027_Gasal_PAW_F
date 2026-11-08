<?php
// Halaman MASTER-DETAIL: transaksi (master) + transaksi_detail (detail)
require 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// --- Data master ---
$stmt = mysqli_prepare($koneksi,
    "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan
     FROM transaksi t JOIN pelanggan p ON p.id = t.pelanggan_id WHERE t.id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$master = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$master) {
    die("Transaksi tidak ditemukan. <a href='transaksi.php'>Kembali</a>");
}

$pesan = "";

// Simpan detail baru + update total (Tugas 4)
if (isset($_POST['simpan'])) {
    $barang_id = (int)$_POST['barang_id'];
    $qty = (int)$_POST['qty'];

    if ($barang_id <= 0 || $qty < 1) {
        $pesan = "<div class='err'>Pilih barang dan isi qty minimal 1.</div>";
    } else {
        // harga diambil dari tabel barang (bukan dari input user)
        $q = mysqli_prepare($koneksi, "SELECT harga FROM barang WHERE id = ?");
        mysqli_stmt_bind_param($q, "i", $barang_id);
        mysqli_stmt_execute($q);
        $brg = mysqli_fetch_assoc(mysqli_stmt_get_result($q));

        // cek ulang di server: barang tidak boleh dobel dalam 1 transaksi (Tugas 2)
        $c = mysqli_prepare($koneksi,
            "SELECT COUNT(*) AS n FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?");
        mysqli_stmt_bind_param($c, "ii", $id, $barang_id);
        mysqli_stmt_execute($c);
        $sudah = mysqli_fetch_assoc(mysqli_stmt_get_result($c))['n'];

        if (!$brg) {
            $pesan = "<div class='err'>Barang tidak ditemukan.</div>";
        } elseif ($sudah > 0) {
            $pesan = "<div class='err'>Barang tersebut sudah ada di transaksi ini.</div>";
        } else {
            mysqli_begin_transaction($koneksi);
            try {
                $harga = (int)$brg['harga'];
                $ins = mysqli_prepare($koneksi,
                    "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)");
                mysqli_stmt_bind_param($ins, "iiii", $id, $barang_id, $harga, $qty);
                mysqli_stmt_execute($ins);

                // hitung ulang total = SUM(harga * qty) semua detail transaksi ini
                $upd = mysqli_prepare($koneksi,
                    "UPDATE transaksi
                     SET total = (SELECT COALESCE(SUM(harga * qty), 0)
                                  FROM transaksi_detail WHERE transaksi_id = ?)
                     WHERE id = ?");
                mysqli_stmt_bind_param($upd, "ii", $id, $id);
                mysqli_stmt_execute($upd);

                mysqli_commit($koneksi);
                header("Location: detail.php?id=$id&ok=1");
                exit;
            } catch (mysqli_sql_exception $ex) {
                mysqli_rollback($koneksi);
                $pesan = "<div class='err'>Gagal menyimpan detail.</div>";
            }
        }
    }
}
if (isset($_GET['ok'])) {
    $pesan = "<div class='ok'>Detail tersimpan dan total transaksi diperbarui.</div>";
}

// --- Data detail ---
$d = mysqli_prepare($koneksi,
    "SELECT b.kode_barang, b.nama_barang, td.harga, td.qty, (td.harga * td.qty) AS subtotal
     FROM transaksi_detail td JOIN barang b ON b.id = td.barang_id
     WHERE td.transaksi_id = ? ORDER BY b.kode_barang");
mysqli_stmt_bind_param($d, "i", $id);
mysqli_stmt_execute($d);
$detail = mysqli_stmt_get_result($d);

// --- Dropdown: hanya barang yang BELUM ada di detail transaksi ini ---
$o = mysqli_prepare($koneksi,
    "SELECT id, kode_barang, nama_barang, harga FROM barang
     WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ?)
     ORDER BY nama_barang");
mysqli_stmt_bind_param($o, "i", $id);
mysqli_stmt_execute($o);
$opsi = mysqli_stmt_get_result($o);
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Detail Transaksi #<?= $id ?></title>
<link rel="stylesheet" href="style.css"></head>
<body>
<nav><a href="transaksi.php">Transaksi</a><a href="barang.php">Barang</a></nav>

<h2>Master: Transaksi #<?= e($master['id']) ?></h2>
<table>
<tr><th>Tanggal</th><td><?= e($master['waktu_transaksi']) ?></td></tr>
<tr><th>Pelanggan</th><td><?= e($master['pelanggan']) ?></td></tr>
<tr><th>Keterangan</th><td><?= e($master['keterangan']) ?></td></tr>
<tr><th>Total</th><td><strong><?= rp($master['total']) ?></strong></td></tr>
</table>

<?= $pesan ?>

<h3>Detail Transaksi</h3>
<table>
<tr><th>Kode</th><th>Nama Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
<?php $ada = false; while ($r = mysqli_fetch_assoc($detail)): $ada = true; ?>
<tr>
  <td><?= e($r['kode_barang']) ?></td>
  <td><?= e($r['nama_barang']) ?></td>
  <td><?= rp($r['harga']) ?></td>
  <td><?= e($r['qty']) ?></td>
  <td><?= rp($r['subtotal']) ?></td>
</tr>
<?php endwhile; ?>
<?php if (!$ada): ?><tr><td colspan="5">Belum ada detail.</td></tr><?php endif; ?>
</table>

<fieldset><legend>Tambah Detail</legend>
<?php if (mysqli_num_rows($opsi) === 0): ?>
  <p>Semua barang sudah dimasukkan ke transaksi ini.</p>
<?php else: ?>
<form method="post">
  <label>Barang</label>
  <select name="barang_id" required>
    <option value="">-- pilih barang --</option>
    <?php while ($b = mysqli_fetch_assoc($opsi)): ?>
      <option value="<?= (int)$b['id'] ?>">
        <?= e($b['kode_barang'] . " - " . $b['nama_barang'] . " (" . rp($b['harga']) . ")") ?>
      </option>
    <?php endwhile; ?>
  </select><br>
  <label>Qty</label><input type="number" name="qty" min="1" value="1" required><br>
  <button type="submit" name="simpan">Simpan Detail</button>
</form>
<?php endif; ?>
</fieldset>
</body></html>
