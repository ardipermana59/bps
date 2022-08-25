-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 07:35 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bps`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Print Document', '2022-08-22 01:03:06', '2022-08-22 01:03:06'),
(2, 'Fotokopi Document', '2022-08-22 01:03:06', '2022-08-22 01:03:06'),
(3, 'Jilid Document', '2022-08-22 01:03:06', '2022-08-22 01:03:06'),
(4, 'Input Data Penduduk', '2022-08-22 01:03:06', '2022-08-22 01:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `ambil_kegiatans`
--

CREATE TABLE `ambil_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `nama_penilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realisasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `mulai_kegiatan` date DEFAULT NULL,
  `selesai_kegiatan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambil_kegiatans`
--

INSERT INTO `ambil_kegiatans` (`id`, `employee_id`, `activity_id`, `nama_penilai`, `target`, `realisasi`, `mulai_kegiatan`, `selesai_kegiatan`, `created_at`, `updated_at`, `url_file`) VALUES
(23, 9, 3, 'penilai 1', '1', '2', '2022-08-26', '2022-08-13', '2022-08-24 16:48:40', '2022-08-24 16:48:40', NULL),
(24, 9, 4, 'penilai 3', '2', '2', '2022-08-24', '2022-08-24', '2022-08-24 16:48:54', '2022-08-24 16:48:54', NULL),
(25, 5, 2, 'penilai 2', '2', '2', '2022-08-31', '2022-08-24', '2022-08-24 16:51:07', '2022-08-24 16:51:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `nip` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `position_id`, `nip`, `full_name`, `gender`, `hp`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '100000001', 'admin', NULL, NULL, NULL, '2022-08-22 01:03:11', '2022-08-22 01:03:11'),
(2, 2, 3, '100000002', 'penilai 1', NULL, NULL, NULL, '2022-08-22 01:03:11', '2022-08-22 01:03:11'),
(3, 3, 3, '100000003', 'penilai 2', NULL, NULL, NULL, '2022-08-22 01:03:12', '2022-08-22 01:03:12'),
(4, 4, 1, '100000004', 'penilai 3', NULL, NULL, NULL, '2022-08-22 01:03:12', '2022-08-22 01:03:12'),
(5, 5, 4, '100000005', 'Saka Mansur', NULL, NULL, NULL, '2022-08-22 01:03:12', '2022-08-22 01:03:12'),
(6, 6, 4, '100000006', 'Wulan Lestari', NULL, NULL, NULL, '2022-08-22 01:03:12', '2022-08-22 01:03:12'),
(7, 7, 4, '100000007', 'Muhammad Carub Latupono M.TI.', NULL, NULL, NULL, '2022-08-22 01:03:13', '2022-08-22 01:03:13'),
(8, 8, 4, '100000008', 'Latika Rina Widiastuti', NULL, NULL, NULL, '2022-08-22 01:03:13', '2022-08-22 01:03:13'),
(9, 9, 4, '100000009', 'Jais Utama', NULL, NULL, NULL, '2022-08-22 01:03:14', '2022-08-22 01:03:14'),
(10, 10, 4, '100000010', 'Sari Sadina Nasyiah', NULL, NULL, NULL, '2022-08-22 01:03:14', '2022-08-22 01:03:14'),
(11, 11, 4, '100000011', 'Ganjaran Mansur', NULL, NULL, NULL, '2022-08-22 01:03:14', '2022-08-22 01:03:14'),
(12, 12, 4, '100000012', 'Wardaya Gunawan', NULL, NULL, NULL, '2022-08-22 01:03:15', '2022-08-22 01:03:15'),
(13, 13, 4, '100000013', 'Elma Elvina Permata S.Sos', NULL, NULL, NULL, '2022-08-22 01:03:16', '2022-08-22 01:03:16'),
(14, 14, 4, '100000014', 'Maya Aryani', NULL, NULL, NULL, '2022-08-22 01:03:17', '2022-08-22 01:03:17'),
(15, 15, 4, '100000015', 'Tina Puspasari', NULL, NULL, NULL, '2022-08-22 01:03:18', '2022-08-22 01:03:18'),
(16, 16, 4, '100000016', 'Uchita Tami Yulianti S.E.I', NULL, NULL, NULL, '2022-08-22 01:03:19', '2022-08-22 01:03:19'),
(17, 17, 4, '100000017', 'Raditya Waluyo', NULL, NULL, NULL, '2022-08-22 01:03:20', '2022-08-22 01:03:20'),
(18, 18, 4, '100000018', 'Cemani Najmudin', NULL, NULL, NULL, '2022-08-22 01:03:20', '2022-08-22 01:03:20'),
(19, 19, 4, '100000019', 'Diah Rahmawati', NULL, NULL, NULL, '2022-08-22 01:03:20', '2022-08-22 01:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `evaluators`
--

CREATE TABLE `evaluators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluators`
--

INSERT INTO `evaluators` (`id`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-08-22 01:03:22', '2022-08-22 01:03:22'),
(2, 3, '2022-08-22 01:03:23', '2022-08-22 01:03:23'),
(3, 4, '2022-08-22 01:03:23', '2022-08-22 01:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_07_29_065022_create_positions_table', 1),
(5, '2022_07_29_065023_create_employees_table', 1),
(6, '2022_07_29_065105_create_activities_table', 1),
(7, '2022_07_30_112247_create_ambil_kegiatans_table', 1),
(8, '2022_07_30_113310_create_evaluators_table', 1),
(9, '2022_07_30_113339_create_penilai_pegawais_table', 1),
(10, '2022_08_07_122248_create_nilais_table', 1),
(11, '2022_08_15_084244_add_file_url_to_ambil_kegiatans_table', 1),
(12, '2022_08_21_151405_add_column_to_ambil_kegiatans_table', 1),
(13, '2022_08_24_115624_add_activity_id', 2),
(14, '2022_08_24_210617_add_evaluator_id_to_table_ambil_kegiatans', 3),
(15, '2022_08_24_211728_add_nama_penilai_to_table_ambil_kegiatans', 4);

-- --------------------------------------------------------

--
-- Table structure for table `nilais`
--

CREATE TABLE `nilais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ambil_kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `target_realisasi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `kerjasama` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ketepatan_waktu` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `kualitas` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilai_pegawais`
--

CREATE TABLE `penilai_pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `evaluator_id` bigint(20) UNSIGNED NOT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilai_pegawais`
--

INSERT INTO `penilai_pegawais` (`id`, `employee_id`, `evaluator_id`, `activity_id`, `created_at`, `updated_at`) VALUES
(17, 9, 1, 3, '2022-08-23 17:00:00', '2022-08-23 17:00:00'),
(20, 9, 3, 4, '2022-08-24 15:04:42', '2022-08-24 15:04:42'),
(21, 5, 2, 2, '2022-08-24 16:50:35', '2022-08-24 16:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ketua BPS', '2022-08-22 01:03:05', '2022-08-22 01:03:05'),
(2, 'Wakil Ketua BPS', '2022-08-22 01:03:05', '2022-08-22 01:03:05'),
(3, 'Kabid', '2022-08-22 01:03:05', '2022-08-22 01:03:05'),
(4, 'Staff Pegawai', '2022-08-22 01:03:05', '2022-08-22 01:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` enum('admin','staff','pegawai','penilai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `status`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'active', 'admin', NULL, '$2y$10$iUJf76fCKXy4lMdM.JXyW.c1izXm3AN2ztdKc4xNfHg7tm2SygK42', NULL, '2022-08-22 01:03:11', '2022-08-22 01:03:11'),
(2, 'penilai 1', 'penilai1', 'penilai1@gmail.com', 'active', 'penilai', NULL, '$2y$10$kT3NA4B5kMqOpT0m3EsBhO7ZMvtcZ9IZkTXfrfd3ZxBpyUCPWD2AK', NULL, '2022-08-22 01:03:11', '2022-08-22 01:03:11'),
(3, 'penilai 2', 'penilai2', 'penilai2@gmail.com', 'active', 'penilai', NULL, '$2y$10$yOnLXrvzQHwGWk72fDsBLuEW3uelhbzGEe26rFLjdQx/LHCFrParG', NULL, '2022-08-22 01:03:11', '2022-08-22 01:03:11'),
(4, 'penilai 3', 'penilai3', 'penilai3@gmail.com', 'active', 'penilai', NULL, '$2y$10$ZcgdzDPMtkjPw9M2d60nXuqtftLIgecuZQm/SLLTFiX3ShS9hypg6', NULL, '2022-08-22 01:03:12', '2022-08-22 01:03:12'),
(5, 'Saka Mansur', 'onovitasari', 'anita39@jailani.tv', 'active', 'pegawai', NULL, '$2y$10$GetH9VFYUe9EV2Yv7j/UTe/NM/92NSArJYS19JNQEchf6e4x8Q.bC', NULL, '2022-08-22 01:03:12', '2022-08-22 01:03:12'),
(6, 'Wulan Lestari', 'yhastuti', 'wrahmawati@yahoo.co.id', 'active', 'pegawai', NULL, '$2y$10$XbZxV2/tFhkzPrEbX89OHeBe5F65mvDMm07HUZHjaMYepYnLazULq', NULL, '2022-08-22 01:03:12', '2022-08-22 01:03:12'),
(7, 'Muhammad Carub Latupono M.TI.', 'ihandayani', 'ssihotang@gmail.com', 'active', 'pegawai', NULL, '$2y$10$lPzDz9GHMbpSJk.3XPLqaeK8tF3SlR7ejLAJXyWTdzho7cdg3JQ8S', NULL, '2022-08-22 01:03:13', '2022-08-22 01:03:13'),
(8, 'Latika Rina Widiastuti', 'pratama.mursita', 'maryadi.maryati@wijayanti.tv', 'active', 'pegawai', NULL, '$2y$10$ORlhMpV9/eQeCO7APWOBA.Ch/oQiRxHOxPmIAQdm/op9t/qGiH/2W', NULL, '2022-08-22 01:03:13', '2022-08-22 01:03:13'),
(9, 'Jais Utama', 'cinta84', 'mursita34@gmail.com', 'active', 'pegawai', NULL, '$2y$10$pn0tEaIubqUUpZEeQaKDCe0XVsSKZXyuc3P8VGc6yLBUEikTORBpa', NULL, '2022-08-22 01:03:14', '2022-08-22 01:03:14'),
(10, 'Sari Sadina Nasyiah', 'laksana49', 'mangunsong.carub@gmail.co.id', 'active', 'pegawai', NULL, '$2y$10$yZvIhcETnjZMeNJRwrk0pu6uGeW54dwEorikVmEHglZroyHjBGRtK', NULL, '2022-08-22 01:03:14', '2022-08-22 01:03:14'),
(11, 'Ganjaran Mansur', 'hhidayanto', 'jasmin.natsir@gmail.co.id', 'active', 'pegawai', NULL, '$2y$10$zjfeMAf3Uqyvux2dKFMIR.ttubcfdKFExhSpQmH46mZMGj2WPLx/e', NULL, '2022-08-22 01:03:14', '2022-08-22 01:03:14'),
(12, 'Wardaya Gunawan', 'kiandra.siregar', 'ziswahyudi@gmail.com', 'active', 'pegawai', NULL, '$2y$10$lfShbnACN1VX00uYFx4bGeSuufCkB5DWxtedE2PDl6mhVv6jQlYHy', NULL, '2022-08-22 01:03:15', '2022-08-22 01:03:15'),
(13, 'Elma Elvina Permata S.Sos', 'elisa93', 'jrahimah@iswahyudi.asia', 'active', 'pegawai', NULL, '$2y$10$UZLxEq41zJQGcEdE6b/w9eW7N2wyrCxdURzM8IBPEXjfOCfA/Ktg6', NULL, '2022-08-22 01:03:15', '2022-08-22 01:03:15'),
(14, 'Maya Aryani', 'hadi.lailasari', 'rajasa.ika@yahoo.com', 'active', 'pegawai', NULL, '$2y$10$5dsCBIj4M.1lZEKjKN2ZT.HuMd5OfrUQY8.r4APaXuxTBPdOFMt36', NULL, '2022-08-22 01:03:17', '2022-08-22 01:03:17'),
(15, 'Tina Puspasari', 'genta.prasetya', 'atma.ardianto@yahoo.co.id', 'active', 'pegawai', NULL, '$2y$10$KcWxW6QcXMlBVSb/W24aneWSxzioxnkdAt6dF/GEI6IPwvGFwVtJG', NULL, '2022-08-22 01:03:17', '2022-08-22 01:03:17'),
(16, 'Uchita Tami Yulianti S.E.I', 'laras72', 'prayoga.daruna@yahoo.com', 'active', 'pegawai', NULL, '$2y$10$rOruc6zLBNl2Bj7XQXk4HOScYx0vN.lWgQkjoaed9sF.qdMP9vxHu', NULL, '2022-08-22 01:03:18', '2022-08-22 01:03:18'),
(17, 'Raditya Waluyo', 'galuh.kurniawan', 'balijan31@rahayu.go.id', 'active', 'pegawai', NULL, '$2y$10$71Bdhk5VTi.KCYsrx51pcuXUNwP539Kr5Hf6kdvWJYfZssgUN2duG', NULL, '2022-08-22 01:03:19', '2022-08-22 01:03:19'),
(18, 'Cemani Najmudin', 'hutapea.rafi', 'lnuraini@gmail.co.id', 'active', 'pegawai', NULL, '$2y$10$HdxZ6kgJTPKbkGRETpyxVOX/Amn3vbeb14cqLxR/JBBEfUGO.yyVe', NULL, '2022-08-22 01:03:20', '2022-08-22 01:03:20'),
(19, 'Diah Rahmawati', 'tiara63', 'sakura04@gmail.co.id', 'active', 'pegawai', NULL, '$2y$10$OvBY8/WXS5vZaaxgBtnt0O3vTkyzfSsQpCNXGtUPIyNblYfRBN5WS', NULL, '2022-08-22 01:03:20', '2022-08-22 01:03:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ambil_kegiatans`
--
ALTER TABLE `ambil_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ambil_kegiatans_employee_id_foreign` (`employee_id`),
  ADD KEY `ambil_kegiatans_activity_id_foreign` (`activity_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_nip_unique` (`nip`),
  ADD KEY `employees_user_id_foreign` (`user_id`),
  ADD KEY `employees_position_id_foreign` (`position_id`);

--
-- Indexes for table `evaluators`
--
ALTER TABLE `evaluators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluators_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilais_ambil_kegiatan_id_foreign` (`ambil_kegiatan_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penilai_pegawais`
--
ALTER TABLE `penilai_pegawais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilai_pegawais_employee_id_foreign` (`employee_id`),
  ADD KEY `penilai_pegawais_evaluator_id_foreign` (`evaluator_id`),
  ADD KEY `penilai_pegawais_activity_id_foreign` (`activity_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ambil_kegiatans`
--
ALTER TABLE `ambil_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `evaluators`
--
ALTER TABLE `evaluators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penilai_pegawais`
--
ALTER TABLE `penilai_pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ambil_kegiatans`
--
ALTER TABLE `ambil_kegiatans`
  ADD CONSTRAINT `ambil_kegiatans_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ambil_kegiatans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluators`
--
ALTER TABLE `evaluators`
  ADD CONSTRAINT `evaluators_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilais`
--
ALTER TABLE `nilais`
  ADD CONSTRAINT `nilais_ambil_kegiatan_id_foreign` FOREIGN KEY (`ambil_kegiatan_id`) REFERENCES `ambil_kegiatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilai_pegawais`
--
ALTER TABLE `penilai_pegawais`
  ADD CONSTRAINT `penilai_pegawais_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilai_pegawais_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilai_pegawais_evaluator_id_foreign` FOREIGN KEY (`evaluator_id`) REFERENCES `evaluators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
