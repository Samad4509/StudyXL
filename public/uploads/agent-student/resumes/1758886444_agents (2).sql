-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2025 at 11:13 AM
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
(2, 'Mr', 'Lawrence', 'Love', 'Coleman and Gonzalez Traders', 'Ex duis quis assumen', '+880', '+880+1 (563) 338-1024', 'xaqefa@mailinator.com', 'tocigyxos@mailinator.com', '$2y$12$r0CAFh0qT4M3zCaPcnISjOdvxhGm7./JpcYm7SBl9BS8F6ySlWwBu', 'Deleniti id ipsam om', 'In dolore ut accusan', 'Quos ut ipsum laboru', 'Iusto distinctio Ex', 'In elit ipsum sapi', 'Quidem minima molest', 'Ms', 'Larissa', 'Barber', 'Ut est sunt cumque n', '+880', '+880+1 (318) 143-9527', 'hyqadytudy@mailinator.com', 'Kaitlin Cruz', 'https://www.kexamorypasonyd.co.uk', '1982', '\"[\\\"UK\\\",\\\"USA\\\",\\\"Canada\\\",\\\"Other\\\"]\"', '', 'Id distinctio Corpo', 'Nulla veniam eius q', 'Nobis dolorum non pr', 'Aut non saepe totam ', 'Recusandae Eos pla', NULL, 'Quae distinctio Nob', 'Animi quidem praese', 'Nam id nemo ullamco ', 'Molestias doloremque', 'Minima voluptatem eo', '1976', '47', '92', 'Harum placeat amet', 'Saepe qui occaecat a', 'Et eum quis molestia', 'Mr', 'Austin', 'Castillo', 'Buckley Vincent Co', 'puqiqu@mailinator.com', '+880', '+880+1 (209) 108-1639', 'https://www.volafy.ca', '0', 'inactive', NULL, '2025-09-21 03:12:27', '2025-09-21 03:12:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
