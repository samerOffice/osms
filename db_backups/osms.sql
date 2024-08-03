-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 04:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osms`
--

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
(1, 'App\\Models\\User', 1, 'myToken', '3ad100a8bf42f44c988e4be5fc38aabf0d1d4e0c2bc8f88a8a1a08fbde23ba2f', '[\"*\"]', NULL, NULL, '2024-05-01 04:09:44', '2024-05-01 04:09:44'),
(2, 'App\\Models\\User', 3, 'myToken', 'a2f0c6751bbf48ea7e3e56ba8997c4ec7a282501cc4e4c2d32441e03b4f42eee', '[\"*\"]', NULL, NULL, '2024-05-01 04:23:22', '2024-05-01 04:23:22'),
(3, 'App\\Models\\User', 3, 'myToken', '254ac2788afecfc67fb7b80368a02717892e819ac9200a7214d05ba38db7cc9f', '[\"*\"]', '2024-05-01 04:43:20', NULL, '2024-05-01 04:39:03', '2024-05-01 04:43:20'),
(4, 'App\\Models\\User', 3, 'myToken', '5013f1be9be4d5c059a8f192f9dcce4e5c00c05c2d954c5d573df7e375a1d678', '[\"*\"]', NULL, NULL, '2024-05-01 06:07:26', '2024-05-01 06:07:26'),
(5, 'App\\Models\\User', 3, 'myToken', 'f6614cd7cba16a4a5a8bbdaaf7e138b32c4e71e9c1eb323665ea2f83179a5c65', '[\"*\"]', NULL, NULL, '2024-05-01 06:08:12', '2024-05-01 06:08:12'),
(6, 'App\\Models\\User', 3, 'myToken', '4ac82b2a1f240325baebcda6847eeecf1602b3a04567fce12c15887bcff23822', '[\"*\"]', NULL, NULL, '2024-05-01 06:53:15', '2024-05-01 06:53:15'),
(7, 'App\\Models\\User', 3, 'myToken', 'e13f3c1315062d4e5cf27e2e68f7b90524cff1d2127b238e426ad11eccba4fd2', '[\"*\"]', NULL, NULL, '2024-05-01 07:24:58', '2024-05-01 07:24:58'),
(8, 'App\\Models\\User', 3, 'myToken', 'f8d92b77f573f36affd4c44a2d51ba2191c1ca6f1ce64ad2d033a2e99b98384e', '[\"*\"]', NULL, NULL, '2024-05-01 07:27:14', '2024-05-01 07:27:14'),
(9, 'App\\Models\\User', 3, 'myToken', '8e0017d3b2b1981314e3c2b5ae50f85a3650cdd3d0cc806ae32b87c34f6862d2', '[\"*\"]', NULL, NULL, '2024-05-01 07:36:55', '2024-05-01 07:36:55'),
(10, 'App\\Models\\User', 3, 'myToken', '1855352c885e012f09a9b70900cd774a0add716a5e6644925b913b107e50ef69', '[\"*\"]', NULL, NULL, '2024-05-01 07:48:40', '2024-05-01 07:48:40'),
(11, 'App\\Models\\User', 3, 'myToken', '118b6161429d7a82ca5511109056437b85c63765b43bee336eaf36e2ebdd1a35', '[\"*\"]', NULL, NULL, '2024-05-01 07:48:56', '2024-05-01 07:48:56'),
(12, 'App\\Models\\User', 3, 'myToken', '37f7b1c9dc985c9021cfc87bf8b7294c17664c26c710d023c2b71dc180492aac', '[\"*\"]', NULL, NULL, '2024-05-01 07:52:48', '2024-05-01 07:52:48'),
(13, 'App\\Models\\User', 3, 'myToken', '3d41e658f898278303b52ce904be918ee813e96d95382b2efb793799e90564f7', '[\"*\"]', NULL, NULL, '2024-05-01 07:53:14', '2024-05-01 07:53:14'),
(14, 'App\\Models\\User', 3, 'myToken', 'd21e1a607e1b775d3b4318ab5a33bb4b775149d2600f68fb6d99942c950ba37b', '[\"*\"]', NULL, NULL, '2024-05-01 07:53:54', '2024-05-01 07:53:54'),
(15, 'App\\Models\\User', 3, 'myToken', '49914c6eb0778bab9efc8f71eec7a1b1f90ce735ccc6b686e185d5c434153746', '[\"*\"]', NULL, NULL, '2024-05-01 07:55:15', '2024-05-01 07:55:15'),
(16, 'App\\Models\\User', 3, 'myToken', 'f79f9d32e798a11e84a35c32aae2de5328784e0438da10b7a3a17f00edfb0053', '[\"*\"]', NULL, NULL, '2024-05-01 07:57:50', '2024-05-01 07:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'samer', 'sam@gmail.com', NULL, '$2y$10$Q/7NYoa9ThlmRx6SUNn6zOYSAXp4KAHfJFelXPUdIBURB2GnKpuRC', NULL, '2024-05-01 04:23:22', '2024-05-01 04:23:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
