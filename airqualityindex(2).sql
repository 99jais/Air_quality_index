-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2020 at 08:55 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airqualityindex`
--

-- --------------------------------------------------------

--
-- Table structure for table `location2`
--

CREATE TABLE `location2` (
  `AQIIndex` int(11) NOT NULL,
  `COLevel` int(11) NOT NULL,
  `LPGLevel` int(11) NOT NULL,
  `Methanelevel` int(11) NOT NULL,
  `MQ7Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location2`
--

INSERT INTO `location2` (`AQIIndex`, `COLevel`, `LPGLevel`, `Methanelevel`, `MQ7Level`) VALUES
(50, 50, 50, 50, 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location2`
--
ALTER TABLE `location2`
  ADD PRIMARY KEY (`AQIIndex`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
