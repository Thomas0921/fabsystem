-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2018 at 08:41 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fabsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_address`, `customer_contact`) VALUES
(1, 'Tan', 'Jalan Joget 7', '0143144171'),
(2, 'Ong', 'Jalan Jasa 1', '0147896523');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_description` varchar(50) NOT NULL,
  `food_price` decimal(6,2) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`food_id`, `food_name`, `food_description`, `food_price`, `subcategory_id`) VALUES
(1, 'Curry Chicken Rice', '咖喱鸡饭', '8.90', 1),
(2, 'Mamee Chicken Rice', '妈蜜鸡丁饭', '8.90', 1),
(3, 'Mamee Fish Rice', '妈蜜鱼片饭', '8.90', 2),
(4, 'Mamee Prawn Rice', '妈蜜虾仁饭', '9.90', 3),
(5, 'Nasi Ayam Penyet', '印尼鸡饭', '11.90', 5),
(6, 'Nasi Ayam Kunyit', '黄姜鸡饭', '8.90', 5),
(7, 'Nasi Lemak with Chicken Wing', '鸡翅膀椰浆饭', '7.90', 6),
(8, 'Nasic Lemak with Otak', '乌打椰浆饭', '7.90', 6),
(10, 'Nasi Lemak with Chicken Rendang & Egg', '仁当鸡鸡蛋椰浆饭', '8.90', 6),
(11, 'Nasi Lemak with Red Chili Chicken & Egg', '红鸡鸡蛋椰浆饭', '8.90', 6),
(14, 'Nasi Lemak with Egg', '鸡蛋椰浆饭', '4.90', 6),
(15, 'Fried Kway Teow', '干炒粿条', '6.90', 7);

-- --------------------------------------------------------

--
-- Table structure for table `food_add_on`
--

CREATE TABLE `food_add_on` (
  `add_on_id` int(11) NOT NULL,
  `add_on_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `add_on_description` varchar(50) CHARACTER SET utf8 NOT NULL,
  `add_on_price` decimal(6,2) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_add_on`
--

INSERT INTO `food_add_on` (`add_on_id`, `add_on_name`, `add_on_description`, `add_on_price`, `category_id`) VALUES
(1, 'Fried Egg', '荷包蛋', '1.50', 1),
(2, 'Fish Fillet', '鱼柳', '1.50', 1),
(3, 'Cocktail Sausage (3 pcs)', '迷你小香肠（3片）', '2.20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_categories`
--

INSERT INTO `food_categories` (`category_id`, `category_name`) VALUES
(1, 'Rice'),
(2, 'Indo'),
(3, 'Local'),
(4, 'Snack'),
(5, 'Soup'),
(6, 'Drink');

-- --------------------------------------------------------

--
-- Table structure for table `food_condition`
--

CREATE TABLE `food_condition` (
  `condition_id` int(11) NOT NULL,
  `condition_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `condition_description` varchar(60) CHARACTER SET utf8 NOT NULL,
  `condition_price` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_condition`
--

INSERT INTO `food_condition` (`condition_id`, `condition_name`, `condition_description`, `condition_price`) VALUES
(1, 'Raining day', '下雨天', '1.00'),
(2, 'Store upstairs', '店屋楼上', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `food_subcategories`
--

CREATE TABLE `food_subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_subcategories`
--

INSERT INTO `food_subcategories` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'Chicken', 1),
(2, 'Fish', 1),
(3, 'Prawn', 1),
(4, 'Sotong', 1),
(5, 'Rice', 2),
(6, 'Rice', 3),
(7, 'Others', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_content` varchar(255) NOT NULL,
  `order_time` datetime NOT NULL,
  `delivery_time` datetime NOT NULL,
  `order_gross` decimal(6,2) NOT NULL,
  `order_discount` decimal(6,2) NOT NULL,
  `order_delivery` decimal(6,2) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_content`, `order_time`, `delivery_time`, `order_gross`, `order_discount`, `order_delivery`, `rider_id`, `status_id`) VALUES
(1, 1, '', '2018-03-13 09:23:00', '2018-03-13 10:33:00', '50.00', '5.00', '10.00', 1, 1),
(2, 2, '', '2018-03-13 11:32:00', '2018-03-13 14:25:00', '50.00', '12.00', '5.00', 2, 2),
(3, 2, '', '2018-03-13 22:21:59', '2018-03-13 22:21:59', '100.00', '10.00', '50.00', 1, 3),
(4, 2, '', '2018-03-13 23:05:30', '2018-03-13 23:05:30', '40.00', '12.00', '55.00', 2, 4),
(5, 1, '', '2018-03-13 23:05:30', '2018-03-13 23:05:30', '50.00', '5.00', '10.00', 1, 5),
(6, 1, '', '2018-03-14 11:42:23', '2018-03-14 11:42:23', '45.00', '5.00', '13.00', 2, 2),
(7, 1, '', '2018-03-14 11:49:06', '2018-03-14 11:49:06', '100.00', '5.00', '10.00', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_name`) VALUES
(1, 'in progress'),
(2, 'ready'),
(3, 'delivering'),
(4, 'closed'),
(5, 'canceled');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `rider_id` int(11) NOT NULL,
  `rider_name` varchar(50) NOT NULL,
  `rider_earned` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`rider_id`, `rider_name`, `rider_earned`) VALUES
(1, 'David', '0.00'),
(2, 'James', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(50) NOT NULL,
  `user_last` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pwd` char(60) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_pwd`, `hash`, `active`) VALUES
(3, 'Kim', 'kaka', 'lalala@gmail.com', '$2y$10$/OCTwztehDIHFlgFxXNIpuXdwzVG3Rl6nxs/vW8fzoM', '3871bd64012152bfb53fdf04b401193f', 0),
(14, 'Kenny', 'Ong', 'kenny961127@hotmail.co.uk', '$2y$10$dxVjPK.l95wFOOOzQJOcneYGDT0o7CZgcRZ8o8z1o5b', 'a8c88a0055f636e4a163a5e3d16adab7', 0),
(20, 'Thomas', 'Kim', 'thomaskim092150@gmail.com', '$2y$10$b6SoZywLFH4arV/aIfwwR.DpCzTTIh0RSnxm8wAScqWTe2kK1BNRW', '16a5cdae362b8d27a1d8f8c7b78b4330', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `category_id` (`subcategory_id`);

--
-- Indexes for table `food_add_on`
--
ALTER TABLE `food_add_on`
  ADD PRIMARY KEY (`add_on_id`),
  ADD KEY `subcategory_id` (`category_id`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `food_condition`
--
ALTER TABLE `food_condition`
  ADD PRIMARY KEY (`condition_id`);

--
-- Indexes for table `food_subcategories`
--
ALTER TABLE `food_subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `rider_id` (`rider_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`rider_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food_add_on`
--
ALTER TABLE `food_add_on`
  MODIFY `add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food_condition`
--
ALTER TABLE `food_condition`
  MODIFY `condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food_subcategories`
--
ALTER TABLE `food_subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `rider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `food_subcategories` (`subcategory_id`);

--
-- Constraints for table `food_add_on`
--
ALTER TABLE `food_add_on`
  ADD CONSTRAINT `food_add_on_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `food_categories` (`category_id`);

--
-- Constraints for table `food_subcategories`
--
ALTER TABLE `food_subcategories`
  ADD CONSTRAINT `food_subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `food_categories` (`category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`rider_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
