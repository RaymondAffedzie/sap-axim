-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 12:29 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sap_axim`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Id` int(11) NOT NULL,
  `PiD` int(11) NOT NULL,
  `Street_name` varchar(30) DEFAULT NULL,
  `House_number` varchar(10) DEFAULT NULL,
  `GPS_address` varchar(15) NOT NULL,
  `Postal_address` varchar(30) DEFAULT NULL,
  `Phone_number` varchar(18) NOT NULL,
  `Email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `church`
--

CREATE TABLE `church` (
  `Id` int(11) NOT NULL,
  `PiD` int(11) NOT NULL,
  `Baptism_card_number` varchar(10) DEFAULT NULL,
  `Baptism_date` date DEFAULT NULL,
  `Confirmation_number` varchar(10) DEFAULT NULL,
  `Confirmation_datE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `Id` int(11) NOT NULL,
  `Pid` int(11) NOT NULL,
  `Mother_name` varchar(50) NOT NULL,
  `M_decease` char(1) NOT NULL,
  `Father_name` varchar(50) NOT NULL,
  `F_decease` char(1) NOT NULL,
  `Next_of_kin` varchar(50) DEFAULT NULL,
  `NoK_contact` varchar(18) DEFAULT NULL,
  `NoK_GPS_address` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `other_info`
--

CREATE TABLE `other_info` (
  `Id` int(11) NOT NULL,
  `PiD` int(11) NOT NULL,
  `Marital_status` char(10) NOT NULL,
  `Number_of_children` int(11) NOT NULL,
  `Education_level` char(15) NOT NULL,
  `Occupation` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `Pwd_reset_id` int(11) NOT NULL,
  `Pwd_reset_email` varchar(60) NOT NULL,
  `Pwd_reset_token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`Pwd_reset_id`, `Pwd_reset_email`, `Pwd_reset_token`) VALUES
(9, 'raymondaffedzie@gmail.com', 463812);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `Id` int(11) NOT NULL,
  `Serial_Number` varchar(20) NOT NULL,
  `Firstname` varchar(25) NOT NULL,
  `Sur_name` varchar(25) NOT NULL,
  `Other_name` varchar(25) NOT NULL,
  `Sex` char(1) NOT NULL,
  `Birth_Date` date NOT NULL,
  `Birth_Place` varchar(20) NOT NULL,
  `Birth_Region` varchar(30) DEFAULT NULL,
  `Birth_District` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `society`
--

CREATE TABLE `society` (
  `Id` int(11) NOT NULL,
  `PiD` int(11) NOT NULL,
  `Society_name` varchar(30) DEFAULT NULL,
  `Position_held` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Firstname` varchar(25) NOT NULL,
  `Surname` varchar(25) NOT NULL,
  `Username` varchar(18) NOT NULL,
  `Phone_number` varchar(18) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Pwd_reset_token` int(11) NOT NULL,
  `Role` char(1) NOT NULL DEFAULT 'M',
  `Status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Firstname`, `Surname`, `Username`, `Phone_number`, `Email`, `Password`, `Pwd_reset_token`, `Role`, `Status`) VALUES
(2, 'Ray', 'Berth', 'berth_ray', '0247692388', 'raymondaffedzie@gmail.com', '$2y$10$lmKh11itlDVySVIa2UootOUSDS3liJWnVD6G0aIPu4rADyPgnWxum', 463812, 'A', 'A'),
(3, 'John', 'Doe', 'johndoe', '7231045687', 'johndoe@email.com', '$2y$10$vF4KjDPVUiQFVNKU3sYgZu84d8qhG87OXL7fUbjn3.PEltmnF1qpu', 0, 'M', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Relationship-Add` (`PiD`);

--
-- Indexes for table `church`
--
ALTER TABLE `church`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Relationship-Chc` (`PiD`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Relationship-Fam` (`Pid`);

--
-- Indexes for table `other_info`
--
ALTER TABLE `other_info`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Relationship-OtI` (`PiD`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`Pwd_reset_id`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `society`
--
ALTER TABLE `society`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Relationship-Sct` (`PiD`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `church`
--
ALTER TABLE `church`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_info`
--
ALTER TABLE `other_info`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `Pwd_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `society`
--
ALTER TABLE `society`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `Relationship` FOREIGN KEY (`PiD`) REFERENCES `personal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship-Add` FOREIGN KEY (`PiD`) REFERENCES `personal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `church`
--
ALTER TABLE `church`
  ADD CONSTRAINT `Relationship-Chc` FOREIGN KEY (`PiD`) REFERENCES `personal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `Relationship-Fam` FOREIGN KEY (`Pid`) REFERENCES `personal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `other_info`
--
ALTER TABLE `other_info`
  ADD CONSTRAINT `Relationship-OtI` FOREIGN KEY (`PiD`) REFERENCES `personal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `society`
--
ALTER TABLE `society`
  ADD CONSTRAINT `Relationship-Sct` FOREIGN KEY (`PiD`) REFERENCES `personal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
