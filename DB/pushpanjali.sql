-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2013 at 08:10 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `type`, `type_id`, `date`, `cr`, `dr`, `status`) VALUES
(1, 'vazhipadu', 1, '2013-11-14', 5, 0, 1),
(2, 'voucher', 1, '2013-11-14', 0, 1, 1),
(3, 'vazhipadu', 2, '2013-11-14', 5, 0, 1),
(4, 'voucher', 2, '2013-11-14', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pooja`
--

CREATE TABLE IF NOT EXISTS `pooja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pooja` text COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `bhogam_melsanthi` double NOT NULL DEFAULT '0',
  `bhogam_kazakam` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`id`, `pooja`, `rate`, `bhogam_melsanthi`, `bhogam_kazakam`) VALUES
(1, 'പുഷ്പാഞ്ജലി', 5, 1, 0.5),
(2, 'ഗുരുതി പുഷ്പാഞ്ജലി', 10, 1.5, 0.75),
(3, 'ശത്രു സംഹാര പുഷ്പാഞ്ജലി', 20, 5.5, 1.5),
(4, 'മൃത്യുഞ്ജയ പുഷ്പാഞ്ജലി', 20, 5, 1.25),
(5, 'ഭാഗ്യസൂക്ത പുഷ്പാഞ്ജലി', 20, 5, 1.25),
(6, 'സ്പെഷ്യല്‍ പുഷ്പാഞ്ജലി', 20, 5, 1.25),
(7, 'ഗുരുതി', 5, 0.5, 0),
(8, 'വെള്ളനേദ്യം', 10, 1.25, 0.6),
(9, 'കൂട്ടുപായസം', 40, 3, 0.6),
(10, 'കടുംപായസം', 50, 2.5, 0.7),
(11, 'നെയ്പായസം', 75, 3, 0.9),
(12, 'അതിമധുരപായസം', 50, 5, 1),
(13, 'പിഴിഞ്ഞുപായസം', 75, 5, 1),
(14, 'ആറുനാഴിപായസം', 400, 10, 2.5),
(15, 'പാല്‍പായസം', 50, 1.5, 0.5),
(16, 'പിതൃനമസ്കാരം', 12, 4, 0),
(18, 'കൂട്ടനമസ്കാരം', 30, 8, 0),
(19, 'ഒറ്റയപ്പം', 30, 3, 2),
(20, 'ഗണപതിഹോമം', 60, 7.5, 4),
(21, 'അഷ്ടദ്രവ്യഗണപതിഹോമം', 200, 17, 5),
(22, 'കറുകഹോമം', 50, 0, 0),
(23, 'ഭഗവതിസേവ', 100, 15, 4.25),
(24, 'സര്‍പ്പനേദ്യം', 10, 1, 0.5),
(25, 'നൂറുംപാലും', 50, 9, 2.5),
(26, 'നിറമാല', 100, 0, 45),
(27, 'നീരാഞ്ജനം', 10, 0, 0),
(28, 'പത്മമിട്ടുനേദ്യം', 15, 1.5, 1),
(29, 'ചോറൂണ്', 50, 5, 2),
(30, 'വിവാഹം', 250, 30, 20),
(31, 'വാഹനപൂജ', 100, 10, 4),
(32, 'ഒരുദിവസത്തെപൂജ', 300, 20, 5),
(33, 'ഒരുനേരപൂജ', 150, 4, 0),
(34, 'ത്രികാലപൂജ', 350, 30, 10),
(35, 'സുമംഗലിപൂജ', 500, 10, 0),
(36, 'മംഗല്യപൂജ', 500, 10, 0),
(37, 'മണ്ഡലപൂജ', 450, 20, 5),
(38, 'ചന്ദനംചാര്‍ത്ത്(മുഖം)', 30, 15, 0),
(39, 'കൈവെട്ടഗുരുതി', 10, 2, 0),
(40, 'പന്തീരാഴി', 800, 20, 0),
(41, 'അരപന്തീരഴി', 400, 10, 0),
(42, 'കാല്‍പന്തീരാഴി', 250, 10, 2.5),
(43, 'ത്രിമധുരം', 30, 1, 0),
(44, 'കലംകരിക്കല്‍', 10, 1, 0),
(45, 'തുലാഭാരം', 20, 0, 0),
(46, 'ഭരണിഊട്ട്', 250, 0, 0),
(47, 'മധുപൂജ', 250, 0, 0),
(48, 'വലിയഗുരുതി', 5500, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `star`
--

CREATE TABLE IF NOT EXISTS `star` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starname` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `star`
--

INSERT INTO `star` (`id`, `starname`) VALUES
(1, 'അശ്വതി'),
(2, 'ഭരണി'),
(3, 'കാര്‍ത്തിക'),
(4, 'രോഹിണി'),
(5, 'മകയിരം'),
(6, 'തിരുവാതിര'),
(7, 'പുണര്‍തം'),
(8, 'പൂയം'),
(9, 'ആയില്യം'),
(10, 'മകം'),
(11, 'പൂരം'),
(12, 'ഉത്രം'),
(13, 'അത്തം'),
(14, 'ചിത്തിര'),
(15, 'ചോതി'),
(16, 'വിശാഖം'),
(17, 'അനിഴം'),
(18, 'തൃക്കേട്ട'),
(19, 'മൂലം'),
(20, 'പൂരാടം'),
(21, 'ഉത്രാടം'),
(22, 'തിരുവോണം'),
(23, 'അവിട്ടം'),
(24, 'ചതയം'),
(25, 'പൂരുട്ടാതി'),
(26, 'ഉത്രട്ടാതി'),
(27, 'രേവതി'),
(29, 'പൂയില്യം');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vazhipadu`
--

INSERT INTO `vazhipadu` (`id`, `name`, `star`, `amount`, `quantity`, `pooja`, `vazhipadu_date`, `status`, `booking_date`, `booking_to`, `receipt_number`) VALUES
(1, 'രതീഷ്‌', 1, 5, 1, 1, '2013-11-14', 1, '0000-00-00', '0000-00-00', 1),
(2, 'രാജേഷ്‌', 4, 5, 1, 1, '2013-11-14', 1, '0000-00-00', '0000-00-00', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `voucher_date`, `name`, `address`, `purpose`, `description`, `amount`, `status`) VALUES
(1, '2013-11-14', 'ആനന്ദ്‌', 'പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം', '5', 'പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം', 1, 1),
(2, '2013-11-14', 'Shalom Interiors', 'പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം', '5', 'പുത്തന്‍കാവ് ചാരംപറമ്പ്‌ ഭഗവതി ക്ഷേത്രം', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_head`
--

CREATE TABLE IF NOT EXISTS `voucher_head` (
  `vou_hd_id` int(11) NOT NULL AUTO_INCREMENT,
  `vou_head` text NOT NULL,
  PRIMARY KEY (`vou_hd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `voucher_head`
--

INSERT INTO `voucher_head` (`vou_hd_id`, `vou_head`) VALUES
(1, 'Store'),
(2, 'Miscellaneous'),
(3, 'Advance'),
(4, 'Fixed Asset'),
(5, 'salary');
