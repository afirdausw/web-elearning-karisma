-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2018 at 05:38 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearning_karisma`
--

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas` int(11) NOT NULL,
  `sekolah_id` int(11) NOT NULL,
  `asal_sekolah` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `id_login` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `telepon_ortu` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `poin` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `id_indihome` int(9) NOT NULL,
  `id_affiliasi` int(8) DEFAULT '0',
  `NIS` int(11) DEFAULT NULL,
  `NISN` int(50) DEFAULT NULL,
  `id_premium` int(5) NOT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `kelas`, `sekolah_id`, `asal_sekolah`, `alamat`, `jenis_kelamin`, `id_login`, `email`, `telepon`, `telepon_ortu`, `foto`, `last_login`, `poin`, `timestamp`, `id_indihome`, `id_affiliasi`, `NIS`, `NISN`, `id_premium`) VALUES
(1, 'Siswa 1', 7, 2, '', '', 0, 1, 'siswa1@lpih.com', '0111111111', '0111111111', '', '2018-04-17 00:00:00', 0, '2018-04-05 11:20:01', 0, 0, 1, 1, 0),
(2, 'Siswa 2', 7, 2, '', '', 0, 2, 'siswa2@lpih.com', '0222222', '0222222', '', '2018-04-06 00:00:00', 0, '2018-04-05 11:29:43', 0, 0, 2, 2, 0),
(3, 'Siswa 3', 7, 2, '', '', 0, 3, 'siswa3@lpih.com', '0333333', '0333333', '', '2018-04-06 00:00:00', 0, '2018-04-05 12:46:22', 0, 0, 3, 3, 0),
(4, 'Siswa 4', 7, 2, '', '', 0, 4, 'siswa4@lpih.com', '044444', '04444', '', '2018-04-17 00:00:00', 0, '2018-04-05 12:47:21', 0, 0, 4, 4, 0),
(5, 'Siswa 5', 7, 2, '', '', 0, 5, 'siswa5@lpih.com', '055555', '055555', '', '2018-04-06 00:00:00', 0, '2018-04-05 12:48:13', 0, 0, 5, 5, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
