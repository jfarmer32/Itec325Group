-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2019 at 07:25 PM
-- Server version: 5.6.43-cll-lve
-- PHP Version: 5.6.30

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
CREATE DATABASE IF NOT EXISTS `social-site` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `social-site`;

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
(1, 'ckuehn', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/ET_Afar_asv2018-01_img36_Dallol.jpg/500px-ET_Afar_asv2018-01_img36_Dallol.jpg', 'https://www.thesprucepets.com/cats-4162124', 0, '2019-04-04', '00:00:00'),
(4, 'ckuehn', 'https://upload.wikimedia.org/wikipedia/commons/3/33/Dogs_nose.jpg', 'https://www.petfinder.com/dogs/', 1, '2019-04-04', '00:00:00'),
(5, 'blichtma', 'https://i1.sndcdn.com/avatars-000532707114-o5fv53-t500x500.jpg', 'http://owsla.com/', 0, '2019-04-04', '00:00:00'),
(6, 'blichtma', 'https://cdn-images-1.medium.com/max/624/1*2fQnfjokCOWqkfWWJJn4tw.png', 'http://www.ovosound.com/', 0, '2019-04-04', '00:00:00'),
(7, 'jshmoe', 'https://upload.wikimedia.org/wikipedia/commons/e/ec/Longhair_Djrizkfkrrlfdjdy.jpg', 'https://www.womansday.com/style/beauty/g1098/celebrity-hairstyles-long-hair/', 1, '2019-04-04', '00:00:00'),
(8, 'jshmoe', 'placeholder.png', 'https://google.com', 1, '2019-04-04', '00:00:00'),
(9, 'jshmoe', 'placeholder.png', 'https://google.com', 1, '2019-04-04', '00:00:00'),
(10, 'jdoe', 'placeholder.png', 'https://google.com', 0, '2019-04-04', '00:00:00'),
(11, 'jdoe', 'placeholder.png', 'https://google.com', 1, '2019-04-04', '00:00:00'),
(12, 'jshmoe', 'https://thumbs.gfycat.com/SilkyGeneralAmethystsunbird-size_restricted.gif', 'https://google.com', 0, '2019-04-04', '00:00:00'),
(13, 'jshmoe', 'https://media0.giphy.com/media/4XZAPHsKaY21W/giphy.gif', 'https://google.com', 0, '2019-04-04', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `profilePicture` varchar(2038) NOT NULL DEFAULT 'predefinedStockImage.png',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isUserRestricted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `profilePicture`, `isAdmin`, `isUserRestricted`) VALUES
('blichtma', 'ahahahah', 'https://pbs.twimg.com/profile_images/565387423887405056/z4BM8z15_400x400.jpeg', 1, 0),
('Bobby', 'Billy', 'predefinedStockImage.png', 0, 0),
('ckuehn', 'hahahaha', 'https://1.bp.blogspot.com/-2Hqo7_S_s8g/TV6BmvNSmEI/AAAAAAAAfGY/ANT5_dYZaFs/s1600/Weird_Faces_A_Guy_Can_Make_07.jpg', 0, 0),
('jdoe', 'nameless', 'https://itsnotamatch.files.wordpress.com/2012/04/crazy_face.jpg', 0, 0),
('jshmoe', 'test333', 'predefinedStockImage.png', 0, 1),
('test', 'test', 'predefinedStockImage.png', 0, 0);

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
  MODIFY `ContentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
