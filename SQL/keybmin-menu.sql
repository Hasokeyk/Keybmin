-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2020 at 07:36 AM
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
(1, 'Login', 'Login Desc', '?page=login', 'login', 'login', 1, 0, 0, 'pages', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(2, 'Ajax Login', 'Ajax Login Desc', '?page=ajax-login', 'ajax-login', 'ajax-login', 1, 0, 0, 'ajax', 'fab fa-korvue', '[\"1\"]', 1528843544, 0, 0),
(3, 'Dashboard', 'Dashboard Desc', '?page=dashboard', 'dashboard', 'dashboard', 1, 1, 1, 'pages', 'fas fa-home', '[\"1\",\"2\",\"3\"]', 1528843544, 0, 0),
(4, 'Logout', 'Logout Desc', '?page=logout', 'logout', 'logout', 1, 1, 1, 'pages', 'fab fa-korvue', '[\"1\",\"2\",\"3\"]', 1528843544, 0, 0),
(5, 'Keybmin', 'Keybmin Desc', '?page=keybmin', 'keybmin', 'keybmin', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[\"1\",\"2\",\"3\"]', 1528843544, 0, 0),
(6, 'Page Operations', 'Page Operations Desc', '?page=keybmin-page-operations', 'keybmin-page-operations', 'keybmin-page-operations', 1, 1, 1, 'keybmin', 'fas fa-file-powerpoint', '[\"1\",\"2\",\"3\"]', 1528843544, 5, 0),
(7, 'Add New Page', 'Add New Page Desc', '?page=keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[\"1\",\"2\",\"3\"]', 1528843544, 6, 0),
(8, 'Page Edit', 'Page Edit Desc', '?page=keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 1, 1, 0, 'keybmin', 'fas fa-file-medical', '[\"1\",\"2\",\"3\"]', 1528843544, 6, 0),
(9, 'Page List', 'Page List Desc', '?page=keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[\"1\",\"2\",\"3\"]', 1528843544, 6, 0),
(10, 'Auth Operations', 'Auth Operations Desc', '?page=keybmin-auth-operations', 'keybmin-auth-operations', 'keybmin-auth-operations', 1, 1, 1, 'keybmin', 'fas fa-align-center', '[\"1\",\"2\",\"3\"]', 1528843544, 5, 0),
(11, 'Add New Auth', 'Add New Auth Desc', '?page=keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[\"1\",\"2\",\"3\"]', 1528843544, 10, 0),
(12, 'Auth List', 'Auth List Desc', '?page=keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 1, 1, 1, 'keybmin', 'fas fa-list-ul', '[\"1\",\"2\",\"3\"]', 1528843544, 10, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
