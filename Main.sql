-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql749.db.sakura.ne.jp
-- Generation Time: Feb 17, 2020 at 10:46 PM
-- Server version: 5.7.28-log
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siennafawn13_nyan`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `owner` int(11) NOT NULL,
  `token` varchar(45) NOT NULL,
  `public_token` varchar(255) NOT NULL,
  `website` varchar(250) NOT NULL,
  `callback` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_certifications`
--

CREATE TABLE `app_certifications` (
  `id` int(11) NOT NULL,
  `token` varchar(70) NOT NULL,
  `app` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `expires_in` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifer`
--

CREATE TABLE `notifer` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `app` int(11) NOT NULL,
  `reg_time` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifer_contents`
--

CREATE TABLE `notifer_contents` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `app` int(11) NOT NULL,
  `contents` varchar(300) NOT NULL,
  `in_read` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `description`) VALUES
(1, '内部ユーザーIDのみを取得する。'),
(2, 'メールアドレスと内部ユーザーIDのみを取得する。'),
(3, 'メールアドレスと内部ユーザーIDと電話番号を取得する。'),
(4, 'メールアドレスと内部ユーザーIDと電話番号と住所を取得する。'),
(5, 'ユーザーidの取得とユーザーアカウントへの通知権限を持つ');

-- --------------------------------------------------------

--
-- Table structure for table `temp_account`
--

CREATE TABLE `temp_account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_in` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `token_requests`
--

CREATE TABLE `token_requests` (
  `id` int(11) NOT NULL,
  `app` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `callback` varchar(255) NOT NULL,
  `expires_in` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `public_email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `displayname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Admin'),
(10, 'Developer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_certifications`
--
ALTER TABLE `app_certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifer`
--
ALTER TABLE `notifer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifer_contents`
--
ALTER TABLE `notifer_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_account`
--
ALTER TABLE `temp_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_requests`
--
ALTER TABLE `token_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_certifications`
--
ALTER TABLE `app_certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifer`
--
ALTER TABLE `notifer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifer_contents`
--
ALTER TABLE `notifer_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp_account`
--
ALTER TABLE `temp_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token_requests`
--
ALTER TABLE `token_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
