-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 05:19 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mineditse_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_phone` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_address`, `admin_phone`) VALUES
(21, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bales`
--

CREATE TABLE `bales` (
  `bale_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `bale_quantity` int(10) UNSIGNED NOT NULL,
  `bale_price` decimal(10,2) NOT NULL,
  `bale_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bale_order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bales`
--

INSERT INTO `bales` (`bale_id`, `category_id`, `supplier_id`, `bale_quantity`, `bale_price`, `bale_description`, `bale_order_date`) VALUES
(1, 1, 1, 211, '8000.00', NULL, '2023-01-07 16:00:00'),
(2, 2, 1, 161, '10000.00', NULL, '2023-01-07 16:00:00'),
(3, 3, 1, 225, '7000.00', NULL, '2023-01-07 16:00:00'),
(4, 4, 1, 110, '8000.00', NULL, '2023-01-07 16:00:00'),
(5, 5, 1, 98, '4000.00', NULL, '2023-01-07 16:00:00'),
(6, 6, 1, 91, '5000.00', NULL, '2023-01-07 16:00:00'),
(7, 7, 1, 50, '6000.00', NULL, '2023-01-07 16:00:00'),
(8, 8, 1, 101, '4800.00', NULL, '2023-01-07 16:00:00'),
(9, 9, 1, 120, '6000.00', 'Men\'s Shorts', '2023-01-07 16:00:00'),
(10, 9, 1, 200, '7500.00', 'Garterized Shorts', '2023-01-07 16:00:00'),
(11, 10, 1, 86, '4000.00', 'Mixed Tattered Jeans', '2023-01-07 16:00:00'),
(12, 5, 1, 288, '7000.00', 'Jayde Assorted (Hair Claim - Fish Tail, Colorful, Plain Gold)', '2023-01-07 16:00:00'),
(13, 7, 1, 50, '3900.00', NULL, '2023-01-07 16:00:00'),
(14, 1, 1, 192, '9500.00', 'Men\'s Tshirts', '2023-01-07 16:00:00'),
(15, 12, 1, 231, '8500.00', NULL, '2023-01-07 16:00:00'),
(16, 13, 1, 5, '1200.00', NULL, '2023-01-07 16:00:00'),
(17, 14, 1, 20, '8500.00', NULL, '2023-01-31 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `card_id` int(10) UNSIGNED NOT NULL,
  `prod_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`card_id`, `prod_id`, `user_id`, `created_at`, `updated_at`) VALUES
(38, 6, 1, '2023-01-29 12:51:04', '2023-01-29 12:51:04'),
(39, 7, 1, '2023-01-29 12:51:07', '2023-01-29 12:51:07'),
(40, 4, 1, '2023-01-29 12:51:11', '2023-01-29 12:51:11'),
(87, 8, 33, '2023-02-10 22:30:30', '2023-02-10 22:30:30'),
(103, 11, 35, '2023-02-11 15:18:52', '2023-02-11 15:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_other_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `category_other_details`) VALUES
(1, 'TShirts', NULL, NULL),
(2, 'Dresses', NULL, NULL),
(3, 'Blouses', NULL, NULL),
(4, 'Hoody', NULL, NULL),
(5, 'Assorted', NULL, NULL),
(6, 'Bra', NULL, NULL),
(7, 'Bags', NULL, NULL),
(8, 'Wallet', NULL, NULL),
(9, 'Shorts', NULL, NULL),
(10, 'Jeans', NULL, NULL),
(11, 'Hair Claim', NULL, NULL),
(12, 'Fashion Tops', NULL, NULL),
(13, 'Jackets', NULL, NULL),
(14, 'Another Category', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(10) UNSIGNED NOT NULL,
  `cust_street` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_barangay` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `cust_registered_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_street`, `cust_barangay`, `cust_city`, `cust_province`, `cust_type`, `cust_registered_date`) VALUES
(1, 'C De Jesus', 'Corazon', 'Calumpit', 'Bulacan', 'NEW', '2023-01-08 11:53:45'),
(4, 'Sta Cruz', 'Sto Nino', 'Baliuag', 'Bulacan', 'BOGUS', '2023-01-08 12:01:40'),
(33, 'Abante', 'Baye-Baye', 'Jamindan', 'Capiz', 'NEW', '2023-02-11 06:29:37'),
(34, 'Kalye Mabini', 'De Los Santos', 'Baliwag', 'Bulacan', 'NEW', '2023-02-11 12:39:38'),
(35, 'C De Jesus', 'Sto Cristo', 'Baliwag', 'Bulacan', 'NEW', '2023-02-11 15:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_05_120443_create_suppliers_table', 1),
(6, '2023_01_05_124806_create_categories_table', 1),
(7, '2023_01_05_154846_create_bales_table', 1),
(8, '2023_01_05_172009_create_customers_table', 1),
(9, '2023_01_06_144605_create_products_table', 1),
(10, '2023_01_07_201332_create_admins_table', 1),
(11, '2023_01_07_202114_create_staff_table', 1),
(12, '2023_01_07_202814_create_orders_table', 1),
(13, '2023_01_07_210344_create_order_status_table', 1),
(14, '2023_01_07_211303_create_order_detail_table', 1),
(15, '2023_01_07_211950_create_payment_table', 1),
(17, '2023_01_27_121109_add_prod_qr_code_to_products_table', 2),
(18, '2023_01_27_142611_add_status_and_deleted_on_products', 2),
(20, '2023_01_29_032709_create_carts_table', 3),
(21, '2023_01_29_044201_add_prod_id_to_carts', 4),
(22, '2023_01_29_064156_add_prod_name_to_carts', 5),
(23, '2023_02_08_155503_remove_columns_from_cart', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `cust_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_shipping_fee` decimal(10,2) NOT NULL,
  `order_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_cash` decimal(10,2) NOT NULL,
  `payment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_date` timestamp NULL DEFAULT NULL,
  `completed_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `staff_id`, `order_total`, `order_shipping_fee`, `order_method`, `order_status`, `payment_method`, `payment_cash`, `payment_status`, `order_details`, `order_date`, `payment_date`, `completed_date`) VALUES
(1, 1, 21, '450.00', '0.00', 'Pick-Up', 'Cancelled', 'Cash', '0.00', 'Pending', NULL, '2023-02-10 19:44:41', '2023-02-10 23:00:57', NULL),
(2, 1, 21, '420.00', '0.00', 'Pick-Up', 'Completed', 'Cash', '420.00', 'Received', NULL, '2023-02-10 19:56:15', '2023-02-10 23:00:57', '2023-02-12 04:04:30'),
(3, 33, 21, '130.00', '600.00', 'Delivery', 'For Delivery', 'Gcash', '1000.00', 'Received', NULL, '2023-02-11 06:33:19', '2023-02-10 23:00:57', NULL),
(4, 33, 21, '380.00', '0.00', 'Pick-Up', 'For Pick-Up', 'Cash', '1000.00', 'Received', NULL, '2023-02-11 06:57:54', '2023-02-10 23:00:57', NULL),
(5, 33, 21, '430.00', '122.00', 'Delivery', 'For Delivery', 'Gcash', '600.00', 'Received', NULL, '2023-02-11 07:22:01', '2023-02-11 13:04:50', NULL),
(6, 35, 21, '25320.00', '90.00', 'Delivery', 'For Delivery', 'Cash', '30000.00', 'Received', NULL, '2023-02-11 15:33:10', '2023-02-11 15:34:19', NULL),
(7, 4, 21, '130.00', '50.00', 'Delivery', 'For Delivery', 'Cash', '0.00', 'Pending', NULL, '2023-02-11 15:52:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `prod_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `prod_id`) VALUES
(1, 1, 1),
(2, 1, 8),
(3, 1, 9),
(4, 2, 6),
(5, 2, 4),
(6, 2, 10),
(7, 3, 1),
(8, 4, 2),
(9, 4, 5),
(10, 4, 7),
(11, 5, 8),
(12, 5, 13),
(13, 5, 17),
(14, 6, 9),
(15, 6, 113),
(16, 6, 21),
(17, 7, 11);

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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `payment_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_details` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(10) UNSIGNED NOT NULL,
  `prod_qr_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bale_id` int(10) UNSIGNED NOT NULL,
  `prod_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/storage/images/product.png',
  `prod_desc` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `prod_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `prod_other_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_qr_code`, `bale_id`, `prod_name`, `prod_img_path`, `prod_desc`, `prod_unit`, `prod_price`, `prod_status`, `prod_deleted`, `prod_other_details`, `prod_last_updated`) VALUES
(1, 'htauzt33m', 1, 'Mine Brown', '/storage/images/products/htauzt33m_Mine Brown', 'Jeyym Santos', 'pc', '130.00', 'Sold', 1, 'Gandarra', '2023-01-08 13:04:48'),
(2, 'giaytu4te', 3, 'Mine Maroon', '/storage/images/products/giaytu4te_Mine Maroon', NULL, 'pc', '110.00', 'Sold', 0, NULL, '2023-01-08 13:22:03'),
(4, '2y8p74g4s', 3, 'Mine Blue', '/storage/images/products/2y8p74g4s_Mine Blue', NULL, 'pc', '120.00', 'Sold', 0, NULL, '2023-01-08 13:32:07'),
(5, 'la27fi6p9', 16, 'Mine Miss Minchin', '/storage/images/products/la27fi6p9_Mine Miss Minchin', NULL, 'pc', '130.00', 'Sold', 0, NULL, '2023-01-08 13:35:30'),
(6, '65dfi2dld', 3, 'Mine Grey', '/storage/images/products/65dfi2dld_Mine Grey', NULL, 'pc', '150.00', 'Sold', 0, NULL, '2023-01-08 13:45:28'),
(7, '4tklgd8eq', 3, 'Mine White', '/storage/images/products/4tklgd8eq_Mine White', NULL, 'pc', '140.00', 'Sold', 0, NULL, '2023-01-08 13:46:59'),
(8, '9qcj7m03k', 1, 'Mine Horse', '/storage/images/products/9qcj7m03k_Mine Horse', NULL, 'pc', '150.00', 'Sold', 0, NULL, '2023-01-08 13:54:08'),
(9, 'chl9q524x', 1, 'Mine Star', '/storage/images/products/chl9q524x_Mine Star', NULL, 'pc', '170.00', 'Sold', 0, NULL, '2023-01-08 13:54:37'),
(10, 'ok20j1kzg', 1, 'Mine Never Enough', '/storage/images/products/ok20j1kzg_Mine Never Enough', NULL, 'pc', '150.00', 'Sold', 0, NULL, '2023-01-08 13:55:00'),
(11, 'lee3ya4yf', 1, 'Mine Girl', '/storage/images/products/lee3ya4yf_Mine Girl', NULL, 'pc', '130.00', 'Sold', 0, NULL, '2023-01-08 13:55:35'),
(12, 'jjeknlwhp', 1, 'Mine Rose', '/storage/images/products/jjeknlwhp_Mine Rose', NULL, 'pc', '150.00', 'Available', 0, NULL, '2023-01-08 13:56:26'),
(13, 'tq0eozz9v', 1, 'Mine Mickey', '/storage/images/products/tq0eozz9v_Mine Mickey', NULL, 'pc', '130.00', 'Sold', 0, NULL, '2023-01-08 13:57:18'),
(14, 'p4x39lskb', 12, 'Mine Love Spell', '/storage/images/product.png', NULL, 'pc', '150.00', 'Available', 0, NULL, '2023-01-08 13:57:40'),
(15, 'q8jnjsvnb', 2, 'Mine Heart', '/storage/images/product.png', NULL, 'pc', '160.00', 'Available', 0, NULL, '2023-01-08 13:59:31'),
(16, '3z9wknxsz', 2, 'Mine Black White', '/storage/images/product.png', NULL, 'pc', '130.00', 'Available', 0, NULL, '2023-01-08 14:05:30'),
(17, 'r23a5p8t4', 12, 'mine dark kiss', '/storage/images/product.png', NULL, 'pc', '150.00', 'Sold', 0, NULL, '2023-01-08 14:05:31'),
(18, 'doj8xgtt1', 2, 'Mine Polka', '/storage/images/product.png', NULL, 'pc', '180.00', 'Available', 0, NULL, '2023-01-08 14:05:53'),
(19, '7hsrtq78q', 2, 'Mine Ethnic', '/storage/images/product.png', NULL, 'pc', '140.00', 'Available', 0, NULL, '2023-01-08 14:06:16'),
(20, 'i80r01hvj', 12, 'mine ls shimmer', '/storage/images/product.png', NULL, 'pc', '150.00', 'Available', 0, NULL, '2023-01-08 14:06:24'),
(21, 's6vjkrc8m', 2, 'Mine Red', '/storage/images/product.png', NULL, 'pc', '150.00', 'Sold', 0, NULL, '2023-01-08 14:06:40'),
(22, '6zn3sbsgb', 2, 'Mine Silknet', '/storage/images/product.png', NULL, 'pc', '180.00', 'Available', 0, NULL, '2023-01-08 14:07:11'),
(23, 'km0c3kn0u', 12, 'mine Vs pure', '/storage/images/product.png', NULL, 'pc', '150.00', 'Available', 0, NULL, '2023-01-08 14:07:16'),
(24, 'kyv1b7bxr', 2, 'Mine Offshie', '/storage/images/product.png', NULL, 'pc', '160.00', 'Available', 0, NULL, '2023-01-08 14:07:43'),
(25, 'qhhyjqppo', 12, 'mine vs romance', '/storage/images/product.png', NULL, 'pc', '150.00', 'Available', 0, NULL, '2023-01-08 14:07:59'),
(26, 'h2sc5hn2w', 2, 'Mine Someone', '/storage/images/product.png', NULL, 'pc', '180.00', 'Available', 0, NULL, '2023-01-08 14:08:11'),
(27, '7mivh8nog', 2, 'Mine Unique', '/storage/images/product.png', NULL, 'pc', '130.00', 'Available', 0, NULL, '2023-01-08 14:08:35'),
(28, '132fvovlx', 2, 'Mine Pink', '/storage/images/product.png', NULL, 'pc', '140.00', 'Available', 0, NULL, '2023-01-08 14:09:15'),
(29, 'qn7fpqi6l', 12, 'mine vs heart of', '/storage/images/product.png', NULL, 'pc', '150.00', 'Available', 0, NULL, '2023-01-08 14:09:17'),
(30, '827yy9q8f', 2, 'Mine Royal', '/storage/images/product.png', NULL, 'pc', '130.00', 'Pending', 0, NULL, '2023-01-08 14:09:46'),
(31, '4drlc3iez', 12, 'mine vs velvet', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:10:07'),
(32, 'rqzyss95r', 2, 'Mine Denim', '/storage/images/product.png', NULL, 'pc', '100.00', 'Pending', 0, NULL, '2023-01-08 14:10:10'),
(33, '27rvfrup0', 2, 'Mine Emily', '/storage/images/product.png', NULL, 'pc', '130.00', 'Pending', 0, NULL, '2023-01-08 14:10:36'),
(34, 'gc9970pl5', 2, 'Mine Sexy', '/storage/images/product.png', NULL, 'pc', '140.00', 'Pending', 0, NULL, '2023-01-08 14:11:05'),
(35, 'qicbkwfva', 7, 'mine handmade bag 1', '/storage/images/product.png', NULL, 'pc', '750.00', 'Pending', 0, NULL, '2023-01-08 14:17:21'),
(36, 'saws3t4jw', 7, 'mine handmade bag 2', '/storage/images/product.png', NULL, 'pc', '750.00', 'Pending', 0, NULL, '2023-01-08 14:18:24'),
(37, '6plydos4v', 7, 'mine handmade bag 3', '/storage/images/product.png', NULL, 'pc', '750.00', 'Pending', 0, NULL, '2023-01-08 14:19:49'),
(38, '5kebkmvsf', 2, 'Mine Chanel Blue', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:20:50'),
(39, 'b1wqpdpne', 7, 'mine handmade bag 4', '/storage/images/product.png', NULL, 'pc', '750.00', 'Pending', 0, NULL, '2023-01-08 14:20:55'),
(40, 'fhiuhcn58', 2, 'Mine Chanel Paris', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:21:22'),
(41, '51ljay0zd', 7, 'mine handmade bag 5', '/storage/images/product.png', NULL, 'pc', '750.00', 'Pending', 0, NULL, '2023-01-08 14:21:46'),
(42, 'q2hmkmv4c', 2, 'Mine Diamond', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:21:59'),
(43, '8umqf37qs', 7, 'mine handmade bag 6', '/storage/images/product.png', NULL, 'pc', '750.00', 'Pending', 0, NULL, '2023-01-08 14:22:35'),
(44, 'eukz2qi95', 2, 'Mine Dior', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:22:40'),
(45, '88el6kzjl', 1, 'MIne LV Black', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:23:12'),
(46, 'gm9npsj21', 2, 'Mine LV', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:23:32'),
(47, '2mz9w0uwy', 2, 'Mine Adidas', '/storage/images/product.png', NULL, 'pc', '250.00', 'Pending', 0, NULL, '2023-01-08 14:33:03'),
(48, 'tanrcdqjv', 2, 'Mine Balenciaga Red', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:33:52'),
(49, '1byzgr9xq', 2, 'Mine Fendi', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:34:11'),
(50, 'pqibs8z76', 2, 'Mine Hot', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:34:58'),
(51, 'i3vabycka', 2, 'Mine LV Black', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:35:21'),
(52, 'esxiwdoil', 2, 'Mine LV Maroon', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:35:59'),
(53, 'nx80krhmg', 2, 'Mine Mickey', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:36:25'),
(54, 'm5p8gmv44', 2, 'Mine Versace Blue', '/storage/images/product.png', NULL, 'pc', '290.00', 'Pending', 0, NULL, '2023-01-08 14:36:48'),
(55, 'bphy3o97g', 12, 'mine broncos T', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 14:46:23'),
(56, 'dg6ta9xc4', 12, 'mine patriots T', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 14:46:55'),
(57, 'grsr4ucuw', 12, 'mine  seahawks T', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 14:48:17'),
(58, '67zg2z4vr', 12, 'mine stars', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:50:06'),
(59, '6qk5iq1m5', 12, 'mine temptation', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:50:50'),
(60, 'o0mlvhflr', 12, 'mine ITN', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:51:32'),
(61, '4ovzusxfl', 12, 'mine cherry blossom', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:52:14'),
(62, '1sx8bgj9c', 12, 'mine dahlia', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:52:46'),
(63, 'jhehq0hnn', 12, 'mine diamond petals', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:54:40'),
(64, 'e5qzketel', 12, 'mine YTO', '/storage/images/product.png', NULL, 'pc', '150.00', 'Pending', 0, NULL, '2023-01-08 14:56:32'),
(65, 'guowln83y', 1, 'mine aero green', '/storage/images/product.png', NULL, 'pc', '120.00', 'Pending', 0, NULL, '2023-01-08 14:57:38'),
(66, 'biiwmwkda', 1, 'mine aero shirt', '/storage/images/product.png', NULL, 'pc', '120.00', 'Pending', 0, NULL, '2023-01-08 14:58:26'),
(67, 'thb0lhalx', 1, 'Mine Book', '/storage/images/product.png', NULL, 'pc', '160.00', 'Pending', 0, NULL, '2023-01-08 14:58:43'),
(68, 'fabjntjnh', 1, 'Mine Coffee', '/storage/images/product.png', NULL, 'pc', '160.00', 'Pending', 0, NULL, '2023-01-08 14:59:43'),
(69, '9vevhdr2s', 6, 'Mine Flower', '/storage/images/product.png', NULL, 'pc', '100.00', 'Pending', 0, NULL, '2023-01-08 15:00:23'),
(70, 'b271mc7ql', 1, 'mine cartoons black', '/storage/images/product.png', NULL, 'pc', '120.00', 'Pending', 0, NULL, '2023-01-08 15:00:41'),
(71, 'll2x9024x', 1, 'Mine Flowers', '/storage/images/product.png', NULL, 'pc', '160.00', 'Pending', 0, NULL, '2023-01-08 15:00:42'),
(72, '65v9wwxjy', 6, 'Mine Gold', '/storage/images/product.png', NULL, 'pc', '100.00', 'Pending', 0, NULL, '2023-01-08 15:01:06'),
(73, 'dtywimgh8', 1, 'mine champion black', '/storage/images/product.png', NULL, 'pc', '120.00', 'Pending', 0, NULL, '2023-01-08 15:01:16'),
(74, 'rc0ypbhwo', 6, 'Mine Gray', '/storage/images/product.png', NULL, 'pc', '100.00', 'Pending', 0, NULL, '2023-01-08 15:01:26'),
(75, 'k1o9frt0f', 1, 'mine champion gray', '/storage/images/product.png', NULL, 'pc', '120.00', 'Pending', 0, NULL, '2023-01-08 15:01:48'),
(76, 'm4ctgtx6h', 1, 'Mine Gucci Bear', '/storage/images/product.png', NULL, 'pc', '399.00', 'Pending', 0, NULL, '2023-01-08 15:02:00'),
(77, 'rzlep543h', 1, 'mine nirvana', '/storage/images/product.png', NULL, 'pc', '120.00', 'Pending', 0, NULL, '2023-01-08 15:02:33'),
(78, '3styohebg', 1, 'Mine Heels', '/storage/images/product.png', NULL, 'pc', '160.00', 'Pending', 0, NULL, '2023-01-08 15:02:34'),
(79, '8y4o8sec7', 1, 'Mine Hermes', '/storage/images/product.png', NULL, 'pc', '399.00', 'Pending', 0, NULL, '2023-01-08 15:03:29'),
(80, 'caos64qbu', 15, 'mine cardigan black', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:03:34'),
(81, 'ms2qknwoz', 1, 'Mine LV Bear', '/storage/images/product.png', NULL, 'pc', '399.00', 'Pending', 0, NULL, '2023-01-08 15:04:15'),
(82, 'bgyujzi0v', 15, 'mine cardigan brown', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:04:57'),
(83, '6n8jxwvcf', 1, 'Mine Mug', '/storage/images/product.png', NULL, 'pc', '160.00', 'Pending', 0, NULL, '2023-01-08 15:05:14'),
(84, '687leheqd', 15, 'mine cardigan dark blue', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:05:35'),
(85, '47l1cfzjt', 6, 'Mine Orage', '/storage/images/product.png', NULL, 'pc', '100.00', 'Pending', 0, NULL, '2023-01-08 15:05:41'),
(86, 'tv7zejny0', 6, 'Mine Peach', '/storage/images/product.png', NULL, 'pc', '100.00', 'Pending', 0, NULL, '2023-01-08 15:06:06'),
(87, 'l91amzihk', 15, 'mine cardigan floral', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:06:22'),
(88, 'ggmqmc9f4', 1, 'Mine Shoes', '/storage/images/product.png', NULL, 'pc', '160.00', 'Pending', 0, NULL, '2023-01-08 15:06:43'),
(89, 'dibljvqyj', 15, 'mine cardigan gray', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:06:49'),
(90, 'krrsyzxqh', 1, 'Mine Stripes Black', '/storage/images/product.png', NULL, 'pc', '399.00', 'Pending', 0, NULL, '2023-01-08 15:07:20'),
(91, 'oyzrcvjqz', 15, 'mine cardigan green', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:07:45'),
(92, 'kk2qv9s2r', 1, 'Mine Stripes Brown', '/storage/images/product.png', NULL, 'pc', '399.00', 'Pending', 0, NULL, '2023-01-08 15:07:59'),
(93, '1hy179mj3', 15, 'mine cardigan light blue', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:08:17'),
(94, 'j3cibrf87', 1, 'Mine Vogue', '/storage/images/product.png', NULL, 'pc', '160.00', 'Pending', 0, NULL, '2023-01-08 15:08:19'),
(95, '3achgtgzd', 15, 'mine cardigan light green', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:09:33'),
(96, 'icetniida', 15, 'mine cardigan maroon', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:10:27'),
(97, 'dwceq28gw', 15, 'mine cardigan orange', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:11:13'),
(98, 'dgtp1f3xw', 15, 'mine cardigan peach', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:11:39'),
(99, 'lu0o7tacp', 15, 'mine cardigan pink', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:13:00'),
(100, 'ar5670c9j', 15, 'mine cardigan stripes', '/storage/images/product.png', NULL, 'pc', '200.00', 'Pending', 0, NULL, '2023-01-08 15:14:15'),
(101, 'hm7map2qz', 1, 'Sample Product', '/storage/images/product.png', NULL, 'pc', '25.00', 'Pending', 0, NULL, '2023-01-23 10:49:02'),
(102, 'gjyv6ym1n', 1, 'Sample Product', '/storage/images/products/Sample Product_326490958_538581511576935_4638522482429597640_n.png', NULL, 'pc', '12.00', 'Available', 0, NULL, '2023-01-27 13:10:40'),
(103, 'jnrxun5uc', 1, 'Jeyym Santos', '/storage/images/products/Jeyym Santos_sandals.png', NULL, 'pc', '122.00', 'Available', 0, NULL, '2023-01-27 13:12:34'),
(104, 'mzdr6otav', 1, 'New Product', '/storage/images/products/mzdr6otav_New Product', NULL, 'pc', '122.00', 'Sold', 0, NULL, '2023-01-27 13:16:26'),
(105, '32sh2vtt5', 1, 'Mine Tasty Break', '/storage/images/products/32sh2vtt5_Mine Tasty Break', 'This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a sample description. This is a', 'box', '50.00', 'Available', 0, NULL, '2023-01-27 14:06:20'),
(106, 'k713ynr3b', 7, 'Hehe', '/storage/images/products/k713ynr3b_Hehe', NULL, 'pc', '12.00', 'Available', 0, NULL, '2023-01-27 16:06:40'),
(107, 'ejx2q2cjt', 14, 'Jeyym', '/storage/images/products/ejx2q2cjt_Jeyym', 'Sample Desc', 'box', '50.00', 'Available', 0, 'Other DEtails', '2023-01-27 17:38:48'),
(108, 'k1tnr91o2', 1, 'dsadasdas', '/storage/images/products/k1tnr91o2_dsadasdas', NULL, 'pc', '123.00', 'Available', 0, NULL, '2023-01-28 06:12:11'),
(109, 'fmzr7l1u1', 1, 'dsadasda', '/storage/images/products/fmzr7l1u1_dsadasda', NULL, 'pc', '123.00', 'Sold', 0, NULL, '2023-01-28 06:15:49'),
(110, 'thetl1ua7', 14, 'Klay', '/storage/images/products/thetl1ua7_Klay', NULL, 'pc', '123.00', 'Sold', 0, NULL, '2023-01-28 10:54:18'),
(111, '4t6knxdws', 7, 'Fidel', '/storage/images/products/4t6knxdws_Fidel', NULL, 'pc', '123.00', 'Sold', 0, NULL, '2023-01-28 10:56:03'),
(112, 'olxg0kphm', 1, 'Ibarra', '/storage/images/products/olxg0kphm_Ibarra', NULL, 'pc', '1231.00', 'Sold', 0, NULL, '2023-01-28 10:56:49'),
(113, 'cg2vblc58', 17, 'Mine Computer', '/storage/images/products/cg2vblc58_Mine Computer', NULL, 'pc', '25000.00', 'Sold', 0, NULL, '2023-02-11 15:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) UNSIGNED NOT NULL,
  `staff_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_phoneNumber` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_hired_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_address`, `staff_phoneNumber`, `staff_hired_date`) VALUES
(25, NULL, NULL, '2023-01-08 16:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_phone` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_other_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_registered_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_other_details`, `supplier_registered_date`) VALUES
(1, 'No Suppliers', NULL, '00000000000', NULL, '2023-01-07 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `phone_number`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aisha San Mateo', 'customer', '09123456789', 'aisha@mine', NULL, '$2y$10$qs954XvFH6p2QiBbTOPmZuOle/hCwaEfdOpAAwmvhxxGHCkjrK7rq', NULL, '2023-01-08 03:53:45', '2023-01-08 03:53:45'),
(4, 'Angelica Gobac', 'customer', '09876543210', 'angel@mine', NULL, '$2y$10$.6exnxGoyt8Klpkrjcc3ROByF1dt17nc/D6njh8PwGtNp4Tu8cEvq', NULL, '2023-01-08 04:01:40', '2023-01-08 04:01:40'),
(21, 'Jeyym Santos', 'admin', '09998877665', 'jeyymsantos@gmail.com', NULL, '$2y$10$PL70x0yeda9IGXqkVRvXCuUEdw0GTpaNnHT/lQS124zFY0MLCAMJC', 'FBojkiNnZtIvEjObHDx3uEv4qUWAHSRviMv1gFjju4AKGeXP1FS2FzUZ68BN', '2023-01-08 04:30:18', '2023-01-08 04:30:18'),
(25, 'Charles Correa', 'staff', '09123456789', 'charles@mine', NULL, '$2y$10$45eFbYQyeow96MjkeCy2O.gzVPA/QfGgiYGJyovnQ.g4GLThjhSVK', 'gRrdtSLMwIKVWDoiJcEUhGkrnI7Apq2Q9ryTnOy8oA7i2pl1drSI6AebG4uG', '2023-01-08 08:33:37', '2023-01-08 08:33:37'),
(33, 'Jhon Mark Santos', 'customer', '09217456414', 'jeyymsantos@jamindan.capiz', NULL, '$2y$10$FgQbdMHBkwrEutYrvQ1RbO4R2Gdmh4n9.0raEGNMU9QB.sdbh6P0G', NULL, '2023-02-10 22:29:37', '2023-02-10 22:29:37'),
(34, 'Jhon Mark Santos', 'customer', '09217456414', 'jeyym@gmail.com', NULL, '$2y$10$bblNfun0RYMbzutxlQQF8u3.G17j9v6tkOQCEyUtaBwZt4c1t6UPW', NULL, '2023-02-11 12:39:38', '2023-02-11 12:39:38'),
(35, 'Ian Rociel Santos', 'customer', '09123456789', 'ian@rociel.com', NULL, '$2y$10$4YDm5lADX5GkOPqYaanOe.Im3EvKT01aB4a5UJHhhuONC66AXw32a', 'i1GTB592L6dwwvNUgPBKA9HmMApbTY61Yb7fF0MfNaiY6pVCTMXL3FDZCYdX', '2023-02-11 15:17:08', '2023-02-11 15:17:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bales`
--
ALTER TABLE `bales`
  ADD PRIMARY KEY (`bale_id`),
  ADD KEY `bales_supplier_id_foreign` (`supplier_id`),
  ADD KEY `bales_category_id_foreign` (`category_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_cust_id_foreign` (`cust_id`),
  ADD KEY `orders_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_prod_id_foreign` (`prod_id`),
  ADD KEY `order_detail_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `products_bale_id_foreign` (`bale_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

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
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bales`
--
ALTER TABLE `bales`
  MODIFY `bale_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `card_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bales`
--
ALTER TABLE `bales`
  ADD CONSTRAINT `bales_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `bales_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_detail_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_bale_id_foreign` FOREIGN KEY (`bale_id`) REFERENCES `bales` (`bale_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
