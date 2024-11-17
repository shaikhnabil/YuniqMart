-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 08:16 AM
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
-- Database: `e_commerce`
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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$.mKXwCBhSEjSphxXPRlecu.oV1t2LV9iEpwVxE9PzTgYrjb.sg.Yu', NULL, '2024-08-20 09:41:40', '2024-08-20 09:41:40'),
(2, 'admin1', 'admin1@gmail.com', NULL, '$2y$12$R5Knae.kHSwjDRdUm5ej1OTztEi1wwznc/sBz0f4EkwUWck6Dy85G', NULL, '2024-08-20 09:53:27', '2024-08-20 09:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('5c785c036466adea360111aa28563bfd556b5fba', 'i:2;', 1728306568),
('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1728306568;', 1728306568);

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Electronic', 'electronic', 'categories/electronic-1727939022.jpg', '2024-08-20 06:26:50', '2024-10-03 07:03:42'),
(2, 'Home and Kitchen', 'home-and-kitchen', 'categories/home-and-kitchen-1724135322.jpg', '2024-08-20 06:26:56', '2024-08-20 06:28:42'),
(20, 'Cookware and Bakewaresss', 'cookware-and-bakewaresss', 'categories/cookware-and-bakewaresss-1726836250.webp', '2024-09-20 12:18:07', '2024-09-20 12:44:10'),
(27, 'Menswear', 'menswear', 'categories/menswear-1726895704.png', '2024-09-21 05:14:44', '2024-09-21 05:15:04'),
(29, 'kids wear', 'kids-wear', 'categories/kids-wear-1728305533.png', '2024-09-21 05:15:55', '2024-10-07 12:52:13'),
(31, 'Books', 'books', '', '2024-10-07 12:41:59', '2024-10-07 12:41:59'),
(32, 'Glasses', 'glasses', '', '2024-10-07 12:53:21', '2024-10-07 12:53:21'),
(33, 'Electronics', 'electronics', '', '2024-10-07 12:55:27', '2024-10-07 12:55:27'),
(34, 'test', 'test', '', '2024-10-07 13:08:27', '2024-10-07 13:08:27');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(7, 'default', '{\"uuid\":\"a0e428a1-a7e0-4530-8a6f-50152921186c\",\"displayName\":\"App\\\\Mail\\\\OrderStatusChanged\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\OrderStatusChanged\\\":3:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:1:{i:0;s:4:\\\"user\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:14:\\\"user@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1727849583, 1727849583);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_19_051055_create_categories_table', 1),
(5, '2024_08_19_051304_create_products_table', 1),
(6, '2024_08_19_054909_create_subcategories_table', 1),
(7, '2024_08_19_055030_create_product_subcategory_table', 1),
(8, '2024_08_20_133151_create_admins_table', 2),
(11, '2024_08_23_101512_create_carts_table', 3),
(12, '2024_08_23_102046_create_orders_table', 3),
(14, '2024_08_27_111127_add_order_number_column_to_orders_table', 4),
(17, '2024_10_04_180640_add_offers_field_to_products__table', 5),
(18, '2024_10_08_103657_add_google_id_to_users_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `product_qty`, `product_price`, `created_at`, `updated_at`, `order_number`, `status`) VALUES
(2, 4, 1, 1, 45000, '2024-08-23 08:19:51', '2024-10-01 06:13:10', '', 2),
(3, 4, 2, 1, 5000, '2024-08-23 10:54:01', '2024-10-01 06:36:20', '', 2),
(4, 4, 2, 1, 5000, '2024-08-23 10:54:01', '2024-10-01 06:33:15', '', 1),
(5, 1, 1, 1, 45000, '2024-08-23 10:58:20', '2024-10-01 06:58:04', '', 1),
(6, 1, 3, 2, 10000, '2024-08-23 11:03:52', '2024-10-02 06:13:00', '', 2),
(9, 2, 18, 1, 10000, '2024-08-23 12:53:28', '2024-10-01 06:38:15', '', 5),
(10, 1, 2, 1, 5000, '2024-08-23 12:59:54', '2024-08-23 12:59:54', '', 0),
(11, 1, 2, 1, 5000, '2024-08-23 13:15:57', '2024-08-23 13:15:57', '', 0),
(12, 1, 2, 1, 5000, '2024-08-23 13:15:57', '2024-08-23 13:15:57', '', 0),
(13, 3, 1, 1, 45000, '2024-08-27 04:44:26', '2024-10-01 06:12:13', '', 2),
(15, 3, 3, 1, 10000, '2024-08-27 05:11:41', '2024-08-27 05:11:41', '', 0),
(17, 3, 3, 1, 10000, '2024-08-27 05:11:41', '2024-08-27 05:11:41', '', 0),
(19, 3, 18, 1, 12000, '2024-08-27 05:49:47', '2024-10-01 06:16:41', '', 3),
(24, 1, 15, 1, 2000, '2024-08-27 08:13:31', '2024-08-27 08:13:31', '', 0),
(25, 1, 3, 1, 10000, '2024-08-27 08:13:31', '2024-08-27 08:13:31', '', 0),
(27, 3, 18, 1, 12000, '2024-08-28 08:07:11', '2024-08-28 08:07:11', '', 0);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text DEFAULT NULL,
  `price` int(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `description`, `slug`, `category_id`, `is_active`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Laptop Computer HP', '[\"products\\/laptop-computer-hp-1.jpg\"]', 50000, 'Use browser developer tools to inspect the network request and ensure that the URL being generated is correct and accessible. Check if there are any 404 errors or other issues with the file request.', 'laptop-computer-hp', 1, 0, NULL, '2024-08-20 06:29:41', '2024-10-05 06:57:34', NULL),
(2, 'Mixer Grinder', '[\"products\\/mixer-grinder-1.jpg\",\"products\\/mixer-grinder-2.jpg\",\"products\\/mixer-grinder-3.jpg\"]', 5000, 'Use browser developer tools to inspect the network request and ensure that the URL being generated is correct and accessible. Check if there are any 404 errors or other issues with the file request.', 'mixer-grinder', 2, 0, NULL, '2024-08-20 06:30:11', '2024-10-04 13:38:12', NULL),
(3, 'Automatic Washing Machines', '[\"products\\/washing-machines-1.webp\",\"products\\/washing-machines-2.jpg\"]', 10000, 'Use browser developer tools to inspect the network request and ensure that the URL being generated is correct and accessible. Check if there are any 404 errors or other issues with the file request.', 'automatic-washing-machines', 1, 0, NULL, '2024-08-20 06:30:34', '2024-10-05 06:57:04', NULL),
(11, 'Pan', '[\"products\\/pan-1.webp\"]', 500, 'Nisi ratione quia unde aut consequatur sint. Numquam quisquam odit sint consectetur.', 'pan-2', 2, 0, NULL, '2024-08-21 12:43:41', '2024-09-23 07:30:47', NULL),
(14, 'Oven', '[\"products\\/oven-1.jpg\"]', 10000, 'Oven', 'oven-2', 2, 0, NULL, '2024-08-21 12:55:11', '2024-08-27 05:35:37', NULL),
(15, 'Toaster', '[\"products\\/toaster-1.jpg\"]', 3000, 'Toaster', 'toaster-2', 2, 0, NULL, '2024-08-21 12:56:46', '2024-09-23 07:32:11', NULL),
(18, 'Smart Phone', '[\"products\\/smart-phone-1.jpg\"]', 12000, 'Smart Phone', 'smart-phone', 1, 1, NULL, '2024-08-22 12:05:50', '2024-08-27 05:36:19', NULL),
(25, 'Thor Sawyer', '[\"products\\/thor-sawyer-1.jpg\"]', 55000, 'Lorem nesciunt labo', 'thor-sawyer-2', 1, 0, NULL, '2024-09-23 05:38:54', '2024-09-26 04:55:31', NULL),
(26, 'Xanthus Middleton', '[\"products\\/xanthus-middleton-1.webp\"]', 15000, 'Ad quidem non voluptty', 'xanthus-middleton', 1, 1, NULL, '2024-09-23 05:44:18', '2024-10-05 07:18:11', NULL),
(28, 'Quail Vega', '[\"products\\/quail-vega-1.jpg\"]', 115, 'Earum ut autem facer', 'quail-vega', 1, 0, NULL, '2024-10-07 12:40:48', '2024-10-07 12:40:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategory`
--

CREATE TABLE `product_subcategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `subcategories_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_subcategory`
--

INSERT INTO `product_subcategory` (`id`, `product_id`, `subcategories_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 3, 3, NULL, NULL),
(6, 14, 2, NULL, NULL),
(9, 18, 3, NULL, NULL),
(14, 25, 1, NULL, NULL),
(18, 15, 2, NULL, NULL),
(19, 11, 2, NULL, NULL),
(20, 26, 3, NULL, NULL),
(22, 28, 1, NULL, NULL);

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
('KCDPJMyMbio4QvS9jS5VNamoCXngPctttAtqBb90', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGEzZ20xSTdkNW1uQzJHNmhHV1JaVXBENDNJcWhwb1N3cXdjUzZHSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoL2dvb2dsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6InUycmpOWXdRYjNHQXQ0UTVDWHhBUEI0WmZkaFRMbW4zUHBERUVxaGMiO30=', 1728368105);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `subcategory`, `slug`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Automotive Electronics', 'automotive-electronics', 1, '2024-08-20 06:27:20', '2024-10-07 13:08:57'),
(2, 'Cooking Tool', 'cooking-tool', 2, '2024-08-20 06:27:30', '2024-09-21 11:42:59'),
(3, 'Consumer Electronics', 'consumer-electronics', 1, '2024-08-20 06:28:27', '2024-08-20 06:28:27'),
(10, 'T-shirts', 't-shirts', 27, '2024-09-21 06:12:41', '2024-09-21 06:12:41'),
(14, 'Shoes', 'shoes', 27, '2024-09-21 06:23:32', '2024-09-21 11:43:16'),
(16, 'Oven', 'oven', 20, '2024-09-21 11:22:36', '2024-09-21 11:22:36'),
(17, 'Shoes', 'shoes-2', 29, '2024-09-21 11:43:52', '2024-09-21 11:43:52'),
(18, 'Sports T-shirts', 'sports-t-shirts', 27, '2024-10-02 09:59:46', '2024-10-02 09:59:46'),
(19, 'Track Pants', 'track-pants', 27, '2024-10-04 12:00:02', '2024-10-04 12:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `image`, `gender`, `dob`, `address`, `city`, `state`, `country`, `zipcode`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `google_id`) VALUES
(1, 'user', 'user@gmail.com', '$2y$12$xjqt0uEHBCc6L0hkVwAt2uWSSzn1DvfddGmDGcXUP8VMTKKQT/YOa', '1234567890', 'users/user-1724130871.jpg', 'Male', '2000-03-12', 'Ghogha Circle', 'Bhavnagar', 'Gujarat', 'India', 364002, NULL, 'a9oV7L20QHDvLhTfAA0Mnb77ttizJaO9ou1ty7iZq4ZIRuVbbdJbzUwF2xVD', '2024-08-20 05:14:32', '2024-08-20 07:29:02', NULL, NULL),
(2, 'test', 'test1@gmail.com', '$2y$12$Jl/ZpmlVxfFUtbKZ8BkzSeyU1qgxpMgRR3FPMYeIqtGBsGX4bPrb2', '1234567899', 'users/test-1724135135.jpg', 'Female', '1999-03-02', 'Sarkhej', 'Ahemdabad', 'Gujarat', 'India', 384002, NULL, '4jpsr6seRxILwq3CfbAVUBsXQUS2dHRhrlI4JvbUYpHbFjE3lKXiVW2yXnVa', '2024-08-20 05:17:21', '2024-08-20 06:56:13', NULL, NULL),
(3, 'abc', 'abc@gmail.com', '$2y$12$2YHhO1q2B3YVPm9RdWR.Z.4IyOuLFjWEiAa7rJLlaUyq92rQPu/gi', '1234567892', 'users/abc-1724135189.jpg', 'Male', '2002-12-12', 'Ghogha Circle', 'Bhavnagar', 'Gujarat', 'India', 364001, NULL, '7oZ7LgxC6VCqTWDmOysHr8H0qlIt8PRxTeq5PPQIIbtcRZcxoe2TMfS2Brna', '2024-08-20 06:05:04', '2024-08-20 06:44:29', NULL, NULL),
(4, 'user', 'user1@gmail.com', '$2y$12$XbKJTRvNf.BFPnGPR10JYup.SlMaUlYHbdUabb/rozTS9AJbg8Tiu', '1234567892', 'users/user-1724135106.jpg', 'Male', '2000-03-03', 'Ghogha Circle', 'Bhavnagar', 'Gujarat', 'India', 364002, NULL, NULL, '2024-08-20 06:06:35', '2024-08-20 06:25:06', NULL, NULL);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_subcategory_product_id_foreign` (`product_id`),
  ADD KEY `product_subcategory_subcategories_id_foreign` (`subcategories_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_slug_unique` (`slug`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD CONSTRAINT `product_subcategory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_subcategory_subcategories_id_foreign` FOREIGN KEY (`subcategories_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
