-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2011 at 09:11 PM
-- Server version: 5.1.48
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `postimer`
--

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--


-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, 'Modify Access Rights (Experts Only!)', NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;'),
('Pos.View', 0, 'View POS Timer Details', NULL, 'N;'),
('Pos.Create', 0, 'Create New POS Timers', NULL, 'N;'),
('Pos.Update', 0, 'Modify Existing POS Timers', NULL, 'N;'),
('Pos.Delete', 0, 'Delete POS Timers', NULL, 'N;'),
('Pos.Index', 0, 'View the POS Timer Index', NULL, 'N;'),
('Pos.Admin', 0, 'Manage POS Timers', NULL, 'N;'),
('FleetCommander', 2, 'Create and Delete POS Timers', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('Assignment', 'authItem.*'),
('Authenticated', 'Pos.View'),
('FleetCommander', 'Pos.Admin'),
('FleetCommander', 'Pos.Create'),
('FleetCommander', 'Pos.Delete'),
('FleetCommander', 'Pos.Index'),
('FleetCommander', 'Pos.Update'),
('FleetCommander', 'Pos.View');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rights`
--

