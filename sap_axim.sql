-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2022 at 04:07 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `sap_axim`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Id` int(11) NOT NULL,
  `MiD` int(11) NOT NULL,
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
  `MiD` int(11) NOT NULL,
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
  `MiD` int(11) NOT NULL,
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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Id` int(11) NOT NULL,
  `Init` char(3) NOT NULL DEFAULT 'SAP',
  `Reg_year` year(4) NOT NULL,
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
-- Table structure for table `other_info`
--

CREATE TABLE `other_info` (
  `Id` int(11) NOT NULL,
  `MiD` int(11) NOT NULL,
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
(41, 'raymondaffedzie@gmail.com', 582524);

-- --------------------------------------------------------

--
-- Table structure for table `society`
--

CREATE TABLE `society` (
  `Id` int(11) NOT NULL,
  `MiD` int(11) NOT NULL,
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
(1, 'Ray', 'Berth', 'berth_ray', '0247692388', 'raymondaffedzie@gmail.com', '$2y$10$lmKh11itlDVySVIa2UootOUSDS3liJWnVD6G0aIPu4rADyPgnWxum', 463812, 'A', 'A'),
(2, 'John', 'Doe', 'johndoe', '7231045687', 'johndoe@email.com', '$2y$10$vF4KjDPVUiQFVNKU3sYgZu84d8qhG87OXL7fUbjn3.PEltmnF1qpu', 0, 'M', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `MiD` (`MiD`);

--
-- Indexes for table `church`
--
ALTER TABLE `church`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `MiD` (`MiD`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `MiD` (`MiD`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Id`,`Init`,`Reg_year`);

--
-- Indexes for table `other_info`
--
ALTER TABLE `other_info`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `MiD` (`MiD`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`Pwd_reset_id`);

--
-- Indexes for table `society`
--
ALTER TABLE `society`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `MiD` (`MiD`);

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
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
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
  MODIFY `Pwd_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `society`
--
ALTER TABLE `society`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`MiD`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `church`
--
ALTER TABLE `church`
  ADD CONSTRAINT `church_ibfk_1` FOREIGN KEY (`MiD`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`MiD`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `other_info`
--
ALTER TABLE `other_info`
  ADD CONSTRAINT `other_info_ibfk_1` FOREIGN KEY (`MiD`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `society`
--
ALTER TABLE `society`
  ADD CONSTRAINT `society_ibfk_1` FOREIGN KEY (`MiD`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;