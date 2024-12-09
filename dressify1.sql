-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 09:58 AM
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
-- Database: `dressify1`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(5, 'frock 002', NULL, 5236.00, 'about img.jpg'),
(6, 'frock 5', NULL, 1000.00, 'p2.jpg'),
(7, 'frock 46', NULL, 2000.00, 'p8.jpg'),
(8, 'frock 464', NULL, 1000.25, 'p4.jpg'),
(9, 'frock 0022', NULL, 2000.00, 'p11.jpg'),
(10, 'frock 564', NULL, 2500.00, 'hansana.jpg'),
(11, 'frock 001', NULL, 1000.00, 'p1.jpg'),
(12, 'frock 001', NULL, 1000.00, 'p1.jpg'),
(13, 'frock 001', NULL, 1000.00, 'p1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` int(10) NOT NULL,
  `pp` varchar(255) NOT NULL DEFAULT 'default-pp.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `pp`) VALUES
(1, 'dine', '1234', 'kaumadi2002@gmail.com', 0, 'default-pp.png'),
(2, 'chamal', '$2y$10$GFRsjW25hRJg2zoMuYOzd.VAtSo5YTlzWFD7wKQE4EIlZzJQHs/..', 'chamal@gmail.com', 0, 'default-pp.png'),
(6, 'Ravinya', '$2y$10$2N5B2htBLCfvDhsEQEl0o.QImyBFgupM37Mx8cwO4YcHkELY5NBYu', 'ravinya2002@gmail.com', 0, 'Ravinya66973853dcd674.23319779.jpg'),
(7, 'ruchira', '$2y$10$osGUaKLx6xrRT0bSo287d.oHrz2nB31S9bBzp99KUirprldML41MS', 'webruchira@gmail.com', 0, 'default-pp.png'),
(8, 'new', '$2y$10$n90Rr85l1veJKfPc.uO6sOr134TmU.UsIZHhJ5d8FJUrkzAjg4cW6', 'abc@gmail.com', 0, 'new6696b2f0793a98.97534475.png'),
(9, 'ruchira1', '$2y$10$j70/ctGT.nvEgV60bMSO/.8LDLKSlWNdOJNHm5OKULid942SYiYOy', 'ruchira@gmail.com', 0, 'ruchira16696b923113d14.54587610.png'),
(10, 'Dinelka', '$2y$10$m0j43QMSaYkGWFTWEo4BAuZe5uplJyNBSdlSGvvkL3NexsrNrwvw6', 'Dinelka2002@gmail.com', 0, 'Dinelka Kaumadi66976fbc99e681.86487028.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
