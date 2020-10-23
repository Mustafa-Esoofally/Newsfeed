-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2020 at 12:05 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsfeed`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_personalisation`
--

CREATE TABLE `user_personalisation` (
  `Id` int(11) NOT NULL,
  `Keywords` text NOT NULL,
  `SelectedSources` text NOT NULL,
  `Bookmarked` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_personalisation`
--

INSERT INTO `user_personalisation` (`Id`, `Keywords`, `SelectedSources`, `Bookmarked`) VALUES
(1, 'Alibaba,Amazon,Apple,Cloud,Flipkart,GoIbibo,Mangan,Myntra,Netflix,Pepperfry,RBI,Snapchat,Social,SoftBank,Spotify,Tencent,WhiteHat Jr', 'Google Alert - wall street journal startups , Google Alert - crunchbase', '1298,2000  ,1602 ,1665,1664,1601,2174,1778,482,604,2800');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_personalisation`
--
ALTER TABLE `user_personalisation`
  ADD PRIMARY KEY (`Id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_personalisation`
--
ALTER TABLE `user_personalisation`
  ADD CONSTRAINT `user_personalisation_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
