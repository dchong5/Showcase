-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2020 at 09:51 PM
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
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `horsepower` int(11) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `city_econ` double NOT NULL,
  `highway_econ` double NOT NULL,
  `seating` int(11) NOT NULL,
  `price` double NOT NULL,
  `pic` varchar(255) NOT NULL,
  `vid` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `type`, `horsepower`, `fuel_type`, `city_econ`, `highway_econ`, `seating`, `price`, `pic`, `vid`) VALUES
(1, 'Toyota', 'Prius', 'Sedan', 120, 'Hybrid', 4.4, 4.6, 5, 28650, 'prius.jpg', 'https://www.youtube.com/watch?v=5zoOZVU1pxg'),
(2, 'Toyota', 'Camry', 'Sedan', 208, 'Gasoline', 8.5, 6.1, 5, 27250, 'camry.jpg', 'https://www.youtube.com/watch?v=VWmoPg7wDow'),
(5, 'Ford', 'F-150', 'Truck', 325, 'Gasoline', 12.1, 9.3, 6, 30839, 'f-150.jpg', 'https://www.youtube.com/watch?v=sHH0u5v3ZE8'),
(6, 'Toyota', 'Rav4', 'SUV', 203, 'Gasoline', 8.8, 6.8, 5, 51600, 'rav4.jpg', 'https://www.youtube.com/watch?v=MepG9vNVOjk'),
(7, 'Toyota', 'Tundra', 'Truck', 381, 'Gasoline', 18, 14.2, 5, 46610, 'tundra.jpg', 'https://www.youtube.com/watch?v=6mAapLfKsa8'),
(8, 'Ford', 'Expedition', 'SUV', 375, 'Gasoline', 14.1, 10.6, 7, 61000, 'expedition.jpg', 'https://www.youtube.com/watch?v=Y67hLwxQR08'),
(9, 'Ford', 'Mustang', 'Sedan', 310, 'Gasoline', 11.2, 7.9, 5, 28080, 'mustang.jpg', 'https://www.youtube.com/watch?v=BN0yJ2nJ6W4'),
(10, 'Honda', 'Civic', 'Sedan', 158, 'Gasoline', 7.9, 6.1, 5, 25196, 'civic.jpg', 'https://www.youtube.com/watch?v=XLj3ZyCmUAA'),
(11, 'Honda', 'Pilot', 'Van', 262, 'Gasoline', 12.4, 9.3, 7, 44256, 'pilot.jpg', 'https://www.youtube.com/watch?v=1H2hJXNYauQ'),
(12, 'Honda', 'Ridgeline', 'Truck', 262, 'Gasoline', 12.6, 10, 6, 44671, 'ridgeline.jpg', 'https://www.youtube.com/watch?v=-W_QnW1Mb48'),
(25, 'Cadillac', 'Escalade', 'SUV', 420, 'Gasoline', 17, 11, 7, 99298, 'escalade.jpg', 'https://www.youtube.com/watch?v=faSX3-ObA2A'),
(26, 'Hyundai', 'Sonata', 'Sedan', 191, 'Gasoline', 8.8, 6.4, 5, 27149, 'sonata.jpg', 'https://www.youtube.com/watch?v=QFGpSdSB6NM'),
(27, 'Hyundai', 'Santa Fe', 'SUV', 185, 'Gasoline', 10.8, 8, 5, 29242, 'santafe.jpg', 'https://www.youtube.com/watch?v=EGqidg60qew'),
(28, 'Kia', 'Stinger', 'Sedan', 365, 'Gasoline', 13.6, 9.6, 5, 44995, 'stinger.jpg', 'https://www.youtube.com/watch?v=38nDEvihRUk'),
(29, 'Kia', 'Telluride', 'SUV', 291, 'Gasoline', 12.5, 9.6, 7, 44995, 'telluride.jpg', 'https://www.youtube.com/watch?v=v8bqw7qjwus'),
(30, 'Dodge', 'Ram', 'Truck', 305, 'Diesel', 22, 20, 5, 47695, 'ram.jpg', 'https://www.youtube.com/watch?v=mXkcRKvTQ9M'),
(31, 'Volkswagon', 'Jetta', 'Sedan', 120, 'Gasoline', 7.8, 7.3, 5, 21595, 'jetta.jpg', 'https://www.youtube.com/watch?v=VPDoBbfL7-E'),
(32, 'Volkswagon', 'Tiguan', 'SUV', 184, 'Gasoline', 11, 8.1, 7, 29795, 'tiguan.jpg', 'https://www.youtube.com/watch?v=6mX8ynu7PQs'),
(33, 'Ford', 'F-350', 'Truck', 385, 'Diesel', 17.7, 13.2, 5, 80119, 'f350.jpg', 'https://www.youtube.com/watch?v=_M0OITI5vgc'),
(34, 'Dodge', 'Charger', 'Sedan', 485, 'Gasoline', 18, 15, 5, 38795, 'charger.jpg', 'https://www.youtube.com/watch?v=pgguJ-XYkXY'),
(35, 'Hyundai', 'Genesis', 'Sedan', 311, 'Gasoline', 12.1, 10.8, 5, 43575, 'genesis.jpg', 'https://www.youtube.com/watch?v=0cilSuj2LSM'),
(36, 'Subaru', 'Impreza', 'Sedan', 152, 'Gasoline', 9.6, 8.1, 5, 19995, 'impreza.jpg', 'https://www.youtube.com/watch?v=5XAyUL2WAJk'),
(37, 'Chevrolet', 'Malibu', 'Sedan', 160, 'Gasoline', 8.2, 7.3, 5, 37848, 'malibu.jpg', 'https://www.youtube.com/watch?v=h4J9o4_lNEM'),
(38, 'Chevrolet', 'Silverado', 'Truck', 310, 'Diesel', 15.8, 13.9, 5, 31398, 'silverado.jpg', 'https://www.youtube.com/watch?v=7OJjLNO1IBw'),
(39, 'Chrysler', 'Pacifica', 'Van', 260, 'Gasoline', 13.5, 12.5, 7, 36540, 'pacifica.jpg', 'https://www.youtube.com/watch?v=D0jCClgvhug'),
(40, 'Nissan', 'Quest', 'Van', 260, 'Gasoline', 13.8, 10.8, 7, 30280, 'quest.jpg', 'https://www.youtube.com/watch?v=3ZiaJRX84bI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
