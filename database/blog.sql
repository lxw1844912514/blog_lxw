-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?08 �?20 �?17:11
-- 服务器版本: 5.5.53
-- PHP 版本: 7.1.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_permissions`
--

CREATE TABLE IF NOT EXISTS `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'system', '系统管理', '2018-07-13 03:27:27', '2018-07-13 03:27:27'),
(2, 'post', '文章管理', '2018-07-13 03:27:55', '2018-07-13 03:27:55'),
(3, 'topic', '专题管理', '2018-07-13 03:28:18', '2018-07-13 03:28:18'),
(4, 'notice', '通知管理', '2018-07-13 03:28:32', '2018-07-13 03:28:32'),
(5, 'file', '文件管理', '2018-07-17 07:39:04', '2018-07-17 07:39:04');

-- --------------------------------------------------------

--
-- 表的结构 `admin_permission_role`
--

CREATE TABLE IF NOT EXISTS `admin_permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `admin_permission_role`
--

INSERT INTO `admin_permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(7, 4, 5),
(8, 3, 4),
(9, 2, 3),
(10, 5, 1),
(11, 3, 5);

-- --------------------------------------------------------

--
-- 表的结构 `admin_roles`
--

CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin_manager', '超级管理员', '2018-07-13 03:32:35', '2018-07-13 03:32:35'),
(2, 'system_manager', '系统管理员', '2018-07-13 03:33:09', '2018-07-13 03:33:09'),
(3, 'post_manager', '文章管理员', '2018-07-13 03:33:30', '2018-07-13 03:33:30'),
(4, 'topics_manager', '专题管理员', '2018-07-13 05:09:36', '2018-07-13 05:09:36'),
(5, 'notics_manager', '通知管理员', '2018-07-13 05:10:22', '2018-07-13 05:10:22');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_user`
--

CREATE TABLE IF NOT EXISTS `admin_role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `admin_role_user`
--

INSERT INTO `admin_role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 1, 8),
(2, 2, 1),
(3, 3, 7),
(4, 1, 10),
(5, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1正常 -1：失效',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `avatar`, `created_at`, `updated_at`, `status`) VALUES
(4, 'admin12366', 'lixiaowang@welltrend.com.cn', '$2y$10$lr5s6irvZywh5oLYAnHov.xYjnpiTHLS1aBo/S58xws4Igp9Jcr92', '/storage/2018-07-19/BspKrNGkcS9wOAROHOoCAnQg4x1crrvfZFvN4WJV.jpeg', '2018-07-11 09:22:22', '2018-08-16 09:42:09', 1),
(5, 'admin123', 'admin123@qq.com', '$2y$10$fwCeS.3y6bWVe6gYVGSwIu6gJ8kvgq5HupxQEQh8UCuptYgGs.g6.', '/storage/2018-07-19/iHO6WfR8sAY7eRnmfrsP3Qtqp8DkKr3NFv5MCxSc.jpeg', '2018-07-12 01:26:10', '2018-07-25 06:45:33', 1),
(6, 'admin1', 'admin1@qq.com', '$2y$10$cz4O0G26HTUBkTXv2zlYl.QELSUIegGUSLC8h2R65j0Pw89bJWZgG', '\\storage\\2018-07-24/20180226笔记.txt', '2018-07-12 02:37:53', '2018-07-25 06:45:35', 1),
(7, 'lxw2', 'lxw@qq.com', '$2y$10$qRQc30Cgsz0VfXhBlhdUOeKPaunl4lsWfXv6ZC2KeItDeeh8vvsDC', '/storage/2018-07-17/hUJsX4ISzOuGWtDrBfNONRIWvGiwQlxBubYEiehG.jpeg', '2018-07-12 02:42:24', '2018-07-25 06:54:02', 1),
(1, 'admin', 'admin@qq.com', '$2y$10$05cYCzgkFhRmSJI3xat/geMMjrQ7ixFOKcUNk.2nG/CdeI5F2Oxe2', '/storage/2018-07-17/I5opVaUmGBnd4dr7nfBWLssx9QZ5YOZTJi1HRhz0.jpeg', '2018-07-12 02:44:42', '2018-07-24 09:20:45', 1),
(10, 'lxw', '1844912514@qq.com', '$2y$10$gDe0j0e.QmJoyl0qmT4wGeBXMS6VGQ10UCyTXeRzUCJ7SdmGkEqG.', '/storage/2018-07-24/UQ8ZdZYAUew0DWrlGEIHEo9MPRixtrksbyvSXCpf.jpeg', '2018-06-24 01:28:28', '2018-05-17 05:16:39', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ceshi`
--

CREATE TABLE IF NOT EXISTS `ceshi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'this is test',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 6, 37, 'dddddd', '2018-07-05 06:31:26', '2018-07-05 06:31:26'),
(2, 6, 37, '这是第二条评论', '2018-07-05 06:55:50', '2018-07-05 06:55:50'),
(3, 6, 39, '不需要指定模型的动作', '2018-07-05 07:00:32', '2018-07-05 07:00:32'),
(4, 6, 39, '不需要指定模型的动作', '2018-07-05 07:00:36', '2018-07-05 07:00:36'),
(5, 5, 39, 'gsdfg', '2018-07-11 05:20:02', '2018-07-11 05:20:02');

-- --------------------------------------------------------

--
-- 表的结构 `db_import`
--

CREATE TABLE IF NOT EXISTS `db_import` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telphone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `E-mail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `db_import`
--

INSERT INTO `db_import` (`id`, `name`, `job`, `phone`, `telphone`, `E-mail`, `source`, `time`, `recard`) VALUES
(1, 'lxw/天津', 'php', '18227111', '010-555', '4444444@qq.com', '今日头条', '07-20-18', '已记录4'),
(2, '敏/北京', 'php', '1881008', '010-111111', '1111111@qq.com', '微信', '07-20-18', '已记录1'),
(3, '帅/北京', 'php', '1838792', '010-22222', '222222@qq.com', '电梯框架', '07-20-18', '已记录2'),
(4, '李先生/天津', 'php', '13500334', '010-33333', '33333@qq.com', '今日头条', '07-20-18', '已记录3'),
(5, '寇女士/天津', 'php', '18227111', '010-44444', '4444444@qq.com', '今日头条', '07-20-18', '已记录4'),
(6, 'lxw/天津', 'php', '18227111', '010-555', '4444444@qq.com', '今日头条', '07-20-18', '已记录4'),
(7, '敏/北京', 'php', '1881008', '010-111111', '1111111@qq.com', '微信', '07-20-18', '已记录1'),
(8, '帅/北京', 'php', '1838792', '010-22222', '222222@qq.com', '电梯框架', '07-20-18', '已记录2'),
(9, '李先生/天津', 'php', '13500334', '010-33333', '33333@qq.com', '今日头条', '07-20-18', '已记录3'),
(10, '寇女士/天津', 'php', '18227111', '010-44444', '4444444@qq.com', '今日头条', '07-20-18', '已记录4'),
(11, 'lxw/天津', 'php', '18227111', '010-555', '4444444@qq.com', '今日头条', '07-20-18', '已记录4'),
(12, '敏/北京', 'php', '1881008', '010-111111', '1111111@qq.com', '微信', '07-20-18', '已记录1'),
(13, '帅/北京', 'php', '1838792', '010-22222', '222222@qq.com', '电梯框架', '07-20-18', '已记录2'),
(14, '李先生/天津', 'php', '13500334', '010-33333', '33333@qq.com', '今日头条', '07-20-18', '已记录3'),
(15, '寇女士/天津', 'php', '18227111', '010-44444', '4444444@qq.com', '今日头条', '07-20-18', '已记录4');

-- --------------------------------------------------------

--
-- 表的结构 `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fans`
--

CREATE TABLE IF NOT EXISTS `fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fan_id` int(11) NOT NULL DEFAULT '0',
  `star_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `fans`
--

INSERT INTO `fans` (`id`, `fan_id`, `star_id`, `created_at`, `updated_at`) VALUES
(12, 6, 5, '2018-07-12 05:19:40', '2018-07-12 05:19:40'),
(10, 5, 6, '2018-07-10 06:56:41', '2018-07-10 06:56:41'),
(14, 4, 6, '2018-07-24 01:08:20', '2018-07-24 01:08:20'),
(15, 18, 6, '2018-08-06 08:57:06', '2018-08-06 08:57:06'),
(16, 22, 18, '2018-08-08 04:49:37', '2018-08-08 04:49:37'),
(17, 18, 26, '2018-08-08 05:39:04', '2018-08-08 05:39:04');

-- --------------------------------------------------------

--
-- 表的结构 `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `flights`
--

INSERT INTO `flights` (`id`, `name`, `airline`, `created_at`, `updated_at`) VALUES
(1, 'jpD2RQBSu5', '4WXZw2STRV@qq.com', NULL, NULL),
(2, 'yO6Ry5foAn', 'G6gzNKL6tX@qq.com', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=259 ;

--
-- 转存表中的数据 `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(257, 'default', '{"displayName":"App\\\\Jobs\\\\SendEmail","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmail","command":"O:18:\\"App\\\\Jobs\\\\SendEmail\\":8:{s:7:\\"\\u0000*\\u0000user\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:13:\\"App\\\\AdminUser\\";s:2:\\"id\\";i:4;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1534412529, 1534412529),
(256, 'default', '{"displayName":"App\\\\Jobs\\\\SendEmail","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmail","command":"O:18:\\"App\\\\Jobs\\\\SendEmail\\":8:{s:7:\\"\\u0000*\\u0000user\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:13:\\"App\\\\AdminUser\\";s:2:\\"id\\";i:4;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 255, NULL, 1534412526, 1534412526),
(258, 'default', '{"displayName":"App\\\\Jobs\\\\SendEmail","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmail","command":"O:18:\\"App\\\\Jobs\\\\SendEmail\\":8:{s:7:\\"\\u0000*\\u0000user\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":4:{s:5:\\"class\\";s:13:\\"App\\\\AdminUser\\";s:2:\\"id\\";i:10;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";}s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1534482999, 1534482999);

-- --------------------------------------------------------

--
-- 表的结构 `laravel_sms`
--

CREATE TABLE IF NOT EXISTS `laravel_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `temp_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `voice_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fail_times` mediumint(9) NOT NULL DEFAULT '0',
  `last_fail_time` int(10) unsigned NOT NULL DEFAULT '0',
  `sent_time` int(10) unsigned NOT NULL DEFAULT '0',
  `result_info` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_06_12_132002_create_sessions_table', 2),
(4, '2018_06_15_162435_create_flights_tables', 3),
(5, '2018_06_29_101021_create_ceshi_table', 4),
(6, '2018_07_05_135219_create_comments_table', 5),
(7, '2018_07_05_150454_create_zans_table', 6),
(8, '2018_07_09_163122_create_fans_table', 7),
(9, '2018_07_10_151145_create_topics_table', 8),
(10, '2018_07_10_151503_create_post_topic_table', 9),
(11, '2018_07_11_153847_create_admin_users_table', 10),
(12, '2018_07_12_113148_alter_posts_table', 11),
(13, '2018_07_12_152930_create_role_and_permission_table', 12),
(14, '2018_07_13_152058_create_notics_table', 13),
(15, '2018_07_13_162904_create_jobs_table', 14),
(16, '2018_08_02_145510_create_third_login_table', 15),
(17, '2018_08_02_150219_create_third_table', 15),
(18, '2018_07_25_130243_create_jobs_table', 16),
(19, '2018_08_02_151149_create_ttttt_table', 17),
(20, '2015_12_21_111514_create_sms_table', 18),
(21, '2018_08_16_173710_create_failed_jobs_table', 19);

-- --------------------------------------------------------

--
-- 表的结构 `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `notices`
--

INSERT INTO `notices` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, '通知啦', '2018年7月14日，明天休息啦', '2018-07-13 07:52:32', '2018-07-13 07:52:32'),
(2, '假期啦', '开始假期啦，快来啊', '2018-07-13 09:02:54', '2018-07-13 09:02:54'),
(3, '成功啦', '队列消息成功啦', '2018-07-13 09:03:48', '2018-07-13 09:03:48'),
(4, '1111', '11111', '2018-07-13 09:06:07', '2018-07-13 09:06:07');

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  `name` varchar(25) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `name`, `desc`, `created_at`, `updated_at`, `status`) VALUES
(31, '这十年，如果要形容英格兰队门将的水平，只有一个词——有辱“狮”门。', '<p>这十年，如果要形容英格兰队门将的水平，只有一个词——有辱“狮”门。</p><p><br></p>', 5, NULL, NULL, '2018-07-05 02:00:36', '2018-07-12 06:53:01', -1),
(33, '福被骑士摆上货架5队或成下家 三队愿4换1有望赴湖人', '<p>在7月3日，骑士队就已经决定将全明星大前锋凯文-乐福摆上货架，之前对外界表示不愿意交易乐福完全是想以乐福把詹姆斯留住，但如今詹姆斯已经加盟湖人，骑士队没有必要在装好人，他们立马开了重建计划，送走他们最具交易价值的球员乐福，乐福上赛季场均17.6分9.2篮板0.71抢断0.41盖帽，三分命中率41.5%，骑士队希望将乐福送走得到一些选秀权、年轻球员、到期合同等，在7月5日，《露天看台》为乐福找寻了5大下家</p><p><br></p>', 5, NULL, NULL, '2018-07-05 04:46:21', '2018-07-12 06:30:14', 0),
(34, '开拓者送出迈耶斯-伦纳德、哈克里斯、凯莱布-斯', '<p>开拓者送出迈耶斯-伦纳德、哈克里斯、凯莱布-斯瓦尼根、19年首轮签，得到乐福，这笔交易骑士队需要吞下两个大合同，伦纳德的合同还有两年2200万，哈克里斯还有2年2200万，不过也得到了一名年轻球员与1个首轮签，开拓者则可以组建四巨头阵容利拉德+麦科勒姆+努尔基奇+乐福，实力必然更进一步。</p><p><br></p>', 5, NULL, NULL, '2018-07-05 04:48:21', '2018-07-12 06:43:20', 0),
(35, '火箭队送出莱恩-安德森、', '<p>火箭队送出莱恩-安德森、欧努阿库、19+21首轮签换取乐福，火箭队一直想要清理掉安德森2年4000万的大合同，如今机会来了，奉上两个首轮签去交易乐福，乐福虽然防守不行，但他进攻很强，在火箭队的阵容中三分球是得分关键，有了乐福这个不错得分能力的大前锋，哈登的压力会小很多。</p><p><br></p>', 5, NULL, NULL, '2018-07-05 04:48:52', '2018-07-12 06:42:03', 0),
(36, '四、灰熊、76人（三方交易）', '<p>灰熊送出：本-麦克勒莫+杰迈克尔-格林，得到科文顿；费城送出贝勒斯+科文顿+沙里奇得到乐福，骑士送出乐福得到沙里奇、麦克勒莫、贝勒斯、杰迈克尔-格林；这笔三方交易怎么看费城都是最亏的那个，不知道76人怎么会愿意商议这样的交易，为了送走贝勒斯的合同牺牲沙里奇+科文顿吗？沙里奇已经展现出场均20+10的潜力，换取一个乐福已经够亏的了，这笔交易骑士队赚翻了，得到一众年轻球员，贝勒斯得到后可以立马裁掉，但我认为这笔交易很难成功</p><p><br></p>', 5, NULL, NULL, '2018-07-05 04:49:20', '2018-07-12 06:43:22', 0),
(37, '湖人队送出：罗尔-邓、库兹马、', '<p>湖人队送出：罗尔-邓、库兹马、哈特、19首轮签得到乐福，这笔交易湖人队终于送走了罗尔邓1800万的垃圾合同，当然他们也付出了两个潜力新星与一个首轮签，湖人则得到乐福，乐福是之前明确表示愿意跟随詹姆斯打球到退役的球员，这笔交易的成功率其实不低，就看湖人队愿意放弃库兹马不，乐福+詹姆斯的组合怎么也好过詹姆斯单核带队</p><p><br></p>', 5, NULL, NULL, '2018-07-05 04:49:54', '2018-07-12 06:41:37', 0),
(39, '不需要指定模型的动作不需要指定模型的动作', '<h4>不需要指定模型的动作</h4><h4>不需要指定模型的动作</h4><h4>不需要指定模型的动作</h4><h4>不需要指定模型的动</h4><h4><img src="http://blog.com/storage/2018-07-06/vb2NJW61lGWIykcFlYjw5OoxuJESniItzjIxPFGx.jpeg" alt="63" style="max-width:100%;" data-bd-imgshare-binded="1"></h4><p><br></p><p><br></p>', 6, NULL, NULL, '2018-07-05 05:46:01', '2018-07-12 06:41:39', 0),
(40, '欢迎来到简书网站 欢迎来到简书网站', '<p>欢迎来到简书网站\r\n            </p><p>欢迎来到简书网站\r\n            </p><p><img src="http://blog.com/storage/2018-07-10/dXQsZQF5hCZDguuofukTqYdoYRTqgECLuHUSXkkK.jpeg" alt="56fe09fe0e22c" style="max-width:100%;"></p><p><br></p>', 6, NULL, NULL, '2018-07-10 02:42:46', '2018-07-13 09:25:58', -1),
(41, '欢迎来到简书网站 欢迎来到简书网站', '<p>欢迎来到简书网站\r\n            </p><p>欢迎来到简书网站\r\n            </p><p><img src="http://blog.com/storage/2018-07-10/dXQsZQF5hCZDguuofukTqYdoYRTqgECLuHUSXkkK.jpeg" alt="56fe09fe0e22c" style="max-width:100%;"></p><p><br></p>', 6, NULL, NULL, '2018-07-10 02:44:54', '2018-07-13 09:25:55', -1),
(42, '欢迎来到简书网站 欢迎来到简书网站', '<p>欢迎来到简书网站\r\n            </p><p>欢迎来到简书网站\r\n            </p><p><img src="http://blog.com/storage/2018-07-10/dXQsZQF5hCZDguuofukTqYdoYRTqgECLuHUSXkkK.jpeg" alt="56fe09fe0e22c" style="max-width:100%;"></p><p><br></p>', 6, NULL, NULL, '2018-07-10 02:46:03', '2018-07-13 09:25:56', -1),
(43, '欢迎来到简书网站 欢迎来到简书网站', '<p>欢迎来到简书网站\r\n            </p><p>欢迎来到简书网站\r\n            </p><p><img src="http://blog.com/storage/2018-07-10/dXQsZQF5hCZDguuofukTqYdoYRTqgECLuHUSXkkK.jpeg" alt="56fe09fe0e22c" style="max-width:100%;"></p><p><br></p>', 6, NULL, NULL, '2018-07-10 02:46:22', '2018-07-13 09:25:54', -1),
(44, '人民日报海外版：荒谬的药方治不了美国的病', '<p>人民日报海外版7月13日消息，近日，美方突然公布了拟对价值2000亿美元从中国进口商品加征关税清单，使贸易战加速升级。这是一种显然会伤害中美双边贸易，并将危害世界经济的挑衅行为，我们不禁要问：美方采取如此蛮横举措，道理何在？ \r\n</p><br><p> \r\n几位美国高官近日倒也在不断重复一套说辞，声称美国在对华贸易中受到了“不公平待遇”：中国通过“强制技术转让”手段，“盗窃”了美国技术，由此获得“不公平优势”。这套说辞来自今年早些时候发布的“对华301调查报告”，这份报告成了美方制定针对中国航空航天、信息技术、机器人和机械等领域产品加征关税清单的理由，而之后的2000亿美元清单理由则是中国采取反击措施。\r\n \r\n</p><br><p> \r\n美方这套理由及依此而生的举动是否站得住脚呢？对于“对华301调查报告”，就连美国自己的智库——彼得森国际经济研究所都忍不住站出来驳斥。该所发布研究报告指出，在知识产权方面，美国恰恰从中国获得了巨大的利益：近十年来，中国付给外国企业的技术许可费用增长了4倍，2017年达到近300亿美元，美国是其中最大获益者，收益增速也最快，2017年增幅达14%。中国公布数据显示，2017年，中国对外支付的知识产权使用费达到286亿美元，比2001年加入世贸组织时增长了15倍之多。\r\n \r\n</p><br><p> \r\n实际上，美国“对华301调查报告”混淆了微观层面的技术转移与宏观层面的技术扩散。在微观层面，外资企业对中国企业的技术转让主要是“技术使用有偿许可”，外资企业的技术所有权不但没有受到影响，反而获得了收益。这种契约是商业谈判形成的互利互惠合作，是典型的市场行为，政府无需干预。中外企业的技术合作和其他经贸合作完全是基于自愿原则实施的契约行为，多年来双方企业都从中获得了巨大利益。这也正是美国每年从中国获取大量知识产权收益的主要来源。\r\n \r\n</p><br><p> \r\n而在宏观层面，技术扩散是一种普遍规律，像“阿拉伯数字”扩散到全世界、电力技术普及到每个国家都是技术扩散现象。把“对华301调查报告”的逻辑用在美国自己身上的话，1886年德国人卡尔·本茨发明了世界上第一辆汽车，7年后美国人杜里埃造出了美国第一辆汽车，难道说美国“盗窃”了德国的汽车技术？\r\n \r\n</p><p><br></p>', 6, NULL, NULL, '2018-07-16 01:42:48', '2018-07-16 01:42:48', 0),
(45, '人民日报海外版：荒谬的药方治不了美国的病', '<p>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 人民日报海外版7月13日消息，近日，美方突然公布了拟对价值2000亿美元从中国进口商品加征关税清单，使贸易战加速升级。这是一种显然会伤害中美双边贸易，并将危害世界经济的挑衅行为，我们不禁要问：美方采取如此蛮横举措，道理何在？ \r\n</p><br><p> \r\n几位美国高官近日倒也在不断重复一套说辞，声称美国在对华贸易中受到了“不公平待遇”：中国通过“强制技术转让”手段，“盗窃”了美国技术，由此获得“不公平优势”。这套说辞来自今年早些时候发布的“对华301调查报告”，这份报告成了美方制定针对中国航空航天、信息技术、机器人和机械等领域产品加征关税清单的理由，而之后的2000亿美元清单理由则是中国采取反击措施。\r\n \r\n</p><br><p> \r\n美方这套理由及依此而生的举动是否站得住脚呢？对于“对华301调查报告”，就连美国自己的智库——彼得森国际经济研究所都忍不住站出来驳斥。该所发布研究报告指出，在知识产权方面，美国恰恰从中国获得了巨大的利益：近十年来，中国付给外国企业的技术许可费用增长了4倍，2017年达到近300亿美元，美国是其中最大获益者，收益增速也最快，2017年增幅达14%。中国公布数据显示，2017年，中国对外支付的知识产权使用费达到286亿美元，比2001年加入世贸组织时增长了15倍之多。\r\n \r\n</p><br><p> \r\n实际上，美国“对华301调查报告”混淆了微观层面的技术转移与宏观层面的技术扩散。在微观层面，外资企业对中国企业的技术转让主要是“技术使用有偿许可”，外资企业的技术所有权不但没有受到影响，反而获得了收益。这种契约是商业谈判形成的互利互惠合作，是典型的市场行为，政府无需干预。中外企业的技术合作和其他经贸合作完全是基于自愿原则实施的契约行为，多年来双方企业都从中获得了巨大利益。这也正是美国每年从中国获取大量知识产权收益的主要来源。\r\n \r\n</p><br><p> \r\n而在宏观层面，技术扩散是一种普遍规律，像“阿拉伯数字”扩散到全世界、电力技术普及到每个国家都是技术扩散现象。把“对华301调查报告”的逻辑用在美国自己身上的话，1886年德国人卡尔·本茨发明了世界上第一辆汽车，7年后美国人杜里埃造出了美国第一辆汽车，难道说美国“盗窃”了德国的汽车技术？\r\n \r\n</p><p><br></p>', 6, NULL, NULL, '2018-07-16 01:43:14', '2018-07-16 01:43:42', 0),
(46, '海关总署：上半年贸易顺差9013.2亿元，收窄26.7%', '<p>国新发布7月13日消息：今日，国务院新闻办举行2018年上半年进出口情况发布会。海关总署新闻发言人黄颂平表示，今年以来，国内经济平稳运行，推动我国外贸进出口较快增长。据海关统计，上半年我国货物贸易进出口总值14.12万亿元人民币，比去年同期（下同）增长7.9%。其中，出口7.51万亿元，增长4.9%；进口6.61万亿元，增长11.5%；贸易顺差9013.2亿元，收窄26.7%。具体情况有以下几个方面：\r\n \r\n</p><br><p> 一般贸易进出口快速增长，贸易结构进一步优化。上半年，我国一般贸易进出口8.33万亿元，增长12.2%，占我国进出口总值的59%，比去年同期提升2.3个百分点。 \r\n</p><br><p> 对前三大贸易伙伴进出口保持增长，对中东欧国家进出口增势较好。上半年，我国对欧盟、美国和东盟进出口分别增长5.3%、5.2%和11%，3者合计占我国进出口总值的41%。同期，我国对中东欧16国进出口增长14.7%，高出全国整体增速6.8个百分点。 \r\n</p><br><p> \r\n民营企业进出口比重继续提升，内生动力不断增强。上半年，我国民营企业进出口5.52万亿元，增长11.2%，占我国进出口总值的39.1%，比去年同期提升1.2个百分点。其中，出口3.57万亿元，增长7.6%，占出口总值的47.5%，继续保持出口份额居首的地位；进口1.95万亿元，增长18.4%。\r\n \r\n</p><br><p> \r\n中西部、东北进出口增速高于全国整体，区域发展协调性增强。上半年，西部12省市外贸增速为17.8%，超过全国增速9.9个百分点；中部6省市外贸增速为13.2%，超过全国增速5.3个百分点；东北三省外贸增速为8.8%，超过全国增速0.9个百分点；东部10省市外贸增速为6.7%。\r\n \r\n</p><br><p> \r\n机电产品出口保持增长，出口提质增效稳步推进。上半年，我国机电产品出口4.4万亿元，增长7%，占我国出口总值的58.6%。其中，电器及电子产品出口增长8%，机械设备出口增长9%。同期，传统劳动密集型产品合计出口1.41万亿元，下降4.1%，占出口总值的18.7%。\r\n \r\n</p><br><p> \r\n原油、天然气、水海产品等商品进口量增加，扩大进口政策效应持续显现。上半年，我国进口原油2.25亿吨，增加5.8%；天然气4208万吨，增加35.4%；成品油1649万吨，增加9.7%；铜260万吨，增加16.3%。同期，水海产品进口量增加12.4%；化妆品增加1倍；医药品增加8%。\r\n \r\n</p><br><p> 黄颂平表示，总的看，上半年我国外贸进出口稳中有进，结构进一步优化，动力转换有所加快，质量效益稳步提高。但国际环境不稳定不确定性上升，未来我国外贸进出口平稳运行将面临一些挑战。\r\n      </p><p><br></p>', 6, NULL, NULL, '2018-07-16 01:50:11', '2018-07-16 01:50:11', 0),
(47, '特朗普称对美国情报部门很有信心 这时屋里的灯灭了', '<p>【环球网报道记者赵衍龙】当地时间17日，特朗普召开白宫内阁会议，回应俄干预美国大选。特朗普称接受情报机构关于俄罗斯干预大选的结论，“非常相信美国情报机构”，美国福克斯新闻网的视频画面显示，这时灯突然灭了，之后又马上恢复。</p><p><img src="http://blog.com/storage/2018-07-20/3BVtinNPly440xnVDiZFodUfVtg3pwAzxFg2pdeh.jpeg" alt="test" style="max-width:100%;"></p><p><br></p>', 6, NULL, NULL, '2018-07-19 01:16:47', '2018-07-20 03:00:40', 0),
(49, '车管所再次确认：8月起私家车都要安装这个小东西，还要准备500块', '<p>随着社会智能化的发展越来越先进，许多证件已经开始逐步使用电子形式的了。比如电子车牌，已经逐步在全国普及，不论是南京还是广州地区，很多省市已经开始采用电子车牌，而且规定私家车上电子车牌，如果交警在查车或者被电子眼拍到没有使用电子车牌，会被罚款500块。尤其是从8月起，各省市对电子车牌的要求更加严格。车管所再次确认：8月起私家车都要安装这个小东西，还要准备500块，因为如果不安装被查到就要被罚款500元。</p><p><br></p>', 26, NULL, NULL, '2018-08-16 01:16:32', '2018-08-16 01:16:32', 0);

-- --------------------------------------------------------

--
-- 表的结构 `post_topics`
--

CREATE TABLE IF NOT EXISTS `post_topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `post_topics`
--

INSERT INTO `post_topics` (`id`, `post_id`, `topic_id`, `created_at`, `updated_at`) VALUES
(1, 39, 1, '2018-07-11 03:29:47', '2018-07-11 03:29:47'),
(2, 43, 1, '2018-07-11 03:30:14', '2018-07-11 03:30:14'),
(3, 39, 2, '2018-07-11 03:30:28', '2018-07-11 03:30:28'),
(4, 40, 2, '2018-07-11 03:30:28', '2018-07-11 03:30:28'),
(5, 41, 1, '2018-07-11 03:30:56', '2018-07-11 03:30:56'),
(6, 37, 2, '2018-07-11 03:31:28', '2018-07-11 03:31:28'),
(7, 36, 2, '2018-07-11 04:51:09', '2018-07-11 04:51:09'),
(8, 37, 1, '2018-07-11 05:19:21', '2018-07-11 05:19:21'),
(9, 36, 1, '2018-07-11 05:19:40', '2018-07-11 05:19:40'),
(10, 42, 1, '2018-07-12 05:01:45', '2018-07-12 05:01:45'),
(11, 42, 5, '2018-07-13 07:08:56', '2018-07-13 07:08:56');

-- --------------------------------------------------------

--
-- 表的结构 `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('G6sFyt7fOKPU1ZgHwcOZsgnPgrsRX5peIbH7wm66', 26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia2RVeUZiUjV1QjBNTkpOQVFNZXlGZVB5dEh5bjR2SHl4ZjlIYlhQUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly90ZXN0Lm9wZW4ubGl4aWFvd2FuZy50b3AvYWRtaW4/cz0lMkZhZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyNjt9', 1534756247);

-- --------------------------------------------------------

--
-- 表的结构 `third_logins`
--

CREATE TABLE IF NOT EXISTS `third_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `sina_id` int(11) unsigned DEFAULT NULL,
  `openid` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nickname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sina_avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `qq_avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `third_logins`
--

INSERT INTO `third_logins` (`id`, `user_id`, `sina_id`, `openid`, `name`, `nickname`, `email`, `sina_avatar`, `qq_avatar`, `created_at`, `updated_at`) VALUES
(1, 0, 2147483647, NULL, NULL, 'lxw18231857001', NULL, 'http://tva1.sinaimg.cn/crop.109.42.273.273.180/0063xpjSjw8f911i1zjtzj30do09yq48.jpg', '', '2018-08-06 08:53:34', '2018-08-06 08:53:34');

-- --------------------------------------------------------

--
-- 表的结构 `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `topics`
--

INSERT INTO `topics` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '案例专题', '2018-07-10 07:59:47', '2018-07-10 08:00:58'),
(2, '旅游', '2018-07-10 08:01:33', '2018-07-10 08:01:33');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` char(11) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '注册绑定手机号（手机号登录）',
  `third_id` int(11) unsigned DEFAULT NULL COMMENT '微博用户id',
  `openid` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT 'qq openid',
  `avatar` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '头像',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `tel`, `third_id`, `openid`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'qqq', 'qq@qq.com', '$2y$10$5gMyOm/N0kqttl073TuOZedYmAuX1vM3kI/7e3s3c3xC8jUylZXJe', '', 0, '', NULL, NULL, '2018-07-04 07:55:47', '2018-07-04 07:55:47'),
(2, 'www', 'www@qq.com', '$2y$10$mYGLugrPCqfxxFQ.SsS/fetSb/GH1mWZaaTlHQENyds02TS/8NnOO', '', 0, '', NULL, NULL, '2018-07-04 07:56:39', '2018-07-04 07:56:39'),
(3, 'aaa', 'aa@qq.com', '$2y$10$3HnqvmYV3/uDK3O62nCZb.5HVcBbswd7zpGseY47Kf9eekxbvgzpm', '', 0, '', 'http://blog.com/storage/2018-07-10/dXQsZQF5hCZDguuofukTqYdoYRTqgECLuHUSXkkK.jpeg', NULL, '2018-07-04 08:03:08', '2018-07-04 08:03:08'),
(4, 'lxw1', '1844912514@qq.com', '$2y$10$v41CcW1Ym14tb/4x9meuLuiyyXbtjlRPsQGQh8I0BbxlkTzjlzjXa', '', 0, '', 'http://blog.com/storage/2018-07-10/dXQsZQF5hCZDguuofukTqYdoYRTqgECLuHUSXkkK.jpeg', 'rvvEBn21dF92sS92BjneO1bPCsfxo0jj5dp5qKSj7Y2X4SHwX4lMiQcg70Vn', '2018-07-04 08:07:59', '2018-08-16 05:18:07'),
(5, 'test', 'test@qq.com', '$2y$10$OwQQVo3UcrHy0jq.XPdvSOyWruC3CW7zFUEhFSODVc/GyelYf8YfG', '', 0, '', '/storage/2018-07-10/pGMf2vQvIblhBRgUZJ9xu6qGHtQXyzPjVdfIu7HD.jpeg', '5bxvs4MIzkZPYY5mk19WHXCxQVCg7Mx8mX95tje8OIjYy0FHHUoGkjGv62Dn', '2018-07-04 08:37:12', '2018-07-11 04:51:30'),
(6, 'admin', 'lixiaowang@welltrend.com.cn', '$2y$10$AnfkeBy7n4.RhhdsoQ/TPOR/YroyL3ir8ZctVTLltbm8PFPhuV6Tm', '', 0, '', '/storage/2018-07-10/pGMf2vQvIblhBRgUZJ9xu6qGHtQXyzPjVdfIu7HD.jpeg', 'JANk3y1Xv9YucfGd8NKs9gyxFiA9gwheHFygw8GTSx9wQaQJoM0XuOpY1kSn', '2018-07-23 06:23:53', '2018-08-03 02:15:46'),
(8, 'admin2', 'admin2@qq.com', '$2y$10$13yC3IQSbRTn5v2LdpnC9.Nj61q52wvJh61DBVX92C2D3jun2l4qW', '', 0, '', '/storage/2018-07-23/gpwQIAc0lCe6SIJKHVFz5xoat8pfV5XyaouiFEFo.jpeg', 'CGFWej2mFdkC3XYGZo1pLxLyDebYyHBH8tgVaEzR7CL1A8iNEHP6RjKXuBaj', '2018-07-23 07:10:28', '2018-07-23 07:11:46'),
(18, 'lxw18231857001', 'luozhiqun@welltrend.com.cn', '$2y$10$R3fnKJffiKOkQQjCcyyip.1WnRpzmhdRkZ00agGzmzYT.OnPi/FKu', '18231857002', 2147483647, '', '/storage/2018-08-06/G7cdYPTXjAuLzAggSiYVfDbQwpVwami1amICitb6.png', 'itj0P0Bk6HNJFbI984sjLHWZlFEUoIygGqJBUR67uLYrkCh9XX9k0kwWFRBQ', '2018-08-06 08:53:34', '2018-08-06 08:58:22'),
(26, '青春阳光', '18231857001@welltrend.com.cn', '$2y$10$WQ8yrRLs4TEBRDTxEaV3cuqTOi3jeVgfKBuKzFfJ79UkES1lMNhnS', '18231857001', NULL, 'F484C06DAF4FFE33463BA5F98D1F6B0C', '/storage/2018-08-08/xqf0ddCGCZoRdJ5gowXWNhW7ptGBIK86qI9zK1i6.jpeg', 'ewwL7pYeb4SHrVuqgDF8LXBvMBGQOV16c1MUocfTT5sTLwI8ZCKmULgqPI7b', '2018-08-08 05:07:17', '2018-08-15 02:39:47');

-- --------------------------------------------------------

--
-- 表的结构 `user_notice`
--

CREATE TABLE IF NOT EXISTS `user_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `notice_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `user_notice`
--

INSERT INTO `user_notice` (`id`, `user_id`, `notice_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(7, 1, 3),
(8, 2, 3),
(9, 3, 3),
(10, 4, 3),
(11, 5, 3),
(12, 6, 3),
(13, 1, 4),
(14, 2, 4),
(15, 3, 4),
(16, 4, 4),
(17, 5, 4),
(18, 6, 4);

-- --------------------------------------------------------

--
-- 表的结构 `zans`
--

CREATE TABLE IF NOT EXISTS `zans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `zans`
--

INSERT INTO `zans` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(4, 6, 39, '2018-07-05 07:59:09', '2018-07-05 07:59:09'),
(5, 6, 37, '2018-07-05 07:59:17', '2018-07-05 07:59:17'),
(6, 5, 43, '2018-07-10 05:12:10', '2018-07-10 05:12:10'),
(7, 6, 41, '2018-07-10 07:05:49', '2018-07-10 07:05:49'),
(8, 6, 43, '2018-07-11 01:18:34', '2018-07-11 01:18:34'),
(9, 6, 46, '2018-07-16 03:10:25', '2018-07-16 03:10:25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
