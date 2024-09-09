-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 11:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bracken`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(14) NOT NULL,
  `password` varchar(10000) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `password`, `gender`) VALUES
(1, 'Mutasem Mustafa', 'gazawi', 'm@bracken.team', 788717057, 'b6f8f194049b037e79ea2b2605c127f1', 'Male'),
(2, 'Majd Banat', 'glory', 'majd@bracken.team', 795774826, '47b52b82e473a42f861765e8bb85bb10', 'Male'),
(7, 'Ahmad Bilide', 'bilide', 'a@bracken.team', 787638500, '8f399d756a6038512ee6bed516746343', 'Male'),
(8, 'test', 'test', 'test@test-test.test', 1234567890, 'd0755dcb967153761f734690cfe60e57', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `writeup`
--

CREATE TABLE `writeup` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writeup`
--

INSERT INTO `writeup` (`id`, `name`, `title`, `link`, `picture`) VALUES
(1, 'Majd Banat', 'Cyber Talents General Information Challenges', 'https://medium.com/@glorybnat/general-information-challenges-from-cybertalents-78df9780f208', '66a6b293a5e48.png'),
(8, 'Ahmad Bilide', 'Cyber Talents | Raw Disk', 'https://medium.com/@ahmadbilide/cyber-talents-raw-disk-bac6ca85606b', '66a6b2bdb4854.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `writeup`
--
ALTER TABLE `writeup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `writeup`
--
ALTER TABLE `writeup`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
