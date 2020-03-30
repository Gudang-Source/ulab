-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Des 2017 pada 03.18
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ujian_labor_dewa_066`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar_066`
--

CREATE TABLE IF NOT EXISTS `kamar_066` (
`kode_kamar` int(4) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `tarif_normal` int(8) NOT NULL,
  `tarif_khusus` int(8) NOT NULL,
  `tipe_kamar` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `kamar_066`
--

INSERT INTO `kamar_066` (`kode_kamar`, `nama_kamar`, `tarif_normal`, `tarif_khusus`, `tipe_kamar`) VALUES
(1, 'Kamar Pria Kelas 1', 30000, 20000, 1),
(2, 'Kamar Pria Kelas 2', 27000, 18000, 1),
(3, 'Kamar Wanita Kelas 1', 32000, 28000, 1),
(4, 'Kamar Wanita Kelas 2', 29000, 26000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan_066`
--

CREATE TABLE IF NOT EXISTS `pelanggan_066` (
`id_pelanggan` int(4) NOT NULL,
  `nama_pelanggan` varchar(35) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `pelanggan_066`
--

INSERT INTO `pelanggan_066` (`id_pelanggan`, `nama_pelanggan`, `jenis_kelamin`) VALUES
(1, 'Wahyu', 'Laki-Laki'),
(2, 'Dewi', 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_066`
--

CREATE TABLE IF NOT EXISTS `transaksi_066` (
`id_transaksi` int(4) NOT NULL,
  `id_pelanggan` int(4) NOT NULL,
  `kode_kamar` int(4) NOT NULL,
  `lama_inap` int(4) NOT NULL,
  `fasilitas_tambahan` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `transaksi_066`
--

INSERT INTO `transaksi_066` (`id_transaksi`, `id_pelanggan`, `kode_kamar`, `lama_inap`, `fasilitas_tambahan`) VALUES
(1, 2, 3, 30, 'Lemari, Kipas Angin'),
(2, 1, 1, 6, 'Lemari');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar_066`
--
ALTER TABLE `kamar_066`
 ADD PRIMARY KEY (`kode_kamar`);

--
-- Indexes for table `pelanggan_066`
--
ALTER TABLE `pelanggan_066`
 ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi_066`
--
ALTER TABLE `transaksi_066`
 ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar_066`
--
ALTER TABLE `kamar_066`
MODIFY `kode_kamar` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pelanggan_066`
--
ALTER TABLE `pelanggan_066`
MODIFY `id_pelanggan` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_066`
--
ALTER TABLE `transaksi_066`
MODIFY `id_transaksi` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
