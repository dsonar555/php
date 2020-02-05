-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 11:08 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `url` text NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `published_at` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`post_id`, `user_id`, `title`, `url`, `content`, `image`, `published_at`, `created_at`, `updated_at`) VALUES
(9, 3, 'what is trending in wedding season?', 'http://fashionInWedding.in', 'kffvjigjvkmdkdfj', 'uploads/download.jpg', '2020-02-04', '2020-02-05 09:56:55', '0000-00-00 00:00:00'),
(10, 6, 'home decorations', 'hhtp://homeDecor.in', 'ncneefekc,mmvlkrvd,.,.,lkkjajhc', 'uploads/download.jpg', '2020-02-02', '2020-02-05 09:59:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_category_id`, `title`, `meta_title`, `url`, `image`, `content`, `created_at`, `updated_at`) VALUES
(22, NULL, 'electrical', 'sub tilte', 'http://electrical.php', 'uploads/download.jpg', 'fbhntjykcfar', '2020-02-05 09:48:59', '0000-00-00 00:00:00'),
(23, 22, 'Mobile', 'any sub title', 'http://electrical//mobile.co.in', 'uploads/nature.jpg', 'dvbhtkuuly,jkjk,luolmt4tf', '2020-02-05 09:49:52', '0000-00-00 00:00:00'),
(24, NULL, 'Lifestyle', 'meta title of lifestyle', 'http://lifestyle.html', 'uploads/nature.jpg', 'about lifestyle', '2020-02-05 09:50:48', '0000-00-00 00:00:00'),
(25, 24, 'Fashion', 'fashion sense', 'http://lifestyle/fashion.html', 'uploads/nature.jpg', 'todays fashion', '2020-02-05 09:51:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `category_post_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`category_post_id`, `post_id`, `category_id`) VALUES
(21, 9, 24),
(22, 9, 25),
(23, 10, 24),
(24, 10, 25);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mobile_no` bigint(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login_at` datetime NOT NULL,
  `information` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `prefix`, `first_name`, `last_name`, `mobile_no`, `email`, `password`, `last_login_at`, `information`, `created_at`, `updated_at`) VALUES
(3, 'Ms', 'Divya', 'Sonar', 9090909090, 'ds@ds.com', '$2y$10$Sw2.1jL0h8Psa5DOD6bodu/I4cF8rv.swro5aWhP7LzfwVCbXZo/C', '2020-02-05 10:58:58', 'I like programming.', '2020-02-05 10:58:58', '2020-02-05 10:57:54'),
(6, 'Ms', 'Pooja', 'Chavda', 9090909099, 'pc@pc.com', '$2y$10$NabV0Zp6BtkVvmeqQRseBeixek82i2txzuqlLkLKhmTBLrpVEAOZG', '0000-00-00 00:00:00', 'Science Student', '2020-02-05 10:59:42', '2020-02-05 10:59:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_category_id` (`parent_category_id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`category_post_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `category_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_post`
--
ALTER TABLE `category_post`
  ADD CONSTRAINT `category_post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
