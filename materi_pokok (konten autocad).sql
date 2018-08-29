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

 Date: 30/08/2018 04:01:18
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
  PRIMARY KEY (`id_materi_pokok`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of materi_pokok
-- ----------------------------
INSERT INTO `materi_pokok` VALUES (1, 1, 1, 1, 'Apa itu HTML', 'Deskripsi Apa itu HTML', 'html.jpg');
INSERT INTO `materi_pokok` VALUES (2, 1, 0, 2, 'Pengenalan HTML', 'Deskripsi Pengenalan HTML', 'html (1).jpg');
INSERT INTO `materi_pokok` VALUES (3, 1, 0, 3, 'Contoh Dasar HTML', 'Deskripsi Contoh Dasar HTML', 'cover_html_dasar-image.jpg');
INSERT INTO `materi_pokok` VALUES (4, 1, 0, 4, 'HTML 5', 'Deskripsi HTML 5', 'html-bab-1-pengenalan.png');
INSERT INTO `materi_pokok` VALUES (6, 11, 0, 5, 'Pemograman Android Dasar dengan Android Studio', 'Deskripsi Pemograman Android Dasar', '976334_20d6.jpg');
INSERT INTO `materi_pokok` VALUES (8, 13, 0, 1, 'Pengertian RAB', 'Deskripsi RAB', 'A-Day-in-the-Life-of-an-Auto-Body-Estimator2.jpg');
INSERT INTO `materi_pokok` VALUES (9, 13, 0, 8, 'Perhitungan Volume', 'Deskripsi Perhitungan Volume', '2461919_ecd7c139-b4e0-494f-9ade-c68aa2ba3a55.jpg');
INSERT INTO `materi_pokok` VALUES (10, 13, 0, 9, 'AHSP & ASDM', 'Deskripsi AHSP & ASDM', 'blog_sparkEstimator.png');
INSERT INTO `materi_pokok` VALUES (11, 20, 0, 10, 'Pengenalan Corel Draw', '', 'corel-drea.png');
INSERT INTO `materi_pokok` VALUES (12, 20, 0, 11, 'Desain Packaging Ongis Choco', 'Desain packaging menggunakan corel draw', 'choch.jpg');
INSERT INTO `materi_pokok` VALUES (13, 8, 1, 12, 'Pengenalan SketchUp', '', NULL);
INSERT INTO `materi_pokok` VALUES (14, 7, 1, 13, 'Introduction', '', NULL);
INSERT INTO `materi_pokok` VALUES (15, 7, 0, 14, 'Teknik Dasar Menggambar', '', NULL);
INSERT INTO `materi_pokok` VALUES (16, 7, 0, 15, 'Mempercepat Penggambaran', '', NULL);
INSERT INTO `materi_pokok` VALUES (17, 7, 0, 16, 'Modifikasi Object', '', NULL);
INSERT INTO `materi_pokok` VALUES (18, 7, 0, 17, 'Manipulasi Object', '', NULL);
INSERT INTO `materi_pokok` VALUES (19, 7, 0, 18, 'Aneka Perintah Lain', '', NULL);
INSERT INTO `materi_pokok` VALUES (20, 7, 0, 19, 'Menggambar Kurva', '', NULL);
INSERT INTO `materi_pokok` VALUES (21, 7, 0, 20, 'Text & Setting Dimensi ', '', NULL);
INSERT INTO `materi_pokok` VALUES (22, 7, 0, 21, 'Latihan, Skala & Peta', '', NULL);
INSERT INTO `materi_pokok` VALUES (23, 7, 0, 22, 'Denah Bangunan', '', NULL);
INSERT INTO `materi_pokok` VALUES (24, 7, 0, 23, 'Tampak Bangunan', '', NULL);
INSERT INTO `materi_pokok` VALUES (25, 7, 0, 24, 'Plot & Layout Cetak', '', NULL);

SET FOREIGN_KEY_CHECKS = 1;
