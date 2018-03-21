-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2018 at 04:53 AM
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
  `food_code` varchar(50) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_description` varchar(50) NOT NULL,
  `food_price` decimal(6,2) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`food_id`, `food_code`, `food_name`, `food_description`, `food_price`, `subcategory_id`) VALUES
(1, '202', 'Curry Chicken Rice', '咖喱鸡饭', '8.90', 1),
(2, '203', 'Mamee Chicken Rice', '妈蜜鸡丁饭', '8.90', 1),
(3, '204', 'Mamee Fish Rice', '妈蜜鱼片饭', '8.90', 2),
(4, '205', 'Mamee Prawn Rice', '妈蜜虾仁饭', '9.90', 3),
(5, '501', 'Nasi Ayam Penyet', '印尼鸡饭', '11.90', 5),
(6, '502', 'Nasi Ayam Kunyit', '黄姜鸡饭', '8.90', 5),
(7, '101A', 'Nasi Lemak with Chicken Wing', '鸡翅膀椰浆饭', '7.90', 6),
(8, '101B', 'Nasic Lemak with Otak', '乌打椰浆饭', '7.90', 6),
(10, '102A', 'Nasi Lemak with Chicken Rendang & Egg', '仁当鸡鸡蛋椰浆饭', '8.90', 6),
(11, '103A', 'Nasi Lemak with Red Chili Chicken & Egg', '红鸡鸡蛋椰浆饭', '8.90', 6),
(14, '104A', 'Nasi Lemak with Egg', '鸡蛋椰浆饭', '4.90', 6),
(15, '401', 'Fried Kway Teow', '干炒粿条', '6.90', 7);

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
(3, 'Cocktail Sausage', '迷你小香肠（3片）', '2.20', 1),
(4, 'testing', 'lala', '2.00', 3);

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
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `membership_id` int(11) NOT NULL,
  `membership_name` varchar(50) NOT NULL,
  `membership_contact` varchar(50) NOT NULL,
  `membership_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`membership_id`, `membership_name`, `membership_contact`, `membership_address`) VALUES
(0, 'No membership', '-', '-'),
(3, 'Kenny ', '0126541254', 'No 22, Jalan Jasa');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `order_content` text NOT NULL,
  `order_time` datetime NOT NULL,
  `delivery_time` datetime NOT NULL,
  `closed_time` datetime NOT NULL,
  `order_gross` decimal(6,2) NOT NULL,
  `order_discount` decimal(6,2) NOT NULL,
  `order_delivery` decimal(6,2) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `membership_id`, `customer_name`, `customer_contact`, `customer_address`, `order_content`, `order_time`, `delivery_time`, `closed_time`, `order_gross`, `order_discount`, `order_delivery`, `bill_no`, `rider_id`, `status_id`) VALUES
(1, 0, 'John', '0123654789', 'jalan nakhoda 15', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:36:59', '2018-03-19 14:58:34', '2018-03-17 20:45:53', '50.00', '5.00', '10.00', 'JP1', 3, 4),
(2, 0, '2', 'Sam', 'jalan tun aminah', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:37:21', '2018-03-13 14:25:00', '0000-00-00 00:00:00', '50.00', '12.00', '5.00', 'JP2', 1, 2),
(3, 0, 'Gilbert', '01257894632', 'jalan hang tuah 31', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:38:13', '2018-03-13 22:21:59', '0000-00-00 00:00:00', '100.00', '10.00', '50.00', 'JP3', 1, 2),
(4, 0, 'Yoga', '01354889456', 'jalan perwira 6', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:39:50', '2018-03-19 15:11:16', '0000-00-00 00:00:00', '40.00', '12.00', '55.00', 'JP4', 2, 3),
(5, 0, 'Kent', '012564987486', 'jalan mutiara 2/5', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:40:44', '2018-03-13 23:05:30', '0000-00-00 00:00:00', '50.00', '5.00', '10.00', 'JP5', 1, 3),
(6, 0, 'Ahmad', '0125896475', 'jalan utama 29', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:42:25', '2018-03-20 14:17:36', '2018-03-20 14:17:39', '45.00', '5.00', '13.00', 'JP6', 3, 4),
(7, 0, 'Tan', '0123456789', 'jalan bakti 48', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:43:06', '2018-03-14 11:49:06', '2018-03-20 14:17:40', '100.00', '5.00', '10.00', 'JP7', 1, 4),
(8, 0, 'thomas', '021-5523657', 'jalan perwira 16', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:43:25', '2018-03-21 10:09:08', '2018-03-18 00:23:26', '56.50', '2.00', '4.00', 'JP8', 1, 4),
(9, 0, 'thomas', '021-5523657', 'No lala, jalan jasa 3', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-14 18:56:51', '2018-03-21 10:09:08', '2018-03-18 21:57:38', '56.50', '2.00', '4.00', 'JP4412', 1, 2),
(10, 0, 'jason', '02155756', 'jalan bakti 4', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:44:07', '2018-03-17 20:29:19', '2018-03-20 01:23:24', '56.20', '2.00', '4.00', 'JP10', 1, 4),
(11, 0, 'james', '0143144127', 'jalan sutera pulai 2/4', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:44:46', '2018-03-17 23:45:59', '2018-03-17 23:46:05', '50.00', '5.00', '10.00', 'JP11', 2, 4),
(12, 0, 'Kent', '014357889', 'jalan joget 7', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:44:58', '2018-03-18 00:23:31', '2018-03-20 01:21:59', '100.00', '5.00', '5.00', 'JP12', 2, 4),
(13, 0, 'jen', '456789123', 'jalan inang', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:45:21', '2018-03-20 14:17:46', '2018-03-20 14:17:48', '100.00', '50.00', '55.00', 'JP13', 2, 4),
(14, 0, 'jan', '01288554679', 'jalan wira 9', '<dl><dt>1 Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1 Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage (3 pcs)<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-19 09:45:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123.00', '456.00', '123.00', 'JP14', 1, 2),
(15, 0, 'Kan', '123456789', 'No Jalan Sultan Aminah', '<dl><dt>1     Mamee Chicken Rice<button class=\'delete-item\' data-id=\'2\'>X</button><dd>1 Fried Egg<button class=\'delete-addon\' cat-id=\'2\' addon-id=\'1\'>X</button></dd><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'2\' addon-id=\'2\'>X</button></dd><dt>1     Nasi Ayam Penyet<button class=\'delete-item\' data-id=\'5\'>X</button><dt>1     Nasi Ayam Kunyit<button class=\'delete-item\' data-id=\'6\'>X</button></dl>', '2018-03-20 11:55:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0.00', '12.00', '5.00', 'JP1354', 1, 2),
(16, 0, 'dd', '123', 'No 33, jalan guning', '<dl><dt>1     Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dt>1     Mamee Chicken Rice<button class=\'delete-item\' data-id=\'2\'>X</button></dl>', '2018-03-20 12:00:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0.00', '2.00', '4.00', 'll', 1, 1),
(17, 0, 'ss', '123123', 'No 77', '<dl><dt>1     Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dt>1     Mamee Chicken Rice<button class=\'delete-item\' data-id=\'2\'>X</button><dt>1     Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'3\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage<button class=\'delete-addon\' cat-id=\'3\' addon-id=\'3\'>X</button></dd></dl>', '2018-03-20 12:03:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '32.40', '2.00', '4.00', 'ff', 1, 1),
(18, 0, 'Long', '1452366875', 'No Jalan Jasa', '<dl><dt>1     Mamee Chicken Rice<button class=\'delete-item\' data-id=\'2\'>X</button><dt>1     Curry Chicken Rice<button class=\'delete-item\' data-id=\'1\'>X</button><dd>1 Fried Egg<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'1\'>X</button></dd><dd>1 Fish Fillet<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'2\'>X</button></dd><dd>1 Cocktail Sausage<button class=\'delete-addon\' cat-id=\'1\' addon-id=\'3\'>X</button></dd><dt>1     Nasi Ayam Penyet<button class=\'delete-item\' data-id=\'5\'>X</button><dt>1     Nasi Ayam Kunyit<button class=\'delete-item\' data-id=\'6\'>X</button><dt>1     Nasi Lemak with Chicken Wing<button class=\'delete-item\' data-id=\'7\'>X</button><dt>1     Nasic Lemak with Otak<button class=\'delete-item\' data-id=\'8\'>X</button><dd>1 testing<button class=\'delete-addon\' cat-id=\'8\' addon-id=\'4\'>X</button></dd><dt>1     Nasi Lemak with Chicken Rendang & Egg dfde<button class=\'delete-item\' data-id=\'10\'>X</button><dt>1     testing<button class=\'delete-item\' data-id=\'16\'>X</button><dt>1     Nasi Lemak with Egg<button class=\'delete-item\' data-id=\'14\'>X</button><dt>1     Nasi Lemak with Red Chili Chicken & Egg<button class=\'delete-item\' data-id=\'11\'>X</button></dl>', '2018-03-20 17:47:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '89.30', '2.00', '4.00', '3', 1, 1),
(19, 3, 'Kenny ', '0126541254', '0126541254', '<dl><dt>1     Mamee Fish Rice<button class=\'delete-item\' data-id=\'3\'>X</button><dt>1     Nasi Lemak with Chicken Wing<button class=\'delete-item\' data-id=\'7\'>X</button></dl>', '2018-03-21 11:03:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '18.80', '2.00', '4.00', 'JP0021', 1, 1);

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
(5, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `rider_id` int(11) NOT NULL,
  `rider_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`rider_id`, `rider_name`) VALUES
(1, 'not yet'),
(2, 'James'),
(3, 'Kennyong');

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
(22, 'Thomas', 'Kim', 'thomaskim092150@gmail.com', '$2y$10$f11BcGPjM51ZjVSkjIF4n.zL3fW4ScyUQ3uninl/KOL0rAbZDHMxC', '959a557f5f6beb411fd954f3f34b21c3', 1);

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
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `rider_id` (`rider_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `membership_id` (`membership_id`);

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
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `food_add_on`
--
ALTER TABLE `food_add_on`
  MODIFY `add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `rider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`rider_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`status_id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`membership_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
