-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2021 at 08:18 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bendahara_kp`
--

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
-- Table structure for table `honors`
--

CREATE TABLE `honors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int(11) DEFAULT NULL,
  `biayakhusus` int(11) DEFAULT NULL,
  `hdr` int(11) DEFAULT NULL,
  `jumlahbimb` int(11) DEFAULT NULL,
  `hrbimb` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `honorpraktikum` int(11) NOT NULL,
  `pjk_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenistransaksis`
--

CREATE TABLE `jenistransaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenistransaksis`
--

INSERT INTO `jenistransaksis` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'kredit', '2021-06-25 23:17:30', '2021-06-25 23:17:30'),
(2, 'debit', '2021-06-25 23:17:30', '2021-06-25 23:17:30');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_02_20_130807_create_transaksikoordinators_table', 1),
(4, '2021_05_31_161641_create_roles_table', 1),
(5, '2021_05_31_161937_create_users_table', 1),
(6, '2021_05_31_172155_create_jenistransaksis_table', 1),
(7, '2021_06_01_125842_create_transaksibendaharas_table', 1),
(8, '2021_06_02_134523_create_pjks_table', 1),
(9, '2021_06_05_153947_create_honors_table', 1);

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
-- Table structure for table `pjks`
--

CREATE TABLE `pjks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `lampiran` int(11) NOT NULL,
  `praktikum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lulus` int(11) NOT NULL,
  `tidaklulus` int(11) NOT NULL,
  `gugur` int(11) NOT NULL,
  `jumlahpeserta` int(11) NOT NULL,
  `jumlahkelas` int(11) NOT NULL,
  `jumlahpesertaperkelas` int(11) NOT NULL,
  `jumlahmodul` int(11) NOT NULL,
  `lamapraktikum` int(11) NOT NULL,
  `sks` int(11) NOT NULL,
  `sertifikat` int(11) NOT NULL,
  `operasional` int(11) NOT NULL,
  `koordinator` int(11) NOT NULL,
  `administrator` int(11) NOT NULL,
  `kebersihan` int(11) NOT NULL,
  `bimbingan` int(11) NOT NULL,
  `honorarium` int(11) NOT NULL,
  `biayamodul` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'bendahara', '2021-06-25 23:17:29', '2021-06-25 23:17:29'),
(2, 'koordinator', '2021-06-25 23:17:29', '2021-06-25 23:17:29'),
(3, 'kalab', '2021-06-25 23:17:29', '2021-06-25 23:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `transaksibendaharas`
--

CREATE TABLE `transaksibendaharas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` double NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `jenistransaksi_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksikoordinators`
--

CREATE TABLE `transaksikoordinators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` double NOT NULL,
  `jenistransaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'bendahara', 'bendahara@gmail.com', NULL, '$2y$10$qu4XkZCEPrZKqNnM8nrx5.eeyRcvKQ6BENgVtVMcwreZxjspS/gi.', 1, NULL, '2021-06-25 23:17:29', '2021-06-25 23:17:29'),
(2, 'koor', 'koor@gmail.com', NULL, '$2y$10$yecd.xBlj9r3UfBPGB7CzuTCcfVzWd0.SGBSewVAN0n5o8owhnBsK', 2, NULL, '2021-06-25 23:17:30', '2021-06-25 23:17:30'),
(3, 'kalab', 'kalab@gmail.com', NULL, '$2y$10$d7RE.W8ZRwjmRjhuc3u.V.Ywa3bpfYsFoL6fKrsZt4KSuwu7dF8Wu', 3, NULL, '2021-06-25 23:17:30', '2021-06-25 23:17:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `honors`
--
ALTER TABLE `honors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `honors_pjk_id_foreign` (`pjk_id`);

--
-- Indexes for table `jenistransaksis`
--
ALTER TABLE `jenistransaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pjks`
--
ALTER TABLE `pjks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjks_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksibendaharas`
--
ALTER TABLE `transaksibendaharas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksibendaharas_jenistransaksi_id_foreign` (`jenistransaksi_id`),
  ADD KEY `transaksibendaharas_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaksikoordinators`
--
ALTER TABLE `transaksikoordinators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `honors`
--
ALTER TABLE `honors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenistransaksis`
--
ALTER TABLE `jenistransaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pjks`
--
ALTER TABLE `pjks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksibendaharas`
--
ALTER TABLE `transaksibendaharas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksikoordinators`
--
ALTER TABLE `transaksikoordinators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `honors`
--
ALTER TABLE `honors`
  ADD CONSTRAINT `honors_pjk_id_foreign` FOREIGN KEY (`pjk_id`) REFERENCES `pjks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjks`
--
ALTER TABLE `pjks`
  ADD CONSTRAINT `pjks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksibendaharas`
--
ALTER TABLE `transaksibendaharas`
  ADD CONSTRAINT `transaksibendaharas_jenistransaksi_id_foreign` FOREIGN KEY (`jenistransaksi_id`) REFERENCES `jenistransaksis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksibendaharas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
