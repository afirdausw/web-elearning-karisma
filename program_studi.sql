/*
 Navicat Premium Data Transfer

 Source Server         : myprime.co.id_3306
 Source Server Type    : MySQL
 Source Server Version : 100135
 Source Host           : myprime.co.id:3306
 Source Schema         : myprimeco_uss

 Target Server Type    : MySQL
 Target Server Version : 100135
 File Encoding         : 65001

 Date: 21/08/2018 09:03:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for program_studi
-- ----------------------------
DROP TABLE IF EXISTS `program_studi`;
CREATE TABLE `program_studi`  (
  `id_prodi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kampus` int(11) NOT NULL,
  `nama_prodi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_prodi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `akreditasi_prodi` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kuota` int(11) NOT NULL,
  `kategori_snmptn` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nilai_minimal_siswa` decimal(11, 2) NOT NULL,
  `indeks_ketetatan` decimal(11, 2) NULL DEFAULT NULL,
  `nilai_rataan` decimal(11, 2) NULL DEFAULT NULL,
  `mpkp` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_jurusan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mpkp1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mpkp2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mpks` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_prodi`) USING BTREE,
  INDEX `id_ptn`(`id_kampus`) USING BTREE,
  CONSTRAINT `program_studi_ibfk_1` FOREIGN KEY (`id_kampus`) REFERENCES `kampus` (`id_kampus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
