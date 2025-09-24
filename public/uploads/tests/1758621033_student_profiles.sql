-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 09:57 AM
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
(1, 22, 'student', 'student2@example.com', 'Canada', 'Master', 'Computer Science', 'Indian', 'A1234567', 'IELTS', '1998-05-20', '123 Main Street, Dhaka, Bangladesh', '+880123456789', 'Male', '2030-05-20', 'Bangladesh', 'MS', 'Fall 2025', 'Artificial Intelligence', '[{\"degree\":\"BSc Computer Science\",\"institution\":\"ABC University\",\"year\":2020,\"cgpa\":\"3.8\"},{\"degree\":\"MSc AI\",\"institution\":\"XYZ University\",\"year\":2022,\"cgpa\":\"4.0\"}]', '[{\"test_name\":\"IELTS\",\"score\":\"7.5\",\"date\":\"2023-01-15\"},{\"test_name\":\"TOEFL\",\"score\":\"100\",\"date\":\"2023-03-10\"}]', '[{\"organization\":\"TechCorp\",\"position\":\"Developer\",\"start_date\":\"2020-06-01\",\"end_date\":\"2022-05-31\",\"description\":\"Developed web applications.\"},{\"organization\":\"AI Labs\",\"position\":\"Researcher\",\"start_date\":\"2022-06-01\",\"end_date\":\"2023-05-31\",\"description\":\"Worked on AI research projects.\"}]', '[{\"name\":\"Dr. John Doe\",\"email\":\"johndoe@example.com\",\"relationship\":\"Professor\",\"phone\":\"+880111111111\"},{\"name\":\"Ms. Jane Smith\",\"email\":\"janesmith@example.com\",\"relationship\":\"Manager\",\"phone\":\"+880222222222\"}]', 'This is my statement of purpose explaining my goals and interests.', 'Dean\'s List 2020, Hackathon Winner 2021', 'uploads/resumes/1758612046_blog2.png', NULL, NULL, NULL, NULL, '2025-09-23 01:20:46', '2025-09-23 01:21:07');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
