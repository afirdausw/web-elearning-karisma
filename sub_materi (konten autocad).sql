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

 Date: 30/08/2018 04:00:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sub_materi
-- ----------------------------
DROP TABLE IF EXISTS `sub_materi`;
CREATE TABLE `sub_materi`  (
  `id_sub_materi` int(11) NOT NULL AUTO_INCREMENT,
  `materi_pokok_id` int(11) NOT NULL,
  `urutan_materi` int(11) NOT NULL,
  `urutan_konten` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_sub_materi` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi_sub_materi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_materi` tinyint(1) NOT NULL DEFAULT 1,
  `waktu_soal` int(10) NULL DEFAULT NULL,
  `jenis_akses` int(2) NOT NULL,
  PRIMARY KEY (`id_sub_materi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 131 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sub_materi
-- ----------------------------
INSERT INTO `sub_materi` VALUES (1, 1, 1, '', 'Apa itu HTML?', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (2, 1, 2, '', 'Sejarah HTML', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (3, 1, 3, '', 'HTML dan HTML5', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (4, 1, 4, '', 'Soal HTML', '', 1, NULL, 1);
INSERT INTO `sub_materi` VALUES (5, 2, 1, '', 'Pengenalan HTML', 'Embed from youtube', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (6, 2, 2, '', 'Apa itu tag', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (7, 2, 4, '', 'Apa itu div', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (8, 2, 5, '', 'Soal tentang Tag HTML', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (9, 6, 1, '', 'Pendahuluan', 'Deskrisi Pendahuluan', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (10, 2, 3, '', 'Apa itu Atribut', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (11, 8, 1, '', 'Pengertian Rencana Anggaran Biaya', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (12, 8, 2, '', 'Pendahuluan RAB', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (13, 8, 3, '', 'Soal Pengertian RAB', '', 1, 90, 1);
INSERT INTO `sub_materi` VALUES (17, 9, 1, '', 'Pekerjaan Persiapan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (18, 9, 2, '', 'Pekerjaan Persiapan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (19, 9, 4, '', 'Pekerjaan Struktur', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (20, 9, 5, '', 'Pekerjaan Pondasi', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (21, 9, 6, '', 'Pekerjaan Beton', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (22, 9, 7, '', 'Perhitungan Atap', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (23, 9, 9, '', 'Pekerjaan Finishing', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (24, 9, 10, '', 'Pekerjaan Plafon dan Lantai', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (25, 9, 11, '', 'Pekerjaan Pintu dan Jendela', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (26, 9, 12, '', 'Pekerjaan Pengecatan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (27, 9, 3, '', 'Soal Pekerjaan Persiapan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (28, 9, 8, '', 'Soal Pekerjaan Struktur', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (29, 9, 13, '', 'Soal Pekerjaan Finishing', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (30, 9, 14, '', 'Pekerjaan Mekanikal', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (31, 9, 15, '', 'Pekerjaan Mekanikal', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (32, 9, 16, '', 'Soal Pekerjaan Mekanikal', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (33, 10, 1, '', 'Rekapitulasi dan RAB', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (34, 10, 2, '', 'Analisa Sumberdaya', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (35, 10, 3, '', 'Soal AHSP & ASDM', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (36, 11, 1, '', 'Pengenalan dan sejarah ', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (37, 11, 2, '', 'Keunggulan program Corel Draw', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (38, 12, 1, '', 'Desain Kemasan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (39, 12, 2, '', 'Membuat Deline', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (40, 12, 3, '', 'Membuat Logo', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (41, 12, 4, '', 'Membuat Karakter Singa', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (42, 12, 5, '', 'Line Art Coklat', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (43, 12, 6, '', 'Menata Layout & Final Design', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (44, 12, 7, '', 'Soal tentang Corel Draw', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (45, 14, 1, '', 'Mengenal Autocad', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (46, 14, 2, '', 'Navigasi Autocad 2009', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (47, 14, 3, '', 'Membuka Dan Menyimpan Data', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (48, 14, 4, '', 'Menggambar Garis', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (49, 14, 5, '', 'Mengatur Tampilan Dan Memilih Gambar', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (50, 14, 6, '', 'Memilih Display', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (51, 15, 1, '', 'Sistem Koordinat Absoulte', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (52, 15, 2, '', 'Sistem Koordinat Relative', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (53, 15, 3, '', 'Menggambar Persegi', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (54, 15, 4, '', 'Menggambar Lingkaran', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (55, 15, 5, '', 'Perintah Arc', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (56, 14, 7, '', 'Soal Tes Teori', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (57, 16, 1, '', 'Menggunakan Polar Tracing', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (58, 16, 2, '', 'Fasilitas Object Snap', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (59, 16, 3, '', 'Object Snap Tracking', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (60, 16, 4, '', 'Latihan Polar Koordinat', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (61, 17, 1, '', 'Perintah Move', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (62, 17, 2, '', ' Copy & Paste', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (63, 17, 3, '', 'Merubah Ukuran Dan Stretch', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (64, 17, 4, '', 'Scale', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (65, 17, 5, '', 'Align', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (66, 17, 6, '', 'Array Rectangular', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (67, 17, 7, '', 'Polar Array', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (68, 18, 1, '', 'Offset', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (69, 18, 2, '', 'Mirror', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (70, 18, 3, '', 'Trim Cutting Edges', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (71, 18, 4, '', 'Trim Edges Extend', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (72, 18, 5, '', 'Extend', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (73, 18, 6, '', 'Fillet', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (74, 18, 7, '', 'Chamfer', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (75, 19, 1, '', 'Hatch', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (76, 19, 2, '', 'Polygon Tool', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (77, 19, 3, '', 'List & Boundary', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (78, 19, 4, '', 'Manajemen Layer', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (79, 20, 1, '', 'Polyline', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (80, 20, 2, '', 'Polyline Edit', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (81, 20, 3, '', 'Spline', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (82, 20, 4, '', 'Sketch', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (83, 20, 5, '', 'Modifikasi Sketch', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (84, 21, 1, '', 'Text', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (85, 21, 2, '', 'Multiline Text', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (86, 21, 3, '', 'Memberi Garis Dimensi', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (87, 21, 4, '', 'Garis Dimensi Tambahan & Keterangan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (88, 21, 5, '', 'Dimension Style: Tlines, Symbol & Arror', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (89, 21, 6, '', 'Dimension Style: Text & Primary Units', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (90, 21, 7, '', 'Dimension Style: Fit', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (91, 22, 1, '', 'Latihan Dasar Menggambar Mesin', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (92, 22, 2, '', 'Latihan Gambar Dasar Mesin I', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (93, 22, 3, '', 'Latihan Gambar Dasar Mesin II', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (94, 22, 4, '', 'Roda Gigi', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (95, 22, 5, '', 'Prinsip Pengskalaan & Ploting', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (96, 22, 6, '', 'Tracing Peta', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (97, 23, 1, '', 'Menggambar Dinding', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (98, 23, 2, '', 'Dinding Dengan Multiline', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (99, 23, 3, '', 'Menggambar Pintu', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (100, 23, 4, '', 'Mengatur Pintu', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (101, 23, 5, '', 'Gambar Kusen Dan Jendela', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (102, 23, 6, '', 'Menggambar Teras', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (103, 23, 7, '', 'Memberi Keterangan Text', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (104, 23, 8, '', 'Memberi Dimensi Dan Desain', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (105, 23, 9, '', 'Mengatur Perabot', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (106, 23, 10, '', 'Menata Ruang', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (107, 23, 11, '', 'Merapikan Ruangan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (108, 23, 12, '', 'Mengarsir Ruangan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (109, 24, 1, '', 'Menggambar Teras', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (110, 24, 2, '', 'Pintu', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (111, 24, 3, '', 'Jendela', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (112, 24, 4, '', 'Roster', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (113, 24, 5, '', 'Atap', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (114, 24, 6, '', 'Balok Dan Plat', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (115, 24, 7, '', 'Sun Shading Dan Pagar', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (116, 24, 8, '', 'Memberi Arsiran Dinding', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (117, 24, 9, '', 'Arsiran Pintu, Plat, Teras', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (118, 24, 10, '', 'Menambah Pohon, Mobil Dan Orang', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (119, 25, 1, '', 'Persiapan Plot', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (120, 25, 2, '', 'Pengaturan Skala', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (121, 25, 3, '', 'Scale Fit To Paper', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (122, 25, 4, '', 'Layout Dan View Port', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (123, 25, 5, '', 'Viewport 4 Tampilan', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (124, 25, 6, '', 'Tampilan Presentasi', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (125, 25, 7, '', 'Mengatur Skala Pada Layout', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (126, 25, 8, '', 'Membuat Kepala Gambar', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (127, 25, 9, '', 'Menggunakan Attibute Difinition', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (128, 25, 10, '', 'Edit Attibute', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (129, 25, 11, '', 'Mencetak Dari Layout', '', 1, NULL, 0);
INSERT INTO `sub_materi` VALUES (130, 25, 12, '', 'Tebal Tipis Garis', '', 1, NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;
