-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2015 at 02:44 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `superapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `settings_id` bigint(20) NOT NULL,
  `contact_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `last_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, 1001, 'foo', 'nancy', 0, 0, '0000-00-00', '0000-00-00');
INSERT INTO `user` VALUES(2, 1001, 'jim', 'boo', 0, 0, '0000-00-00', '0000-00-00');
