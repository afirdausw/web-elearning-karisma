-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2016 at 10:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prime_generation`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
`id_jawaban` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `jawab_1` text NOT NULL,
  `jawab_2` text NOT NULL,
  `jawab_3` text NOT NULL,
  `jawab_4` text NOT NULL,
  `jawab_5` text NOT NULL,
  `kunci_jawaban` varchar(5) NOT NULL,
  `pembahasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`id_kelas` int(11) NOT NULL,
  `jenjang` varchar(100) NOT NULL,
  `tingkatan_kelas` int(4) NOT NULL,
  `alias_kelas` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `jenjang`, `tingkatan_kelas`, `alias_kelas`) VALUES
(1, 'SD', 1, 'SD kelas 1'),
(2, 'SD', 2, 'SD kelas 2'),
(3, 'SMP', 9, 'SMP kelas 9'),
(4, 'SD', 4, 'SD kelas 4');

-- --------------------------------------------------------

--
-- Table structure for table `konten_materi`
--

CREATE TABLE IF NOT EXISTS `konten_materi` (
`id_konten` int(11) NOT NULL,
  `sub_materi_id` int(11) NOT NULL,
  `isi_materi` text NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `gambar_materi` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten_materi`
--

INSERT INTO `konten_materi` (`id_konten`, `sub_materi_id`, `isi_materi`, `kategori`, `tanggal`, `waktu`, `gambar_materi`) VALUES
(1, 1, 'https://www.youtube.com/watch?v=j_OyHUqIIOU', '2', '2016-07-20', '22:31:00', '29136571_p6_master1200.jpg'),
(5, 5, 'https://www.youtube.com/watch?v=j_OyHUqIIOU', '2', '2016-07-31', '20:42:00', '42455151_p0.jpg'),
(6, 6, '<p>Mapem 6 joss Tenan</p>\r\n<p>https://www.youtube.com/watch?v=1qx6Y120Hmk&lt;iframe src="https://www.youtube.com/embed/1qx6Y120Hmk?rel=0&hd=0" width="640" height="385" class="embed-responsive-item"&gt; &lt;/iframe&gt;</p>', '1', '2016-07-18', '11:15:00', '42455151_p0.jpg'),
(7, 7, '<p>asfafas as das d 7</p>', '1', '2016-07-19', '13:37:00', '42455151_p0.jpg'),
(9, 9, '<p>Ini Video Loh ....</p>', '1', '2016-07-20', '22:03:00', ''),
(10, 18, '<p>asasf asf asf asf a fas </p>', '1', '2016-07-24', '13:48:00', ''),
(11, 19, '<p>asdad</p>', '1', '2016-07-28', '13:01:00', ''),
(12, 20, '<p>'' asd asd a '' asd a "Quote" </p>\r\n<p>\\][;''/``</p>', '1', '2016-07-28', '13:04:00', ''),
(13, 21, 'https://www.youtube.com/watch?v=j_OyHUqIIOU', '2', '2016-07-31', '11:01:00', ''),
(14, 23, '', '2', '2016-07-31', '18:47:00', ''),
(15, 24, '<p>asda asd as</p>', '1', '2016-07-31', '19:57:00', ''),
(16, 25, 'https://www.youtube.com/watch?v=j_OyHUqIIOU', '2', '2016-07-31', '20:07:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('administrator', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
`id_mapel` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `kelas_id`, `nama_mapel`) VALUES
(1, 3, 'Matematika'),
(2, 2, 'Bahasa Inggris'),
(3, 1, 'Bahasa Indonesia'),
(5, 1, 'Biologi'),
(6, 3, 'Fisika'),
(7, 4, 'Bahasa Jawa');

-- --------------------------------------------------------

--
-- Table structure for table `materi_pokok`
--

CREATE TABLE IF NOT EXISTS `materi_pokok` (
`id_materi_pokok` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `nama_materi_pokok` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi_pokok`
--

INSERT INTO `materi_pokok` (`id_materi_pokok`, `mapel_id`, `nama_materi_pokok`) VALUES
(1, 2, 'English is Cool'),
(3, 3, 'Materi 1'),
(4, 2, 'English is Good'),
(5, 7, 'Krama Inggil');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
`id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas` int(11) NOT NULL,
  `asal_sekolah` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `kelas`, `asal_sekolah`) VALUES
(1, 'Alissa A.', 1, 'SD Negeri 1 Purwantoro, Malang'),
(2, 'Amanda', 3, 'SMP Negeri 5 Surabaya'),
(3, 'Benny', 1, 'SD Negeri 4 Malang');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
`id_soal` int(11) NOT NULL,
  `sub_materi_id` int(11) NOT NULL,
  `isi_soal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_materi`
--

CREATE TABLE IF NOT EXISTS `sub_materi` (
`id_sub_materi` int(11) NOT NULL,
  `materi_pokok_id` int(11) NOT NULL,
  `nama_sub_materi` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_materi`
--

INSERT INTO `sub_materi` (`id_sub_materi`, `materi_pokok_id`, `nama_sub_materi`) VALUES
(1, 1, 'Sub - Materi 1'),
(5, 4, 'SubMateri 5'),
(6, 5, 'SubMateri 6X'),
(7, 5, 'SubMateri 7'),
(9, 7, 'SubMateri 9'),
(12, 1, 'SubMateri 12'),
(14, 5, 'SubMateri 14'),
(15, 2, 'SubMateri 15'),
(16, 1, 'SubMateri 16'),
(17, 1, 'Sub - Materi 17'),
(18, 3, 'Test judul'),
(19, 4, 'asdad'),
(20, 3, 'sfasf'),
(21, 3, 'coba konten video 1'),
(22, 3, 'asdasdasd2'),
(23, 3, 'asdasdasd2'),
(24, 5, 'z'),
(25, 5, 'z2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
 ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `konten_materi`
--
ALTER TABLE `konten_materi`
 ADD PRIMARY KEY (`id_konten`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
 ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `materi_pokok`
--
ALTER TABLE `materi_pokok`
 ADD PRIMARY KEY (`id_materi_pokok`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
 ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `sub_materi`
--
ALTER TABLE `sub_materi`
 ADD PRIMARY KEY (`id_sub_materi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `konten_materi`
--
ALTER TABLE `konten_materi`
MODIFY `id_konten` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `materi_pokok`
--
ALTER TABLE `materi_pokok`
MODIFY `id_materi_pokok` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_materi`
--
ALTER TABLE `sub_materi`
MODIFY `id_sub_materi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
