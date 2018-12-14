-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 10:37 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `image`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `resolution` varchar(30) NOT NULL,
  `size` varbinary(100) NOT NULL,
  `source` varchar(32) NOT NULL,
  `category` varchar(100) NOT NULL,
  `credits` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `userType` char(20) NOT NULL,
  `credits` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `lastName`, `firstName`, `userName`, `password`, `userType`, `credits`) VALUES
(1, 'Yam', 'Austin', 'Ditsum', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', 'regular', 1106),
(2, 'Last', 'First', 'TEST', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', 'regular', NULL),
(3, 'Yam', 'Yung', 'JamOfYam', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 50),
(4, 'Yam', 'Austin', 'Test', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 177),
(5, 'demo', 'dem', 'Demo', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 28),
(6, 'demo', 'demo', 'Demo1', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 50),
(7, 'demo', 'demo', 'Demoer', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 6),
(8, 'demo', 'demo', 'Demo123', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 41),
(9, 'test', 'test', 'Tester', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 51),
(10, 'test', 'test', 'test1', 'e6b6afbd6d76bb5d2041542d7d2e3fac5bb05593', '', 9);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(10) UNSIGNED NOT NULL,
  `resolution` varchar(30) NOT NULL,
  `size` varbinary(100) NOT NULL,
  `source` varchar(32) NOT NULL,
  `category` varchar(100) NOT NULL,
  `credits` int(200) DEFAULT NULL,
  `postDate` date NOT NULL,
  `contrib` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `resolution`, `size`, `source`, `category`, `credits`, `postDate`, `contrib`) VALUES
(56, '251x201', 0x31302e3138204b42, 'beatlesnew.png', 'music', 11, '2018-12-13', 'Test'),
(57, '251x201', 0x31302e3138204b42, 'beatlesnew.png', 'music', 11, '2018-12-13', 'Test'),
(59, '194x259', 0x31302e3537204b42, 'affectionnew.png', 'mood', 6, '2018-12-13', 'Test'),
(64, '275x183', 0x352e3238204b42, 'asthetichandsnew.png', 'nothing', 16, '2018-12-13', 'Test'),
(66, '209x241', 0x342e3036204b42, 'lightsnew.png', 'art', 18, '2018-12-13', 'Test'),
(67, '236x214', 0x362e3332204b42, 'applenew.png', 'fruit', 15, '2018-12-13', 'Test'),
(68, '198x254', 0x31312e3333204b42, 'astheticnew.png', 'art', 6, '2018-12-13', 'Test'),
(69, '225x225', 0x352e3938204b42, 'darthvadernew.png', 'starwars', 7, '2018-12-13', 'Test'),
(70, '275x183', 0x392e3236204b42, 'jacksparrownew.png', 'pirate', 16, '2018-12-13', 'Test'),
(71, '259x194', 0x31302e3137204b42, 'quadmirenew.png', 'giggity', 17, '2018-12-13', 'Test'),
(72, '275x183', 0x31362e3533204b42, 'pizzanew.png', 'food', 15, '2018-12-13', 'Test'),
(73, '275x183', 0x31302e3538204b42, 'ledzepplinnew.png', 'music', 6, '2018-12-13', 'Demoer'),
(74, '184x274', 0x362e3134204b42, 'monalisanew.png', 'art', 12, '2018-12-13', 'Demo123'),
(75, '239x211', 0x342e3838204b42, 'eminemnew.png', 'music', 13, '2018-12-13', 'Tester'),
(76, '275x183', 0x342e3038204b42, 'metallicanew.png', 'music', 9, '2018-12-13', 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `orderNumber` int(10) UNSIGNED NOT NULL,
  `customerID` varchar(40) NOT NULL,
  `imageID` varchar(40) NOT NULL,
  `source` varchar(32) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `transactionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`orderNumber`, `customerID`, `imageID`, `source`, `category`, `transactionDate`) VALUES
(1, '1', '4', 'kurt.jpg', NULL, '2018-12-11'),
(3, '1', '17', 'forest.jpg', NULL, '2018-12-11'),
(5, '1', '21', 'pineapple.jpg', NULL, '2018-12-11'),
(10, '1', '22', 'kurt.jpg', NULL, '2018-12-12'),
(14, '1', '31', 'michaeljackson.jpg', '', '2018-12-12'),
(15, '1', '32', 'clouds.jpg', '', '2018-12-12'),
(17, '1', '37', 'asthetichands.jpg', '', '2018-12-12'),
(18, '1', '34', 'clouds.jpg', '', '2018-12-12'),
(19, '1', '36', 'beatles.jpg', '', '2018-12-12'),
(21, '1', '35', 'clouds.jpg', '', '2018-12-12'),
(22, '1', '38', 'asthetichands.jpg', '', '2018-12-12'),
(23, '1', '42', 'beatles.jpg', '', '2018-12-13'),
(24, '1', '46', 'photo.jpg', '', '2018-12-13'),
(25, '1', '50', 'apple.jpg', 'fruit', '2018-12-13'),
(26, '4', '59', 'affection.jpg', 'mood', '2018-12-13'),
(29, '4', '64', 'asthetichands.jpg', 'nothing', '2018-12-13'),
(30, '4', '56', 'beatles.jpg', 'music', '2018-12-13'),
(31, '4', '59', 'affection.jpg', 'mood', '2018-12-13'),
(32, '4', '56', 'beatles.jpg', 'music', '2018-12-13'),
(33, '4', '56', 'beatles.jpg', 'music', '2018-12-13'),
(34, '1', '56', 'beatles.jpg', 'music', '2018-12-13'),
(35, '1', '57', 'beatles.jpg', 'music', '2018-12-13'),
(36, '1', '64', 'asthetichands.jpg', 'nothing', '2018-12-13'),
(37, '1', '66', 'lights.jpg', 'art', '2018-12-13'),
(38, '1', '69', 'darthvader.jpg', 'starwars', '2018-12-13'),
(39, '4', '67', 'apple.jpg', 'fruit', '2018-12-13'),
(40, '4', '69', 'darthvader.jpg', 'starwars', '2018-12-13'),
(42, '5', '68', 'asthetic.jpg', 'art', '2018-12-13'),
(43, '5', '56', 'beatles.jpg', 'music', '2018-12-13'),
(44, '7', '57', 'beatles.jpg', 'music', '2018-12-13'),
(45, '7', '66', 'lights.jpg', 'art', '2018-12-13'),
(46, '7', '68', 'asthetic.jpg', 'art', '2018-12-13'),
(47, '7', '67', 'apple.jpg', 'fruit', '2018-12-13'),
(48, '8', '67', 'apple.jpg', 'fruit', '2018-12-13'),
(49, '8', '68', 'asthetic.jpg', 'art', '2018-12-13'),
(50, '9', '74', 'monalisa.jpg', 'art', '2018-12-13'),
(51, '10', '72', 'pizza.jpg', 'food', '2018-12-13'),
(53, '10', '56', 'beatles.jpg', 'music', '2018-12-13'),
(54, '10', '68', 'asthetic.jpg', 'art', '2018-12-13'),
(55, '10', '73', 'ledzepplin.jpg', 'music', '2018-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `trending`
--

CREATE TABLE `trending` (
  `id` int(10) UNSIGNED NOT NULL,
  `source` varchar(32) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`orderNumber`);

--
-- Indexes for table `trending`
--
ALTER TABLE `trending`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `orderNumber` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2076;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
