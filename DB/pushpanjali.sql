-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2013 at 11:04 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pushpanjali`
--

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE IF NOT EXISTS `master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `cr` int(11) NOT NULL,
  `dr` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `type`, `type_id`, `date`, `cr`, `dr`, `status`) VALUES
(1, 'vazhipadu', 1, '2013-10-28', 12, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pooja`
--

CREATE TABLE IF NOT EXISTS `pooja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pooja` text COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  `bhogam_melsanthi` double NOT NULL DEFAULT '0',
  `bhogam_kazakam` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`id`, `pooja`, `rate`, `bhogam_melsanthi`, `bhogam_kazakam`) VALUES
(8, 'ഗുരുതിപുഷ്പാഞ്ജലി', 12, 2, 1),
(9, 'ഗുരുതി', 10, 0, 0),
(10, 'സമര്‍പണം', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `star`
--

CREATE TABLE IF NOT EXISTS `star` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starname` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `star`
--

INSERT INTO `star` (`id`, `starname`) VALUES
(1, 'അത്തം'),
(2, 'ചിത്തിര'),
(3, 'ചോതി'),
(4, 'വിശാകം');

-- --------------------------------------------------------

--
-- Table structure for table `vazhipadu`
--

CREATE TABLE IF NOT EXISTS `vazhipadu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `star` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `pooja` int(11) NOT NULL,
  `vazhipadu_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `booking_date` date DEFAULT NULL,
  `booking_to` date DEFAULT NULL,
  `receipt_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vazhipadu`
--

INSERT INTO `vazhipadu` (`id`, `name`, `star`, `amount`, `quantity`, `pooja`, `vazhipadu_date`, `status`, `booking_date`, `booking_to`, `receipt_number`) VALUES
(1, 'ജിസ്മി', 1, 12, 1, 8, '2013-10-28', 0, '2013-10-30', '2013-10-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_date` date NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `purpose` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_head`
--

CREATE TABLE IF NOT EXISTS `voucher_head` (
  `vou_hd_id` int(11) NOT NULL AUTO_INCREMENT,
  `vou_head` text NOT NULL,
  PRIMARY KEY (`vou_hd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `voucher_head`
--

INSERT INTO `voucher_head` (`vou_hd_id`, `vou_head`) VALUES
(1, 'Store'),
(2, 'Miscellaneous'),
(3, 'Advance'),
(4, 'Fixed Asset');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
