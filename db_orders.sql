-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2018 at 02:00 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) DEFAULT '1',
  `notes` varchar(255) DEFAULT NULL,
  `promo_code_id` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `notes`, `promo_code_id`, `created_at`, `updated_at`) VALUES
(17, 11, 1, NULL, NULL, '2018-05-16 22:27:52', NULL),
(18, 11, 1, NULL, NULL, '2018-05-16 22:27:59', NULL),
(19, 11, 1, NULL, NULL, '2018-05-16 22:28:12', NULL),
(23, 15, 1, NULL, NULL, '2018-05-17 02:17:39', NULL),
(24, 15, 1, NULL, NULL, '2018-05-17 02:43:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(21, 23, 49, 5),
(22, 24, 49, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `sku` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(300) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `sku`, `stock`, `image_url`, `status`, `created_at`, `updated_at`) VALUES
(49, 'Apple MacBook Pro 2017\" không Touch Bar', 22000000, 'apple_mbp_17_wo_tb', 94, 'http://localhost:8888/orders/uploads/1526545066_apple-macbook-pro-without-touchbar.jpg', 1, NULL, NULL),
(50, 'MacBook Pro 2017 13\" với Touch Bar', 44000000, 'apple_mbp_17_w_tb', 40, 'http://localhost:8888/orders/uploads/1526545836_apple-macbook-pro-without-touchbar.jpg', 1, NULL, NULL),
(51, 'Túi chống sốc', 300000, 'xiaomi_tcs', 10, 'http://localhost:8888/orders/uploads/1526546475_tui-chong-soc.jpg', 1, NULL, NULL),
(52, 'ABC123', 100000, 'njfnvkj', 10, 'http://localhost:8888/orders/uploads/1526550146_tui-chong-soc.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `telephone_number` varchar(13) DEFAULT NULL,
  `address` text,
  `position` varchar(45) NOT NULL DEFAULT 'user',
  `status` int(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `telephone_number`, `address`, `position`, `status`, `created_at`, `updated_at`) VALUES
(11, 'ndt', '$2y$10$DZ5KvaDsgk848xfGipPBgOIOFo9rS9m7wEXK6WExZP2NuqXpqOHce', 'thinhnd.ict@gmail.com', 'Thịnh Nguyễn', '0936237890', NULL, 'admin', NULL, NULL, NULL),
(15, 'ndttest1', '$2y$10$xk5.maGqIlpuZlZbl3bLeOy8hF.ClNjnv1bA2GkclOb/Ty2r9a3Z2', 'ndttest1@gmail.com', 'Thịnh Nguyễn KH1', '', NULL, 'user', NULL, NULL, NULL),
(16, 'ndttest2', '$2y$10$UHqyy1dgtVEy1/8lkiCjpO60ekUI6MpjRVyQ0PKArDXwTxNExkx2i', 'ndttest2@gmail.com', 'Thịnh Nguyễn KH2', '', NULL, 'user', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users1_idx` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_products1_idx` (`product_id`),
  ADD KEY `fk_order_items_orders1_idx` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_items_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
