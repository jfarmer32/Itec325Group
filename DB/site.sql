-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 06:21 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `ContentID` int(11) NOT NULL,
  `User` varchar(20) NOT NULL,
  `Image` varchar(2038) NOT NULL,
  `Hyperlink` varchar(2038) NOT NULL,
  `isContentRestricted` tinyint(1) NOT NULL DEFAULT '0',
  `ContentDate` date NOT NULL,
  `ContentTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`ContentID`, `User`, `Image`, `Hyperlink`, `isContentRestricted`, `ContentDate`, `ContentTime`) VALUES
(1, 'ckuehn', 'www.img1', 'www.site1.c', 0, '2019-04-04', '00:00:00'),
(4, 'ckuehn', 'www.img2', 'www.site2.c', 1, '2019-04-04', '00:00:00'),
(5, 'blichtma', 'www.img3', 'www.site3.c', 0, '2019-04-04', '00:00:00'),
(6, 'blichtma', 'www.img4', 'www.site4.c', 0, '2019-04-04', '00:00:00'),
(7, 'jshmoe', 'www.img5', 'www.site5.c', 1, '2019-04-04', '00:00:00'),
(8, 'jshmoe', 'www.img6', 'www.site6.c', 1, '2019-04-04', '00:00:00'),
(9, 'jshmoe', 'www.img7', 'www.site7.c', 1, '2019-04-04', '00:00:00'),
(10, 'jdoe', 'www.img8', 'www.site8.c', 0, '2019-04-04', '00:00:00'),
(11, 'jdoe', 'www.img9', 'www.site9.c', 1, '2019-04-04', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isUserRestricted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `isAdmin`, `isUserRestricted`) VALUES
('blichtma', 'ahahahah', 1, 0),
('ckuehn', 'hahahaha', 0, 0),
('jdoe', 'nameless', 0, 0),
('jshmoe', 'test333', 0, 1),
('test', 'test', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`ContentID`),
  ADD KEY `content_username_fk` (`User`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `ContentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_username_fk` FOREIGN KEY (`User`) REFERENCES `users` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
