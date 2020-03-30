-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Des 2017 pada 04.16
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ujian_labor_dewa_802066`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar_802066`
--

CREATE TABLE IF NOT EXISTS `kamar_802066` (
`kode_kamar_802066` int(4) NOT NULL,
  `nama_kamar_802066` varchar(50) NOT NULL,
  `tarif_normal_802066` int(8) NOT NULL,
  `tarif_khusus_802066` int(8) NOT NULL,
  `tipe_kamar_802066` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `kamar_802066`
--

INSERT INTO `kamar_802066` (`kode_kamar_802066`, `nama_kamar_802066`, `tarif_normal_802066`, `tarif_khusus_802066`, `tipe_kamar_802066`) VALUES
(1, 'Kamar Pria Kelas 1', 30000, 20000, 1),
(2, 'Kamar Pria Kelas 2', 27000, 18000, 1),
(3, 'Kamar Wanita Kelas 1', 32000, 28000, 1),
(4, 'Kamar Wanita Kelas 2', 29000, 26000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan_802066`
--

CREATE TABLE IF NOT EXISTS `pelanggan_802066` (
`id_pelanggan_802066` int(4) NOT NULL,
  `nama_pelanggan_802066` varchar(35) NOT NULL,
  `jenis_kelamin_802066` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `pelanggan_802066`
--

INSERT INTO `pelanggan_802066` (`id_pelanggan_802066`, `nama_pelanggan_802066`, `jenis_kelamin_802066`) VALUES
(1, 'Wahyu', 'Laki-Laki'),
(2, 'Dewi', 'Perempuan'),
(3, 'Dewa', 'Laki-Laki'),
(4, 'SInta', 'Perempuan'),
(5, 'Agus', 'Laki-Laki'),
(6, 'Hani', 'Perempuan'),
(7, 'Nano', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_802066`
--

CREATE TABLE IF NOT EXISTS `transaksi_802066` (
`id_transaksi_802066` int(4) NOT NULL,
  `id_pelanggan_802066` int(4) NOT NULL,
  `kode_kamar_802066` int(4) NOT NULL,
  `lama_inap_802066` int(4) NOT NULL,
  `fasilitas_tambahan_802066` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `transaksi_802066`
--

INSERT INTO `transaksi_802066` (`id_transaksi_802066`, `id_pelanggan_802066`, `kode_kamar_802066`, `lama_inap_802066`, `fasilitas_tambahan_802066`) VALUES
(1, 2, 3, 30, 'Lemari, Kipas Angin'),
(2, 1, 1, 6, 'Lemari'),
(3, 5, 2, 10, 'Lemari, Kursi, Kipas Angin'),
(4, 4, 3, 80, ''),
(5, 6, 4, 4, 'Lemari, Kursi, Kipas Angin'),
(6, 7, 2, 12, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar_802066`
--
ALTER TABLE `kamar_802066`
 ADD PRIMARY KEY (`kode_kamar_802066`);

--
-- Indexes for table `pelanggan_802066`
--
ALTER TABLE `pelanggan_802066`
 ADD PRIMARY KEY (`id_pelanggan_802066`);

--
-- Indexes for table `transaksi_802066`
--
ALTER TABLE `transaksi_802066`
 ADD PRIMARY KEY (`id_transaksi_802066`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar_802066`
--
ALTER TABLE `kamar_802066`
MODIFY `kode_kamar_802066` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pelanggan_802066`
--
ALTER TABLE `pelanggan_802066`
MODIFY `id_pelanggan_802066` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transaksi_802066`
--
ALTER TABLE `transaksi_802066`
MODIFY `id_transaksi_802066` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
