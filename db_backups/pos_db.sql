-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 02:25 PM
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
  `company_id` int(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `membership_id` varchar(100) DEFAULT NULL,
  `customer_phone_number` varchar(20) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL COMMENT '1 = active, 2 = inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_id`, `customer_name`, `membership_id`, `customer_phone_number`, `customer_email`, `customer_address`, `birth_date`, `registration_date`, `points`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 11, 'Fahad Ahmed', 'Member-11-9566', '01513470130', 'fahad@gmail.com', NULL, NULL, '2024-08-08', NULL, 1, '2024-08-08 07:09:12', '2024-08-08 07:09:12'),
(2, 11, 'Abul Kauser', 'Member-11-8265', '01513470137', 'kauser@gmail.com', NULL, NULL, '2024-08-13', NULL, 1, '2024-08-13 09:04:33', '2024-08-13 09:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `customer_dues`
--

CREATE TABLE `customer_dues` (
  `id` int(255) NOT NULL,
  `due_clear_date` date DEFAULT NULL,
  `company_id` int(255) DEFAULT NULL,
  `invoice_id` int(255) DEFAULT NULL,
  `customer_id` int(255) DEFAULT NULL,
  `due_clear_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_dues`
--

INSERT INTO `customer_dues` (`id`, `due_clear_date`, `company_id`, `invoice_id`, `customer_id`, `due_clear_amount`, `created_at`, `updated_at`) VALUES
(1, '2024-08-15', 11, 1, 2, '20', '2024-08-15 06:07:44', '2024-08-15 06:07:44'),
(2, '2024-08-15', 11, 1, 2, '5', '2024-08-15 06:59:35', '2024-08-15 06:59:35'),
(3, '2024-08-15', 11, 1, 2, '1', '2024-08-15 12:40:34', '2024-08-15 12:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(100) NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `due_clear_date` date DEFAULT NULL,
  `invoice_track_id` varchar(100) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `outlet_id` int(100) DEFAULT NULL,
  `customer_id` int(100) DEFAULT NULL,
  `emp_id` int(100) DEFAULT NULL,
  `payment_method_id` int(100) DEFAULT NULL,
  `transaction_id` int(100) DEFAULT NULL,
  `total_amount` varchar(100) DEFAULT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `tax_amount` varchar(100) DEFAULT NULL,
  `discount_amount` varchar(100) DEFAULT NULL,
  `grand_total` varchar(100) DEFAULT NULL,
  `due_amount` varchar(100) DEFAULT NULL,
  `paid_amount` varchar(100) DEFAULT NULL,
  `terms_and_conditions` text DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL COMMENT '1=pending, 2=completed, 3=cancelled',
  `policy_id` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_date`, `due_clear_date`, `invoice_track_id`, `company_id`, `branch_id`, `outlet_id`, `customer_id`, `emp_id`, `payment_method_id`, `transaction_id`, `total_amount`, `tax_id`, `tax_amount`, `discount_amount`, `grand_total`, `due_amount`, `paid_amount`, `terms_and_conditions`, `payment_status`, `policy_id`, `created_at`, `updated_at`) VALUES
(1, '2024-08-15', NULL, 'INVOICE-20240813-170242-026', 11, NULL, 2, 2, 1, 1, NULL, '840.00', NULL, '10', '20', '830.00', '4', '826', NULL, 1, NULL, '2024-08-13 11:03:13', '2024-08-13 11:03:13'),
(2, '2024-08-14', NULL, 'INVOICE-20240814-115321-284', 11, NULL, 2, 2, 1, 1, NULL, '25400.00', NULL, NULL, '100', '25300.00', NULL, '25300.00', NULL, 1, NULL, '2024-08-14 05:54:08', '2024-08-14 05:54:08'),
(3, '2024-08-14', NULL, 'INVOICE-20240814-115440-721', 11, NULL, 2, 1, 1, 1, NULL, '13540.00', NULL, NULL, '100', '13440.00', '40', '13400.00', NULL, 1, NULL, '2024-08-14 05:56:44', '2024-08-14 05:56:44'),
(4, '2024-08-14', NULL, 'INVOICE-20240814-120530-946', 11, NULL, 2, 2, 1, 1, NULL, '12700.00', NULL, NULL, NULL, '12700.00', NULL, '12700.00', NULL, 1, NULL, '2024-08-14 06:06:53', '2024-08-14 06:06:53'),
(5, '2024-08-17', NULL, 'INVOICE-20240817-015018-069', 11, NULL, 2, 2, 1, 1, NULL, '92260.00', NULL, NULL, NULL, '92260.00', NULL, '92260.00', NULL, 1, NULL, '2024-08-16 19:52:18', '2024-08-16 19:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(100) NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_id` int(100) DEFAULT NULL,
  `stock_id` int(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` varchar(100) DEFAULT NULL,
  `sale_unit_price` varchar(255) DEFAULT NULL,
  `sub_total` varchar(100) DEFAULT NULL,
  `remaining_product_in_batch` int(100) DEFAULT NULL COMMENT 'If product is batch',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_date`, `invoice_id`, `stock_id`, `quantity`, `unit_price`, `sale_unit_price`, `sub_total`, `remaining_product_in_batch`, `created_at`, `updated_at`) VALUES
(1, '2024-08-13', 1, 3, 2, '420', NULL, '840.00', NULL, '2024-08-13 11:03:13', '2024-08-13 11:03:13'),
(2, '2024-08-14', 2, 4, 2, '12700', NULL, '25400.00', NULL, '2024-08-14 05:54:08', '2024-08-14 05:54:08'),
(3, '2024-08-14', 3, 4, 1, '12700', NULL, '12700.00', NULL, '2024-08-14 05:56:44', '2024-08-14 05:56:44'),
(4, '2024-08-14', 3, 3, 2, '420', NULL, '840.00', NULL, '2024-08-14 05:56:44', '2024-08-14 05:56:44'),
(5, '2024-08-14', 4, 4, 1, '12700', NULL, '12700.00', NULL, '2024-08-14 06:06:53', '2024-08-14 06:06:53'),
(6, '2024-08-17', 5, 1, 2, '45700', '45705', '91410.00', NULL, '2024-08-16 19:52:18', '2024-08-16 19:52:18'),
(7, '2024-08-17', 5, 3, 2, '420', '425', '850.00', NULL, '2024-08-16 19:52:18', '2024-08-16 19:52:18');

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

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `payment_method_name`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1, '2024-08-07 16:45:24', '2024-08-07 16:45:24');

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

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` int(255) NOT NULL,
  `company_id` int(255) DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `company_id`, `descriptions`, `created_at`, `updated_at`) VALUES
(1, 11, 'All sales are final. Please make the payment within 7 days. Late payments will incur a 5% penalty.', '2024-08-15 08:55:18', '2024-08-15 08:55:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_dues`
--
ALTER TABLE `customer_dues`
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
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_dues`
--
ALTER TABLE `customer_dues`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
