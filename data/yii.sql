-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+08:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限列表(仅对数据库表的字段)';

INSERT INTO `access` (`id`, `name`, `pid`) VALUES
(1,	'admin.auth',	0),
(2,	'index',	1),
(3,	'admin.category',	0),
(4,	'index',	3),
(5,	'create',	3),
(6,	'update',	3),
(7,	'admin.default',	0),
(8,	'index',	7),
(9,	'admin.group',	0),
(10,	'bind',	9),
(11,	'create',	9),
(12,	'update',	9),
(13,	'delete',	9),
(14,	'index',	9),
(15,	'admin.language',	0),
(16,	'index',	15),
(17,	'create',	15),
(18,	'update',	15),
(19,	'admin.login',	0),
(20,	'index',	19),
(21,	'admin.module',	0),
(22,	'index',	21),
(23,	'install',	21),
(24,	'admin.user',	0),
(25,	'view',	24),
(26,	'create',	24),
(27,	'update',	24),
(28,	'delete',	24),
(29,	'index',	24),
(30,	'album.default',	0),
(31,	'index',	30),
(32,	'create',	30),
(33,	'update',	30),
(34,	'sort',	30),
(35,	'album.image',	0),
(36,	'index',	35),
(37,	'sort',	35),
(38,	'backup.default',	0),
(39,	'index',	38),
(40,	'do',	38),
(41,	'i18n.default',	0),
(42,	'index',	41),
(43,	'image.manage',	0),
(44,	'index',	43),
(45,	'menu.default',	0),
(46,	'index',	45),
(47,	'create',	45),
(48,	'update',	45),
(49,	'sort',	45),
(50,	'node.default',	0),
(51,	'index',	50),
(52,	'create',	50),
(53,	'update',	50),
(54,	'delete',	50),
(55,	'sort',	50),
(56,	'node.field',	0),
(57,	'delete',	56),
(58,	'sort',	56),
(59,	'node.query',	0),
(60,	'index',	59),
(61,	'create',	59),
(62,	'update',	59),
(63,	'delete',	59),
(64,	'sort',	59),
(65,	'post.default',	0),
(66,	'index',	65),
(67,	'create',	65),
(68,	'update',	65),
(69,	'delete',	65),
(70,	'sort',	65),
(71,	'seo.default',	0),
(72,	'index',	71),
(73,	'create',	71),
(74,	'update',	71),
(75,	'video.default',	0),
(76,	'view',	75),
(77,	'index',	75),
(78,	'create',	75),
(79,	'update',	75),
(80,	'delete',	75),
(81,	'sort',	75);

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `uid` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `body` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `albums` (`id`, `name`, `display`, `uid`, `created`, `updated`, `body`, `sort`) VALUES
(1,	'默认',	1,	0,	0,	0,	'<p>这是测试相册</p>',	0),
(2,	'test',	1,	0,	0,	0,	'',	0);

DROP TABLE IF EXISTS `album_images`;
CREATE TABLE `album_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `album_images` (`id`, `album_id`, `fid`, `sort`) VALUES
(1,	1,	2,	69),
(2,	1,	1,	71),
(3,	1,	2,	73),
(4,	1,	3,	76),
(5,	1,	4,	70),
(6,	1,	5,	79),
(7,	1,	6,	72),
(8,	1,	1,	74),
(9,	1,	2,	81),
(10,	1,	3,	75),
(11,	1,	4,	78),
(12,	1,	7,	77),
(13,	1,	6,	49),
(14,	1,	5,	51),
(15,	1,	6,	55),
(16,	1,	1,	59),
(17,	1,	2,	61),
(18,	1,	3,	62),
(19,	1,	4,	63),
(20,	1,	5,	64),
(21,	1,	6,	80),
(22,	1,	1,	57),
(23,	1,	2,	65),
(24,	1,	3,	66),
(25,	1,	4,	67),
(26,	1,	7,	68),
(27,	1,	5,	1),
(28,	1,	6,	4),
(29,	1,	1,	28),
(30,	1,	2,	34),
(31,	1,	3,	40),
(32,	1,	4,	46),
(33,	1,	5,	7),
(34,	1,	6,	10),
(35,	1,	1,	13),
(36,	1,	2,	16),
(37,	1,	3,	19),
(38,	1,	4,	22),
(39,	1,	7,	25),
(40,	1,	5,	29),
(41,	1,	6,	31),
(42,	1,	1,	35),
(43,	1,	2,	37),
(44,	1,	3,	41),
(45,	1,	4,	43),
(46,	1,	7,	47),
(47,	1,	5,	5),
(48,	1,	6,	11),
(49,	1,	1,	17),
(50,	1,	2,	23),
(51,	1,	3,	32),
(52,	1,	4,	38),
(53,	1,	7,	44),
(54,	1,	5,	48),
(55,	1,	6,	50),
(56,	1,	1,	52),
(57,	1,	2,	53),
(58,	1,	3,	54),
(59,	1,	4,	56),
(60,	1,	7,	58),
(61,	1,	5,	60),
(62,	1,	6,	18),
(63,	1,	1,	2),
(64,	1,	2,	6),
(65,	1,	3,	8),
(66,	1,	4,	12),
(67,	1,	7,	14),
(68,	1,	5,	15),
(69,	1,	6,	20),
(70,	1,	1,	24),
(71,	1,	2,	26),
(72,	1,	3,	30),
(73,	1,	4,	33),
(74,	1,	7,	36),
(75,	1,	5,	39),
(76,	1,	6,	42),
(77,	1,	1,	45),
(78,	1,	2,	3),
(79,	1,	3,	9),
(80,	1,	4,	21),
(81,	1,	7,	27);

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `fullpath` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `uniqid` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `attachments` (`id`, `name`, `fullpath`, `size`, `type`, `created`, `uid`, `sort`, `display`, `uniqid`, `is_admin`) VALUES
(1,	'upload/2013/12/30/1ece12c94ca288c4fd355633c9ad949e.jpg',	'upload/2013/12/30/1ece12c94ca288c4fd355633c9ad949e.jpg',	775702,	'image/jpeg',	1388395621,	1,	0,	1,	'5a44c7ba5bbe4ec867233d67e4806848',	1),
(2,	'upload/2013/12/30/c71b7d0243d362059203ea601f213815.jpg',	'upload/2013/12/30/c71b7d0243d362059203ea601f213815.jpg',	780831,	'image/jpeg',	1388396349,	1,	0,	1,	'2b04df3ecc1d94afddff082d139c6f15',	1),
(3,	'upload/2013/12/30/73697df6eb54f56c10d4e9c7ac32d215.jpg',	'upload/2013/12/30/73697df6eb54f56c10d4e9c7ac32d215.jpg',	561276,	'image/jpeg',	1388396357,	1,	0,	1,	'8969288f4245120e7c3870287cce0ff3',	1),
(4,	'upload/2013/12/30/eafc093b541f0031139abe3e0d28a8dd.jpg',	'upload/2013/12/30/eafc093b541f0031139abe3e0d28a8dd.jpg',	777835,	'image/jpeg',	1388396358,	1,	0,	1,	'9d377b10ce778c4938b3c7e2c63a229a',	1),
(5,	'upload/2013/12/30/7cba443debd0a38020b6c97134166047.jpg',	'upload/2013/12/30/7cba443debd0a38020b6c97134166047.jpg',	845941,	'image/jpeg',	1388397003,	1,	0,	1,	'ba45c8f60456a672e003a875e469d0eb',	1),
(6,	'upload/2013/12/30/0f911ac595895aa6b9de67e2abfe735e.jpg',	'upload/2013/12/30/0f911ac595895aa6b9de67e2abfe735e.jpg',	595284,	'image/jpeg',	1388397003,	1,	0,	1,	'bdf3bf1da3405725be763540d6601144',	1),
(7,	'upload/2013/12/30/a8ab9b3a5b074a2c0575db6cadefeeb6.jpg',	'upload/2013/12/30/a8ab9b3a5b074a2c0575db6cadefeeb6.jpg',	879394,	'image/jpeg',	1388397005,	1,	0,	1,	'076e3caed758a1c18c91a0e9cae3368f',	1);

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `name`, `pid`, `display`) VALUES
(1,	'城市',	0,	1),
(2,	'上海',	1,	1),
(3,	'北京',	1,	1),
(4,	'浦东',	2,	1),
(5,	'路家嘴',	4,	1);

DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `configs` (`id`, `name`, `body`) VALUES
(1,	'title',	'aa'),
(2,	'seo',	'adfadf'),
(3,	'mlanguage',	'1');

DROP TABLE IF EXISTS `field_post`;
CREATE TABLE `field_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `vid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `one` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `field_post` (`id`, `uid`, `created`, `updated`, `sort`, `language_id`, `display`, `vid`, `title`, `one`, `uuid`) VALUES
(1,	1,	1389350377,	1389350377,	0,	0,	1,	'182774377061923147',	'test',	1,	''),
(2,	1,	1389350397,	1389350397,	0,	0,	1,	'182774397444233068',	'test',	1,	''),
(3,	1,	0,	1389350467,	0,	1,	1,	'182774397444233068',	'test',	3,	''),
(4,	1,	0,	1389350679,	0,	3,	1,	'182774651798747122',	'test3333',	3,	''),
(5,	1,	1389350699,	1389352290,	0,	4,	1,	'182774699472803029',	'aaa',	2,	''),
(6,	1,	1389351068,	1389352337,	0,	2,	1,	'182775068758763012',	'bbb',	3,	'ADMIN-PC52cfd09cb95b11.46336760'),
(7,	1,	0,	1389352354,	0,	3,	1,	'182775068758763012',	'bbb_韩国',	3,	'');

DROP TABLE IF EXISTS `field_post_more`;
CREATE TABLE `field_post_more` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `field_post_more` (`id`, `nid`, `value`) VALUES
(1,	2,	1),
(2,	3,	1),
(3,	4,	1),
(11,	6,	1),
(9,	5,	1);

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) NOT NULL COMMENT '唯一标识',
  `name` varchar(200) NOT NULL COMMENT '用户组名',
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组信息';

INSERT INTO `groups` (`id`, `slug`, `name`, `pid`) VALUES
(1,	'admin',	'管理员',	0),
(2,	'test',	'测试 ',	1);

DROP TABLE IF EXISTS `group_access`;
CREATE TABLE `group_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  `access_id` int(11) NOT NULL COMMENT '权限列表ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与权限列表 关系';

INSERT INTO `group_access` (`id`, `group_id`, `access_id`) VALUES
(1,	1,	2),
(2,	1,	4),
(3,	1,	5),
(4,	1,	8),
(5,	1,	42),
(6,	1,	62),
(7,	1,	63),
(8,	1,	68),
(9,	1,	76);

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '注释为 中文 英文 等',
  `code` varchar(20) NOT NULL COMMENT '如zh_cn  en_us 等',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `languages` (`id`, `name`, `code`, `display`, `is_default`, `sort`) VALUES
(1,	'简体中文',	'zh_cn',	1,	0,	0),
(2,	'英文',	'en_us',	1,	1,	0),
(3,	'韩语',	'ko',	1,	0,	0),
(4,	'意大利语',	'it',	1,	0,	0),
(5,	'西班牙语',	'es',	1,	0,	0),
(6,	'德语',	'de',	1,	0,	0),
(7,	'法语',	'fr',	1,	0,	0),
(8,	'日语',	'ja',	1,	0,	0);

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `display` tinyint(4) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `menus` (`id`, `name`, `url`, `pid`, `is_admin`, `display`, `sort`) VALUES
(1,	'user',	'admin/user/index',	11,	1,	1,	22),
(2,	'category',	'admin/category/index',	11,	1,	1,	12),
(3,	'post',	'post/default/index',	0,	1,	1,	11),
(4,	'video',	'video/default/index',	0,	1,	1,	5),
(5,	'album',	'album/default/index',	0,	1,	1,	7),
(6,	'menu',	'menu/default/index',	11,	1,	1,	8),
(7,	'node',	'node/default/index',	0,	1,	1,	4),
(8,	'seo',	'seo/default/index',	11,	1,	1,	9),
(9,	'i18n',	'i18n/default/index',	11,	1,	1,	10),
(14,	'home',	'site/index',	0,	0,	1,	20),
(10,	'backup',	'backup/default/index',	11,	1,	1,	1),
(11,	'system',	'admin/default/index',	0,	1,	1,	3),
(12,	'language',	'admin/language/index',	11,	1,	1,	2),
(13,	'file manage',	'image/manage/index',	11,	1,	1,	6),
(15,	'Why MM',	'site/why',	0,	0,	1,	19),
(16,	'Chineses Programs',	'site/pro',	0,	0,	1,	18),
(17,	'Learn at School',	'site/learn',	0,	0,	1,	17),
(18,	'Learm Online',	'site/online',	0,	0,	1,	16),
(19,	'Community',	'site/bbs',	0,	0,	1,	15),
(20,	'Contact',	'site/contact',	0,	0,	1,	14),
(21,	'用户组',	'admin/group/index',	11,	1,	1,	21),
(22,	'模块管理',	'admin/module/index',	11,	1,	1,	13);

DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `label` varchar(50) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `core` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `modules` (`id`, `name`, `label`, `memo`, `core`, `active`, `sort`) VALUES
(31,	'album',	'',	'',	0,	1,	0),
(28,	'admin',	'',	'',	0,	1,	0),
(29,	'menu',	'',	'',	1,	1,	0),
(30,	'image',	'',	'',	1,	1,	0),
(32,	'i18n',	'',	'',	1,	1,	0);

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

INSERT INTO `node_content` (`id`, `name`, `discription`, `sort`, `created`, `updated`, `display`) VALUES
(1,	'post',	'文章',	0,	0,	0,	1);

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

INSERT INTO `node_field` (`id`, `node_content_id`, `name`, `widget`, `type`, `value`, `search`, `indexes`, `sort`, `display`, `rules`, `automodel`, `default_value`, `label`, `memo`, `relation`, `mvalue`, `mysql_ext`) VALUES
(1,	1,	'title',	'a:0:{}',	'input',	'',	0,	1,	0,	1,	'a:1:{s:8:\"required\";i:1;}',	'a:0:{}',	'',	'标题',	'',	'',	0,	''),
(4,	1,	'one',	'',	'relation',	'',	0,	0,	0,	1,	'a:1:{s:8:\"required\";i:1;}',	'',	'',	'一个',	'',	'category.name',	0,	''),
(5,	1,	'more',	'',	'relation',	'',	0,	0,	0,	1,	'',	'',	'',	'多个',	'',	'users.username',	1,	'');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `vid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `title`, `body`, `category_id`, `uid`, `created`, `updated`, `sort`, `language_id`, `display`, `vid`) VALUES
(1,	'式样',	'<p>aaaa</p>',	2,	1,	1388144525,	1388144525,	6,	1,	1,	'181568525781884114'),
(2,	'新的',	'<p>测试</p>',	3,	1,	1388144602,	1388144602,	1,	1,	1,	'181568602983675001'),
(3,	'新的 news',	'<p>new</p>',	3,	1,	0,	1388144615,	2,	2,	1,	'181568602983675001'),
(4,	'测试',	'<p>测试内容</p>',	5,	1,	1388144794,	1388144794,	3,	1,	1,	'181568794551728061'),
(6,	'test',	'<p>test</p>',	5,	1,	0,	1388144834,	4,	2,	1,	'181568794551728061');

DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(255) NOT NULL,
  `route_to` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `seo` (`id`, `description`, `keywords`, `url`, `display`) VALUES
(1,	'这里面描述',	'默认关键词2',	'',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT '登录使用的EMAIL',
  `password` varchar(100) NOT NULL COMMENT '加密后的密码',
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否激活',
  `active_code` varchar(200) NOT NULL COMMENT '用户激活码',
  `yourself` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否只有操作自己添加的数据权限。1为是',
  `created` int(11) NOT NULL COMMENT '创建时间',
  `updated` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户(管理员)';

INSERT INTO `users` (`id`, `username`, `email`, `password`, `active`, `active_code`, `yourself`, `created`, `updated`) VALUES
(1,	'admin',	'yiiphp@qq.com',	'$2a$13$.AqT2YJn7l0ASBKUPbHXMOUG4QskxqrRNhxhFYRVdOvyTSm7bdIB.',	0,	'',	1,	1389415839,	1389415839);

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户与组 对应关系';

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(9,	1,	2),
(8,	1,	1);

DROP TABLE IF EXISTS `user_reset`;
CREATE TABLE `user_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `update` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `vid` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `videos` (`id`, `title`, `body`, `image`, `video`, `created`, `update`, `uid`, `display`, `vid`, `sort`, `language_id`) VALUES
(1,	'test',	'<p><img src=\"/imagine/upload/2013/12/30/1ece12c94ca288c4fd355633c9ad949e=image_fuel1c407a4560e26f474a8efe3045458164.jpg\" /></p>',	'upload/2013/12/30/0f911ac595895aa6b9de67e2abfe735e.jpg',	'upload/ftp/1.mp4',	1388486084,	0,	1,	1,	'181911513516918033',	0,	1);

-- 2014-01-11 17:26:10
