-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2017 at 07:54 PM
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
  `image_path` varchar(255) NOT NULL,
  `video_path` varchar(255) NOT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_types`
--

CREATE TABLE IF NOT EXISTS `complaint_types` (
  `complaint_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `illegal parking` varchar(255) NOT NULL,
  `corruption` varchar(255) NOT NULL,
  `signal_violation` varchar(255) NOT NULL,
  `warden_complaint` varchar(255) NOT NULL,
  PRIMARY KEY (`complaint_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `cnic` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  PRIMARY KEY (`signup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`signup_id`, `name`, `cnic`, `password`, `phone_no`) VALUES
(1, 'shafiq', '15403-32654-3', '12345', '0333-987623'),
(2, 'Ullah', '15476-09323-6', '12344', '0347-586894'),
(3, 'Smith', '15403-36324-3', '1111', '091-559907'),
(4, 'Smith', '20403-23241-2', '1111', '0300-987616'),
(5, 'ali', '15403-12324-3', 'aliraza', '0333-987287'),
(6, 'ali', '15403-12324-3', 'aliraza', '0333-987287'),
(7, 'noor', '15403-12324-3', 'noor123', '0333-987287'),
(8, 'noor', '15403-12324-3', 'noor123', '0333-987287'),
(9, 'noor', '15403-12324-3', 'noor123', '0333-987287'),
(10, 'noor', '15403-12324-3', 'c03a3aac533b61b822448c3ab5f815', '0333-987287'),
(11, 'noor', '15403-12324-3', 'c03a3aac533b61b822448c3ab5f815', '0333-987287'),
(12, 'noor', '15403-12324-3', '2634a0dacdb96ed9920af9aca48f3b', '0333-987287'),
(13, 'naz', '9787665', 'a4797cdec634c496bc10ca82a73144', '78976876'),
(14, 'noor', '15403-12324-3', '2634a0dacdb96ed9920af9aca48f3b', '0333-9872876'),
(15, 'noor', '15403-12324-3', '2634a0dacdb96ed9920af9aca48f3b', '0333-9872876'),
(16, 'noor', '15403-12324-3', '2634a0dacdb96ed9920af9aca48f3b', '0333-9872876'),
(17, 'noor', '15403-12324-3', '2634a0dacdb96ed9920af9aca48f3b', '0333-9872876'),
(18, 'noorullah', '15403-12324-3', '2634a0dacdb96ed9920af9aca48f3b', '0333-9872876'),
(19, 'zakir', '15403-12324-3', 'fa40c09dac7fe090a4efc0f60cd01c', '0300-76472876'),
(20, 'zakir', '15403-12324-3', 'fa40c09dac7fe090a4efc0f60cd01c', '0300-76472876'),
(21, 'zakir', '15403-12324-3', 'fa40c09dac7fe090a4efc0f60cd01c', '0300-76472876'),
(22, 'saki', '15403-12324-3', '2634a0dacdb96ed9920af9aca48f3b', '0333-9872876'),
(23, 'saki', '15403-12324-3', '202cb962ac59075b964b07152d234b', '0333-9872876');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
