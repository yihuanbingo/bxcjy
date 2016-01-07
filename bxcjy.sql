/*
Navicat MySQL Data Transfer

Source Server         : mytest
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : bxcjy

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-01-07 18:13:27
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
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_activity
-- ----------------------------
INSERT INTO `bxc_activity` VALUES ('1601071539191946hd', '大活动', '阿斯达打死', '0', '0', '0', '1', 'qwe', '', '', '0', '0', '2016-01-07 15:39:22', '2016-01-07 15:39:22');
INSERT INTO `bxc_activity` VALUES ('1601071551152795hd', '123123123', '123123123', '0', '0', '0', '1', '123123', 'http://hd.bxcjy.com/?activity_id=1601071551152795hd', '', '0', '0', '2016-01-07 15:51:15', '2016-01-07 15:51:15');
INSERT INTO `bxc_activity` VALUES ('2', '元旦来一波', '描述', '0', '0', '1', '0:20|1:20|2:20|5:20|10:20|20:0', 'test', '', '', '0', '0', '2016-01-06 18:51:49', '2016-01-07 15:36:27');

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
  `message` varchar(200) NOT NULL DEFAULT '' COMMENT '返回消息',
  `isdelete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除（0:未删除，1:已删除）',
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_rechargerecord
-- ----------------------------

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
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
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
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_valifycode
-- ----------------------------
INSERT INTO `bxc_valifycode` VALUES ('11', '1601071539191946hd', '大活动', 'A0IZCI', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('12', '1601071539191946hd', '大活动', 'X1VFTT', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('13', '1601071539191946hd', '大活动', '999KBZ', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('14', '1601071539191946hd', '大活动', 'WZD0RA', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('15', '1601071539191946hd', '大活动', 'BDH6HI', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('16', '1601071539191946hd', '大活动', '5XOEC7', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('17', '1601071539191946hd', '大活动', 'AI694S', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('18', '1601071539191946hd', '大活动', '8RJQM0', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('19', '1601071539191946hd', '大活动', 'EBWN0Y', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('20', '1601071539191946hd', '大活动', '7X9O3K', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:06', '2016-01-07 15:40:06');
INSERT INTO `bxc_valifycode` VALUES ('21', '2', '元旦来一波', 'GXOSGO', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('22', '2', '元旦来一波', 'JBLESC', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('23', '2', '元旦来一波', 'Q11L73', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('24', '2', '元旦来一波', 'BBUIA7', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('25', '2', '元旦来一波', '0S0GJV', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('26', '2', '元旦来一波', '2US8KJ', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('27', '2', '元旦来一波', 'LT4AA5', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('28', '2', '元旦来一波', 'SBP57B', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('29', '2', '元旦来一波', '8BFIOL', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
INSERT INTO `bxc_valifycode` VALUES ('30', '2', '元旦来一波', '1MEH6V', '0.00', '0', '0', '', '0', '0', '2016-01-07 15:40:36', '2016-01-07 15:40:36');
