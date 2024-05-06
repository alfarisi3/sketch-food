-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2024 at 07:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sketch_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `picture`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '1714029893-2080140647-art3.jpg', 'About', 'Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'show', '2024-04-25 00:24:53', '2024-05-04 10:23:12'),
(2, '1714029941-1587188042-back-kor3.jpg', 'Lokasi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'show', '2024-04-25 00:25:41', '2024-05-04 10:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `picture`, `bank_account_number`, `account_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mandiri', '1714030060-1618480381-mandiri_icon.png', '088888889898989', 'Sketch Food', 'show', '2024-04-25 00:27:40', '2024-04-25 00:27:40'),
(2, 'Dana', '1714030084-333060446-dana.png', '08997877877', 'Sketch Food', 'show', '2024-04-25 00:28:04', '2024-04-25 00:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `desserts`
--

CREATE TABLE `desserts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desserts`
--

INSERT INTO `desserts` (`id`, `picture`, `title`, `slug`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
('9be3e101-eed5-4e3d-828b-771277bea968', '1714030348-671592481-dessert4.jpg', 'Choco Oreo seulbing', 'choco-oreo-seulbing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 20000, 'show', '2024-04-25 00:32:28', '2024-05-04 09:31:50'),
('9be3e198-2cff-4759-9a65-5a905b9d1220', '1714030447-635479968-dessert3.jpg', 'Almond Vanilla seulbing', 'almond-vanilla-seulbing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 19000, 'show', '2024-04-25 00:34:07', '2024-05-04 09:31:22'),
('9bf9c045-8d73-4831-b409-1e35c110fef2', '1714969749-314257882-dessert3.jpg', 'Caramel pudding', 'caramel-pudding', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 20000, 'show', '2024-05-05 21:29:09', '2024-05-05 21:29:09'),
('9bf9c085-243f-43de-b5ba-b20e349a2346', '1714969791-931862894-dessert4.jpg', 'Patbingsu', 'patbingsu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 30000, 'show', '2024-05-05 21:29:51', '2024-05-05 21:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `picture`, `title`, `slug`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
('9be3e0ad-186f-4aa2-839d-98d2e8c35961', '1714030293-847922482-drink2.jpg', 'Coca Cola', 'coca-cola', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 20000, 'show', '2024-04-25 00:31:33', '2024-05-04 09:30:17'),
('9be3e0d5-03b5-4538-9e40-4bac5d4757ef', '1714030319-495254385-drink3.jpg', 'Chilsung', 'chilsung', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 30000, 'show', '2024-04-25 00:31:59', '2024-05-04 09:29:49'),
('9bf9a8d3-ad30-4eee-8977-b051b10615aa', '1714965816-149583363-drink1.jpg', 'Caramel pudding', 'caramel-pudding', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 400000, 'show', '2024-05-05 20:23:36', '2024-05-05 20:23:36'),
('9bf9a916-73b5-4752-a6c0-b88977828fd0', '1714965859-1645513899-drink4.jpg', 'Sprite', 'sprite', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 25000, 'show', '2024-05-05 20:24:19', '2024-05-05 20:24:19'),
('9bf9bfb9-d657-4cc7-a214-05cbb68e2504', '1714969657-144187810-drink2.jpg', 'Barley tea', 'barley-tea', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 15000, 'show', '2024-05-05 21:27:37', '2024-05-05 21:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `picture`, `title`, `slug`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
('9be3dddb-5ca0-4937-bd31-9cd61546367f', '1714965523-396394150-food2.jpg', 'Kimchi Jiggae', 'kimchi-jiggae', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 100000, 'show', '2024-04-25 00:23:40', '2024-05-05 20:18:43'),
('9be3de13-63fc-47e1-9b47-6092b3c6a9eb', '1714965490-736521439-food1.jpg', 'Sundubu Jiggae', 'sundubu-jiggae', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 50000, 'show', '2024-04-25 00:24:16', '2024-05-05 20:18:10'),
('9bf9a754-107a-49d6-b8b7-24b87530a2a3', '1714965562-1351501788-food3.jpg', 'Bulgogi Bap', 'bulgogi-bap', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 40000, 'show', '2024-05-05 20:19:25', '2024-05-05 20:19:25'),
('9bf9a788-ec5c-450b-8f16-45a931e3f23b', '1714965599-1065368712-food4.jpg', 'Gukbap', 'gukbap', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 400000, 'show', '2024-05-05 20:19:59', '2024-05-05 20:19:59'),
('9bf9a887-2a30-4add-b637-2fb1ad72295f', '1714965765-611044527-food5.jpg', 'Dakgalbi', 'dakgalbi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 500000, 'show', '2024-05-05 20:22:45', '2024-05-05 20:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_2nd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_3rd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_2nd` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_2nd` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `heroes`
--

INSERT INTO `heroes` (`id`, `picture`, `picture_2nd`, `picture_3rd`, `title`, `title_2nd`, `description`, `description_2nd`, `status`, `created_at`, `updated_at`) VALUES
(1, '1714029781-695366844-back2.jpg', '1714029781-338391156-back3.jpg', '1714029781-41232053-art2.jpg', '<p>Tuang Ekspresimu<br />di Sketch Food.</p>', '<p>Lengkapi harimu<br />dengan makanan korea.</p>', '<p>Nikmat makanan Korea ditemani seni yang memanjakan mata.</p>', '<p>Dengan menggambar, makanan pun lebih enak dinikmati.</p>', 'show', '2024-04-25 00:23:01', '2024-05-05 23:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `imagems`
--

CREATE TABLE `imagems` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('makanan','minuman','cemilan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imagems`
--

INSERT INTO `imagems` (`id`, `picture`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '1714598445-459358570-food3.jpg', 'makanan', 'hide', '2024-05-01 14:20:45', '2024-05-01 14:56:13'),
(4, '1714598609-1412696969-drink2.jpg', 'minuman', 'hide', '2024-05-01 14:23:29', '2024-05-01 14:56:32'),
(5, '1714600518-2111106472-dessert1.jpg', 'cemilan', 'show', '2024-05-01 14:55:18', '2024-05-01 14:55:18'),
(6, '1714600562-259345550-drink4.jpg', 'minuman', 'show', '2024-05-01 14:56:02', '2024-05-01 14:56:02'),
(7, '1714600622-681842928-food5.jpg', 'makanan', 'show', '2024-05-01 14:57:02', '2024-05-01 14:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2019_08_19_000000_create_failed_jobs_table', 1),
(19, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(20, '2024_04_22_151005_create_heroes_table', 1),
(21, '2024_04_22_155756_create_drinks_table', 1),
(22, '2024_04_22_162359_create_food_table', 1),
(23, '2024_04_22_163436_create_desserts_table', 1),
(24, '2024_04_23_034300_create_quotes_table', 1),
(25, '2024_04_24_060157_create_abouts_table', 1),
(26, '2024_04_24_070815_create_tables_table', 1),
(27, '2024_04_24_072401_create_banks_table', 1),
(28, '2024_04_25_044928_create_reservations_table', 1),
(29, '2024_05_01_200024_create_image_menus_table', 2),
(30, '2024_05_01_205912_create_imagems_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint UNSIGNED NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembagi` enum('quote 1','quote 2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `picture`, `title`, `description`, `pembagi`, `status`, `created_at`, `updated_at`) VALUES
(4, '1714758749-1656829428-art1.jpg', '`Michael Palin`', '\"Saya bukan juru masak yang hebat, saya bukan seniman hebat, tapi saya suka seni, dan saya suka makanan. Jadi, saya adalah penjelajah yang sempurna.\"', 'quote 1', 'show', '2024-05-03 10:52:29', '2024-05-03 21:19:29'),
(5, '1714759347-1575925562-back3.jpg', '\'Michael palin\'', '\"Saya bukan juru masak yang hebat, saya bukan seniman hebat, tapi saya suka seni, dan saya suka makanan. Jadi, saya adalah penjelajah yang sempurna.\"', 'quote 2', 'show', '2024-05-03 11:02:27', '2024-05-03 21:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `table_id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` time NOT NULL,
  `date` timestamp NOT NULL,
  `status` enum('sudah bayar','belum bayar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `table_id`, `name`, `phone`, `email`, `time`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Istiyaa', '0889808', 'diwd03268@gmail.com', '17:15:00', '2024-04-30 17:00:00', 'sudah bayar', '2024-04-29 01:14:17', '2024-04-29 01:21:37'),
(2, 1, 1, 'Istiyaa', '08992833333', 'user1@telnest.com', '17:25:00', '2024-05-01 17:00:00', 'belum bayar', '2024-05-01 07:04:51', '2024-05-01 07:04:51'),
(4, 1, 1, 'asdasdasd', '08992833366', 'wewaeawew@gmail.com', '17:31:00', '2024-05-09 17:00:00', 'sudah bayar', '2024-05-01 20:26:19', '2024-05-02 02:03:22'),
(17, 5, 1, 'Yuvia', '08992888888', 'diwd03268@gmail.com', '08:39:00', '2024-05-15 17:00:00', 'sudah bayar', '2024-05-05 23:39:16', '2024-05-05 23:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_meja` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `title`, `description`, `total_meja`, `created_at`, `updated_at`) VALUES
(1, 'Meja 1-2', '<p>untuk 1 sampai 2 orang</p>', 10, '2024-04-25 00:28:33', '2024-04-25 00:28:33'),
(2, 'meja 3-6', '<p>untuk meja 3 sampai 6 orang</p>', 4, '2024-04-25 00:28:56', '2024-04-28 19:06:51'),
(3, 'Meja 7-12', '<p>untuk 7 sampai 12 orang</p>', 5, '2024-04-25 00:29:24', '2024-04-28 19:07:00'),
(4, 'Meja leseh 1-2', '<p>meja khusus leseh untuk 1-2 orang</p>', 2, '2024-04-28 19:06:30', '2024-05-02 02:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin ', '08123456789', 'admin@sketchfood.com', NULL, '$2y$12$2F87WVZ6Hr1wGdVWE5fQMOqdpymn7Xwr1yWWIiebVxowC1BjNq5Xi', 1, NULL, NULL, NULL),
(2, 'User Biasa', '0812345678', 'user@sketchfood.com', NULL, '$2y$12$Ofo3ENIf7x7J8v1yxoh7luCbpHldXyVErVLrxaSIHvIJrbonp30WO', 0, NULL, NULL, NULL),
(3, 'Istiyaa', '089928333009', 'istong@sketchfood.com', NULL, '$2y$12$7QK07FaRmxNkOx00m/hf.edgZpqnG/nyeSgHg3dUa3GTfL3mu.adi', 0, NULL, '2024-04-27 21:16:33', '2024-04-27 21:16:33'),
(4, 'Yuvia', '08992833366', 'user1@telnest.com', NULL, '$2y$12$rpO43K5RXbFoydr9/HqOa.qXZNPPDh1qTX71ycTlsmW.sKZSPji5O', 0, NULL, '2024-05-02 02:12:11', '2024-05-02 02:12:11'),
(5, 'Faris', '08997877665', 'faris@sketchfood.com', NULL, '$2y$12$bNrUPTQM8f5Js3WQpqkG1eNbVrboFdDoCbgFT9RzByNwHHyA0hB0i', 0, NULL, '2024-05-05 23:34:05', '2024-05-05 23:34:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desserts`
--
ALTER TABLE `desserts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desserts_slug_unique` (`slug`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drinks_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `food_slug_unique` (`slug`);

--
-- Indexes for table `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagems`
--
ALTER TABLE `imagems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imagems`
--
ALTER TABLE `imagems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
