-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2021 at 06:30 PM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Contracts`
--

CREATE TABLE IF NOT EXISTS `Contracts` (
  `DateOfContracts` date DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `BusinessName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HomeNumber` int(11) DEFAULT NULL,
  `ContractID` int(11) NOT NULL,
  `PriceID` int(11) DEFAULT NULL,
  `Accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ContractID`),
  UNIQUE KEY `ContractID` (`ContractID`),
  KEY `HomeNumber` (`HomeNumber`),
  KEY `BusinessName` (`BusinessName`),
  KEY `PriceID` (`PriceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Contracts`
--

-- --------------------------------------------------------

--
-- Table structure for table `Disputes`
--

CREATE TABLE IF NOT EXISTS `Disputes` (
  `DisputeID` int(11) NOT NULL,
  `DisputeDate` date NOT NULL,
  `ContractID` int(11) NOT NULL,
  `DisputeDetails` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`DisputeID`),
  KEY `ContractID` (`ContractID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Disputes`
--


-- --------------------------------------------------------

--
-- Table structure for table `HomeDetails`
--

CREATE TABLE IF NOT EXISTS `HomeDetails` (
  `HomeNumber` int(11) NOT NULL,
  `Address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HomePrice` float DEFAULT NULL,
  `TypeOfHome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FloorSqFt` int(11) DEFAULT NULL,
  `ConstructionsType` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `YardSqFt` int(11) DEFAULT NULL,
  `TypesOfPlants` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GarageSize` int(11) DEFAULT NULL,
  `Bathrooms` int(11) DEFAULT NULL,
  `Bedrooms` int(11) DEFAULT NULL,
  `Area` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`HomeNumber`),
  UNIQUE KEY `HomeNumber` (`HomeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `HomeDetails`
--


-- --------------------------------------------------------

--
-- Table structure for table `Owners`
--

CREATE TABLE IF NOT EXISTS `Owners` (
  `AccountID` int(11) NOT NULL,
  `HomeNumber` int(11) DEFAULT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TelephoneNumbers` int(11) DEFAULT NULL,
  `EmailAddress` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreditCard` bigint(20) DEFAULT NULL,
  `BankInformation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`AccountID`),
  UNIQUE KEY `AccountID` (`AccountID`),
  KEY `HomeNumber` (`HomeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Owners`
--


-- --------------------------------------------------------

--
-- Table structure for table `PricingQuotes`
--

CREATE TABLE IF NOT EXISTS `PricingQuotes` (
  `Cost` float DEFAULT NULL,
  `PerWhat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PriceID` int(11) NOT NULL,
  `BusinessName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ServiceName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`PriceID`),
  UNIQUE KEY `PriceID` (`PriceID`),
  KEY `BusinessName` (`BusinessName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `PricingQuotes`
--

-- --------------------------------------------------------

--
-- Table structure for table `ServiceProviders`
--

CREATE TABLE IF NOT EXISTS `ServiceProviders` (
  `BusinessName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ContactInformation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreditCard` bigint(20) DEFAULT NULL,
  `BankInformation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TypeOfService` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Speciality` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Liscence` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ServiceArea` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`BusinessName`),
  UNIQUE KEY `BusinessName` (`BusinessName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ServiceProviders`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Contracts`
--
ALTER TABLE `Contracts`
  ADD CONSTRAINT `Contracts_ibfk_1` FOREIGN KEY (`HomeNumber`) REFERENCES `HomeDetails` (`HomeNumber`),
  ADD CONSTRAINT `Contracts_ibfk_2` FOREIGN KEY (`BusinessName`) REFERENCES `ServiceProviders` (`BusinessName`),
  ADD CONSTRAINT `Contracts_ibfk_3` FOREIGN KEY (`PriceID`) REFERENCES `PricingQuotes` (`PriceID`);

--
-- Constraints for table `Disputes`
--
ALTER TABLE `Disputes`
  ADD CONSTRAINT `Disputes_ibfk_1` FOREIGN KEY (`ContractID`) REFERENCES `Contracts` (`ContractID`);

--
-- Constraints for table `Owners`
--
ALTER TABLE `Owners`
  ADD CONSTRAINT `Owners_ibfk_1` FOREIGN KEY (`HomeNumber`) REFERENCES `HomeDetails` (`HomeNumber`);

--
-- Constraints for table `PricingQuotes`
--
ALTER TABLE `PricingQuotes`
  ADD CONSTRAINT `PricingQuotes_ibfk_1` FOREIGN KEY (`BusinessName`) REFERENCES `ServiceProviders` (`BusinessName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
