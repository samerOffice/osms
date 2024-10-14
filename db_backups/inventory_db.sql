-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 03:41 PM
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
-- Table structure for table `barcodes_and_skus`
--

CREATE TABLE `barcodes_and_skus` (
  `id` int(255) NOT NULL,
  `stock_id` int(255) DEFAULT NULL,
  `company_id` int(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barcodes_and_skus`
--

INSERT INTO `barcodes_and_skus` (`id`, `stock_id`, `company_id`, `barcode`, `sku`, `created_at`, `updated_at`) VALUES
(1, 3, 11, NULL, 'SKU-160525-753', '2024-08-13 10:05:29', '2024-08-13 10:05:29'),
(2, 4, 11, NULL, 'SKU-160624-073', '2024-08-13 10:06:26', '2024-08-13 10:06:26'),
(3, 1, 11, NULL, 'SKU-014714-770', '2024-08-16 19:47:18', '2024-08-16 19:47:18'),
(4, 5, 11, NULL, 'SKU-124540-322', '2024-08-20 06:45:42', '2024-08-20 06:45:42'),
(5, 7, 11, NULL, 'SKU-134533-222', '2024-10-14 07:45:36', '2024-10-14 07:45:36'),
(6, 9, 11, NULL, 'SKU-160313-000', '2024-10-14 10:03:15', '2024-10-14 10:03:15'),
(7, 8, 11, NULL, 'SKU-160753-791', '2024-10-14 10:07:56', '2024-10-14 10:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `damage_and_burned_products`
--

CREATE TABLE `damage_and_burned_products` (
  `id` int(255) NOT NULL,
  `entry_date` date DEFAULT NULL,
  `company_id` int(255) DEFAULT NULL,
  `stock_id` int(255) DEFAULT NULL,
  `product_id` int(255) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `unit_price` varchar(255) DEFAULT NULL,
  `damage_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `damage_and_burned_products`
--

INSERT INTO `damage_and_burned_products` (`id`, `entry_date`, `company_id`, `stock_id`, `product_id`, `quantity`, `unit_price`, `damage_amount`, `created_at`, `updated_at`) VALUES
(1, '2024-08-13', 11, 2, 3, 7, NULL, NULL, '2024-08-13 10:07:03', '2024-08-13 10:07:03'),
(2, '2024-08-17', 11, 1, 1, 1, NULL, NULL, '2024-08-16 19:49:02', '2024-08-16 19:49:02'),
(3, '2024-08-17', 11, 3, 6, 2, NULL, '10', '2024-08-17 11:40:33', '2024-08-17 11:40:33'),
(4, '2024-08-17', 11, 3, 6, 1, '420', '420', '2024-08-17 11:48:16', '2024-08-17 11:48:16');

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
(1, 11, 'Electronics', 1, '2024-07-28 11:29:10', '2024-07-28 11:29:10'),
(2, 11, 'Furniture', 1, '2024-07-28 11:29:45', '2024-07-28 11:29:45'),
(3, 11, 'Steel', 2, '2024-07-28 11:32:18', '2024-07-28 11:32:18'),
(4, 11, 'Oil', 1, '2024-08-03 07:41:14', '2024-08-03 07:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL COMMENT '1=batch, 2=single item',
  `product_name` varchar(100) DEFAULT NULL,
  `product_track_name` varchar(255) DEFAULT NULL,
  `product_unit_price` varchar(100) DEFAULT NULL,
  `labeling_type` int(11) DEFAULT NULL COMMENT '1=sku, 2=barcode',
  `batch_number` varchar(100) DEFAULT NULL,
  `product_tag_number` varchar(255) DEFAULT NULL,
  `product_weight` varchar(100) DEFAULT NULL,
  `product_unit_type` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_total_price` varchar(100) DEFAULT NULL,
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

INSERT INTO `products` (`id`, `item_category_id`, `product_category_id`, `product_type`, `product_name`, `product_track_name`, `product_unit_price`, `labeling_type`, `batch_number`, `product_tag_number`, `product_weight`, `product_unit_type`, `quantity`, `product_total_price`, `additional_product_details`, `product_entry_date`, `product_mfg_date`, `product_expiry_date`, `product_status`, `total_product_in_a_batch`, `product_batch_price`, `current_available_product_in_a_batch`, `shop_company_id`, `shop_branch_id`, `shop_depth_id`, `shop_outlet_id`, `shop_warehouse_id`, `vendor_id`, `vendor_company_id`, `vendor_branch_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, 'Lenovo 203 tablet', 'Lenovo 203 laptop', NULL, 1, NULL, 'SKU-Electronics- Laptop -Lenovo 203 tablet-20240729-165427-336', '3', 'Kg', NULL, NULL, 'Lenovo 15\" LED', '2024-07-29', '2022-06-15', NULL, 1, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29 05:51:59', '2024-07-29 05:51:59'),
(2, 2, 1, NULL, 'Otobi Wooden Table', 'Otobi Wooden Table', NULL, 1, NULL, 'SKU-Furniture- Table -Otobi Wooden Table-20240729-115238-464', '7.5', 'Kg', NULL, NULL, 'Otobi Latest Folding Table', '2024-07-29', NULL, NULL, 1, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29 05:53:10', '2024-07-29 05:53:10'),
(3, 2, 1, NULL, 'Hatil Table', 'Hatil Table', NULL, NULL, NULL, 'SKU-Furniture- Table -Hatil Table-20240729-122841-832', '8', 'Kg', NULL, NULL, 'new hatil folding table', NULL, NULL, NULL, 1, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29 06:29:03', '2024-07-29 06:29:03'),
(6, 4, 4, NULL, 'Rupchanda Soyabin Oil', NULL, NULL, NULL, NULL, NULL, '7', 'Liter', NULL, NULL, 'Rupchanda 5L Fresh soyabin oil', NULL, NULL, NULL, 1, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-03 07:44:29', '2024-08-03 07:44:29'),
(7, 1, 3, NULL, 'HP notebook pro', NULL, NULL, NULL, NULL, NULL, '1.5', 'Kg', NULL, NULL, 'HP notebook pro 15\" laptop', NULL, NULL, NULL, 1, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-20 06:43:49', '2024-08-20 06:43:49'),
(9, 1, 6, NULL, 'HP inkjet Printer', NULL, NULL, NULL, NULL, NULL, '2', 'Kg', NULL, NULL, 'HP latest model inkjet printer', NULL, NULL, NULL, 1, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-14 06:51:26', '2024-10-14 06:51:26');

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
(1, 11, 'Table', 2, 1, '2024-07-28 11:35:45', '2024-07-28 11:35:45'),
(2, 11, 'Chair', 2, 2, '2024-07-28 11:36:04', '2024-07-28 11:36:04'),
(3, 11, 'Laptop', 1, 1, '2024-07-29 05:50:21', '2024-07-29 05:50:21'),
(4, 11, 'Soyabin Oil', 4, 1, '2024-08-03 07:41:34', '2024-08-03 07:41:34'),
(6, 11, 'Printer', 1, 1, '2024-10-14 06:50:15', '2024-10-14 06:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_requisitions`
--

CREATE TABLE `product_requisitions` (
  `id` int(255) NOT NULL,
  `requisition_order_id` varchar(100) DEFAULT NULL,
  `product_track_id` varchar(100) DEFAULT NULL,
  `product_id` int(255) DEFAULT NULL,
  `product_weight` varchar(100) DEFAULT NULL,
  `product_unit_type` varchar(100) DEFAULT NULL,
  `product_details` text DEFAULT NULL,
  `product_mfg_date` date DEFAULT NULL,
  `product_expiry_date` date DEFAULT NULL,
  `product_quantity` int(100) DEFAULT NULL,
  `product_unit_price` varchar(100) DEFAULT NULL,
  `product_subtotal` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_requisitions`
--

INSERT INTO `product_requisitions` (`id`, `requisition_order_id`, `product_track_id`, `product_id`, `product_weight`, `product_unit_type`, `product_details`, `product_mfg_date`, `product_expiry_date`, `product_quantity`, `product_unit_price`, `product_subtotal`, `created_at`, `updated_at`) VALUES
(1, 'ORD-20240813-160218-959', 'Pro-20240813-160236-802', 1, '3', 'Kg', 'Lenovo 15\" LED', NULL, NULL, 5, '45700', '228500.00', '2024-08-13 10:04:09', '2024-08-13 10:04:09'),
(2, 'ORD-20240813-160218-959', 'Pro-20240813-160301-153', 3, '6', 'Kg', 'new hatil folding table', NULL, NULL, 7, '13580', '95060.00', '2024-08-13 10:04:09', '2024-08-13 10:04:09'),
(3, 'ORD-20240813-160218-959', 'Pro-20240813-160405-602', 6, '7', 'Liter', 'Rupchanda 5L Fresh soyabin oil', NULL, NULL, 12, '420', '5040.00', '2024-08-13 10:04:09', '2024-08-13 10:04:09'),
(4, 'ORD-20240813-160417-129', 'Pro-20240813-160439-282', 3, '6', 'Kg', 'new hatil folding table', NULL, NULL, 4, '12700', '50800.00', '2024-08-13 10:04:42', '2024-08-13 10:04:42'),
(5, 'ORD-20240820-124358-339', 'Pro-20240820-124421-642', 7, '1.5', 'Kg', 'HP notebook pro 15\" laptop', NULL, NULL, 15, '40500', '607500.00', '2024-08-20 06:44:45', '2024-08-20 06:44:45'),
(6, 'ORD-20240829-133937-684', 'Pro-20240829-133949-767', 7, '1.5', 'Kg', 'HP notebook pro 15\" laptop', NULL, NULL, 4, '42500', '170000.00', '2024-08-29 07:39:51', '2024-08-29 07:39:51'),
(7, 'ORD-20241002-171224-322', 'Pro-20241002-171252-389', 3, '8', 'Kg', 'new hatil folding table', NULL, NULL, 14, '7800', '109200.00', '2024-10-02 11:12:53', '2024-10-02 11:12:53'),
(10, 'ORD-20241014-155922-831', 'Pro-20241014-160019-000', 1, '3', 'Kg', 'Lenovo 15\" LED', NULL, NULL, 10, '55000', '550000.00', '2024-10-14 10:01:14', '2024-10-14 10:01:14'),
(11, 'ORD-20241014-155922-831', 'Pro-20241014-160105-317', 9, '2', 'Kg', 'HP latest model inkjet printer', NULL, NULL, 35, '14500', '507500.00', '2024-10-14 10:01:14', '2024-10-14 10:01:14'),
(13, 'ORD-20241014-125134-968', 'Pro-20241014-125156-447', 9, '2', 'Kg', 'HP latest model inkjet printer', NULL, NULL, 10, '25400', '254000.00', '2024-10-14 11:49:35', '2024-10-14 11:49:35'),
(14, 'ORD-20241014-125134-968', 'Pro-20241014-174915-599', 2, '7.5', 'Kg', 'Otobi Latest Folding Table', NULL, NULL, 7, '7500', '52500.00', '2024-10-14 11:49:35', '2024-10-14 11:49:35'),
(15, 'ORD-20241014-191959-259', 'Pro-20241014-192016-532', 6, '7', 'Liter', 'Rupchanda 5L Fresh soyabin oil', NULL, NULL, 8, '100', '800.00', '2024-10-14 13:20:23', '2024-10-14 13:20:23');

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
  `due_clear_date` date DEFAULT NULL,
  `shop_company_id` int(100) DEFAULT NULL,
  `warehouse_id` int(100) DEFAULT NULL,
  `requisition_order_by` int(100) DEFAULT NULL,
  `requisition_reviewed_by` int(100) DEFAULT NULL,
  `supplier_id` int(100) DEFAULT NULL,
  `requisition_status` int(11) DEFAULT NULL COMMENT '1 = pending, 2= declined, 3 = delivered',
  `total_amount` varchar(100) DEFAULT NULL,
  `due_amount` varchar(100) DEFAULT NULL,
  `paid_amount` varchar(100) DEFAULT NULL,
  `requisition_decline_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requisition_orders`
--

INSERT INTO `requisition_orders` (`id`, `company_id`, `requisition_type`, `requisition_order_id`, `requisition_order_date`, `requisition_deliver_date`, `due_clear_date`, `shop_company_id`, `warehouse_id`, `requisition_order_by`, `requisition_reviewed_by`, `supplier_id`, `requisition_status`, `total_amount`, `due_amount`, `paid_amount`, `requisition_decline_reason`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'ORD-20240813-160218-959', '2024-08-13', '2024-08-13', NULL, 11, 2, 1, 1, 2, 3, '328600.00', NULL, NULL, NULL, '2024-08-13 10:04:09', '2024-08-13 10:04:09'),
(2, 11, 1, 'ORD-20240813-160417-129', '2024-08-13', '2024-08-13', NULL, 11, 1, 1, 1, 4, 3, '50800.00', NULL, NULL, NULL, '2024-08-13 10:04:42', '2024-08-13 10:04:42'),
(3, 11, 1, 'ORD-20240820-124358-339', '2024-08-20', '2024-08-20', NULL, 11, NULL, 1, 1, 3, 3, '607500.00', NULL, NULL, NULL, '2024-08-20 06:44:45', '2024-08-20 06:44:45'),
(4, 11, 1, 'ORD-20240829-133937-684', '2024-08-29', '2024-08-29', NULL, 11, 1, 9, 9, 2, 3, '170000.00', NULL, NULL, NULL, '2024-08-29 07:39:51', '2024-08-29 07:39:51'),
(5, 11, 1, 'ORD-20241002-171224-322', '2024-10-02', '2024-10-02', NULL, 11, 2, 1, 1, 2, 3, '109200.00', NULL, NULL, NULL, '2024-10-02 11:12:53', '2024-10-02 11:12:53'),
(6, 11, 1, 'ORD-20241014-125134-968', '2024-10-14', NULL, NULL, 11, 1, 1, NULL, 2, 1, '306500.00', '500.00', '306000', NULL, '2024-10-14 07:00:08', '2024-10-14 07:00:08'),
(7, 11, 1, 'ORD-20241014-155922-831', '2024-10-14', '2024-10-14', NULL, 11, 2, 1, 1, 4, 3, '1057500.00', '500.00', '1057000.00', NULL, '2024-10-14 10:01:14', '2024-10-14 10:01:14'),
(8, 11, 1, 'ORD-20241014-191959-259', '2024-10-14', NULL, NULL, 11, 2, 1, NULL, 2, 1, '800.00', '60', '740', NULL, '2024-10-14 13:20:23', '2024-10-14 13:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(255) NOT NULL,
  `product_id` int(255) DEFAULT NULL,
  `company_id` int(255) DEFAULT NULL,
  `warehouse_id` int(255) DEFAULT NULL,
  `product_mfg_date` date DEFAULT NULL,
  `product_expiry_date` date DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `product_unit_price` varchar(255) DEFAULT NULL,
  `product_subtotal` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `product_stored_by` int(255) DEFAULT NULL,
  `label_status` int(10) DEFAULT NULL COMMENT '1 = Labeled, 2 = Not Labeled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `company_id`, `warehouse_id`, `product_mfg_date`, `product_expiry_date`, `quantity`, `product_unit_price`, `product_subtotal`, `purchase_date`, `product_stored_by`, `label_status`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 2, NULL, NULL, 0, '45700', '182800', '2024-08-13', 1, 1, '2024-08-13 10:04:51', '2024-08-13 10:04:51'),
(2, 3, 11, 2, NULL, NULL, 0, '13580', '0', '2024-08-13', 1, NULL, '2024-08-13 10:04:51', '2024-08-13 10:04:51'),
(3, 6, 11, 2, NULL, NULL, 0, '420', '420', '2024-08-13', 1, 1, '2024-08-13 10:04:51', '2024-08-13 10:04:51'),
(4, 3, 11, 1, NULL, NULL, 0, '12700', '50800.00', '2024-08-13', 1, 1, '2024-08-13 10:04:55', '2024-08-13 10:04:55'),
(5, 7, 11, NULL, NULL, NULL, 0, '40500', '607500.00', '2024-08-20', 1, 1, '2024-08-20 06:44:52', '2024-08-20 06:44:52'),
(6, 7, 11, 1, NULL, NULL, 4, '42500', '170000.00', '2024-08-29', 9, NULL, '2024-08-29 07:46:56', '2024-08-29 07:46:56'),
(7, 3, 11, 2, NULL, NULL, 6, '7800', '109200.00', '2024-10-02', 1, 1, '2024-10-02 11:13:01', '2024-10-02 11:13:01'),
(8, 1, 11, 2, NULL, NULL, 10, '55000', '550000.00', '2024-10-14', 1, 1, '2024-10-14 10:01:51', '2024-10-14 10:01:51'),
(9, 9, 11, 2, NULL, NULL, 35, '14500', '507500.00', '2024-10-14', 1, 1, '2024-10-14 10:01:51', '2024-10-14 10:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_dues`
--

CREATE TABLE `supplier_dues` (
  `id` int(255) NOT NULL,
  `due_clear_date` date DEFAULT NULL,
  `company_id` int(255) DEFAULT NULL,
  `order_id` int(255) DEFAULT NULL,
  `supplier_id` int(255) DEFAULT NULL,
  `due_clear_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_dues`
--

INSERT INTO `supplier_dues` (`id`, `due_clear_date`, `company_id`, `order_id`, `supplier_id`, `due_clear_amount`, `created_at`, `updated_at`) VALUES
(1, '2024-10-14', 11, 8, 2, '40', '2024-10-14 13:39:57', '2024-10-14 13:39:57');

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
(1, 11, 3, 'Mohammadpur Warehouse', '<p>Laalbagh, Dhaka<br></p>', 1, '2024-06-10 10:25:14', '2024-06-10 10:25:14'),
(2, 11, 1, 'Mirpur warehouse', 'Mirpur DOHS', 1, '2024-06-10 10:47:05', '2024-06-10 10:47:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barcodes_and_skus`
--
ALTER TABLE `barcodes_and_skus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damage_and_burned_products`
--
ALTER TABLE `damage_and_burned_products`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_dues`
--
ALTER TABLE `supplier_dues`
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
-- AUTO_INCREMENT for table `barcodes_and_skus`
--
ALTER TABLE `barcodes_and_skus`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `damage_and_burned_products`
--
ALTER TABLE `damage_and_burned_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_batch`
--
ALTER TABLE `product_batch`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_requisitions`
--
ALTER TABLE `product_requisitions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplier_dues`
--
ALTER TABLE `supplier_dues`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
