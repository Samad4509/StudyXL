-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2025 at 02:02 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$XbkbSV2MsJFywcQ4zrEc3eIO4/v2E4xrp1uD.sx5uTfAOAJwFwVFa', NULL, '2025-09-23 23:05:53', '2025-09-23 23:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `country_dialing_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `finance_email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `street_address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `director_prefix` varchar(255) DEFAULT NULL,
  `director_first_name` varchar(255) DEFAULT NULL,
  `director_last_name` varchar(255) DEFAULT NULL,
  `director_job_title` varchar(255) DEFAULT NULL,
  `director_dialing_code` varchar(255) DEFAULT NULL,
  `director_phone_number` varchar(255) DEFAULT NULL,
  `director_email` varchar(255) DEFAULT NULL,
  `trading_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `students_per_year` text DEFAULT NULL,
  `destinations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`destinations`)),
  `other_destination` varchar(255) DEFAULT NULL,
  `litigation` varchar(255) DEFAULT NULL,
  `litigation_details` text DEFAULT NULL,
  `australia_recruitment` varchar(255) DEFAULT NULL,
  `australia_recruitment_details` text DEFAULT NULL,
  `institutions` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `creative_course` varchar(255) DEFAULT NULL,
  `university_preparation` text NOT NULL,
  `adult_english` text NOT NULL,
  `junior_english` text NOT NULL,
  `direct_entry` text NOT NULL,
  `year_established` text NOT NULL,
  `branch_offices` text NOT NULL,
  `counsellors` text NOT NULL,
  `icef_id` varchar(255) NOT NULL,
  `hear_about` varchar(255) NOT NULL,
  `why_oxford` text DEFAULT NULL,
  `referee_prefix` varchar(255) DEFAULT NULL,
  `referee_first_name` varchar(255) DEFAULT NULL,
  `referee_last_name` varchar(255) DEFAULT NULL,
  `referee_company` varchar(255) DEFAULT NULL,
  `referee_email` varchar(255) DEFAULT NULL,
  `referee_dialing_code` varchar(255) DEFAULT NULL,
  `referee_phone` varchar(255) DEFAULT NULL,
  `referee_website` varchar(255) DEFAULT NULL,
  `is_approved` text NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'inactive',
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `prefix`, `first_name`, `last_name`, `company_name`, `job_title`, `country_dialing_code`, `phone_number`, `email`, `finance_email`, `password`, `street_address`, `street_address_line2`, `city`, `state`, `postal_code`, `country`, `director_prefix`, `director_first_name`, `director_last_name`, `director_job_title`, `director_dialing_code`, `director_phone_number`, `director_email`, `trading_name`, `website`, `students_per_year`, `destinations`, `other_destination`, `litigation`, `litigation_details`, `australia_recruitment`, `australia_recruitment_details`, `institutions`, `college`, `creative_course`, `university_preparation`, `adult_english`, `junior_english`, `direct_entry`, `year_established`, `branch_offices`, `counsellors`, `icef_id`, `hear_about`, `why_oxford`, `referee_prefix`, `referee_first_name`, `referee_last_name`, `referee_company`, `referee_email`, `referee_dialing_code`, `referee_phone`, `referee_website`, `is_approved`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'MacKenzie', 'Duke', 'Delacruz Wolfe Traders', 'Deserunt cupiditate ', '+880', '+880+1 (694) 426-1466', 'imranorbit5@gmail.com', 'hagepedefo@mailinator.com', '$2y$12$mn5e6qMY4f.LcIYT35EZMOP.GjuXhv/8GtJv5b6nJD/nz0uEeyD1m', 'Itaque est numquam p', 'Vel cupiditate illo ', 'Placeat sed id mag', 'Pariatur Voluptatem', 'Corporis consectetur', 'Provident molestiae', 'Ms', 'Myles', 'Dalton', 'Excepteur autem aliq', '+880', '+880+1 (797) 998-6252', 'paboj@mailinator.com', 'Brandon Acevedo', 'https://www.cupuwymag.com.au', '1988', '[\"UK\",\"Australia\"]', '', 'Eos quia cum odit pe', 'Cupiditate dolorem n', 'Quod aliquam esse r', 'Cumque mollitia fugi', 'Atque modi id adipi', 'Ipsum ipsum harum v', 'Enim vero repellendu', 'Cillum veniam possi', 'Ex neque voluptatem', 'Quos quia molestiae ', 'Sit sed illo debiti', '1985', '90', '36', 'In voluptatem Porro', 'Suscipit illum et v', 'Unde praesentium sae', 'Mr', 'Alika', 'Logan', 'Little Owens Plc', 'disivakaqe@mailinator.com', '+880', '+880+1 (564) 965-4946', 'https://www.luro.com.au', '0', 'inactive', NULL, '2025-09-24 05:41:53', '2025-09-24 05:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `field_of_studies`
--

CREATE TABLE `field_of_studies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_o_f_subjects`
--

CREATE TABLE `field_o_f_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `field_of_study_id` bigint(20) UNSIGNED NOT NULL,
  `study_field_name` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intakes`
--

CREATE TABLE `intakes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intake_months`
--

CREATE TABLE `intake_months` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intake_id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(255) NOT NULL,
  `open_date` date DEFAULT NULL,
  `submission_deadline` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(21, '2025_09_21_084359_add_phone_to_agents_table', 1),
(22, '2014_10_12_000000_create_users_table', 2),
(23, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(24, '2019_08_19_000000_create_failed_jobs_table', 2),
(25, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(26, '2025_08_22_071116_create_admins_table', 2),
(27, '2025_08_24_063658_create_agents_table', 2),
(28, '2025_08_25_054729_add_is_approved_to_agents_table', 2),
(29, '2025_09_01_091706_create_universities_table', 2),
(30, '2025_09_02_102303_create_university_programs_table', 2),
(31, '2025_09_03_080205_create_student_profiles_table', 2),
(32, '2025_09_07_084842_create_program_levels_table', 2),
(33, '2025_09_07_100544_create_field_of_studies_table', 2),
(34, '2025_09_09_055141_create_field_o_f_subjects_table', 2),
(35, '2025_09_10_115458_create_intakes_table', 2),
(36, '2025_09_10_125027_create_intake_months_table', 2),
(37, '2025_09_11_071614_create_destinations_table', 2),
(38, '2025_09_11_094123_create_program_tags_table', 2),
(39, '2025_09_14_092832_add_remember_token_to_users_table', 2),
(40, '2025_09_20_060226_add_active_to_agents_table', 2),
(41, '2025_09_20_060739_add_active_to_agents_table', 2);

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
(1, 'App\\Models\\User', 1, 'auth_token', 'f7427c718f0bd91ef8d0000d3304bb90040d5b9c7af9bf611618f133720e6882', '[\"*\"]', NULL, NULL, '2025-09-23 23:08:10', '2025-09-23 23:08:10'),
(2, 'App\\Models\\User', 1, 'auth_token', 'd46d842bda08aad1e4f5fdc09cbf985742f7749421ffbff4c8f82bfcb65ef8b6', '[\"*\"]', NULL, NULL, '2025-09-23 23:08:26', '2025-09-23 23:08:26'),
(3, 'App\\Models\\User', 1, 'auth_token', '0613eb03e5978bc9cceb9f0250088f0a201cde0ccf1df3b53fc2b9f6cbe9c40f', '[\"*\"]', NULL, NULL, '2025-09-23 23:09:33', '2025-09-23 23:09:33'),
(4, 'App\\Models\\User', 1, 'auth_token', 'c3d077fea1d6a2da71af2c5c93119cff49971d35f431a97e5384a5d2efbab1a3', '[\"*\"]', '2025-09-24 03:34:53', NULL, '2025-09-23 23:11:20', '2025-09-24 03:34:53'),
(5, 'App\\Models\\User', 1, 'auth_token', 'e1cff29fb45a05e8dfbbc1721c3ea650db14cee1423ec0e6c3f2b6b1d36c9a7e', '[\"*\"]', NULL, NULL, '2025-09-23 23:38:09', '2025-09-23 23:38:09'),
(6, 'App\\Models\\User', 1, 'auth_token', '0cfc003efe0c9427fd19a8952ea967f054dd46bc0961ae37bc0ecda15609681c', '[\"*\"]', NULL, NULL, '2025-09-24 00:14:09', '2025-09-24 00:14:09'),
(7, 'App\\Models\\User', 1, 'auth_token', '9e26beac5fd5a1abbe9140e8beee2aceb30702c99780da1a4052559389b67273', '[\"*\"]', NULL, NULL, '2025-09-24 00:23:22', '2025-09-24 00:23:22'),
(8, 'App\\Models\\User', 1, 'auth_token', '3aa3cb55b59b8ea0be6dfacd3df1cd62d4473441f6976259e3795f20cfce499b', '[\"*\"]', NULL, NULL, '2025-09-24 00:24:37', '2025-09-24 00:24:37'),
(9, 'App\\Models\\User', 1, 'auth_token', '51c4241ddce44915127126641f731eb54080a5374cb53b24a462c070f7c96c1b', '[\"*\"]', '2025-09-24 00:50:32', NULL, '2025-09-24 00:24:57', '2025-09-24 00:50:32'),
(10, 'App\\Models\\User', 1, 'auth_token', 'ce1f165e2f6bd911630bd6cc32fb16ae43f757b3418685b8afa9e3ca519511ef', '[\"*\"]', NULL, NULL, '2025-09-24 00:55:35', '2025-09-24 00:55:35'),
(11, 'App\\Models\\User', 1, 'auth_token', 'c24d416a80fd20a1b57da7f7b1eaca54bd5b42b642887443575e8a1eb434e231', '[\"*\"]', NULL, NULL, '2025-09-24 02:56:10', '2025-09-24 02:56:10'),
(12, 'App\\Models\\User', 1, 'auth_token', '05b15c8c0486717f55f2ef831550f0a3a2fdcc7241381c3526ba09079301809d', '[\"*\"]', '2025-09-24 03:15:02', NULL, '2025-09-24 03:00:34', '2025-09-24 03:15:02'),
(13, 'App\\Models\\User', 2, 'auth_token', '930bd788602ee615597680675b73182b10348370cdf6b3ee59a003142748db63', '[\"*\"]', NULL, NULL, '2025-09-24 03:37:16', '2025-09-24 03:37:16'),
(14, 'App\\Models\\User', 2, 'auth_token', '2778a6535c8fb352dbb455e2e1b6bab4152f64115a02e83f11acbae5abddae89', '[\"*\"]', '2025-09-24 04:23:44', NULL, '2025-09-24 03:37:24', '2025-09-24 04:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `program_levels`
--

CREATE TABLE `program_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_tags`
--

CREATE TABLE `program_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_tag` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `passport` varchar(255) DEFAULT NULL,
  `elp` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `passport_expiry` date DEFAULT NULL,
  `country_of_residence` varchar(255) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  `intake` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `academic_qualifications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`academic_qualifications`)),
  `test_scores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`test_scores`)),
  `work_experiences` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`work_experiences`)),
  `references` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`references`)),
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

INSERT INTO `student_profiles` (`id`, `user_id`, `name`, `email`, `destination`, `study_level`, `subject`, `nationality`, `passport`, `elp`, `dob`, `address`, `phone`, `gender`, `passport_expiry`, `country_of_residence`, `program`, `intake`, `specialization`, `academic_qualifications`, `test_scores`, `work_experiences`, `references`, `sop`, `achievements`, `resume`, `passport_copy`, `transcripts`, `english_test`, `photo`, `created_at`, `updated_at`) VALUES
(4, 2, 'Hop Carter', 'tuhehaqeli@mailinator.com', 'Harum qui culpa rep', 'Adipisicing enim sun', 'Aute neque doloribus', 'Qui adipisicing veni', 'Dicta amet in ut no', 'Occaecat quo aliquip', '1988-03-24', 'Qui quam ipsam et de', '+1 (988) 784-1251', 'Other', '2002-12-06', 'Consequuntur vitae l', 'Sint dolore minus r', 'Expedita sint perfer', 'Itaque eum nihil aut', '[{\"degree\":\"Sed mollitia ut sint\",\"institution\":\"Tempora do quis vero\",\"year\":\"1984\",\"cgpa\":\"Qui ipsam odit maior\"}]', '[{\"test_name\":\"GRE\",\"score\":\"Reiciendis vero cill\",\"date\":\"2019-08-16\"}]', '[{\"organization\":\"Kirk and Cantu Trading\",\"position\":\"Officiis commodi adi\",\"start_date\":\"1993-11-03\",\"end_date\":\"2003-04-28\",\"description\":\"Aut ab delectus ips\"}]', '[{\"name\":\"Jaime England\",\"email\":\"ferix@mailinator.com\",\"relationship\":\"In tempore unde est\",\"phone\":\"+1 (701) 644-3479\"}]', 'Elit cillum autem v', 'Incidunt veniam vo', 'uploads/resumes/1758708584_Odoo Solutions.xlsx', NULL, NULL, NULL, 'uploads/photos/1758708714_Screenshot 2025-09-23 145547.png', '2025-09-24 03:42:05', '2025-09-24 04:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `founded` int(11) DEFAULT NULL,
  `school_id` varchar(255) DEFAULT NULL,
  `institution_type` varchar(255) DEFAULT NULL,
  `dli_number` varchar(255) DEFAULT NULL,
  `top_disciplines` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`top_disciplines`)),
  `application_fee` varchar(255) DEFAULT NULL,
  `application_short_desc` varchar(255) DEFAULT NULL,
  `average_graduate_program` varchar(255) DEFAULT NULL,
  `average_graduate_program_short_desc` varchar(255) DEFAULT NULL,
  `average_undergraduate_program` varchar(255) DEFAULT NULL,
  `average_undergraduate_program_short_desc` varchar(255) DEFAULT NULL,
  `cost_of_living` varchar(255) DEFAULT NULL,
  `cost_of_living_short_desc` varchar(255) DEFAULT NULL,
  `average_gross_tuition` varchar(255) DEFAULT NULL,
  `average_gross_tuition_short_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university_programs`
--

CREATE TABLE `university_programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `university_id` bigint(20) UNSIGNED NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_description` text NOT NULL,
  `program_level` varchar(255) DEFAULT NULL,
  `program_intakes` varchar(255) DEFAULT NULL,
  `open_date` date DEFAULT NULL,
  `submission_deadline` datetime DEFAULT NULL,
  `study_permit_or_visa` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `education_country` varchar(255) DEFAULT NULL,
  `last_level_of_study` varchar(255) DEFAULT NULL,
  `grading_scheme` varchar(255) DEFAULT NULL,
  `ielts_required` tinyint(1) NOT NULL DEFAULT 0,
  `ielts_reading` double(8,2) DEFAULT NULL,
  `ielts_writing` double(8,2) DEFAULT NULL,
  `ielts_listening` double(8,2) DEFAULT NULL,
  `ielts_speaking` double(8,2) DEFAULT NULL,
  `ielts_overall` double(8,2) DEFAULT NULL,
  `toefl_required` tinyint(1) NOT NULL DEFAULT 0,
  `toefl_reading` int(11) DEFAULT NULL,
  `toefl_writing` int(11) DEFAULT NULL,
  `toefl_listening` int(11) DEFAULT NULL,
  `toefl_speaking` int(11) DEFAULT NULL,
  `toefl_overall` int(11) DEFAULT NULL,
  `duolingo_required` tinyint(1) NOT NULL DEFAULT 0,
  `duolingo_total` int(11) DEFAULT NULL,
  `pte_required` tinyint(1) NOT NULL DEFAULT 0,
  `pte_reading` int(11) DEFAULT NULL,
  `pte_writing` int(11) DEFAULT NULL,
  `pte_listening` int(11) DEFAULT NULL,
  `pte_speaking` int(11) DEFAULT NULL,
  `pte_overall` int(11) DEFAULT NULL,
  `no_exam_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `study_level` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `elp` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `destination`, `study_level`, `subject`, `nationality`, `elp`, `passport`, `created_at`, `updated_at`, `remember_token`) VALUES
(2, 'imran', 'imranorbit5@gmail.com', '$2y$12$00XrjBvQpVxCRtDKdSwSweg6dxBLgTu280Voic4HUKepDh3Ip11s2', 'UK', 'Bachelor', '7', 'Bangladesh', 'IELTS', '343325345', '2025-09-24 03:37:16', '2025-09-24 03:37:16', NULL);

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
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `field_of_studies`
--
ALTER TABLE `field_of_studies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_o_f_subjects`
--
ALTER TABLE `field_o_f_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_o_f_subjects_field_of_study_id_foreign` (`field_of_study_id`);

--
-- Indexes for table `intakes`
--
ALTER TABLE `intakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intake_months`
--
ALTER TABLE `intake_months`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intake_months_intake_id_foreign` (`intake_id`);

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
-- Indexes for table `program_levels`
--
ALTER TABLE `program_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_tags`
--
ALTER TABLE `program_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_profiles_user_id_unique` (`user_id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_programs`
--
ALTER TABLE `university_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `university_programs_university_id_foreign` (`university_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_of_studies`
--
ALTER TABLE `field_of_studies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_o_f_subjects`
--
ALTER TABLE `field_o_f_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intakes`
--
ALTER TABLE `intakes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intake_months`
--
ALTER TABLE `intake_months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `program_levels`
--
ALTER TABLE `program_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_tags`
--
ALTER TABLE `program_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university_programs`
--
ALTER TABLE `university_programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `field_o_f_subjects`
--
ALTER TABLE `field_o_f_subjects`
  ADD CONSTRAINT `field_o_f_subjects_field_of_study_id_foreign` FOREIGN KEY (`field_of_study_id`) REFERENCES `field_of_studies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `intake_months`
--
ALTER TABLE `intake_months`
  ADD CONSTRAINT `intake_months_intake_id_foreign` FOREIGN KEY (`intake_id`) REFERENCES `intakes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `student_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `university_programs`
--
ALTER TABLE `university_programs`
  ADD CONSTRAINT `university_programs_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
