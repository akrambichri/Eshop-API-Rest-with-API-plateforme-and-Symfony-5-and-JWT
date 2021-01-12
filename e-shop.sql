-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 05:28 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `alias`, `created_at`, `updated_at`) VALUES
(17, 'Informatique', 'informatique', '2021-01-08 13:12:37', '2021-01-08 13:12:37'),
(18, 'Livres', 'livres', '2021-01-08 13:12:37', '2021-01-08 13:12:37'),
(19, 'High-Tech', 'hight-tech', '2021-01-08 13:12:37', '2021-01-08 13:12:37'),
(20, 'Cuisine et Maison', 'cuisine-maison', '2021-01-08 13:12:37', '2021-01-08 13:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user_id`, `name`, `description`, `alias`, `price`, `image`) VALUES
(71, 149, 'Et sed error deserunt.', 'Corporis sunt magni non quis. Est quia necessitatibus reiciendis voluptate natus. Non molestias tempore quaerat rem accusantium excepturi. Iste totam labore voluptas quaerat ab perspiciatis.', 'Et-sed-error-deserunt', 6679.49, 'https://lorempixel.com/640/480/?29698'),
(72, 149, 'Ex esse qui beatae molestias accusamus.', 'Qui aliquam itaque qui magni saepe. A quia et aperiam quis perferendis consequuntur ducimus. Voluptatem non accusamus dolor.', 'Ex-esse-qui-beatae-molestias-accusamus', 15479.49, 'https://lorempixel.com/640/480/?60469'),
(73, 149, 'Cum perspiciatis et et.', 'Provident non itaque est autem dolores nihil soluta. Non enim quis vel voluptatem veritatis molestias necessitatibus. Sint eaque incidunt magni fuga et cumque.', 'Cum-perspiciatis-et-et', 1999.29, 'https://lorempixel.com/640/480/?73889');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(72, 19),
(73, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `roles`) VALUES
(149, 'akram', 'akram', 'akram@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NVZ2ODBMOC5KU3BQN214Rw$jW51v/3RvtOTZBq5/MMobD3wypBSLmActX3j4ztRQDw', 'a:1:{i:0;s:9:\"ROLE_USER\";}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04ADA76ED395` (`user_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `IDX_CDFC73564584665A` (`product_id`),
  ADD KEY `IDX_CDFC735612469DE2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04ADA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
