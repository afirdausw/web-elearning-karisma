/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100125
 Source Host           : localhost:3306
 Source Schema         : lpihiday_belajar

 Target Server Type    : MySQL
 Target Server Version : 100125
 File Encoding         : 65001

 Date: 08/09/2018 09:46:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for materi_pokok
-- ----------------------------
DROP TABLE IF EXISTS `materi_pokok`;
CREATE TABLE `materi_pokok`  (
  `id_materi_pokok` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `pretest_status` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `nama_materi_pokok` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi_materi_pokok` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_materi_pokok` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `materi_status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_materi_pokok`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of materi_pokok
-- ----------------------------
INSERT INTO `materi_pokok` VALUES (1, 1, 1, 1, 'Apa itu HTML', 'Deskripsi Apa itu HTML', 'html.jpg', '');
INSERT INTO `materi_pokok` VALUES (2, 1, 0, 2, 'Pengenalan HTML', 'Deskripsi Pengenalan HTML', 'html (1).jpg', '');
INSERT INTO `materi_pokok` VALUES (3, 1, 0, 3, 'Contoh Dasar HTML', 'Deskripsi Contoh Dasar HTML', 'cover_html_dasar-image.jpg', '');
INSERT INTO `materi_pokok` VALUES (4, 1, 0, 4, 'HTML 5', 'Deskripsi HTML 5', 'html-bab-1-pengenalan.png', '');
INSERT INTO `materi_pokok` VALUES (6, 11, 0, 5, 'Pemograman Android Dasar dengan Android Studio', 'Deskripsi Pemograman Android Dasar', '976334_20d6.jpg', '');
INSERT INTO `materi_pokok` VALUES (8, 13, 0, 1, 'Pengertian RAB', 'Deskripsi RAB', 'A-Day-in-the-Life-of-an-Auto-Body-Estimator2.jpg', '');
INSERT INTO `materi_pokok` VALUES (9, 13, 0, 8, 'Perhitungan Volume', 'Deskripsi Perhitungan Volume', '2461919_ecd7c139-b4e0-494f-9ade-c68aa2ba3a55.jpg', '');
INSERT INTO `materi_pokok` VALUES (10, 13, 0, 9, 'AHSP & ASDM', 'Deskripsi AHSP & ASDM', 'blog_sparkEstimator.png', '');
INSERT INTO `materi_pokok` VALUES (11, 20, 0, 10, 'Pengenalan Corel Draw', '', 'corel-drea.png', '');
INSERT INTO `materi_pokok` VALUES (12, 20, 0, 11, 'Desain Packaging Ongis Choco', 'Desain packaging menggunakan corel draw', 'choch.jpg', '');
INSERT INTO `materi_pokok` VALUES (13, 8, 1, 12, 'Pengenalan SketchUp', '', NULL, '');
INSERT INTO `materi_pokok` VALUES (14, 7, 1, 13, 'Introduction', '', NULL, 'free');
INSERT INTO `materi_pokok` VALUES (15, 7, 1, 14, 'Teknik Dasar Menggambar', '', NULL, 'free');
INSERT INTO `materi_pokok` VALUES (16, 7, 0, 15, 'Mempercepat Penggambaran', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (17, 7, 0, 16, 'Modifikasi Object', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (18, 7, 0, 17, 'Manipulasi Object', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (19, 7, 0, 18, 'Aneka Perintah Lain', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (20, 7, 0, 19, 'Menggambar Kurva', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (21, 7, 0, 20, 'Text & Setting Dimensi ', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (22, 7, 0, 21, 'Latihan, Skala & Peta', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (23, 7, 0, 22, 'Denah Bangunan', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (24, 7, 0, 23, 'Tampak Bangunan', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (25, 7, 0, 24, 'Plot & Layout Cetak', '', NULL, 'buy');
INSERT INTO `materi_pokok` VALUES (26, 7, 1, 1, 'Pretest', '', NULL, 'pre');

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa`  (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `tempat_lahir` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `poin` int(11) NOT NULL,
  `timestamp` datetime(0) NOT NULL,
  `last_login` datetime(0) NOT NULL,
  `id_login` int(11) NOT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES (1, 'Siswa 1', 1, 'Malang', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0111111', 'siswa1@elearning.com', '', 0, '2018-04-05 11:20:01', '2018-04-17 00:00:00', 1);
INSERT INTO `siswa` VALUES (2, 'Siswa 2', 1, 'Surabaya', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0222222', 'siswa2@elearning.com', '', 0, '2018-04-05 11:29:43', '2018-04-06 00:00:00', 2);
INSERT INTO `siswa` VALUES (3, 'Siswa 3', 1, 'Gresik', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0333333', 'siswa3@elearning.com', '', 0, '2018-04-05 12:46:22', '2018-04-06 00:00:00', 3);
INSERT INTO `siswa` VALUES (4, 'Siswa 4', 1, 'Lamongan', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0444444', 'siswa4@elearning.com', '', 0, '2018-04-05 12:47:21', '2018-04-17 00:00:00', 4);
INSERT INTO `siswa` VALUES (5, 'Siswa 5', 2, 'Jember', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0555555', 'siswa5@elearning.com', '', 0, '2018-04-05 12:48:13', '2018-04-06 00:00:00', 5);

-- ----------------------------
-- Table structure for testimoni
-- ----------------------------
DROP TABLE IF EXISTS `testimoni`;
CREATE TABLE `testimoni`  (
  `id_testimoni` int(4) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(4) NULL DEFAULT NULL,
  `waktu` timestamp(0) NULL DEFAULT NULL,
  `testimoni` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_testimoni`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
