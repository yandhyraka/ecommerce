/*
 Navicat Premium Dump SQL

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : ecommerce

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 24/04/2026 08:58:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for master_barang
-- ----------------------------
DROP TABLE IF EXISTS `master_barang`;
CREATE TABLE `master_barang`  (
  `kode_barang` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga` double(20, 2) NOT NULL,
  PRIMARY KEY (`kode_barang`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_barang
-- ----------------------------
INSERT INTO `master_barang` VALUES ('001', 'Skin Care', 5000.00);
INSERT INTO `master_barang` VALUES ('002', 'Body Care', 4000.00);
INSERT INTO `master_barang` VALUES ('003', 'Facial Care', 3000.00);
INSERT INTO `master_barang` VALUES ('004', 'Hair Care', 2000.00);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (5, '2026-04-22-015109', 'App\\Database\\Migrations\\CreateMasterBarang', 'default', 'App', 1776824186, 1);
INSERT INTO `migrations` VALUES (6, '2026-04-22-015130', 'App\\Database\\Migrations\\CreatePromo', 'default', 'App', 1776824186, 1);
INSERT INTO `migrations` VALUES (7, '2026-04-22-015143', 'App\\Database\\Migrations\\CreatePenjualanHeader', 'default', 'App', 1776824186, 1);
INSERT INTO `migrations` VALUES (8, '2026-04-22-015200', 'App\\Database\\Migrations\\CreatePenjualanHeaderDetail', 'default', 'App', 1776824186, 1);

-- ----------------------------
-- Table structure for penjualan_header
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_header`;
CREATE TABLE `penjualan_header`  (
  `no_transaksi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `customer` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kode_promo` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total_biaya` double(20, 2) NOT NULL,
  `ppn` double(20, 2) NOT NULL,
  `grand_total` double(20, 2) NOT NULL,
  PRIMARY KEY (`no_transaksi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan_header
-- ----------------------------
INSERT INTO `penjualan_header` VALUES ('202312-001', '2023-12-23', 'Michael', 'promo-001', 10000.00, 1100.00, 11100.00);

-- ----------------------------
-- Table structure for penjualan_header_detail
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_header_detail`;
CREATE TABLE `penjualan_header_detail`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kode_barang` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qty` int NOT NULL,
  `harga` double(20, 2) NOT NULL,
  `discount` double(20, 2) NOT NULL DEFAULT 0.00,
  `subtotal` double(20, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan_header_detail
-- ----------------------------
INSERT INTO `penjualan_header_detail` VALUES (1, '202312-001', '001', 1, 5000.00, 0.00, 5000.00);
INSERT INTO `penjualan_header_detail` VALUES (2, '202312-001', '003', 2, 3000.00, 3000.00, 5000.00);
INSERT INTO `penjualan_header_detail` VALUES (3, '202312-001', '004', 1, 3000.00, 0.00, 3000.00);

-- ----------------------------
-- Table structure for promo
-- ----------------------------
DROP TABLE IF EXISTS `promo`;
CREATE TABLE `promo`  (
  `kode_promo` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_promo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`kode_promo`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of promo
-- ----------------------------
INSERT INTO `promo` VALUES ('promo-001', 'promo facial care', 'setiap pembelian Facial Care sejumlah 2 pcs akan mendapat potongan harga 3000');

SET FOREIGN_KEY_CHECKS = 1;
