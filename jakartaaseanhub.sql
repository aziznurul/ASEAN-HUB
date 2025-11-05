-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2025 at 05:15 PM
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
-- Database: `jakartaaseanhub`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_27_120049_add_role_and_ip_to_users_table', 1),
(5, '2025_10_27_131617_create_submissions_table', 2),
(6, '2025_10_27_173219_add_score_and_feedback_to_submissions_table', 3),
(7, '2025_10_28_010541_add_is_finalist_to_submissions', 4),
(8, '2025_10_28_031449_add_rank_to_submissions_table', 5),
(9, '2025_10_28_044659_add_votes_count_to_submissions_table', 6),
(10, '2025_10_28_062351_create_votes_table', 7);

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
('azizfitb@gmail.com', '$2y$12$HhogVL5fcoNWZfxT2L8BJer4wU/1NG.oAFRYhmszFwEe90v6koUoG', '2025-10-30 09:33:55');

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
('dnCuv9FW4dAQktqS7mhBvICvxyCFqA6bHfgQULxZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGM0S0VTTHhHa0dydlhwUndRWGs1NzZVVU0wU0xKNVBwWnlFZGsyYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1761843601),
('k7SKYgpdmNjCNhf7PLaUz9cKy6BLjQdUnqCgX5Gh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTMwblJyaWFvWWRkVGJ4OHRPZWtpYjZKV3lSeHZYTVpVMng0bEo2eiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1761927032),
('rSxWPzgJ4oMQFM8E92lssGtrmtYb4JD2zmwsCNJ9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUQza0d2RzBud2NmQzIwb2Y1NGJodXF3RDdRbUQ4c3hpeUt4enZ4bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1761843817),
('w0733rL3EnE6jLK5vrqPl8lEJOOp2jjEeJTJQUAk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVW9ZWm5nTjQzV0liUjQ3Wld4MkhScHVkTkdLeTFIRmlRQWxwTU82NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1761843602);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `team_members` text NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `video_path` varchar(255) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_finalist` tinyint(1) NOT NULL DEFAULT 0,
  `rank` int(11) DEFAULT NULL,
  `votes_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `team_name`, `phone_number`, `team_members`, `pdf_path`, `video_path`, `score`, `feedback`, `created_at`, `updated_at`, `is_finalist`, `rank`, `votes_count`) VALUES
(9, 8, 'Sinergantara', '087634963120', '\"[\\\"Gesta Maulana\\\",\\\"Albert Timothy\\\"]\"', 'submissions/do8heraco7AYLbWBWDuvvA8zAlUi8XWvBBoxFI1z.pdf', 'submissions/HfELVuaWaiodxvHHiVcRveScylOIO5K4FmANv3Wn.mp4', 80, 'Cukup Bagus', '2025-10-27 18:02:06', '2025-10-30 06:08:36', 1, 1, 2),
(10, 11, 'Yayasan Pemuda Indonesia', '089523124532', '\"[\\\"Aziz Nurul Hidayat\\\",\\\"Belyas Saputra\\\"]\"', 'submissions/uoKVFKzQyJqS3GPaC02lLLgDrKmQZ77NOGP0d7q1.pdf', 'submissions/GmRlREhRwC1cqJm1pUmodEUTZEC3kbhMTf0iPFeH.mp4', 95, 'Sangat Bagus', '2025-10-28 07:00:35', '2025-10-30 04:32:13', 1, 1, 0),
(13, 12, 'Biro KSD', '081310627547', '\"[\\\"Nirwono\\\",\\\"Marjani\\\"]\"', 'submissions/ntLVi1N80JJX9B3eX1KZaK7c9N3WYKKhj6kQQuBB.pdf', 'submissions/OxuSasngQAmnk79cv1G7RM1xzPGi5PTnBQFsE3p6.mp4', 80, 'Cukup Bagus', '2025-10-29 00:09:07', '2025-10-30 06:10:51', 1, NULL, 0),
(15, 5, 'Baraya Technology Solution', '089530078310', '\"[\\\"Aziz Nurul Hidayat\\\",\\\"Bambang Pamungkas\\\"]\"', 'submissions/djymhucSj1yNhXsu4K48qreV2vdsqOorpy0gWhbg.pdf', 'submissions/LfO0aCu6UmgGsiHzh6Zp28AbhXjOh5JGeUylVNeA.mp4', 90, 'Sangat Bagus', '2025-10-29 00:21:44', '2025-10-30 04:37:33', 1, 1, 0),
(16, 13, 'Badan Usaha Biro Kerja Sama Daerah DKI Jakarta', '087643974093', '\"[\\\"Borneo Putra Utama\\\",\\\"Haikal\\\",\\\"Fariq\\\"]\"', 'submissions/ZfZEWHSl1vP5Jsj2uBNQDPaeHf70MHTYJHZmOoPX.pdf', 'submissions/MOCbxhSrbZM8qyOAK8HMXfvhVlnjQ6JLaTnNzrzg.mp4', 80, 'Cukup Bagus', '2025-10-29 02:24:13', '2025-10-30 06:08:47', 1, 2, 0),
(17, 14, 'PTY Biro Kerja Sama Daerah DKI Jakarta', '087638913632', '\"[\\\"Raden Ajeng Sulastri\\\",\\\"Yopie\\\",\\\"Fadjar\\\"]\"', 'submissions/Kst7aZstr4pWfZxJfF86WP1KtpVDmJ4Cl82S89XL.pdf', 'submissions/i4nVV7rrFrQtya45iOSfCaFqYQDq5e8AMgnq5b2G.mp4', 90, 'Sangat Bagus', '2025-10-29 02:30:36', '2025-10-30 04:32:59', 1, 1, 0);

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
  `role` enum('admin','jury','participant','voter') NOT NULL DEFAULT 'voter',
  `register_ip` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `register_ip`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Aziz Nurul Hidayat', 'azizfitb@gmail.com', '2025-10-27 06:06:46', '$2y$12$IJz.IXqadCYmtFLVG2D1RuaeZZseW28p9QOov/dW4Jhflqkw7k09G', 'participant', '127.0.0.1', NULL, '2025-10-27 06:05:51', '2025-10-27 06:06:46'),
(6, 'Yudi Hermawan', 'yudihermawan@gmail.com', NULL, '$2y$12$k/YhjAoMoj/Vwlw9fLP9eeDfwcmae2SAbxBMEogfacUZl8x5AqsGu', 'jury', '127.0.0.1', NULL, '2025-10-27 07:49:46', '2025-10-27 07:49:46'),
(7, 'Marjani', 'marjani@gmail.com', '2025-10-27 08:43:37', '$2y$12$io3VaGgdETYmbIw.IdBabOpGfZEIS9X6NOOb2ynwwvVpx2do5aTaK', 'jury', '127.0.0.1', NULL, '2025-10-27 08:42:44', '2025-10-27 08:43:37'),
(8, 'Rahaden Bagas', 'rahadenbagas@gmail.com', NULL, '$2y$12$hn9xFAz/GccyAx4XWI/U5.YdUc.bJVJaj5JdmMrSc9eKGS3KuuRTm', 'participant', '127.0.0.1', NULL, '2025-10-27 17:59:09', '2025-10-27 17:59:09'),
(9, 'Anisa Hasna N', 'anisahasna@gmail.com', NULL, '$2y$12$GQIZE5NMILoTHtf4BYN4neIdncXhzh5CNfxGS8E0lsKtPcY5AqTf2', 'voter', '127.0.0.1', NULL, '2025-10-27 21:43:27', '2025-10-27 21:43:27'),
(10, 'Administrator', 'administrator@gmail.com', NULL, '$2y$12$tN7SVUijl4BWhXJrI5SzYu9egTLs/yEZU6Klb4qfCJN4R03EhDh2q', 'admin', '127.0.0.1', NULL, '2025-10-28 01:25:34', '2025-10-28 01:25:34'),
(11, 'Yayasan Pemuda Indonesia', 'itkliniktsngontong@gmail.com', NULL, '$2y$12$JwFOurGu/O.ENTSU9tBxW..CykrBok0g54C8ocoRDCskLSRIfzkHO', 'participant', '127.0.0.1', NULL, '2025-10-28 06:59:22', '2025-10-28 06:59:22'),
(12, 'YUDI', 'yudi.hermawan@jakarta.go.id', NULL, '$2y$12$ycOh0lWHXNid6RSPYkMtkuW1fB3rwzPNqbEmBXP0lAejYyadtV.gm', 'participant', '127.0.0.1', NULL, '2025-10-29 00:04:07', '2025-10-29 00:04:07'),
(13, 'Borneo Putra Utama', 'borneo.putrautama@jakarta.go.id', NULL, '$2y$12$aI7u.mZaNhTxu/q9qwCLke/vKQg7Hk6Y/YilIY/vWK3aKML/Zs3ua', 'participant', '127.0.0.1', NULL, '2025-10-29 02:23:12', '2025-10-29 02:23:12'),
(14, 'Raden Ajeng Sulastri', 'radenajengsulastri@jakarta.go.id', NULL, '$2y$12$K7kcNmGU.uYdNMMIlziSledxVLu5yLz83cIGFUTJsaPYh5E91mK1G', 'participant', '127.0.0.1', NULL, '2025-10-29 02:29:23', '2025-10-29 02:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `submission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votes_user_id_foreign` (`user_id`),
  ADD KEY `votes_submission_id_foreign` (`submission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
