-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 11:26 AM
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
-- Database: `thegoldengrain`
--

-- --------------------------------------------------------

--
-- Table structure for table `breakfast_items`
--

CREATE TABLE `breakfast_items` (
  `item_id` int(11) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `veg_nonveg` enum('Veg','Non-Veg') DEFAULT 'Veg',
  `status` enum('Available','Not Available') DEFAULT 'Available',
  `price` decimal(10,2) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `breakfast_items`
--

INSERT INTO `breakfast_items` (`item_id`, `menu_category_id`, `item_name`, `veg_nonveg`, `status`, `price`, `photo`, `updated_at`) VALUES
(2, 12, 'upma pesarattu', 'Veg', '', 2000000.00, 'download (23)_6905d636cdaab.jpg', '2025-11-01 15:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `parent_id`, `created_at`, `updated_at`) VALUES
(17, 'devi', NULL, '2025-11-01 09:23:09', '2025-11-01 09:23:09'),
(18, 'sample blogs', NULL, '2025-11-01 09:30:21', '2025-11-01 09:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `dinner_items`
--

CREATE TABLE `dinner_items` (
  `item_id` int(11) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `veg_nonveg` enum('Veg','Non-Veg') DEFAULT 'Veg',
  `status` enum('Available','Not Available') DEFAULT 'Available',
  `price` decimal(10,2) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dinner_items`
--

INSERT INTO `dinner_items` (`item_id`, `menu_category_id`, `item_name`, `veg_nonveg`, `status`, `price`, `photo`, `updated_at`) VALUES
(4, 11, 'chicken dum biryanni', 'Non-Veg', '', 500.00, 'download (22)_6905d51f86e12.jpg', '2025-11-01 15:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `image_uploads`
--

CREATE TABLE `image_uploads` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_uploads`
--

INSERT INTO `image_uploads` (`id`, `image`, `title`, `category_id`, `updated_at`) VALUES
(18, 'download (23)_6905d34421b9a.jpg', 'sample for the blogs', 18, '2025-11-01 09:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `lunch_items`
--

CREATE TABLE `lunch_items` (
  `item_id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `veg_nonveg` enum('Veg','Non-Veg') NOT NULL DEFAULT 'Veg',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `price` decimal(10,2) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lunch_items`
--

INSERT INTO `lunch_items` (`item_id`, `photo`, `item_name`, `veg_nonveg`, `status`, `price`, `menu_category_id`, `created_at`) VALUES
(8, 'download (24)_6905d42c78fd0.jpg', 'dosa', 'Veg', 'Inactive', 120.00, 10, '2025-11-01 09:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `menu_category_id` int(11) NOT NULL,
  `menu_category` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`menu_category_id`, `menu_category`, `created_at`) VALUES
(10, 'lunch', '2025-11-01 09:30:56'),
(11, 'dinner', '2025-11-01 09:31:05'),
(12, 'breakfast', '2025-11-01 09:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `created_at`) VALUES
(1, 'creat', '$2y$10$a9kbf/.xkWr4TRBXZ2EGUODalN13x1SLvfHbmes.ju2OP6dwcHLMK', NULL, NULL, NULL, '2025-10-31 07:49:22'),
(2, 'admin', '$2y$10$uTMWgRJ25FTc2ROOhM929.hyugBWSuAcYGMn85AbgKQer0XrltNpi', NULL, NULL, NULL, '2025-10-31 07:50:39'),
(3, 'bhavi', '$2y$10$Ggh7wbThkgR73ApCxQDaRuqxZbpChsb.e2PL.8RaDEO4mqNQ9gUma', NULL, NULL, NULL, '2025-11-01 05:06:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breakfast_items`
--
ALTER TABLE `breakfast_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `menu_category_id` (`menu_category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `dinner_items`
--
ALTER TABLE `dinner_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `menu_category_id` (`menu_category_id`);

--
-- Indexes for table `image_uploads`
--
ALTER TABLE `image_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lunch_items`
--
ALTER TABLE `lunch_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`menu_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breakfast_items`
--
ALTER TABLE `breakfast_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dinner_items`
--
ALTER TABLE `dinner_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image_uploads`
--
ALTER TABLE `image_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lunch_items`
--
ALTER TABLE `lunch_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `menu_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `breakfast_items`
--
ALTER TABLE `breakfast_items`
  ADD CONSTRAINT `breakfast_items_ibfk_1` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_category` (`menu_category_id`) ON DELETE CASCADE;

--
-- Constraints for table `dinner_items`
--
ALTER TABLE `dinner_items`
  ADD CONSTRAINT `dinner_items_ibfk_1` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_category` (`menu_category_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
