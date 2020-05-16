-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 16 Bulan Mei 2020 pada 05.58
-- Versi server: 10.2.31-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u8638004_aankasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `authority_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `foto`, `authority_level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'profil11.jpg', 'ADMIN'),
(5, 'NANANG', '38a96b68040b114e0665be56fe0e7e26', 'NANANG', NULL, 'KASIR'),
(6, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'CASIER', NULL, 'KASIR'),
(7, 'firli', '1ff790e81b455edd482288553e452f17', 'FIRLI', NULL, 'KASIR'),
(8, 'yogi', '938e14c074c45c62eb15cc05a6f36d79', 'YOGI', NULL, 'KASIR'),
(9, 'aan1', 'c400557746413ee8cb616664f5912530', 'AAN', NULL, 'ADMIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id` int(11) NOT NULL,
  `id_brg` varchar(50) NOT NULL COMMENT 'prefix 3 karakter pertama + lima digit generate',
  `barcode_brg` varchar(50) DEFAULT NULL COMMENT 'barcode di barang',
  `nama_brg` varchar(40) NOT NULL,
  `kategori` varchar(40) NOT NULL,
  `hrg_beli_pcs` int(10) DEFAULT 0,
  `hrg_beli_pax` int(10) DEFAULT 0,
  `hrg_beli_dus` int(10) DEFAULT 0,
  `pcs_hrgjual_retail` int(10) DEFAULT 0,
  `pax_hrgjual_retail` int(10) DEFAULT 0,
  `dus_hrgjual_retail` int(10) DEFAULT 0,
  `pcs_hrgjual_grosir` int(10) DEFAULT 0,
  `pax_hrgjual_grosir` int(10) DEFAULT 0,
  `dus_hrgjual_grosir` int(10) DEFAULT 0,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id`, `id_brg`, `barcode_brg`, `nama_brg`, `kategori`, `hrg_beli_pcs`, `hrg_beli_pax`, `hrg_beli_dus`, `pcs_hrgjual_retail`, `pax_hrgjual_retail`, `dus_hrgjual_retail`, `pcs_hrgjual_grosir`, `pax_hrgjual_grosir`, `dus_hrgjual_grosir`, `keterangan`) VALUES
(14, 'GGS00001', '8998989300155', 'GG SIGNATURE', '6', 14000, 140000, 1400000, 17000, 170000, 1700000, 16000, 160000, 1600000, NULL),
(15, 'GIV00001', '8998866888622', 'GIV PINK', '5', 2000, 200000, 2000000, 3000, 300000, 3000000, 2500, 250000, 2500000, NULL),
(16, 'SOK00001', '8998866608237', 'SO KLIN LANTAI HIJAU 80 ML', '5', 800, 80000, 800000, 1000, 100000, 1000000, 900, 90000, 900000, NULL),
(17, 'CLO00001', '8999999707842', 'CLOSEUP 110', '5', 10000, 100000, 1000000, 12000, 120000, 1200000, 11000, 110000, 1100000, NULL),
(18, 'KOM00001', '8993058300500', 'KOMIX JAHE SASET', '7', 800, 8000, 80000, 1000, 10000, 100000, 900, 9000, 90000, NULL),
(19, 'MOM00001', '8994075230399', 'MOMOGI', '8', 1000, 10000, 100000, 1500, 15000, 150000, 1200, 12000, 120000, NULL),
(20, 'VAS00001', '8999999533373', 'VASELINE', '3', 9000, 90000, 900000, 10000, 100000, 1000000, 9500, 95000, 9500000, ''),
(21, 'WAR00001', '8993137692526', 'WARDAH', '3', 5000, 50000, 500000, 7000, 70000, 700000, 6000, 60000, 600000, NULL),
(22, 'JKF00001', '950470', 'JKFGSDK', '2', 88, 88, 66, 9869, 73763, 62626, 1929, 92929, 626, 'TYSSHGS'),
(23, 'TBM00001', '12345', 'TBM', '2', 1000, 10000, 100000, 2000, 20000, 200000, 1500, 15000, 150000, '10 / PAK, 100/DUS'),
(24, 'GGS00002', '8998989300261', 'GG SURYA 12', '6', 15000, 150000, 1500000, 17000, 170000, 1700000, 16000, 160000, 1600000, 'PAK 10 DUS 100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_detail_jual`
--

CREATE TABLE `data_detail_jual` (
  `d_jual_id` int(11) NOT NULL,
  `d_jual_nofak` varchar(15) DEFAULT NULL,
  `d_jual_barang_id` varchar(15) DEFAULT NULL,
  `d_jual_barang_nama` varchar(150) DEFAULT NULL,
  `d_jual_barang_satuan` varchar(30) DEFAULT NULL,
  `d_jual_barang_harpok` double DEFAULT NULL,
  `d_jual_barang_harjul` double DEFAULT NULL,
  `d_jual_qty` int(11) DEFAULT NULL,
  `d_jual_diskon` double DEFAULT NULL,
  `d_jual_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jual`
--

CREATE TABLE `data_jual` (
  `jual_nofak` varchar(15) NOT NULL,
  `jual_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `jum_modal` double DEFAULT NULL,
  `jual_total` double DEFAULT NULL,
  `jual_jml_uang` double DEFAULT NULL,
  `jual_kembalian` double DEFAULT NULL,
  `jum_keuntungan` double DEFAULT NULL,
  `jual_user_id` varchar(200) DEFAULT NULL,
  `jual_keterangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_karyawan`
--

INSERT INTO `data_karyawan` (`id`, `id_admin`, `name`, `address`, `phone`) VALUES
(1, 6, 'CASIER', 'CASIER', '000123'),
(2, 7, 'FIRLI', 'BOBOTSARI', '089777666555'),
(3, 8, 'YOGI', 'BOBOTSARI', '087888999000'),
(4, 9, 'AAN', 'BOBOTSARI', '085701621774');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kategori`
--

CREATE TABLE `data_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kategori`
--

INSERT INTO `data_kategori` (`id`, `kategori`) VALUES
(1, 'ALAT TULIS'),
(2, 'BAHAN ROTI'),
(3, 'BEDAK'),
(4, 'ALAT POTONG'),
(5, 'SABUN'),
(6, 'ROKOK'),
(7, 'OBAT'),
(8, 'JAJAN'),
(9, 'GULA');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_detail_jual`
--
ALTER TABLE `data_detail_jual`
  ADD PRIMARY KEY (`d_jual_id`);

--
-- Indeks untuk tabel `data_jual`
--
ALTER TABLE `data_jual`
  ADD PRIMARY KEY (`jual_nofak`);

--
-- Indeks untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_kategori`
--
ALTER TABLE `data_kategori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `data_detail_jual`
--
ALTER TABLE `data_detail_jual`
  MODIFY `d_jual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_kategori`
--
ALTER TABLE `data_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
