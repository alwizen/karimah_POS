-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 04:28 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `karimah`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`kd_barang` int(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `harga_beli` int(100) NOT NULL,
  `harga_jual` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `model`, `id_supplier`, `harga_beli`, `harga_jual`) VALUES
(14, 'Hijab MoonLight', 'Hijab Segi Empat', 1, 17000, 20000),
(15, 'Hijab Komang', 'Hijab Jumbo', 1, 9000, 10000),
(16, 'Hijab Sangkuriang', 'Hijab Serut', 1, 1000, 12000),
(17, 'Hijab Paris', 'Hijab Segi Empat', 1, 1000, 6000),
(18, 'Hijab Paris hilton', 'Hijab Segi Empat', 1, 4000, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `det_pembelian`
--

CREATE TABLE IF NOT EXISTS `det_pembelian` (
`id_det_pembelian` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_pembelian`
--

INSERT INTO `det_pembelian` (`id_det_pembelian`, `id_pembelian`, `kd_barang`, `jumlah`) VALUES
(11, 11, 14, 190),
(12, 12, 14, 11),
(13, 13, 14, 33),
(14, 14, 15, 300),
(15, 15, 16, 1000),
(16, 16, 17, 900),
(17, 17, 15, 100),
(18, 17, 16, 100),
(19, 17, 17, 100),
(20, 18, 18, 100);

-- --------------------------------------------------------

--
-- Table structure for table `det_penjualan`
--

CREATE TABLE IF NOT EXISTS `det_penjualan` (
`no_det_penjualan` int(11) NOT NULL,
  `no_penjualan` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_penjualan`
--

INSERT INTO `det_penjualan` (`no_det_penjualan`, `no_penjualan`, `kd_barang`, `jumlah`, `harga`, `created_at`, `updated_at`) VALUES
(14, 10, 14, 20, 20000, '2018-07-16 08:27:24', '2018-07-16 08:27:24'),
(15, 11, 14, 9, 20000, '2018-07-21 00:22:47', '2018-07-21 00:22:47'),
(16, 12, 14, 9, 20000, '2018-07-21 03:16:09', '2018-07-21 03:16:09'),
(17, 13, 15, 90, 10000, '2018-07-21 03:16:52', '2018-07-21 03:16:52'),
(18, 14, 14, 5, 20000, '2018-07-21 03:17:21', '2018-07-21 03:17:21'),
(19, 14, 15, 5, 10000, '2018-07-21 03:17:21', '2018-07-21 03:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kd_kategori` char(6) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nama_kategori`) VALUES
('H4002', 'Hijab Segi Empat'),
('HJ008', 'Hijab Anak'),
('HJ980', 'Hijab Jumbo'),
('HS006', 'Hijab Serut');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
`id_pembelian` int(11) NOT NULL,
  `kd_pembelian` char(20) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `kd_pembelian`, `tanggal`, `created_at`, `updated_at`) VALUES
(11, '20180716FC8D', '2018-07-16', '2018-07-16 08:18:35', '2018-07-16 08:18:35'),
(12, '201807177CD2', '2018-07-17', '2018-07-17 04:59:08', '2018-07-17 04:59:08'),
(13, '201807217779', '2018-07-21', '2018-07-21 00:22:20', '2018-07-21 00:22:20'),
(14, '201807218E0A', '2018-07-21', '2018-07-21 03:08:19', '2018-07-21 03:08:19'),
(15, '2018072133CB', '2018-07-21', '2018-07-21 10:54:30', '2018-07-21 10:54:30'),
(16, '2018072279CD', '2018-07-22', '2018-07-22 13:08:53', '2018-07-22 13:08:53'),
(17, '201807223E6D', '2018-07-22', '2018-07-22 13:11:34', '2018-07-22 13:11:34'),
(18, '20180722CF3B', '2018-07-22', '2018-07-22 14:37:03', '2018-07-22 14:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
`no_penjualan` int(11) NOT NULL,
  `kd_transaksi` char(20) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `kd_transaksi`, `tanggal`, `created_at`, `updated_at`) VALUES
(10, '2018071632E5', '2018-07-16', '2018-07-16 08:27:24', '2018-07-16 08:27:24'),
(11, '20180721E7E4', '2018-07-21', '2018-07-21 00:22:46', '2018-07-21 00:22:46'),
(13, '20180721C65E', '2018-07-21', '2018-07-21 03:16:52', '2018-07-21 03:16:52'),
(14, '201807215739', '2018-07-21', '2018-07-21 03:17:21', '2018-07-21 03:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
`id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` char(14) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_tlp`) VALUES
(1, '  Kimbo  Hijab', ' jakarta ', '085701355578');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','kasir','','') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', 'admin', 'admin'),
(2, 'Alwi Zen', 'alwizen', 'alwizen', 'admin'),
(5, 'Si kasir', 'kasir', 'kasir', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `det_pembelian`
--
ALTER TABLE `det_pembelian`
 ADD PRIMARY KEY (`id_det_pembelian`);

--
-- Indexes for table `det_penjualan`
--
ALTER TABLE `det_penjualan`
 ADD PRIMARY KEY (`no_det_penjualan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
 ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
 ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
 ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `kd_barang` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `det_pembelian`
--
ALTER TABLE `det_pembelian`
MODIFY `id_det_pembelian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `det_penjualan`
--
ALTER TABLE `det_penjualan`
MODIFY `no_det_penjualan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
MODIFY `no_penjualan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
