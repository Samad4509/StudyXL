-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 06:52 AM
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
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$0zyVDHO9hsjW/o5VwUQA4OSLTeSKSM11oNPrBv8oianK/sKsHXeb.', NULL, '2025-12-29 23:45:34', '2025-12-29 23:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
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
(100000, 'Ms', 'Nerea', 'Franco', 'STUDY Learn', 'Agent', '+880', '+880+1 (698) 476-7403', 'hipijybex@mailinator.com', 'poky@mailinator.com', '$2y$12$6KSOYEzvx4OGVKgcE.xRIeNfcg.O/CApelExlJ/NgQbye51W5Inoe', 'Itaque animi non ve', 'Facilis et distincti', 'Dolore exercitatione', 'Laudantium eaque di', 'Accusamus dolore ali', 'Eum delectus nisi q', 'Mr', 'Cleo', 'Hanson', 'Cum at tempora ipsam', '+880', '+880+1 (337) 851-8312', 'pima@mailinator.com', 'Rosalyn Stout', 'https://www.myp.mobi', '2001', '[\"USA\",\"UK\",\"Canada\",\"Australia\"]', '', 'Amet consectetur c', 'Voluptate voluptatem', 'Est dignissimos qui', 'Voluptas tempora vol', 'Provident qui ad mo', 'Adipisci perferendis', 'In quis laborum Com', 'Sunt id fuga Placea', 'Velit nobis inventor', 'Aut rerum distinctio', 'Aut vitae veniam co', '1979', '4', '31', 'Nostrum molestiae et', 'Soluta aut consequat', 'Quae praesentium sap', 'Ms', 'Axel', 'Grimes', 'Wilson and Brock Associates', 'vakylybi@mailinator.com', '+880', '+880+1 (788) 826-6542', 'https://www.kymate.com.au', '1', 'active', '9d70fe81fb076c3c8203154b411147677bb41ee6e92ab14e7b8fd7cebc00e7bd', '2026-01-02 03:51:27', '2026-01-03 02:04:06'),
(100001, 'Mr', 'Lawrence', 'Love', 'Coleman and Gonzalez Traders', 'Ex duis quis assumen', '+880', '+880+1 (563) 338-1024', 'xaqefa255@mailinator.com', 'tocigyxos255@mailinator.com', '$2y$12$gCgVcXZz4w3Nc.Rnji7hAOh0DRhw0lJCV/aKeKEp/R1VIFbmZhGBe', 'Deleniti id ipsam om', 'In dolore ut accusan', 'Quos ut ipsum laboru', 'Iusto distinctio Ex', 'In elit ipsum sapi', 'Quidem minima molest', 'Ms', 'Larissa', 'Barber', 'Ut est sunt cumque n', '+880', '+880+1 (318) 143-9527', 'hyqadytudy@mailinator.com', 'Kaitlin Cruz', 'https://www.kexamorypasonyd.co.uk', '1982', '\"[\\\"UK\\\",\\\"USA\\\",\\\"Canada\\\",\\\"Other\\\"]\"', '', 'Id distinctio Corpo', 'Nulla veniam eius q', 'Nobis dolorum non pr', 'Aut non saepe totam ', 'Recusandae Eos pla', 'Natus obcaecati veri', 'Quae distinctio Nob', 'Animi quidem praese', 'Nam id nemo ullamco ', 'Molestias doloremque', 'Minima voluptatem eo', '1976', '47', '92', 'Harum placeat amet', 'Saepe qui occaecat a', 'Et eum quis molestia', 'Mr', 'Austin', 'Castillo', 'Buckley Vincent Co', 'puqiqu@mailinator.com', '+880', '+880+1 (209) 108-1639', 'https://www.volafy.ca', '0', 'inactive', NULL, '2026-01-03 03:09:42', '2026-01-03 03:09:42'),
(100002, 'Dr', 'Ross', 'Wooten', 'Lynch Butler Co', 'Quae quia suscipit m', '+880', '+880+1 (988) 775-4059', 'agent2@mailinator.com', 'agent2@mailinator.com', '$2y$12$.Tyes5cqC.LTdRbMmZuDR.z.AFatiEvuPX/LWd2eEZGZBHInh7Ddy', 'Irure fuga In maior', 'Illum ullam molesti', 'Amet rem architecto', 'Do velit voluptatem', 'Excepturi quidem qui', 'Quam et velit delect', 'Mr', 'Burton', 'Parker', 'Quia illo consequatu', '+880', '+880+1 (311) 847-8596', 'punav@mailinator.com', 'Garth Kline', 'https://www.hewyfudiporyx.us', '1997', '[\"Canada\",\"Other\"]', '', 'Nulla repudiandae co', 'Fugit rerum in quae', 'Velit deleniti ut u', 'Accusantium in dolor', 'Sapiente illum id u', 'Dolorum temporibus e', 'Omnis voluptas conse', 'Expedita adipisicing', 'Non sit quam omnis ', 'Nostrud natus impedi', 'Dolor ex officia qua', '2019', '6', '81', 'Quia et in praesenti', 'Mollit voluptas volu', 'Beatae natus error f', 'Dr', 'Eaton', 'Faulkner', 'Norton and Cotton Co', 'cevyryk@mailinator.com', '+880', '+880+1 (689) 566-1877', 'https://www.vapydatidy.com', '1', 'active', NULL, '2026-01-03 03:54:49', '2026-01-03 03:56:28'),
(100003, 'Ms', 'Cleo', 'Camacho', 'Gonzales Frank Plc', 'Sit non laborum Ir', '+880', '+880+1 (158) 408-6864', 'sozaby@mailinator.com', 'sozaby@mailinator.com', '$2y$12$zMXavhzJIbCqs2OZgO685u/bKKd5sshJA8Z8Ca6yqNdq9Bh/78cTy', 'Aliquip animi offic', 'Sint excepturi non ', 'Quis nihil maxime sa', 'Iure ipsa in quod q', 'Officia blanditiis u', 'Et corrupti mollit ', 'Mrs', 'Hanae', 'Peterson', 'Non ut labore commod', '+880', '+880+1 (489) 495-5275', 'renigyja@mailinator.com', 'Mufutau Bridges', 'https://www.vinaneguneb.org', '2008', '[\"USA\"]', '', 'Ipsam impedit totam', 'Et proident nulla a', 'Beatae ea autem occa', 'In delectus earum o', 'Exercitation ea aut ', 'Dignissimos consequu', 'Veniam quasi irure ', 'Similique id illum ', 'Est pariatur Laudan', 'Dolor voluptatem ve', 'Aut laboriosam ex f', '1999', '69', '28', 'Nesciunt vitae magn', 'Aut in do hic irure ', 'Veniam explicabo E', 'Mrs', 'Kaye', 'Mccoy', 'Hoover and Daniel Inc', 'sugisa@mailinator.com', '+880', '+880+1 (573) 996-5298', 'https://www.pyrimu.com', '0', 'inactive', NULL, '2026-01-03 23:12:03', '2026-01-03 23:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `agent_students`
--

CREATE TABLE `agent_students` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `agent_students`
--

INSERT INTO `agent_students` (`id`, `agent_id`, `company_name`, `name`, `email`, `destination`, `study_level`, `subject`, `nationality`, `passport`, `elp`, `dob`, `address`, `phone`, `gender`, `passport_expiry`, `country_of_residence`, `program`, `intake`, `specialization`, `academic_qualifications`, `test_scores`, `work_experiences`, `references`, `sop`, `achievements`, `resume`, `passport_copy`, `transcripts`, `english_test`, `photo`, `created_at`, `updated_at`) VALUES
(1000, '100000', 'STUDY Learn', 'Erica Oliver', 'xanati@mailinator.com', 'Tempor iste voluptat', 'okok', 'Consequat Qui quibu', 'Enim et qui harum ve', 'Minima enim eveniet', 'Nihil veniam pariat', '2000-03-18', 'Et corporis elit do', '+1 (639) 684-5799', 'Male', '1977-06-16', 'Sit aut praesentium', 'Cupidatat voluptates', 'Iusto ut nisi eos ve', 'Soluta ut officia pa', '\"[{\\\"degree\\\":\\\"Soluta unde assumend\\\",\\\"institution\\\":\\\"Nulla odit voluptate\\\",\\\"year\\\":\\\"2010\\\",\\\"cgpa\\\":\\\"Ut dolorum quaerat q\\\"}]\"', '\"[{\\\"test_name\\\":\\\"GMAT\\\",\\\"score\\\":\\\"Qui ullam ipsum vel\\\",\\\"date\\\":\\\"2016-08-26\\\"}]\"', '\"[{\\\"organization\\\":\\\"Baker Price Associates\\\",\\\"position\\\":\\\"Suscipit impedit om\\\",\\\"start_date\\\":\\\"1978-06-28\\\",\\\"end_date\\\":\\\"1984-08-08\\\",\\\"description\\\":\\\"Quisquam sed nostrum\\\"}]\"', '\"[{\\\"name\\\":\\\"Tyler Branch\\\",\\\"email\\\":\\\"qeny@mailinator.com\\\",\\\"relationship\\\":\\\"In voluptatum enim q\\\",\\\"phone\\\":\\\"+1 (954) 633-7659\\\"}]\"', 'Ut sit qui voluptate', 'Nihil saepe voluptat', 'uploads/agent-student/resumes/1767348096_resume.pdf', 'uploads/agent-student/passports/1767348096_passport.pdf', 'uploads/agent-student/transcripts/1767348096_trns.pdf', 'uploads/agent-student/tests/1767348096_english test.pdf', 'uploads/agent-student/photos/1767348096_phpto.pdf', '2026-01-02 04:01:36', '2026-01-03 03:26:53'),
(1001, '100000', 'STUDY Learn', 'student name', 'student@gmail.com', 'asdsef', 'qqwewr', 'dgffdg', 'dgfdfg', '10011011', 'dsfdgfdgft', '2025-01-01', 'xdffdgfdf', '0147825666', 'fdghfh', '2025-01-01', 'zdsf', 'dsfdg', 'fghfgjh', 'fsdf', '\"[{\\\"degree\\\":\\\"BSc\\\",\\\"institution\\\":\\\"ABC University\\\",\\\"year\\\":2020,\\\"cgpa\\\":\\\"3.8\\\"},{\\\"degree\\\":\\\"MSc\\\",\\\"institution\\\":\\\"XYZ University\\\",\\\"year\\\":2022,\\\"cgpa\\\":\\\"4.0\\\"}]\"', NULL, NULL, NULL, 'dfdsgs', 'dfdg', NULL, NULL, NULL, NULL, NULL, '2026-01-03 03:12:21', '2026-01-03 03:12:21'),
(1002, '100000', 'STUDY Learn', 'student name', 'student@gmail.com', 'asdsef', 'qqwewr', 'dgffdg', 'dgfdfg', '10011011', 'dsfdgfdgft', '2025-01-01', 'xdffdgfdf', '0147825666', 'fdghfh', '2025-01-01', 'zdsf', 'dsfdg', 'fghfgjh', 'fsdf', '\"[{\\\"degree\\\":\\\"BSc\\\",\\\"institution\\\":\\\"ABC University\\\",\\\"year\\\":2020,\\\"cgpa\\\":\\\"3.8\\\"},{\\\"degree\\\":\\\"MSc\\\",\\\"institution\\\":\\\"XYZ University\\\",\\\"year\\\":2022,\\\"cgpa\\\":\\\"4.0\\\"}]\"', NULL, NULL, NULL, 'dfdsgs', 'dfdg', NULL, NULL, NULL, NULL, NULL, '2026-01-03 03:14:15', '2026-01-03 03:14:15'),
(1003, '100002', 'Lynch Butler Co', 'Agent2', 'agent2@mailinator.com', 'Ducimus ipsa quo e', 'Beatae deserunt prae', 'Impedit consequatur', 'Odit inventore ut es', 'Eum alias dolorem te', 'Dolorem aspernatur d', '1982-08-13', 'Voluptatem quasi en', '+1 (309) 309-1069', 'Male', '2011-02-08', 'Aliquid eos impedit', 'Eum omnis nobis aut', 'Consectetur cupidat', 'Praesentium occaecat', '\"[{\\\"degree\\\":\\\"Incididunt et sunt i\\\",\\\"institution\\\":\\\"Nam officia maiores \\\",\\\"year\\\":\\\"1997\\\",\\\"cgpa\\\":\\\"Qui voluptas fugiat\\\"}]\"', '\"[{\\\"test_name\\\":\\\"TOEFL\\\",\\\"score\\\":\\\"Sint culpa est aut\\\",\\\"date\\\":\\\"2015-09-08\\\"}]\"', '\"[{\\\"organization\\\":\\\"Castro Henson LLC\\\",\\\"position\\\":\\\"Obcaecati qui sequi \\\",\\\"start_date\\\":\\\"2000-06-12\\\",\\\"end_date\\\":\\\"1981-03-28\\\",\\\"description\\\":\\\"Fugiat in ullamco a\\\"}]\"', '\"[{\\\"name\\\":\\\"Miranda Roman\\\",\\\"email\\\":\\\"node@mailinator.com\\\",\\\"relationship\\\":\\\"Iusto natus officia \\\",\\\"phone\\\":\\\"+1 (637) 959-9284\\\"}]\"', 'Inventore itaque ut', 'Consequat Dolorem h', 'uploads/agent-student/resumes/1767434316_passport.pdf', NULL, NULL, NULL, NULL, '2026-01-03 03:58:36', '2026-01-03 03:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `program_id` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `intake` varchar(255) NOT NULL,
  `status` enum('Submitted','Pending','Accepted','Rejected') NOT NULL DEFAULT 'Submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `student_name`, `student_id`, `agent_name`, `agent_id`, `program_id`, `program_name`, `university_name`, `intake`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Erica Oliver', 1000, 'STUDY Learn', '100000', '1', 'CSE', 'Dhaka University', 'dec - feb 2025', 'Submitted', '2026-01-03 23:46:10', '2026-01-03 23:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destinations_name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `destinations_name`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', '2025-12-29 23:56:06', '2025-12-29 23:56:06'),
(2, 'UK', '2025-12-31 00:25:05', '2025-12-31 00:25:05'),
(3, 'USA', '2025-12-31 02:50:45', '2025-12-31 02:50:45');

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

--
-- Dumping data for table `field_of_studies`
--

INSERT INTO `field_of_studies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'EEE', '2025-12-30 00:10:55', '2025-12-30 00:10:55'),
(2, 'cses', '2025-12-31 02:51:42', '2025-12-31 02:51:42');

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

--
-- Dumping data for table `field_o_f_subjects`
--

INSERT INTO `field_o_f_subjects` (`id`, `field_of_study_id`, `study_field_name`, `subject_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'EEE', 'Electronics enginnering', '2025-12-30 00:12:06', '2025-12-30 00:12:06');

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

--
-- Dumping data for table `intakes`
--

INSERT INTO `intakes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'dec - feb 2025', '2025-12-30 00:09:19', '2025-12-30 00:09:19');

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
  `status` varchar(255) NOT NULL DEFAULT 'likely_open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intake_months`
--

INSERT INTO `intake_months` (`id`, `intake_id`, `month`, `open_date`, `submission_deadline`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'jan 2025', '2024-10-01', '2025-10-31', 'likely_open', '2025-12-30 00:09:51', '2025-12-30 00:09:51');

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
(106, '2025_12_29_102928_add_additional_fields_to_university_programs_table', 1),
(107, '2014_10_12_000000_create_users_table', 2),
(108, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(109, '2019_08_19_000000_create_failed_jobs_table', 2),
(110, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(111, '2025_08_22_071116_create_admins_table', 2),
(112, '2025_08_24_063658_create_agents_table', 2),
(113, '2025_09_01_091706_create_universities_table', 2),
(114, '2025_09_02_102303_create_university_programs_table', 3),
(115, '2025_09_03_080205_create_student_profiles_table', 3),
(116, '2025_09_07_084842_create_program_levels_table', 3),
(117, '2025_09_07_100544_create_field_of_studies_table', 3),
(118, '2025_09_09_055141_create_field_o_f_subjects_table', 3),
(119, '2025_09_10_115458_create_intakes_table', 3),
(120, '2025_09_10_125027_create_intake_months_table', 3),
(121, '2025_09_11_071614_create_destinations_table', 3),
(122, '2025_09_11_094123_create_program_tags_table', 3),
(123, '2025_09_24_110103_create_agent_students_table', 3),
(124, '2025_10_28_082229_add_university_desc_to_universities_table', 3),
(126, '2026_01_03_112300_create_applications_table', 4),
(127, '2026_01_04_054510_create_notifications_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('acd22ef7-5436-479b-856a-a42bb57d81b2', 'App\\Notifications\\AgentApplicationConfirmed', 'App\\Models\\Admin', 1, '{\"application_id\":2,\"student_name\":\"Erica Oliver\",\"agent_name\":\"STUDY Learn\",\"program_name\":\"CSE\",\"message\":\"Agent \\u098f\\u0995\\u099f\\u09bf \\u09a8\\u09a4\\u09c1\\u09a8 Application confirm \\u0995\\u09b0\\u09c7\\u099b\\u09c7\"}', NULL, '2026-01-03 23:46:13', '2026-01-03 23:46:13');

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
(1, 'App\\Models\\Admin', 1, 'AdminAPIToken', 'c9267e1be78bb4cbbc0b002a83710ab08fcb0b4511cd9c4a30e6d827a8940369', '[\"*\"]', '2025-12-30 01:04:11', NULL, '2025-12-29 23:51:31', '2025-12-30 01:04:11'),
(2, 'App\\Models\\Admin', 1, 'AdminAPIToken', 'ef3c541ce2ca19f3b0bf3bae87ebde4a5bf50b278cd92785f701e8dd890194b8', '[\"*\"]', '2025-12-31 02:51:42', NULL, '2025-12-30 00:04:44', '2025-12-31 02:51:42'),
(3, 'App\\Models\\Admin', 1, 'AdminAPIToken', '1d8988efc24da15d19addccbd65fe348b5e347738baabc4da6795711867db309', '[\"*\"]', '2025-12-31 00:50:12', NULL, '2025-12-31 00:22:47', '2025-12-31 00:50:12'),
(4, 'App\\Models\\Admin', 1, 'AdminAPIToken', '704e6b2a5471871b771f08cf70e458bb25aab7e8170cbb0eeb3b1704b8d5eaf1', '[\"*\"]', '2026-01-02 04:04:17', NULL, '2026-01-02 03:53:02', '2026-01-02 04:04:17'),
(5, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '3227c185d6249f5a5bbab8e6f7e9217a7be22eca38209e4e57ad2405761c5cc0', '[\"*\"]', '2026-01-02 04:01:35', NULL, '2026-01-02 03:54:29', '2026-01-02 04:01:35'),
(6, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '2d798f49c623ac4532c0677fe00fe5862efcf97d39534c41fa64086cb85f2d17', '[\"*\"]', NULL, NULL, '2026-01-02 23:23:11', '2026-01-02 23:23:11'),
(7, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '398956c4e8a981871728d9955b7b4737c85c1c0bbeb6bd44675f2aeb5f2fa7e8', '[\"*\"]', NULL, NULL, '2026-01-02 23:23:13', '2026-01-02 23:23:13'),
(8, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '912541b5bff7b611696bf1846bd7c903df86a1db38cd43842d2af08ca5de4b91', '[\"*\"]', NULL, NULL, '2026-01-02 23:30:34', '2026-01-02 23:30:34'),
(9, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '558d07bb5c64e2b987b5b7a4bf03ee19d04ef48efbc3f09f1d67f2f50465823d', '[\"*\"]', NULL, NULL, '2026-01-02 23:30:42', '2026-01-02 23:30:42'),
(10, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '1b8faa007905dcb2b2b231842b536f407bd9720828666ad5ddb944d798567a89', '[\"*\"]', NULL, NULL, '2026-01-02 23:31:08', '2026-01-02 23:31:08'),
(11, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'dfd4a1205f63972fdf9263734050e65b766fdbdfa14da9376a4af2fd52ade807', '[\"*\"]', NULL, NULL, '2026-01-02 23:31:44', '2026-01-02 23:31:44'),
(12, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '065338eba2b6944bc90496245af87362d53e9dd46ed7489584bde1a3f10f7b73', '[\"*\"]', NULL, NULL, '2026-01-02 23:32:02', '2026-01-02 23:32:02'),
(13, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'b423292e28042ce03dab419943fdaeacc83603eed43d643b95214531cb118290', '[\"*\"]', NULL, NULL, '2026-01-02 23:32:18', '2026-01-02 23:32:18'),
(14, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '93033c1e79bc6045d77010febbd5eef55fe524da65622ac9a97a036a71cebb01', '[\"*\"]', NULL, NULL, '2026-01-02 23:32:34', '2026-01-02 23:32:34'),
(15, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '01a25e95ef395d0fc1c95a68b41f4a1289c6be528ab3e32970aa84c9caa3cb5d', '[\"*\"]', NULL, NULL, '2026-01-02 23:36:57', '2026-01-02 23:36:57'),
(16, 'App\\Models\\Admin', 1, 'AdminAPIToken', '7e1d8bcbecd86f73f944b985986f5474e65461f50e73719b2f5913f567e5e416', '[\"*\"]', '2026-01-03 01:03:47', NULL, '2026-01-02 23:53:18', '2026-01-03 01:03:47'),
(17, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '79d2c46e2393708e53cef463a45176b1babfca2d79acb387a3d788867aebdc23', '[\"*\"]', NULL, NULL, '2026-01-03 01:05:49', '2026-01-03 01:05:49'),
(18, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '34b5727ac0c45b4ab966337f914cad75400bd71c65294b993323e2cb72c40fb7', '[\"*\"]', NULL, NULL, '2026-01-03 01:18:01', '2026-01-03 01:18:01'),
(19, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'b935457d6edcf640776de7e1c0fec554f5445cd5a39a3649557f20d16ff8daf9', '[\"*\"]', NULL, NULL, '2026-01-03 01:20:23', '2026-01-03 01:20:23'),
(20, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '2d7c1ed90258f7828d049c06cde0ae0a9c8675d93216a9f57ee7cb59efee7809', '[\"*\"]', NULL, NULL, '2026-01-03 01:23:34', '2026-01-03 01:23:34'),
(21, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'a5d901bcd90943a6682a8ea0141a72a6a90ed3fa04fd359ced2c90f378b86919', '[\"*\"]', NULL, NULL, '2026-01-03 01:51:28', '2026-01-03 01:51:28'),
(22, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'a192570363235bf8c89a33264218a69be22d44b6e9403f8aeb4358bde82d6224', '[\"*\"]', NULL, NULL, '2026-01-03 01:52:53', '2026-01-03 01:52:53'),
(23, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'd4abb92071286756cbb7acfec2a1e082e5a5524844fe0cdfb16872c34b014046', '[\"*\"]', NULL, NULL, '2026-01-03 01:53:07', '2026-01-03 01:53:07'),
(24, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '18f32bf2b84f2af7a653b240bff6bd49648a7780f661ee8e08bd6e608dd232c9', '[\"*\"]', NULL, NULL, '2026-01-03 01:53:24', '2026-01-03 01:53:24'),
(25, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'e7d17363ca0891a1e30df73248ca4b2fc2794c13f0c3a7ee94abfcd349ba3887', '[\"*\"]', NULL, NULL, '2026-01-03 01:54:38', '2026-01-03 01:54:38'),
(26, 'App\\Models\\User', 1, 'auth_token', 'c1f387ff7cf6bacdfe9259f16154bf400fbc73238772691c59c722310754b2e4', '[\"*\"]', NULL, NULL, '2026-01-03 01:55:40', '2026-01-03 01:55:40'),
(27, 'App\\Models\\Agent', 100000, 'AgentAPIToken', 'f6e0285ee5a4b772530ee0fc8cfa0fdda3c8b59e53f9d0186cef5d81f4160c47', '[\"*\"]', NULL, NULL, '2026-01-03 01:55:45', '2026-01-03 01:55:45'),
(28, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '863e55f14a8856d732274c27739444040d4b026644ec309fd219e3821de82cc3', '[\"*\"]', NULL, NULL, '2026-01-03 01:56:54', '2026-01-03 01:56:54'),
(29, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '87baa352f0a2281cf2dac6a181c0e97c59c6d4c79adaa7524a2b65d060b199c3', '[\"*\"]', NULL, NULL, '2026-01-03 01:57:25', '2026-01-03 01:57:25'),
(30, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '6cbaec2c163e6a6d01c76bd362c601c3e1597969a6ad8c748b473a640d8e1d4b', '[\"*\"]', NULL, NULL, '2026-01-03 02:58:38', '2026-01-03 02:58:38'),
(31, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '1d9247310328ed763a621a2a4e61ac8624eb6bc6fc81ca1bbea23e3725f6ee6d', '[\"*\"]', '2026-01-03 03:32:50', NULL, '2026-01-03 03:07:36', '2026-01-03 03:32:50'),
(32, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '4a4dd592ab79674e68b672ae6919109404c2f8ba3690ffeb7b978631a432a694', '[\"*\"]', NULL, NULL, '2026-01-03 03:13:00', '2026-01-03 03:13:00'),
(33, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '361b6148c4a42d0d7df0199588be39d4d5180e979fdbe5355a951b3946840ea9', '[\"*\"]', NULL, NULL, '2026-01-03 03:32:20', '2026-01-03 03:32:20'),
(34, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '443c07513e8b599c14cbd0660acafab3feea2fc384cfabc21f7fb27a9f4f4cd3', '[\"*\"]', NULL, NULL, '2026-01-03 03:49:38', '2026-01-03 03:49:38'),
(35, 'App\\Models\\Agent', 100000, 'AgentAPIToken', '054cf976ff3e2f009acddb2fdec5d5cc79b4064759ff402d6454b556fd0c43c2', '[\"*\"]', '2026-01-03 04:06:53', NULL, '2026-01-03 03:49:49', '2026-01-03 04:06:53'),
(36, 'App\\Models\\Admin', 1, 'AdminAPIToken', 'c7a0eb0556a97b1eed3c6e0eb9d535e68b90f3b6eaa771625bd23742f5cf47d3', '[\"*\"]', NULL, NULL, '2026-01-03 03:53:03', '2026-01-03 03:53:03'),
(37, 'App\\Models\\Agent', 100002, 'AgentAPIToken', 'ff75a362e30b1ca7ad9b6b8d572eefd1f5de9269b1f8187b791425db1acfdfc6', '[\"*\"]', '2026-01-03 03:58:36', NULL, '2026-01-03 03:56:32', '2026-01-03 03:58:36'),
(38, 'App\\Models\\Agent', 100002, 'AgentAPIToken', '47024de74f1c48f20021ddfe4e5dfcb17b89791abe7cfcf69502fd5c8d27b9b1', '[\"*\"]', '2026-01-03 04:08:05', NULL, '2026-01-03 04:07:40', '2026-01-03 04:08:05'),
(40, 'App\\Models\\User', 2, 'auth_token', '38fb47ad7ffbf07c80cc8f2dd3b0584b7d84a26b4238df7cb56df0d7540763fc', '[\"*\"]', '2026-01-03 06:52:19', NULL, '2026-01-03 06:52:01', '2026-01-03 06:52:19'),
(44, 'App\\Models\\User', 3, 'auth_token', 'e36f1e535700b08d196c33e9f4792278f7f0f19a042ac729aa184f5c15100b3d', '[\"*\"]', '2026-01-03 07:02:07', NULL, '2026-01-03 07:01:39', '2026-01-03 07:02:07');

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

--
-- Dumping data for table `program_levels`
--

INSERT INTO `program_levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Grate2', '2025-12-30 00:05:14', '2025-12-30 00:05:14'),
(2, 'Grate2', '2025-12-30 00:10:21', '2025-12-30 00:10:21');

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

--
-- Dumping data for table `program_tags`
--

INSERT INTO `program_tags` (`id`, `program_tag`, `created_at`, `updated_at`) VALUES
(1, 'Fast Aceptance', '2025-12-30 00:11:47', '2025-12-30 00:11:47');

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

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `university_desc` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `destinations` text DEFAULT NULL,
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

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `destination_id`, `university_name`, `university_desc`, `address`, `location`, `destinations`, `phone_number`, `images`, `founded`, `school_id`, `institution_type`, `dli_number`, `top_disciplines`, `application_fee`, `application_short_desc`, `average_graduate_program`, `average_graduate_program_short_desc`, `average_undergraduate_program`, `average_undergraduate_program_short_desc`, `cost_of_living`, `cost_of_living_short_desc`, `average_gross_tuition`, `average_gross_tuition_short_desc`, `created_at`, `updated_at`) VALUES
(1, '1', 'Dhaka University', 'Velit sequi tempor', 'Dhaka', 'Dhaka', 'Dhaka', 'Adipisicing tempor s', '[\"uploads\\/universities\\/img_1767074192_Regis-College-Crest-Campus-July-2022.webp\",\"uploads\\/universities\\/img_1767074192_Regis-College-Graduation-Ceremony-July-2022.webp\",\"uploads\\/universities\\/img_1767074192_Regis-College-Nursing-Student-At-Work-July-2022.webp\",\"uploads\\/universities\\/img_1767074192_Regis-College-Students-July-2022.webp\",\"uploads\\/universities\\/img_1767074192_Regis-College-Tower-Campus-July-2022.webp\"]', 1817, 'Ad consequat Ut eli', NULL, 'Elit voluptate mole', '[{\"discipline\":\"Math\",\"percentage\":80}]', 'Autem lorem amet in', 'Consectetur qui qui', 'Reiciendis ipsa rep', 'Quisquam pariatur V', 'Numquam id sunt mol', 'Fugiat quo officia', 'Et enim facilis et e', 'Quas possimus et ar', 'Non voluptatem cillu', 'Debitis pariatur La', '2025-12-29 23:56:32', '2025-12-29 23:56:32'),
(2, '2', 'East West University', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.', 'Dhaka', 'Dhaka', 'UK', 'Deserunt et aut sint', '[\"uploads\\/universities\\/img_1767162403_Regis-College-Crest-Campus-July-2022.webp\",\"uploads\\/universities\\/img_1767162403_Regis-College-Graduation-Ceremony-July-2022.webp\",\"uploads\\/universities\\/img_1767162403_Regis-College-Nursing-Student-At-Work-July-2022.webp\",\"uploads\\/universities\\/img_1767162403_Regis-College-Students-July-2022.webp\",\"uploads\\/universities\\/img_1767162403_Regis-College-Tower-Campus-July-2022.webp\"]', 1518, 'Qui at molestiae eiu', 'Private', 'Consequat Qui neces', '[{\"discipline\":\"EEE\",\"percentage\":90},{\"discipline\":\"CSE\",\"percentage\":80}]', 'Qui iure quod culpa', 'Assumenda dolorum pe', 'Perspiciatis culpa', 'Nihil officia conseq', 'Sunt aliquam nulla', 'Eos in eum autem qu', 'Similique obcaecati', 'Veniam inventore ci', 'Nisi in laboris dolo', 'Nesciunt sunt elige', '2025-12-31 00:26:43', '2025-12-31 00:26:43'),
(3, '1', 'Child Hood', NULL, 'Stanford, CA', 'Example City', 'Dhaka', '+12345678901', '[]', 1997, 'GFU-123', 'Private', '00233E', '[{\"discipline\":\"Business, Management and Economics\",\"percentage\":28},{\"discipline\":\"Sciences\",\"percentage\":25},{\"discipline\":\"Arts\",\"percentage\":16},{\"discipline\":\"Other\",\"percentage\":29}]', 'Free', 'Average application fee', 'One Year', 'Average graduate program', '3 Years', 'Average undergraduate program', '€11,904.00 EUR / Year', 'Cost of living', '€12,784.80 EUR / First Year', 'Average gross tuition', '2026-01-03 01:03:47', '2026-01-03 01:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `university_programs`
--

CREATE TABLE `university_programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_level_id` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `university_id` bigint(20) UNSIGNED NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_description` text NOT NULL,
  `program_level` varchar(255) DEFAULT NULL,
  `open_date` date DEFAULT NULL,
  `submission_deadline` datetime DEFAULT NULL,
  `intake_name` varchar(255) NOT NULL,
  `intake_id` varchar(255) NOT NULL,
  `field_of_study_name` varchar(255) NOT NULL,
  `field_of_study_id` varchar(255) NOT NULL,
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
  `intake_months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`intake_months`)),
  `program_tag_id` varchar(255) DEFAULT NULL,
  `program_tag_name` varchar(255) DEFAULT NULL,
  `no_exam_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
  `campus_city` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `success_chance` longtext DEFAULT NULL,
  `program_summary` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `university_programs`
--

INSERT INTO `university_programs` (`id`, `program_level_id`, `university_name`, `address`, `location`, `phone_number`, `images`, `university_id`, `program_name`, `program_description`, `program_level`, `open_date`, `submission_deadline`, `intake_name`, `intake_id`, `field_of_study_name`, `field_of_study_id`, `study_permit_or_visa`, `nationality`, `education_country`, `last_level_of_study`, `grading_scheme`, `ielts_required`, `ielts_reading`, `ielts_writing`, `ielts_listening`, `ielts_speaking`, `ielts_overall`, `toefl_required`, `toefl_reading`, `toefl_writing`, `toefl_listening`, `toefl_speaking`, `toefl_overall`, `duolingo_required`, `duolingo_total`, `pte_required`, `pte_reading`, `pte_writing`, `pte_listening`, `pte_speaking`, `pte_overall`, `intake_months`, `program_tag_id`, `program_tag_name`, `no_exam_status`, `created_at`, `updated_at`, `application_fee`, `application_short_desc`, `average_graduate_program`, `average_graduate_program_short_desc`, `average_undergraduate_program`, `average_undergraduate_program_short_desc`, `cost_of_living`, `cost_of_living_short_desc`, `average_gross_tuition`, `average_gross_tuition_short_desc`, `campus_city`, `duration`, `success_chance`, `program_summary`) VALUES
(1, '1', 'Dhaka University', 'Dhaka', 'Dhaka', 'Adipisicing tempor s', '\"[\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Crest-Campus-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Graduation-Ceremony-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Nursing-Student-At-Work-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Students-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Tower-Campus-July-2022.webp\\\"]\"', 1, 'CSE', 'Start completing Western Engineering’s Common First Year, students can enrol in the Chemical Engineering program.', 'Grate2', '2025-09-01', '2026-01-15 23:59:00', 'dec - feb 2025', '1', 'EEE', '1', 'Required', 'International', 'Bangladesh', 'High School', 'GPA (out of 4.0)', 1, 6.00, 6.00, 6.00, 6.00, 6.50, 1, 20, 20, 20, 20, 80, 1, 110, 1, 50, 50, 50, 50, 58, '[{\"id\":1,\"intake_id\":1,\"month\":\"jan 2025\",\"open_date\":\"2024-10-01\",\"submission_deadline\":\"2025-10-31\",\"status\":\"likely_open\",\"created_at\":\"2025-12-30T06:09:51.000000Z\",\"updated_at\":\"2025-12-30T06:09:51.000000Z\"}]', '1', 'Fast Aceptance', 'I will provide this later', '2025-12-30 00:12:27', '2025-12-30 00:27:11', 'Free', 'testx', 'fsdf', 'desc', 'prog', 'sdhsaf', '4252', 'living cost', '1000', 'dfgsds', NULL, NULL, NULL, NULL),
(2, '2', 'Dhaka University', 'Dhaka', 'Dhaka', 'Adipisicing tempor s', '\"[\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Crest-Campus-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Graduation-Ceremony-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Nursing-Student-At-Work-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Students-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767074192_Regis-College-Tower-Campus-July-2022.webp\\\"]\"', 1, 'Bangla', 'DESC', 'Grate2', '2025-09-01', '2026-01-15 23:59:00', 'dec - feb 2025', '1', 'EEE', '1', 'Required', 'International', 'Bangladesh', 'High School', 'GPA (out of 4.0)', 1, 6.00, 6.00, 6.00, 6.00, 6.50, 1, 20, 20, 20, 20, 80, 1, 110, 1, 50, 50, 50, 50, 58, '[{\"id\":1,\"intake_id\":1,\"month\":\"jan 2025\",\"open_date\":\"2024-10-01\",\"submission_deadline\":\"2025-10-31\",\"status\":\"likely_open\",\"created_at\":\"2025-12-30T06:09:51.000000Z\",\"updated_at\":\"2025-12-30T06:09:51.000000Z\"}]', '1', 'Fast Aceptance', 'I will provide this later', '2025-12-31 00:32:43', '2025-12-31 00:32:43', '10000', 'testx', 'fsdf', 'desc', 'prog', 'sdhsaf', '4252', 'living cost', '324623', 'dfgsds', 'City Name', '24 month', 'High', 'desc'),
(3, '2', 'East West University', 'Dhaka', 'Dhaka', 'Deserunt et aut sint', '\"[\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Crest-Campus-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Graduation-Ceremony-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Nursing-Student-At-Work-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Students-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Tower-Campus-July-2022.webp\\\"]\"', 2, 'Bangla', 'DESC', 'Grate2', '2025-09-01', '2026-01-15 23:59:00', 'dec - feb 2025', '1', 'EEE', '1', 'Required', 'International', 'Bangladesh', 'High School', 'GPA (out of 4.0)', 1, 6.00, 6.00, 6.00, 6.00, 6.50, 1, 20, 20, 20, 20, 80, 1, 110, 1, 50, 50, 50, 50, 58, '[{\"id\":1,\"intake_id\":1,\"month\":\"jan 2025\",\"open_date\":\"2024-10-01\",\"submission_deadline\":\"2025-10-31\",\"status\":\"likely_open\",\"created_at\":\"2025-12-30T06:09:51.000000Z\",\"updated_at\":\"2025-12-30T06:09:51.000000Z\"}]', '1', 'Fast Aceptance', 'I will provide this later', '2025-12-31 00:33:38', '2025-12-31 00:33:38', '10000', 'testx', 'fsdf', 'desc', 'prog', 'sdhsaf', '4252', 'living cost', '324623', 'dfgsds', 'City Name', '24 month', 'High', 'desc'),
(4, '2', 'East West University', 'Dhaka', 'Dhaka', 'Deserunt et aut sint', '\"[\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Crest-Campus-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Graduation-Ceremony-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Nursing-Student-At-Work-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Students-July-2022.webp\\\",\\\"uploads\\\\\\/universities\\\\\\/img_1767162403_Regis-College-Tower-Campus-July-2022.webp\\\"]\"', 2, 'Bangla', 'DESC', 'Grate2', '2025-09-01', '2026-01-15 23:59:00', 'dec - feb 2025', '1', 'EEE', '1', 'Required', 'International', 'Bangladesh', 'High School', 'GPA (out of 4.0)', 1, 6.00, 6.00, 6.00, 6.00, 6.50, 1, 20, 20, 20, 20, 80, 1, 110, 1, 50, 50, 50, 50, 58, '[{\"id\":1,\"intake_id\":1,\"month\":\"jan 2025\",\"open_date\":\"2024-10-01\",\"submission_deadline\":\"2025-10-31\",\"status\":\"likely_open\",\"created_at\":\"2025-12-30T06:09:51.000000Z\",\"updated_at\":\"2025-12-30T06:09:51.000000Z\"}]', '1', 'Fast Aceptance', 'I will provide this later', '2025-12-31 00:34:18', '2025-12-31 00:34:18', '10000', 'testx', 'fsdf', 'desc', 'prog', 'sdhsaf', '4252', 'living cost', '324623', 'dfgsds', 'City Name', '24 month', 'High', 'desc');

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
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `destination`, `study_level`, `subject`, `nationality`, `elp`, `passport`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Rerum doloribus et v', 'wopigunuv@mailinator.com', '$2y$12$IOJBbLU7YiOU/TehcnGxTeODfZoprQOwktLM4oh6Lz7xtgbvLt5i6', 'USA', 'Master', '55', 'Canada', 'IELTS', 'MOLESTIAS EU VEL MIN', NULL, '2026-01-03 01:55:39', '2026-01-03 01:55:39'),
(2, 'Atque reprehenderit ', 'muka@mailinator.com', '$2y$12$/begzql2ivEEZBahYkQJ4OCD/Ci29/bGage3vJFHD2tqZMFfqD3n2', 'USA', 'Bachelor', '5', 'China', 'TOEFL', 'NULLA ITAQUE IPSA S', NULL, '2026-01-03 06:51:56', '2026-01-03 06:51:56'),
(3, 'Ea facere aliquip pe', 'supupek@mailinator.com', '$2y$12$uGsmgBcb.w0ZAG0hM4gwjOeMNEMZwj/uYURIev4/orWBrwNuTjvxm', 'Canada', 'Master', '64', 'China', 'TOEFL', 'DOLORE AMET ET ARCH', NULL, '2026-01-03 06:52:56', '2026-01-03 06:52:56');

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
-- Indexes for table `agent_students`
--
ALTER TABLE `agent_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_of_studies`
--
ALTER TABLE `field_of_studies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `field_o_f_subjects`
--
ALTER TABLE `field_o_f_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `intakes`
--
ALTER TABLE `intakes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `intake_months`
--
ALTER TABLE `intake_months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `program_levels`
--
ALTER TABLE `program_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program_tags`
--
ALTER TABLE `program_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `university_programs`
--
ALTER TABLE `university_programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
