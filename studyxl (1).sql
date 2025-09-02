-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2025 at 02:59 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `email`, `email_verified_at`, `password`, `token`, `remember_token`, `created_at`, `updated_at`, `is_approved`, `status`) VALUES
(1, 'August Vasquez', 'nifaxo@mailinator.com', NULL, '$2y$12$RmVovqBp004fbAag5Eb2Fuf4qKE.iHa7Xivc5ORZ8S.VFpv11NPme', NULL, NULL, '2025-08-29 06:58:08', '2025-08-29 06:58:08', 0, 'active');

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
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(36, '2025_08_29_105953_add_columns_to_agents_table', 2),
(37, '2025_08_22_071116_create_admins_table', 3),
(38, '2025_08_24_063658_create_agents_table', 3),
(39, '2025_08_25_054729_add_is_approved_to_agents_table', 3),
(40, '2025_08_25_062012_add_status_to_agents_table', 3);

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
('jepukocuvo@mailinator.com', '$2y$12$PTkvat31513YHp1.f3JDzeY8dMzdbbXpB5AkXW0gzrR1p3WuGbe8y', '2025-08-27 05:04:05'),
('user@gmail.com', '$2y$12$ZLg5IdjVMEGThUZw88biTu4e6BkwTP2AkxG/JTWOFKvxKpIlHLbJi', '2025-08-22 00:47:34');

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
(1, 'App\\Models\\User', 15, 'auth_token', '20f63172eac6f5901cf7718a2c3d3705b680caa0651b97892af80355225e35cc', '[\"*\"]', NULL, NULL, '2025-08-25 02:32:01', '2025-08-25 02:32:01'),
(2, 'App\\Models\\User', 37, 'auth_token', '0430f679fbaab774200cc306446ade7469bf405d3aee85b2cbfba02c1464f752', '[\"*\"]', NULL, NULL, '2025-08-25 04:36:58', '2025-08-25 04:36:58'),
(3, 'App\\Models\\User', 38, 'auth_token', '018362d8353374b2f166514f41ff95100142798e10a78429dc1b8c4673ed0ba4', '[\"*\"]', NULL, NULL, '2025-08-25 04:38:47', '2025-08-25 04:38:47'),
(4, 'App\\Models\\User', 39, 'auth_token', 'd94634facac6f03d8dea44f2bf76be9621354b7300031cd5a895ff520c420c5d', '[\"*\"]', NULL, NULL, '2025-08-25 04:40:13', '2025-08-25 04:40:13'),
(5, 'App\\Models\\User', 39, 'auth_token', '59edb1bf571f11470a47511262c969afdc287991819d44f0f4e6a0c135346b83', '[\"*\"]', NULL, NULL, '2025-08-25 05:48:44', '2025-08-25 05:48:44'),
(6, 'App\\Models\\User', 39, 'auth_token', '4e2e66f4ca338342d4f601c494b292aeac8930da53c7448f9e01466f798d4bae', '[\"*\"]', NULL, NULL, '2025-08-25 05:48:53', '2025-08-25 05:48:53'),
(7, 'App\\Models\\User', 39, 'auth_token', '04c6adbb85a2fff0683a170e9c7713c0915ffadd1ff9b152b65280cf83671de4', '[\"*\"]', NULL, NULL, '2025-08-25 05:49:06', '2025-08-25 05:49:06'),
(8, 'App\\Models\\User', 39, 'auth_token', '0edc56aa6d907e6eb0f886b257c057805be4b020b7999078ab75c5aed5dbfd3e', '[\"*\"]', NULL, NULL, '2025-08-25 05:49:50', '2025-08-25 05:49:50'),
(9, 'App\\Models\\User', 39, 'auth_token', 'f8b190c0e13630888d557311fb7a87334ff9ccfae262ee6f3aec027a20d24abc', '[\"*\"]', NULL, NULL, '2025-08-25 05:51:15', '2025-08-25 05:51:15'),
(10, 'App\\Models\\User', 39, 'auth_token', '82870d4a074e454950cc88a2ec0c4465a04f42d6e2ae5775e96be7fd50961b67', '[\"*\"]', NULL, NULL, '2025-08-25 05:51:33', '2025-08-25 05:51:33'),
(11, 'App\\Models\\User', 39, 'auth_token', 'c4ec7124cda67dfe4f0f1d4170704cf478b9595fd0d06c1b925e0c3c6500b4c7', '[\"*\"]', NULL, NULL, '2025-08-25 05:51:45', '2025-08-25 05:51:45'),
(12, 'App\\Models\\User', 39, 'auth_token', '34e79abab793d1ab2abd27aa74e3a73d3cee2e12471bea31e98a112b569d82cf', '[\"*\"]', NULL, NULL, '2025-08-25 05:51:55', '2025-08-25 05:51:55'),
(13, 'App\\Models\\User', 39, 'auth_token', '5e28d5cf41d65e015442a159120c6ec0b311a22d5e293fc4ed58188c234a237d', '[\"*\"]', NULL, NULL, '2025-08-25 05:52:06', '2025-08-25 05:52:06'),
(14, 'App\\Models\\User', 39, 'auth_token', '5ba4420977d2a73f6e3d589c0cf0eab2cb1f3c4104ca726ebd2d822dc94532f3', '[\"*\"]', NULL, NULL, '2025-08-25 05:55:59', '2025-08-25 05:55:59'),
(15, 'App\\Models\\User', 39, 'auth_token', 'a44d6223a9d3cba611758dfa318b4b86e9d3662eaf8224d0c41a90000b097517', '[\"*\"]', NULL, NULL, '2025-08-25 05:56:07', '2025-08-25 05:56:07'),
(16, 'App\\Models\\User', 39, 'auth_token', 'd3a6e6644c6dfb1a93c29fd0e594fa03212067dd7627e4e2e5d97c15d8389afb', '[\"*\"]', NULL, NULL, '2025-08-25 05:56:39', '2025-08-25 05:56:39'),
(17, 'App\\Models\\User', 39, 'auth_token', '83b5f0287fb25c8d0cb2dcf227a5f3041455f206ad4cd790e7dce525e72b96d3', '[\"*\"]', NULL, NULL, '2025-08-25 05:59:46', '2025-08-25 05:59:46'),
(18, 'App\\Models\\User', 39, 'auth_token', '816917dd7912905990542a31796e4e3ef9a60e36d9fc472181bd4741378ccf2e', '[\"*\"]', NULL, NULL, '2025-08-25 05:59:56', '2025-08-25 05:59:56'),
(19, 'App\\Models\\User', 39, 'auth_token', '3f707cbec3da228d890ad3b37e3602a2bcf3a10beaa90f06176c90709ff0b32d', '[\"*\"]', NULL, NULL, '2025-08-25 06:00:04', '2025-08-25 06:00:04'),
(20, 'App\\Models\\User', 39, 'auth_token', '1b070afc69cfa08c4cce21ef445cc19609a82fe7fc56aaec38bf9d58a0a467f6', '[\"*\"]', NULL, NULL, '2025-08-25 06:00:25', '2025-08-25 06:00:25'),
(21, 'App\\Models\\User', 39, 'auth_token', 'eeff2d3b4759dbe6cb73e109786b52b3af78f0fee919f069ba145b1d077f5a2c', '[\"*\"]', NULL, NULL, '2025-08-25 06:03:41', '2025-08-25 06:03:41'),
(22, 'App\\Models\\User', 39, 'auth_token', 'f3cd084546a86648274ec2614caa6db5a2f200690f38d0ddbea3338c38b05676', '[\"*\"]', NULL, NULL, '2025-08-25 06:04:56', '2025-08-25 06:04:56'),
(23, 'App\\Models\\User', 39, 'auth_token', '8a3294521376681e9191e2811846fc597fe6f956e4db2c5f7b0fa789277c9133', '[\"*\"]', NULL, NULL, '2025-08-25 06:05:07', '2025-08-25 06:05:07'),
(24, 'App\\Models\\User', 39, 'auth_token', '90733f49dedc48e7a65fe3dd1e2518163a4641ecbb9f653508b307e2cc926a7b', '[\"*\"]', NULL, NULL, '2025-08-25 06:05:14', '2025-08-25 06:05:14'),
(25, 'App\\Models\\User', 39, 'auth_token', 'ec2b089c1900e04ac4cfe96c497d5e68da71f1ca9751ea17b89dfe71e02c23c7', '[\"*\"]', NULL, NULL, '2025-08-25 06:05:28', '2025-08-25 06:05:28'),
(26, 'App\\Models\\User', 39, 'auth_token', '31f79b4615164205ff5f1aecb7262f069e8a4c220addb09517b618684fb7ca4b', '[\"*\"]', NULL, NULL, '2025-08-25 06:05:51', '2025-08-25 06:05:51'),
(27, 'App\\Models\\User', 39, 'auth_token', '1b733865261d27674c3c16c708fef46c29130e9a525c77bd2e7cad98964a1e4b', '[\"*\"]', NULL, NULL, '2025-08-25 06:06:09', '2025-08-25 06:06:09'),
(28, 'App\\Models\\User', 39, 'auth_token', 'f6c7742279cd7fa2dbd0948064b96cd9ed095f9e81324dec7926accc5a889567', '[\"*\"]', NULL, NULL, '2025-08-25 06:07:03', '2025-08-25 06:07:03'),
(29, 'App\\Models\\User', 39, 'auth_token', '4c8f9cf5a10d39dfe47487ef0a36985351c3dc1905dc54feb79a43abc913bc9a', '[\"*\"]', NULL, NULL, '2025-08-25 06:08:56', '2025-08-25 06:08:56'),
(30, 'App\\Models\\User', 39, 'auth_token', 'c0c1a3d2e3742801ef049a9d60c435cd426850bd88c6d1511d223eb35fd64589', '[\"*\"]', NULL, NULL, '2025-08-25 06:12:24', '2025-08-25 06:12:24'),
(31, 'App\\Models\\User', 39, 'auth_token', 'a6d8f228b7787e4fe5c81337b7bb8d8d0a76915b162d5d8be69ca889c3940e3b', '[\"*\"]', NULL, NULL, '2025-08-25 06:12:29', '2025-08-25 06:12:29'),
(32, 'App\\Models\\User', 40, 'auth_token', '0229776c305e81ea56b761e86364cbbe926870c11d4e18da2179b5ef9ce7fa2d', '[\"*\"]', NULL, NULL, '2025-08-26 22:49:27', '2025-08-26 22:49:27'),
(33, 'App\\Models\\User', 41, 'auth_token', '54a1141981321e5625309e33f86ca3cadc2a41094b1a48d0604ce42aaf74e81b', '[\"*\"]', NULL, NULL, '2025-08-26 22:53:46', '2025-08-26 22:53:46'),
(34, 'App\\Models\\User', 41, 'auth_token', 'd3ddad25644cd3dd517b834ed10d0e274db1dedaddf41c5931d8883e73c4c2d0', '[\"*\"]', NULL, NULL, '2025-08-26 22:55:26', '2025-08-26 22:55:26'),
(35, 'App\\Models\\User', 41, 'auth_token', '331589db64cfa0ac2aeae530877a076844a44acdc482ff250c378fc7adf93125', '[\"*\"]', NULL, NULL, '2025-08-26 22:55:42', '2025-08-26 22:55:42'),
(36, 'App\\Models\\User', 41, 'auth_token', 'b04102e11a6fa9e1e5c1199c6c89243ad2069ca3293a00ff4faec91656a03b0a', '[\"*\"]', NULL, NULL, '2025-08-26 22:55:58', '2025-08-26 22:55:58'),
(37, 'App\\Models\\User', 41, 'auth_token', '79f977af7609a7466b7b9ac54830804b600e63c1ab439a7ae543dc980c8364af', '[\"*\"]', NULL, NULL, '2025-08-26 22:56:29', '2025-08-26 22:56:29'),
(38, 'App\\Models\\User', 41, 'auth_token', '3d93c9e71f745cffe6243eff6fa3d15ac96cc0f86581aed0b0e667fe09097d23', '[\"*\"]', NULL, NULL, '2025-08-26 22:56:39', '2025-08-26 22:56:39'),
(39, 'App\\Models\\User', 41, 'auth_token', '982589212fba957bd8132e9b5e0c2af0afa50b11776eae76ded581abb04eee3c', '[\"*\"]', NULL, NULL, '2025-08-26 22:56:44', '2025-08-26 22:56:44'),
(40, 'App\\Models\\User', 41, 'auth_token', 'ed2b98a9cc625461c947255624780208bf5cda6bed83915783d867f72a7d0f8b', '[\"*\"]', NULL, NULL, '2025-08-26 23:02:31', '2025-08-26 23:02:31'),
(41, 'App\\Models\\User', 41, 'auth_token', '2211886c39b752821099256f64b89237a86cc6b4633038fac148fa2def6b74af', '[\"*\"]', NULL, NULL, '2025-08-26 23:03:21', '2025-08-26 23:03:21'),
(42, 'App\\Models\\User', 42, 'auth_token', '1548f6dd587fc0e7444191b20702d8342368663fe7cb439a4a4fe006aff2940e', '[\"*\"]', NULL, NULL, '2025-08-26 23:23:29', '2025-08-26 23:23:29'),
(43, 'App\\Models\\User', 42, 'auth_token', '3919c90f1f6561ebc309c45e31a52afd05e52de7f41217cd5495d3c6cb10c77e', '[\"*\"]', NULL, NULL, '2025-08-27 00:14:42', '2025-08-27 00:14:42'),
(44, 'App\\Models\\User', 42, 'auth_token', '2c200ae34b2e1b4e377d0c102106afe2d3d89cbe22b69b5269a8f5a82ce5a796', '[\"*\"]', NULL, NULL, '2025-08-27 00:14:47', '2025-08-27 00:14:47'),
(45, 'App\\Models\\User', 41, 'auth_token', '65b5f8163d8ae523abfe646a5b680710ffbebf10c701b4f51a0d5e19fc145fe9', '[\"*\"]', NULL, NULL, '2025-08-27 00:43:10', '2025-08-27 00:43:10'),
(46, 'App\\Models\\User', 43, 'auth_token', '3ba89f0e55e2341150b7ff5fa442d2d3ef3a50055003e36091df1d1aa6484293', '[\"*\"]', NULL, NULL, '2025-08-27 00:56:49', '2025-08-27 00:56:49'),
(47, 'App\\Models\\User', 43, 'auth_token', 'cd14e37edca3638bd35e2b3da7f692035759bf6615a7a2d287dd47a1157b5d53', '[\"*\"]', NULL, NULL, '2025-08-27 00:57:02', '2025-08-27 00:57:02'),
(48, 'App\\Models\\User', 43, 'auth_token', 'd73a38803263462860289df672070519c9d650b7859b80136715db68f11bb4e9', '[\"*\"]', NULL, NULL, '2025-08-27 01:18:12', '2025-08-27 01:18:12'),
(49, 'App\\Models\\User', 43, 'auth_token', '660577f4f4bbfbc8282aa52d5c122cd74ebf541905cc9c80347af8f8732c15a7', '[\"*\"]', NULL, NULL, '2025-08-27 01:18:24', '2025-08-27 01:18:24'),
(50, 'App\\Models\\User', 41, 'auth_token', '6d773e3e616fcd6c0ce5d3e97f4dee64425ba7a9cbae5f617bacd18f6bd2be19', '[\"*\"]', NULL, NULL, '2025-08-27 04:42:26', '2025-08-27 04:42:26'),
(51, 'App\\Models\\User', 41, 'auth_token', '15e3cb7afa93c280292cb971867dcd4c3db9379e69d71b295fc4cf4567540fde', '[\"*\"]', NULL, NULL, '2025-08-27 04:42:44', '2025-08-27 04:42:44'),
(52, 'App\\Models\\User', 44, 'auth_token', 'ec15413b4b2eeb97c87830cff288ef8dea8de9bb82b34d4557b5cc72b9a92f1c', '[\"*\"]', NULL, NULL, '2025-08-27 05:31:03', '2025-08-27 05:31:03'),
(53, 'App\\Models\\User', 44, 'auth_token', '70db5873eb880dbdc2449c94dbcb98f1bf31e068cba879b873211da241306fe7', '[\"*\"]', NULL, NULL, '2025-08-27 05:31:19', '2025-08-27 05:31:19'),
(54, 'App\\Models\\User', 44, 'auth_token', '775a378ddff8e76a85ef4640134cdadaaffffd2c7992cab2d44b6b9cbdb10471', '[\"*\"]', NULL, NULL, '2025-08-27 05:33:29', '2025-08-27 05:33:29'),
(55, 'App\\Models\\User', 45, 'auth_token', 'b0d3d6df15e54e48f04d46182d85a8235b62de44773eee37e88b1262d2f6d29c', '[\"*\"]', NULL, NULL, '2025-08-27 23:34:35', '2025-08-27 23:34:35'),
(56, 'App\\Models\\User', 46, 'auth_token', 'eabf5d5cb08e9c8ee9b3137cb6a332b24344951f43488e51eb584da00e74bfa0', '[\"*\"]', NULL, NULL, '2025-08-29 06:22:09', '2025-08-29 06:22:09');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(22, 'xyz', 'xy@g.com', NULL, '$2y$12$8oSW7dkHfP7GAp70Kbwt4e6pi1Xk3odYtUS9CcUar0DB/VuEiseVK', NULL, '2025-08-25 04:01:57', '2025-08-25 04:01:57'),
(23, 'xyz25', 'xy34@g.com', NULL, '$2y$12$SlHVdy8.A2LJzmOzhtrnB.4mNnLQBf4bTEcMcv3kuQlnhOOJcP2nW', NULL, '2025-08-25 04:02:29', '2025-08-25 04:02:29'),
(24, 'xyz54', 'xy54@g.com', NULL, '$2y$12$1RgmBN5y7LKWpFa5ZFg7aeDwT8EvyUVN0vo1KUeNwLbdT3/Hnk0ES', NULL, '2025-08-25 04:06:37', '2025-08-25 04:06:37'),
(25, 'xyz545', 'xy544@g.com', NULL, '$2y$12$dkweGZENAUYhDNtPqAnXUOnAA76zZMXjetQeKgekVOXkm787uYchi', NULL, '2025-08-25 04:07:56', '2025-08-25 04:07:56'),
(26, 'Lucian Lowe', 'rodexyxeq@mailinator.com', NULL, '$2y$12$ffvdwFQVB6xGbzJg0VJqGe/1woiqPDuSxb8LJINCRV2LeP/BkGgLO', NULL, '2025-08-25 04:08:29', '2025-08-25 04:08:29'),
(27, 'Colton Santos', 'cinu@mailinator.com', NULL, '$2y$12$1GTjnleHm/cRyzNufqDupOZ8ZFEtwd1qOo51OxNCIzKlxcNwKUJ0m', NULL, '2025-08-25 04:09:18', '2025-08-25 04:09:18'),
(28, 'Paula Church', 'bevotovol@mailinator.com', NULL, '$2y$12$EPgt5ytd2ptSkwUW.IERI.gq2bvf7FPxe/4OlBvBQhuGGFdRD0RNC', NULL, '2025-08-25 04:09:47', '2025-08-25 04:09:47'),
(29, 'xyz54522', 'xy54422@g.com', NULL, '$2y$12$mxQojPPELn739sAkLTqIhu8.gHyvG/xB6mXTolkTJGU78IujjXoZm', NULL, '2025-08-25 04:10:18', '2025-08-25 04:10:18'),
(30, 'Thane Martinez', 'xypyn@mailinator.com', NULL, '$2y$12$wZpaW3PRRqVGqyCTh7GKRunRh6HE/yg3kKNtRdjLTeiWifAbcugNO', NULL, '2025-08-25 04:11:01', '2025-08-25 04:11:01'),
(31, 'xyz545224', 'xy544224@g.com', NULL, '$2y$12$U4ly8/65rX9epWtB9DvncO6sqUvsFB9BTy2zQfL4J693SL.BWynNm', NULL, '2025-08-25 04:11:24', '2025-08-25 04:11:24'),
(32, 'xyz5452242', 'xy5442224@g.com', NULL, '$2y$12$6vLxOmCzG2jK4oHqKy94lOBhRTUYO5vc4PRSpzhdT4vnDiM91PGVW', NULL, '2025-08-25 04:23:55', '2025-08-25 04:23:55'),
(33, 'xyz54522423', 'xy54422224@g.com', NULL, '$2y$12$IT/l0RIzWdl7foiJRTpm/edOkAb21ToZeWC1jTe16ISjPYNSSCPHm', NULL, '2025-08-25 04:24:33', '2025-08-25 04:24:33'),
(34, 'xyz5452242333', 'xy5442223324@g.com', NULL, '$2y$12$Dn.6.mVIo9Gwc4kpefvWSuaFkzvz5YS64qSnbg.HAQ98Z7gNAetWm', NULL, '2025-08-25 04:25:49', '2025-08-25 04:25:49'),
(35, 'xyz54522423332', 'xy54422233424@g.com', NULL, '$2y$12$H/.tuZM2Az9VsQJU.LZNxuPufcSzKQolBirbMFvyVZGyyuGeZDqv2', NULL, '2025-08-25 04:27:04', '2025-08-25 04:27:04'),
(36, 'xyz549', 'xy594@g.com', NULL, '$2y$12$6.9pZxi8.jPUgQ1IDrSuYOSIUOsytAFbG9XB3he8PcKkMLm0wm5jq', NULL, '2025-08-25 04:33:18', '2025-08-25 04:33:18'),
(37, 'xyz54934', 'xy59334@g.com', NULL, '$2y$12$TUBtKcdUT5L03.fvlGnZmeZP2LBJwxhJBjkL9WQjBg109DxlKeqa2', NULL, '2025-08-25 04:36:52', '2025-08-25 04:36:52'),
(38, 'xyz5493432', 'xy5932334@g.com', NULL, '$2y$12$YM3qkTgLf/ia47033i94weHoHX5LzquW57zMz3nZjfxz91L7dQK.G', NULL, '2025-08-25 04:38:41', '2025-08-25 04:38:41'),
(39, 'Wendy Walter', 'jepukocuvo@mailinator.com', '2025-08-25 05:32:17', '$2y$12$8kYBcML0XHC6.hLyO.3Io.8oHKOPR65xTGf7vtWeayjmkXre5ICCK', 'hfoAjcCvs2tnjRwrNAjHRp82VE4edPZOTOtoAJH93n9vu0hI3YvA02y4AH2u', '2025-08-25 04:40:07', '2025-08-25 07:34:01'),
(40, 'Nasim Arnold', 'dojelunex@mailinator.com', NULL, '$2y$12$aLuZGrYMWbYlzlkS1w2dPOS.x1vfFxj2Ms5SnMInBufjjsEUbVrj6', NULL, '2025-08-26 22:49:10', '2025-08-26 22:49:10'),
(41, 'student', 'student@gmail.com', '2025-08-26 23:04:58', '$2y$12$CzAa19iv.lxQgtEF8s3NOeT0vF.dypKvN81EHw/XMXVV92KAK.6N2', 'mIB15Llf64Iu6jfsrLCuRDjCuxTtozUcOeaA0o9Gave3nRM5t6hFIRy7uexL', '2025-08-26 22:53:38', '2025-08-26 23:07:15'),
(42, 'Alyssa Dorsey', 'vicakywe@mailinator.com', NULL, '$2y$12$WkcNZC6GpNZyivcYDkIo/.NsMuQ6s.rG8xYzs2U.bghq1cbLP.082', NULL, '2025-08-26 23:23:23', '2025-08-26 23:23:23'),
(43, 'samad', 'xyz@g.com', NULL, '$2y$12$.IZztdf0n15OVTf9WPvnl.0njQ1vGGS.LHdph7Tmch81lWGcBP8me', NULL, '2025-08-27 00:56:43', '2025-08-27 00:56:43'),
(44, 'bd', 'bd@gmail.com', NULL, '$2y$12$XX0emJuX5ZgoYN7EE/9FBuTO.vU/GLG6wtlUn7hC1uYTVx35Ojjni', 'GJCgmyHDNv4g9aDlDTGJ726eMsSC9s0iK4TWxHnajFPuA2YOvYiXwvLglxH6', '2025-08-27 05:30:57', '2025-08-27 05:33:14'),
(45, 'bdc', 'bdc@gmail.com', NULL, '$2y$12$RL49duzlgdmFcqsvUNM27uscgKKVuwJRAxKEEXbijcl7nOzV9bnP2', NULL, '2025-08-27 23:34:19', '2025-08-27 23:34:19'),
(46, 'Maggie Cash', 'fehobix@mailinator.com', NULL, '$2y$12$PPW3X/KccWP7VMxMxGRcoO/XU2A8VOP.QzcR.ZY7gKZV8I.XFgXBW', NULL, '2025-08-29 06:21:54', '2025-08-29 06:21:54');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
