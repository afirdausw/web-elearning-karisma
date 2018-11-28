/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100136
 Source Host           : localhost:3306
 Source Schema         : lpihiday_belajar

 Target Server Type    : MySQL
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 28/11/2018 14:27:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tingkatan_kelas` int(4) NOT NULL,
  `alias_kelas` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi_kelas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_kelas` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (1, 'SD', 1, 'Web Design', '<p><em>Ingin belajar membuat desain website interaktif serta memiliki estetika menarik? <br /> Ingin menguasai berbagai perkembangan teknologi desain website paling up to date? <br /> Ingin mengetahui bagaimana membuat desain website terlihat sempurna di setiap gadget?</em></p>\r\n<p>Materi dalam kursus web design akan membantu anda menjadi seorang desainer web professional, Anda akan terampil dalam bidang UI/UX (User Interface/User Experience) dan Mockup+PSD Design interaktif yang dioptimalkan dengan keahlian menggunakan Adobe Illustrator, beserta pengkodean HTML 5, CSS 3, JQuery, hingga membuat Wordpress Company Profile dan Search Engine Optimation (SEO)</p>', '14d01375363b7247537862f33049508f.jpg');
INSERT INTO `kelas` VALUES (2, 'SD', 2, 'Web Master', '<p>Ingin belajar membuat web dinamis yang terintegrasi dengan database MySQL? <br /> Ingin menguasai berbagai perkembangan teknologi website yang paling up to date? <br /> Ingin mengetahui bagaimana membuat e-commerce dengan wordpress dan PHP?</p>\r\n<p>Materi Kursus Web Master akan membantu Anda menjadi seorang Professional Front-End Web Development, Anda akan terampil membuat beberapa project website mulai dari website bertema clean &amp; modern UI, profesional landing page, Flat UI website, website company profile, portal berita, hingga membuat aplikasi website ecommerce dinamis</p>', '8b22dd0dd60a2b1b1e50386240e698ec.jpg');
INSERT INTO `kelas` VALUES (3, 'SD', 3, 'Web Programming', '', '808a19cce8d962ddedfec46bc8df7331.jpg');
INSERT INTO `kelas` VALUES (4, 'SD', 4, 'Wordpress Development', '<p><em>from fully customised courses for multiple devices to rapidly developed and ready-to-go content.</em></p>\r\n<p>Mengajarkan bagaimana membuat aplikasi website dengan tampilan profesional serta memiliki fitur dinamis berbasis Content Management System(CMS). Target Goal dari kursus ini adalah peserta dapat membuat aplikasi website dinamis seperti portal berita, company profile, sistem informasi management, website e-commerce, hingga membuat theme CMS Wordpress mulai dari nol.</p>', 'db63d24dbfc1534e479126264b8fdb69.jpg');
INSERT INTO `kelas` VALUES (5, 'SD', 5, 'Internet Marketing', '', '93523b3020122272c1ea591cf3435acb.jpg');
INSERT INTO `kelas` VALUES (6, 'SD', 6, 'Drafter & Estimator', '', '3d6f656b052e33ce974bc987cc38ef6d.jpg');
INSERT INTO `kelas` VALUES (7, 'SD', 7, 'Arsitektur Digital', '', 'a91140d966e90ed895062d9b958aa601.jpg');
INSERT INTO `kelas` VALUES (8, 'SD', 8, 'Desain Grafis & Multimedia', '<p><em>Ingin belajar membuat grafis yang bersih, terlihat profesional, memberikan pesan? <br /> Ingin meningkatkan penguasaan software pengolah grafis untuk mewujudkan bakat anda? <br />Ingin merintis usaha yang berhubungan dengan desain? </em></p>\r\n<p>Materi desain grafis dan multimedia akan membantu anda untuk menguasai software pengolah grafis yang populer digunakan oleh para desainer saat ini. Materi diambil dari kasus industri dan wirausaha sebenarnya; desain vector, kaos, ID Card, logo, tipografi, layouting, dan masih banyak lainnya.</p>\r\n<p>&nbsp;</p>', 'c5a6ed789ee57650372ff69a0216e93c.jpg');
INSERT INTO `kelas` VALUES (9, 'SD', 9, 'Mobile App', '', '781e0956e4f10aa7c2516dd9a6604af2.jpg');

-- ----------------------------
-- Table structure for mapel
-- ----------------------------
DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel`  (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `mapel` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_kelas` int(255) NULL DEFAULT NULL,
  `id_kelompok_mapel` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_mapel`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
