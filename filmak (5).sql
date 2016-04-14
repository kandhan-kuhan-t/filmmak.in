-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2016 at 01:54 AM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmak`
--

-- --------------------------------------------------------

--
-- Table structure for table `casting`
--

CREATE TABLE IF NOT EXISTS `casting` (
  `videoID` varchar(50) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `field` varchar(50) NOT NULL,
  `isMember` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casting`
--

INSERT INTO `casting` (`videoID`, `member_name`, `field`, `isMember`) VALUES
('m7uveDMaVG4', 'kandhan.kuhan@gmail.com', 'sfx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `username` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`username`, `contact_number`, `email_id`, `access`) VALUES
('26kandhan@gmail.com', '', '', 0),
('kandhan.kuhan@gmail.com', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `profile_name`) VALUES
('26kandhan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'kuhan kandhan'),
('kandhan.kuhan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'kandhan kuhan');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `delete_chain` BEFORE DELETE ON `users`
 FOR EACH ROW delete from users_profile
where users_profile.username = username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE IF NOT EXISTS `users_profile` (
  `profile_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'null',
  `about` text NOT NULL,
  `experience` int(100) NOT NULL DEFAULT '0',
  `field` varchar(30) NOT NULL DEFAULT 'null',
  `dob` varchar(30) NOT NULL DEFAULT 'null',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `display_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`profile_name`, `username`, `gender`, `about`, `experience`, `field`, `dob`, `timestamp`, `display_name`) VALUES
('kuhan kandhan', '26kandhan@gmail.com', 'null', '', 0, 'null', 'null', '2016-04-14 20:21:28', 'kuhan'),
('kandhan kuhan', 'kandhan.kuhan@gmail.com', 'null', '', 0, 'null', 'null', '2016-04-14 20:20:28', 'kandhan');

--
-- Triggers `users_profile`
--
DELIMITER $$
CREATE TRIGGER `below_insert_insert_into_contact` BEFORE INSERT ON `users_profile`
 FOR EACH ROW insert into contact
set username = new.username
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bi_update_users` BEFORE UPDATE ON `users_profile`
 FOR EACH ROW update users
set profile_name = new.profile_name
where username = old.username
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_chain_1` BEFORE DELETE ON `users_profile`
 FOR EACH ROW delete from contact
where contact.username = username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `username` varchar(30) NOT NULL DEFAULT '',
  `videoID` varchar(30) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL,
  `duration` varchar(30) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`username`, `videoID`, `title`, `description`, `genre`, `duration`, `views`, `upload_date`) VALUES
('26kandhan@gmail.com', 'm7uveDMaVG4', 'Check', 'Checking', 'CHK', '328', 0, '2016-04-14 19:37:23'),
('26kandhan@gmail.com', 'SxBNlcf0AzI', '...', 'CHECK', 'CHK', '317', 0, '2016-04-14 19:43:14'),
('26kandhan@gmail.com', 'U-AENMwFdt8', 'hkj', 'hjk', 'hkj', '277', 0, '2016-04-14 19:47:37'),
('26kandhan@gmail.com', 'YGf8j9Fxn4w', 'Check 2', 'Check 2', 'CHK', '159', 0, '2016-04-14 19:41:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`username`,`contact_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`username`,`videoID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
