-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2020 at 01:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dchong5_dmit2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars_rating`
--

CREATE TABLE `cars_rating` (
  `id` int(11) NOT NULL,
  `car` varchar(255) NOT NULL,
  `rating` float NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars_rating`
--

INSERT INTO `cars_rating` (`id`, `car`, `rating`, `ip`) VALUES
(9, 'Prius', 4, '84.17.41.72'),
(10, 'Civic', 5, '84.17.41.72'),
(11, 'Ridgeline', 3, '84.17.41.72'),
(12, 'F-150', 2, '84.17.41.72'),
(13, 'Prius', 5, '66.115.147.75'),
(14, 'F-150', 2, '66.115.147.75'),
(15, 'Camry', 4, '66.115.147.75'),
(16, 'Civic', 4, '66.115.147.75');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars_rating`
--
ALTER TABLE `cars_rating`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars_rating`
--
ALTER TABLE `cars_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
