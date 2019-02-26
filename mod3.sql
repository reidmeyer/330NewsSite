-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 26, 2018 at 02:39 AM
-- Server version: 5.5.61
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mod3`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` mediumint(8) UNSIGNED NOT NULL,
  `storyidreferenced` mediumint(8) UNSIGNED NOT NULL,
  `comment_content` text NOT NULL,
  `comment_createdbyid` mediumint(8) UNSIGNED NOT NULL,
  `comment_createdbyuser` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `storyidreferenced`, `comment_content`, `comment_createdbyid`, `comment_createdbyuser`) VALUES
(6, 10, 'I wanna buy the head! 5$', 4, 'kevin');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `story_id` mediumint(8) UNSIGNED NOT NULL,
  `madebyuser` varchar(30) NOT NULL,
  `story_content` text NOT NULL,
  `story_createdbyuserid` mediumint(8) UNSIGNED NOT NULL,
  `thelink` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`story_id`, `madebyuser`, `story_content`, `story_createdbyuserid`, `thelink`) VALUES
(10, 'reid', 'Horse head for sale', 3, 'https://www.mallatts.com/store/images/P/brownhorse.jpg'),
(11, 'kevin', 'football team wins superbowl', 4, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHNp0yp4crv7YgE3Y15fFJfxZQoWVmr3SwasB0JuJBWV2kznUEAw');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` char(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`) VALUES
(1, 'admin', '$2y$10$DJrcuqtu6ZbGQuZdKksnOOWX8IapqkglnC4/2L6ujzuyMR1SH9C9e'),
(2, 'newuser', '$2y$10$QvZw.VNnd8Fm5.z5.hd95OjxzVUrTrgv5xT9XYIh4AUEFPK957nWO'),
(3, 'reid', '$2y$10$t8hhL6kkgVUfAFnqv.yrLeNjly019/IwnQ2o/1b7wdZDAlHCW/f3.'),
(4, 'kevin', '$2y$10$DIohqFvri4v/8OKRmZIGHu6tEU9tg1XxhtddYK8o/SzsUctwc/vtK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_createdbyid` (`comment_createdbyid`,`comment_createdbyuser`),
  ADD KEY `storyidreferenced` (`storyidreferenced`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`story_id`),
  ADD KEY `story_createdbyuserid` (`story_createdbyuserid`,`madebyuser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `story_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_createdbyid`,`comment_createdbyuser`) REFERENCES `users` (`id`, `user`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`storyidreferenced`) REFERENCES `stories` (`story_id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`story_createdbyuserid`,`madebyuser`) REFERENCES `users` (`id`, `user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
