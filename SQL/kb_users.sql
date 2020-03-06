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
-- Table structure for table `kb_users`
--

CREATE TABLE `kb_users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `session` text,
  `authID` int(11) NOT NULL,
  `seldosID` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kb_users`
--

INSERT INTO `kb_users` (`id`, `fullName`, `mail`, `phone`, `password`, `status`, `session`, `authID`, `seldosID`, `time`) VALUES
(1, 'Hasan Yüksektepe', 'hello@seldos.com.tr', '905414233558', '858e1b28d71379da6f278fcc2f3905be', 1, '6bfdd9c414eb438dab4feeca8fd5eeb6', 1, '59209c04469eb05541', 1528843544);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kb_users`
--
ALTER TABLE `kb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kb_users`
--
ALTER TABLE `kb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
