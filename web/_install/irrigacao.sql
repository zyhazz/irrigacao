/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : irrigacao

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2017-09-20 13:03:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for configurations
-- ----------------------------
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `interval` int(255) NOT NULL,
  `min` int(255) DEFAULT NULL,
  `max` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of configurations
-- ----------------------------
INSERT INTO `configurations` VALUES ('1', '1', '1', '20', '60');

-- ----------------------------
-- Table structure for humid_data
-- ----------------------------
DROP TABLE IF EXISTS `humid_data`;
CREATE TABLE `humid_data` (
  `id_umidade` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dataHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valor_umidade` float NOT NULL,
  PRIMARY KEY (`id_umidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of humid_data
-- ----------------------------
