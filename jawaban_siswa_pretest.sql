/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50621
 Source Host           : localhost:3306
 Source Schema         : elearning_karisma

 Target Server Type    : MySQL
 Target Server Version : 50621
 File Encoding         : 65001

 Date: 20/08/2018 14:33:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jawaban_siswa_pretest
-- ----------------------------
DROP TABLE IF EXISTS `jawaban_siswa_pretest`;
CREATE TABLE `jawaban_siswa_pretest`  (
  `id_jawaban_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `id_log_ujian` int(11) NULL DEFAULT NULL,
  `id_siswa` int(11) NULL DEFAULT NULL,
  `soal_id` int(11) NULL DEFAULT NULL,
  `sub_materi_id` int(11) NULL DEFAULT NULL,
  `jawaban` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_jawaban_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
