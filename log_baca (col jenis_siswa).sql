-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2018 at 10:04 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lpihiday_belajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_baca`
--

CREATE TABLE IF NOT EXISTS `log_baca` (
  `id_log_baca` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) DEFAULT NULL,
  `jenis_siswa` varchar(10) DEFAULT 'pretest',
  `sub_materi_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log_baca`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=7 ;

--
-- Dumping data for table `log_baca`
--

INSERT INTO `log_baca` (`id_log_baca`, `id_siswa`, `jenis_siswa`, `sub_materi_id`, `created_at`) VALUES
(1, 1, 'siswa', 2, '2018-08-31 14:54:06'),
(2, 1, 'siswa', 1, '2018-08-31 15:01:24'),
(3, 1, 'siswa', 3, '2018-08-31 14:54:24'),
(4, 1, 'siswa', 4, '2018-08-31 15:01:51'),
(5, 1, 'siswa', 6, '2018-08-31 15:01:32'),
(6, 1, 'siswa', 5, '2018-08-31 15:01:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
