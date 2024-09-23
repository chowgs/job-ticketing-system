-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 10:44 AM
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
-- Database: `jrs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('a@administrator.com|127.0.0.1', 'i:2;', 1714753760),
('a@administrator.com|127.0.0.1:timer', 'i:1714753760;', 1714753760),
('admin@gmail.com|127.0.0.1', 'i:1;', 1712988443),
('admin@gmail.com|127.0.0.1:timer', 'i:1712988443;', 1712988443),
('gene@admin.com|127.0.0.1', 'i:2;', 1715156198),
('gene@admin.com|127.0.0.1:timer', 'i:1715156198;', 1715156198),
('khentr@sample.com|127.0.0.1', 'i:1;', 1714757694),
('khentr@sample.com|127.0.0.1:timer', 'i:1714757694;', 1714757694),
('mico@user.com|127.0.0.1', 'i:1;', 1714830441),
('mico@user.com|127.0.0.1:timer', 'i:1714830441;', 1714830441),
('no@administrator.com|127.0.0.1', 'i:1;', 1714841075),
('no@administrator.com|127.0.0.1:timer', 'i:1714841075;', 1714841075),
('xander@admin.com|127.0.0.1', 'i:1;', 1714468011),
('xander@admin.com|127.0.0.1:timer', 'i:1714468011;', 1714468011);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept_acronym` varchar(255) NOT NULL,
  `dept_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_acronym`, `dept_name`, `created_at`, `updated_at`) VALUES
(2, 'PGO', 'Provincial Government Office', '2024-05-05 22:43:35', '2024-05-05 22:43:35'),
(3, 'DOH', 'Department of Health', '2024-05-05 22:50:13', '2024-05-05 22:50:13'),
(4, 'PTO', 'Provincial Treasurer’s Office', '2024-05-06 21:52:54', '2024-05-06 21:52:54'),
(5, 'PAO', 'Provincial Attorney’s Office', '2024-05-06 21:53:04', '2024-05-06 21:53:04'),
(6, 'PVO', 'Provincial Veterinarian Office', '2024-05-06 21:53:15', '2024-05-06 21:53:15'),
(7, 'BOI', 'Bureau of Immigration', '2024-05-06 21:53:57', '2024-05-06 21:53:57'),
(8, 'PNRC', 'Philippine National Red Cross', '2024-05-06 21:54:50', '2024-05-06 21:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `job_info`
--

CREATE TABLE `job_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `problem_statement` varchar(255) DEFAULT NULL,
  `no_units` int(11) DEFAULT NULL,
  `requests` tinytext DEFAULT NULL COMMENT 'the values are dependent on the office',
  `attending_personnel` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `date_returned` datetime DEFAULT NULL,
  `datetime_started` datetime DEFAULT NULL,
  `datetime_accomplished` datetime DEFAULT NULL,
  `transaction_code` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_info`
--

INSERT INTO `job_info` (`id`, `name`, `email`, `number`, `department`, `problem_statement`, `no_units`, `requests`, `attending_personnel`, `remarks`, `created_at`, `updated_at`, `date_received`, `date_returned`, `datetime_started`, `datetime_accomplished`, `transaction_code`, `status`, `reason`) VALUES
(1, 'Akashi Vielle Shintaro', 'aka@client.com', '09194567823', 'PTO', 'aka1 creative', 2, '1', 'DALE', 'sample layout design remark', '2024-05-10 21:58:41', '2024-05-12 00:05:09', NULL, NULL, '2024-05-12 16:04:00', '2024-05-12 17:05:00', '202405-0', 'Released', NULL),
(2, 'Akashi Vielle Shintaro', 'aka@client.com', '09194567823', 'PTO', 'aka1 it sample', 1, NULL, NULL, NULL, '2024-05-10 21:58:55', '2024-05-10 21:58:55', NULL, NULL, NULL, NULL, '202405-1', NULL, NULL),
(3, 'Akashi Vielle Shintaro', 'aka@client.com', '09194567823', 'PTO', 'aka1 sys sample', 1, '3', NULL, '', '2024-05-10 21:59:03', '2024-05-11 01:08:09', NULL, NULL, NULL, NULL, '202405-2', '', NULL),
(4, 'COLLARD', 'collard@client.com', '09192345678', 'PNRC', 'not booting pcs', 5, '2', NULL, NULL, '2024-05-10 21:59:38', '2024-05-10 22:03:13', NULL, NULL, NULL, NULL, '202405-3', NULL, NULL),
(5, 'COLLARD', 'collard@client.com', '09192345678', 'PNRC', 't shirt design', 50, '1', 'DALE', NULL, '2024-05-10 21:59:54', '2024-05-12 00:05:33', NULL, NULL, NULL, NULL, '202405-4', 'Pending', NULL),
(6, 'COLLARD', 'collard@client.com', '09192345678', 'PNRC', 'website design', 1, NULL, NULL, NULL, '2024-05-10 22:00:16', '2024-05-10 22:00:16', NULL, NULL, NULL, NULL, '202405-5', NULL, NULL),
(7, 'DALE', 'dale@admin.com', '09199646072', 'CCMS', 'requesting new website ideas for job order', 1, NULL, '', NULL, '2024-05-11 01:11:27', '2024-05-11 22:49:14', NULL, NULL, NULL, NULL, '202405-6', NULL, NULL),
(8, 'Akashi Vielle Shintaro', 'aka@client.com', '09194567823', 'PTO', 'test1creative', 1, '5', 'DALE', 'CANT DO IT', '2024-05-12 00:11:22', '2024-05-12 00:13:01', NULL, NULL, '2024-05-12 16:12:00', '2024-05-12 16:35:00', '202405-7', 'Voided', 'di n a daw kaya'),
(9, 'Akashi Vielle Shintaro', 'aka@client.com', '09194567823', 'PTO', 'test2creative', 1, NULL, 'DALE', NULL, '2024-05-12 00:11:26', '2024-05-12 00:12:11', NULL, NULL, NULL, NULL, '202405-8', 'Pending', NULL);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_27_130728_add_fields_to_users_table', 2),
(9, '2024_04_04_104024_create_it_repair_maintenance_table', 3),
(14, '2024_04_06_104851_add_fields_to_it_repair_maintenance_table', 4),
(15, '2024_04_13_025301_add_column_to_users_table', 5),
(17, '2024_04_13_034428_add_column_to_users_table', 6),
(19, '2024_04_29_124408_add_field_to_it_repair_maintenance', 7),
(22, '2024_04_30_132046_add_field_to_job_info', 8),
(23, '2024_05_01_100305_create_departments', 9),
(24, '2024_05_02_051822_add_status_and_reason_to_job_infos_table', 10),
(26, '2024_05_03_062513_add_id_number_to_users', 11),
(27, '2024_05_03_142854_add_office_to_users_table', 12),
(28, '2024_05_03_150851_add_dept_name_to_departments_table', 13),
(29, '2024_05_03_155610_add_reason_to_void_list_table', 14),
(30, '2024_05_03_164525_add_remarks_to_administrator_job_list_table', 15),
(31, '2024_05_10_074805_add_no_units_to_job_info_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('cwgakv@gmail.com', '$2y$12$rpTOuIggJFdqPTw2DFbMUuiwPC6ojPrdGj7lkHygI/OUUTPYLUAJO', '2024-03-26 22:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DVdBimoOoqB16VEysPsz0rJExzlNiOXgJD3vBE50', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRDQ2ZTJONU9xMU41T09taTRORmozellaemhOSE1uRHA1YlNibDlINSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qb2ItaW5mby1yZXF1ZXN0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1715502775),
('RV6Yh8RLbmOTUX1MXgtnV8xjfCUoohlDDT1e6Tys', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkFTVjRhUlJVWjY5dzdjZFl6VHZUSHFaU0x4bU5id3RXejlWcm04SiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1715503385);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `office` tinyint(1) DEFAULT NULL COMMENT '1 = creative, 2 = it, 3 = system dev',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `office`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `contact_number`, `department`) VALUES
(1, 'Akashi Vielle Shintaro', 'aka@client.com', 'client', NULL, NULL, '$2y$12$bNjzl2urvcQjKIHls3QJyuFqErZ20a7G6Q/6Vuv5PqUV5NX1Gdroq', NULL, '2024-05-04 08:41:12', '2024-05-05 09:16:27', '09194567823', 'PTO'),
(2, 'KHENT', 'khent@administrator.com', 'administrator', NULL, NULL, '$2y$12$clULLs2f7E/befr3BAai5.4HjQ92OjACLeHIZe9qUGHzC3DTSsXi.', NULL, '2024-05-04 08:42:06', '2024-05-04 08:42:06', '09949493482', 'CCMS'),
(3, 'HENRY', 'henry@admin.com', 'admin', 2, NULL, '$2y$12$NTCr.3ePS.doyP7UFdXjU.pCY9cirE7MkNcx7H8ftY3nrRtLzFw1i', NULL, '2024-05-04 08:42:49', '2024-05-04 08:42:49', '09192345679', 'CCMS'),
(4, 'MICO', 'mico@monitor.com', 'monitor', NULL, NULL, '$2y$12$T7ZEf98FrBoP61yjfwZM4eseLbsgjLL4V1Bon6/9zFq3f.EzYD/mi', NULL, '2024-05-04 08:43:21', '2024-05-04 08:43:48', '09192345678', 'CCMS'),
(5, 'DALE', 'dale@admin.com', 'admin', 1, NULL, '$2y$12$s7xQDZ7ZJvQ0qqfR.OroN.EcSs7SK9sJvkdv5HIMq2cwdRIwXZZR2', NULL, '2024-05-04 08:47:13', '2024-05-04 08:47:39', '09199646072', 'CCMS'),
(6, 'MAC', 'mac@admin.com', 'admin', 3, NULL, '$2y$12$I.PbWy12sW.82B7/BT6L8esNN4aHupj3c08ifmbncKRY40yJ3CrsS', NULL, '2024-05-04 08:48:07', '2024-05-04 08:48:13', '09486752673', 'CCMS'),
(7, 'GENE', 'gene@client.com', 'admin', 1, NULL, '$2y$12$4Ke8snwBDdey9qFddxLkd..d8vB5DhV81CIt/o75uRH1nL8BXZfOu', NULL, '2024-05-06 03:07:16', '2024-05-06 03:07:16', '09192345679', 'DOH'),
(8, 'EDMAR', 'edmar@admin.com', 'admin', 2, NULL, '$2y$12$.7gMR9BFUcg0exTXgSnui.OFuLDz/bb0MwxoI8NVJDKGD2t2tInHK', NULL, '2024-05-06 18:44:25', '2024-05-06 18:44:25', '09949493482', 'PGO'),
(9, 'NOEL', 'no@admin.com', 'admin', 2, NULL, '$2y$12$5vnwgO90iKrLkmKPazlqc.eq9bNbrTiqeUQ5q8HrcMU6Ge/JpRcla', NULL, '2024-05-06 18:46:53', '2024-05-06 18:46:53', '09949493482', 'CCMS'),
(10, 'GREGG', 'gregg@admin.com', 'admin', 3, NULL, '$2y$12$GTgnNzvt7R2S3qJJiI1FZeWtQHPKTxm/gwchkecm8OaHEklmVAzUa', NULL, '2024-05-06 18:47:16', '2024-05-06 18:47:16', '09192345678', 'DOH'),
(11, 'COLLARD', 'collard@client.com', 'client', NULL, NULL, '$2y$12$Lc3O.D4Xlk28O7ANwUSFXOHN4nGDjNYuJSV4UZBQiTsJZGdkK8uo.', NULL, '2024-05-06 21:56:47', '2024-05-06 21:56:47', '09192345678', 'PNRC'),
(12, 'JOHN', 'john@client.com', 'client', NULL, NULL, '$2y$12$4fOAz05NqjtshqCm6FPW9uRD7F0kpNNcAbfk3gBIFK8MZ6GQkenlK', NULL, '2024-05-06 21:57:20', '2024-05-06 21:57:20', '09949493482', 'PVO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_info`
--
ALTER TABLE `job_info`
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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job_info`
--
ALTER TABLE `job_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
