-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2018 at 02:35 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpihiday_belajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `instruktur`
--

CREATE TABLE `instruktur` (
  `id_instruktur` int(11) NOT NULL,
  `nama_instruktur` varchar(50) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `instruktur`
--

INSERT INTO `instruktur` (`id_instruktur`, `nama_instruktur`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telepon`, `email`, `foto`) VALUES
(1, 'Muhammad Nur Alfiyan', 1, 'Malang', '1998-11-30', 'Jl. Bantaran', '081233233233', 'rendy@email.com', '7db7569711ebd9b3f527c553ec37c7b6.jpg'),
(2, 'Rendy Yofana', 1, 'Malang', '1998-07-15', 'Jl. Bantaran', '081233233233', 'rendy@email.com', '68f9321b2c8497b653450e7bb74a02bf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `instruktur_mapel`
--

CREATE TABLE `instruktur_mapel` (
  `id_instruktur_mapel` int(11) NOT NULL,
  `id_instruktur` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `instruktur_mapel`
--

INSERT INTO `instruktur_mapel` (`id_instruktur_mapel`, `id_instruktur`, `id_mapel`) VALUES
(17, 2, 1),
(18, 1, 1),
(19, 1, 2),
(20, 1, 3),
(21, 1, 4),
(22, 1, 5),
(23, 1, 6),
(24, 1, 7),
(25, 1, 8),
(26, 1, 9),
(27, 1, 10),
(28, 1, 11),
(29, 1, 12),
(30, 1, 13),
(31, 1, 20),
(32, 1, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`id_instruktur`) USING BTREE;

--
-- Indexes for table `instruktur_mapel`
--
ALTER TABLE `instruktur_mapel`
  ADD PRIMARY KEY (`id_instruktur_mapel`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instruktur`
--
ALTER TABLE `instruktur`
  MODIFY `id_instruktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `instruktur_mapel`
--
ALTER TABLE `instruktur_mapel`
  MODIFY `id_instruktur_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
