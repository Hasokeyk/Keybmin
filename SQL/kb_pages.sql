-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2020 at 07:42 AM
-- Server version: 5.7.28-log
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panelseldos`
--

-- --------------------------------------------------------

--
-- Table structure for table `kb_pages`
--

CREATE TABLE `kb_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(522) NOT NULL,
  `link` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `shortcode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `control` int(11) NOT NULL DEFAULT '1',
  `menu` int(11) NOT NULL DEFAULT '1',
  `type` varchar(255) NOT NULL DEFAULT 'pages',
  `iconClass` varchar(255) NOT NULL DEFAULT 'fab fa-korvue',
  `userAuth` text NOT NULL,
  `time` int(11) NOT NULL,
  `parentID` int(11) NOT NULL DEFAULT '0',
  `orderBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kb_pages`
--

INSERT INTO `kb_pages` (`id`, `title`, `description`, `link`, `template`, `shortcode`, `status`, `control`, `menu`, `type`, `iconClass`, `userAuth`, `time`, `parentID`, `orderBy`) VALUES
(NULL, 'Keybmin', 'Keybmin Desc', '?page=keybmin', 'keybmin', 'keybmin', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[1]', 1583855834, 0, 9999999),
(NULL, 'Page Operations', 'Page Operations Desc', '?page=keybmin-page-operations', 'keybmin-page-operations', 'keybmin-page-operations', 1, 1, 1, 'keybmin', 'fas fa-file-powerpoint', '[1]', 1528843544, 1, 0),
(NULL, 'Page List', 'Page List Desc', '?page=keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[1]', 1528843544, 2, 0),
(NULL, 'Page Edit', 'Page Edit Desc', '?page=keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 1, 1, 2, 'keybmin', 'fas fa-file-medical', '[\"1\",\"2\",\"3\"]', 1528843544, 2, 0),
(NULL, 'Add New Page', 'Add New Page Desc', '?page=keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[1]', 1528843544, 2, 0),
(NULL, 'Auth Operations', 'Auth Operations Desc', '?page=keybmin-auth-operations', 'keybmin-auth-operations', 'keybmin-auth-operations', 1, 1, 1, 'keybmin', 'fas fa-align-center', '[1]', 1528843544, 1, 0),
(NULL, 'Auth List', 'Auth List Desc', '?page=keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 1, 1, 1, 'keybmin', 'fas fa-list-ul', '[1]', 1528843544, 6, 0),
(NULL, 'Auth Edit', 'Auth Edit Desc', '?page=keybmin-auth-operations-auth-edit', 'keybmin-auth-operations-auth-edit', 'keybmin-auth-operations-auth-edit', 1, 1, 2, 'keybmin', 'fas fa-file-medical', '[\"1\",\"2\",\"3\"]', 1528843544, 6, 0),
(NULL, 'Add New Auth', 'Add New Auth Desc', '?page=keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[1]', 1528843544, 6, 0),
(NULL, 'Login', 'Login Desc', '?page=login', 'login', 'login', 1, 0, 2, 'pages', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(NULL, 'Register', 'Register Desc', '?page=register', 'register', 'register', 1, 0, 2, 'pages', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(NULL, 'Ajax Login', 'Ajax Login Desc', '?page=ajax-login', 'ajax-login', 'ajax-login', 1, 0, 2, 'ajax', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(NULL, 'Dashboard', 'Dashboard Desc', '?page=dashboard', 'dashboard', 'dashboard', 1, 1, 1, 'pages', 'fas fa-home', '[\"1\",\"2\",\"3\"]', 1528843544, 0, 0),
(NULL, 'Logout', 'Logout Desc', '?page=logout', 'logout', 'logout', 1, 1, 1, 'pages', 'fas fa-sign-out-alt', '[\"2\",\"3\",\"1\"]', 1583859680, 0, 9999998),
(NULL, 'Banned', 'Banned Desc', '?page=banned', 'banned', 'banned', 1, 1, 2, 'pages', 'fas fa-ban', '[\"2\",\"3\",\"1\"]', 1583859798, 0, 0),
(NULL, '404', '404 Desc', '?page=404', '404', '404', 1, 1, 2, 'pages', 'empty', '[\"2\",\"3\",\"1\"]', 1583859793, 0, 0),
(NULL, '500', '500 Desc', '?page=500', '500', '500', 1, 0, 2, 'pages', 'fab fa-korvue', '[\"1\",\"2\",\"3\"]', 1528843544, 0, 0),
(NULL, 'Users', 'Users Desc', '?page=users', 'users', 'users', 1, 1, 1, 'pages', 'fas fa-users', '[\"2\",\"1\"]', 1583855761, 0, 0),
(NULL, 'User List', 'User List Desc', '?page=users-user-list', 'users-user-list', 'users-user-list', 1, 1, 1, 'pages', 'fas fa-list', '[\"2\",\"1\"]', 1583859720, 18, 0),
(NULL, 'User Edit', 'User Edit', '?page=users-user-edit', 'users-user-edit', 'users-user-edit', 1, 1, 2, 'pages', 'fab fa-korvue', '[\"2\",\"1\"]', 1583857069, 18, 0),
(NULL, 'Add New User', 'Add New User Desc', '?page=users-add-new-user', 'users-add-new-user', 'users-add-new-user', 1, 1, 1, 'pages', 'fas fa-user-plus', '[\"2\",\"1\"]', 1583859731, 18, 0),
(NULL, 'Settings', 'Settings Desc', '?page=settings', 'settings', 'settings', 1, 1, 1, 'pages', 'fas fa-cogs', '[\"2\",\"3\",\"1\"]', 1583859834, 0, 0),
(NULL, 'Panel Settings', 'Panel Settings', '?page=settings-panel-settings', 'settings-panel-settings', 'settings-panel-settings', 1, 1, 1, 'pages', 'fas fa-cog', '[\"2\",\"1\"]', 1583859828, 22, 0),
(NULL, 'My profile', 'My profile', '?page=settings-my-profile', 'settings-my-profile', 'settings-my-profile', 1, 1, 1, 'pages', 'fas fa-user-circle', '[\"2\",\"3\",\"1\"]', 1583859816, 22, 0)
--
-- Indexes for dumped tables
--

--
-- Indexes for table `kb_pages`
--
ALTER TABLE `kb_pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kb_pages`
--
ALTER TABLE `kb_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
