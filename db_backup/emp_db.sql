-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 02:59 PM
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
  `id` int(11) NOT NULL,
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
(1, 1, 'abu basar', 'halima', '2852574', '2258727452', 'laalbagh', 'laalbagh', '1995-09-10', 'o+', 'Bangladeshi', 'Single', 'Islam', 'Male', NULL, 'Abul', '01513470120', 'Father', 1, '2024-05-20 12:54:49', '2024-05-20 12:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
(7, 1, '2024-05-21', '13:36:37', NULL, '2024-05-21 07:36:37', '2024-05-21 07:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_users`
--

CREATE TABLE `attendance_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `card_no` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `br_name` varchar(500) DEFAULT NULL,
  `br_address` text DEFAULT NULL,
  `br_type` int(11) DEFAULT NULL COMMENT '1=Head Office, 2= Single branch',
  `br_status` int(11) NOT NULL DEFAULT 1 COMMENT '1= active, 2= inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `br_name`, `br_address`, `br_type`, `br_status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 1, '2024-05-19 06:41:27', '2024-05-19 06:41:27'),
(2, NULL, NULL, NULL, 1, '2024-05-19 06:44:11', '2024-05-19 06:44:11'),
(3, 'ghgggggg', NULL, 2, 1, '2024-05-19 06:45:59', '2024-05-19 06:45:59'),
(4, 'Mirpur Branch', 'mirpur 12, dhaka', 1, 1, '2024-05-19 08:08:04', '2024-05-19 08:08:04'),
(5, 'Laalbagh Branch', 'Laalbagh, Dhaka -1200', 2, 1, '2024-05-20 08:23:24', '2024-05-20 08:23:24'),
(6, 'Mirpur Branch', 'Mirpur 12', 2, 1, '2024-05-20 08:28:39', '2024-05-20 08:28:39'),
(7, 'Azimpur Branch', 'Azimpur, Dhaka', 1, 1, '2024-05-20 10:08:25', '2024-05-20 10:08:25'),
(8, 'Azimpur Branch', 'Azimpur, Dhaka', 1, 1, '2024-05-20 10:10:39', '2024-05-20 10:10:39'),
(9, 'Azimpur Branch', 'Azimpur, Dhaka', 1, 1, '2024-05-20 10:12:50', '2024-05-20 10:12:50'),
(10, NULL, NULL, 1, 1, '2024-05-20 12:46:44', '2024-05-20 12:46:44'),
(11, NULL, NULL, 1, 1, '2024-05-20 12:54:49', '2024-05-20 12:54:49'),
(12, 'Meherpur Branch', NULL, 2, 1, '2024-05-21 07:24:50', '2024-05-21 07:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `business_types`
--

CREATE TABLE `business_types` (
  `id` int(10) NOT NULL,
  `business_type` varchar(50) DEFAULT NULL,
  `business_status` int(10) DEFAULT 1 COMMENT '1=active, 2=deactive',
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
(25, 'Optician', 1, '2024-05-19 07:42:20', '2024-05-19 07:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(500) DEFAULT NULL,
  `company_email` varchar(500) DEFAULT NULL,
  `contact_no` varchar(500) DEFAULT NULL,
  `license_no` varchar(500) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `registration_no` varchar(500) DEFAULT NULL,
  `division` varchar(500) DEFAULT NULL,
  `district` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
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
(11, 'Samer Store', NULL, '01514120130', 'ggg8878797789', NULL, 'fhfjgh5435', '6', '47', 'Bangladesh', '2024-05-20 12:54:49', '2024-05-20 12:54:49'),
(12, 'Rahat store', 'rahatbusiness@gmail.com', '01514120130', 'kjjhgj7777', NULL, '978987u', '3', '22', 'Bangladesh', '2024-05-21 07:24:50', '2024-05-21 07:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `current_modules`
--

CREATE TABLE `current_modules` (
  `id` int(11) NOT NULL,
  `module_status` int(10) NOT NULL DEFAULT 1 COMMENT '1 = general dashboard, 2= employee, 3= inventory, 4= pos\r\n',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_modules`
--

INSERT INTO `current_modules` (`id`, `module_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-05-19 09:28:53', '2024-05-19 09:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, NULL, '2024-05-19 06:41:27', '2024-05-19 06:41:27'),
(2, NULL, '2024-05-19 06:44:11', '2024-05-19 06:44:11'),
(3, NULL, '2024-05-19 06:45:59', '2024-05-19 06:45:59'),
(4, 'Storage Department', '2024-05-19 08:08:04', '2024-05-19 08:08:04'),
(5, 'Cloth Department', '2024-05-20 08:23:24', '2024-05-20 08:23:24'),
(6, 'Storage Department', '2024-05-20 08:28:39', '2024-05-20 08:28:39'),
(7, 'Cloth Department', '2024-05-20 10:08:25', '2024-05-20 10:08:25'),
(8, 'Cloth Department', '2024-05-20 10:10:39', '2024-05-20 10:10:39'),
(9, 'Cloth Department', '2024-05-20 10:12:50', '2024-05-20 10:12:50'),
(10, NULL, '2024-05-20 12:46:44', '2024-05-20 12:46:44'),
(11, NULL, '2024-05-20 12:54:49', '2024-05-20 12:54:49'),
(12, NULL, '2024-05-21 07:24:50', '2024-05-21 07:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) NOT NULL,
  `designation_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, 'Store Manager', '2024-05-19 07:23:46', '2024-05-19 07:23:46'),
(2, 'Assistant Manager', '2024-05-19 07:23:46', '2024-05-19 07:23:46'),
(3, 'Cashier', '2024-05-19 07:24:07', '2024-05-19 07:24:07'),
(4, 'Sales Associate', '2024-05-19 07:24:07', '2024-05-19 07:24:07'),
(5, 'Inventory Manager', '2024-05-19 07:24:33', '2024-05-19 07:24:33'),
(6, 'Customer Service Representative', '2024-05-19 07:24:33', '2024-05-19 07:24:33'),
(7, 'Merchandiser', '2024-05-19 07:24:59', '2024-05-19 07:24:59'),
(8, 'Marketing Manager', '2024-05-19 07:24:59', '2024-05-19 07:24:59'),
(9, 'IT Support Specialist', '2024-05-19 07:25:11', '2024-05-19 07:25:11');

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
  `id` int(11) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `designation_id` int(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
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

INSERT INTO `employees` (`id`, `user_id`, `designation_id`, `joining_date`, `father_name`, `mother_name`, `mobile_number`, `nid_number`, `present_address`, `permanent_address`, `birth_date`, `blood_group`, `nationality`, `marital_status`, `religion`, `gender`, `profile_pic`, `emergency_contact_name`, `emergency_contact_number`, `emergency_contact_relation`, `flag`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2024-05-02', 'Hamid Ahmed papa', 'Hasina Begum', '01513470121', '7647643756', '<p>Meherpur<br></p>', '<p>Puran Dhaka<br></p>', '1994-06-15', 'AB+', 'Bangladeshi', 'Single', 'Islam', 'Male', NULL, 'Hamid Ahmed', '01513470138', 'Father', 1, '2024-05-21 07:24:50', '2024-05-21 07:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `employee_performances`
--

CREATE TABLE `employee_performances` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `total_working_hours` varchar(500) DEFAULT NULL,
  `total_overtime_hours` varchar(500) DEFAULT NULL,
  `performance_bonus` varchar(500) DEFAULT NULL,
  `total_attendance` varchar(500) DEFAULT NULL,
  `smartness_point` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `application_type` text DEFAULT NULL,
  `application_msg` text DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `application_status` int(11) DEFAULT NULL,
  `application_approved_user_id` int(11) DEFAULT NULL,
  `application_approved_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `payroll_reports`
--

CREATE TABLE `payroll_reports` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `salary_rate` varchar(500) DEFAULT NULL,
  `total_working_hours` varchar(500) DEFAULT NULL,
  `total_overtime_hours` varchar(500) DEFAULT NULL,
  `bonus` varchar(500) DEFAULT NULL,
  `total_pay` varchar(500) DEFAULT NULL,
  `deductions` varchar(500) DEFAULT NULL,
  `salary_date` varchar(500) DEFAULT NULL,
  `bank_name` varchar(500) DEFAULT NULL,
  `branch_name` varchar(500) DEFAULT NULL,
  `routing_number` varchar(500) DEFAULT NULL,
  `bank_acc_no` varchar(500) DEFAULT NULL,
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
(163, 'App\\Models\\User', 1, 'myToken', '2e0e14cd869149865706307fbbcf4c560c7222aeb1c60b21a86678deeda3de05', '[\"*\"]', '2024-05-21 07:36:37', NULL, '2024-05-21 07:36:22', '2024-05-21 07:36:37');

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
  `id` int(11) NOT NULL,
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
  `department_id` int(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active_status` int(10) NOT NULL DEFAULT 1 COMMENT '1=active, 2=inactive',
  `designation` text DEFAULT NULL,
  `company_business_type` int(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `company_id`, `branch_id`, `department_id`, `joining_date`, `email_verified_at`, `password`, `active_status`, `designation`, `company_business_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'samer', 'sam@gmail.com', 2, 11, 11, 11, '2024-05-06', NULL, '$2y$10$nlqFwO/VZKrydr2.gUHnp.6i383bobONro6ABEUwDGINjHJsoIukG', 1, '1', 1, NULL, '2024-05-20 06:54:49', '2024-05-20 06:54:49'),
(2, 'rahat ahmed', 'rahat@gmail.com', 3, 12, 12, 12, '2024-05-02', NULL, '$2y$10$bRFLISLP82.g4V4rR4UvI.Z7QJycvcSLl9dlYJAajc/iITMzHVNp.', 1, '2', 1, NULL, '2024-05-21 07:24:50', '2024-05-21 07:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(500) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `father_name` varchar(500) DEFAULT NULL,
  `mother_name` varchar(500) DEFAULT NULL,
  `mobile_number` varchar(500) DEFAULT NULL,
  `nid_number` varchar(500) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `blood_group` varchar(500) DEFAULT NULL,
  `nationality` varchar(500) DEFAULT NULL,
  `marital_status` varchar(500) DEFAULT NULL,
  `religion` varchar(500) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(500) DEFAULT NULL,
  `emergency_contact_name` varchar(500) DEFAULT NULL,
  `emergency_contact_number` varchar(500) DEFAULT NULL,
  `emergency_contact_relation` varchar(500) DEFAULT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attendance_users`
--
ALTER TABLE `attendance_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `business_types`
--
ALTER TABLE `business_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `current_modules`
--
ALTER TABLE `current_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_performances`
--
ALTER TABLE `employee_performances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payroll_reports`
--
ALTER TABLE `payroll_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;