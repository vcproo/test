/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : bill

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-12-02 16:21:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bill
-- ----------------------------
DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill` (
  `bill_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `type` int(11) DEFAULT NULL COMMENT '支出 1 收入2',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `outprice` decimal(10,0) DEFAULT '0' COMMENT '支出金额',
  `inprice` decimal(10,0) DEFAULT '0' COMMENT '收入金额',
  `label_id` int(11) DEFAULT NULL COMMENT '标签id',
  `year` int(11) DEFAULT NULL COMMENT '该账单的年份',
  `month` int(11) DEFAULT NULL COMMENT '该账单的月份',
  `day` int(11) DEFAULT NULL COMMENT '该账单的日期',
  `week` int(11) DEFAULT NULL COMMENT '星期 1表示星期一....',
  `time` datetime DEFAULT NULL COMMENT '该笔账单的日期',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL,
  `is_delete` int(11) DEFAULT '1' COMMENT '1正常 2删除',
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bill
-- ----------------------------
INSERT INTO `bill` VALUES ('1', '1', '1', '早饭', '8', '0', '1', '2021', '11', '25', '4', '2021-11-25 11:17:15', '2021-11-26 11:17:26', '2021-11-26 11:17:28', '1');
INSERT INTO `bill` VALUES ('2', '1', '1', '午饭', '15', '0', '1', '2021', '11', '25', '4', '2021-11-25 11:17:59', '2021-11-26 11:18:02', '2021-11-26 11:18:06', '1');
INSERT INTO `bill` VALUES ('3', '1', '1', '晚饭', '100', '0', '1', '2021', '11', '25', '4', '2021-11-25 11:18:27', '2021-11-26 11:18:31', '2021-11-26 11:18:33', '1');
INSERT INTO `bill` VALUES ('4', '1', '1', '早饭', '6', '0', '1', '2021', '11', '26', '5', '2021-11-26 11:18:51', '2021-11-26 11:18:54', '2021-11-26 11:18:56', '1');
INSERT INTO `bill` VALUES ('5', '1', '1', '午饭', '20', '0', '1', '2021', '11', '26', '5', '2021-11-26 11:20:04', '2021-11-26 11:20:07', '2021-11-26 11:20:09', '1');
INSERT INTO `bill` VALUES ('6', '1', '2', '兼职', '0', '50', '16', '2021', '11', '26', '5', '2021-11-26 11:21:15', '2021-11-26 11:21:19', '2021-11-26 11:21:24', '1');
INSERT INTO `bill` VALUES ('7', '1', '1', '购物', '80', '0', '4', '2021', '11', '26', '5', '2021-11-26 11:22:01', '2021-11-26 11:22:05', '2021-11-26 11:22:07', '1');
INSERT INTO `bill` VALUES ('8', '1', '1', '购物', '20', '0', '4', '2021', '11', '25', '4', '2021-11-25 11:22:24', '2021-11-26 11:22:28', '2021-11-26 11:22:31', '1');

-- ----------------------------
-- Table structure for family
-- ----------------------------
DROP TABLE IF EXISTS `family`;
CREATE TABLE `family` (
  `family_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '家庭id',
  `name_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '编码',
  `create_id` int(11) DEFAULT NULL COMMENT '创建id',
  `is_delete` int(10) DEFAULT '1' COMMENT '1正常 2删除',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`family_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of family
-- ----------------------------

-- ----------------------------
-- Table structure for family_user
-- ----------------------------
DROP TABLE IF EXISTS `family_user`;
CREATE TABLE `family_user` (
  `family_user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) DEFAULT NULL COMMENT '家庭id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `is_delete` int(10) DEFAULT '1' COMMENT '1正常2删除',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`family_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of family_user
-- ----------------------------

-- ----------------------------
-- Table structure for label
-- ----------------------------
DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `label_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标签名称',
  `zt` int(11) DEFAULT '1' COMMENT ' 1支出 2收入',
  `is_delete` int(10) DEFAULT '1' COMMENT '1正常2删除',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL,
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`label_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of label
-- ----------------------------
INSERT INTO `label` VALUES ('1', '餐饮', '1', '1', '2021-11-16 14:51:27', null, '1');
INSERT INTO `label` VALUES ('2', '交通', '1', '1', '2021-11-16 14:51:33', null, '2');
INSERT INTO `label` VALUES ('3', '服饰', '1', '1', '2021-11-16 14:51:38', null, '3');
INSERT INTO `label` VALUES ('4', '购物', '1', '1', '2021-11-16 14:51:35', null, '4');
INSERT INTO `label` VALUES ('5', '服务', '2', '1', '2021-11-16 14:51:44', null, '5');
INSERT INTO `label` VALUES ('6', '教育', '1', '1', '2021-11-16 14:51:47', null, '6');
INSERT INTO `label` VALUES ('7', '娱乐', '1', '1', '2021-11-16 14:51:50', null, '7');
INSERT INTO `label` VALUES ('8', '运动', '1', '1', '2021-11-16 14:51:53', null, '8');
INSERT INTO `label` VALUES ('9', '生活缴费', '1', '1', '2021-11-16 14:51:55', null, '9');
INSERT INTO `label` VALUES ('10', '旅行', '1', '1', '2021-11-16 14:51:57', null, '10');
INSERT INTO `label` VALUES ('11', '宠物', '1', '1', '2021-11-16 14:52:00', null, '11');
INSERT INTO `label` VALUES ('12', '保险', '1', '1', '2021-11-16 14:52:02', null, '12');
INSERT INTO `label` VALUES ('13', '房租', '1', '1', '2021-11-16 14:52:05', null, '13');
INSERT INTO `label` VALUES ('14', '还贷', '1', '1', '2021-11-16 14:52:07', null, '14');
INSERT INTO `label` VALUES ('15', '其他', '1', '1', '2021-11-16 14:52:11', null, '15');
INSERT INTO `label` VALUES ('16', '工资', '2', '1', '2021-11-17 15:07:24', null, '16');
INSERT INTO `label` VALUES ('17', '股票/基金', '2', '1', '2021-11-17 15:07:28', null, '17');
INSERT INTO `label` VALUES ('18', '副业', '2', '1', '2021-11-17 15:07:31', null, '18');
INSERT INTO `label` VALUES ('19', '其他', '2', '1', '2021-11-17 15:07:33', null, '19');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户名',
  `headimg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像',
  `is_lable` int(10) DEFAULT '0' COMMENT '是否自定义标签 0否 1是 如果是则查询user_lable表',
  `status` int(10) DEFAULT '1' COMMENT '状态 1正常 2禁用',
  `is_delete` int(10) DEFAULT '1' COMMENT '是否删除 1正常 2删除',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '张三', null, '0', '1', '1', '2021-11-16 14:47:07', null);

-- ----------------------------
-- Table structure for user_label
-- ----------------------------
DROP TABLE IF EXISTS `user_label`;
CREATE TABLE `user_label` (
  `label_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL COMMENT '用户id',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标签标题',
  `zt` int(10) DEFAULT '1' COMMENT '1支出 2收入',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `is_delete` int(10) DEFAULT '1' COMMENT '是否删除 1正常 2删除',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`label_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_label
-- ----------------------------
INSERT INTO `user_label` VALUES ('1', '1', '购买基金', '1', '1', '2021-11-26 10:07:56', '1', '2021-11-26 10:08:04');
INSERT INTO `user_label` VALUES ('2', '1', '基金盈利', '2', '2', '2021-11-26 10:08:32', '1', '2021-11-26 10:08:36');
