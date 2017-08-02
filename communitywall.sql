-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2016 at 07:49 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `communitywall`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fill_date_dimension`(IN startdate DATE,IN stopdate DATE)
BEGIN
    DECLARE currentdate DATE;
    SET currentdate = startdate;
    WHILE currentdate < stopdate DO
        INSERT INTO time_dimension VALUES (
                        YEAR(currentdate)*10000+MONTH(currentdate)*100 + DAY(currentdate),
                        currentdate,
                        YEAR(currentdate),
                        MONTH(currentdate),
                        DAY(currentdate),
                        QUARTER(currentdate),
                        WEEKOFYEAR(currentdate),
                        DATE_FORMAT(currentdate,'%W'),
                        DATE_FORMAT(currentdate,'%M'),
                        'f',
                        CASE DAYOFWEEK(currentdate) WHEN 1 THEN 't' WHEN 7 then 't' ELSE 'f' END,
                        NULL);
        SET currentdate = ADDDATE(currentdate,INTERVAL 1 DAY);
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `app_id` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `settings_id` varchar(20) NOT NULL,
  `acct_id` varchar(20) NOT NULL,
  `dt_created` varchar(20) NOT NULL,
  `dt_modified` varchar(20) NOT NULL,
  `parent_id` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `app_id`, `username`, `password`, `settings_id`, `acct_id`, `dt_created`, `dt_modified`, `parent_id`) VALUES
(4, 'marco polo', '', 'foo', 'foo', '', '', '', '', ''),
(5, 'bforte', '', 'bforte', 'bforte', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `crudtable`
--

CREATE TABLE IF NOT EXISTS `crudtable` (
`id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `thing1` varchar(20) NOT NULL,
  `thing2` varchar(20) NOT NULL,
  `lotsodata` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `crudtable`
--

INSERT INTO `crudtable` (`id`, `name`, `thing1`, `thing2`, `lotsodata`, `date`) VALUES
(1, 'test data', '', '', '', ''),
(2, 'foo data', '', '', '', ''),
(3, 'asdf', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
`id` bigint(20) NOT NULL,
  `parent_id` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `date_created` tinytext NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `parent_id`, `name`, `type`, `url`, `date_created`) VALUES
(1, '99', 'foo', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `generic`
--

CREATE TABLE IF NOT EXISTS `generic` (
`id` bigint(20) NOT NULL,
  `parent_id` varchar(20) NOT NULL,
  `title` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `dt_created` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=18 ;

--
-- Dumping data for table `generic`
--

INSERT INTO `generic` (`id`, `parent_id`, `title`, `description`, `dt_created`) VALUES
(13, '4', 'auto pop parent', '', ''),
(14, '5', 'Best Hair DO', 'Mark Binghamton', ''),
(15, '4', 'Im admin 4', '', ''),
(16, '5', 'Best Impersonation', 'Sandy Holcomstein', ''),
(17, '5', 'Best Overall Costume', 'John Matricoli', '');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
`id` bigint(20) NOT NULL,
  `parent_id` tinytext NOT NULL,
  `room_name` tinytext NOT NULL,
  `time` tinytext NOT NULL,
  `reserved_by` tinytext NOT NULL,
  `dt_created` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
`id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` tinytext NOT NULL,
  `notes` tinytext NOT NULL,
  `completed` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `name`, `description`, `notes`, `completed`) VALUES
(1, 'redo documents table', 'it should include ALL the different types of documents a client created.', '', 'y'),
(2, 'Document Types', 'Generic, Meeting Reservations,etc.', '', 'y'),
(4, 'parent_id', 'transfer parent_id to document during creation.', '', 'y'),
(5, 'write file', 'write a file upon PUBLISH of document', ' ', ''),
(6, 'Analyze', 'the changes to GENERIC code ', 'Apply them to OTHER document types as well.', ''),
(7, 'Move Code', 'to shout to test dynamic data on codigo', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crudtable`
--
ALTER TABLE `crudtable`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generic`
--
ALTER TABLE `generic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `crudtable`
--
ALTER TABLE `crudtable`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `generic`
--
ALTER TABLE `generic`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
