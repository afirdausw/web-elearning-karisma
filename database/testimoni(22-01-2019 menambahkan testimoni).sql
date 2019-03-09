-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22 Jan 2019 pada 08.49
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` int(4) NOT NULL,
  `id_siswa` int(4) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  `testimoni` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id_testimoni`, `id_siswa`, `waktu`, `testimoni`) VALUES
(1, 1, '2018-09-20 05:57:42', 'Belajar dari dasar sehingga cocok bagi pemula, Pemahaman maupun penjelasan dari instrukturnya mulai dasar - dasarnya materi mudah di pahami.\n'),
(2, 2, '2019-01-15 05:30:05', 'Untuk teman - teman yang tak punya background seputar IT, Kelas - kelas disini cocok untuk belajar, karena materinya jelas sekali. Dari Zero ke Hero pokoknya'),
(3, 3, '2019-01-15 04:20:04', 'Saya lulusan S1 dan masih ingin bergabung di Karisma Academy. Kenapa? karena saya ingin mencari ilmu yang lebih banyak, karena disini cocok juga bagi yang sudah mendalami IT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
