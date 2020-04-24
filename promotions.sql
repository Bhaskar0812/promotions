-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2020 at 01:32 PM
-- Server version: 5.7.29-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-26+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promotions`
--

-- --------------------------------------------------------

--
-- Table structure for table `reffers`
--

CREATE TABLE `reffers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `refrece_status` tinyint(4) NOT NULL DEFAULT '0',
  `referer_poll` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `reffered_by` int(11) NOT NULL,
  `promotion_amount` float(10,4) NOT NULL DEFAULT '1.0000',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `referer_poll` tinyint(4) NOT NULL DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `reffered_by`, `promotion_amount`, `created_at`, `updated_at`, `created_by`, `referer_poll`, `password`, `user_type`) VALUES
(1, 'Admin', 'admin@gmail.com', 0, 0, 1.0000, '2020-04-23 19:31:14', NULL, NULL, 1, '$2y$10$O5KHkc0ckmq0g/IeTPtwYuKGgHjfFIsJXOcPRWqll6XnGa/rP9YVa', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reffers`
--
ALTER TABLE `reffers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reffers`
--
ALTER TABLE `reffers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
