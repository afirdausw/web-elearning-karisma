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

 Date: 17/09/2018 12:49:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
  `id_premium` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES (1, 'Siswa 1', 1, 'Malang', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0111111', 'siswa1@elearning.com', '', 0, '2018-04-05 11:20:01', '2018-04-17 00:00:00', 1, NULL);
INSERT INTO `siswa` VALUES (2, 'Siswa 2', 1, 'Surabaya', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0222222', 'siswa2@elearning.com', '', 0, '2018-04-05 11:29:43', '2018-04-06 00:00:00', 2, NULL);
INSERT INTO `siswa` VALUES (3, 'Siswa 3', 1, 'Gresik', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0333333', 'siswa3@elearning.com', '', 0, '2018-04-05 12:46:22', '2018-04-06 00:00:00', 3, NULL);
INSERT INTO `siswa` VALUES (4, 'Siswa 4', 1, 'Lamongan', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0444444', 'siswa4@elearning.com', '', 0, '2018-04-05 12:47:21', '2018-04-17 00:00:00', 4, NULL);
INSERT INTO `siswa` VALUES (5, 'Siswa 5', 2, 'Jember', '0000-00-00', 'Mahasiswa', 'Jl. Watu Gong No.18 Ketawanggede', '0555555', 'siswa5@elearning.com', '', 0, '2018-04-05 12:48:13', '2018-04-06 00:00:00', 5, NULL);

SET FOREIGN_KEY_CHECKS = 1;
