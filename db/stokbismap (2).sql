-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 10:15 PM
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
-- Database: `stokbismap`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `satuan` varchar(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `id_kategori`, `satuan`, `harga`) VALUES
(1, 'HVS', 0, 'lembar', 2000),
(2, 'AP', 0, 'lembar', 3000),
(3, 'AC 210 gr', 0, 'lembar', 4000),
(4, 'Chromo', 0, 'lembar', 4000),
(5, 'AC 230 gr', 0, 'lembar', 4000),
(6, 'Vinyl', 0, 'lembar', 9000),
(7, 'kertas Tik', 0, 'lembar', 4500),
(81, '', 0, 'lembar', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `nama_barang` varchar(150) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(50) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `tanggal`, `nama_barang`, `stok`, `harga`, `id_kategori`) VALUES
(2, '2021-06-11', 'Chromo', 5750, 4000, 1),
(3, '2021-06-11', 'Art Paper', 350, 3500, 2),
(4, '2021-06-11', 'AC 230', 124, 4000, 2),
(5, '2021-06-11', 'Nota Azzah Laundry', 300, 4500, 2),
(6, '2021-06-11', 'AP 150gr', 600, 3000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_keluar` varchar(255) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_barang`, `jumlah_keluar`, `tanggal`, `penerima`, `keterangan`) VALUES
(3, 0, '250', '2021-05-31', 'Percetakan Garuda', 'stiker cromo'),
(4, 0, '50', '2021-06-03', 'imam', 'Nota PT. Roy Boris'),
(15, 2, '6', '2021-06-03', 'elin', 'stiker waroengmbael');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(5) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tipe` varchar(40) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `tipe`, `item_id`, `qty`, `subtotal`) VALUES
(5, 2, 'bahan', 6, 2, '18000'),
(6, 2, 'bahan', 3, 2, '8000'),
(7, 1, 'stok', 4, 50, '200000'),
(8, 0, 'stok', 2, 5, '20000'),
(10, 4, 'stok', 3, 4, '14000'),
(11, 4, 'bahan', 1, 10, '20000'),
(12, 5, 'barang', 2, 3, '12000'),
(13, 5, 'barang', 4, 5, '20000');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'digital printing'),
(2, 'Offset');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `nama`, `alamat`, `telp`, `username`, `password`, `level`, `foto`) VALUES
(4, 0, 'febri', 'cileungsi', '081387217621', 'febri', 'febri', 'pegawai', 'user.jfif'),
(5, 0, 'dodi', 'cileungsi', '081387217621', 'dodi123', '12345', 'pegawai', 'user.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id_supplier` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `produk` text NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id_supplier`, `id_user`, `username`, `password`, `level`, `nama_perusahaan`, `alamat`, `produk`, `jumlah_barang`, `keterangan`) VALUES
(6, 0, 'supplier', 'supplier', 'supplier', 'Toko JLS', 'Senen, Jakarta Pusat', 'tinta dan kertas', 3, '/pack Vinil glosy'),
(7, 0, 'supplier2', '1234', 'supplier', 'Toko Joy', 'Pasar Senen, Jakarta Pusat', 'kertas', 6, '/pack cromo'),
(8, 0, '', '', 'supplier', 'Timur Jaya', 'Kramat jati, Jakarta timur', 'kertas', 0, ''),
(9, 0, '', '', 'supplier', 'Master Grafika', 'Pasar senen, Jakpus', 'tinta', 0, ''),
(10, 0, '', '', 'supplier', 'INKO', 'Indonesia', 'Mesin', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total` int(50) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nama_customer`, `tanggal`, `total`) VALUES
(1, 'Jamal', '2021-05-27', 200000),
(2, 'Edi', '2021-05-28', 30500),
(4, 'Budi', '2021-06-09', 28000),
(5, 'Cinta', '2021-06-09', 32000);

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
(7, 'supplier', 'supplier', 'supplier', 'Timur Jaya'),
(8, 'ami123', 'ami123', 'pegawai', 'Fahmi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_barang_2` (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

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
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
