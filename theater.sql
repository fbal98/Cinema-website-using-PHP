-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2021 at 05:16 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theater`
--
CREATE DATABASE IF NOT EXISTS `theater` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `theater`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `peopleNum` int(11) NOT NULL DEFAULT 1,
  `bookingTime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `movieID`, `userID`, `peopleNum`, `bookingTime`) VALUES
(1, 1, 2, 2, '2020-12-02'),
(2, 1, 2, 5, '2020-12-02'),
(3, 1, 2, 5, '2020-12-02'),
(4, 1, 2, 1, '2020-12-02'),
(5, 3, 2, 5, '2020-12-03'),
(6, 6, 2, 2, '2020-12-03'),
(7, 7, 2, 12, '2020-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `ageRestriction` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieID`, `name`, `description`, `ageRestriction`, `price`) VALUES
(7, 'The Shawshank Redemp', 'The Shawshank Redemption', 12, 3),
(8, 'The Godfather', 'The GodfatherThe GodfatherThe GodfatherThe Godfather', 17, 30),
(9, 'The Godfather: Part ', 'The Godfather: Part IIThe Godfather: Part II', 17, 10),
(10, 'The Dark Knight ', 'The Dark Knight The Dark Knight The Dark Knight ', 18, 12),
(11, '12 Angry Men', '12 Angry Men12 Angry Men12 Angry Men', 17, 34),
(12, 'Schindler\'s List ', 'Schindler\'s List Schindler\'s List ', 12, 11),
(13, 'The Lord of the Ring', 'The Lord of the Rings: The Return of the King ', 19, 50),
(14, 'Pulp Fiction ', 'Pulp Fiction Pulp Fiction Pulp Fiction ', 111, 50),
(15, 'Back to the future I', 'Back to the future I', 15, 22),
(16, 'Back to the future I', 'Back to the future IIBack to the future IIBack to the future II', 15, 30),
(17, 'The Good, the Bad an', 'The Good, the Bad and the Ugly', 17, 44);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `age` varchar(11) NOT NULL,
  `isAdmin` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `name`, `email`, `password`, `age`, `isAdmin`) VALUES
(1, 'admin', 'admin@admin.com', '12345', '0', 1),
(2, 'FARAS AL KHARUSI', 'firass269@gmail.com', '12', '0-12', 1),
(8, 'faras k', 'fbal@umich.edu', '12', '18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
