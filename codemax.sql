-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2018 at 01:11 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codemax`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_info`
--

DROP TABLE IF EXISTS `manufacturer_info`;
CREATE TABLE IF NOT EXISTS `manufacturer_info` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `ManufacturerName` varchar(300) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer_info`
--

INSERT INTO `manufacturer_info` (`Id`, `ManufacturerName`, `Status`, `CreatedOn`, `UpdatedOn`) VALUES
(1, 'BMW', 'active', '2018-07-18 18:37:23', '2018-07-18 18:37:23'),
(2, 'Ford', 'active', '2018-07-18 18:37:27', '2018-07-18 18:37:27'),
(3, 'Nisan', 'active', '2018-07-18 18:37:31', '2018-07-18 18:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `model_info`
--

DROP TABLE IF EXISTS `model_info`;
CREATE TABLE IF NOT EXISTS `model_info` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `ManufacturerId` int(10) NOT NULL,
  `ModelName` varchar(300) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model_info`
--

INSERT INTO `model_info` (`Id`, `ManufacturerId`, `ModelName`, `Status`, `CreatedOn`, `UpdatedOn`) VALUES
(1, 1, 'X3', 'active', '2018-07-18 18:37:59', '2018-07-18 18:37:59'),
(2, 1, 'X1', 'active', '2018-07-18 18:38:07', '2018-07-18 18:38:07'),
(3, 1, 'X6', 'active', '2018-07-18 18:38:26', '2018-07-18 18:38:26'),
(4, 2, 'Figo', 'active', '2018-07-18 18:38:49', '2018-07-18 18:38:49'),
(5, 2, 'Aspire', 'active', '2018-07-18 18:38:57', '2018-07-18 18:38:57'),
(6, 2, 'EcoSport', 'active', '2018-07-18 18:39:04', '2018-07-18 18:39:04'),
(7, 3, 'GTR', 'active', '2018-07-18 18:39:34', '2018-07-18 18:39:34'),
(8, 3, 'Kicks', 'active', '2018-07-18 18:39:45', '2018-07-18 18:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `model_transaction`
--

DROP TABLE IF EXISTS `model_transaction`;
CREATE TABLE IF NOT EXISTS `model_transaction` (
  `Id` int(9) NOT NULL AUTO_INCREMENT,
  `ModelId` int(9) NOT NULL,
  `ModelCount` int(9) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `ModelId` (`ModelId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model_transaction`
--

INSERT INTO `model_transaction` (`Id`, `ModelId`, `ModelCount`, `CreatedOn`, `UpdatedOn`) VALUES
(1, 1, 10, '2018-07-18 18:37:59', '2018-07-18 18:37:59'),
(2, 2, 7, '2018-07-18 18:38:07', '2018-07-18 18:40:29'),
(3, 3, 2, '2018-07-18 18:38:26', '2018-07-18 18:40:13'),
(4, 4, 22, '2018-07-18 18:38:49', '2018-07-18 18:38:49'),
(5, 5, 44, '2018-07-18 18:38:57', '2018-07-18 18:38:57'),
(6, 6, 99, '2018-07-18 18:39:04', '2018-07-18 18:39:04'),
(7, 7, 2, '2018-07-18 18:39:34', '2018-07-18 18:39:34'),
(8, 8, 3, '2018-07-18 18:39:45', '2018-07-18 18:39:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
