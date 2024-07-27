-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 02:30 PM
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
  `id` int(255) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
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
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
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
(3, 11, 'Electronics', 1, '2024-06-01 05:18:29', '2024-06-01 05:18:29'),
(4, 11, 'Furniture', 1, '2024-06-27 12:21:02', '2024-06-27 12:21:02'),
(5, 11, 'Electronics', 1, '2024-06-27 13:18:42', '2024-06-27 13:18:42'),
(6, 11, 'Mirpur DOHS', 2, '2024-07-14 08:08:51', '2024-07-14 08:08:51'),
(7, 11, 'lllll', 2, '2024-07-14 08:10:30', '2024-07-14 08:10:30'),
(8, 11, 'Mirpur DOHS', 2, '2024-07-14 08:11:26', '2024-07-14 08:11:26'),
(9, 11, 'Liquid', 1, '2024-07-16 07:02:19', '2024-07-16 07:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL COMMENT '1=batch, 2=single item',
  `product_name` varchar(100) DEFAULT NULL,
  `product_single_price` varchar(100) DEFAULT NULL,
  `labeling_type` int(11) DEFAULT NULL COMMENT '1=sku, 2=barcode',
  `batch_number` varchar(100) DEFAULT NULL,
  `product_tag_number` varchar(100) DEFAULT NULL,
  `product_weight` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `additional_product_details` text DEFAULT NULL,
  `product_entry_date` date DEFAULT NULL,
  `product_mfg_date` date DEFAULT NULL,
  `product_expiry_date` date DEFAULT NULL,
  `product_status` int(11) DEFAULT NULL COMMENT '1=available, 2=not available, 3=damaged',
  `total_product_in_a_batch` int(100) DEFAULT NULL,
  `product_batch_price` varchar(500) DEFAULT NULL,
  `current_available_product_in_a_batch` int(100) DEFAULT NULL,
  `shop_company_id` int(100) DEFAULT NULL,
  `shop_branch_id` int(100) DEFAULT NULL,
  `shop_depth_id` int(100) DEFAULT NULL,
  `shop_outlet_id` int(100) DEFAULT NULL,
  `shop_warehouse_id` int(100) DEFAULT NULL,
  `vendor_id` int(100) DEFAULT NULL,
  `vendor_company_id` int(100) DEFAULT NULL,
  `vendor_branch_id` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_category_id`, `product_category_id`, `product_type`, `product_name`, `product_single_price`, `labeling_type`, `batch_number`, `product_tag_number`, `product_weight`, `quantity`, `additional_product_details`, `product_entry_date`, `product_mfg_date`, `product_expiry_date`, `product_status`, `total_product_in_a_batch`, `product_batch_price`, `current_available_product_in_a_batch`, `shop_company_id`, `shop_branch_id`, `shop_depth_id`, `shop_outlet_id`, `shop_warehouse_id`, `vendor_id`, `vendor_company_id`, `vendor_branch_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Lenovo 203 laptop', '45,000', 2, NULL, 'laptop-12', '2kg', 1, '<p>Lenovo latest laptop<br></p>', '2024-05-21', NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-21 11:40:52', '2024-05-21 11:40:52'),
(2, 3, 4, 2, 'Samsung Smart TV', '51000', 1, NULL, 'smarttv-122134', '30kg', 1, '32\" LED smart TV<br>', '2024-06-01', NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-01 06:00:55', '2024-06-01 06:00:55'),
(3, 4, 5, 2, 'Otobi Table', '1200', 1, NULL, 'dfds-1299', '20kg', 1, NULL, '2024-06-27', NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-27 12:22:46', '2024-06-27 12:22:46'),
(4, 5, 6, 2, 'Lenovo 203 laptop', '25000', 1, NULL, 'laptop-12', '2kg', 1, NULL, '2024-06-27', NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-27 13:20:29', '2024-06-27 13:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_batch`
--

CREATE TABLE `product_batch` (
  `id` int(100) NOT NULL,
  `product_id` int(100) DEFAULT NULL,
  `batch_number` varchar(500) DEFAULT NULL,
  `product_name` varchar(500) DEFAULT NULL,
  `total_number_of_purchased_product_in_a_batch` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
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
(4, 11, 'Smart TV', 3, 1, '2024-06-01 05:18:50', '2024-06-01 05:18:50'),
(5, 11, 'Mirpur DOHS', 4, 2, '2024-06-27 12:21:26', '2024-06-27 12:21:26'),
(6, 11, 'Laptop', 5, 1, '2024-06-27 13:19:15', '2024-06-27 13:19:15'),
(7, 11, 'test product category', 3, 2, '2024-07-14 10:49:41', '2024-07-14 10:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_requisitions`
--

CREATE TABLE `product_requisitions` (
  `id` int(255) NOT NULL,
  `requisition_order_id` varchar(100) DEFAULT NULL,
  `product_track_id` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_weight` varchar(100) DEFAULT NULL,
  `product_unit_type` varchar(100) DEFAULT NULL,
  `product_details` text DEFAULT NULL,
  `product_quantity` int(100) DEFAULT NULL,
  `product_unit_price` varchar(100) DEFAULT NULL,
  `product_subtotal` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_requisitions`
--

INSERT INTO `product_requisitions` (`id`, `requisition_order_id`, `product_track_id`, `product_name`, `product_weight`, `product_unit_type`, `product_details`, `product_quantity`, `product_unit_price`, `product_subtotal`, `created_at`, `updated_at`) VALUES
(1, 'ORD-20240717-164412', 'Pro-20240717-164452-279', 'Mum Mineral Water', '5', 'Liter', 'Mum water bottle', 15, '65', '975.00', '2024-07-17 10:45:47', '2024-07-17 10:45:47'),
(2, 'ORD-20240717-164412', 'Pro-20240717-164531-135', 'Peanut Butter', '1', 'Kg', 'Pran-RFL peanut butter', 5, '120', '600.00', '2024-07-17 10:45:47', '2024-07-17 10:45:47'),
(23, 'ORD-20240725-153245', 'Pro-20240727-151526-718', 'Ruchi Chanachur', '1', 'Kg', 'ruchi jhal chanachur', 5, '110', '550.00', '2024-07-27 09:21:19', '2024-07-27 09:21:19'),
(24, 'ORD-20240725-153245', 'Pro-20240727-151523-173', 'Aam', '5', 'Kg', 'mango', 1, '90', '90.00', '2024-07-27 09:21:19', '2024-07-27 09:21:19'),
(25, 'ORD-20240725-153245', 'Pro-20240727-152114-423', 'Jam', '2', 'Kg', 'jam', 2, '50', '100.00', '2024-07-27 09:21:19', '2024-07-27 09:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(100) NOT NULL,
  `product_id` int(100) DEFAULT NULL,
  `product_tag_number` varchar(100) DEFAULT NULL,
  `batch_number` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sales_date` date DEFAULT NULL,
  `invoice_id` int(100) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `outlet_id` int(100) DEFAULT NULL,
  `total_number_of_sold_product_in_a_batch` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `id` int(100) NOT NULL,
  `status_name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisition_orders`
--

CREATE TABLE `requisition_orders` (
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
  `requisition_type` int(11) DEFAULT NULL COMMENT '1=new stock, 2=refill stock',
  `requisition_order_id` varchar(100) DEFAULT NULL,
  `requisition_order_date` date DEFAULT NULL,
  `requisition_deliver_date` date DEFAULT NULL,
  `shop_company_id` int(100) DEFAULT NULL,
  `warehouse_id` int(100) DEFAULT NULL,
  `requisition_order_by` int(100) DEFAULT NULL,
  `requisition_reviewed_by` int(100) DEFAULT NULL,
  `supplier_id` int(100) DEFAULT NULL,
  `requisition_status` int(11) DEFAULT NULL COMMENT '1 = pending, 2= declined, 3 = delivered',
  `total_amount` varchar(100) DEFAULT NULL,
  `requisition_decline_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requisition_orders`
--

INSERT INTO `requisition_orders` (`id`, `company_id`, `requisition_type`, `requisition_order_id`, `requisition_order_date`, `requisition_deliver_date`, `shop_company_id`, `warehouse_id`, `requisition_order_by`, `requisition_reviewed_by`, `supplier_id`, `requisition_status`, `total_amount`, `requisition_decline_reason`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'ORD-20240717-164412', '2024-07-17', NULL, 11, 1, 1, 1, 4, 2, '1575.00', 'invalid order', '2024-07-17 10:45:47', '2024-07-17 10:45:47'),
(2, 11, 1, 'ORD-20240725-153245', '2024-07-25', NULL, 11, 2, 1, 1, 3, 3, '740.00', NULL, '2024-07-25 09:35:32', '2024-07-25 09:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `warehouse_name` varchar(100) DEFAULT NULL,
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
-- Indexes for table `requisition_orders`
--
ALTER TABLE `requisition_orders`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_batch`
--
ALTER TABLE `product_batch`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_requisitions`
--
ALTER TABLE `product_requisitions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisition_orders`
--
ALTER TABLE `requisition_orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
