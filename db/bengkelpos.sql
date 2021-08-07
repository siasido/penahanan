-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2021 at 03:36 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkelpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `idcompany` int(11) NOT NULL,
  `namacompany` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`idcompany`, `namacompany`, `nohp`, `alamat`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Surya Mandiri Motors', '081210002000', 'Jl. Raya Bojongsoang', '2021-07-18 10:33:44', '2021-07-18 10:39:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `deskripsi`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Kopling Matic', 'zzz', '2021-07-17 17:14:00', '2021-07-17 17:18:00', 1),
(2, 'Roller', '', '2021-07-17 17:18:00', NULL, 1),
(3, 'zzz', '', '2021-07-17 17:18:00', '2021-07-17 17:19:00', 0),
(4, 'Oli', 'Oli kalengan atau jerigen', '2021-07-24 12:46:00', '2021-07-24 12:47:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outstock`
--

CREATE TABLE `outstock` (
  `idoutstock` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `notes` text NOT NULL,
  `outstockdate` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outstock`
--

INSERT INTO `outstock` (`idoutstock`, `idproduk`, `qty`, `notes`, `outstockdate`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 2, 1, '0', '2021-07-24', '2021-07-24 14:53:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `idproduk` int(11) NOT NULL,
  `namaproduk` varchar(80) NOT NULL,
  `sisastock` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `idkategori` int(11) NOT NULL,
  `idunit` int(11) NOT NULL,
  `hargasatuan` int(11) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`idproduk`, `namaproduk`, `sisastock`, `deskripsi`, `idkategori`, `idunit`, `hargasatuan`, `foto`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'kampas kopling mio', 0, '', 1, 3, 50000, '', '2021-07-18 09:57:00', '2021-07-18 10:26:00', 0),
(2, 'Roller Kawahara', 6, 'qqqq', 2, 3, 90000, 'product-20210718100719.jpg', '2021-07-18 10:07:00', '2021-08-07 09:57:52', 1),
(3, 'Kopling x', 95, '', 1, 3, 50000, 'product-20210724082009.jpg', '2021-07-24 08:20:00', '2021-08-07 09:57:52', 1),
(4, 'Yamalube', 95, '', 4, 4, 48000, 'product-20210724124747.jpg', '2021-07-24 12:47:00', '2021-08-07 09:57:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasestock`
--

CREATE TABLE `purchasestock` (
  `idpurchase` int(11) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `purchasedate` date NOT NULL,
  `idproduk` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchasestock`
--

INSERT INTO `purchasestock` (`idpurchase`, `idsupplier`, `purchasedate`, `idproduk`, `notes`, `created_at`, `updated_at`, `is_active`, `qty`) VALUES
(1, 1, '2021-07-24', 2, 'barang sudah diterima dalam keadaan baik', '2021-07-24 13:27:00', NULL, 1, 10),
(2, 1, '2021-08-07', 3, 'zzz', '2021-08-07 08:48:00', NULL, 1, 100),
(3, 3, '2021-08-05', 4, '', '2021-08-07 08:48:00', NULL, 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `idrekening` int(11) NOT NULL,
  `namaakun` varchar(40) NOT NULL,
  `namabank` varchar(50) NOT NULL,
  `norek` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`idrekening`, `namaakun`, `namabank`, `norek`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Andi Sen', 'BRI', '014121000', '2021-07-18 10:58:00', '2021-07-18 11:01:00', 0),
(2, 'Andi S', 'BCA', '014121001', '2021-07-18 10:59:00', NULL, 1),
(3, 'Andi law', 'BNI', '0912313221321', '2021-07-28 16:43:00', NULL, 1),
(4, 'Andi law', 'Mandiri', '0198991231231', '2021-07-28 16:44:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesdetail`
--

CREATE TABLE `salesdetail` (
  `idsalesdetail` int(11) NOT NULL,
  `no_order` varchar(35) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesdetail`
--

INSERT INTO `salesdetail` (`idsalesdetail`, `no_order`, `idproduk`, `qty`, `created_at`, `updated_at`, `is_active`) VALUES
(1, '20210729074930IA0RLJKV', 2, 4, '2021-07-29 07:50:00', NULL, 1),
(2, '20210729074930IA0RLJKV', 3, 4, '2021-07-29 07:50:00', NULL, 1),
(4, '20210729085157JISGQIYN', 2, 5, '2021-07-29 08:54:00', NULL, 1),
(5, '20210802083021XOFU8EDQ', 2, 1, '2021-08-02 08:30:00', NULL, 1),
(6, '20210802083021XOFU8EDQ', 3, 1, '2021-08-02 08:30:00', NULL, 1),
(7, '20210807082843FR6JNI7G', 2, 2, '2021-08-07 08:28:00', NULL, 1),
(8, '202108070955254XJUSMLR', 2, 1, '2021-08-07 09:56:00', NULL, 1),
(9, '202108070955254XJUSMLR', 3, 5, '2021-08-07 09:56:00', NULL, 1),
(10, '202108070955254XJUSMLR', 4, 5, '2021-08-07 09:56:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesheader`
--

CREATE TABLE `salesheader` (
  `idsales` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `idrekening` int(11) NOT NULL,
  `notes` text NOT NULL,
  `status` int(11) NOT NULL,
  `no_order` varchar(35) NOT NULL,
  `namapenerima` varchar(40) NOT NULL,
  `nohppenerima` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `kurir` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `buktipembayaran` varchar(40) NOT NULL,
  `statusbayar` int(1) NOT NULL,
  `statusorder` int(1) NOT NULL,
  `catatanpembayaran` text NOT NULL,
  `noresi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesheader`
--

INSERT INTO `salesheader` (`idsales`, `userid`, `total`, `idrekening`, `notes`, `status`, `no_order`, `namapenerima`, `nohppenerima`, `alamat`, `kurir`, `created_at`, `updated_at`, `is_active`, `buktipembayaran`, `statusbayar`, `statusorder`, `catatanpembayaran`, `noresi`) VALUES
(2, 2, 560000, 2, 'asdasda', 0, '20210729074930IA0RLJKV', 'liana', '081231112313', 'Jl. Raya Bojong Gede', 'Tiki', '2021-07-29 07:49:00', '2021-08-07 09:50:45', 1, 'resibayar-20210729142128eA1T8ylW.jpg', 3, 3, 'Diterima', 'A121ZQQ'),
(5, 2, 450000, 2, 'TItip di pos satpam', 0, '20210729085157JISGQIYN', 'liana', '08123123131', 'Jl Kaliurang', 'Sicepat', '2021-07-29 08:52:00', '2021-08-07 07:54:57', 1, 'resibayar-20210729145217RVQNzm20.jpeg', 3, 2, 'Valid', ''),
(7, 2, 140000, 2, 'aqqq', 0, '20210802083021XOFU8EDQ', 'liana', '08123132131231', 'zzz', 'JNT', '2021-08-02 08:30:00', NULL, 1, '', 0, 0, '', ''),
(8, 2, 180000, 2, 'kamar no 8', 0, '20210807082843FR6JNI7G', 'kalit', '0812311231321', 'Jl. Ahmad Yani', 'Sicepat', '2021-08-07 08:28:00', '2021-08-07 08:44:45', 1, 'resibayar-20210807082911iy9LpqGt.jpg', 3, 2, 'Valid', '121AQSSA'),
(9, 2, 580000, 3, 'qqq', 0, '202108070955254XJUSMLR', 'Jon Doe', '081110002000', 'Jl. Simatupang', 'POS', '2021-08-07 09:56:00', '2021-08-07 10:00:22', 1, 'resibayar-20210807095615icfuNahl.jpg', 3, 3, 'valid', '1231QSADA');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `sisastock` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `idsupplier` int(11) NOT NULL,
  `namasupplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `deskripsi` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`idsupplier`, `namasupplier`, `alamat`, `deskripsi`, `nohp`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Jaya Abadi', 'Jln. Raya Bojongsoang', 'zzxcz', '081211221122', '2021-07-17 10:22:11', '2021-07-17 14:12:00', 1),
(2, 'Mega Sparepart', 'Jl. Cibaduyut', 'aaaa', '08121212121', '2021-07-17 10:55:24', '2021-07-17 16:37:00', 0),
(3, 'Trimega Supplier', 'aaa', '', '081210002000', '2021-07-17 13:05:00', NULL, 1),
(4, 'jonozz', 'zzz', 'zz', '123131313131', '2021-07-17 13:06:00', '2021-07-17 14:20:00', 1),
(5, 'z', 'z', '', '123123123123', '2021-07-17 13:14:00', NULL, 0),
(6, 'q', 'zz', '', '12341234124', '2021-07-17 13:15:00', NULL, 0),
(7, 'Jaya Abadi 2', 'zz', '', '081211112222', '2021-07-17 17:14:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `idunit` int(11) NOT NULL,
  `namaunit` varchar(40) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`idunit`, `namaunit`, `deskripsi`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Kilogram', 'Kilogram', '2021-07-17 16:25:01', '2021-07-17 16:36:00', 1),
(2, 'Pcs', '', '2021-07-17 16:30:00', '2021-07-17 16:39:00', 0),
(3, 'Pcs', 'zzz', '2021-07-17 16:44:00', NULL, 1),
(4, 'liter', 'zz', '2021-07-24 12:46:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `namalengkap` varchar(40) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `role` int(11) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `namalengkap`, `foto`, `role`, `nohp`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'joko triyono', 'bengkel.jpg', 1, '0', '2021-07-17 01:27:52', '2021-07-17 01:27:52', 1),
(2, 'nana', '893a6a6789d8aef157ac0615ac3855587daaac07', 'nana nana', 'bengkel.jpg', 2, '', '2021-07-17 01:27:52', '2021-07-17 01:27:52', 1),
(3, 'kalitx', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Johnnie Walker', 'user-20210807130817.jpg', 2, '081112003400', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`idcompany`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `outstock`
--
ALTER TABLE `outstock`
  ADD PRIMARY KEY (`idoutstock`),
  ADD KEY `fk_product_outstock` (`idproduk`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `fk_kategori` (`idkategori`),
  ADD KEY `fk_units` (`idunit`);

--
-- Indexes for table `purchasestock`
--
ALTER TABLE `purchasestock`
  ADD PRIMARY KEY (`idpurchase`),
  ADD KEY `fk_supplier_po` (`idsupplier`),
  ADD KEY `fk_products` (`idproduk`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`idrekening`);

--
-- Indexes for table `salesdetail`
--
ALTER TABLE `salesdetail`
  ADD PRIMARY KEY (`idsalesdetail`),
  ADD KEY `fk_sales_products` (`idproduk`);

--
-- Indexes for table `salesheader`
--
ALTER TABLE `salesheader`
  ADD PRIMARY KEY (`idsales`),
  ADD KEY `fk_sales_users` (`userid`),
  ADD KEY `fk_sales_rekenign` (`idrekening`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stock_product` (`idproduk`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`idsupplier`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`idunit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `idcompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outstock`
--
ALTER TABLE `outstock`
  MODIFY `idoutstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchasestock`
--
ALTER TABLE `purchasestock`
  MODIFY `idpurchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `idrekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salesdetail`
--
ALTER TABLE `salesdetail`
  MODIFY `idsalesdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salesheader`
--
ALTER TABLE `salesheader`
  MODIFY `idsales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `idsupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `idunit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `outstock`
--
ALTER TABLE `outstock`
  ADD CONSTRAINT `fk_product_outstock` FOREIGN KEY (`idproduk`) REFERENCES `products` (`idproduk`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`),
  ADD CONSTRAINT `fk_units` FOREIGN KEY (`idunit`) REFERENCES `units` (`idunit`);

--
-- Constraints for table `purchasestock`
--
ALTER TABLE `purchasestock`
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`idproduk`) REFERENCES `products` (`idproduk`),
  ADD CONSTRAINT `fk_supplier_po` FOREIGN KEY (`idsupplier`) REFERENCES `suppliers` (`idsupplier`);

--
-- Constraints for table `salesdetail`
--
ALTER TABLE `salesdetail`
  ADD CONSTRAINT `fk_sales_products` FOREIGN KEY (`idproduk`) REFERENCES `products` (`idproduk`);

--
-- Constraints for table `salesheader`
--
ALTER TABLE `salesheader`
  ADD CONSTRAINT `fk_sales_rekenign` FOREIGN KEY (`idrekening`) REFERENCES `rekening` (`idrekening`),
  ADD CONSTRAINT `fk_sales_users` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_product` FOREIGN KEY (`idproduk`) REFERENCES `products` (`idproduk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
