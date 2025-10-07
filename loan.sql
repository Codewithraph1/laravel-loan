-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2025 at 12:28 AM
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
-- Database: `loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admins', 'admin@mail.com', '$2y$12$JeNb891WuHfzwlu2Z33hAOd3YqFw3R6Th529ID.OVVeOljwxgwT6K', NULL, '2025-10-07 06:12:52', '2025-10-07 06:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_account_details`
--

CREATE TABLE `admin_account_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_code` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'NGN',
  `instructions` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_account_details`
--

INSERT INTO `admin_account_details` (`id`, `bank_name`, `account_name`, `account_number`, `bank_code`, `currency`, `instructions`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Access Bank', 'pakins mighty', '50038472801', '011', 'NGN', 'This account receives Nigerian Naira payments only.', 1, '2025-10-07 06:27:04', '2025-10-07 06:27:40');

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
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `loan_amount` decimal(15,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tenure_months` int(11) NOT NULL,
  `monthly_repayment` decimal(15,2) NOT NULL DEFAULT 0.00,
  `purpose` text NOT NULL,
  `house_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `next_of_kin_fullname` varchar(255) NOT NULL,
  `next_of_kin_relationship` varchar(255) NOT NULL,
  `next_of_kin_phone` varchar(255) NOT NULL,
  `next_of_kin_address` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `valid_id_type` varchar(255) NOT NULL,
  `valid_id_number` varchar(255) NOT NULL,
  `valid_id_path` varchar(255) NOT NULL,
  `status` enum('pending','under_review','approved','rejected','disbursed','active','completed','defaulted') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `application_date` date NOT NULL,
  `approval_date` date DEFAULT NULL,
  `disbursement_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `loan_amount`, `interest_rate`, `total_amount`, `tenure_months`, `monthly_repayment`, `purpose`, `house_address`, `city`, `state`, `next_of_kin_fullname`, `next_of_kin_relationship`, `next_of_kin_phone`, `next_of_kin_address`, `bank_name`, `account_number`, `account_name`, `valid_id_type`, `valid_id_number`, `valid_id_path`, `status`, `admin_notes`, `rejection_reason`, `application_date`, `approval_date`, `disbursement_date`, `due_date`, `created_at`, `updated_at`) VALUES
(1, 1, 50000.00, 50.00, 60416.67, 5, 12083.33, 'Education', 'No 5 ekwere mmanadu', 'Umuahia', 'Abia', 'Pakins Mighty', 'Sibling', '+2347664664674', 'No 5 ekwere mmanadu', 'Diamond Bank', '50038472801', 'pakins mighty', '5455464677366363', '37736653533', 'valid_ids/ID_1759824482_1.jpg', 'disbursed', 'Loan has been approved you will received your payment shortly\n\nDisbursed: Payment has been made', NULL, '2025-10-07', '2025-10-07', '2025-10-07', NULL, '2025-10-07 15:08:04', '2025-10-07 16:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayments`
--

CREATE TABLE `loan_repayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `installment_number` int(11) NOT NULL,
  `amount_due` decimal(15,2) NOT NULL,
  `amount_paid` decimal(15,2) NOT NULL DEFAULT 0.00,
  `due_date` date NOT NULL,
  `paid_date` date DEFAULT NULL,
  `status` enum('pending','paid','overdue','partial','pending_approval') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `transaction_reference` varchar(255) DEFAULT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `admin_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_repayments`
--

INSERT INTO `loan_repayments` (`id`, `loan_id`, `installment_number`, `amount_due`, `amount_paid`, `due_date`, `paid_date`, `status`, `payment_method`, `transaction_reference`, `receipt_path`, `admin_account_id`, `admin_notes`, `rejection_reason`, `approved_at`, `rejected_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12083.33, 12083.00, '2025-11-07', '2025-10-07', 'partial', 'bank_transfer', '44444', 'payment_receipts/receipt_1759869891_1.png', 1, 'Payment submitted - and has been confirmed', NULL, '2025-10-08 03:52:42', NULL, '2025-10-08 03:40:22', '2025-10-08 03:52:42'),
(2, 1, 2, 12083.33, 12083.33, '2025-12-07', '2025-10-07', 'paid', 'bank_transfer', '444444444', 'payment_receipts/receipt_1759870580_1.jpg', 1, 'Payment submitted - waiting for admin approval', NULL, '2025-10-08 03:57:50', NULL, '2025-10-08 03:40:22', '2025-10-08 03:57:50'),
(3, 1, 3, 12083.33, 12083.33, '2026-01-07', '2025-10-07', 'paid', 'card', '44444', 'payment_receipts/receipt_1759870744_1.jpg', 1, 'Payment submitted - waiting for admin approval', NULL, '2025-10-08 03:59:16', NULL, '2025-10-08 03:40:22', '2025-10-08 03:59:16'),
(4, 1, 4, 12083.33, 0.00, '2026-02-07', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-08 03:40:22', '2025-10-08 03:40:22'),
(5, 1, 5, 12083.33, 0.00, '2026-03-07', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-08 03:40:22', '2025-10-08 03:40:22');

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_10_02_194732_create_admins_table', 1),
(4, '2025_10_06_193937_create_users_table', 1),
(5, '2025_10_06_201609_create_sessions_table', 1),
(6, '2025_10_06_225513_create_admin_account_details_table', 1),
(7, '2025_10_07_073135_create_loans_table', 2),
(8, '2025_10_07_073154_create_loan_repayments_table', 2),
(9, '2025_10_07_091754_add_payment_approval_columns_to_loan_repayments_table', 3),
(10, '2025_10_07_095451_create_loan_repayments_table', 4);

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
('ffoUtM6SoHe8UX4xOIHSobVUIdkEOdpsEC62zDmb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUpSc3FHcE9OSU1QT1hsOWJEQTlnWkRSUjZaWk52S1A2QkM3bndoOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1759868838),
('Plp9nChXEmX6FQ21caVKMplqaCcSIr5BnDJUq7aa', 1, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/17.5 Mobile/15A5370a Safari/602.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYjZaeWpKQWc5Y3NXNUxERjhNSzY4STlJaDJMMGdlM1BqZFQxOXZTWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6Nzoic3VjY2VzcyI7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2xvZ2luIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjc6InN1Y2Nlc3MiO3M6MzE6IkxvZ2luIHN1Y2Nlc3NmdWwhIFdlbGNvbWUgYmFjay4iO30=', 1759871786),
('XzQPJAZtDrsYgcMebOrE7EiflDeDlW5xvhMPM7HB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicUFZVFA5bUJGemhHUkpTc2VBYVFOaVJhNU5vc1JiUHRBeUdoSjRPMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1759875814),
('YGGeiUc6GG4mrRyn1xxRPWyPtffx4SlaAms9HEtp', 1, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/17.5 Mobile/15A5370a Safari/602.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYUs5NmdqaXRYZ2lNY2U5UEJsSG9qRFQ3OEZLeVJiSFRGdWIxUlJZayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjc6InN1Y2Nlc3MiO319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2xvZ2luIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjc6InN1Y2Nlc3MiO3M6MzE6IkxvZ2luIHN1Y2Nlc3NmdWwhIFdlbGNvbWUgYmFjay4iO30=', 1759871760);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `account_number` varchar(20) DEFAULT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `annual_income` decimal(15,2) DEFAULT NULL,
  `credit_score` int(11) NOT NULL DEFAULT 0,
  `two_fa_pin` varchar(10) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','suspended','closed') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`, `address`, `city`, `state`, `country`, `date_of_birth`, `occupation`, `account_number`, `balance`, `annual_income`, `credit_score`, `two_fa_pin`, `profile_image`, `is_verified`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Davis emt', 'davies9288@gmail.com', NULL, '$2y$12$hWXLLc9h8oaM37RFQxpc/uAKt0BpL27um48t/YRyuD4/.Lqp.fk5S', NULL, NULL, NULL, NULL, NULL, NULL, '62653434205', 0.00, NULL, 0, NULL, 'profile_images/v7OsC0aJ3bGq3dxB9JataUklw1QPuGhPKlJgKjrP.png', 0, 'active', 'jHDv97HIEHsqSVlU0gMENJou0dpCvZMVhOETNFuOzkkADiXaE7ig1IE2WobG', '2025-10-07 06:14:37', '2025-10-07 06:28:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_account_details`
--
ALTER TABLE `admin_account_details`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_index` (`user_id`),
  ADD KEY `loans_status_index` (`status`),
  ADD KEY `loans_application_date_index` (`application_date`);

--
-- Indexes for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loan_repayments_loan_id_installment_number_unique` (`loan_id`,`installment_number`),
  ADD KEY `loan_repayments_admin_account_id_foreign` (`admin_account_id`),
  ADD KEY `loan_repayments_loan_id_index` (`loan_id`),
  ADD KEY `loan_repayments_due_date_index` (`due_date`),
  ADD KEY `loan_repayments_status_index` (`status`),
  ADD KEY `loan_repayments_paid_date_index` (`paid_date`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_account_number_unique` (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_account_details`
--
ALTER TABLE `admin_account_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD CONSTRAINT `loan_repayments_admin_account_id_foreign` FOREIGN KEY (`admin_account_id`) REFERENCES `admin_account_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_repayments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
