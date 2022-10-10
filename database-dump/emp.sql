-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2022 at 05:51 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail_id` varchar(50) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `department` text NOT NULL,
  `joining_date` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `employer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `mail_id`, `contact`, `department`, `joining_date`, `password`, `employer_id`) VALUES
(12, 'tester', 'tester@gmail.com', '123456789', 'IT', '2022-10-20', '$2y$10$UQuGqSEnMO6X3vMTUUff4urwCQ4lcA1NsVHA8aSkUSKUeCzGOfHAW', 7);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_name` text NOT NULL,
  `mail_id` varchar(50) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `employer_name`, `mail_id`, `contact`, `password`) VALUES
(7, 'xxx', 'xxx@gmail.com', '1234', '$2y$10$xNy/1HNCbyr1D8/RA01ZsuSGnoSY.VtA.SbPRgjo/u8cQvNGXt.o.');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text NOT NULL,
  `type` text NOT NULL,
  `start_time` datetime NOT NULL,
  `total_time` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `desc`, `type`, `start_time`, `total_time`, `employee_id`) VALUES
(15, 'work', 'Break', '2022-09-09 01:53:00', 20, 12),
(16, 'work', 'Work', '2022-10-09 01:54:00', 60, 12),
(17, 'break', 'Break', '2022-10-09 01:54:00', 40, 12),
(18, 'team meet', 'Meeting', '2022-10-09 01:55:00', 25, 12),
(19, 'cafe', 'Meeting', '2022-10-09 02:05:00', 80, 12),
(20, 'Binding', 'Work', '2022-10-10 02:05:00', 40, 12),
(21, 'team meet', 'Meeting', '2022-10-10 02:06:00', 25, 12),
(22, 'team meet', 'Meeting', '2022-10-10 10:31:00', 30, 12),
(23, 'break', 'Break', '2022-10-10 11:03:00', 30, 12);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
