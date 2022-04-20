-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2022 at 07:33 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oefenexamen`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `omschrijving` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `typenummer` int(11) NOT NULL,
  `aanschaffingsdatum` date DEFAULT NULL,
  `prijs` float DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5005 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `omschrijving`, `merk`, `typenummer`, `aanschaffingsdatum`, `prijs`, `status`) VALUES
(5000, 'HDMI-kabel', 'acer', 12873, '2022-04-20', 2, 'Beschikbaar'),
(5001, 'VGA-Kabel', 'acer', 1279, '2022-04-20', 3, 'Beschikbaar'),
(5002, 'Monitor 144hz', 'dell', 1672, '2022-04-20', 150, 'Uitgeleend'),
(5003, 'Mechanisch toetsenbord', 'Asus', 8212, '2022-04-20', 75.5, 'Niet-reserveerbaar'),
(5004, 'Prebuilt computer', 'Lenovo', 2378, '2022-04-20', 200, 'Beschikbaar');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `omschrijving` varchar(255) NOT NULL,
  PRIMARY KEY (`omschrijving`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`omschrijving`) VALUES
('Beschikbaar'),
('Gereserveerd'),
('Niet-reserveerbaar'),
('Uitgeleend');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
