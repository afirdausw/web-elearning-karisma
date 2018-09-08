-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2018 at 11:38 AM
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
-- Table structure for table `sub_materi`
--

CREATE TABLE IF NOT EXISTS `sub_materi` (
  `id_sub_materi` int(11) NOT NULL AUTO_INCREMENT,
  `materi_pokok_id` int(11) NOT NULL,
  `urutan_materi` int(11) NOT NULL,
  `urutan_konten` varchar(100) NOT NULL,
  `nama_sub_materi` varchar(200) NOT NULL,
  `deskripsi_sub_materi` text NOT NULL,
  `status_materi` tinyint(1) NOT NULL DEFAULT '1',
  `waktu_soal` float DEFAULT '0.1',
  `jenis_akses` int(2) NOT NULL,
  PRIMARY KEY (`id_sub_materi`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=57 ;

--
-- Dumping data for table `sub_materi`
--

INSERT INTO `sub_materi` (`id_sub_materi`, `materi_pokok_id`, `urutan_materi`, `urutan_konten`, `nama_sub_materi`, `deskripsi_sub_materi`, `status_materi`, `waktu_soal`, `jenis_akses`) VALUES
(1, 1, 1, '', 'Apa itu HTML?', '', 1, NULL, 0),
(2, 1, 2, '', 'Sejarah HTML', '', 1, NULL, 0),
(3, 1, 3, '', 'HTML dan HTML5', '', 1, NULL, 0),
(4, 1, 4, '', 'Soal HTML', '', 1, 0, 1),
(5, 2, 1, '', 'Pengenalan HTML', 'Embed from youtube', 1, NULL, 0),
(6, 2, 2, '', 'Apa itu tag', '', 1, NULL, 0),
(7, 2, 4, '', 'Apa itu div', '', 1, NULL, 0),
(8, 2, 5, '', 'Soal tentang Tag HTML', '', 1, NULL, 0),
(9, 6, 1, '', 'Pendahuluan', 'Deskrisi Pendahuluan', 1, NULL, 0),
(10, 2, 3, '', 'Apa itu Atribut', '', 1, NULL, 0),
(11, 8, 1, '', 'Pengertian Rencana Anggaran Biaya', '', 1, NULL, 0),
(12, 8, 2, '', 'Pendahuluan RAB', '', 1, NULL, 0),
(13, 8, 3, '', 'Soal Pengertian RAB', '', 1, 90, 1),
(17, 9, 1, '', 'Pekerjaan Persiapan', '', 1, NULL, 0),
(18, 9, 2, '', 'Pekerjaan Persiapan', '', 1, NULL, 0),
(19, 9, 4, '', 'Pekerjaan Struktur', '', 1, NULL, 0),
(20, 9, 5, '', 'Pekerjaan Pondasi', '', 1, NULL, 0),
(21, 9, 6, '', 'Pekerjaan Beton', '', 1, NULL, 0),
(22, 9, 7, '', 'Perhitungan Atap', '', 1, NULL, 0),
(23, 9, 9, '', 'Pekerjaan Finishing', '', 1, NULL, 0),
(24, 9, 10, '', 'Pekerjaan Plafon dan Lantai', '', 1, NULL, 0),
(25, 9, 11, '', 'Pekerjaan Pintu dan Jendela', '', 1, NULL, 0),
(26, 9, 12, '', 'Pekerjaan Pengecatan', '', 1, NULL, 0),
(27, 9, 3, '', 'Soal Pekerjaan Persiapan', '', 1, NULL, 0),
(28, 9, 8, '', 'Soal Pekerjaan Struktur', '', 1, NULL, 0),
(29, 9, 13, '', 'Soal Pekerjaan Finishing', '', 1, NULL, 0),
(30, 9, 14, '', 'Pekerjaan Mekanikal', '', 1, NULL, 0),
(31, 9, 15, '', 'Pekerjaan Mekanikal', '', 1, NULL, 0),
(32, 9, 16, '', 'Soal Pekerjaan Mekanikal', '', 1, NULL, 0),
(33, 10, 1, '', 'Rekapitulasi dan RAB', '', 1, NULL, 0),
(34, 10, 2, '', 'Analisa Sumberdaya', '', 1, NULL, 0),
(35, 10, 3, '', 'Soal AHSP & ASDM', '', 1, NULL, 0),
(36, 11, 1, '', 'Pengenalan dan sejarah ', '', 1, NULL, 0),
(37, 11, 2, '', 'Keunggulan program Corel Draw', '', 1, NULL, 0),
(38, 12, 1, '', 'Desain Kemasan', '', 1, NULL, 0),
(39, 12, 2, '', 'Membuat Deline', '', 1, NULL, 0),
(40, 12, 3, '', 'Membuat Logo', '', 1, NULL, 0),
(41, 12, 4, '', 'Membuat Karakter Singa', '', 1, NULL, 0),
(42, 12, 5, '', 'Line Art Coklat', '', 1, NULL, 0),
(43, 12, 6, '', 'Menata Layout & Final Design', '', 1, NULL, 0),
(44, 12, 7, '', 'Soal tentang Corel Draw', '', 1, NULL, 0),
(45, 14, 1, '', 'Mengenal Autocad', '', 1, NULL, 0),
(46, 14, 2, '', 'Navigasi Autocad 2009', '', 1, NULL, 0),
(47, 14, 3, '', 'Membuka Dan Menyimpan Data', '', 1, NULL, 0),
(48, 14, 4, '', 'Menggambar Garis', '', 1, NULL, 0),
(49, 14, 5, '', 'Mengatur Tampilan Dan Memilih Gambar', '', 1, NULL, 0),
(50, 14, 6, '', 'Memilih Display', '', 1, NULL, 0),
(51, 15, 1, '', 'Sistem Koordinat Absoulte', '', 1, NULL, 0),
(52, 15, 2, '', 'Sistem Koordinat Relative', '', 1, NULL, 0),
(53, 15, 3, '', 'Menggambar Persegi', '', 1, NULL, 0),
(54, 15, 4, '', 'Menggambar Lingkaran', '', 1, NULL, 0),
(55, 15, 5, '', 'Perintah Arc', '', 1, NULL, 0),
(56, 14, 7, '', 'Soal Tes Teori', '', 1, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
