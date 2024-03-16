-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 07:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `is_correct`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 'a', 0, 1, NULL, NULL),
(2, 'b', 1, 1, NULL, NULL),
(3, 'kkkkk', 0, 3, NULL, NULL),
(4, 'k5', 1, 3, NULL, NULL),
(5, 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 1, 2, NULL, NULL),
(6, 'km', 0, 4, NULL, NULL),
(7, 'ksddd', 1, 5, NULL, NULL),
(8, '1', 1, 7, NULL, NULL),
(9, 'Answer 1 for Question 1', 1, 1, NULL, NULL),
(10, 'Answer 2 for Question 1', 0, 1, NULL, NULL),
(11, 'Answer 1 for Question 2', 1, 2, NULL, NULL),
(12, 'Answer 2 for Question 2', 0, 2, NULL, NULL),
(13, 'Answer 1 for Question 3', 1, 3, NULL, NULL),
(14, 'Answer 2 for Question 3', 0, 3, NULL, NULL),
(15, 'Answer 1 for Question 4', 1, 4, NULL, NULL),
(16, 'Answer 2 for Question 4', 0, 4, NULL, NULL),
(17, 'Answer 1 for Question 5', 1, 5, NULL, NULL),
(18, 'Answer 2 for Question 5', 0, 5, NULL, NULL),
(19, 'Answer 1 for Question 6', 1, 6, NULL, NULL),
(20, 'Answer 2 for Question 6', 0, 6, NULL, NULL),
(21, 'Answer 1 for Question 6', 1, 6, NULL, NULL),
(22, 'Answer 2 for Question 6', 0, 6, NULL, NULL),
(23, 'Another Correct Answer for Question 6', 1, 6, NULL, NULL),
(24, 'Yet Another Incorrect Answer for Question 6', 0, 6, NULL, NULL),
(25, 'Answer 1 for Question 1', 1, 13, NULL, NULL),
(26, 'Answer 2 for Question 1', 0, 13, NULL, NULL),
(27, 'Answer 3 for Question 1', 0, 13, NULL, NULL),
(28, 'Answer 4 for Question 1', 0, 13, NULL, NULL),
(29, 'Answer 5 for Question 1', 0, 13, NULL, NULL),
(30, 'Answer 1 for Question 2', 1, 14, NULL, NULL),
(31, 'Answer 2 for Question 2', 0, 14, NULL, NULL),
(32, 'Answer 3 for Question 2', 0, 14, NULL, NULL),
(33, 'Answer 4 for Question 2', 0, 14, NULL, NULL),
(34, 'Answer 5 for Question 2', 0, 14, NULL, NULL),
(35, 'Answer 1 for Question 3', 1, 15, NULL, NULL),
(36, 'Answer 2 for Question 3', 0, 15, NULL, NULL),
(37, 'Answer 3 for Question 3', 0, 15, NULL, NULL),
(38, 'Answer 4 for Question 3', 0, 15, NULL, NULL),
(39, 'Answer 5 for Question 3', 0, 15, NULL, NULL),
(40, 'Answer 1 for Question 4', 1, 16, NULL, NULL),
(41, 'Answer 2 for Question 4', 0, 16, NULL, NULL),
(42, 'Answer 3 for Question 4', 0, 16, NULL, NULL),
(43, 'Answer 4 for Question 4', 0, 16, NULL, NULL),
(44, 'Answer 5 for Question 4', 0, 16, NULL, NULL),
(45, 'Answer 1 for Question 5', 1, 17, NULL, NULL),
(46, 'Answer 2 for Question 5', 0, 17, NULL, NULL),
(47, 'Answer 3 for Question 5', 0, 17, NULL, NULL),
(48, 'Answer 4 for Question 5', 0, 17, NULL, NULL),
(49, 'Answer 5 for Question 5', 0, 17, NULL, NULL),
(50, 'Answer 1 for Question 6', 1, 18, NULL, NULL),
(51, 'Answer 2 for Question 6', 0, 18, NULL, NULL),
(52, 'Answer 3 for Question 6', 0, 18, NULL, NULL),
(53, 'Answer 4 for Question 6', 0, 18, NULL, NULL),
(54, 'Answer 5 for Question 6', 0, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `subject_id`, `chapter_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'm1', NULL, NULL),
(2, 2, 'kk', NULL, NULL),
(3, 2, 'kk2', NULL, NULL),
(4, 1, 'ss', NULL, NULL),
(5, 1, 'Random Chapter 1', NULL, NULL),
(6, 2, 'Random Chapter 2', NULL, NULL),
(7, 1, 'Random Chapter 3', NULL, NULL),
(8, 2, 'Random Chapter 4', NULL, NULL),
(9, 1, 'Random Chapter 5', NULL, NULL);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_22_000209_create_years_table', 1),
(6, '2024_02_28_235502_create_subjects_table', 1),
(7, '2024_02_29_000235_create_chapters_table', 1),
(8, '2024_03_01_015402_create_questions_table', 1),
(9, '2024_03_01_015419_create_answers_table', 1),
(10, '2024_03_03_010510_add_source_to_questions_table', 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `type` enum('QCM','Cas Cliniques') NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`, `chapter_id`, `created_at`, `updated_at`, `source`) VALUES
(1, 'maa??', 'QCM', 1, NULL, NULL, 'M'),
(2, 'ka?', 'Cas Cliniques', 2, NULL, NULL, 'C'),
(3, 'ka mcq?', 'QCM', 2, NULL, NULL, 'M'),
(4, 'k2?', 'QCM', 2, NULL, NULL, 'C'),
(5, 'ksd', 'QCM', 3, NULL, NULL, 'M'),
(6, 'k6', 'QCM', 3, NULL, NULL, 'C'),
(7, 'Random Question 1', 'QCM', 1, NULL, NULL, 'M'),
(8, 'Random Question 2', 'Cas Cliniques', 2, NULL, NULL, 'M'),
(9, 'Random Question 3', 'QCM', 3, NULL, NULL, 'C'),
(10, 'Random Question 4', 'Cas Cliniques', 1, NULL, NULL, 'C'),
(11, 'Random Question 5', 'QCM', 2, NULL, NULL, 'M'),
(12, 'Random Question 6', 'Cas Cliniques', 3, NULL, NULL, 'C'),
(13, 'Question 1', 'QCM', 6, NULL, NULL, 'M'),
(14, 'Question 2', 'Cas Cliniques', 8, NULL, NULL, 'M'),
(15, 'Question 3', 'QCM', 6, NULL, NULL, 'C'),
(16, 'Question 4', 'Cas Cliniques', 9, NULL, NULL, 'C'),
(17, 'Question 5', 'QCM', 6, NULL, NULL, 'M'),
(18, 'Question 6', 'Cas Cliniques', 9, NULL, NULL, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year_id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `year_id`, `subject_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'm', NULL, NULL),
(2, 1, 'k', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `first_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `code`, `first_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, NULL, '2024-03-01 22:29:05', '2024-03-01 22:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chapters_chapter_name_unique` (`chapter_name`),
  ADD KEY `chapters_subject_id_foreign` (`subject_id`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_year_id_foreign` (`year_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
