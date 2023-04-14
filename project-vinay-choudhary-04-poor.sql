-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 04, 2023 at 10:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-vinay-choudhary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `status`, `description`, `created_at`, `updated_at`) VALUES
(27, 'dfgtduio', 'active', 'fhjknbvm', '2023-04-03 12:09:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `mobile`, `gender`, `status`, `created_at`, `updated_at`) VALUES
(76, 'vinay', 'choudhary', 'vinay@gmail.com', '3456789890', 'male', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `country` varchar(10) NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`) VALUES
(62, 'Ahmedabad', 'Ahmedabad', 'Gujarat', 'India', 380059);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'redmi', 'active', '2023-04-03 06:53:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) NOT NULL DEFAULT 5,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `color` varchar(10) NOT NULL,
  `material` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`) VALUES
(58, '', 'asaas', '1.00', '1.00', 1, ' scds', 'active', 'eee', 'eedsf', '2023-02-21 06:01:26', NULL),
(59, '', 'asaas', '1.00', '1.00', 1, ' scds', 'active', 'eee', 'eedsf', '2023-02-21 06:01:38', NULL),
(61, '', 'asaas', '1.00', '1.00', 1, ' scds', 'inactive', 'red', 'eedsf', '2023-02-21 06:09:42', '2023-03-15 06:21:56'),
(62, '', 'asaas', '1.00', '1.00', 1, ' scds', 'active', 'eee', 'eedsf', '2023-02-21 06:12:05', NULL),
(79, '', 'sqs', '121.00', '21.00', 12, 'ssadsdsjcnscjjjscnsxc j ', 'inactive', 'red', 'wqqw', '2023-03-10 07:07:21', '2023-03-10 07:08:11'),
(80, '', 'zxsad', '1.00', '2.00', 3, 'asssddfdf', 'active', '', '', '2023-03-15 05:58:53', '2023-03-15 06:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `base` tinyint(4) NOT NULL DEFAULT 0,
  `thumnail` tinyint(4) NOT NULL DEFAULT 0,
  `small` tinyint(4) NOT NULL DEFAULT 0,
  `gallary` tinyint(4) NOT NULL DEFAULT 0,
  `file_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`product_id`, `image_id`, `name`, `created_at`, `base`, `thumnail`, `small`, `gallary`, `file_name`) VALUES
(50, 4, 'nokia 1500', '2023-02-15 08:15:11', 1, 0, 1, 1, ''),
(50, 5, 'nokia 1500', '2023-02-15 08:15:40', 0, 1, 0, 1, ''),
(51, 7, 'abnm', '2023-02-16 09:25:57', 1, 1, 1, 1, ''),
(53, 23, 'wwfg', '2023-02-16 10:38:06', 0, 1, 0, 0, ''),
(53, 24, 'aghj', '2023-02-16 10:50:19', 1, 0, 1, 1, ''),
(52, 25, 'kznxjzc', '2023-03-07 06:11:27', 1, 1, 1, 1, ''),
(72, 26, 'gyft', '2023-03-15 04:57:01', 0, 0, 0, 0, ''),
(72, 27, 'dasdg', '2023-03-15 05:15:55', 0, 0, 0, 0, ''),
(72, 28, '', '2023-03-15 05:16:54', 0, 0, 0, 0, '28.'),
(72, 29, '', '2023-03-15 05:24:04', 0, 0, 0, 0, '29.'),
(72, 30, '', '2023-03-15 05:24:12', 0, 0, 0, 0, '30.');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` int(10) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `company` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `first_name`, `last_name`, `email`, `mobile`, `gender`, `status`, `company`, `created_at`, `updated_at`) VALUES
(43, 'vinay', 'choudhary', 'vinay@gmail.com', 1234567890, 'male', 'active', 'Cybercom', '2023-03-03 10:22:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `country` varchar(10) NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`) VALUES
(42, 'idwwdklfsdmnj', 'Ahmedabad', 'gujrat', 'india', 380059);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int(11) NOT NULL,
  `salesmane_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `salesman_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nokia 1200', '1096.00', 'active', NULL, '2023-03-03 02:07:56'),
(4, 'Nokia 1200', '1100.00', 'active', NULL, NULL),
(11, 'Nokia 1200', '1100.00', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `company` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `first_name`, `last_name`, `email`, `mobile`, `gender`, `status`, `company`, `created_at`, `updated_at`) VALUES
(36, 'asda', 'qwdq', 'wqdqw', '1234567890', 'male', 'active', '', '2023-03-23 06:29:59', NULL),
(37, '', '', '', '', 'male', 'active', '', '2023-03-23 10:19:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `country` varchar(10) NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`) VALUES
(36, '', '', '', '', 0),
(37, '', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD UNIQUE KEY `address_id` (`address_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD UNIQUE KEY `address_id` (`address_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `salesmane_id` (`salesmane_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD UNIQUE KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_1` FOREIGN KEY (`salesmane_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
