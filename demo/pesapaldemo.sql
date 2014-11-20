-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2014 at 04:13 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pesapaldemo`
--
-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `currency` varchar(3) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(10) NOT NULL,
  `referenceNo` varchar(20) NOT NULL,
  `trackingId` varchar(20) NOT NULL,
  `paymentMethod` varchar(20) NOT NULL,
  `userId` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `currency`, `amount`, `status`, `referenceNo`, `trackingId`, `paymentMethod`, `userId`) VALUES
(31, 'KES', 300, 'PLACED', 'jMQAbrAsWV', '', '', '17'),
(32, 'KES', 300, 'PLACED', '2JpL2g2yNF', '', '', '17'),
(33, 'KES', 500, 'PLACED', 'SVoxXK3O06', '', '', '17'),
(34, 'KES', 25, 'PLACED', 'f4Au7CYs8X', '', '', '17'),
(35, 'KES', 25, 'PLACED', 'werty', '', '', '17'),
(36, 'KES', 25, 'PLACED', 'werty', '', '', '17'),
(37, 'KES', 500, 'PLACED', 'Mf2RhdENU2', '', '', '17'),
(38, '', 0, 'PLACED', 'OTRjb5N2yD', '', '', '18'),
(39, 'KES', 500, 'PLACED', '9awpAfbsDe', '', '', '17'),
(40, 'KES', 500, 'PLACED', 'SVI7asmp0h', '', '', '17'),
(41, '', 0, 'PLACED', 'NvffKzqanj', '', '', '18'),
(42, '', 0, 'PLACED', '5zuPuF6MYK', '', '', '18'),
(43, 'KES', 500, 'PLACED', 'Ez2wzLZDZ9', '', '', '17'),
(44, 'KES', 500, 'PLACED', 'V5hypRa2Rh', '', '', '17'),
(45, '', 0, 'PLACED', 'JVnUavpeMJ', '', '', '18'),
(46, 'KES', 500, 'PLACED', 'CH1OhJWRSn', '', '', '17'),
(47, 'KES', 25, 'PLACED', '3HopeN7PBQ', '', '', '17'),
(48, 'KES', 500, 'PLACED', 'SIuSXibwRQ', '', '', '17'),
(49, 'KES', 500, 'PLACED', 'TBu0P6kSZw', '', '', '17'),
(50, 'KES', 500, 'PLACED', 'FclqLn9u67', '', '', '17'),
(51, 'KES', 500, 'PLACED', 'l0cOwu1F34', '', '', '17'),
(52, 'KES', 500, 'PLACED', 'uni13Inc2Y', '', '', '17'),
(53, 'KES', 500, 'PLACED', '', '', '', '17'),
(54, 'KES', 500, 'PLACED', '5eHNLFupiI', '', '', '17'),
(55, 'KES', 500, 'PLACED', '5mF6fGE7CM', '', '', '17'),
(56, 'KES', 500, 'PLACED', '4q9ANwLx91', '', '', '17'),
(57, 'KES', 25, 'PLACED', 'v6sAjsm9hb', '', '', '17'),
(58, 'KES', 0, 'PLACED', 'DBgLahRRZe', '', '', '18'),
(59, 'KES', 500, 'PLACED', 'PR7qOOdh2y', '', '', '17'),
(60, 'KES', 500, 'PLACED', 'NJPVvh1FtY', '', '', '17'),
(61, 'KES', 500, 'PLACED', 'DLOWwVgsm0', '', '', '17'),
(62, '', 0, 'PLACED', 'Ad2QeQm3jY', '', '', '18'),
(63, 'KES', 500, 'PLACED', 'RFq7oVFdSI', '', '', '17'),
(64, 'KES', 500, 'PLACED', '1NZc7DgxsD', '', '', '17'),
(65, 'KES', 300, 'PLACED', '23kj7IKX7L', '', '', '17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phoneNo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `phoneNo`) VALUES
(17, 'Daniel', 'John', 'danmbeyah@gmail.com', ''),
(18, '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
