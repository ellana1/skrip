-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 03:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stok_bisma`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id` int(11) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id`, `nama_bahan`, `satuan`, `harga`) VALUES
(1, 'HVS', 'lembar', 2000),
(2, 'AP', 'lembar', 3000),
(3, 'AC 210 gr', 'lembar', 4000),
(4, 'Chromo', 'lembar', 4000),
(5, 'AC 230 gr', 'lembar', 4000),
(6, 'Vinyl', 'lembar', 9000),
(7, 'kertas Tik', 'lembar', 4500),
(8, 'vinyl silver', 'lembar', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(5) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `kode_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `stok_id` int(11) DEFAULT NULL,
  `harga` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `kategori_id`, `kode_barang`, `nama_barang`, `stok_id`, `harga`) VALUES
(4, 2, 10621, 'Nota PT. Roy Boris', 500, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `pengeluaran` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `pengeluaran`, `tanggal`, `penerima`, `keterangan`) VALUES
(1, 250, '2021-05-31', 'Percetakan Garuda', 'stiker cromo'),
(2, 50, '2021-06-03', 'imam', 'Nota PT. Roy Boris');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `kode_barang`, `tanggal`, `nama_barang`, `keterangan`) VALUES
(1, '230', '2021-05-28', 'Art Carton', 'untuk Banner'),
(2, '150', '2021-05-26', 'Art Paper', 'untuk katalog');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(5) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `bahan_id` varchar(100) NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `qty` int(5) DEFAULT NULL,
  `subtotal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `bahan_id`, `barang_id`, `qty`, `subtotal`) VALUES
(1, 0, '', 0, 0, ''),
(2, 3, '', NULL, 1, ''),
(3, 3, '', NULL, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(5) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'digital printing'),
(2, 'Offset');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `alamat`, `telp`, `username`, `password`, `foto`) VALUES
(1, 'dodi', 'cileungsi', '081387217621', 'dodi123', '12345', 'user.jfif'),
(3, 'Ahmad dani', 'bogor', '08526276534554', 'dani', 'dani123', 'user.jfif'),
(5, 'Febriyan', 'cileungsi', '081387217621', 'febri', '', 'user.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `stok` int(200) DEFAULT NULL,
  `harga` int(50) NOT NULL,
  `kategori` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id`, `nama_barang`, `jenis`, `stok`, `harga`, `kategori`) VALUES
(1, 'Buku Tahunan', 'AC 210 gr', 140, 45000, '2'),
(2, 'Chromo', 'AC 230gr', 5750, 4000, '1'),
(3, 'Art Paper', '248', 350, 3500, '2'),
(4, 'AC 230', '124', 124, 4000, '2'),
(5, 'Nota Azzah Laundry', 'Buku Nota Azzah Laundry', 300, 4500, '2'),
(6, 'AP 150gr', 'Art Paper 150gr', 600, 3000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `produk` text NOT NULL,
  `jumlah_barang` int(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama_perusahaan`, `alamat`, `produk`, `jumlah_barang`, `keterangan`) VALUES
(1, 'Toko JLS', 'Senen, Jakarta Pusat', 'tinta dan kertas', 3, '/pack Vinil glosy'),
(2, 'Toko Joy', 'Pasar Senen, Jakarta Pusat', 'kertas', 6, '/pack cromo'),
(3, 'Timur Jaya', 'Kramat jati, Jakarta timur', 'kertas', 0, ''),
(4, 'Master Grafika', 'Pasar senen, Jakpus', 'tinta', 0, ''),
(5, 'INKO', 'Indonesia', 'Mesin', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total` int(50) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama_customer`, `tanggal`, `total`) VALUES
(1, 'palapa', '2021-05-27', 0),
(2, 'Jamal', '2021-05-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `nama`) VALUES
(1, 'admin', 'admin', 'admin', 'Adminitrasi'),
(2, 'elinmrl', '220799', 'admin', 'Elin M'),
(6, 'febri', 'febri', 'pegawai', 'febriansyah'),
(7, 'supplier', 'supplier', 'supplier', 'Timur Jaya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
