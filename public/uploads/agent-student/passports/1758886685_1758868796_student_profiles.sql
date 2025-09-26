-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 10:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studyxl`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_profiles`
--

CREATE TABLE `student_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `study_level` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `elp` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `passport_expiry` date DEFAULT NULL,
  `country_of_residence` varchar(100) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  `intake` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `cgpa` varchar(255) DEFAULT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `test_score` varchar(255) DEFAULT NULL,
  `test_year` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `reference_name` varchar(255) DEFAULT NULL,
  `reference_email` varchar(255) DEFAULT NULL,
  `reference_relationship` varchar(255) DEFAULT NULL,
  `reference_phone` varchar(255) DEFAULT NULL,
  `sop` longtext DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `passport_copy` varchar(255) DEFAULT NULL,
  `transcripts` varchar(255) DEFAULT NULL,
  `english_test` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_profiles`
--

INSERT INTO `student_profiles` (`id`, `user_id`, `name`, `email`, `destination`, `study_level`, `subject`, `nationality`, `elp`, `passport`, `dob`, `address`, `phone`, `gender`, `passport_expiry`, `country_of_residence`, `program`, `intake`, `specialization`, `qualification`, `institution`, `year`, `cgpa`, `test_name`, `test_score`, `test_year`, `organization`, `position`, `start_date`, `end_date`, `description`, `reference_name`, `reference_email`, `reference_relationship`, `reference_phone`, `sop`, `achievements`, `resume`, `passport_copy`, `transcripts`, `english_test`, `photo`, `created_at`, `updated_at`) VALUES
(5, 10, 'Imran Uddin Chowdhury', 'imranorbit5@gmail.com', 'UK', 'Bachelor', '4', 'Bangladesh', 'IELTS', '123456789', '2025-09-18', 'Sunt consectetur om', '+8801700876543', 'Male', '2025-09-19', 'sas', 'ass', 'dsaa', 'sss', 'sss', 'ssss', '', '', 'sss', '', 'sss', 's', 'sss', '2025-09-25', '2025-09-26', 'ssa', 'aswsw', 'sss', 'sss', 'ss', 'ss', 'sss', NULL, NULL, NULL, NULL, NULL, '2025-09-22 23:32:26', '2025-09-23 01:14:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_profiles_user_id_unique` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `student_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
