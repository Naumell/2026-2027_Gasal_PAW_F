-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2026 pada 11.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Beras 5 Kg', 65000, 50, 1),
(2, 'BRG002', 'Minyak Goreng 2 L', 38000, 40, 1),
(3, 'BRG003', 'Gula Pasir 1 Kg', 16000, 80, 2),
(4, 'BRG004', 'Teh Celup', 8500, 100, 2),
(5, 'BRG005', 'Kopi Sachet', 12000, 120, 3),
(6, 'BRG006', 'Susu UHT 1 L', 18000, 60, 3),
(7, 'BRG007', 'Mie Instan', 3500, 200, 4),
(8, 'BRG008', 'Sabun Mandi', 4500, 90, 5),
(9, 'BRG009', 'Sampo', 12000, 70, 6),
(10, 'BRG010', 'Air Mineral', 3000, 150, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('P001', 'Andi Saputra', 'L', '081200000001', 'Surabaya'),
('P002', 'Budi Santoso', 'L', '081200000002', 'Sidoarjo'),
('P003', 'Citra Dewi', 'P', '081200000003', 'Gresik'),
('P004', 'Dina Lestari', 'P', '081200000004', 'Surabaya'),
('P005', 'Eko Prasetyo', 'L', '081200000005', 'Malang'),
('P006', 'Fitri Handayani', 'P', '081200000006', 'Surabaya'),
('P007', 'Gilang Ramadhan', 'L', '081200000007', 'Bangkalan'),
('P008', 'Hana Putri', 'P', '081200000008', 'Sidoarjo'),
('P009', 'Indra Wijaya', 'L', '081200000009', 'Surabaya'),
('P010', 'Joko Susilo', 'L', '081200000010', 'Mojokerto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 10:00:00', 65000, 'TUNAI', 1),
(2, '2026-10-02 11:00:00', 76000, 'TRANSFER', 2),
(3, '2026-10-03 09:30:00', 48000, 'EDC', 3),
(4, '2026-10-04 14:15:00', 34000, 'TUNAI', 4),
(5, '2026-10-05 13:00:00', 24000, 'TUNAI', 5),
(6, '2026-10-06 16:45:00', 90000, 'TRANSFER', 6),
(7, '2026-10-07 10:20:00', 35000, 'EDC', 7),
(8, '2026-10-08 15:10:00', 27000, 'TUNAI', 8),
(9, '2026-10-09 12:00:00', 12000, 'TUNAI', 9),
(10, '2026-10-10 17:30:00', 36000, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(2, 'PT. Senang Sekali', '081515563', 'Kediri'),
(3, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(4, 'CV. Sumber Rejeki', '0315551001', 'Sidoarjo'),
(5, 'PT. Jaya Abadi', '0315551002', 'Gresik'),
(6, 'CV. Mitra Makmur', '0315551003', 'Malang'),
(7, 'PT. Sinar Terang', '0315551004', 'Surabaya'),
(8, 'CV. Berkah Selalu', '0315551005', 'Mojokerto'),
(9, 'PT. Cipta Niaga', '0315551006', 'Pasuruan'),
(10, 'CV. Karya Utama', '0315551007', 'Surabaya'),
(11, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(12, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(13, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(14, 'CV. Sumber Rejeki', '0315551001', 'Sidoarjo'),
(15, 'PT. Jaya Abadi', '0315551002', 'Gresik'),
(16, 'CV. Mitra Makmur', '0315551003', 'Malang'),
(17, 'PT. Sinar Terang', '0315551004', 'Surabaya'),
(18, 'CV. Berkah Selalu', '0315551005', 'Mojokerto'),
(19, 'PT. Cipta Niaga', '0315551006', 'Pasuruan'),
(20, 'CV. Karya Utama', '0315551007', 'Surabaya'),
(21, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(22, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(23, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(24, 'CV. Sumber Rejeki', '0315551001', 'Sidoarjo'),
(25, 'PT. Jaya Abadi', '0315551002', 'Gresik'),
(26, 'CV. Mitra Makmur', '0315551003', 'Malang'),
(27, 'PT. Sinar Terang', '0315551004', 'Surabaya'),
(28, 'CV. Berkah Selalu', '0315551005', 'Mojokerto'),
(29, 'PT. Cipta Niaga', '0315551006', 'Pasuruan'),
(30, 'CV. Karya Utama', '0315551007', 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01', 'Pembelian beras', 65000, 'P001'),
(2, '2026-10-02', 'Pembelian minyak', 76000, 'P002'),
(3, '2026-10-03', 'Pembelian gula', 48000, 'P003'),
(4, '2026-10-04', 'Pembelian teh', 34000, 'P004'),
(5, '2026-10-05', 'Pembelian kopi', 24000, 'P005'),
(6, '2026-10-06', 'Pembelian susu', 90000, 'P006'),
(7, '2026-10-07', 'Pembelian mie', 35000, 'P007'),
(8, '2026-10-08', 'Pembelian sabun', 27000, 'P008'),
(9, '2026-10-09', 'Pembelian sampo', 12000, 'P009'),
(10, '2026-10-10', 'Pembelian air mineral', 36000, 'P010');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 65000, 1),
(2, 2, 38000, 2),
(3, 3, 16000, 3),
(4, 4, 8500, 4),
(5, 5, 12000, 2),
(6, 6, 18000, 5),
(7, 7, 3500, 10),
(8, 8, 4500, 6),
(9, 9, 12000, 1),
(10, 10, 3000, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 'Surabaya', '081300000001', 1),
(2, 'kasir1', 'de28f8f7998f23ab4194b51a6029416f', 'Kasir Satu', 'Surabaya', '081300000002', 2),
(3, 'kasir2', 'de28f8f7998f23ab4194b51a6029416f', 'Kasir Dua', 'Sidoarjo', '081300000003', 2),
(4, 'kasir3', 'de28f8f7998f23ab4194b51a6029416f', 'Kasir Tiga', 'Gresik', '081300000004', 2),
(5, 'gudang1', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Petugas Gudang 1', 'Surabaya', '081300000005', 3),
(6, 'gudang2', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Petugas Gudang 2', 'Malang', '081300000006', 3),
(7, 'owner', '5be057accb25758101fa5eadbbd79503', 'Pemilik Toko', 'Surabaya', '081300000007', 1),
(8, 'staff1', 'de9bf5643eabf80f4a56fda3bbb84483', 'Staff Satu', 'Bangkalan', '081300000008', 2),
(9, 'staff2', 'de9bf5643eabf80f4a56fda3bbb84483', 'Staff Dua', 'Surabaya', '081300000009', 2),
(10, 'staff3', 'de9bf5643eabf80f4a56fda3bbb84483', 'Staff Tiga', 'Mojokerto', '081300000010', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
