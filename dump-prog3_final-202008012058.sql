-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2020 at 02:00 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prog3_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `desc` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `desc`, `userId`, `date`) VALUES
(1, 'Esto es un evento', NULL, '2020-07-29 04:19:57'),
(2, 'Esto es un evento', NULL, '2020-07-29 04:21:41'),
(3, 'Esto es un evento', NULL, '2020-07-29 04:21:49'),
(4, 'Esto es un evento', NULL, '2020-07-29 04:22:03'),
(5, 'Esto es un evento', NULL, '2020-07-29 04:22:17'),
(6, 'Esto es un evento', NULL, '2020-07-29 04:22:26'),
(7, 'Esto es un evento', NULL, '2020-07-29 04:26:21'),
(8, 'Esto es un evento', NULL, '2020-07-29 04:29:29'),
(9, 'Esto es un evento', NULL, '2020-07-29 04:29:50'),
(10, 'Esto es un evento', NULL, '2020-07-29 04:38:13'),
(11, 'Esto es un evento', NULL, '2020-07-29 04:43:45'),
(12, 'Esto es un evento', NULL, '2020-07-29 04:46:29'),
(13, 'Esto es un evento', 2, '2020-07-29 05:21:11'),
(14, 'Esto es un evento', 2, '2020-07-29 06:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `endpoint` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `type` int(11) NOT NULL,
  `pass` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `email`, `type`, `pass`) VALUES
(1, 'admin1', 'admin1@examle.com', 0, '$2y$10$iZPTIa1pUMdi44CmP/bImeYcqn28ytbrzw.gTKHF5GyJtLmb4rARK'),
(2, 'user1', 'user1@examle.com', 1, '$2y$10$APPBx0/2jNMNaArkKiZo2.ZTlaTPGx4BdUktCd.FlH8E6H4LXdl3O');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
