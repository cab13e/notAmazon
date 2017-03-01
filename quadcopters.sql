-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2017 at 12:27 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quadcopters`
--

-- --------------------------------------------------------

--
-- Table structure for table `copters`
--

CREATE TABLE `copters` (
  `sku` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `size` int(50) NOT NULL,
  `weight` int(50) NOT NULL,
  `time` int(50) NOT NULL,
  `distance` int(50) NOT NULL,
  `speed` int(50) NOT NULL,
  `gimbal` tinyint(1) NOT NULL,
  `video` tinyint(1) NOT NULL,
  `camera` tinyint(1) NOT NULL,
  `Features` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
