-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2017 at 01:08 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kp_traffic_police`
--

-- --------------------------------------------------------

--
-- Table structure for table `challan`
--

CREATE TABLE IF NOT EXISTS `challan` (
  `challan_id` int(11) NOT NULL AUTO_INCREMENT,
  `challan_no` int(11) NOT NULL,
  `challan_status` varchar(20) NOT NULL,
  PRIMARY KEY (`challan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type_id` int(11) NOT NULL,
  `signup_id` int(11) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `complaint_type_id`, `signup_id`, `latitude`, `longitude`, `description`, `image`, `video`) VALUES
(1, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked.jpg', 'video here'),
(2, 1, 2, 23.988001, -29.677999, 'wrong parking', '<p>The file you are attempting to upload is larger than the permitted size.</p>', 'video here'),
(3, 1, 2, 23.988001, -29.677999, 'wrong parking', '<p>The file you are attempting to upload is larger than the permitted size.</p>', 'video uploaded'),
(4, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked1.jpg', 'video uploaded'),
(5, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked2.jpg', 'video uploaded'),
(6, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked3.jpg', 'video uploaded'),
(7, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked4.jpg', 'video uploaded'),
(8, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked5.jpg', 'video uploaded'),
(9, 1, 2, 23.988001, -29.677999, 'wrong parking', 'parking21.jpg', 'video uploaded'),
(10, 1, 2, 23.988001, -29.677999, 'wrong parking', 'parking213.jpg', '11_Second_Animation_-_YouTube.MP4'),
(11, 1, 2, 23.988001, -29.677999, 'wrong parking', 'parking214.jpg', '11_Second_Animation_-_YouTube1.MP4'),
(12, 1, 2, 23.988001, -29.677999, 'wrong parking', 'parking216.jpg', 'Zombie_Kid_Likes_Turtles_-_YouTube.MP4'),
(13, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked8.jpg', ''),
(14, 1, 2, 23.988001, -29.677999, 'wrong parking', '', '11_Second_Animation_-_YouTube2.MP4'),
(18, 1, 2, 23.988001, -29.677999, 'wrong parking', 'parking219.jpg', ''),
(24, 1, 2, 23.988001, -29.677999, 'wrong parking', '', 'Zombie_Kid_Likes_Turtles_-_YouTube1.MP4'),
(25, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked9.jpg', ''),
(26, 1, 2, 23.988001, -29.677999, 'wrong parking', 'parking21.jpg', ''),
(27, 1, 2, 23.988001, -29.677999, 'wrong parking', '', 'Zombie_Kid_Likes_Turtles_-_YouTube2.MP4'),
(28, 1, 2, 23.988001, -29.677999, 'wrong parking', '', '11_Second_Animation_-_YouTube3.MP4'),
(29, 1, 2, 23.988001, -29.677999, 'wrong parking', 'car_Parked1.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_types`
--

CREATE TABLE IF NOT EXISTS `complaint_types` (
  `complaint_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type` varchar(255) NOT NULL,
  PRIMARY KEY (`complaint_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `complaint_types`
--

INSERT INTO `complaint_types` (`complaint_type_id`, `complaint_type`) VALUES
(1, 'illegal parking'),
(2, 'corruption'),
(3, 'signal violation'),
(4, 'warden complaint');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE IF NOT EXISTS `emergency_contacts` (
  `emergency_id` int(11) NOT NULL AUTO_INCREMENT,
  `emergency_name` varchar(255) NOT NULL,
  PRIMARY KEY (`emergency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts_detail`
--

CREATE TABLE IF NOT EXISTS `emergency_contacts_detail` (
  `emergency_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `emergency_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  PRIMARY KEY (`emergency_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `license_verification`
--

CREATE TABLE IF NOT EXISTS `license_verification` (
  `license_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(255) NOT NULL,
  `candidate_father_name` varchar(255) NOT NULL,
  `candidate_cnic` varchar(30) NOT NULL,
  `candidate_license_no` varchar(30) NOT NULL,
  `candidate_district` varchar(255) NOT NULL,
  `license_status` varchar(25) NOT NULL,
  `license_issue_date` date NOT NULL,
  `license_expiry_date` date NOT NULL,
  PRIMARY KEY (`license_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `signup_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnic` int(13) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  PRIMARY KEY (`signup_id`),
  UNIQUE KEY `cnic` (`cnic`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`signup_id`, `name`, `email`, `cnic`, `phone_no`) VALUES
(1, 'sakina', 'sakina@gmail.com', 2147483647, '0333-9872876'),
(2, 'sakina', 'sakina@gmail.com', 15403, '0333-9872876'),
(4, 'sakina', 'sakina@gmail.com', 15401, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
