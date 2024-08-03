-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 07:49 AM
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
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(100) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `membership_id` varchar(100) DEFAULT NULL,
  `customer_phone_number` int(11) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(100) NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `product_id` int(100) DEFAULT NULL,
  `customer_id` int(100) DEFAULT NULL,
  `emp_id` int(100) DEFAULT NULL,
  `payment_method_id` int(100) DEFAULT NULL,
  `transaction_id` int(100) DEFAULT NULL,
  `sub_total` varchar(100) DEFAULT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `tax_amount` varchar(100) DEFAULT NULL,
  `discount_amount` varchar(100) DEFAULT NULL,
  `total_amount` varchar(100) DEFAULT NULL,
  `terms_and_conditions` text DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL COMMENT '1=pending, 2=completed, 3=cancelled',
  `policy_id` int(100) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `outlet_id` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_date`, `product_id`, `customer_id`, `emp_id`, `payment_method_id`, `transaction_id`, `sub_total`, `tax_id`, `tax_amount`, `discount_amount`, `total_amount`, `terms_and_conditions`, `payment_status`, `policy_id`, `company_id`, `branch_id`, `outlet_id`, `created_at`, `updated_at`) VALUES
(1, '2024-05-21', 1, NULL, 2, 1, NULL, '1250', NULL, NULL, '100', '1150.00', NULL, NULL, NULL, 12, NULL, NULL, '2024-05-21 12:44:11', '2024-05-21 12:44:11'),
(2, '2024-06-01', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-01 06:02:28', '2024-06-01 06:02:28'),
(3, '2024-06-01', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-01 06:15:42', '2024-06-01 06:15:42'),
(4, '2024-06-01', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-01 06:16:06', '2024-06-01 06:16:06'),
(5, '2024-06-01', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-01 06:17:10', '2024-06-01 06:17:10'),
(6, '2024-06-01', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-01 06:20:09', '2024-06-01 06:20:09'),
(7, '2024-06-01', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-01 06:24:58', '2024-06-01 06:24:58'),
(8, '2024-06-06', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-06 05:31:33', '2024-06-06 05:31:33'),
(9, '2024-06-24', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '100', '50900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-24 12:09:41', '2024-06-24 12:09:41'),
(10, '2024-06-27', 3, NULL, 1, 1, NULL, '1200', NULL, NULL, '10', '1190.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-27 12:52:57', '2024-06-27 12:52:57'),
(11, '2024-06-27', 3, NULL, 1, 1, NULL, '1200', NULL, NULL, '10', '1190.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-27 13:03:13', '2024-06-27 13:03:13'),
(12, '2024-06-27', 4, NULL, 1, 1, NULL, '25000', NULL, NULL, '100', '24900.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-06-27 13:21:53', '2024-06-27 13:21:53'),
(13, '2024-07-25', 2, NULL, 1, 1, NULL, '51000', NULL, NULL, '10', '50990.00', NULL, NULL, NULL, 11, NULL, NULL, '2024-07-25 09:40:28', '2024-07-25 09:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(100) NOT NULL,
  `invoice_id` int(100) DEFAULT NULL,
  `product_id` int(100) DEFAULT NULL,
  `unit_price` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining_product_in_batch` int(100) DEFAULT NULL COMMENT 'If product is batch',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(100) NOT NULL,
  `condition` text DEFAULT NULL,
  `offer_start_date` date DEFAULT NULL,
  `offer_end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_inventory_items`
--

CREATE TABLE `offer_inventory_items` (
  `id` int(100) NOT NULL,
  `product_id` int(100) DEFAULT NULL,
  `offer_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `outlet_name` varchar(100) DEFAULT NULL,
  `outlet_address` text DEFAULT NULL,
  `outlet_status` int(11) DEFAULT NULL COMMENT '1=open, 2=closed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `company_id`, `branch_id`, `outlet_name`, `outlet_address`, `outlet_status`, `created_at`, `updated_at`) VALUES
(1, 11, 3, 'qqqqqqqooooo', 'Laalm', 1, '2024-06-10 07:56:01', '2024-06-10 07:56:01'),
(2, 11, 1, 'Mirpur Outlet', 'Mirpur DOHS', 1, '2024-06-10 07:56:49', '2024-06-10 07:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(100) NOT NULL,
  `payment_method_name` varchar(100) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` int(100) NOT NULL,
  `policy_name` varchar(100) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_log`
--

CREATE TABLE `pos_log` (
  `id` int(100) NOT NULL,
  `emp_id` int(100) DEFAULT NULL,
  `customer_id` int(100) DEFAULT NULL,
  `invoice_id` int(100) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(500) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_calculations`
--

CREATE TABLE `tax_calculations` (
  `id` int(100) NOT NULL,
  `tax_name` varchar(100) DEFAULT NULL,
  `tax_rate` int(100) DEFAULT NULL,
  `tax_type` int(11) DEFAULT NULL,
  `tax_code` varchar(100) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `expire_date` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_inventory_items`
--
ALTER TABLE `offer_inventory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_log`
--
ALTER TABLE `pos_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_calculations`
--
ALTER TABLE `tax_calculations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer_inventory_items`
--
ALTER TABLE `offer_inventory_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_log`
--
ALTER TABLE `pos_log`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_calculations`
--
ALTER TABLE `tax_calculations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
