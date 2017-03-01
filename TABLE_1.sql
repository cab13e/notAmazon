-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2017 at 07:25 PM
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
-- Table structure for table `TABLE 1`
--

CREATE TABLE `TABLE 1` (
  `sku` varchar(4) DEFAULT NULL,
  `model` varchar(13) DEFAULT NULL,
  `vendor` varchar(6) DEFAULT NULL,
  `operator` varchar(8) DEFAULT NULL,
  `size` varchar(4) DEFAULT NULL,
  `weight` varchar(6) DEFAULT NULL,
  `flight_time` varchar(11) DEFAULT NULL,
  `distance` varchar(5) DEFAULT NULL,
  `msrp` varchar(4) DEFAULT NULL,
  `speed` varchar(5) DEFAULT NULL,
  `gimbal` varchar(6) DEFAULT NULL,
  `video` varchar(8) DEFAULT NULL,
  `camera` varchar(7) DEFAULT NULL,
  `feature` varchar(17) DEFAULT NULL,
  `image` varchar(17) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TABLE 1`
--

INSERT INTO `TABLE 1` (`sku`, `model`, `vendor`, `operator`, `size`, `weight`, `flight_time`, `distance`, `msrp`, `speed`, `gimbal`, `video`, `camera`, `feature`, `image`) VALUES
('sku', 'model', 'vendor', 'operator', 'size', 'weight', 'flight_time', 'range', 'msrp', 'speed', 'gimbal', 'video', 'camera', 'feature', 'image'),
('D003', 'Phantom 3', 'DJI', 'single', '350', '1216', '25', '5', '999', '57', '3-axis', '', '12 mp', '', 'Phantom_3.jpg'),
('D004', 'Phantom 4', 'DJI', 'single', '350', '1380', '28', '5', '1199', '72', '3-axis', '', '12.4 mp', '', 'Phantom_4.jpg'),
('D005', 'Phantom 4 Pro', 'DJI', 'single', '350', '1288', '30', '7', '1499', '72', '3-axis', '4k 60fps', '20 mp', 'obstacle sensing,', 'Phantom_4_Pro.jpg'),
('D006', 'Inspire 1', 'DJI', 'dual', '581', '2845', '18', '7', '1999', '79', '3-axis', '4k 60fps', '12.4 mp', '', 'Inspire_1.jpg'),
('D007', 'Inspire 1 Pro', 'DJI', 'dual', '581', '2968', '18', '7', '3399', '79', '3-axis', '4k 60fps', '16 mp', '', 'Inspire_1_Pro.jpg'),
('D008', 'Inspire 2', 'DJI', 'dual', '605', '3290', '27', '7', '2999', '94', '3-axis', '4k 60fps', '16 mp', '', 'Inspire_2.jpg'),
('D009', 'Mavic', 'DJI', 'single', '335', '734', '27', '7', '999', '65', '3-axis', '4k', '12 mp', '', 'Mavic.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
