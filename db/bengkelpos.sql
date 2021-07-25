-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 09:14 AM
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
(2, 'Roller Kawahara', 9, 'qqqq', 2, 3, 90000, 'product-20210718100719.jpg', '2021-07-18 10:07:00', '2021-07-24 14:53:00', 1),
(3, 'Kopling x', 0, '', 1, 3, 50000, 'product-20210724082009.jpg', '2021-07-24 08:20:00', NULL, 1),
(4, 'Yamalube', 0, '', 4, 4, 48000, 'product-20210724124747.jpg', '2021-07-24 12:47:00', NULL, 1);

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
(1, 1, '2021-07-24', 2, 'barang sudah diterima dalam keadaan baik', '2021-07-24 13:27:00', NULL, 1, 10);

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
(2, 'Andi S', 'BCA', '014121001', '2021-07-18 10:59:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesdetail`
--

CREATE TABLE `salesdetail` (
  `idsales` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskonsatuan` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salesheader`
--

CREATE TABLE `salesheader` (
  `idsales` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `grandtotal` int(11) NOT NULL,
  `idrekening` int(11) NOT NULL,
  `notes` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'nana', '893a6a6789d8aef157ac0615ac3855587daaac07', 'nana nana', 'bengkel.jpg', 2, '', '2021-07-17 01:27:52', '2021-07-17 01:27:52', 1);

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
  ADD KEY `fk_sales_products` (`idproduk`),
  ADD KEY `fk_sales_header` (`idsales`);

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
  MODIFY `idpurchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `idrekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salesheader`
--
ALTER TABLE `salesheader`
  MODIFY `idsales` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `fk_sales_header` FOREIGN KEY (`idsales`) REFERENCES `salesheader` (`idsales`),
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
