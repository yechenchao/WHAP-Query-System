-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 18, 2015 at 06:03 AM
-- Server version: 5.5.41-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whap`
--

-- --------------------------------------------------------

--
-- Table structure for table `layerData`
--

CREATE TABLE IF NOT EXISTS `layerData` (
  `id` int(100) NOT NULL,
  `serial` int(100) NOT NULL,
  `layer` varchar(5) NOT NULL,
  `questionCode` varchar(100) NOT NULL,
  `answerNumeric` double DEFAULT NULL,
  `answerString` varchar(10000) DEFAULT NULL,
  `answerDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1972371 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layerData`
--

INSERT INTO `layerData` (`id`, `serial`, `layer`, `questionCode`, `answerNumeric`, `answerString`, `answerDate`) VALUES
(1, 1, 'L0', 'NAME', NULL, 'Peter Yeah', NULL),
(1972368, 2, 'L0', 'NAME', NULL, 'Annabelle Young', NULL),
(1972369, 1, 'L0', 'SPORTS', NULL, 'Basketball', NULL),
(1972370, 2, 'L0', 'SPORTS', NULL, 'Tennis', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layer_questionCode`
--

CREATE TABLE IF NOT EXISTS `layer_questionCode` (
  `layer` varchar(4) NOT NULL,
  `questionCode` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layer_questionCode`
--

INSERT INTO `layer_questionCode` (`layer`, `questionCode`, `id`) VALUES
('L0', 'NAME', 1),
('L0', 'SPORTS', 2);

-- --------------------------------------------------------

--
-- Table structure for table `layer_year`
--

CREATE TABLE IF NOT EXISTS `layer_year` (
  `id` int(11) NOT NULL,
  `layer` varchar(10) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layer_year`
--

INSERT INTO `layer_year` (`id`, `layer`, `year`) VALUES
(1, 'L2', 2015),
(2, 'L0', 2013),
(3, 'L1', 2014);

-- --------------------------------------------------------

--
-- Table structure for table `questionCode_description`
--

CREATE TABLE IF NOT EXISTS `questionCode_description` (
  `id` int(10) NOT NULL,
  `questionCode` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `valueType` varchar(10) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1730 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionCode_description`
--

INSERT INTO `questionCode_description` (`id`, `questionCode`, `description`, `valueType`, `category`) VALUES
(1, 'NAME', 'What is your name?', 'String', 'Administration'),
(1729, 'SPORTS', 'Which sport do you like?', 'String', 'Hobby');

-- --------------------------------------------------------

--
-- Table structure for table `questionCode_value`
--

CREATE TABLE IF NOT EXISTS `questionCode_value` (
  `id` int(10) NOT NULL,
  `questionCode` varchar(10) NOT NULL,
  `valueCode` tinyint(10) NOT NULL,
  `value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `identifier` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `identifier`) VALUES
(1, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `valueType`
--

CREATE TABLE IF NOT EXISTS `valueType` (
  `id` int(1) NOT NULL,
  `valueType` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valueType`
--

INSERT INTO `valueType` (`id`, `valueType`) VALUES
(3, 'Date'),
(2, 'MCQ'),
(4, 'Numeric'),
(1, 'String');

-- --------------------------------------------------------

--
-- Table structure for table `variableCategory`
--

CREATE TABLE IF NOT EXISTS `variableCategory` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variableCategory`
--

INSERT INTO `variableCategory` (`id`, `category`) VALUES
(1, 'Administration'),
(2, 'Hobby');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layerData`
--
ALTER TABLE `layerData`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `layer_questionCode`
--
ALTER TABLE `layer_questionCode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layer_year`
--
ALTER TABLE `layer_year`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `layer` (`layer`),
  ADD UNIQUE KEY `year` (`year`);

--
-- Indexes for table `questionCode_description`
--
ALTER TABLE `questionCode_description`
  ADD PRIMARY KEY (`questionCode`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `questionCode` (`questionCode`);

--
-- Indexes for table `questionCode_value`
--
ALTER TABLE `questionCode_value`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `valueType`
--
ALTER TABLE `valueType`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `valueType` (`valueType`);

--
-- Indexes for table `variableCategory`
--
ALTER TABLE `variableCategory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layerData`
--
ALTER TABLE `layerData`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1972371;
--
-- AUTO_INCREMENT for table `layer_questionCode`
--
ALTER TABLE `layer_questionCode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `layer_year`
--
ALTER TABLE `layer_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `questionCode_description`
--
ALTER TABLE `questionCode_description`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1730;
--
-- AUTO_INCREMENT for table `questionCode_value`
--
ALTER TABLE `questionCode_value`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `valueType`
--
ALTER TABLE `valueType`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `variableCategory`
--
ALTER TABLE `variableCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
