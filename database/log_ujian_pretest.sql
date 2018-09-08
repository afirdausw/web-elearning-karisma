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

 Date: 20/08/2018 14:32:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for log_ujian_pretest
-- ----------------------------
DROP TABLE IF EXISTS `log_ujian_pretest`;
CREATE TABLE `log_ujian_pretest`  (
  `id_log_ujian` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NULL DEFAULT NULL,
  `sub_materi_id` int(11) NULL DEFAULT NULL,
  `start` datetime(0) NULL DEFAULT NULL,
  `finish` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `finish_ujian` datetime(0) NULL DEFAULT NULL,
  `nilai` float(11, 2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_log_ujian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
