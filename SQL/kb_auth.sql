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
-- Table structure for table `kb_auth`
--

CREATE TABLE `kb_auth` (
  `id` int(11) NOT NULL,
  `authName` varchar(255) NOT NULL,
  `authDesc` text NOT NULL,
  `parentID` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kb_auth`
--

INSERT INTO `kb_auth` (`id`, `authName`, `authDesc`, `parentID`) VALUES
(1, 'Super Admin', 'Super Admin Desc', 0),
(2, 'Admin', 'Admin Desc', 0),
(3, 'User', 'User Desc', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kb_auth`
--
ALTER TABLE `kb_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kb_auth`
--
ALTER TABLE `kb_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
