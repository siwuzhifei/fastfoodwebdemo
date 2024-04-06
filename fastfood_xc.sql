-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 10:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastfood_xc`
--

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `AvailabilityID` int(11) NOT NULL,
  `dateTimeFrom` datetime DEFAULT NULL,
  `dateTimeTo` int(11) DEFAULT NULL,
  `staffID` int(11) NOT NULL,
  `rosterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` varchar(30) NOT NULL,
  `ratehour` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `name`, `description`, `ratehour`) VALUES
(1, 'cook', 'works in kitchen', 50.50),
(2, 'waiter', 'front desk', 40.50),
(3, 'supervisor', 'of branch', 70.50),
(4, 'manager', 'of area', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `roster`
--

CREATE TABLE `roster` (
  `rosterID` int(11) NOT NULL,
  `dateTimeFrom` datetime NOT NULL,
  `dateTimeTo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roster`
--

INSERT INTO `roster` (`rosterID`, `dateTimeFrom`, `dateTimeTo`) VALUES
(1, '2023-05-01 08:00:00', '2023-05-01 17:00:00'),
(2, '2023-05-01 17:00:00', '2023-05-01 22:00:00'),
(3, '2023-05-02 08:00:00', '2023-05-02 17:00:00'),
(4, '2023-05-02 17:00:00', '2023-05-02 22:00:00'),
(5, '2023-05-03 08:00:00', '2023-05-03 17:00:00'),
(6, '2023-05-03 17:00:00', '2023-05-03 22:00:00'),
(7, '2023-05-04 08:00:00', '2023-05-04 17:00:00'),
(8, '2023-05-04 17:00:00', '2023-05-04 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rosterrole`
--

CREATE TABLE `rosterrole` (
  `rosterRoleID` int(11) NOT NULL,
  `qty` int(3) NOT NULL,
  `rosterID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rosterrole`
--

INSERT INTO `rosterrole` (`rosterRoleID`, `qty`, `rosterID`, `roleID`) VALUES
(1, 5, 1, 1),
(2, 6, 1, 2),
(3, 5, 2, 1),
(4, 1, 2, 3),
(5, 3, 2, 2),
(6, 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `mob` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `name`, `address`, `dateOfBirth`, `email`, `mob`, `password`, `roleID`) VALUES
(1, 'staff1', 'address1', '2020-09-01', 'email1@test.com', 'mob1', '', 1),
(2, 'staff2', 'address2', '2021-09-01', 'email2@test.com', 'mob2', '', 1),
(3, 'staff3', 'address3', '2022-09-01', 'email3@test.com', 'mob3', '', 1),
(4, 'staff4', 'address4', '2023-09-01', 'email4@test.com', 'mob4', '', 2),
(5, 'staff5', 'address5', '2024-09-01', 'email5@test.com', 'mob5', '', 3),
(6, 'staff6', 'address6', '2025-09-01', 'email6@test.com', 'mob6', '', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`AvailabilityID`),
  ADD UNIQUE KEY `staffID` (`staffID`,`rosterID`),
  ADD KEY `rosterID` (`rosterID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `roster`
--
ALTER TABLE `roster`
  ADD PRIMARY KEY (`rosterID`);

--
-- Indexes for table `rosterrole`
--
ALTER TABLE `rosterrole`
  ADD PRIMARY KEY (`rosterRoleID`),
  ADD UNIQUE KEY `rosterID` (`rosterID`,`roleID`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD KEY `email` (`email`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `AvailabilityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roster`
--
ALTER TABLE `roster`
  MODIFY `rosterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rosterrole`
--
ALTER TABLE `rosterrole`
  MODIFY `rosterRoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`),
  ADD CONSTRAINT `availability_ibfk_2` FOREIGN KEY (`rosterID`) REFERENCES `roster` (`rosterID`);

--
-- Constraints for table `rosterrole`
--
ALTER TABLE `rosterrole`
  ADD CONSTRAINT `rosterrole_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`),
  ADD CONSTRAINT `rosterrole_ibfk_2` FOREIGN KEY (`rosterID`) REFERENCES `roster` (`rosterID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
