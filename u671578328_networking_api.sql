-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2024 at 02:38 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u671578328_networking_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `companycode` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_codes`
--

CREATE TABLE `email_codes` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transNo` varchar(255) NOT NULL,
  `desc_code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `routes` varchar(255) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `transNo`, `desc_code`, `description`, `icon`, `class`, `routes`, `sort`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1', 'top_navigation', 'Home', 'icon-home', 'class-home', 'home', 1, 'A', NULL, NULL, NULL, NULL),
(2, '2', 'top_navigation', 'System', 'icon-system', 'class-system', '#', 15, 'A', NULL, NULL, NULL, NULL),
(5, '3', 'top_navigation', 'Messaging', 'icon-message', 'icon-class', 'message', 2, 'A', NULL, NULL, NULL, NULL),
(6, '4', 'side_bar', 'Dashboard', '', 'icon-dashboard', 'dashboard', 1, 'A', NULL, NULL, NULL, NULL),
(7, '5', 'top_navigation', 'My Network', 'icon-network', '', 'network', 3, 'A', NULL, NULL, NULL, NULL),
(8, '6', 'top_navigation', 'Notifications', 'icon-notifications', 'class-notifications', 'notifications', 4, 'A', NULL, NULL, NULL, NULL);

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
(5, '2024_11_02_055944_create_resources_table', 1),
(6, '2024_11_02_060040_create_companies_table', 1),
(7, '2024_11_02_060201_create_roles_table', 1),
(8, '2024_11_02_060556_create_menus_table', 1),
(9, '2024_11_02_060737_create_submenus_table', 1),
(10, '2024_11_02_064146_create_roleaccesssubmenus_table', 1),
(11, '2024_11_02_065922_create_roleaccessmenus_table', 1);

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
(1, 'App\\Models\\User', 61, 'Personal Access Token', '7bbeb3b457cd6e89c98f15718d6642b8187a5171117b0469d778398e0bba6474', '[\"*\"]', '2024-11-23 03:06:52', NULL, '2024-11-23 03:06:44', '2024-11-23 03:06:52'),
(2, 'App\\Models\\User', 61, 'Personal Access Token', '4d94bac34137cfcaf7ead5693b0b9eff995446d5b33ba5492eeddbc6dc5a2977', '[\"*\"]', '2024-11-23 03:12:55', NULL, '2024-11-23 03:09:05', '2024-11-23 03:12:55'),
(3, 'App\\Models\\User', 61, 'Personal Access Token', '09f0600a52008fd6fb46bdac9e3db0e438aabe4b129e3c227848e8fcb3d5d250', '[\"*\"]', '2024-11-23 03:16:53', NULL, '2024-11-23 03:15:14', '2024-11-23 03:16:53'),
(4, 'App\\Models\\User', 61, 'Personal Access Token', '4098e85ab3e3161d27dbb79466a48db9a275c7b8a0e821c1fc9827b7c6c487ba', '[\"*\"]', '2024-11-23 06:48:57', NULL, '2024-11-23 03:20:42', '2024-11-23 06:48:57'),
(5, 'App\\Models\\User', 70, 'Personal Access Token', '2e3497c89a5e594d6a4b8d818e144a56748d94539a40341f581f7e5c7edc0b24', '[\"*\"]', '2024-11-23 07:05:00', NULL, '2024-11-23 07:02:43', '2024-11-23 07:05:00'),
(6, 'App\\Models\\User', 70, 'Personal Access Token', '51a6ffa1b90f55c4aafb680b2fe0b7f3d2b0d9c6687d3a28a8f832c131803c46', '[\"*\"]', '2024-11-23 07:13:35', NULL, '2024-11-23 07:12:50', '2024-11-23 07:13:35'),
(7, 'App\\Models\\User', 70, 'Personal Access Token', '56cd5dfef1495ef7fdc81ec85a886c3c28200fcce914dbfcc0b068ca33b39c0d', '[\"*\"]', '2024-11-23 07:20:18', NULL, '2024-11-23 07:20:17', '2024-11-23 07:20:18'),
(8, 'App\\Models\\User', 74, 'Personal Access Token', '10864a70ae1e0dd1b8c5bf948361098cdb7a8b4cd3e537ad074eede8a997f600', '[\"*\"]', '2024-11-25 15:03:29', NULL, '2024-11-25 14:59:58', '2024-11-25 15:03:29'),
(9, 'App\\Models\\User', 74, 'Personal Access Token', '5c82d428454fa7940a5f451cd2e34760d033055fee0d7431c85564fc3e9acda9', '[\"*\"]', '2024-11-25 15:05:11', NULL, '2024-11-25 15:04:39', '2024-11-25 15:05:11'),
(10, 'App\\Models\\User', 74, 'Personal Access Token', 'e364669442f48a61fd3e9519e2ec2ea265486199481a260fa85940b0db0f89dc', '[\"*\"]', '2024-11-25 15:05:40', NULL, '2024-11-25 15:05:39', '2024-11-25 15:05:40'),
(11, 'App\\Models\\User', 74, 'Personal Access Token', '68c1b316eb8b29b3e5de66ed1693c512642dbcf0a41cc5fdf3fdea570c2fff7e', '[\"*\"]', '2024-11-25 15:10:39', NULL, '2024-11-25 15:10:20', '2024-11-25 15:10:39'),
(12, 'App\\Models\\User', 74, 'Personal Access Token', '51f06658ea4be1c4eebb70067f19df0ec8dbff33809629ac1f91c5299f8782c8', '[\"*\"]', '2024-11-25 21:33:58', NULL, '2024-11-25 21:33:53', '2024-11-25 21:33:58'),
(13, 'App\\Models\\User', 74, 'Personal Access Token', '8304a465608f2de20a06f8b7fc929425e2cf9e02a468e6e671951ec495109d22', '[\"*\"]', '2024-11-26 00:12:34', NULL, '2024-11-26 00:12:21', '2024-11-26 00:12:34'),
(14, 'App\\Models\\User', 75, 'Personal Access Token', '5ef6e94a4de6ecf3a6bdb6165f61283ef54c38d0ef3f215201dc0881fa502b36', '[\"*\"]', '2024-11-26 00:33:17', NULL, '2024-11-26 00:29:56', '2024-11-26 00:33:17'),
(15, 'App\\Models\\User', 74, 'Personal Access Token', 'a5c8015083712ca1993b1e64688954d6435fe1c3a24e70e4a785579e2a19ea59', '[\"*\"]', '2024-11-26 00:35:01', NULL, '2024-11-26 00:34:50', '2024-11-26 00:35:01'),
(16, 'App\\Models\\User', 79, 'Personal Access Token', '0c11fbd95f21ca00bc665ab7f9a907833284bc47024106cbac98dde721fbbde2', '[\"*\"]', '2024-11-26 11:44:05', NULL, '2024-11-26 11:43:58', '2024-11-26 11:44:05'),
(17, 'App\\Models\\User', 74, 'Personal Access Token', '474a79cda6e6199074d2d86b3f4fc6902cedcc4bd7bbfbbb20e71df40508f5b7', '[\"*\"]', '2024-11-26 13:52:26', NULL, '2024-11-26 13:52:26', '2024-11-26 13:52:26'),
(18, 'App\\Models\\User', 80, 'Personal Access Token', 'bd27fe6f43014a560f34e3abd4874d58bd676e03771e4ddd5b9372cef24bc82c', '[\"*\"]', '2024-11-26 13:57:08', NULL, '2024-11-26 13:57:01', '2024-11-26 13:57:08'),
(19, 'App\\Models\\User', 80, 'Personal Access Token', 'c382fd562d34d359046ed87e4b220ce0a140b45e4e15692fbbde61e2149c4dbd', '[\"*\"]', '2024-11-26 14:05:41', NULL, '2024-11-26 14:05:23', '2024-11-26 14:05:41'),
(20, 'App\\Models\\User', 81, 'Personal Access Token', '1bf1aef09427196bc4ec3f2f105c7bc2ba2586fee1020add2276f6b14e27ecd6', '[\"*\"]', '2024-11-26 14:07:30', NULL, '2024-11-26 14:07:30', '2024-11-26 14:07:30'),
(21, 'App\\Models\\User', 80, 'Personal Access Token', 'cdadfa1d627909d0a6cff27a4564791c37e8d24f654bfc2036e07f2b5e6d8692', '[\"*\"]', '2024-11-26 15:33:50', NULL, '2024-11-26 15:29:55', '2024-11-26 15:33:50'),
(22, 'App\\Models\\User', 80, 'Personal Access Token', '8c736b9b4ad4b1057e9e12c185e75c26d4b543ec1d39916b71dfb8f569221898', '[\"*\"]', '2024-11-26 15:40:23', NULL, '2024-11-26 15:36:06', '2024-11-26 15:40:23'),
(23, 'App\\Models\\User', 74, 'Personal Access Token', '10c460d15d0f0e6cf4035abf7c38e15baf45cd62a643346f4623a53d77e8f800', '[\"*\"]', '2024-11-26 15:49:19', NULL, '2024-11-26 15:49:18', '2024-11-26 15:49:19'),
(24, 'App\\Models\\User', 87, 'Personal Access Token', 'c43fe619aff0d342bdd107536952d2543a047589619f7ebb756a143bafbf6e28', '[\"*\"]', '2024-11-27 05:58:34', NULL, '2024-11-27 05:58:33', '2024-11-27 05:58:34'),
(25, 'App\\Models\\User', 88, 'Personal Access Token', '3a00a84ff9e9ea436e7840f09f59365e4b1414c3fc5e71777bfc30882bdef979', '[\"*\"]', '2024-11-27 06:03:03', NULL, '2024-11-27 06:03:02', '2024-11-27 06:03:03'),
(26, 'App\\Models\\User', 91, 'Personal Access Token', '73f345570ed20110a73ba068daef1c645ce5d454bb9d9c3bc0f660f8848cdc99', '[\"*\"]', '2024-11-27 13:39:22', NULL, '2024-11-27 13:39:22', '2024-11-27 13:39:22'),
(27, 'App\\Models\\User', 91, 'Personal Access Token', '879b451f3bf95b4b6cdc75162325a0ee2f7d5e4816642cf4446ef18c4b967b08', '[\"*\"]', '2024-11-27 13:52:01', NULL, '2024-11-27 13:50:43', '2024-11-27 13:52:01'),
(28, 'App\\Models\\User', 92, 'Personal Access Token', '350f1450d4cc7f054a8438dfb85160928879cd0f56c05b384fbd0fdc99e7be75', '[\"*\"]', '2024-11-27 14:13:07', NULL, '2024-11-27 14:13:06', '2024-11-27 14:13:07'),
(29, 'App\\Models\\User', 93, 'Personal Access Token', '7b3b0b71bd3a1c8bbe80d08ecf070d6c0fe5a20b692deea68e4fe8a59e89b339', '[\"*\"]', '2024-11-27 14:25:03', NULL, '2024-11-27 14:25:02', '2024-11-27 14:25:03'),
(30, 'App\\Models\\User', 91, 'Personal Access Token', '08dae661c95b55dd1ce76433129e645c4b04c1c2880c900e2f233a6c6e6b2c9c', '[\"*\"]', '2024-11-27 14:26:33', NULL, '2024-11-27 14:26:33', '2024-11-27 14:26:33'),
(31, 'App\\Models\\User', 92, 'Personal Access Token', 'c86d1dba639fdaac7b0992e50274a3afaadaf656b8bdb2f3e8afa497c92b946d', '[\"*\"]', '2024-11-27 15:26:40', NULL, '2024-11-27 14:59:34', '2024-11-27 15:26:40'),
(32, 'App\\Models\\User', 91, 'Personal Access Token', '9d2da656d8136bbe54bb49d7c60248f6aea9d2545a560d62d4e791f96da56ab7', '[\"*\"]', '2024-11-27 15:46:07', NULL, '2024-11-27 15:29:14', '2024-11-27 15:46:07'),
(33, 'App\\Models\\User', 91, 'Personal Access Token', 'db771922337a92389fdd6c1cb197f0e07d8f6c1138a47d0b40b2d97859129776', '[\"*\"]', '2024-11-27 15:46:38', NULL, '2024-11-27 15:46:23', '2024-11-27 15:46:38'),
(34, 'App\\Models\\User', 91, 'Personal Access Token', '25410134b66a30ab0845e9ec17bbfce452edff428b367484c4729e4b71eb4598', '[\"*\"]', '2024-11-27 15:49:42', NULL, '2024-11-27 15:49:42', '2024-11-27 15:49:42'),
(35, 'App\\Models\\User', 92, 'Personal Access Token', 'e3cd47785d8a433b89fc44f5b173df8dca3990ad39dcb968eea2f7b2c757dabc', '[\"*\"]', '2024-11-27 15:56:31', NULL, '2024-11-27 15:56:30', '2024-11-27 15:56:31'),
(36, 'App\\Models\\User', 92, 'Personal Access Token', 'a29571300ff4673e6bad61d773b25da04646e6a150cdbe97af010c11d74257e9', '[\"*\"]', '2024-11-28 00:34:00', NULL, '2024-11-28 00:33:59', '2024-11-28 00:34:00'),
(37, 'App\\Models\\User', 91, 'Personal Access Token', '1aba06bd399b742c8e8ac0b54372ff21ada3275ad910101e85a3a03edcb78c51', '[\"*\"]', '2024-11-28 00:36:50', NULL, '2024-11-28 00:36:44', '2024-11-28 00:36:50'),
(38, 'App\\Models\\User', 94, 'Personal Access Token', 'db909af7ba8848265d74d06f59433f86ce2770154d2f27f735fba70534ef0c18', '[\"*\"]', '2024-11-28 06:54:47', NULL, '2024-11-28 06:48:56', '2024-11-28 06:54:47'),
(39, 'App\\Models\\User', 94, 'Personal Access Token', '2ec061258c9265ed6479b2eb03e1a0f327b344703896f75668f965f7b073c4e9', '[\"*\"]', '2024-11-28 07:01:15', NULL, '2024-11-28 07:01:14', '2024-11-28 07:01:15'),
(40, 'App\\Models\\User', 91, 'Personal Access Token', 'd12633ad867606d7a2b38920bd40f38769c0f702ae76526a037fc245def64404', '[\"*\"]', '2024-11-28 08:48:34', NULL, '2024-11-28 08:48:33', '2024-11-28 08:48:34'),
(41, 'App\\Models\\User', 92, 'Personal Access Token', '09342fb212cfd78c1a43935a58884faa9f38178f35eadc0ecd2e22e8deee2d80', '[\"*\"]', '2024-11-28 14:00:27', NULL, '2024-11-28 13:53:08', '2024-11-28 14:00:27'),
(42, 'App\\Models\\User', 92, 'Personal Access Token', '8007e5a4e271bebf634dda4f3bbbe03069884ea3b9689bb689de1e9c336840de', '[\"*\"]', '2024-11-28 15:18:32', NULL, '2024-11-28 14:01:19', '2024-11-28 15:18:32'),
(43, 'App\\Models\\User', 92, 'Personal Access Token', '9a0a3571ad0306a7efe0c08329651ec8f4af021f460a563c0615e6961e8f4d50', '[\"*\"]', '2024-11-28 15:45:05', NULL, '2024-11-28 15:19:11', '2024-11-28 15:45:05'),
(44, 'App\\Models\\User', 92, 'Personal Access Token', '91046db83e6c04bfb0d1c70969dc11f412e57c910431b33584394b4dad90e698', '[\"*\"]', '2024-11-28 16:26:43', NULL, '2024-11-28 15:46:29', '2024-11-28 16:26:43'),
(45, 'App\\Models\\User', 91, 'Personal Access Token', '6883d555414798de4241bf4a7ed1223591bf2768b009b09ab4302d9a68ee323e', '[\"*\"]', '2024-11-28 16:29:38', NULL, '2024-11-28 16:27:40', '2024-11-28 16:29:38'),
(46, 'App\\Models\\User', 92, 'Personal Access Token', 'e6c86e01e973f639bd4c3023c9fe0848368d510049addba824851698797ca624', '[\"*\"]', '2024-11-28 16:33:36', NULL, '2024-11-28 16:30:04', '2024-11-28 16:33:36'),
(47, 'App\\Models\\User', 92, 'Personal Access Token', 'd9d6af3708c6889103175e646a725062c83ac51f2b6f7d52316979fa2a01489c', '[\"*\"]', NULL, NULL, '2024-11-28 16:47:05', '2024-11-28 16:47:05'),
(48, 'App\\Models\\User', 91, 'Personal Access Token', '9ce99a11ea98478b0fecf611d4db03aefde60c664ba25b2aee4357d84b1bfd64', '[\"*\"]', NULL, NULL, '2024-11-28 16:48:15', '2024-11-28 16:48:15'),
(49, 'App\\Models\\User', 92, 'Personal Access Token', '113ccd87b655730e15e37d36fab04dfdefc66a3b2c77affce84cd98873954697', '[\"*\"]', NULL, NULL, '2024-11-28 16:49:09', '2024-11-28 16:49:09'),
(50, 'App\\Models\\User', 92, 'Personal Access Token', '69bd6593215033829035333967874df5ac3e1ec61b40df62f02ca8a89d0871b3', '[\"*\"]', '2024-11-28 16:50:57', NULL, '2024-11-28 16:50:30', '2024-11-28 16:50:57'),
(51, 'App\\Models\\User', 92, 'Personal Access Token', '2fc688281065341f09ef551b886cb692faa8ae751aed5366318cb876f28377d3', '[\"*\"]', NULL, NULL, '2024-11-28 16:52:07', '2024-11-28 16:52:07'),
(52, 'App\\Models\\User', 92, 'Personal Access Token', 'd176c4549b5f005384a886b9089af0eda2976ef95a6d0a92a7fa1952b0d36dfe', '[\"*\"]', '2024-11-28 16:53:11', NULL, '2024-11-28 16:52:56', '2024-11-28 16:53:11'),
(53, 'App\\Models\\User', 92, 'Personal Access Token', '3700bc0a995fbd56159dd014fb4ab0abe0c22ed841071d39386900d0e5c855a9', '[\"*\"]', '2024-11-28 16:54:03', NULL, '2024-11-28 16:54:03', '2024-11-28 16:54:03'),
(54, 'App\\Models\\User', 91, 'Personal Access Token', 'bcfd8db611fb6c26bbc4a821ac533707eba6d346211ddf7d00c8f41a247b8267', '[\"*\"]', '2024-11-28 16:54:24', NULL, '2024-11-28 16:54:24', '2024-11-28 16:54:24'),
(55, 'App\\Models\\User', 92, 'Personal Access Token', 'ae675d60e18d3ea431296685096ba6b68ff3e9f0a1b14b7b555193d5670340f6', '[\"*\"]', '2024-11-28 16:59:00', NULL, '2024-11-28 16:59:00', '2024-11-28 16:59:00'),
(56, 'App\\Models\\User', 91, 'Personal Access Token', '4e2693eb9c08437d8f51e182794ed61cf1b202e6af0f8926d03b7b15fbc41194', '[\"*\"]', '2024-11-28 17:02:14', NULL, '2024-11-28 17:02:14', '2024-11-28 17:02:14'),
(57, 'App\\Models\\User', 91, 'Personal Access Token', '1a11413d580cf84f8d8b06453dddae1bd87c6c02af8db2e0389086a900cd0f0d', '[\"*\"]', '2024-11-28 17:06:29', NULL, '2024-11-28 17:05:59', '2024-11-28 17:06:29'),
(58, 'App\\Models\\User', 92, 'Personal Access Token', '0a7b039e2bafddf9490e583ba349c3fc5bea46b6b5898fb924d3ebf67d9564b9', '[\"*\"]', '2024-11-28 22:22:04', NULL, '2024-11-28 22:22:04', '2024-11-28 22:22:04'),
(59, 'App\\Models\\User', 92, 'Personal Access Token', 'f4addf3c92ea49c22b7c368db755c7493ba86ee90707afb8d8ab6c8390a5e5e1', '[\"*\"]', '2024-11-28 22:25:09', NULL, '2024-11-28 22:24:39', '2024-11-28 22:25:09'),
(60, 'App\\Models\\User', 92, 'Personal Access Token', '55add391b056201c48525ee685af06fa4cf2943e20b0bb316293a3064a9df058', '[\"*\"]', '2024-11-28 22:33:34', NULL, '2024-11-28 22:33:33', '2024-11-28 22:33:34'),
(61, 'App\\Models\\User', 92, 'Personal Access Token', 'b9be472b44cf37c5386282ecd00bde2e4933fc385e9e5c89b9a27e64cfb74069', '[\"*\"]', '2024-11-29 00:22:23', NULL, '2024-11-29 00:19:52', '2024-11-29 00:22:23'),
(62, 'App\\Models\\User', 95, 'Personal Access Token', '174db91f526d44585598af4f36024936458bc33d90da1e4547c078a35be2c539', '[\"*\"]', '2024-11-29 00:47:06', NULL, '2024-11-29 00:47:04', '2024-11-29 00:47:06'),
(63, 'App\\Models\\User', 96, 'Personal Access Token', '7f9155d0125b51bfd0b7e46339d97d4bdd8952a9efa3c615f5d18bc58164cb11', '[\"*\"]', '2024-11-29 02:38:22', NULL, '2024-11-29 02:21:08', '2024-11-29 02:38:22'),
(64, 'App\\Models\\User', 98, 'Personal Access Token', '10f70efdeb180e3dbd4630b65ec2a47d164d9f39b11bc81028bfdf714c0eb136', '[\"*\"]', '2024-11-29 02:28:58', NULL, '2024-11-29 02:26:46', '2024-11-29 02:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `companywebsite` varchar(255) DEFAULT NULL,
  `role_code` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `h1_fname` varchar(255) DEFAULT NULL,
  `h1_lname` varchar(255) DEFAULT NULL,
  `h1_mname` varchar(255) DEFAULT NULL,
  `h1_fullname` varchar(255) DEFAULT NULL,
  `h1_contact_no` int(11) DEFAULT NULL,
  `h1_email` varchar(255) DEFAULT NULL,
  `h1_address1` varchar(255) DEFAULT NULL,
  `h1_address2` varchar(255) DEFAULT NULL,
  `h1_city` varchar(255) DEFAULT NULL,
  `h1_province` varchar(255) DEFAULT NULL,
  `h1_postal_code` varchar(255) DEFAULT NULL,
  `h1_companycode` varchar(255) DEFAULT NULL,
  `h1_rolecode` int(11) DEFAULT NULL,
  `h1_designation` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `code`, `fname`, `lname`, `mname`, `fullname`, `contact_no`, `age`, `email`, `profession`, `company`, `industry`, `companywebsite`, `role_code`, `designation`, `h1_fname`, `h1_lname`, `h1_mname`, `h1_fullname`, `h1_contact_no`, `h1_email`, `h1_address1`, `h1_address2`, `h1_city`, `h1_province`, `h1_postal_code`, `h1_companycode`, `h1_rolecode`, `h1_designation`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(89, 701, 'Pedro', 'yorpo', '', 'Pedro yorpo', '+639999990909', NULL, 'pedroyorpo17@gmail.com', NULL, 'ABC Company', 'Civil Services (Government, Armed Forces)', 'nexsuz.com', 'DEF-CLIENT', 'position', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-27 13:28:16', '2024-11-27 13:28:16'),
(90, 702, 'Pedro', 'Yorpo', '', 'Pedro Yorpo', '+6392999990909', '1', 'pedroyorpo22@gmail.com', 'programmer', NULL, NULL, NULL, 'DEF-USERS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-27 14:10:49', '2024-11-27 14:10:49'),
(91, 703, 'Elizabeth', 'Punay', '', 'Elizabeth Punay', '+639994589906', '1', 'elizabethpunay01@gmail.com', 'Teacher', NULL, NULL, NULL, 'DEF-USERS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-27 14:18:12', '2024-11-27 14:18:12'),
(93, 705, 'David', 'Dela Cruz', '', 'David Dela Cruz', '+8613061767765', '1', 'dhave.cdc83@gmail.com', 'Recruitment Manager', NULL, NULL, NULL, 'DEF-USERS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-29 00:36:59', '2024-11-29 00:36:59'),
(94, 706, 'Human$', 'Crazy', '', 'Human$ Crazy', '+639453570677', '1', 'reinjunelaride34@gmail.com', 'Developer', NULL, NULL, NULL, 'DEF-MASTERADMIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-29 02:19:50', '2024-11-29 02:19:50'),
(95, 707, 'David', 'Dela Cruz', '', 'David Dela Cruz', '+8613061767765', NULL, 'manpower@hraintl.com', NULL, 'HRA International', 'Human Resources Management/Consultancy', 'hraintl.com', 'DEF-CLIENT', 'Recruitment Manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-29 02:22:55', '2024-11-29 02:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `roleaccessmenus`
--

CREATE TABLE `roleaccessmenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rolecode` varchar(255) NOT NULL,
  `transNo` int(11) NOT NULL,
  `menus_id` int(11) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roleaccessmenus`
--

INSERT INTO `roleaccessmenus` (`id`, `rolecode`, `transNo`, `menus_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'DEF-USERS', 3, 1, 'Pedro Yorpo', 'Pedro Yorpo', NULL, NULL),
(4, 'DEF-USERS', 4, 5, 'Pedro Yorpo', 'Pedro Yorpo', NULL, NULL),
(5, 'DEF-USERS', 5, 7, 'Pedro Yorpo', 'Pedro Yorpo', NULL, NULL),
(6, 'DEF-USERS', 6, 8, 'Pedro Yorpo', 'Pedro Yorpo', NULL, NULL),
(7, 'DEF-CLIENT', 7, 1, 'Pedro Yorpo', 'Pedro Yorpo', NULL, NULL),
(8, 'DEF-CLIENT', 8, 8, 'Pedro Yorpo', 'Pedro Yorpo', NULL, NULL),
(20, 'DEF-MASTERADMIN', 9, 1, NULL, NULL, NULL, NULL),
(21, 'DEF-MASTERADMIN', 10, 2, NULL, NULL, NULL, NULL),
(22, 'DEF-MASTERADMIN', 11, 5, NULL, NULL, NULL, NULL),
(23, 'DEF-MASTERADMIN', 12, 6, NULL, NULL, NULL, NULL),
(24, 'DEF-MASTERADMIN', 13, 7, NULL, NULL, NULL, NULL),
(25, 'DEF-MASTERADMIN', 14, 8, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roleaccesssubmenus`
--

CREATE TABLE `roleaccesssubmenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rolecode` varchar(255) NOT NULL,
  `transNo` int(11) NOT NULL,
  `submenus_id` int(11) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roleaccesssubmenus`
--

INSERT INTO `roleaccesssubmenus` (`id`, `rolecode`, `transNo`, `submenus_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 'DEF-MASTERADMIN', 10, 1, NULL, NULL, NULL, NULL),
(6, 'DEF-MASTERADMIN', 10, 2, NULL, NULL, NULL, NULL),
(7, 'DEF-MASTERADMIN', 10, 3, NULL, NULL, NULL, NULL),
(8, 'DEF-MASTERADMIN', 10, 4, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rolecode` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `rolecode`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'DEF-USERS', 'System User with Access to Standard Features', 'Rj ediral', NULL, '2024-11-08 08:09:29', '2024-11-08 08:09:29'),
(3, 'DEF-MASTERADMIN', 'System Developer with Full Access to All Modules and Features.', 'Rj ediral', 'Pedro Yorpo', '2024-11-12 00:27:35', '2024-11-12 13:53:02'),
(4, 'DEF-SUPERADMIN', 'Top-level Admin with access to manage settings and create admins.', 'Pedro Yorpo', NULL, '2024-11-17 07:18:13', '2024-11-17 07:18:13'),
(5, 'DEF-CLIENT', 'Standard user with access to client-specific features.', 'Pedro Yorpo', NULL, '2024-11-21 13:43:00', '2024-11-21 13:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `submenus`
--

CREATE TABLE `submenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transNo` int(11) NOT NULL,
  `desc_code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `routes` varchar(255) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submenus`
--

INSERT INTO `submenus` (`id`, `transNo`, `desc_code`, `description`, `icon`, `class`, `routes`, `sort`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'top_navigation', 'Security roles', 'icon-security', 'class-security', 'security', 1, 'A', NULL, NULL, NULL, NULL),
(2, 2, 'top_navigation', 'Users', 'icon-user', 'class-user', 'user', 2, 'A', NULL, NULL, NULL, NULL),
(3, 2, 'top_navigation', 'Menus', 'icon-menu', 'class-menu', 'menu', 3, 'A', NULL, NULL, NULL, NULL),
(4, 2, 'top_navigation', 'Roles', 'icon-role', 'class-role', 'role', 4, 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'I',
  `company` varchar(255) DEFAULT NULL,
  `code` int(11) NOT NULL,
  `role_code` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `mname`, `contactno`, `fullname`, `email`, `email_verified_at`, `password`, `status`, `company`, `code`, `role_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(91, 'Pedro', 'yorpo', '', '+639999990909', 'Pedro yorpo', 'pedroyorpo17@gmail.com', NULL, '$2y$10$kmqaXBsn5a0.02NPI9V3iu3mT1ByNjEb8nmEe8ia//uF2Q7xMKMri', 'A', NULL, 701, 'DEF-CLIENT', NULL, '2024-11-27 13:28:16', '2024-11-27 13:38:12'),
(92, 'Pedro', 'Yorpo', '', '+6392999990909', 'Pedro Yorpo', 'pedroyorpo22@gmail.com', NULL, '$2y$10$llcrc7MelFMCJH7yTJC9ZuW0vB3bcWGJCc0SbcomhDb4RtX35WtWC', 'A', NULL, 702, 'DEF-USERS', NULL, '2024-11-27 14:10:49', '2024-11-27 14:12:56'),
(93, 'Elizabeth', 'Punay', '', '+639994589906', 'Elizabeth Punay', 'elizabethpunay01@gmail.com', NULL, '$2y$10$MzreSiaSxt4Af8wr3Ejvg.pbrEXUyoyZDYrEK2I2Ff47imafg7XC6', 'A', NULL, 703, 'DEF-USERS', NULL, '2024-11-27 14:18:12', '2024-11-27 14:24:20'),
(95, 'David', 'Dela Cruz', '', '+8613061767765', 'David Dela Cruz', 'dhave.cdc83@gmail.com', NULL, '$2y$10$jHm96v.Ipdp819//DRuan.jvMsvrLkHNUv3cG4ymrQ8nLU6ANc1sK', 'A', NULL, 705, 'DEF-USERS', NULL, '2024-11-29 00:36:59', '2024-11-29 00:46:20'),
(96, 'Human$', 'Crazy', '', '+639453570677', 'Human$ Crazy', 'reinjunelaride34@gmail.com', NULL, '$2y$10$foAUSQJC0tJOP3mFuXvN4u44hFF8GAGV4qrOR2It07iBedtbMFXPi', 'A', NULL, 706, 'DEF-MASTERADMIN', NULL, '2024-11-29 02:19:50', '2024-11-29 02:20:24'),
(98, 'David', 'Dela Cruz', '', '+8613061767765', 'David Dela Cruz', 'manpower@hraintl.com', NULL, '$2y$10$SQWTaMK8YwMiscLKsX8sGOOKLzNxnlvqiVfylGEOocmdr/D4H4MQ6', 'A', NULL, 707, 'DEF-CLIENT', NULL, '2024-11-29 02:22:55', '2024-11-29 02:25:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_codes`
--
ALTER TABLE `email_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resources_code_unique` (`code`),
  ADD UNIQUE KEY `resources_email_unique` (`email`),
  ADD UNIQUE KEY `resources_h1_email_unique` (`h1_email`);

--
-- Indexes for table `roleaccessmenus`
--
ALTER TABLE `roleaccessmenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roleaccesssubmenus`
--
ALTER TABLE `roleaccesssubmenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenus`
--
ALTER TABLE `submenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_codes`
--
ALTER TABLE `email_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `roleaccessmenus`
--
ALTER TABLE `roleaccessmenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roleaccesssubmenus`
--
ALTER TABLE `roleaccesssubmenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
