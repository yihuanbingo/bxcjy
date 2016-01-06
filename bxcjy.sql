/*
Navicat MySQL Data Transfer

Source Server         : mytest
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : bxcjy

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-01-06 19:13:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bxc_activity`
-- ----------------------------
DROP TABLE IF EXISTS `bxc_activity`;
CREATE TABLE `bxc_activity` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_activity
-- ----------------------------
INSERT INTO `bxc_activity` VALUES ('2', '元旦来一波', '描述', '0', '0', '1', '0:20|1:20|2:20|5:20|10:20|20:0', 'test', '', '', '0', '0', '2016-01-06 18:51:49', '2016-01-06 18:51:49');

-- ----------------------------
-- Table structure for `bxc_rechargerecord`
-- ----------------------------
DROP TABLE IF EXISTS `bxc_rechargerecord`;
CREATE TABLE `bxc_rechargerecord` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `orderid` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `activity_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
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
  `activity_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
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
  `activity_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bxc_valifycode
-- ----------------------------
