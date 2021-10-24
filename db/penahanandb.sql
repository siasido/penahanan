-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 01:30 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penahanandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `singkatan` varchar(50) NOT NULL,
  `tipe` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama`, `singkatan`, `tipe`, `alamat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kejaksaan Negeri Kota Kupang', 'Kejari Kota Kupang', 1, 'Jl. Palapa, Kel. Oebobo, Kec. Oebobo, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:00:00', '2021-10-21 10:09:00'),
(2, 'Kepolisian Daerah Nusa Tenggara Timur Direktorat Reserse Narkoba', 'Ditresnarkoba-Polda', 2, 'Jl. Jend. Soeharto No.3, Naikoten II, Kec. Kota Raja, Kota Kupang, Nusa Tenggara Timur, Kode Pos 85142', 1, '2021-10-13 08:11:00', '2021-10-13 08:11:00'),
(3, 'Kepolisian Daerah Nusa Tenggara Timur Direktorat Reserse Kriminal Umum', 'Ditreskrimum-Polda', 2, 'Jl. Jend. Soeharto No.3, Naikoten II, Kec. Kota Raja, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:12:00', '2021-10-13 08:12:00'),
(4, 'Kepolisian Daerah Nusa Tenggara Timur Direktorat Reserse Kriminal Khusus', 'Ditreskrimsus-Polda', 2, 'Jl. Jend. Soeharto No.3, Naikoten II, Kec. Kota Raja, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:13:00', '2021-10-13 08:13:00'),
(5, 'Kepolisian Daerah Nusa Tenggara Timur Resor Kupang Kota', 'Polresta', 2, 'Jl. Frans Seda, Kayu Putih, Kec. Oebobo, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:19:00', '2021-10-13 08:19:00'),
(6, 'Kepolisian Daerah Nusa Tenggara Timur Resor Kupang Kota Sektor Oebobo', 'Polsek Oebobo', 2, 'Jl. Kian Kalaki, Bakunase II, Kec. Kota Raja, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:22:00', '2021-10-13 08:22:00'),
(7, 'Kepolisian Daerah Nusa Tenggara Timur Resor Kupang Kota Sektor Kelapa Lima', 'Polsek Kelapa Lima', 2, 'Jalan Ina Boi, Pasir Panjang, Kec. Kota Lama, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:24:00', '2021-10-13 08:24:00'),
(8, 'Kepolisian Daerah Nusa Tenggara Timur Resor Kupang Kota Sektor Maulafa', 'Polsek Maulafa', 2, 'Kolhua, Maulafa, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:24:00', '2021-10-13 08:24:00'),
(9, 'Kepolisian Daerah Nusa Tenggara Timur Resor Kupang Kota Sektor Alak', 'Polsek Alak', 2, 'Jl. Penkase, Alak, Kota Kupang, Nusa Tenggara Timur', 1, '2021-10-13 08:26:00', '2021-10-13 08:26:00'),
(10, 'Kejaksaan Negeri Kota Kupang', 'Kejari Kota Kupang', 1, 'Jl. Palapa, Kel. Oebobo, Kec. Oebobo, Kota Kupang, Nusa Tenggara Timur', 0, '0000-00-00 00:00:00', '2021-10-21 11:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `penahanan`
--

CREATE TABLE `penahanan` (
  `id` int(11) NOT NULL,
  `nomorpenetapan` varchar(40) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  `tglpermohonan` date NOT NULL,
  `nomorpermohonan` text NOT NULL,
  `jenisperkara` text NOT NULL,
  `pasalperkara` text NOT NULL,
  `tglpenahananhabis` date NOT NULL,
  `instansipenahanterakhir` int(11) NOT NULL,
  `perpanjangan` int(11) NOT NULL,
  `pasalrujukan` varchar(40) NOT NULL,
  `idtersangka` int(11) NOT NULL,
  `idinstansi` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penahanan`
--

INSERT INTO `penahanan` (`id`, `nomorpenetapan`, `counter`, `tglpermohonan`, `nomorpermohonan`, `jenisperkara`, `pasalperkara`, `tglpenahananhabis`, `instansipenahanterakhir`, `perpanjangan`, `pasalrujukan`, `idtersangka`, `idinstansi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '70/Pen.Pid/2021/PN Kpg', 70, '2021-10-21', 'B/2070/X/2021/Ditreskrimum', 'Persetubuhan Anak', 'Pasal 76D jo. Pasal 81 Ayat (3) UU RI No. 17 Tahun 2016 tentang Penetapan Peraturan Pemerintah Pengganti UU No. 1 Tahun 2016 tentang Perubahan Kedua Atas UU No. 23 Tahun 2002 tentang Perlindungan Anak', '2022-11-05', 1, 30, '2', 1, 3, 1, '2021-10-22 13:51:00', '2021-10-22 13:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `penyitaan`
--

CREATE TABLE `penyitaan` (
  `id` int(11) NOT NULL,
  `jenispenyitaan` int(1) NOT NULL,
  `nomorpenetapan` varchar(50) DEFAULT NULL,
  `counter` int(11) NOT NULL,
  `tglpermohonan` date NOT NULL,
  `nomorpermohonan` varchar(100) NOT NULL,
  `jenisperkara` text NOT NULL,
  `pasalperkara` text NOT NULL,
  `nomorlaporansita` varchar(100) NOT NULL,
  `tgllaporansita` date NOT NULL,
  `tglbasita` date NOT NULL,
  `idinstansi` int(11) NOT NULL,
  `idtersangka` int(11) NOT NULL,
  `disitadari` varchar(100) NOT NULL,
  `deskripsipenyitaan` text NOT NULL,
  `qrcode` varchar(60) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyitaan`
--

INSERT INTO `penyitaan` (`id`, `jenispenyitaan`, `nomorpenetapan`, `counter`, `tglpermohonan`, `nomorpermohonan`, `jenisperkara`, `pasalperkara`, `nomorlaporansita`, `tgllaporansita`, `tglbasita`, `idinstansi`, `idtersangka`, `disitadari`, `deskripsipenyitaan`, `qrcode`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, '1/Pen.Pid/2021/PN Kpg', 1, '2021-10-01', 'B/1/X/2021/Sektor Oebobo', 'Penggelapan', 'Pasal 373', 'SP-Sita/180/2021/Ditreskrimum', '2020-10-30', '2020-10-30', 6, 1, 'Joan Jett', '1 kwitansi', 'qr-20211024163028.png', 1, '2021-10-24 16:30:00', '2021-10-24 16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tersangka`
--

CREATE TABLE `tersangka` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempatlahir` varchar(50) NOT NULL,
  `tgllahir` date NOT NULL,
  `jeniskelamin` int(11) NOT NULL,
  `suku` varchar(50) NOT NULL,
  `kebangsaan` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `agama` int(11) NOT NULL,
  `pendidikan` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tersangka`
--

INSERT INTO `tersangka` (`id`, `nama`, `tempatlahir`, `tgllahir`, `jeniskelamin`, `suku`, `kebangsaan`, `pekerjaan`, `alamat`, `agama`, `pendidikan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Imanuel Radja Alias Muhammad Harryz Radja', 'Kupang', '1983-12-25', 1, 'Sabu', 'Indonesia', 'Pegawai Honorer', 'RT. 010 / RW. 003, Kel. Nunbaun-Sabu, Kec. Alak, Kota Kupang', 3, 3, 1, '2021-10-22 13:49:00', '2021-10-22 13:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `role`, `username`, `password`, `is_active`, `created_at`, `updated_at`, `image`) VALUES
(1, 'ADMIN', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2021-10-24 12:59:00', '2021-10-24 12:59:00', 'user-20211024125904.jpg'),
(2, 'WARI JUNIATI, S.H., M.H.', 3, 'wari', 'fb83f70d1a5e6092ed65d71474f6e92e0e4e840b', 1, '2021-10-21 05:19:41', '2021-10-21 05:19:41', ''),
(3, 'DJU JOHNSON MIRA MANGNGI, S.H., M.H.', 2, 'johnson', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '2021-10-21 10:33:05', '2021-10-21 10:33:05', ''),
(5, 'ASIDO', 4, 'asido', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '2021-10-24 12:40:00', '2021-10-24 12:40:00', 'user-20211024124040.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penahanan`
--
ALTER TABLE `penahanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyitaan`
--
ALTER TABLE `penyitaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tersangka`
--
ALTER TABLE `tersangka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penahanan`
--
ALTER TABLE `penahanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penyitaan`
--
ALTER TABLE `penyitaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tersangka`
--
ALTER TABLE `tersangka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
