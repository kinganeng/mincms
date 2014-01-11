-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+08:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `node_content`;
CREATE TABLE `node_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `discription` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `node_field`;
CREATE TABLE `node_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_content_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `widget` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `search` tinyint(1) NOT NULL DEFAULT '0',
  `indexes` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  `automodel` text NOT NULL,
  `default_value` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL DEFAULT '' COMMENT '关联表,file.id.* *为当前字段',
  `mvalue` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为多值',
  `mysql_ext` varchar(200) NOT NULL COMMENT '字段创建说明 如varchar(200)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2014-01-11 17:30:28