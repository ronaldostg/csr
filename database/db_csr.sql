/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3308
 Source Schema         : db_csr

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 14/07/2023 15:09:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dana_alokasi
-- ----------------------------
DROP TABLE IF EXISTS `dana_alokasi`;
CREATE TABLE `dana_alokasi`  (
  `id_alokasi` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_unit` bigint(20) NOT NULL,
  `tahun` year NOT NULL,
  `dana_alokasi` bigint(20) NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_alokasi`) USING BTREE,
  INDEX `id_unit`(`id_unit`) USING BTREE,
  CONSTRAINT `dana_alokasi_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `t_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dana_alokasi
-- ----------------------------
INSERT INTO `dana_alokasi` VALUES (3, 798, 2023, 1300000000, '2013-03-23 07:49:32.000000', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (12, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (13, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (14, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (15, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (16, '2022_09_20_070727_creat_tb_unit', 2);
INSERT INTO `migrations` VALUES (17, '2022_09_20_070752_creat_tb_status', 3);
INSERT INTO `migrations` VALUES (18, '2022_09_26_070010_create_t_validasi', 4);
INSERT INTO `migrations` VALUES (19, '2022_09_29_180703_create_t_ba-pi', 5);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for t_ba_pi
-- ----------------------------
DROP TABLE IF EXISTS `t_ba_pi`;
CREATE TABLE `t_ba_pi`  (
  `id_bapi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bank` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_bank` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_bank` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bapi_unit` bigint(20) NOT NULL,
  `jenis_bantuan` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `saksi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_val_master` bigint(20) NOT NULL,
  `file_ba` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_pi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `tahun` int(4) NULL DEFAULT NULL,
  `nik_pihak_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `npwp_pihak_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `selaku_pihak_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_bapi`) USING BTREE,
  INDEX `id_ba-pi_unit`(`id_bapi_unit`) USING BTREE,
  INDEX `id_val_master`(`id_val_master`) USING BTREE,
  CONSTRAINT `t_ba_pi_ibfk_2` FOREIGN KEY (`id_val_master`) REFERENCES `t_master` (`id_master`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_ba_pi_ibfk_3` FOREIGN KEY (`id_bapi_unit`) REFERENCES `t_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_ba_pi
-- ----------------------------
INSERT INTO `t_ba_pi` VALUES (1, 'Dr. SULAIMAN Silalahi', 'Rektor kampus USU', 'Jalan Dr. Masyur', 'Ronaldo', 'TKAD Admin', 'jalan pemuda', 798, 'dana', 'julian,dekan kampus,anto,kepala prodi teknologi informasi', 75, NULL, NULL, '2023-03-14 10:37:21', '2023-03-14 10:37:21', 2023, '1207261210990005', '346152621761727821', 'Penerima Manfaat');

-- ----------------------------
-- Table structure for t_hist_alokasi
-- ----------------------------
DROP TABLE IF EXISTS `t_hist_alokasi`;
CREATE TABLE `t_hist_alokasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nominal` double(40, 0) NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `id_unit_master` int(11) NULL DEFAULT NULL,
  `tahun` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hist_alokasi
-- ----------------------------

-- ----------------------------
-- Table structure for t_log
-- ----------------------------
DROP TABLE IF EXISTS `t_log`;
CREATE TABLE `t_log`  (
  `id_log` bigint(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `master_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `username` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_log
-- ----------------------------
INSERT INTO `t_log` VALUES (1, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-03-13 18:33:56', '2870', '2023-03-13 18:33:56');
INSERT INTO `t_log` VALUES (2, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Login Berhasil\",\"data\":[{\"id_adm_user\":\"2265\",\"nama_login\":\"2870\",\"password\":\"7af4e97911aaf794d0d4724e31888c6b\",\"id_peg\":\"3222\",\"nrik\":\"2870.20111985.01042013\",\"nama\":\"Denovriyanto Harefa\",\"tgl_lhr\":\"1985-11-20\",\"no_ktp\":\"1204012011850006\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2013-04-01\",\"tgl_msk\":\"2012-07-01\",\"kelamin\":\"L\",\"no_hp\":\"085372803253\",\"user_email\":\"denovriyantoharefa@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"9\",\"id_hist_uker\":\"56834\",\"id_unit_kerja\":\"665\",\"tmt_unit_kerja\":\"2019-07-01\",\"no_sk_unit_kerja\":\"172\\/Dir\\/DSDM-PSDM\\/SK\\/2019\",\"tgl_sk_unit_kerja\":\"2019-06-26\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Divisi Teknologi Informasi\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39528\",\"id_jabatan\":\"6339\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5669\",\"id_hist_unit_kerja\":\"56834\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"Programmer Officer\",\"id_hist_pangkat\":\"23516\",\"id_pangkat\":\"30\",\"tmt_pangkat\":\"2021-03-22\",\"no_sk_pangkat\":\"050\\/DIR\\/DSDM-TK\\/SK\\/2021\",\"tgl_sk_pangkat\":\"2021-03-22\",\"id_hist_jabatan\":\"35054\",\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G5\",\"tk_grade\":\"21\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"665\",\"unit_penempatan\":\"Divisi Teknologi Informasi\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"1\",\"jabunit\":\"665\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"e6675bbd3137f6bf\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Mahdian Putra Lubis\",\"id_supervisi\":\"u1328\"}]}', '2023-03-13 18:34:53', '2870', '2023-03-13 18:34:53');
INSERT INTO `t_log` VALUES (3, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-03-13 18:36:29', '2870', '2023-03-13 18:36:29');
INSERT INTO `t_log` VALUES (4, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Login Berhasil\",\"data\":[{\"id_adm_user\":\"2265\",\"nama_login\":\"2870\",\"password\":\"7af4e97911aaf794d0d4724e31888c6b\",\"id_peg\":\"3222\",\"nrik\":\"2870.20111985.01042013\",\"nama\":\"Denovriyanto Harefa\",\"tgl_lhr\":\"1985-11-20\",\"no_ktp\":\"1204012011850006\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2013-04-01\",\"tgl_msk\":\"2012-07-01\",\"kelamin\":\"L\",\"no_hp\":\"085372803253\",\"user_email\":\"denovriyantoharefa@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"9\",\"id_hist_uker\":\"56834\",\"id_unit_kerja\":\"665\",\"tmt_unit_kerja\":\"2019-07-01\",\"no_sk_unit_kerja\":\"172\\/Dir\\/DSDM-PSDM\\/SK\\/2019\",\"tgl_sk_unit_kerja\":\"2019-06-26\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Divisi Teknologi Informasi\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39528\",\"id_jabatan\":\"6339\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5669\",\"id_hist_unit_kerja\":\"56834\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"Programmer Officer\",\"id_hist_pangkat\":\"23516\",\"id_pangkat\":\"30\",\"tmt_pangkat\":\"2021-03-22\",\"no_sk_pangkat\":\"050\\/DIR\\/DSDM-TK\\/SK\\/2021\",\"tgl_sk_pangkat\":\"2021-03-22\",\"id_hist_jabatan\":\"35054\",\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G5\",\"tk_grade\":\"21\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"665\",\"unit_penempatan\":\"Divisi Teknologi Informasi\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"1\",\"jabunit\":\"665\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"e6675bbd3137f6bf\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Mahdian Putra Lubis\",\"id_supervisi\":\"u1328\"}]}', '2023-03-13 19:32:54', '2870', '2023-03-13 19:32:54');
INSERT INTO `t_log` VALUES (5, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-03-13 19:32:59', '2870', '2023-03-13 19:32:59');
INSERT INTO `t_log` VALUES (6, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Login Berhasil\",\"data\":[{\"id_adm_user\":\"2265\",\"nama_login\":\"2870\",\"password\":\"7af4e97911aaf794d0d4724e31888c6b\",\"id_peg\":\"3222\",\"nrik\":\"2870.20111985.01042013\",\"nama\":\"Denovriyanto Harefa\",\"tgl_lhr\":\"1985-11-20\",\"no_ktp\":\"1204012011850006\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2013-04-01\",\"tgl_msk\":\"2012-07-01\",\"kelamin\":\"L\",\"no_hp\":\"085372803253\",\"user_email\":\"denovriyantoharefa@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"9\",\"id_hist_uker\":\"56834\",\"id_unit_kerja\":\"665\",\"tmt_unit_kerja\":\"2019-07-01\",\"no_sk_unit_kerja\":\"172\\/Dir\\/DSDM-PSDM\\/SK\\/2019\",\"tgl_sk_unit_kerja\":\"2019-06-26\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Divisi Teknologi Informasi\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39528\",\"id_jabatan\":\"6339\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5669\",\"id_hist_unit_kerja\":\"56834\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"Programmer Officer\",\"id_hist_pangkat\":\"23516\",\"id_pangkat\":\"30\",\"tmt_pangkat\":\"2021-03-22\",\"no_sk_pangkat\":\"050\\/DIR\\/DSDM-TK\\/SK\\/2021\",\"tgl_sk_pangkat\":\"2021-03-22\",\"id_hist_jabatan\":\"35054\",\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G5\",\"tk_grade\":\"21\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"665\",\"unit_penempatan\":\"Divisi Teknologi Informasi\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"1\",\"jabunit\":\"665\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"e6675bbd3137f6bf\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Mahdian Putra Lubis\",\"id_supervisi\":\"u1328\"}]}', '2023-03-13 19:36:17', '2870', '2023-03-13 19:36:17');
INSERT INTO `t_log` VALUES (7, 'input permohonan', '{\"_token\":\"2OTMAMUlzxZZTkaOuEFZaSQJohQUyrNZuxnFjvb2\",\"id_unit_master\":\"798\",\"no_surat_edoc\":\"123\",\"nama_kegiatan\":\"Pemberian Beasiswa kepada mahasiswa berprestasi\",\"lokasi_kegiatan\":\"Kampus USU\",\"nominal\":\"200000000\",\"norek\":\"123343445534543543543\",\"ruang_lingkup\":\"Pendidikan\",\"status\":\"NEW\"}', '2023-03-13 19:57:24', '2870', '2023-03-13 19:57:24');
INSERT INTO `t_log` VALUES (8, 'edit permohonan', '{\"ruang_lingkup\":\"Sosial\",\"nominal\":\"10000000\"}', '2023-03-14 09:21:12', '2870', '2023-03-14 09:21:12');
INSERT INTO `t_log` VALUES (9, 'edit permohonan', '{\"ruang_lingkup\":\"Pendidikan\",\"nominal\":\"10000000\"}', '2023-03-14 09:21:45', '2870', '2023-03-14 09:21:45');
INSERT INTO `t_log` VALUES (10, 'edit permohonan', '{\"ruang_lingkup\":\"Sosial\",\"nominal\":\"10000000\"}', '2023-03-14 09:22:28', '2870', '2023-03-14 09:22:28');
INSERT INTO `t_log` VALUES (11, 'edit permohonan', '{\"ruang_lingkup\":\"Pendidikan\",\"nominal\":\"10000000\"}', '2023-03-14 09:24:49', '2870', '2023-03-14 09:24:49');
INSERT INTO `t_log` VALUES (12, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-03-14 09:31:27', '2870', '2023-03-14 09:31:27');
INSERT INTO `t_log` VALUES (13, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Login Berhasil\",\"data\":[{\"id_adm_user\":\"2265\",\"nama_login\":\"2870\",\"password\":\"7af4e97911aaf794d0d4724e31888c6b\",\"id_peg\":\"3222\",\"nrik\":\"2870.20111985.01042013\",\"nama\":\"Denovriyanto Harefa\",\"tgl_lhr\":\"1985-11-20\",\"no_ktp\":\"1204012011850006\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2013-04-01\",\"tgl_msk\":\"2012-07-01\",\"kelamin\":\"L\",\"no_hp\":\"085372803253\",\"user_email\":\"denovriyantoharefa@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"9\",\"id_hist_uker\":\"56834\",\"id_unit_kerja\":\"665\",\"tmt_unit_kerja\":\"2019-07-01\",\"no_sk_unit_kerja\":\"172\\/Dir\\/DSDM-PSDM\\/SK\\/2019\",\"tgl_sk_unit_kerja\":\"2019-06-26\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Divisi Teknologi Informasi\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39528\",\"id_jabatan\":\"6339\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5669\",\"id_hist_unit_kerja\":\"56834\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"Programmer Officer\",\"id_hist_pangkat\":\"23516\",\"id_pangkat\":\"30\",\"tmt_pangkat\":\"2021-03-22\",\"no_sk_pangkat\":\"050\\/DIR\\/DSDM-TK\\/SK\\/2021\",\"tgl_sk_pangkat\":\"2021-03-22\",\"id_hist_jabatan\":\"35054\",\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G5\",\"tk_grade\":\"21\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"665\",\"unit_penempatan\":\"Divisi Teknologi Informasi\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"1\",\"jabunit\":\"665\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"e6675bbd3137f6bf\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Mahdian Putra Lubis\",\"id_supervisi\":\"u1328\"}]}', '2023-03-14 09:41:45', '2870', '2023-03-14 09:41:45');
INSERT INTO `t_log` VALUES (14, 'edit permohonan', '{\"ruang_lingkup\":\"Pendidikan\",\"nominal\":\"200000000\"}', '2023-03-14 09:42:38', '2870', '2023-03-14 09:42:38');
INSERT INTO `t_log` VALUES (15, 'Hapus Data Permohonan', '{\"id_master\":73,\"no_surat_edoc\":\"123\",\"nama_kegiatan\":\"Pemberian Beasiswa kepada mahasiswa berprestasi\",\"lokasi_kegiatan\":\"Kampus USU\",\"nominal\":200000000,\"ruang_lingkup\":\"Pendidikan\",\"status\":\"NEW\",\"id_unit_master\":798,\"file_val\":null,\"file_bapi\":null,\"file_sk\":null,\"created_at\":\"2023-03-13T12:57:24.000000Z\",\"updated_at\":\"2023-03-14T02:42:38.000000Z\",\"norek\":\"123343445534543543543\",\"is_uploaded\":null}', '2023-03-14 09:45:06', '2870', '2023-03-14 09:45:06');
INSERT INTO `t_log` VALUES (16, 'input permohonan', '{\"_token\":\"pgVgAdzogWPmsngb845AKQfsLgkmCbvOjtmb87rh\",\"id_unit_master\":\"798\",\"no_surat_edoc\":\"123\",\"nama_kegiatan\":\"Pemberian Beasiswa Kepada mahasiswa USU\",\"lokasi_kegiatan\":\"Kampus USU\",\"nominal\":\"200000000\",\"norek\":\"2134423421423\",\"ruang_lingkup\":\"Pendidikan\",\"status\":\"NEW\"}', '2023-03-14 09:47:27', '2870', '2023-03-14 09:47:27');
INSERT INTO `t_log` VALUES (17, 'Hapus Data Permohonan', '{\"id_master\":74,\"no_surat_edoc\":\"123\",\"nama_kegiatan\":\"Pemberian Beasiswa Kepada mahasiswa USU\",\"lokasi_kegiatan\":\"Kampus USU\",\"nominal\":200000000,\"ruang_lingkup\":\"Pendidikan\",\"status\":\"NEW\",\"id_unit_master\":798,\"file_val\":null,\"file_bapi\":null,\"file_sk\":null,\"created_at\":\"2023-03-14T02:47:27.000000Z\",\"updated_at\":\"2023-03-14T02:47:27.000000Z\",\"norek\":\"2134423421423\",\"is_uploaded\":null}', '2023-03-14 09:47:33', '2870', '2023-03-14 09:47:33');
INSERT INTO `t_log` VALUES (18, 'input permohonan', '{\"_token\":\"pgVgAdzogWPmsngb845AKQfsLgkmCbvOjtmb87rh\",\"id_unit_master\":\"798\",\"no_surat_edoc\":\"123\",\"nama_kegiatan\":\"Pemberian Beasiswa untuk mahasiswa berprestasi\",\"lokasi_kegiatan\":\"Kampus USU\",\"nominal\":\"200000000\",\"norek\":\"1002233242432423423\",\"ruang_lingkup\":\"Pendidikan\",\"status\":\"NEW\"}', '2023-03-14 09:53:21', '2870', '2023-03-14 09:53:21');
INSERT INTO `t_log` VALUES (19, 'Tambah Validasi Data', '{\"id_master\":75,\"no_surat_edoc\":\"123\",\"nama_kegiatan\":\"Pemberian Beasiswa untuk mahasiswa berprestasi\",\"lokasi_kegiatan\":\"Kampus USU\",\"nominal\":200000000,\"ruang_lingkup\":\"Pendidikan\",\"status\":\"DOKUMENTASI\",\"id_unit_master\":798,\"file_val\":null,\"file_bapi\":null,\"file_sk\":null,\"created_at\":\"2023-03-14T02:53:20.000000Z\",\"updated_at\":\"2023-03-14T03:37:21.000000Z\",\"norek\":\"1002233242432423423\",\"is_uploaded\":null}', '2023-03-14 10:37:21', '2870', '2023-03-14 10:37:21');
INSERT INTO `t_log` VALUES (20, 'edit permohonan', '{\"ruang_lingkup\":\"Pendidikan\",\"nominal\":\"200000000\"}', '2023-03-14 15:31:27', '2870', '2023-03-14 15:31:27');
INSERT INTO `t_log` VALUES (21, 'edit permohonan', '{\"ruang_lingkup\":\"Pendidikan\",\"nominal\":\"200000000\"}', '2023-03-14 16:04:29', '2870', '2023-03-14 16:04:29');
INSERT INTO `t_log` VALUES (22, 'edit permohonan', '{\"ruang_lingkup\":\"Pendidikan\",\"nominal\":\"200000000\"}', '2023-03-14 16:04:35', '2870', '2023-03-14 16:04:35');
INSERT INTO `t_log` VALUES (23, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-03-14 16:04:40', '2870', '2023-03-14 16:04:40');
INSERT INTO `t_log` VALUES (24, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Login Berhasil\",\"data\":[{\"id_adm_user\":\"2265\",\"nama_login\":\"2870\",\"password\":\"7af4e97911aaf794d0d4724e31888c6b\",\"id_peg\":\"3222\",\"nrik\":\"2870.20111985.01042013\",\"nama\":\"Denovriyanto Harefa\",\"tgl_lhr\":\"1985-11-20\",\"no_ktp\":\"1204012011850006\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2013-04-01\",\"tgl_msk\":\"2012-07-01\",\"kelamin\":\"L\",\"no_hp\":\"085372803253\",\"user_email\":\"denovriyantoharefa@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"9\",\"id_hist_uker\":\"56834\",\"id_unit_kerja\":\"665\",\"tmt_unit_kerja\":\"2019-07-01\",\"no_sk_unit_kerja\":\"172\\/Dir\\/DSDM-PSDM\\/SK\\/2019\",\"tgl_sk_unit_kerja\":\"2019-06-26\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Divisi Teknologi Informasi\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39528\",\"id_jabatan\":\"6339\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5669\",\"id_hist_unit_kerja\":\"56834\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"Programmer Officer\",\"id_hist_pangkat\":\"23516\",\"id_pangkat\":\"30\",\"tmt_pangkat\":\"2021-03-22\",\"no_sk_pangkat\":\"050\\/DIR\\/DSDM-TK\\/SK\\/2021\",\"tgl_sk_pangkat\":\"2021-03-22\",\"id_hist_jabatan\":\"35054\",\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G5\",\"tk_grade\":\"21\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"665\",\"unit_penempatan\":\"Divisi Teknologi Informasi\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"1\",\"jabunit\":\"665\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"e6675bbd3137f6bf\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Mahdian Putra Lubis\",\"id_supervisi\":\"u1328\"}]}', '2023-03-20 09:39:23', '2870', '2023-03-20 09:39:23');
INSERT INTO `t_log` VALUES (25, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-26 17:16:06', '2870', '2023-04-26 17:16:06');
INSERT INTO `t_log` VALUES (26, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Berhasil get data pegawai\",\"data\":[{\"id_adm_user\":\"2265\",\"nama_login\":\"2870\",\"password\":\"7af4e97911aaf794d0d4724e31888c6b\",\"id_peg\":\"3222\",\"nrik\":\"2870.20111985.01042013\",\"nama\":\"Denovriyanto Harefa\",\"tgl_lhr\":\"1985-11-20\",\"no_ktp\":\"1204012011850006\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2013-04-01\",\"tgl_msk\":\"2012-07-01\",\"kelamin\":\"L\",\"no_hp\":\"085372803253\",\"user_email\":\"denovriyantoharefa@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"10\",\"id_hist_uker\":\"56834\",\"id_unit_kerja\":\"665\",\"tmt_unit_kerja\":\"2019-07-01\",\"no_sk_unit_kerja\":\"172\\/Dir\\/DSDM-PSDM\\/SK\\/2019\",\"tgl_sk_unit_kerja\":\"2019-06-26\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Divisi Teknologi Informasi\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39528\",\"id_jabatan\":\"6339\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5669\",\"id_hist_unit_kerja\":\"56834\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"Programmer Officer\",\"id_hist_pangkat\":\"23516\",\"id_pangkat\":\"30\",\"tmt_pangkat\":\"2021-03-22\",\"no_sk_pangkat\":\"050\\/DIR\\/DSDM-TK\\/SK\\/2021\",\"tgl_sk_pangkat\":\"2021-03-22\",\"id_hist_jabatan\":\"35054\",\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G5\",\"tk_grade\":\"21\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"665\",\"unit_penempatan\":\"Divisi Teknologi Informasi\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"1\",\"jabunit\":\"665\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"e6675bbd3137f6bf\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Mahdian Putra Lubis\",\"id_supervisi\":\"u1328\"}]}', '2023-04-26 17:19:19', '2870', '2023-04-26 17:19:19');
INSERT INTO `t_log` VALUES (27, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-26 17:20:31', '2870', '2023-04-26 17:20:31');
INSERT INTO `t_log` VALUES (28, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Berhasil get data pegawai\",\"data\":[{\"id_adm_user\":\"1458\",\"nama_login\":\"2119\",\"password\":\"23b4ede183e775ca67ed53790a71ba45\",\"id_peg\":\"2051\",\"nrik\":\"2119.07021986.01062010\",\"nama\":\"Mhd. Ekky Yudhistira\",\"tgl_lhr\":\"1986-02-07\",\"no_ktp\":\"1271020702860002\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2010-06-01\",\"tgl_msk\":\"2009-10-31\",\"kelamin\":\"L\",\"no_hp\":\"081376724737\",\"user_email\":\"mhd.ekkyyudhistira@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"12\",\"id_hist_uker\":\"60344\",\"id_unit_kerja\":\"755\",\"tmt_unit_kerja\":\"2021-05-10\",\"no_sk_unit_kerja\":\"064\\/DIR\\/DSDM-PSDM\\/SK\\/2021\",\"tgl_sk_unit_kerja\":\"2021-04-28\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Sekretariat Perusahaan\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39621\",\"id_jabatan\":\"6352\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5768\",\"id_hist_unit_kerja\":\"60344\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"CSR Analyst Specialist\",\"id_hist_pangkat\":\"25364\",\"id_pangkat\":\"28\",\"tmt_pangkat\":\"2023-02-20\",\"no_sk_pangkat\":\"021\\/Dir\\/DSDM-TK\\/SK\\/2023\",\"tgl_sk_pangkat\":\"2023-02-23\",\"id_hist_jabatan\":null,\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G7\",\"tk_grade\":\"23\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"755\",\"unit_penempatan\":\"Sekretariat Perusahaan\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"3\",\"jabunit\":\"755\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"cc0445b5f223f421\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Agus Condro Wibowo\",\"id_supervisi\":\"u0817\"}]}', '2023-04-26 17:20:35', '2119', '2023-04-26 17:20:35');
INSERT INTO `t_log` VALUES (29, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-26 17:20:50', '2119', '2023-04-26 17:20:50');
INSERT INTO `t_log` VALUES (30, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Berhasil get data pegawai\",\"data\":[{\"id_adm_user\":\"1458\",\"nama_login\":\"2119\",\"password\":\"23b4ede183e775ca67ed53790a71ba45\",\"id_peg\":\"2051\",\"nrik\":\"2119.07021986.01062010\",\"nama\":\"Mhd. Ekky Yudhistira\",\"tgl_lhr\":\"1986-02-07\",\"no_ktp\":\"1271020702860002\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2010-06-01\",\"tgl_msk\":\"2009-10-31\",\"kelamin\":\"L\",\"no_hp\":\"081376724737\",\"user_email\":\"mhd.ekkyyudhistira@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"12\",\"id_hist_uker\":\"60344\",\"id_unit_kerja\":\"755\",\"tmt_unit_kerja\":\"2021-05-10\",\"no_sk_unit_kerja\":\"064\\/DIR\\/DSDM-PSDM\\/SK\\/2021\",\"tgl_sk_unit_kerja\":\"2021-04-28\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Sekretariat Perusahaan\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39621\",\"id_jabatan\":\"6352\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5768\",\"id_hist_unit_kerja\":\"60344\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"CSR Analyst Specialist\",\"id_hist_pangkat\":\"25364\",\"id_pangkat\":\"28\",\"tmt_pangkat\":\"2023-02-20\",\"no_sk_pangkat\":\"021\\/Dir\\/DSDM-TK\\/SK\\/2023\",\"tgl_sk_pangkat\":\"2023-02-23\",\"id_hist_jabatan\":null,\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G7\",\"tk_grade\":\"23\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"755\",\"unit_penempatan\":\"Sekretariat Perusahaan\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"3\",\"jabunit\":\"755\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"cc0445b5f223f421\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Agus Condro Wibowo\",\"id_supervisi\":\"u0817\"}]}', '2023-04-26 17:45:53', '2119', '2023-04-26 17:45:53');
INSERT INTO `t_log` VALUES (31, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-26 17:49:32', '2119', '2023-04-26 17:49:32');
INSERT INTO `t_log` VALUES (32, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Berhasil get data pegawai\",\"data\":[{\"id_adm_user\":\"1458\",\"nama_login\":\"2119\",\"password\":\"23b4ede183e775ca67ed53790a71ba45\",\"id_peg\":\"2051\",\"nrik\":\"2119.07021986.01062010\",\"nama\":\"Mhd. Ekky Yudhistira\",\"tgl_lhr\":\"1986-02-07\",\"no_ktp\":\"1271020702860002\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2010-06-01\",\"tgl_msk\":\"2009-10-31\",\"kelamin\":\"L\",\"no_hp\":\"081376724737\",\"user_email\":\"mhd.ekkyyudhistira@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"12\",\"id_hist_uker\":\"60344\",\"id_unit_kerja\":\"755\",\"tmt_unit_kerja\":\"2021-05-10\",\"no_sk_unit_kerja\":\"064\\/DIR\\/DSDM-PSDM\\/SK\\/2021\",\"tgl_sk_unit_kerja\":\"2021-04-28\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Sekretariat Perusahaan\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39621\",\"id_jabatan\":\"6352\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5768\",\"id_hist_unit_kerja\":\"60344\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"CSR Analyst Specialist\",\"id_hist_pangkat\":\"25364\",\"id_pangkat\":\"28\",\"tmt_pangkat\":\"2023-02-20\",\"no_sk_pangkat\":\"021\\/Dir\\/DSDM-TK\\/SK\\/2023\",\"tgl_sk_pangkat\":\"2023-02-23\",\"id_hist_jabatan\":null,\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G7\",\"tk_grade\":\"23\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"755\",\"unit_penempatan\":\"Sekretariat Perusahaan\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"3\",\"jabunit\":\"755\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"cc0445b5f223f421\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Agus Condro Wibowo\",\"id_supervisi\":\"u0817\"}]}', '2023-04-26 17:50:27', '2119', '2023-04-26 17:50:27');
INSERT INTO `t_log` VALUES (33, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-26 17:50:35', '2119', '2023-04-26 17:50:35');
INSERT INTO `t_log` VALUES (34, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Berhasil get data pegawai\",\"data\":[{\"id_adm_user\":\"1458\",\"nama_login\":\"2119\",\"password\":\"23b4ede183e775ca67ed53790a71ba45\",\"id_peg\":\"2051\",\"nrik\":\"2119.07021986.01062010\",\"nama\":\"Mhd. Ekky Yudhistira\",\"tgl_lhr\":\"1986-02-07\",\"no_ktp\":\"1271020702860002\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2010-06-01\",\"tgl_msk\":\"2009-10-31\",\"kelamin\":\"L\",\"no_hp\":\"081376724737\",\"user_email\":\"mhd.ekkyyudhistira@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"12\",\"id_hist_uker\":\"60344\",\"id_unit_kerja\":\"755\",\"tmt_unit_kerja\":\"2021-05-10\",\"no_sk_unit_kerja\":\"064\\/DIR\\/DSDM-PSDM\\/SK\\/2021\",\"tgl_sk_unit_kerja\":\"2021-04-28\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Sekretariat Perusahaan\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39621\",\"id_jabatan\":\"6352\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5768\",\"id_hist_unit_kerja\":\"60344\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"CSR Analyst Specialist\",\"id_hist_pangkat\":\"25364\",\"id_pangkat\":\"28\",\"tmt_pangkat\":\"2023-02-20\",\"no_sk_pangkat\":\"021\\/Dir\\/DSDM-TK\\/SK\\/2023\",\"tgl_sk_pangkat\":\"2023-02-23\",\"id_hist_jabatan\":null,\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G7\",\"tk_grade\":\"23\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"755\",\"unit_penempatan\":\"Sekretariat Perusahaan\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"3\",\"jabunit\":\"755\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"cc0445b5f223f421\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Agus Condro Wibowo\",\"id_supervisi\":\"u0817\"}]}', '2023-04-26 17:55:18', '2119', '2023-04-26 17:55:18');
INSERT INTO `t_log` VALUES (35, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-26 17:55:32', '2119', '2023-04-26 17:55:32');
INSERT INTO `t_log` VALUES (36, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Berhasil get data pegawai\",\"data\":[{\"id_adm_user\":\"1458\",\"nama_login\":\"2119\",\"password\":\"23b4ede183e775ca67ed53790a71ba45\",\"id_peg\":\"2051\",\"nrik\":\"2119.07021986.01062010\",\"nama\":\"Mhd. Ekky Yudhistira\",\"tgl_lhr\":\"1986-02-07\",\"no_ktp\":\"1271020702860002\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2010-06-01\",\"tgl_msk\":\"2009-10-31\",\"kelamin\":\"L\",\"no_hp\":\"081376724737\",\"user_email\":\"mhd.ekkyyudhistira@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"12\",\"id_hist_uker\":\"60344\",\"id_unit_kerja\":\"755\",\"tmt_unit_kerja\":\"2021-05-10\",\"no_sk_unit_kerja\":\"064\\/DIR\\/DSDM-PSDM\\/SK\\/2021\",\"tgl_sk_unit_kerja\":\"2021-04-28\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Sekretariat Perusahaan\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39621\",\"id_jabatan\":\"6352\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5768\",\"id_hist_unit_kerja\":\"60344\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"CSR Analyst Specialist\",\"id_hist_pangkat\":\"25364\",\"id_pangkat\":\"28\",\"tmt_pangkat\":\"2023-02-20\",\"no_sk_pangkat\":\"021\\/Dir\\/DSDM-TK\\/SK\\/2023\",\"tgl_sk_pangkat\":\"2023-02-23\",\"id_hist_jabatan\":null,\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G7\",\"tk_grade\":\"23\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"755\",\"unit_penempatan\":\"Sekretariat Perusahaan\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"3\",\"jabunit\":\"755\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"cc0445b5f223f421\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Agus Condro Wibowo\",\"id_supervisi\":\"u0817\"}]}', '2023-04-27 11:15:21', '2119', '2023-04-27 11:15:21');
INSERT INTO `t_log` VALUES (37, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-27 11:46:51', '2119', '2023-04-27 11:46:51');
INSERT INTO `t_log` VALUES (38, 'Login Aplikasi', '{\"rcode\":\"00\",\"message\":\"Berhasil get data pegawai\",\"data\":[{\"id_adm_user\":\"1458\",\"nama_login\":\"2119\",\"password\":\"23b4ede183e775ca67ed53790a71ba45\",\"id_peg\":\"2051\",\"nrik\":\"2119.07021986.01062010\",\"nama\":\"Mhd. Ekky Yudhistira\",\"tgl_lhr\":\"1986-02-07\",\"no_ktp\":\"1271020702860002\",\"status_peg\":\"1\",\"tgl_capeg\":null,\"tgl_tetap\":\"2010-06-01\",\"tgl_msk\":\"2009-10-31\",\"kelamin\":\"L\",\"no_hp\":\"081376724737\",\"user_email\":\"mhd.ekkyyudhistira@banksumut.co.id\",\"usia\":\"37\",\"masa_kerja\":\"12\",\"id_hist_uker\":\"60344\",\"id_unit_kerja\":\"755\",\"tmt_unit_kerja\":\"2021-05-10\",\"no_sk_unit_kerja\":\"064\\/DIR\\/DSDM-PSDM\\/SK\\/2021\",\"tgl_sk_unit_kerja\":\"2021-04-28\",\"what_happen_unit_kerja\":\"99\",\"nm_unit_kerja\":\"Sekretariat Perusahaan\",\"kd_unit_uker\":\"001\",\"uker_kelompok\":\"0\",\"id_parentuker\":\"762\",\"id_hist_jab\":\"39621\",\"id_jabatan\":\"6352\",\"tmt_jabatan\":\"2022-09-15\",\"no_sk_jabatan\":\"191\\/Dir\\/DSDM-PSDM\\/SK\\/2022\",\"tgl_sk_jabatan\":\"2022-09-13\",\"id_parentjab\":\"5768\",\"id_hist_unit_kerja\":\"60344\",\"what_happen_jabatan\":\"2\",\"nm_jabatan\":\"CSR Analyst Specialist\",\"id_hist_pangkat\":\"25364\",\"id_pangkat\":\"28\",\"tmt_pangkat\":\"2023-02-20\",\"no_sk_pangkat\":\"021\\/Dir\\/DSDM-TK\\/SK\\/2023\",\"tgl_sk_pangkat\":\"2023-02-23\",\"id_hist_jabatan\":null,\"what_happen_pangkat\":\"1\",\"nm_pangkat\":\"G7\",\"tk_grade\":\"23\",\"is_non_pegawai\":\"0\",\"ditempatkan_di\":\"755\",\"unit_penempatan\":\"Sekretariat Perusahaan\",\"is_placement\":\"0\",\"id_kel_jabatan\":\"251\",\"nama_kel_jabatan\":\"Professional Assistant Manager\",\"direktorat\":\"3\",\"jabunit\":\"755\",\"latitude\":\"3.58308\",\"longtitude\":\"98.6748\",\"max_radius\":\"120\",\"absen_device_id\":\"cc0445b5f223f421\",\"kd_unit_penempatan\":\"001\",\"nama_supervisi\":\"Agus Condro Wibowo\",\"id_supervisi\":\"u0817\"}]}', '2023-04-27 11:52:10', '2119', '2023-04-27 11:52:10');
INSERT INTO `t_log` VALUES (39, 'Logout Aplikasi', 'Keluar dari Aplikasi', '2023-04-27 12:09:21', '2119', '2023-04-27 12:09:21');

-- ----------------------------
-- Table structure for t_master
-- ----------------------------
DROP TABLE IF EXISTS `t_master`;
CREATE TABLE `t_master`  (
  `id_master` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_surat_edoc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `ruang_lingkup` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_unit_master` bigint(20) NOT NULL,
  `file_val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_bapi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_sk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `norek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_uploaded` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_master`) USING BTREE,
  INDEX `id_unit_master`(`id_unit_master`) USING BTREE,
  CONSTRAINT `t_master_ibfk_1` FOREIGN KEY (`id_unit_master`) REFERENCES `t_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 76 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_master
-- ----------------------------
INSERT INTO `t_master` VALUES (75, '123', 'Pemberian Beasiswa untuk mahasiswa berprestasi', 'Kampus USU', 200000000, 'Pendidikan', 'SELESAI', 798, 'arsip_pdf/75/Kelengkapan Usulan.pdf', 'arsip_pdf/75/Berita Acara & Pakta Integritas.pdf', 'arsip_pdf/75/Surat Keputusan.pdf', '2023-03-14 09:53:20', '2023-03-14 14:23:18', '1002233242432423423', 1);

-- ----------------------------
-- Table structure for t_master_surat
-- ----------------------------
DROP TABLE IF EXISTS `t_master_surat`;
CREATE TABLE `t_master_surat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `value_setting` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_master_surat
-- ----------------------------
INSERT INTO `t_master_surat` VALUES (1, 'Analis', NULL, '2023-03-14 15:20:51', 'Mhd. Ekky Yudhistira');
INSERT INTO `t_master_surat` VALUES (2, 'Supervisi', NULL, '2023-03-14 15:20:51', 'Abdul Hamid,PJS - Pemimpin Unit CSR');
INSERT INTO `t_master_surat` VALUES (3, 'Mengetahui', NULL, '2023-03-14 15:20:51', 'Agus Condro Wibowo,Sekretaris Perusahaan');

-- ----------------------------
-- Table structure for t_seremonial
-- ----------------------------
DROP TABLE IF EXISTS `t_seremonial`;
CREATE TABLE `t_seremonial`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `id_val_master` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_seremonial
-- ----------------------------
INSERT INTO `t_seremonial` VALUES (9, '1678737496-mage-202.jpeg', '2023-03-14 14:58:16', 75, '2023-03-14 14:58:16');
INSERT INTO `t_seremonial` VALUES (10, '1678737496-11002360.png', '2023-03-14 14:58:16', 75, '2023-03-14 14:58:16');
INSERT INTO `t_seremonial` VALUES (11, '1678737496-mage-202.jpeg', '2023-03-14 14:58:16', 75, '2023-03-14 14:58:16');

-- ----------------------------
-- Table structure for t_unit
-- ----------------------------
DROP TABLE IF EXISTS `t_unit`;
CREATE TABLE `t_unit`  (
  `id_unit` bigint(20) NOT NULL AUTO_INCREMENT,
  `pemda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` bigint(20) NOT NULL,
  `jns_wilayah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_unit`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 833 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_unit
-- ----------------------------
INSERT INTO `t_unit` VALUES (798, 'Sumatera Utara', 'Kantor Pusat (Pemprov)', 100, 'Provinsi');
INSERT INTO `t_unit` VALUES (799, 'Tapanuli Selatan', 'Cabang Sipirok', 233, 'Kabupaten');
INSERT INTO `t_unit` VALUES (800, 'Simalungun', 'Cabang Pematang Raya', 225, 'Kabupaten');
INSERT INTO `t_unit` VALUES (801, 'Deli Serdang', 'Cabang Lubuk Pakam', 106, 'Kabupaten');
INSERT INTO `t_unit` VALUES (802, 'Labuhan Batu', 'Cabang Rantauprapat', 210, 'Kabupaten');
INSERT INTO `t_unit` VALUES (803, 'Tebing Tinggi', 'Cabang Tebing Tinggi', 300, 'Kotamadya');
INSERT INTO `t_unit` VALUES (804, 'Medan', 'Cabkor Medan', 100, 'Kotamadya');
INSERT INTO `t_unit` VALUES (805, 'Tapanuli Tengah', 'Cabang Pandan', 291, 'Kabupaten');
INSERT INTO `t_unit` VALUES (806, 'Nias', 'Cabang Gunung Sitoli', 270, 'Kabupaten');
INSERT INTO `t_unit` VALUES (807, 'Asahan', 'Cabang Kisaran', 260, 'Kabupaten');
INSERT INTO `t_unit` VALUES (808, 'Tapanuli Utara', 'Cabang Tarutung', 323, 'Kabupaten');
INSERT INTO `t_unit` VALUES (809, 'Pematang Siantar', 'Cabang Pematang Siantar', 220, 'Kotamadya');
INSERT INTO `t_unit` VALUES (810, 'Padang Sidimpuan', 'Cabang Padangsidimpuan', 230, 'Kabupaten');
INSERT INTO `t_unit` VALUES (811, 'Dairi', 'Cabang Sidikalang', 280, 'Kabupaten');
INSERT INTO `t_unit` VALUES (812, 'Tanjung Balai', 'Cabang Tanjung Balai', 330, 'Kotamadya');
INSERT INTO `t_unit` VALUES (813, 'Sibolga', 'Cabang Sibolga', 290, 'Kotamadya');
INSERT INTO `t_unit` VALUES (814, 'Langkat', 'Cabang Stabat', 311, 'Kabupaten');
INSERT INTO `t_unit` VALUES (815, 'Mandailing Natal', 'Cabang Panyabungan', 340, 'Kabupaten');
INSERT INTO `t_unit` VALUES (816, 'Padang Lawas', 'Cabang Sibuhuan', 234, 'Kabupaten');
INSERT INTO `t_unit` VALUES (817, 'H Hasundutan', 'Cabang Dolok Sanggul', 321, 'Kabupaten');
INSERT INTO `t_unit` VALUES (818, 'Toba Samosir', 'Cabang Balige', 240, 'Kabupaten');
INSERT INTO `t_unit` VALUES (819, 'Karo', 'Cabang Kabanjahe', 250, 'Kabupaten');
INSERT INTO `t_unit` VALUES (820, 'Binjai', 'Cabang Binjai', 310, 'Kotamadya');
INSERT INTO `t_unit` VALUES (821, 'Serdang Bedagai', 'Cabang Sei Rampah', 302, 'Kabupaten');
INSERT INTO `t_unit` VALUES (822, 'Samosir', 'Cabang Pangururan', 241, 'Kabupaten');
INSERT INTO `t_unit` VALUES (823, 'Nias Selatan', 'Cabang Teluk Dalam', 271, 'Kabupaten');
INSERT INTO `t_unit` VALUES (824, 'Pakpak Bharat', 'Cabang Pembantu Salak', 281, 'Kabupaten');
INSERT INTO `t_unit` VALUES (825, 'Padang Lawas Utara', 'Cabang Gunung Tua', 231, 'Kabupaten');
INSERT INTO `t_unit` VALUES (826, 'Labusel', 'Cabang Kota Pinang', 212, 'Kabupaten');
INSERT INTO `t_unit` VALUES (827, 'Labura', 'Cabang Aek Kanopan', 211, 'Kabupaten');
INSERT INTO `t_unit` VALUES (828, 'Batubara', 'Cabang Lima Puluh', 262, 'Kabupaten');
INSERT INTO `t_unit` VALUES (829, 'Pemko Gn Sitoli', 'Cabang Gunung Sitoli', 270, 'Kotamadya');
INSERT INTO `t_unit` VALUES (830, 'Nias Barat', 'Cabang Pembantu Lahomi', 273, 'Kabupaten');
INSERT INTO `t_unit` VALUES (831, 'Nias Utara', 'Cabang Pembantu Lotu', 272, 'Kabupaten');

-- ----------------------------
-- Table structure for t_validasi
-- ----------------------------
DROP TABLE IF EXISTS `t_validasi`;
CREATE TABLE `t_validasi`  (
  `id_validasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prop_rencana` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `check_judul` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_jumlah` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_norek` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_pernyataan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `surat_permohonan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `check_data_diri` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_ket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sasaran_prog` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_prog` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kesimpulan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `id_val_master` bigint(20) NULL DEFAULT NULL,
  `file_val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `usulan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_validasi`) USING BTREE,
  INDEX `id_val_master`(`id_val_master`) USING BTREE,
  CONSTRAINT `t_validasi_ibfk_1` FOREIGN KEY (`id_val_master`) REFERENCES `t_master` (`id_master`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_validasi
-- ----------------------------
INSERT INTO `t_validasi` VALUES (1, 'Ya,Proposal kegiatan beasiswa', 'Ya,Pemberian Beasiswa mahasiswa TI USU', 'Ya', 'Ya', 'Ya,xxx/yyy/zzz', 'Ya,yyy/xxxx/xxxx', 'Ya,Terlampir', 'Ya,SK NO XXX/YYY/ZZZ', 'Kepada mahasiswa berprestasi', 'Pemberian Beasisaw', 'Mahasiswa,Untuk meningkatkan prestasi mahasiswa,sudah lengkap', 75, NULL, '2023-03-14 10:37:21', '2023-03-14 10:37:21', 'Berdasarkan data di atas, dengan ini kami usulkan/rekomendasikan kiranya usulan Program Kemitraan tersebut dapat disetujui dan kami akan menindaklanjuti surat persetujuan tersebut kepada penerima manfaat Program Kemitraan');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `role` enum('admin','petugas','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', NULL, '$2y$10$qmf6vRO4.FcGb5Sa1iB1kOjuQN/rmAyrPDXMz5TlJKevno/nmJP3e', '59wj0w7scBKUu2ZzJp0hsl1DJ0oXCQFhx45TR7IovHl2NHN7IMd6uKggVVaz', 'admin', '2022-09-20 07:17:34', '2022-09-20 07:17:34');
INSERT INTO `users` VALUES (2, 'petugas', 'petugas@gmail.com', NULL, '$2y$10$tp4UR7Nk9xkYnQUMKlWh5OD7QfTcVdF0O8N0mRtlw6tdEXk1svFzq', NULL, 'petugas', '2022-10-06 04:29:34', '2022-10-06 04:29:34');
INSERT INTO `users` VALUES (3, 'user', 'user@gmail.com', NULL, '$2y$10$o.3/efDRlmfY0DZ7Qs64fuk7tSYU/KDOzj9Y1UTeyeSX6.OE/Zh3u', NULL, 'user', '2022-10-06 04:30:54', '2022-10-06 04:30:54');

-- ----------------------------
-- Table structure for wilayah
-- ----------------------------
DROP TABLE IF EXISTS `wilayah`;
CREATE TABLE `wilayah`  (
  `id_wilayah` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_wilayah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pusat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_wilayah`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wilayah
-- ----------------------------
INSERT INTO `wilayah` VALUES (1, 'Kabupaten Asahan', 'Kisaran');
INSERT INTO `wilayah` VALUES (2, 'Kabupaten Batu Bara', 'Limapuluh');
INSERT INTO `wilayah` VALUES (3, 'Kabupaten Dairi', 'Sidikalang');
INSERT INTO `wilayah` VALUES (4, 'Kabupaten Deli Serdang', 'Lubuk Pakam');
INSERT INTO `wilayah` VALUES (5, 'Kabupaten Humbang Hasundutan', 'Dolok Sanggul');
INSERT INTO `wilayah` VALUES (6, 'Kabupaten Karo', 'Kabanjahe');
INSERT INTO `wilayah` VALUES (7, 'Kabupaten Labuhanbatu', 'Rantau Prapat');
INSERT INTO `wilayah` VALUES (8, 'Kabupaten Labuhanbatu Selatan', 'Kota Pinang');
INSERT INTO `wilayah` VALUES (9, 'Kabupaten Labuhanbatu Utara', 'Aek Kanopan');
INSERT INTO `wilayah` VALUES (10, 'Kabupaten Langkat', 'Stabat');
INSERT INTO `wilayah` VALUES (11, 'Kabupaten Mandailing Natal', 'Panyabungan');
INSERT INTO `wilayah` VALUES (12, 'Kabupaten Nias', 'Gido');
INSERT INTO `wilayah` VALUES (13, 'Kabupaten Nias Barat', 'Lahomi');
INSERT INTO `wilayah` VALUES (14, 'Kabupaten Nias Selatan', 'Teluk Dalam');
INSERT INTO `wilayah` VALUES (15, 'Kabupaten Nias Utara', 'Lotu');
INSERT INTO `wilayah` VALUES (16, 'Kabupaten Padang Lawas', 'Sibuhuan');
INSERT INTO `wilayah` VALUES (17, 'Kabupaten Padang Lawas Utara', 'Gunung Tua');
INSERT INTO `wilayah` VALUES (18, 'Kabupaten Pakpak Bharat', 'Salak');
INSERT INTO `wilayah` VALUES (19, 'Kabupaten Samosir', 'Pangururan');
INSERT INTO `wilayah` VALUES (20, 'Kabupaten Serdang Bedagai', 'Sei Rampah');
INSERT INTO `wilayah` VALUES (21, 'Kabupaten Simalungun', 'Raya');
INSERT INTO `wilayah` VALUES (22, 'Kabupaten Tapanuli Selatan', 'Sipirok');
INSERT INTO `wilayah` VALUES (23, 'Kabupaten Tapanuli Tengah', 'Pandan');
INSERT INTO `wilayah` VALUES (24, 'Kabupaten Tapanuli Utara', 'Tarutung');
INSERT INTO `wilayah` VALUES (25, 'Kabupaten Toba', 'Balige');
INSERT INTO `wilayah` VALUES (26, 'Kota Binjai', '-');
INSERT INTO `wilayah` VALUES (27, 'Kota Gunungsitoli', '-');
INSERT INTO `wilayah` VALUES (28, 'Kota Medan', '-');
INSERT INTO `wilayah` VALUES (29, 'Kota Padang Sidempuan', '-');
INSERT INTO `wilayah` VALUES (30, 'Kota Pematangsiantar', '-');
INSERT INTO `wilayah` VALUES (31, 'Kota Sibolga', '-');
INSERT INTO `wilayah` VALUES (32, 'Kota Tanjungbalai', '-');
INSERT INTO `wilayah` VALUES (33, 'Kota Tebing Tinggi', '-');

SET FOREIGN_KEY_CHECKS = 1;
