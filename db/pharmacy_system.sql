-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 05:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `drug_id` int(11) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`drug_id`, `drug_name`, `price`) VALUES
(1, 'Paracetamol 500mg', '5.99'),
(2, 'Aspirin 325mg', '3.49'),
(3, 'Ibuprofen 200mg', '4.99'),
(4, 'Loratadine 10mg', '6.99'),
(5, 'Omeprazole 20mg', '8.99'),
(6, 'Cetirizine 5mg', '7.49'),
(7, 'Diphenhydramine 25mg', '9.99'),
(8, 'Ranitidine 150mg', '5.49'),
(9, 'Acetaminophen 250mg', '4.29'),
(10, 'Doxylamine 25mg', '6.79');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `order_by` varchar(255) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `img4` varchar(255) DEFAULT NULL,
  `img5` varchar(255) DEFAULT NULL,
  `note1` varchar(255) DEFAULT NULL,
  `note2` varchar(255) DEFAULT NULL,
  `note3` varchar(255) DEFAULT NULL,
  `note4` varchar(255) DEFAULT NULL,
  `note5` varchar(255) DEFAULT NULL,
  `pres_number` int(11) NOT NULL,
  `email_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `fullname`, `address`, `phone`, `order_by`, `order_date`, `status`, `img1`, `img2`, `img3`, `img4`, `img5`, `note1`, `note2`, `note3`, `note4`, `note5`, `pres_number`, `email_status`) VALUES
(22, 'Nadun Kaushalya Siriwardhana', 'No:41/10, Station Road, Nugegoda', '0768335188', 'Nadun Kaushalya', '2024-03-03 15:27:46', 'accepted', '../uploads/2022_9$largeimg_1999179093.jpeg', '../uploads/19544-u5pPAwiW0Zklnlkn.jpeg', '../uploads/5429636987_5f45004f62_b.jpg', '../uploads/A-sample-image-of-Bangladeshi-handwritten-prescription.png', '../uploads/A-sample-prescription-containing-handwritten-texts-over-the-printed-lines.png', 'Please find my attached prescription 1', 'Please find my attached prescription 2', 'Please find my attached prescription 3', 'Please find my attached prescription 4', 'Please find my attached prescription 5', 5, 1),
(23, 'Nadun Kaushalya', 'Weligama', '+94786269503', 'Nadun Kaushalya', '2024-03-03 15:28:09', 'rejected', '../uploads/5429636987_5f45004f62_b.jpg', '', '', '', '', 'Please find my attached prescription', '', '', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prescription` int(11) NOT NULL,
  `drug` int(50) NOT NULL,
  `quantity` int(100) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `prescription`, `drug`, `quantity`, `cost`, `added_by`, `added_date`) VALUES
(42, 22, 1, 1, 14, '5.99', 'System Admin', '2024-03-03 20:58:50'),
(43, 22, 1, 5, 28, '8.99', 'System Admin', '2024-03-03 20:58:55'),
(44, 22, 2, 5, 15, '8.99', 'System Admin', '2024-03-03 20:59:04'),
(45, 22, 3, 6, 14, '7.49', 'System Admin', '2024-03-03 20:59:11'),
(46, 22, 4, 6, 10, '7.49', 'System Admin', '2024-03-03 20:59:18'),
(47, 22, 5, 7, 10, '9.99', 'System Admin', '2024-03-03 20:59:40'),
(48, 23, 1, 6, 14, '7.49', 'System Admin', '2024-03-03 21:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `address`, `contact_number`, `password`, `type`) VALUES
(2, 'System Admin', 'admin@gmai.com', 'Weligama', '+94786269503', '$2y$10$/f/IM1JJGssWEJ1fnxUXjeCIoyAHuuW0N4Rav8s05Nry..oWH6xsq', 2),
(4, 'Yasiru Basuru', 'check@gmail.com', 'Weligama', '0773696968', '$2y$10$a/tf1D.5.VAEr.kyzGPvo.uHSwviR1LGL2Fbse.7jfIa5RaCkrDGS', 1),
(5, 'Janith Ravindu Rashmika', 'nadunkaushalya2015@gmail.com', 'Weligama', '0786265454', '$2y$10$I/uCP46XxO1HvrSdbMJds.cwZWGhbzdk1TuR4Cr65GLNhjYRFH9Xu', 1),
(10, 'Nadun Kaushalya', 'nadunkaushalya2020@gmail.com', 'No:41/10, Station Road, Nugegoda', '0768335188', '$2y$10$he2/JzurW3LBt9m7sWDNluWbByugNfGHx8xDCR8ECWxZAgwlmYQre', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `drug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
