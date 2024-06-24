-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 02:49 PM
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
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory_log`
--

CREATE TABLE `inventory_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(500) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `company_id`, `name`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 12, 'Electronics', NULL, '2024-05-21 09:29:37', '2024-05-21 09:29:37'),
(2, 11, 'test category', 1, '2024-05-30 06:38:43', '2024-05-30 06:38:43'),
(3, 11, 'Electronics', 1, '2024-06-01 05:18:29', '2024-06-01 05:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL COMMENT '1=batch, 2=single item',
  `product_name` varchar(500) DEFAULT NULL,
  `product_single_price` varchar(500) DEFAULT NULL,
  `labeling_type` int(11) DEFAULT NULL COMMENT '1=sku, 2=barcode',
  `batch_number` varchar(500) DEFAULT NULL,
  `product_tag_number` varchar(500) DEFAULT NULL,
  `product_weight` varchar(500) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `additional_product_details` text DEFAULT NULL,
  `product_entry_date` date DEFAULT NULL,
  `product_mfg_date` date DEFAULT NULL,
  `product_expiry_date` date DEFAULT NULL,
  `product_status` int(11) DEFAULT NULL COMMENT '1=available, 2=not available, 3=damaged',
  `total_product_in_a_batch` int(11) DEFAULT NULL,
  `product_batch_price` varchar(500) DEFAULT NULL,
  `current_available_product_in_a_batch` int(11) DEFAULT NULL,
  `shop_company_id` int(11) DEFAULT NULL,
  `shop_branch_id` int(11) DEFAULT NULL,
  `shop_depth_id` int(11) DEFAULT NULL,
  `shop_outlet_id` int(11) DEFAULT NULL,
  `shop_warehouse_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_company_id` int(11) DEFAULT NULL,
  `vendor_branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_category_id`, `product_category_id`, `product_type`, `product_name`, `product_single_price`, `labeling_type`, `batch_number`, `product_tag_number`, `product_weight`, `quantity`, `additional_product_details`, `product_entry_date`, `product_mfg_date`, `product_expiry_date`, `product_status`, `total_product_in_a_batch`, `product_batch_price`, `current_available_product_in_a_batch`, `shop_company_id`, `shop_branch_id`, `shop_depth_id`, `shop_outlet_id`, `shop_warehouse_id`, `vendor_id`, `vendor_company_id`, `vendor_branch_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Lenovo 203 laptop', '45,000', 2, NULL, 'laptop-12', '2kg', 1, '<p>Lenovo latest laptop<br></p>', '2024-05-21', NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-21 11:40:52', '2024-05-21 11:40:52'),
(2, 3, 4, 2, 'Samsung Smart TV', '51000', 1, NULL, 'smarttv-122134', '30kg', 1, '32\" LED smart TV<br>', '2024-06-01', NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-01 06:00:55', '2024-06-01 06:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_batch`
--

CREATE TABLE `product_batch` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `batch_number` varchar(500) DEFAULT NULL,
  `product_name` varchar(500) DEFAULT NULL,
  `total_number_of_purchased_product_in_a_batch` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `company_id`, `name`, `item_category_id`, `active_status`, `created_at`, `updated_at`) VALUES
(1, 12, 'Fridge', 1, 1, '2024-05-21 10:11:03', '2024-05-21 10:11:03'),
(2, 12, 'Laptop', 1, NULL, '2024-05-21 10:13:58', '2024-05-21 10:13:58'),
(3, 12, NULL, 1, NULL, '2024-05-21 11:39:36', '2024-05-21 11:39:36'),
(4, 11, 'Smart TV', 3, 1, '2024-06-01 05:18:50', '2024-06-01 05:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `product_requisitions`
--

CREATE TABLE `product_requisitions` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `requisition_type` int(11) DEFAULT NULL COMMENT '1=batch, 2=single item',
  `requisition_product_name` varchar(500) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `requisition_sending_date` date DEFAULT NULL,
  `product_delivering_date` date DEFAULT NULL,
  `shop_company_id` int(11) DEFAULT NULL,
  `shop_branch_id` int(11) DEFAULT NULL,
  `shop_dept_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_company_id` int(11) DEFAULT NULL,
  `vendor_branch_id` int(11) DEFAULT NULL,
  `requisition_status` int(11) DEFAULT NULL,
  `requisition_decline_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_tag_number` varchar(500) DEFAULT NULL,
  `batch_number` varchar(500) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sales_date` date DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `total_number_of_sold_product_in_a_batch` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `warehouse_name` varchar(500) DEFAULT NULL,
  `warehouse_address` text DEFAULT NULL,
  `warehouse_status` int(11) DEFAULT NULL COMMENT '1=open, 2=closed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `company_id`, `branch_id`, `warehouse_name`, `warehouse_address`, `warehouse_status`, `created_at`, `updated_at`) VALUES
(1, 11, 3, 'Laalbagh Warehouse', '<p>Laalbagh, Dhaka<br></p>', 1, '2024-06-10 10:25:14', '2024-06-10 10:25:14'),
(2, 11, 1, 'Mirpur warehouse', 'Mirpur DOHS', 1, '2024-06-10 10:47:05', '2024-06-10 10:47:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_log`
--
ALTER TABLE `inventory_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_batch`
--
ALTER TABLE `product_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_requisitions`
--
ALTER TABLE `product_requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_batch`
--
ALTER TABLE `product_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_requisitions`
--
ALTER TABLE `product_requisitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
