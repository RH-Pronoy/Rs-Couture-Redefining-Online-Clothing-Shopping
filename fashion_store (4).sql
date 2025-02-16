-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 03:08 PM
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
-- Database: `fashion_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'Blacklist', '$2y$10$hs.IHZP228oFVoqlNeXZ1uO3JJlDKslZ24gLiCTWMICmfQI35yMw6', '', '2024-12-23 16:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `kids`
--

CREATE TABLE `kids` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `sizes` enum('S','M','L','XL','XXL') DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kids`
--

INSERT INTO `kids` (`id`, `name`, `price`, `color`, `sizes`, `stock`, `description`, `images`, `created_at`) VALUES
(1, 'Wasabi Green Viscose Frock Style Salwar Kameez', 2950.00, 'Green', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Wasabi Green Viscose Frock Style Salwar Kameez1.webp,images/Wasabi Green Viscose Frock Style Salwar Kameez2.webp,images/Wasabi Green Viscose Frock Style Salwar Kameez3.webp', '2024-12-24 20:41:02'),
(2, 'Purple Cotton Ghagra Choli', 5000.00, 'purple', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Purple Cotton Ghagra Choli1.webp,images/Purple Cotton Ghagra Choli2.jpg,images/Purple Cotton Ghagra Choli3.webp', '2024-12-24 20:45:10'),
(3, 'Ash Pique Short Sleeve Polo Shirt', 800.00, 'ash', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Ash Pique Short Sleeve Polo Shirt1.webp,images/Ash Pique Short Sleeve Polo Shirt2.jpg,images/Ash Pique Short Sleeve Polo Shirt3.webp', '2024-12-24 20:48:35'),
(4, 'Olive Viscose Panjabi', 999.00, 'Olive', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Olive Viscose Panjab1.jpg,images/Olive Viscose Panjab2.jpg,images/Olive Viscose Panjab3.webp', '2024-12-24 20:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `men`
--

CREATE TABLE `men` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `sizes` enum('S','M','L','XL','XXL') DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `men`
--

INSERT INTO `men` (`id`, `name`, `price`, `color`, `sizes`, `stock`, `description`, `images`, `created_at`) VALUES
(1, 'Black Cotton Short Sleeve T-Shirt', 895.00, 'Black', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Black Cotton Short Sleeve T-Shirt1.webp,images/Black Cotton Short Sleeve T-Shirt1.webp,images/Black Cotton Short Sleeve T-Shirt1.webp', '2024-12-24 19:53:11'),
(2, 'Brown Blended Cotton Fitted Panjabi', 3950.00, 'Brown ', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images\\Brown Blended Cotton Fitted Panjabi1.webp,images\\Brown Blended Cotton Fitted Panjabi2.webp,images\\Brown Blended Cotton Fitted Panjabi3.webp', '2024-12-24 20:00:32'),
(4, 'Maroon & Gray French Terry Round Neck Hoodie', 950.00, 'Maroon & Gray', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Maroon & Gray French Terry Round Neck Hoodie1.webp,images/Maroon & Gray French Terry Round Neck Hoodie2.jpg,images/Maroon & Gray French Terry Round Neck Hoodie3.webp', '2024-12-24 20:05:42'),
(5, 'Stripe Cotton Knit Winter Sweater', 1950.00, 'Stripe', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Stripe Cotton Knit Winter Sweater1.jpg,images/Stripe Cotton Knit Winter Sweater2.jpg,images/Stripe Cotton Knit Winter Sweater3.jpg', '2024-12-24 20:08:13'),
(6, 'Brown Viscose Knit Winter Sweater', 1950.00, 'Brown', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Brown Viscose Knit Winter Sweater1.webp,images/Brown Viscose Knit Winter Sweater2.jpg,images/Brown Viscose Knit Winter Sweater3.webp', '2024-12-24 20:13:03'),
(7, 'Olive Fleece Hoodie', 1950.00, 'Olive ', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Olive Fleece Hoodie1.webp,images/Olive Fleece Hoodie2.jpg,images/Olive Fleece Hoodie3.webp', '2024-12-24 20:14:15'),
(8, 'Short Sleeve Polo', 1395.00, 'Brown', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images\\Short Sleeve Polob1.webp,images\\Short Sleeve Polob2.jpg,images\\Short Sleeve Polob3.webp', '2024-12-24 20:15:27'),
(9, 'Short Sleeve Polo', 1395.00, 'Blue', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images\\Short Sleeve Polobl1.webp,images\\Short Sleeve Polobl2.jpg,images\\Short Sleeve Polobl3.webp', '2024-12-24 20:18:39'),
(10, 'Round Neck Hoodie', 950.00, 'Maroon & Gray', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Round Neck Hoodie1.webp,images/Round Neck Hoodie2.webp,images/Round Neck Hoodie3.webp', '2024-12-24 20:20:02'),
(11, 'Check Cotton Long Sleeve Casual Shirt', 2950.00, 'Check ', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Check Cotton Long Sleeve Casual Shirt1.webp,images/Check Cotton Long Sleeve Casual Shirt2.jpg,images/Check Cotton Long Sleeve Casual Shirt3.webp', '2024-12-24 20:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `new_arrivals`
--

CREATE TABLE `new_arrivals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `sizes` enum('S','M','L','XL','XXL') DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_arrivals`
--

INSERT INTO `new_arrivals` (`id`, `name`, `price`, `color`, `sizes`, `stock`, `description`, `images`, `created_at`) VALUES
(1, 'Short Sleeve Polo', 1395.00, 'Brown', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images\\Short Sleeve Polob1.webp,images\\Short Sleeve Polob2.jpg,images\\Short Sleeve Polob3.webp', '2024-12-24 13:04:37'),
(2, 'Short Sleeve Polo', 1395.00, 'Blue', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images\\Short Sleeve Polobl1.webp,images\\Short Sleeve Polobl2.jpg,images\\Short Sleeve Polobl3.webp', '2024-12-24 14:14:38'),
(3, ' Olive Green Viscose A-lineTop', 1895.00, ' Olive', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Olive Green Viscose A-line Woven Top1.webp,images/Olive Green Viscose A-line Woven Top2.webp,images/Olive Green Viscose A-line Woven Top3.webp', '2024-12-24 14:20:46'),
(4, ' Black Cotton Short Sleeve T-Shirt', 895.00, 'Black', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Black Cotton Short Sleeve T-Shirt1.webp,images/Black Cotton Short Sleeve T-Shirt1.webp,images/Black Cotton Short Sleeve T-Shirt1.webp', '2024-12-24 14:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_cost` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` enum('Pending','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `subtotal`, `delivery_cost`, `order_date`, `order_status`) VALUES
(1, 0, 1000.00, 950.00, 50.00, '2024-12-26 17:58:20', ''),
(2, 0, 1050.00, 950.00, 100.00, '2024-12-26 19:08:33', ''),
(3, 1, 4050.00, 3950.00, 100.00, '2024-12-26 19:59:03', 'Cancelled'),
(4, 1, 2950.00, 2900.00, 50.00, '2024-12-26 20:37:30', 'Pending'),
(5, 1, 14800.00, 14750.00, 50.00, '2024-12-26 20:52:41', 'Cancelled'),
(6, 1, 17750.00, 17700.00, 50.00, '2024-12-26 20:57:25', 'Cancelled'),
(7, 2, 3895.00, 3845.00, 50.00, '2025-01-07 19:56:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `size` enum('M','L','XL','XXL') NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_product` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `size`, `quantity`, `price_per_product`, `total_price`) VALUES
(1, 1, 2, ' Purple Crepe Hijab', '', 1, 950.00, 950.00),
(2, 2, 2, 'Blue Terry Round Neck Sweat Shirt', '', 1, 950.00, 950.00),
(3, 3, 3, 'Brown Blended Cotton Fitted Panjabi', '', 1, 3950.00, 3950.00),
(4, 4, 4, 'Brown Viscose Knit Winter Sweater', '', 1, 1950.00, 1950.00),
(5, 4, 2, ' Purple Crepe Hijab', 'M', 1, 950.00, 950.00),
(6, 5, 2, 'Purple Cotton Ghagra Choli', 'M', 1, 5000.00, 5000.00),
(7, 5, 5, 'Stripe Cotton Knit Winter Sweater', 'XL', 5, 1950.00, 9750.00),
(8, 6, 1, 'Maroon Viscose Shrug Style Kameez', 'L', 6, 2950.00, 17700.00),
(9, 7, 3, ' Olive Green Viscose A-lineTop', 'L', 1, 1895.00, 1895.00),
(10, 7, 5, 'Stripe Cotton Knit Winter Sweater', 'XXL', 1, 1950.00, 1950.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `sizes` enum('S','M','L','XL','XXL') DEFAULT 'S',
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `sku`, `color`, `sizes`, `stock`, `description`, `images`, `created_at`) VALUES
(1, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 14:24:26'),
(2, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(3, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(4, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(5, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(6, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(7, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(8, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(9, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26'),
(10, 'Olive Green Viscose A-line Woven Top', 1895.00, 'LWNTI4139', 'Green', '', 50, 'This is a comfortable and stylish olive green top perfect for all seasons.', 'images/top1.jpg,images/top2.jpg,images/top3.jpg', '2024-12-04 08:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `sizes` enum('S','M','L','XL','XXL') DEFAULT 'S',
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `name`, `price`, `color`, `sizes`, `stock`, `description`, `images`, `created_at`) VALUES
(1, 'Teal Blue Viscose Abaya Tunic', 1950.00, 'Blue', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images\\Teal Blue Viscose Abaya Tunic1.jpg,images\\Teal Blue Viscose Abaya Tunic2.jpg,images\\Teal Blue Viscose Abaya Tunic3.jpg,', '2024-12-24 08:33:24'),
(2, ' Pink Muslin Layered Tunic', 2950.00, NULL, NULL, 0, NULL, 'images\\Pink Muslin Layered Tunic1.webp,images\\Pink Muslin Layered Tunic2.jpg,images\\Pink Muslin Layered Tunic3.webp', '2024-12-24 08:40:33'),
(3, 'Brown Blended Cotton Fitted Panjabi', 3950.00, NULL, NULL, 0, NULL, 'images\\Brown Blended Cotton Fitted Panjabi1.webp,images\\Brown Blended Cotton Fitted Panjabi2.webp,images\\Brown Blended Cotton Fitted Panjabi3.webp', '2024-12-24 08:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `user_address`, `created_at`, `updated_at`) VALUES
(1, '22100032', 'aaa@gmail.com', '$2y$10$jDSjtbcLfpVHbyXx5Fr0.eHkW0RBpjtY6bvdVo8swS4x9UwOMKkYO', 'Nara', '2024-12-26 13:57:49', '2024-12-26 13:57:49'),
(2, '22100032', 'abs@gmail.com', '$2y$10$OjpN5YAt7nOvi6XdeBBp2OnToNSw7G37HSVEnL1oGY9zA/p6f5YE.', 'AAAA', '2025-01-07 13:56:40', '2025-01-07 13:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `winter`
--

CREATE TABLE `winter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `sizes` enum('S','M','L','XL','XXL') DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `winter`
--

INSERT INTO `winter` (`id`, `name`, `price`, `color`, `sizes`, `stock`, `description`, `images`, `created_at`) VALUES
(1, 'Round Neck Hoodie', 950.00, 'Red', 'S', 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Round Neck Hoodie1.webp,images/Round Neck Hoodie2.webp,images/Round Neck Hoodie3.webp', '2024-12-24 18:14:36'),
(2, 'Blue Terry Round Neck Sweat Shirt', 950.00, 'Blue', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Blue Terry Round Neck Sweat Shirt1.webp,images/Blue Terry Round Neck Sweat Shirt2.jpg,images/Blue Terry Round Neck Sweat Shirt3.webp', '2024-12-24 18:16:31'),
(3, 'Maroon & Gray French Terry Round Neck Hoodie', 950.00, 'Maroon & Gray', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Maroon & Gray French Terry Round Neck Hoodie1.webp,images/Maroon & Gray French Terry Round Neck Hoodie2.jpg,images/Maroon & Gray French Terry Round Neck Hoodie3.webp', '2024-12-24 18:18:56'),
(4, 'Brown Viscose Knit Winter Sweater', 1950.00, 'Brown', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Brown Viscose Knit Winter Sweater1.webp,images/Brown Viscose Knit Winter Sweater2.jpg,images/Brown Viscose Knit Winter Sweater3.webp', '2024-12-24 18:23:08'),
(5, 'Stripe Cotton Knit Winter Sweater', 1950.00, 'Stripe', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Stripe Cotton Knit Winter Sweater1.jpg,images/Stripe Cotton Knit Winter Sweater2.jpg,images/Stripe Cotton Knit Winter Sweater3.jpg', '2024-12-24 18:24:14'),
(6, 'Olive Fleece Hoodie', 1950.00, 'Olive', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Olive Fleece Hoodie1.webp,images/Olive Fleece Hoodie2.jpg,images/Olive Fleece Hoodie3.webp', '2024-12-24 18:25:45'),
(7, 'Blue Stretched Check Winter Jacket', 2450.00, 'Blue', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Blue Stretched Check Winter Jacket1.webp,images/Blue Stretched Check Winter Jacket2.jpg,images/Blue Stretched Check Winter Jacket3.jpg', '2024-12-24 18:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `women`
--

CREATE TABLE `women` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `sizes` enum('S','M','L','XL','XXL') DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `women`
--

INSERT INTO `women` (`id`, `name`, `price`, `color`, `sizes`, `stock`, `description`, `images`, `created_at`) VALUES
(1, 'Maroon Viscose Shrug Style Kameez', 2950.00, 'Maroon', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Maroon Viscose Shrug Style Kameez1.webp,images/Maroon Viscose Shrug Style Kameez2.jpg,images/Maroon Viscose Shrug Style Kameez3.webp', '2024-12-24 20:30:38'),
(2, ' Purple Crepe Hijab', 950.00, ' Purple', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Purple Crepe Hijab1.webp,images/Purple Crepe Hijab2.jpg,', '2024-12-24 20:32:49'),
(3, 'Black Viscose Long Tunic With Shrug', 1950.00, 'Black', NULL, 10, 'Product color may slightly vary, depending on your device\'s screen resolution', 'images/Black Viscose Long Tunic With Shrug1.webp,images/Black Viscose Long Tunic With Shrug2.webp,images/Black Viscose Long Tunic With Shrug3.webp', '2024-12-24 20:36:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `kids`
--
ALTER TABLE `kids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `men`
--
ALTER TABLE `men`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_arrivals`
--
ALTER TABLE `new_arrivals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `winter`
--
ALTER TABLE `winter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `women`
--
ALTER TABLE `women`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kids`
--
ALTER TABLE `kids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `men`
--
ALTER TABLE `men`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `new_arrivals`
--
ALTER TABLE `new_arrivals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `winter`
--
ALTER TABLE `winter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `women`
--
ALTER TABLE `women`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
