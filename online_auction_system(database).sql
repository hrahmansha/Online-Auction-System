-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 10:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_auction_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `Bid_ID` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Top_Bid` int(11) NOT NULL,
  `Top_Bidder_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Seller_ID` int(11) NOT NULL,
  `Time_Track` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`Bid_ID`, `Status`, `Top_Bid`, `Top_Bidder_ID`, `Product_ID`, `Seller_ID`, `Time_Track`) VALUES
(1, 'ongoing', 5500, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `Image_ID` int(11) NOT NULL,
  `Path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`Image_ID`, `Path`) VALUES
(1, 'ppp'),
(2, 'qqq');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `ID` int(11) NOT NULL,
  `Name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`ID`, `Name`) VALUES
(1, 'Dhaka'),
(2, 'Chittagong'),
(3, 'Rajshahi'),
(4, 'Sylhet'),
(5, 'Khulna'),
(6, 'Barisal'),
(7, 'Rangpur');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(20) NOT NULL,
  `Category` varchar(15) NOT NULL,
  `Initial_Bid` int(11) NOT NULL,
  `Description` varchar(80) NOT NULL,
  `Seller_ID` int(11) NOT NULL,
  `Location` int(11) NOT NULL,
  `Bid_Time_Track_ID` int(11) NOT NULL,
  `Image_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Category`, `Initial_Bid`, `Description`, `Seller_ID`, `Location`, `Bid_Time_Track_ID`, `Image_ID`) VALUES
(1, 'TGM Guitar', 'Property', 5000, 'good sound quality', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `time_track`
--

CREATE TABLE `time_track` (
  `Track_ID` int(11) NOT NULL,
  `Start_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `End_Time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_track`
--

INSERT INTO `time_track` (`Track_ID`, `Start_Time`, `End_Time`) VALUES
(1, '2019-04-23 04:00:00', '2019-04-23 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `user_ID` int(11) NOT NULL,
  `First_Name` char(15) NOT NULL,
  `Last_name` char(15) NOT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Phone_No` char(12) NOT NULL,
  `Passward` varchar(15) NOT NULL,
  `Location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`user_ID`, `First_Name`, `Last_name`, `Email`, `Phone_No`, `Passward`, `Location`) VALUES
(1, 'shamim', 'ahmed', 'shamimmahmed04@gmail.com', '111', '1234', 1),
(2, 'sajib', 'ahmed', 'saifullahsajib@gmail.com', '111', '1234', 1),
(3, 'habibur', 'rahman', 'habiburrahmanshamim@hotmail.com', '111', '1234', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`Bid_ID`),
  ADD KEY `Top_Bidder_ID` (`Top_Bidder_ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `Seller_ID` (`Seller_ID`),
  ADD KEY `Time_Track` (`Time_Track`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`Image_ID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Seller_ID` (`Seller_ID`),
  ADD KEY `Location` (`Location`),
  ADD KEY `Bid_Time_Track_ID` (`Bid_Time_Track_ID`),
  ADD KEY `Image_ID` (`Image_ID`);

--
-- Indexes for table `time_track`
--
ALTER TABLE `time_track`
  ADD PRIMARY KEY (`Track_ID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `Location` (`Location`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`Top_Bidder_ID`) REFERENCES `userinfo` (`user_ID`),
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`),
  ADD CONSTRAINT `bid_ibfk_3` FOREIGN KEY (`Seller_ID`) REFERENCES `userinfo` (`user_ID`),
  ADD CONSTRAINT `bid_ibfk_4` FOREIGN KEY (`Time_Track`) REFERENCES `time_track` (`Track_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Seller_ID`) REFERENCES `userinfo` (`user_ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Location`) REFERENCES `locations` (`ID`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`Bid_Time_Track_ID`) REFERENCES `time_track` (`Track_ID`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`Image_ID`) REFERENCES `image` (`Image_ID`);

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`Location`) REFERENCES `locations` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
