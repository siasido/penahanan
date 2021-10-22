-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 07:42 AM
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
-- Table structure for table `penetapan`
--

CREATE TABLE `penetapan` (
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
(1, 'Super Admin', 1, 'asido', '6b375695551b0d28006ac41a34796f7d06152939', 1, '2021-10-13 05:05:00', '2021-10-13 05:05:00', 'user-20210807130817.jpg'),
(2, 'WARI JUNIATI, S.H., M.H.', 3, 'wari', 'fb83f70d1a5e6092ed65d71474f6e92e0e4e840b', 1, '2021-10-21 05:19:41', '2021-10-21 05:19:41', ''),
(3, 'DJU JOHNSON MIRA MANGNGI, S.H., M.H.', 2, 'johnson', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '2021-10-21 10:33:05', '2021-10-21 10:33:05', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penetapan`
--
ALTER TABLE `penetapan`
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
-- AUTO_INCREMENT for table `penetapan`
--
ALTER TABLE `penetapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tersangka`
--
ALTER TABLE `tersangka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
