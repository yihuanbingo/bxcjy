/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : bxcjy

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-01-08 00:53:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bxc_activity`
-- ----------------------------
DROP TABLE IF EXISTS `bxc_activity`;
CREATE TABLE `bxc_activity` (
  `key_id` varchar(30) NOT NULL COMMENT '主键ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '活动名称',
  `descrpition` text NOT NULL COMMENT '活动描述',
  `gift_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '礼物方式（0:话费，1:微信红包）',
  `verificode_rule` bigint(4) NOT NULL DEFAULT '0' COMMENT '验证码生成规则',
  `money_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '送出金额类型（0:固定金额，1:随机金额）',
  `money_rule` varchar(200) NOT NULL DEFAULT '' COMMENT '金额规则',
  `image_address` varchar(200) NOT NULL DEFAULT '' COMMENT '活动图片地址',
  `activi_url` varchar(200) NOT NULL DEFAULT '' COMMENT '活动URL地址',
  `activicode_url` varchar(200) NOT NULL DEFAULT '' COMMENT '活动二维码地址',
  `isdelete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除（0:未删除，1:已删除）',
  `isvalid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否有效（0:有效，1:无效）',
  `add_time` datetime NOT NULL DEFAULT '1900-01-01' COMMENT '添加时间',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_activity
-- ----------------------------
INSERT INTO `bxc_activity` VALUES ('1', '领取红包', '注：活动期间凡购买双喜（经典工坊）、双喜（喜百年）、双喜（百年经典）、双喜（和喜）香烟可轻松获取百元话费，还有小米手机大礼天天放送，机会多多，永不落空。', '0', '0', '1', '0:0|1:50|2:20|5:10|10:10|20:10', '/images/redpacket/201601/1452153857001911612.jpg', 'http://hd.bxcjy.com/?activity_id=1601071551152795hd', '', '0', '0', '2016-01-07 15:51:15', '2016-01-08 00:09:07');
INSERT INTO `bxc_activity` VALUES ('1601080010453799hd', '领取红包', '注：活动期间凡购买双喜（经典工坊）、双喜（喜百年）、双喜（百年经典）、双喜（和喜）香烟可轻松获取百元话费，还有小米手机大礼天天放送，机会多多，永不落空注：活动期间凡购买双喜（经典工坊）、双喜（喜百年）、双喜（百年经典）、双喜（和喜）香烟可轻松获取百元话费，还有小米手机大礼天天放送，机会多多，永不落空。', '0', '0', '0', '1', '/images/redpacket/201601/1452154242914571367.jpg', 'http://hd.bxcjy.com/?activity_id=1601080010453799hd', '', '0', '0', '2016-01-08 00:10:45', '2016-01-08 00:10:45');

-- ----------------------------
-- Table structure for `bxc_rechargerecord`
-- ----------------------------
DROP TABLE IF EXISTS `bxc_rechargerecord`;
CREATE TABLE `bxc_rechargerecord` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `orderid` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `activity_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '活动ID',
  `activity_name` varchar(100) NOT NULL DEFAULT '' COMMENT '活动名称',
  `valifycode` varchar(10) NOT NULL DEFAULT '' COMMENT '验证码',
  `money_num` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `tradeplat` varchar(30) NOT NULL DEFAULT '' COMMENT '交易平台',
  `tradeaccount` varchar(50) NOT NULL DEFAULT '' COMMENT '交易账号（话费充值是手机号）',
  `tradestatus` int(11) NOT NULL DEFAULT '0' COMMENT '交易状态（0:充值，1:成功，其他:失败）',
  `message` text NOT NULL COMMENT '返回消息',
  `isdelete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除（0:未删除，1:已删除）',
  `add_time` datetime NOT NULL DEFAULT '1900-01-01' COMMENT '添加时间',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_rechargerecord
-- ----------------------------
INSERT INTO `bxc_rechargerecord` VALUES ('40', '16010800211271330', '1', '领取红包', '6NTZFU', '1.00', 'APIX', '18200273350', '3', '{\"Code\":3,\"Msg\":\"余额不足\",\"Data\":null}aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '0', '2016-01-08 00:22:50', '2016-01-08 00:49:52');
INSERT INTO `bxc_rechargerecord` VALUES ('41', '16010800230844230', '1', '领取红包', '6NTZFU', '1.00', 'APIX', '18200273350', '3', '{\"Code\":3,\"Msg\":\"余额不足\",\"Data\":null}', '0', '2016-01-08 00:23:09', '2016-01-08 00:23:09');
INSERT INTO `bxc_rechargerecord` VALUES ('42', '16010800521239510', '1', '领取红包', '2EK840', '1.00', 'APIX', '18200273350', '0', '{\"Code\":0,\"Msg\":\"success\",\"Data\":{\"Cardid\":\"141810\",\"Cardnum\":1,\"Ordercash\":1.3,\"Cardname\":\"四川移动手机快充1元\",\"SporderId\":\"1452185702ICXODQQF\",\"UserOrderId\":\"16010800521239510\",\"Phone\":\"18200273350\",\"State\":\"0\"}}', '0', '2016-01-08 00:52:12', '2016-01-08 00:52:12');

-- ----------------------------
-- Table structure for `bxc_traderecord`
-- ----------------------------
DROP TABLE IF EXISTS `bxc_traderecord`;
CREATE TABLE `bxc_traderecord` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `orderid` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `activity_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '活动ID',
  `activity_name` varchar(100) NOT NULL DEFAULT '' COMMENT '活动名称',
  `valifycode` varchar(10) NOT NULL DEFAULT '' COMMENT '验证码',
  `money_num` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `tradeplat` varchar(30) NOT NULL DEFAULT '' COMMENT '交易平台',
  `tradeaccount` varchar(50) NOT NULL DEFAULT '' COMMENT '交易账号（话费充值是手机号）',
  `tradestatus` int(11) NOT NULL DEFAULT '0' COMMENT '交易状态（0:失败，1:成功）',
  `failreason` varchar(200) NOT NULL DEFAULT '' COMMENT '失败原因',
  `isdelete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除（0:未删除，1:已删除）',
  `add_time` datetime NOT NULL DEFAULT '1900-01-01' COMMENT '添加时间',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_traderecord
-- ----------------------------

-- ----------------------------
-- Table structure for `bxc_valifycode`
-- ----------------------------
DROP TABLE IF EXISTS `bxc_valifycode`;
CREATE TABLE `bxc_valifycode` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `activity_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '活动ID',
  `activity_name` varchar(100) NOT NULL DEFAULT '' COMMENT '活动名称',
  `valifycode` varchar(10) NOT NULL DEFAULT '' COMMENT '验证码',
  `money_num` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `is_used` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否使用（0：未使用，1：已使用）',
  `is_valified` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否验证（0：未验证，1：已验证）',
  `use_account` varchar(50) NOT NULL DEFAULT '' COMMENT '使用账号',
  `isdelete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除（0:未删除，1:已删除）',
  `isvalid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否有效（0:有效，1:无效）',
  `add_time` datetime NOT NULL DEFAULT '1900-01-01' COMMENT '添加时间',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_valifycode
-- ----------------------------
INSERT INTO `bxc_valifycode` VALUES ('31', '1', '领取红包', 'BRKOQB', '0.00', '0', '0', '', '0', '1', '2016-01-08 00:08:05', '2016-01-08 00:08:15');
INSERT INTO `bxc_valifycode` VALUES ('32', '1', '领取红包', 'K2DYUH', '1.00', '0', '1', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:38');
INSERT INTO `bxc_valifycode` VALUES ('33', '1', '领取红包', 'RDRC1T', '1.00', '1', '1', '18200273350', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:16:52');
INSERT INTO `bxc_valifycode` VALUES ('34', '1', '领取红包', '6NTZFU', '1.00', '1', '1', '18200273350', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:37:03');
INSERT INTO `bxc_valifycode` VALUES ('35', '1', '领取红包', '53DXMV', '1.00', '1', '1', '18200273350', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:45:01');
INSERT INTO `bxc_valifycode` VALUES ('36', '1', '领取红包', 'BDDK43', '2.00', '0', '1', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:45:42');
INSERT INTO `bxc_valifycode` VALUES ('37', '1', '领取红包', 'ZU5LIY', '5.00', '0', '1', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:46:21');
INSERT INTO `bxc_valifycode` VALUES ('38', '1', '领取红包', '8VLLPC', '2.00', '0', '1', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:46:49');
INSERT INTO `bxc_valifycode` VALUES ('39', '1', '领取红包', 'A0F08X', '20.00', '0', '1', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:46:58');
INSERT INTO `bxc_valifycode` VALUES ('40', '1', '领取红包', 'PBHJG9', '5.00', '0', '1', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:47:06');
INSERT INTO `bxc_valifycode` VALUES ('41', '1', '领取红包', 'NJYBT7', '1.00', '0', '1', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:47:14');
INSERT INTO `bxc_valifycode` VALUES ('42', '1', '领取红包', '2EK840', '1.00', '1', '1', '18200273350', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:52:14');
INSERT INTO `bxc_valifycode` VALUES ('43', '1', '领取红包', '1T05SP', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('44', '1', '领取红包', '08X419', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('45', '1', '领取红包', '0RDO7U', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('46', '1', '领取红包', 'WH13Y4', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('47', '1', '领取红包', 'MQCKKH', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('48', '1', '领取红包', 'HBXK5A', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('49', '1', '领取红包', 'DPPZW3', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('50', '1', '领取红包', '0D6GEW', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:08:05', '2016-01-08 00:08:05');
INSERT INTO `bxc_valifycode` VALUES ('51', '1601080010453799hd', '领取红包', 'GACV70', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('52', '1601080010453799hd', '领取红包', '6HNL5S', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('53', '1601080010453799hd', '领取红包', '3IEYER', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('54', '1601080010453799hd', '领取红包', 'IQXRJC', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('55', '1601080010453799hd', '领取红包', 'IJ4IHI', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('56', '1601080010453799hd', '领取红包', 'BFPORT', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('57', '1601080010453799hd', '领取红包', 'IHIXQX', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('58', '1601080010453799hd', '领取红包', '6GQGUM', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('59', '1601080010453799hd', '领取红包', 'C244W6', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('60', '1601080010453799hd', '领取红包', '28ASBM', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:12:18', '2016-01-08 00:12:18');
INSERT INTO `bxc_valifycode` VALUES ('61', '1601080010453799hd', '领取红包', 'EYIBWJ', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('62', '1601080010453799hd', '领取红包', 'N5U886', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('63', '1601080010453799hd', '领取红包', '5K0QAN', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('64', '1601080010453799hd', '领取红包', '5M83E9', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('65', '1601080010453799hd', '领取红包', 'GZZFYW', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('66', '1601080010453799hd', '领取红包', 'LH5YHA', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('67', '1601080010453799hd', '领取红包', '1PD72B', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('68', '1601080010453799hd', '领取红包', 'F08BF3', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('69', '1601080010453799hd', '领取红包', 'ZUJBAG', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
INSERT INTO `bxc_valifycode` VALUES ('70', '1601080010453799hd', '领取红包', 'JZM9LY', '0.00', '0', '0', '', '0', '0', '2016-01-08 00:13:26', '2016-01-08 00:13:26');
