-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 27 Haz 2021, 15:10:42
-- Sunucu sürümü: 8.0.21
-- PHP Sürümü: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `keybmin`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kb_auth`
--

DROP TABLE IF EXISTS `kb_auth`;
CREATE TABLE IF NOT EXISTS `kb_auth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `auth_desc` text COLLATE utf8mb4_general_ci NOT NULL,
  `parent_id` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kb_auth`
--

INSERT INTO `kb_auth` (`id`, `auth_name`, `auth_desc`, `parent_id`) VALUES
(1, 'Super Admin', 'Super Admin Desc', 0),
(2, 'Admin', 'Admin Desc', 0),
(3, 'User', 'Normal Kullanıcı', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kb_pages`
--

DROP TABLE IF EXISTS `kb_pages`;
CREATE TABLE IF NOT EXISTS `kb_pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(522) COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `template` text COLLATE utf8mb4_general_ci NOT NULL,
  `shortcode` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `login_control` int NOT NULL DEFAULT '1',
  `menu` int NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pages',
  `icon_class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'fab fa-korvue',
  `user_auth` text COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `orderBy` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kb_pages`
--

INSERT INTO `kb_pages` (`id`, `title`, `description`, `link`, `template`, `shortcode`, `status`, `login_control`, `menu`, `type`, `icon_class`, `user_auth`, `time`, `parent_id`, `orderBy`) VALUES
(1, 'Keybmin', 'Keybmin Desc', '?page=keybmin', 'keybmin', 'keybmin', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[1]', 1583855834, 0, 9999999),
(2, 'Page Operations', 'Page Operations Desc', '?page=keybmin-page-operations', 'keybmin-page-operations', 'keybmin-page-operations', 1, 1, 1, 'keybmin', 'fas fa-file-powerpoint', '[1]', 1528843544, 1, 0),
(3, 'Page List', 'Page List Desc', '?page=keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[1]', 1528843544, 2, 0),
(4, 'Page Edit', 'Page Edit Desc', '?page=keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 1, 1, 2, 'keybmin', 'fas fa-file-medical', '[\"1\",\"2\",\"3\"]', 1528843544, 2, 0),
(5, 'Add New Page', 'Add New Page Desc', '?page=keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[1]', 1528843544, 2, 0),
(6, 'Auth Operations', 'Auth Operations Desc', '?page=keybmin-auth-operations', 'keybmin-auth-operations', 'keybmin-auth-operations', 1, 1, 1, 'keybmin', 'fas fa-align-center', '[1]', 1528843544, 1, 0),
(7, 'Auth List', 'Auth List Desc', '?page=keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 1, 1, 1, 'keybmin', 'fas fa-list-ul', '[1]', 1528843544, 6, 0),
(8, 'Auth Edit', 'Auth Edit Desc', '?page=keybmin-auth-operations-auth-edit', 'keybmin-auth-operations-auth-edit', 'keybmin-auth-operations-auth-edit', 1, 1, 2, 'keybmin', 'fas fa-file-medical', '[\"1\",\"2\",\"3\"]', 1528843544, 6, 0),
(9, 'Add New Auth', 'Add New Auth Desc', '?page=keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[1]', 1528843544, 6, 0),
(10, 'Login', 'Login Desc', '?page=login', 'login', 'login', 1, 0, 2, 'pages', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(11, 'Register', 'Register Desc', '?page=register', 'register', 'register', 1, 0, 2, 'pages', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(12, 'Ajax Login', 'Ajax Login Desc', '?page=ajax-login', 'ajax-login', 'ajax-login', 1, 0, 2, 'ajax', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(13, 'Dashboard', 'Dashboard Desc', '?page=dashboard', 'dashboard', 'dashboard', 1, 1, 1, 'pages', 'fas fa-home', '[\"1\",\"2\",\"3\"]', 1528843544, 0, 0),
(14, 'Logout', 'Logout Desc', '?page=logout', 'logout', 'logout', 1, 1, 1, 'pages', 'fas fa-sign-out-alt', '[\"2\",\"3\",\"1\"]', 1583859680, 0, 9999998),
(15, 'Banned', 'Banned Desc', '?page=banned', 'banned', 'banned', 1, 1, 2, 'pages', 'fas fa-ban', '[\"2\",\"3\",\"1\"]', 1583859798, 0, 0),
(16, '404', '404 Desc', '?page=404', '404', '404', 1, 1, 2, 'pages', 'empty', '[\"2\",\"3\",\"1\"]', 1583859793, 0, 0),
(17, '500', '500 Desc', '?page=500', '500', '500', 1, 0, 2, 'pages', 'fab fa-korvue', '[\"1\",\"2\",\"3\"]', 1528843544, 0, 0),
(18, 'Users', 'Users Desc', '?page=users', 'users', 'users', 1, 1, 1, 'pages', 'fas fa-users', '[\"2\",\"1\"]', 1583855761, 0, 0),
(19, 'User List', 'User List Desc', '?page=users-user-list', 'users-user-list', 'users-user-list', 1, 1, 1, 'pages', 'fas fa-list', '[\"2\",\"1\"]', 1583859720, 18, 0),
(20, 'User Edit', 'User Edit', '?page=users-user-edit', 'users-user-edit', 'users-user-edit', 1, 1, 2, 'pages', 'fab fa-korvue', '[\"2\",\"1\"]', 1583857069, 18, 0),
(21, 'Add New User', 'Add New User Desc', '?page=users-add-new-user', 'users-add-new-user', 'users-add-new-user', 1, 1, 1, 'pages', 'fas fa-user-plus', '[\"2\",\"1\"]', 1583859731, 18, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kb_settings`
--

DROP TABLE IF EXISTS `kb_settings`;
CREATE TABLE IF NOT EXISTS `kb_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `var` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `val` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kb_settings`
--

INSERT INTO `kb_settings` (`id`, `var`, `val`) VALUES
(1, 'theme', 'default'),
(2, 'logo', 'keybmin-logo.jpg'),
(3, 'lang', 'tr_TR'),
(4, 'siteUrl', '/');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kb_users`
--

DROP TABLE IF EXISTS `kb_users`;
CREATE TABLE IF NOT EXISTS `kb_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `session` text COLLATE utf8mb4_general_ci,
  `auth_id` int NOT NULL,
  `time` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kb_users`
--

INSERT INTO `kb_users` (`id`, `full_name`, `mail`, `phone`, `password`, `status`, `session`, `auth_id`, `time`) VALUES
(1, 'Hasan Yüksektepe', 'admin@admin.com', NULL, '21232f297a57a5a743894a0e4a801fc3', 1, '', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
