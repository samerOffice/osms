-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 02:13 PM
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
-- Database: `emp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `nid_number` varchar(100) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_number` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(10) DEFAULT NULL,
  `flag` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `profile_pic`, `emergency_contact_name`, `emergency_contact_number`, `emergency_contact_relation`, `flag`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abul Basar Badal', 'halima', '2852574', '2258727452', 'laalbagh', 'laalbagh', '1995-09-10', 'o+', 'Bangladeshi', 'Single', 'Islam', 'Male', 'admin_images/202408281724843831.jpg', 'Abul', '01513470120', 'Father', 1, '2024-05-20 12:54:49', '2024-05-20 12:54:49'),
(2, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-12 10:30:41', '2024-06-12 10:30:41'),
(3, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-12 10:54:42', '2024-06-12 10:54:42'),
(4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-12 10:59:53', '2024-06-12 10:59:53'),
(5, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-28 08:25:58', '2024-08-28 08:25:58'),
(6, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-07 05:56:39', '2024-09-07 05:56:39'),
(7, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-07 05:57:43', '2024-09-07 05:57:43'),
(8, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-07 06:57:08', '2024-09-07 06:57:08'),
(9, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-08 09:32:57', '2024-10-08 09:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `asset_name` varchar(100) DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `cost` varchar(100) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `department_id` int(100) DEFAULT NULL,
  `warehouse_id` int(100) DEFAULT NULL,
  `outlet_id` int(100) DEFAULT NULL,
  `depreciation_rate` decimal(5,2) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `status` int(10) DEFAULT NULL COMMENT '1 = active, 2 = inactive, 3 = maintainance, 4 = damaged',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_name`, `asset_type`, `purchase_date`, `cost`, `company_id`, `branch_id`, `department_id`, `warehouse_id`, `outlet_id`, `depreciation_rate`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Laptop', 'Electronics', '2024-10-10', '35700', 11, 4, 4, 2, 2, NULL, NULL, 1, '2024-10-11 05:43:10', '2024-10-11 05:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `asset_maintenance_logs`
--

CREATE TABLE `asset_maintenance_logs` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `maintenance_date` date DEFAULT NULL,
  `maintenance_description` text DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `attendance_date` date DEFAULT NULL,
  `entry_time` time DEFAULT NULL,
  `exit_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `attendance_date`, `entry_time`, `exit_time`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-05-21', '13:13:59', NULL, '2024-05-21 07:13:59', '2024-05-21 07:13:59'),
(2, 1, '2024-05-21', '13:15:06', NULL, '2024-05-21 07:15:06', '2024-05-21 07:15:06'),
(3, 1, '2024-05-21', '13:18:21', NULL, '2024-05-21 07:18:21', '2024-05-21 07:18:21'),
(4, 1, '2024-05-21', '13:18:39', NULL, '2024-05-21 07:18:39', '2024-05-21 07:18:39'),
(5, 1, '2024-05-21', '13:22:26', NULL, '2024-05-21 07:22:26', '2024-05-21 07:22:26'),
(6, 2, '2024-05-21', '13:32:43', NULL, '2024-05-21 07:32:43', '2024-05-21 07:32:43'),
(7, 1, '2024-05-21', '13:36:37', NULL, '2024-05-21 07:36:37', '2024-05-21 07:36:37'),
(8, 1, '2024-05-28', '17:44:26', NULL, '2024-05-28 11:44:26', '2024-05-28 11:44:26'),
(9, 1, '2024-05-28', '18:30:34', NULL, '2024-05-28 12:30:34', '2024-05-28 12:30:34'),
(10, 1, '2024-05-29', '14:35:13', NULL, '2024-05-29 08:35:13', '2024-05-29 08:35:13'),
(11, 1, '2024-05-29', '18:46:23', NULL, '2024-05-29 12:46:23', '2024-05-29 12:46:23'),
(12, 1, '2024-05-30', '13:54:14', NULL, '2024-05-30 07:54:14', '2024-05-30 07:54:14'),
(13, 1, '2024-05-30', '13:54:17', NULL, '2024-05-30 07:54:17', '2024-05-30 07:54:17'),
(14, 1, '2024-06-02', '12:57:31', NULL, '2024-06-02 06:57:31', '2024-06-02 06:57:31'),
(15, 3, '2024-06-09', '12:27:58', NULL, '2024-06-09 06:27:58', '2024-06-09 06:27:58'),
(16, 3, '2024-06-10', '17:23:50', NULL, '2024-06-10 11:23:50', '2024-06-10 11:23:50'),
(17, 8, '2024-06-12', '17:48:05', NULL, '2024-06-12 11:48:05', '2024-06-12 11:48:05'),
(18, 1, '2024-06-27', '17:16:42', NULL, '2024-06-27 11:16:42', '2024-06-27 11:16:42'),
(19, 1, '2024-06-27', '18:09:07', NULL, '2024-06-27 12:09:07', '2024-06-27 12:09:07'),
(20, 1, '2024-06-27', '18:13:49', NULL, '2024-06-27 12:13:49', '2024-06-27 12:13:49'),
(21, 1, '2024-06-27', '18:18:06', NULL, '2024-06-27 12:18:06', '2024-06-27 12:18:06'),
(22, 1, '2024-06-27', '18:31:14', NULL, '2024-06-27 12:31:14', '2024-06-27 12:31:14'),
(23, 1, '2024-06-27', '18:55:56', NULL, '2024-06-27 12:55:56', '2024-06-27 12:55:56'),
(24, 1, '2024-06-27', '19:05:21', NULL, '2024-06-27 13:05:21', '2024-06-27 13:05:21'),
(25, 1, '2024-06-27', '19:13:59', NULL, '2024-06-27 13:13:59', '2024-06-27 13:13:59'),
(26, 1, '2024-07-25', '15:26:02', NULL, '2024-07-25 09:26:02', '2024-07-25 09:26:02'),
(27, 1, '2024-08-01', '16:50:53', NULL, '2024-08-01 10:50:53', '2024-08-01 10:50:53'),
(28, 1, '2024-08-01', '16:52:33', '17:03:39', '2024-08-01 10:52:33', '2024-08-01 10:52:33'),
(35, 1, '2024-10-17', '17:24:23', '17:24:30', '2024-10-17 11:24:23', '2024-10-17 11:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_users`
--

CREATE TABLE `attendance_users` (
  `id` int(100) NOT NULL,
  `uid` int(100) DEFAULT NULL,
  `system_user_id` int(100) DEFAULT NULL,
  `machine_user_id` int(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `user_create_date` date DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `card_no` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_users`
--

INSERT INTO `attendance_users` (`id`, `uid`, `system_user_id`, `machine_user_id`, `role_id`, `company_id`, `branch_id`, `user_create_date`, `password`, `card_no`, `created_at`, `updated_at`) VALUES
(1, 900, 8, 900, 1, 11, 3, '2024-10-24', '12345678', '12345678', '2024-10-24 10:11:42', '2024-10-24 10:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
  `br_name` varchar(500) DEFAULT NULL,
  `br_address` text DEFAULT NULL,
  `br_type` int(11) DEFAULT NULL COMMENT '1=Head Office, 2= Single branch',
  `br_status` int(11) DEFAULT NULL COMMENT '1= active, 2= inactive',
  `longitude` text DEFAULT NULL,
  `latitude` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `br_name`, `br_address`, `br_type`, `br_status`, `longitude`, `latitude`, `created_at`, `updated_at`) VALUES
(1, 11, 'Laalbagh Branch', '<p>LaalBagh<br></p>', 1, 2, NULL, NULL, '2024-06-10 07:52:15', '2024-06-10 07:52:15'),
(2, 11, 'Islampur Branch', 'Islampur, Dhaka', 2, 2, NULL, NULL, '2024-06-10 07:52:34', '2024-06-10 07:52:34'),
(3, 11, 'Mohammadpur Branch', 'Mohammadpur, Dhaka', 1, 1, '90.4219535', '23.7745978', '2024-06-10 07:52:46', '2024-06-10 07:52:46'),
(4, 11, 'Gulshan Branch', 'Gulshan-1, Dhaka', 1, 1, NULL, NULL, '2024-06-10 07:52:58', '2024-06-10 07:52:58'),
(6, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2024-06-12 07:27:28', '2024-06-12 07:27:28'),
(7, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2024-06-12 10:30:41', '2024-06-12 10:30:41'),
(8, 14, 'Rampura Branch', '<p>rampura bridge, dhaka<br></p>', 1, 1, NULL, NULL, '2024-06-12 10:32:19', '2024-06-12 10:32:19'),
(9, NULL, 'Malibagh Branch', 'Malibagh, Dhaka', 1, 1, NULL, NULL, '2024-06-12 10:54:42', '2024-06-12 10:54:42'),
(10, 16, 'Azimpur Branch', 'Azimpur, Dhaka', 1, 1, NULL, NULL, '2024-06-12 10:59:53', '2024-06-12 10:59:53'),
(11, 17, 'Head Branch', 'Gazipur', 1, 1, NULL, NULL, '2024-08-28 08:25:58', '2024-08-28 08:25:58'),
(12, 18, 'Khilgaon', '10 no. road, Khilgaon, Dhaka', 1, 1, NULL, NULL, '2024-09-07 05:52:17', '2024-09-07 05:52:17'),
(13, 19, 'Khilgaon', '10 no. road, Khilgaon, Dhaka', 1, 1, NULL, NULL, '2024-09-07 05:56:39', '2024-09-07 05:56:39'),
(14, 20, 'Khilgaon', '10 no. road, Khilgaon, Dhaka', 1, 1, NULL, NULL, '2024-09-07 05:57:43', '2024-09-07 05:57:43'),
(15, 21, 'Khilgaon', '10 no. road, Khilgaon, Dhaka', 1, 1, NULL, NULL, '2024-09-07 06:57:08', '2024-09-07 06:57:08'),
(16, 22, 'Head Branch', 'Gulshan-2, Dhaka, Bangladesh<br>', 1, 1, '90.4219535', '23.7745978', '2024-10-08 09:32:57', '2024-10-08 09:32:57'),
(18, 22, 'Badda Branch', 'North Badda, Dhaka, Bangladesh<br>', 1, 1, '90.4158', '23.7731', '2024-10-17 07:31:09', '2024-10-17 07:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `business_types`
--

CREATE TABLE `business_types` (
  `id` int(100) NOT NULL,
  `business_type` varchar(50) DEFAULT NULL,
  `business_status` int(10) DEFAULT NULL COMMENT '1=active, 2=inactive',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_types`
--

INSERT INTO `business_types` (`id`, `business_type`, `business_status`, `created_at`, `updated_at`) VALUES
(1, 'Retail Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(2, 'Grocery Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(3, 'Clothing Boutique', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(4, 'Electronics Shop', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(5, 'Auto Repair Shop', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(6, 'Beauty Salon', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(7, 'Barbershop', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(8, 'Coffee Shop', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(9, 'Bakery', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(10, 'Restaurant', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(11, 'Pharmacy', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(12, 'Bookstore', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(13, 'Hardware Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(14, 'Furniture Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(15, 'Toy Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(16, 'Pet Shop', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(17, 'Florist', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(18, 'Sporting Goods Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(19, 'Gift Shop', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(20, 'Garden Center', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(21, 'Health & Wellness Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(22, 'Music Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(23, 'Stationery Store', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(24, 'Convenience Store (Supermarket)', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(25, 'Optician', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20'),
(26, 'Testing Type', 1, '2024-06-12 05:37:49', '2024-06-12 05:37:49'),
(27, 'testy testing', 1, '2024-06-12 06:37:26', '2024-06-12 06:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(100) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_email` varchar(100) DEFAULT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `license_no` varchar(100) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `division` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_email`, `contact_no`, `license_no`, `company_address`, `registration_no`, `division`, `district`, `country`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-19 06:41:27', '2024-05-19 06:41:27'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-19 06:44:11', '2024-05-19 06:44:11'),
(3, 'ghffffff', NULL, '678678658768', '67gcf', NULL, NULL, '2', '14', NULL, '2024-05-19 06:45:59', '2024-05-19 06:45:59'),
(4, 'my shop', 'myshop@gmail.com', '01514120130', 'asdv123', 'mirpur 12, dhaka', 'aaaa234', '3', '21', 'Bangladesh', '2024-05-19 08:08:04', '2024-05-19 08:08:04'),
(5, 'Rupok Clothing Store', NULL, '01514120136', 'dfgfdg2354345', 'laalbagh, dhaka', 't546757', '6', '41', 'Bangladesh', '2024-05-20 08:23:24', '2024-05-20 08:23:24'),
(6, 'Kawsar Store', NULL, '01514120137', 'vfghfh56456', NULL, '64647', '4', '31', 'Bangladesh', '2024-05-20 08:28:39', '2024-05-20 08:28:39'),
(7, 'Wales Store', NULL, '01514120139', 'dfggf45456', 'Azimpur, Dhaka', '4356456', '6', '44', 'Bangladesh', '2024-05-20 10:08:25', '2024-05-20 10:08:25'),
(8, 'Wales Store', NULL, '01514120139', 'dfggf45456', 'Azimpur, Dhaka', '4356456', '6', '44', 'Bangladesh', '2024-05-20 10:10:39', '2024-05-20 10:10:39'),
(9, 'Wales Store', NULL, '01514120139', 'dfggf45456', 'Azimpur, Dhaka', '4356456', '6', '44', 'Bangladesh', '2024-05-20 10:12:50', '2024-05-20 10:12:50'),
(10, 'Samer Store', NULL, '01514120130', 'hhhh6465465', NULL, '64gfdgfdgf', '6', '47', 'Bangladesh', '2024-05-20 12:46:44', '2024-05-20 12:46:44'),
(11, 'Samer Store', 'samstore@gmail.com', '01514120130', '5464554657', 'Laalbagh, Dhaka', '4566325323', '6', '47', 'Bangladesh', '2024-05-20 12:54:49', '2024-05-20 12:54:49'),
(12, 'Rahat store', 'rahatbusiness@gmail.com', '01514120130', 'kjjhgj7777', NULL, '978987u', '3', '22', 'Bangladesh', '2024-05-21 07:24:50', '2024-05-21 07:24:50'),
(13, 'Otithee Software Solution Limited', 'ossl@gmail.com', '01514120130', '6343513', 'Police Plaza Concord, Level-10, Gulshan-1', '6413164', '6', '47', 'Bangladesh', '2024-06-12 07:27:28', '2024-06-12 07:27:28'),
(14, 'Wahid Store', 'wahidstore@gmail.com', '01514120130', '35435435', NULL, '4646', '6', '47', 'Bangladesh', '2024-06-12 10:30:41', '2024-06-12 10:30:41'),
(15, 'Rupa Store', 'rupastore@gmail.com', '01514120139', '543541351', NULL, '354354135', '6', NULL, 'Bangladesh', '2024-06-12 10:54:42', '2024-06-12 10:54:42'),
(16, 'Fahad Store', 'fahadstore@gmail.com', '01313470130', '354135413', NULL, '35413514', '6', '47', 'Bangladesh', '2024-06-12 10:59:53', '2024-06-12 10:59:53'),
(17, 'Sazid Super Shop', 'sazidsupershop@gmail.com', '01313470130', '643135452', 'Gazipur', '435847863', '6', '41', 'Bangladesh', '2024-08-28 08:25:58', '2024-08-28 08:25:58'),
(18, 'Example Company', 'examplecompany@gmail.com', '01513470158', 'LIC-123456', '12 number road, Tejgaon, Dhaka', 'REG-7890', '6', '47', 'Bangladesh', '2024-09-07 05:52:17', '2024-09-07 05:52:17'),
(19, 'Example Company', 'examplecompany@gmail.com', '01513470158', 'LIC-123456', '12 number road, Tejgaon, Dhaka', 'REG-7890', '6', '47', 'Bangladesh', '2024-09-07 05:56:39', '2024-09-07 05:56:39'),
(20, 'Example Company', 'examplecompany@gmail.com', '01513470158', 'LIC-123456', '12 number road, Tejgaon, Dhaka', 'REG-7890', '6', '47', 'Bangladesh', '2024-09-07 05:57:43', '2024-09-07 05:57:43'),
(21, 'Example Company', 'examplecompany@gmail.com', '01513470158', 'LIC-123456', '12 number road, Tejgaon, Dhaka', 'REG-7890', '6', '47', 'Bangladesh', '2024-09-07 06:57:08', '2024-09-07 06:57:08'),
(22, 'Emran Shopping Mall', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-08 09:32:57', '2024-10-08 09:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `current_modules`
--

CREATE TABLE `current_modules` (
  `id` int(11) NOT NULL,
  `module_status` int(10) NOT NULL DEFAULT 1 COMMENT '1 = general dashboard, 2= employee, 3= inventory, 4= pos, 5 = asset, 6 = accounts\r\n',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_modules`
--

INSERT INTO `current_modules` (`id`, `module_status`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-05-19 09:28:53', '2024-05-19 09:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(255) DEFAULT NULL,
  `warehouse_id` int(255) DEFAULT NULL,
  `outlet_id` int(255) DEFAULT NULL,
  `dept_name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `company_id`, `branch_id`, `warehouse_id`, `outlet_id`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, '2024-05-19 06:41:27', '2024-05-19 06:41:27'),
(2, NULL, NULL, NULL, NULL, 'Samer Department', '2024-05-19 06:44:11', '2024-05-19 06:44:11'),
(3, NULL, NULL, NULL, NULL, NULL, '2024-05-19 06:45:59', '2024-05-19 06:45:59'),
(4, 11, 14, NULL, NULL, 'Storage Department', '2024-05-19 08:08:04', '2024-05-19 08:08:04'),
(5, NULL, NULL, NULL, NULL, 'Cloth Department', '2024-05-20 08:23:24', '2024-05-20 08:23:24'),
(6, NULL, NULL, NULL, NULL, 'Storage Department', '2024-05-20 08:28:39', '2024-05-20 08:28:39'),
(7, NULL, NULL, NULL, NULL, 'Cloth Department', '2024-05-20 10:08:25', '2024-05-20 10:08:25'),
(8, NULL, NULL, NULL, NULL, 'Cloth Department', '2024-05-20 10:10:39', '2024-05-20 10:10:39'),
(9, NULL, NULL, NULL, NULL, 'Cloth Department', '2024-05-20 10:12:50', '2024-05-20 10:12:50'),
(10, NULL, NULL, NULL, NULL, NULL, '2024-05-20 12:46:44', '2024-05-20 12:46:44'),
(11, NULL, NULL, NULL, NULL, NULL, '2024-05-20 12:54:49', '2024-05-20 12:54:49'),
(12, NULL, NULL, NULL, NULL, NULL, '2024-05-21 07:24:50', '2024-05-21 07:24:50'),
(13, 11, 1, 1, NULL, 'Storage Departments', '2024-06-10 12:46:32', '2024-06-10 12:46:32'),
(14, 11, 1, NULL, 1, 'Toys Department', '2024-06-10 12:47:33', '2024-06-10 12:47:33'),
(15, 11, 1, NULL, NULL, 'Samer Toys Department', '2024-06-10 13:22:14', '2024-06-10 13:22:14'),
(16, 11, 1, 1, NULL, 'Testing Department', '2024-06-10 13:22:29', '2024-06-10 13:22:29'),
(17, 11, 1, NULL, NULL, 'Clothing Department', '2024-06-11 04:54:22', '2024-06-11 04:54:22'),
(18, NULL, NULL, NULL, NULL, NULL, '2024-06-12 07:27:28', '2024-06-12 07:27:28'),
(19, NULL, NULL, NULL, NULL, NULL, '2024-06-12 10:30:41', '2024-06-12 10:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(100) NOT NULL,
  `company_id` int(255) DEFAULT NULL,
  `level` int(100) DEFAULT NULL COMMENT '1 = managing level,\r\n2 = operational level,\r\n3 = support level',
  `designation_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `company_id`, `level`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Store Owner', '2024-06-11 08:10:03', '2024-06-11 08:10:03'),
(2, NULL, 1, 'Store Manager', '2024-06-11 08:10:21', '2024-06-11 08:10:21'),
(3, NULL, 1, 'Inventory Manager', '2024-06-11 08:10:30', '2024-06-11 08:10:30'),
(4, NULL, 1, 'Assistant Manager', '2024-06-11 08:10:41', '2024-06-11 08:10:41'),
(5, NULL, 1, 'Marketing Manager', '2024-06-11 08:10:48', '2024-06-11 08:10:48'),
(6, NULL, 1, 'Outlet Manager', '2024-06-11 08:10:54', '2024-06-11 08:10:54'),
(7, NULL, 1, 'Warehouse Manager', '2024-06-11 08:11:03', '2024-06-11 08:11:03'),
(8, NULL, 1, 'Customer Service Manager', '2024-06-11 08:11:14', '2024-06-11 08:11:14'),
(9, NULL, 1, 'Accounts Manager', '2024-06-11 08:11:22', '2024-06-11 08:11:22'),
(10, NULL, 2, 'Sales Associate', '2024-06-11 08:16:59', '2024-06-11 08:16:59'),
(11, NULL, 2, 'Sales Executive', '2024-06-11 08:17:09', '2024-06-11 08:17:09'),
(12, NULL, 2, 'Cashier', '2024-06-11 08:17:20', '2024-06-11 08:17:20'),
(13, NULL, 2, 'Customer Service Representative', '2024-06-11 08:17:53', '2024-06-11 08:17:53'),
(14, NULL, 2, 'Stock Clerk', '2024-06-11 08:18:08', '2024-06-11 08:18:08'),
(15, NULL, 2, 'Warehouse Operative', '2024-06-11 08:18:18', '2024-06-11 08:18:18'),
(16, NULL, 3, 'Maintenance Worker', '2024-06-11 08:19:02', '2024-06-11 08:19:02'),
(17, NULL, 3, 'Data Entry Clerk', '2024-06-11 08:19:12', '2024-06-11 08:19:12'),
(21, NULL, 3, 'Logistics Co-ordinator', '2024-06-12 04:31:23', '2024-06-12 04:31:23'),
(22, NULL, 3, 'IT Support', '2024-06-12 04:31:32', '2024-06-12 04:31:32'),
(23, 11, 2, 'software sales executive', '2024-08-18 11:43:28', '2024-08-18 11:43:28'),
(24, 11, 1, 'HR Manager', '2024-08-28 06:45:13', '2024-08-28 06:45:13'),
(25, 11, 1, 'Stock Manager', '2024-08-28 09:03:22', '2024-08-28 09:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) NOT NULL,
  `division_id` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `lon` varchar(15) DEFAULT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `url`) VALUES
(1, 1, 'Comilla', 'কুমিল্লা', '23.4682747', '91.1788135', 'www.comilla.gov.bd'),
(2, 1, 'Feni', 'ফেনী', '23.023231', '91.3840844', 'www.feni.gov.bd'),
(3, 1, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '23.9570904', '91.1119286', 'www.brahmanbaria.gov.bd'),
(4, 1, 'Rangamati', 'রাঙ্গামাটি', '22.65561018', '92.17541121', 'www.rangamati.gov.bd'),
(5, 1, 'Noakhali', 'নোয়াখালী', '22.869563', '91.099398', 'www.noakhali.gov.bd'),
(6, 1, 'Chandpur', 'চাঁদপুর', '23.2332585', '90.6712912', 'www.chandpur.gov.bd'),
(7, 1, 'Lakshmipur', 'লক্ষ্মীপুর', '22.942477', '90.841184', 'www.lakshmipur.gov.bd'),
(8, 1, 'Chattogram', 'চট্টগ্রাম', '22.335109', '91.834073', 'www.chittagong.gov.bd'),
(9, 1, 'Coxsbazar', 'কক্সবাজার', '21.44315751', '91.97381741', 'www.coxsbazar.gov.bd'),
(10, 1, 'Khagrachhari', 'খাগড়াছড়ি', '23.119285', '91.984663', 'www.khagrachhari.gov.bd'),
(11, 1, 'Bandarban', 'বান্দরবান', '22.1953275', '92.2183773', 'www.bandarban.gov.bd'),
(12, 2, 'Sirajganj', 'সিরাজগঞ্জ', '24.4533978', '89.7006815', 'www.sirajganj.gov.bd'),
(13, 2, 'Pabna', 'পাবনা', '23.998524', '89.233645', 'www.pabna.gov.bd'),
(14, 2, 'Bogura', 'বগুড়া', '24.8465228', '89.377755', 'www.bogra.gov.bd'),
(15, 2, 'Rajshahi', 'রাজশাহী', '24.37230298', '88.56307623', 'www.rajshahi.gov.bd'),
(16, 2, 'Natore', 'নাটোর', '24.420556', '89.000282', 'www.natore.gov.bd'),
(17, 2, 'Joypurhat', 'জয়পুরহাট', '25.09636876', '89.04004280', 'www.joypurhat.gov.bd'),
(18, 2, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', '24.5965034', '88.2775122', 'www.chapainawabganj.gov.bd'),
(19, 2, 'Naogaon', 'নওগাঁ', '24.83256191', '88.92485205', 'www.naogaon.gov.bd'),
(20, 3, 'Jashore', 'যশোর', '23.16643', '89.2081126', 'www.jessore.gov.bd'),
(21, 3, 'Satkhira', 'সাতক্ষীরা', '22.7180905', '89.0687033', 'www.satkhira.gov.bd'),
(22, 3, 'Meherpur', 'মেহেরপুর', '23.762213', '88.631821', 'www.meherpur.gov.bd'),
(23, 3, 'Narail', 'নড়াইল', '23.172534', '89.512672', 'www.narail.gov.bd'),
(24, 3, 'Chuadanga', 'চুয়াডাঙ্গা', '23.6401961', '88.841841', 'www.chuadanga.gov.bd'),
(25, 3, 'Kushtia', 'কুষ্টিয়া', '23.901258', '89.120482', 'www.kushtia.gov.bd'),
(26, 3, 'Magura', 'মাগুরা', '23.487337', '89.419956', 'www.magura.gov.bd'),
(27, 3, 'Khulna', 'খুলনা', '22.815774', '89.568679', 'www.khulna.gov.bd'),
(28, 3, 'Bagerhat', 'বাগেরহাট', '22.651568', '89.785938', 'www.bagerhat.gov.bd'),
(29, 3, 'Jhenaidah', 'ঝিনাইদহ', '23.5448176', '89.1539213', 'www.jhenaidah.gov.bd'),
(30, 4, 'Jhalakathi', 'ঝালকাঠি', '22.6422689', '90.2003932', 'www.jhalakathi.gov.bd'),
(31, 4, 'Patuakhali', 'পটুয়াখালী', '22.3596316', '90.3298712', 'www.patuakhali.gov.bd'),
(32, 4, 'Pirojpur', 'পিরোজপুর', '22.5781398', '89.9983909', 'www.pirojpur.gov.bd'),
(33, 4, 'Barisal', 'বরিশাল', '22.7004179', '90.3731568', 'www.barisal.gov.bd'),
(34, 4, 'Bhola', 'ভোলা', '22.685923', '90.648179', 'www.bhola.gov.bd'),
(35, 4, 'Barguna', 'বরগুনা', '22.159182', '90.125581', 'www.barguna.gov.bd'),
(36, 5, 'Sylhet', 'সিলেট', '24.8897956', '91.8697894', 'www.sylhet.gov.bd'),
(37, 5, 'Moulvibazar', 'মৌলভীবাজার', '24.482934', '91.777417', 'www.moulvibazar.gov.bd'),
(38, 5, 'Habiganj', 'হবিগঞ্জ', '24.374945', '91.41553', 'www.habiganj.gov.bd'),
(39, 5, 'Sunamganj', 'সুনামগঞ্জ', '25.0658042', '91.3950115', 'www.sunamganj.gov.bd'),
(40, 6, 'Narsingdi', 'নরসিংদী', '23.932233', '90.71541', 'www.narsingdi.gov.bd'),
(41, 6, 'Gazipur', 'গাজীপুর', '24.0022858', '90.4264283', 'www.gazipur.gov.bd'),
(42, 6, 'Shariatpur', 'শরীয়তপুর', '23.2060195', '90.3477725', 'www.shariatpur.gov.bd'),
(43, 6, 'Narayanganj', 'নারায়ণগঞ্জ', '23.63366', '90.496482', 'www.narayanganj.gov.bd'),
(44, 6, 'Tangail', 'টাঙ্গাইল', '24.264145', '89.918029', 'www.tangail.gov.bd'),
(45, 6, 'Kishoreganj', 'কিশোরগঞ্জ', '24.444937', '90.776575', 'www.kishoreganj.gov.bd'),
(46, 6, 'Manikganj', 'মানিকগঞ্জ', '23.8602262', '90.0018293', 'www.manikganj.gov.bd'),
(47, 6, 'Dhaka', 'ঢাকা', '23.7115253', '90.4111451', 'www.dhaka.gov.bd'),
(48, 6, 'Munshiganj', 'মুন্সিগঞ্জ', '23.5435742', '90.5354327', 'www.munshiganj.gov.bd'),
(49, 6, 'Rajbari', 'রাজবাড়ী', '23.7574305', '89.6444665', 'www.rajbari.gov.bd'),
(50, 6, 'Madaripur', 'মাদারীপুর', '23.164102', '90.1896805', 'www.madaripur.gov.bd'),
(51, 6, 'Gopalganj', 'গোপালগঞ্জ', '23.0050857', '89.8266059', 'www.gopalganj.gov.bd'),
(52, 6, 'Faridpur', 'ফরিদপুর', '23.6070822', '89.8429406', 'www.faridpur.gov.bd'),
(53, 7, 'Panchagarh', 'পঞ্চগড়', '26.3411', '88.5541606', 'www.panchagarh.gov.bd'),
(54, 7, 'Dinajpur', 'দিনাজপুর', '25.6217061', '88.6354504', 'www.dinajpur.gov.bd'),
(55, 7, 'Lalmonirhat', 'লালমনিরহাট', '25.9165451', '89.4532409', 'www.lalmonirhat.gov.bd'),
(56, 7, 'Nilphamari', 'নীলফামারী', '25.931794', '88.856006', 'www.nilphamari.gov.bd'),
(57, 7, 'Gaibandha', 'গাইবান্ধা', '25.328751', '89.528088', 'www.gaibandha.gov.bd'),
(58, 7, 'Thakurgaon', 'ঠাকুরগাঁও', '26.0336945', '88.4616834', 'www.thakurgaon.gov.bd'),
(59, 7, 'Rangpur', 'রংপুর', '25.7558096', '89.244462', 'www.rangpur.gov.bd'),
(60, 7, 'Kurigram', 'কুড়িগ্রাম', '25.805445', '89.636174', 'www.kurigram.gov.bd'),
(61, 8, 'Sherpur', 'শেরপুর', '25.0204933', '90.0152966', 'www.sherpur.gov.bd'),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', '24.7465670', '90.4072093', 'www.mymensingh.gov.bd'),
(63, 8, 'Jamalpur', 'জামালপুর', '24.937533', '89.937775', 'www.jamalpur.gov.bd'),
(64, 8, 'Netrokona', 'নেত্রকোণা', '24.870955', '90.727887', 'www.netrokona.gov.bd');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `url`) VALUES
(1, 'Chattagram', 'চট্টগ্রাম', 'www.chittagongdiv.gov.bd'),
(2, 'Rajshahi', 'রাজশাহী', 'www.rajshahidiv.gov.bd'),
(3, 'Khulna', 'খুলনা', 'www.khulnadiv.gov.bd'),
(4, 'Barisal', 'বরিশাল', 'www.barisaldiv.gov.bd'),
(5, 'Sylhet', 'সিলেট', 'www.sylhetdiv.gov.bd'),
(6, 'Dhaka', 'ঢাকা', 'www.dhakadiv.gov.bd'),
(7, 'Rangpur', 'রংপুর', 'www.rangpurdiv.gov.bd'),
(8, 'Mymensingh', 'ময়মনসিংহ', 'www.mymensinghdiv.gov.bd');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `designation_id` int(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `monthly_salary` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `nid_number` varchar(100) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_number` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(10) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `designation_id`, `joining_date`, `monthly_salary`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `profile_pic`, `emergency_contact_name`, `emergency_contact_number`, `emergency_contact_relation`, `flag`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2024-05-02', '12500', 'Hamid Ahmed papa', 'Hasina Begum', '01513470121', '7647643756', '<p>Meherpur<br></p>', '<p>Puran Dhaka<br></p>', '1994-06-15', 'AB+', 'Bangladeshi', 'Single', 'Islam', 'Male', 'employee_images/202408221724322609.jpg', 'Hamid Ahmed', '01513470138', 'Father', 1, '2024-05-21 07:24:50', '2024-05-21 07:24:50'),
(2, 3, 4, '2024-05-30', NULL, 'Hamid Ahmed', 'Shamima Basar', '01513470127', '35435135413', '<p>mirpur 12<br></p>', '<p>mirpur 12<br></p>', '1994-06-15', 'B+', 'Bangladeshi', 'Married', 'Islam', 'Male', NULL, 'Hamid Ahmed', '01513470138', 'Father', 1, '2024-05-30 04:33:28', '2024-05-30 04:33:28'),
(3, 8, 23, NULL, '12500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-12 11:47:06', '2024-06-12 11:47:06'),
(4, 9, 23, '2024-06-12', '25500', 'Sohel Hossain', 'Mobina Khatun', '01814750128', '126563463', '<p>Mohammadpur, Dhaka<br></p>', '<p>Mohammadpur, Dhaka</p>', '1994-06-09', 'O+', 'Bangladeshi', 'Single', 'Islam', 'Male', 'employee_images/202408221724321326.jpg', 'Sohel Hossain', '01513470139', 'Father', 1, '2024-06-12 12:48:50', '2024-06-12 12:48:50'),
(5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-27 11:18:54', '2024-06-27 11:18:54'),
(6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-27 13:17:38', '2024-06-27 13:17:38'),
(7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-14 09:40:38', '2024-08-14 09:40:38'),
(10, 15, NULL, NULL, '12500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-28 06:55:27', '2024-08-28 06:55:27'),
(11, 16, 24, NULL, '27500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-28 07:07:24', '2024-08-28 07:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `employee_performances`
--

CREATE TABLE `employee_performances` (
  `id` int(100) NOT NULL,
  `emp_id` int(100) DEFAULT NULL,
  `total_working_hours` varchar(100) DEFAULT NULL,
  `total_overtime_hours` varchar(100) DEFAULT NULL,
  `performance_bonus` varchar(100) DEFAULT NULL,
  `total_attendance` varchar(100) DEFAULT NULL,
  `smartness_point` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `company_id` int(255) DEFAULT NULL,
  `expense_type` int(10) DEFAULT NULL COMMENT '1 = daily, 2 = monthly, 3 = yearly',
  `expense_name` varchar(100) DEFAULT NULL,
  `expense_amount` varchar(100) DEFAULT NULL,
  `expense_pay_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `company_id`, `expense_type`, `expense_name`, `expense_amount`, `expense_pay_date`, `created_at`, `updated_at`) VALUES
(2, 11, 1, 'Snacks', '260', '2024-10-19', '2024-10-19 05:28:14', '2024-10-19 05:28:14'),
(3, 11, 2, 'Market Member Fees', '540', '2024-10-19', '2024-10-19 05:41:34', '2024-10-19 05:41:34'),
(7, 11, 3, 'Zakat', '25800', '2024-10-19', '2024-10-19 08:51:31', '2024-10-19 08:51:31'),
(9, 11, 3, 'Domain and Hosting', '7200', '2024-10-19', '2024-10-19 08:51:31', '2024-10-19 08:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `company_id` int(255) DEFAULT NULL,
  `application_type` int(10) DEFAULT NULL COMMENT '1 = file attachment, 2= form submission',
  `application_file` varchar(100) DEFAULT NULL,
  `leave_type` int(100) DEFAULT NULL,
  `application_msg` text DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `application_from` date DEFAULT NULL,
  `application_to` date DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `approved_duration` int(10) DEFAULT NULL,
  `application_status` int(11) DEFAULT NULL COMMENT '1 = pending, 2 = approved, 3 = declined',
  `application_approved_user_id` int(100) DEFAULT NULL,
  `application_approved_date` date DEFAULT NULL,
  `application_decline_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `user_id`, `company_id`, `application_type`, `application_file`, `leave_type`, `application_msg`, `application_date`, `application_from`, `application_to`, `duration`, `approved_duration`, `application_status`, `application_approved_user_id`, `application_approved_date`, `application_decline_date`, `created_at`, `updated_at`) VALUES
(1, 9, 11, 1, 'leave_applications/202408221724328567.pdf', 1, NULL, '2024-08-22', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-08-22 12:09:27', '2024-08-22 12:09:27'),
(2, 9, 11, 2, NULL, 1, 'Dear Chairman Sir,\r\n\r\nsubject : please grant sick leave\r\n\r\nyour sincerely,', '2024-08-22', '2024-08-24', '2024-08-26', NULL, NULL, 1, NULL, NULL, NULL, '2024-08-22 12:52:44', '2024-08-24 06:57:02'),
(3, 1, 11, 2, NULL, 1, 'sfsdfsdf', '2024-08-24', NULL, NULL, NULL, NULL, 3, 16, NULL, '2024-08-28', '2024-08-24 05:24:24', '2024-08-24 05:24:24'),
(4, 9, 11, 2, NULL, 1, 'Dear Sir,\r\n\r\nSubject: Sick Leave Application\r\n\r\nSir, I have been experiencing severe headaches. and have been advised by my doctor to rest and recover. I apologize for any inconvenience my absence may cause and will ensure that all pending tasks are handed over appropriately. If needed, I am available via [phone/email] for any urgent queries. Thank you for your understanding.\r\n\r\nBest regards,\r\n\r\nYamin Hosssain\r\nSenior Software Engineer\r\nOtithee Software Solution Limited', '2024-07-24', '2024-08-24', '2024-08-26', 3, 2, 2, 1, '2024-08-24', NULL, '2024-08-24 06:58:55', '2024-08-24 09:55:30'),
(8, 9, 11, 1, 'leave_applications/202408241724490407.pdf', 1, NULL, '2024-07-24', '2024-08-27', '2024-08-29', 3, 3, 2, 1, '2024-08-29', NULL, '2024-08-24 07:08:24', '2024-08-24 07:08:24'),
(9, 16, 11, 1, 'leave_applications/202408281724846561.pdf', 1, NULL, '2024-08-28', '2024-08-28', '2024-08-28', 1, NULL, 1, NULL, NULL, NULL, '2024-08-28 12:02:41', '2024-08-28 12:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(255) NOT NULL,
  `company_id` int(255) DEFAULT NULL,
  `type_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `company_id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 11, 'Sick Leave', '2024-08-20 12:47:16', '2024-08-20 12:47:16'),
(2, 11, 'Marriage Leave', '2024-08-28 09:05:56', '2024-08-28 09:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(100) NOT NULL,
  `module_type` int(10) DEFAULT NULL COMMENT '1 = General Dashboard, 2 = Employee Module, 3 = Inventory Module, 4 = POS Module',
  `menu_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `module_type`, `menu_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Employee Dashboard', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(2, 1, 'Inventory Dashboard', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(3, 1, 'POS Dashboard', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(8, 2, 'Payrolls', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(9, 2, 'Employees', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(10, 2, 'Add Leave Type', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(11, 2, 'Leave Approval List', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(12, 3, 'Item Category', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(13, 3, 'Product Category', '2024-08-24 12:01:08', '2024-08-24 12:01:08'),
(14, 3, 'Product', '2024-08-24 12:01:34', '2024-08-24 12:01:34'),
(15, 3, 'Product Purchase', '2024-08-24 12:01:34', '2024-08-24 12:01:34'),
(16, 3, 'Stock', '2024-08-27 06:47:08', '2024-08-27 06:47:08'),
(17, 4, 'Sale & Invoice', '2024-08-27 07:48:15', '2024-08-27 07:48:15'),
(18, 4, 'Sale List', '2024-08-27 07:48:15', '2024-08-27 07:48:15'),
(19, 4, 'Customer', '2024-08-27 07:48:15', '2024-08-27 07:48:15'),
(20, 4, 'Customer Due List', '2024-08-27 07:48:15', '2024-08-27 07:48:15'),
(21, 4, 'Terms & Conditions', '2024-08-27 07:48:15', '2024-08-27 07:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `menu_permissions`
--

CREATE TABLE `menu_permissions` (
  `id` int(100) NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `menus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_permissions`
--

INSERT INTO `menu_permissions` (`id`, `role_id`, `user_id`, `menus`, `created_at`, `updated_at`) VALUES
(5, 2, 1, '1,2,3', '2024-08-28 08:25:58', '2024-08-28 08:25:58'),
(6, 3, 16, '1,8,9,10,11', '2024-08-28 08:42:39', '2024-08-28 08:42:39'),
(7, 3, 9, '1,2,12,13,14,15,16', '2024-08-28 10:53:00', '2024-08-28 10:53:00'),
(8, 2, 19, '1,2,3', '2024-09-07 05:56:39', '2024-09-07 05:56:39'),
(9, 2, 20, '1,2,3', '2024-09-07 05:57:43', '2024-09-07 05:57:43'),
(10, 2, 21, '1,2,3', '2024-09-07 06:57:08', '2024-09-07 06:57:08'),
(11, 2, 22, '1,2,3', '2024-10-08 09:32:57', '2024-10-08 09:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(100) NOT NULL,
  `employee` int(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `salary_date` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `per_day_salary` varchar(100) DEFAULT NULL,
  `emp_total_bonus_day` varchar(100) DEFAULT NULL,
  `emp_total_bonus_amount` varchar(100) DEFAULT NULL,
  `bonus_eligible_month` varchar(100) DEFAULT NULL,
  `bonus_pay_month` varchar(100) DEFAULT NULL,
  `bonus_pay_amount` varchar(100) DEFAULT NULL,
  `total_working_day` varchar(100) DEFAULT NULL,
  `total_leave` varchar(100) DEFAULT NULL,
  `total_number_of_pay_day` varchar(100) DEFAULT NULL,
  `monthly_salary` varchar(100) DEFAULT NULL,
  `monthly_holiday_bonus` varchar(100) DEFAULT NULL,
  `total_daily_allowance` varchar(100) DEFAULT NULL,
  `total_travel_allowance` varchar(100) DEFAULT NULL,
  `rental_cost_allowance` varchar(100) DEFAULT NULL,
  `hospital_bill_allowance` varchar(100) DEFAULT NULL,
  `insurance_allowance` varchar(100) DEFAULT NULL,
  `sales_commission` varchar(100) DEFAULT NULL,
  `retail_commission` varchar(100) DEFAULT NULL,
  `total_others` varchar(100) DEFAULT NULL,
  `total_salary` varchar(100) DEFAULT NULL,
  `yearly_bonus` varchar(100) DEFAULT NULL,
  `total_payable_salary` varchar(100) DEFAULT NULL,
  `advance_less` varchar(100) DEFAULT NULL,
  `any_deduction` varchar(100) DEFAULT NULL,
  `final_pay_amount` varchar(100) DEFAULT NULL,
  `loan_advance` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `employee`, `company`, `salary_date`, `joining_date`, `per_day_salary`, `emp_total_bonus_day`, `emp_total_bonus_amount`, `bonus_eligible_month`, `bonus_pay_month`, `bonus_pay_amount`, `total_working_day`, `total_leave`, `total_number_of_pay_day`, `monthly_salary`, `monthly_holiday_bonus`, `total_daily_allowance`, `total_travel_allowance`, `rental_cost_allowance`, `hospital_bill_allowance`, `insurance_allowance`, `sales_commission`, `retail_commission`, `total_others`, `total_salary`, `yearly_bonus`, `total_payable_salary`, `advance_less`, `any_deduction`, `final_pay_amount`, `loan_advance`, `created_at`, `updated_at`) VALUES
(1, 1, '11', '2024-08-17', '2024-05-06', '550', NULL, NULL, NULL, NULL, NULL, '26', '0', '26', '14300', '550', '0', '0', '0', '0', '0', '0', '0', '550', '14850', '0', '14850', '0', '0', '14850', NULL, '2024-08-17 11:24:57', '2024-08-17 11:24:57'),
(2, 3, '11', '2024-08-17', '2024-05-30', '200', NULL, NULL, NULL, NULL, NULL, '26', '0', '26', '5200', '200', '0', '0', '0', '0', '0', '0', '0', '200', '5400', '0', '5400', '0', '0', '5400', NULL, '2024-08-17 11:25:25', '2024-08-17 11:25:25'),
(3, 1, '11', '2024-08-16', '2024-05-06', '800', NULL, NULL, NULL, NULL, NULL, '26', '0', '26', '20800', '800', '0', '0', '0', '0', '0', '0', '0', '800', '21600', '0', '21600', '0', '0', '21600', NULL, '2024-08-17 11:25:52', '2024-08-17 11:25:52'),
(4, 9, '11', '2024-08-18', '2024-06-12', '827', NULL, NULL, NULL, NULL, NULL, '26', '0', '26', '21502', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '21502', '0', '21502', '0', '0', '21502', NULL, '2024-08-18 11:33:00', '2024-08-18 11:33:00'),
(5, 16, '11', '2024-08-28', '2021-07-22', '1058', NULL, NULL, NULL, NULL, NULL, '26', '0', '26', '27508', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '27508', '0', '27508', '0', '0', '27508', NULL, '2024-08-28 12:05:50', '2024-08-28 12:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_reports`
--

CREATE TABLE `payroll_reports` (
  `id` int(100) NOT NULL,
  `emp_id` int(100) DEFAULT NULL,
  `salary_rate` varchar(100) DEFAULT NULL,
  `total_working_hours` varchar(100) DEFAULT NULL,
  `total_overtime_hours` varchar(100) DEFAULT NULL,
  `bonus` varchar(100) DEFAULT NULL,
  `total_pay` varchar(100) DEFAULT NULL,
  `deductions` varchar(100) DEFAULT NULL,
  `salary_date` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `routing_number` varchar(100) DEFAULT NULL,
  `bank_acc_no` varchar(100) DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `employment_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(132, 'App\\Models\\User', 11, 'myToken', 'aa2382007c775560373b6eba13e5423cda1ecc5605f06a177cf08ac2952cc24c', '[\"*\"]', NULL, NULL, '2024-05-19 00:23:43', '2024-05-19 00:23:43'),
(543, 'App\\Models\\User', 1, 'myToken', '7d613da05f0416cb3eac0b76dd708cc2be2e3d7c1adfc412d48ff461150efad5', '[\"*\"]', NULL, NULL, '2024-10-24 10:20:29', '2024-10-24 10:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` int(255) NOT NULL,
  `company_id` int(255) DEFAULT NULL,
  `rent_eligible_date` date DEFAULT NULL,
  `rent_pay_date` date DEFAULT NULL,
  `rent_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`id`, `company_id`, `rent_eligible_date`, `rent_pay_date`, `rent_amount`, `created_at`, `updated_at`) VALUES
(1, 11, '2024-07-01', '2024-08-18', '15505', '2024-08-17 09:24:59', '2024-08-17 09:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `role_status` int(10) DEFAULT 1 COMMENT '1=active, 2=inactive',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 1, NULL, NULL),
(2, 'admin', 1, NULL, NULL),
(3, 'employee', 1, NULL, NULL),
(4, 'vendor', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `nid_number` varchar(100) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_number` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(10) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`id`, `user_id`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `profile_pic`, `emergency_contact_name`, `emergency_contact_number`, `emergency_contact_relation`, `flag`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-12 07:27:28', '2024-06-12 07:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(100) NOT NULL,
  `company_id` int(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `nid_number` varchar(100) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `official_address` varchar(255) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_number` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(100) DEFAULT NULL,
  `active_status` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_id`, `full_name`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `official_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `profile_pic`, `emergency_contact_name`, `emergency_contact_number`, `emergency_contact_relation`, `active_status`, `created_at`, `updated_at`) VALUES
(2, 11, 'Sujon Mahmud Joy', NULL, NULL, '01513470158', NULL, NULL, 'Dhanmondi 27, Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-15 06:41:10', '2024-07-15 06:41:10'),
(3, 11, 'Hamim Rahman', NULL, NULL, '01513470121', NULL, NULL, '<p>Mirpur 1, Dhaka<br></p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-16 10:36:15', '2024-07-16 10:36:15'),
(4, 11, 'Sumon Rana', NULL, NULL, '01513470157', NULL, NULL, 'Hazaribagh, Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-17 09:36:43', '2024-07-17 09:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `branch_id` int(100) DEFAULT NULL,
  `review_requisition` int(10) DEFAULT NULL COMMENT '1 = Yes, 2 = No',
  `warehouse_id` int(255) DEFAULT NULL,
  `outlet_id` int(255) DEFAULT NULL,
  `department_id` int(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active_status` int(10) DEFAULT NULL COMMENT '1=active, 2=inactive',
  `designation` text DEFAULT NULL,
  `company_business_type` int(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `company_id`, `branch_id`, `review_requisition`, `warehouse_id`, `outlet_id`, `department_id`, `joining_date`, `email_verified_at`, `password`, `active_status`, `designation`, `company_business_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abul Kauser Samer', 'sam@gmail.com', 2, 11, 3, 1, NULL, NULL, 11, '2024-05-06', NULL, '$2y$10$fiTtckRf5G7T1g8uOvPDfuI5NY39E28T2TOlWQRKkCPi5eOhuVRg2', 1, '1', 1, NULL, '2024-05-20 06:54:49', '2024-06-04 10:39:48'),
(2, 'rahat ahmed', 'rahat@gmail.com', 3, 12, 12, NULL, NULL, NULL, 12, '2024-05-02', NULL, '$2y$10$bRFLISLP82.g4V4rR4UvI.Z7QJycvcSLl9dlYJAajc/iITMzHVNp.', 1, '2', 1, NULL, '2024-05-21 07:24:50', '2024-05-21 07:24:50'),
(3, 'Maliha Khatun', 'maliha@gmail.com', 3, 11, 14, NULL, NULL, NULL, NULL, '2024-05-30', NULL, '$2y$10$y3GwSXLco97/EiNZC1x8heCpXNLr8hGEFjSar2exG9I24bMZsK4v.', 2, '4', 1, NULL, '2024-05-30 04:33:28', '2024-05-30 04:33:28'),
(4, 'OSSL', 'ossl@gmail.com', 1, 13, 6, NULL, NULL, NULL, 18, '2024-06-12', NULL, '$2y$10$ASNBaeOaK1mHdXToX7Dc8uDQTmopYKq068OES416ODYaikzKQl2Ku', 1, '1', 26, NULL, '2024-06-12 07:27:28', '2024-06-12 07:27:28'),
(5, 'Wahid Rahman', 'wahid@gmail.com', 2, 14, NULL, 1, NULL, NULL, NULL, '2021-05-12', NULL, '$2y$10$1xfhno1L/KWAwe9M4FM2W.RmqqO./QRMf0SzM.7T.CXaL09pKw8u2', 1, '1', 3, NULL, '2024-06-12 10:30:41', '2024-06-12 10:30:41'),
(6, 'Rupa Rahman', 'rupa@gmail.com', 2, 15, 9, 1, NULL, NULL, NULL, '2023-04-04', NULL, '$2y$10$Uedv4qY.IF2k2bO2fCMeP.u4osouZfHBWMbKexg8Oz753dtsSIOSi', 1, '1', 3, NULL, '2024-06-12 10:54:42', '2024-06-12 10:54:42'),
(7, 'Fahad Ahmed', 'fahad@gmail.com', 2, 16, 10, 1, NULL, NULL, NULL, '2022-05-11', NULL, '$2y$10$B4HjW5ISg0phrHEJwbfQZ.Lro5KetTpOmtQVFfH7OcQrx5QzeE.Dy', 1, '1', 4, NULL, '2024-06-12 10:59:53', '2024-06-12 10:59:53'),
(8, 'Tuhin Ahmed', 'tuhin@gmail.com', 3, 11, 3, 1, 1, NULL, NULL, '2024-06-04', NULL, '$2y$10$kOIA46nYPFVr5tH0XDOtBuYIYeEwhvvtxuXwBJrLanb8Lj45AK5yK', 1, '23', 1, NULL, '2024-06-12 11:47:06', '2024-06-12 11:47:06'),
(9, 'Yamin Hossain', 'yamin@gmail.com', 3, 11, 3, 1, 1, NULL, NULL, '2024-06-12', NULL, '$2y$10$5JrPAz9EwNFn8fT3ARJ9ae/dNC1MVQJQryWb8YuvI.jT9L/JsyQ5G', 1, '23', 1, NULL, '2024-06-12 12:48:50', '2024-08-28 11:20:56'),
(10, 'fahim ahmed', 'fahim@gmail.com', 3, 11, 3, 1, 1, NULL, NULL, '2024-06-18', NULL, '$2y$10$6n1z1jwm/8Cjp0/WZroug.grCo7aWCakpJC7AyxX314WlrKWFbh.O', 1, '3', 1, NULL, '2024-06-27 11:18:54', '2024-06-27 11:18:54'),
(11, 'Sahed Rahman', 'sahed@gmail.com', 3, 11, 3, 1, 1, NULL, NULL, '2024-06-18', NULL, '$2y$10$RmNw5eA99If5dxCZwzEbxuewe16hGbW/gL/kPyo.UvSLs8ooNEzcW', 1, '3', 1, NULL, '2024-06-27 13:17:38', '2024-06-27 13:17:38'),
(12, 'Masud Mia', 'masudmia@gmail.com', 3, 11, 3, 1, 1, NULL, NULL, '2024-08-01', NULL, '$2y$10$K1/x8ctvAxFdt5sNPxrSTeqVvX.HTaQvNnrEtTaUUr.2Lhjdc8u3C', 1, '3', 1, NULL, '2024-08-14 09:40:38', '2024-08-14 09:40:38'),
(15, 'Tamim Hasan', 'tamim@gmail.com', 3, 11, 3, 1, 1, NULL, NULL, '2022-07-06', NULL, '$2y$10$hl/sUFkDxw5Mej4xRXdGLu0fZlMCo0R.ACudNHI3jwRuI.ufKmI.O', 1, '24', 1, NULL, '2024-08-28 06:55:27', '2024-08-28 06:55:27'),
(16, 'Humayun Ahmed', 'humayun@gmail.com', 3, 11, 3, NULL, NULL, NULL, NULL, '2021-07-22', NULL, '$2y$10$y2lRfvIu1nYCf6CnM15MmO3.8./e.aX1KQsuUfzdO.ZHi.w1qovNi', 1, '24', 1, NULL, '2024-08-28 07:07:24', '2024-08-28 07:07:24'),
(17, 'Sazid Rahman', 'sazid@gmail.com', 2, 17, 11, 1, NULL, NULL, NULL, '2024-08-28', NULL, '$2y$10$nAed9JaeQvcCi/kFtlpn/OmdJZtR7UxWAfKPIoyzSeoL5Jp51SOHq', 1, '1', 24, NULL, '2024-08-28 08:25:58', '2024-08-28 08:25:58'),
(18, 'Jasim Molla', 'jasim@gmail.com', 2, 18, 12, 1, NULL, NULL, NULL, '2024-09-01', NULL, '$2y$10$6fsi78w5GUO1Rc1K3QSfCOJs9v2zWphs.elXQ7AtK/8Xn9qRTx612', 1, '1', 1, NULL, '2024-09-07 05:52:18', '2024-09-07 05:52:18'),
(19, 'Jasim Molla', 'jasi@gmail.com', 2, 19, 13, 1, NULL, NULL, NULL, '2024-09-01', NULL, '$2y$10$RWNqwgOb4fnzKD6hhik8qOC7yY/Cmm50qN.ZfNed04ZmAQVgti/cq', 1, '1', 1, NULL, '2024-09-07 05:56:39', '2024-09-07 05:56:39'),
(20, 'Jasim Molla', 'jas@gmail.com', 2, 20, 14, 1, NULL, NULL, NULL, '2024-09-01', NULL, '$2y$10$U2biKHqzEm./NtfdSZ1WzuuhI19tks4pmMKyiAJxxrwyfBIGPJgxW', 1, '1', 1, NULL, '2024-09-07 05:57:43', '2024-09-07 05:57:43'),
(21, 'Jasim Molla', 'ja@gmail.com', 2, 21, 15, 1, NULL, NULL, NULL, '2024-09-01', NULL, '$2y$10$qtauKP1Xc8cY7AZUJAKguu.gQ0xFj7UBDLzeW7ANJEKdqaAlIqeKm', 1, '1', 1, NULL, '2024-09-07 06:57:08', '2024-09-07 06:57:08'),
(22, 'Nakibul Islam Emran', 'emran@gmail.com', 2, 22, 16, 1, NULL, NULL, NULL, '2024-10-08', NULL, '$2y$10$dyQ/6sAX4mP6/OFiq.6VxeUwi1Out785HA9Sz20F5Vk3l.q.WEJBS', 1, '1', 3, NULL, '2024-10-08 09:32:57', '2024-10-08 09:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(500) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
--

CREATE TABLE `utilities` (
  `id` int(255) NOT NULL,
  `company_id` int(255) DEFAULT NULL,
  `utility_pay_date` date DEFAULT NULL,
  `utility_type` varchar(100) DEFAULT NULL,
  `utility_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilities`
--

INSERT INTO `utilities` (`id`, `company_id`, `utility_pay_date`, `utility_type`, `utility_amount`, `created_at`, `updated_at`) VALUES
(1, 11, '2024-08-23', 'waste disposals', '150', '2024-08-17 10:34:33', '2024-08-17 10:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `nid_number` varchar(100) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `official_address` varchar(255) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_number` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(100) DEFAULT NULL,
  `flag` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_maintenance_logs`
--
ALTER TABLE `asset_maintenance_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_users`
--
ALTER TABLE `attendance_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_types`
--
ALTER TABLE `business_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_modules`
--
ALTER TABLE `current_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_performances`
--
ALTER TABLE `employee_performances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_permissions`
--
ALTER TABLE `menu_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_reports`
--
ALTER TABLE `payroll_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `asset_maintenance_logs`
--
ALTER TABLE `asset_maintenance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `attendance_users`
--
ALTER TABLE `attendance_users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `business_types`
--
ALTER TABLE `business_types`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `current_modules`
--
ALTER TABLE `current_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_performances`
--
ALTER TABLE `employee_performances`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menu_permissions`
--
ALTER TABLE `menu_permissions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payroll_reports`
--
ALTER TABLE `payroll_reports`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=544;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
