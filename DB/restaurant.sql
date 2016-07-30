-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2016 at 06:09 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `fooditem`
--

CREATE TABLE `fooditem` (
  `id` int(11) NOT NULL,
  `category` varchar(300) NOT NULL,
  `food_name` varchar(300) NOT NULL,
  `food_image` varchar(300) NOT NULL,
  `food_code` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooditem`
--

INSERT INTO `fooditem` (`id`, `category`, `food_name`, `food_image`, `food_code`, `price`, `deleted_at`) VALUES
(10, '', 'Chicken Steak Meal', 'Chicken Steak Meal_DSC_7319_800x533.JPG', 1010, 290, NULL),
(11, 'Drinks', 'Mint lemon', 'Mint lemon_Ayman-2655_400x600.jpg', 1013, 90, NULL),
(14, 'DESSERTS or DRINKS', 'Coffee-Mocha', 'Coffee-Mocha_drinks.jpg', 1014, 180, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mappingorder`
--

CREATE TABLE `mappingorder` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_code` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mappingorder`
--

INSERT INTO `mappingorder` (`id`, `order_id`, `food_code`, `quantity`) VALUES
(21, 41, 1010, 3),
(22, 41, 1013, 2),
(23, 41, 1014, 2),
(24, 41, 1014, 2),
(25, 42, 1013, 1),
(26, 42, 1010, 1),
(31, 44, 1014, 2),
(34, 45, 1014, 1),
(35, 45, 1014, 1),
(36, 46, 1013, 1),
(37, 46, 1014, 1),
(38, 46, 1014, 1),
(39, 47, 1014, 1),
(40, 47, 1014, 1),
(41, 48, 1014, 4),
(42, 48, 1014, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orderfood`
--

CREATE TABLE `orderfood` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `food_code` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `current_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderfood`
--

INSERT INTO `orderfood` (`id`, `user_id`, `invoice_id`, `food_code`, `total`, `current_date`) VALUES
(19, 8, 'inv19_8', '1014,1010', 650, '2016-07-29 10:43:14'),
(20, 8, 'inv20_8', '1014,1010', 650, '2016-07-29 10:43:47'),
(21, 8, 'inv21_8', '1014,1010', 650, '2016-07-29 10:47:36'),
(22, 8, 'inv22_8', '1014,1010', 650, '2016-07-29 10:51:59'),
(23, 8, 'inv23_8', '1014,1010', 650, '2016-07-29 10:52:21'),
(24, 8, 'inv24_8', '1014,1010', 650, '2016-07-29 10:52:48'),
(25, 8, 'inv25_8', '1014,1010', 650, '2016-07-29 10:53:25'),
(26, 8, 'inv26_8', '1014,1010', 650, '2016-07-29 10:54:28'),
(27, 8, 'inv27_8', '1014,1010', 650, '2016-07-29 10:56:47'),
(28, 8, 'inv28_8', '1014,1010', 650, '2016-07-29 10:57:38'),
(29, 8, 'inv29_8', '1014,1010', 650, '2016-07-29 11:00:24'),
(30, 8, 'inv30_8', '1014,1010', 650, '2016-07-29 11:00:56'),
(31, 8, 'inv31_8', '1014,1010', 650, '2016-07-29 11:01:30'),
(32, 8, 'inv32_8', '1014,1010', 650, '2016-07-29 11:01:51'),
(33, 8, 'inv33_8', '1014,1010', 650, '2016-07-29 11:02:24'),
(34, 8, 'inv34_8', '1014,1010', 650, '2016-07-29 11:04:28'),
(35, 8, 'inv35_8', '1014,1013', 270, '2016-07-29 11:07:09'),
(36, 8, 'inv36_8', '1014,1013', 270, '2016-07-29 11:08:33'),
(37, 8, 'inv37_8', '1014,1013', 270, '2016-07-29 11:13:03'),
(39, 8, 'inv39_8', '1013,1014', 270, '2016-07-29 15:33:02'),
(40, 8, 'inv40_8', '1014,1010', 760, '2016-07-29 15:40:22'),
(41, 8, 'inv41_8', '1010,1013,1014', 1410, '2016-07-29 21:18:32'),
(42, 8, 'inv42_8', '1013,1010', 380, '2016-07-29 21:18:45'),
(43, 8, 'inv43_8', '1014', 360, '2016-07-29 21:19:01'),
(44, 8, 'inv44_8', '1014', 360, '2016-07-29 21:21:34'),
(45, 9, 'inv45_9', '1013,1010,1014', 560, '2016-07-29 21:29:17'),
(46, 9, 'inv46_9', '1013,1014', 270, '2016-07-29 21:52:01'),
(47, 9, 'inv47_9', '1014', 180, '2016-07-30 04:06:56'),
(48, 9, 'inv48_9', '1014', 720, '2016-07-30 04:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `code`, `image`, `price`) VALUES
(1, 'Vivamus at magna non nunc', 'desrip1', 'BQX1', 'page2_img1.jpg', 100.00),
(2, 'sffdc', 'descrip2', 'BX2', 'page2_img2.jpg', 120.50),
(3, 'ggeg', 'descrip3', 'BX3', 'page2_img3.jpg', 130.00),
(4, 'dsrgrht', 'descrip4', 'BX4', 'page2_img4.jpg', 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `address` varchar(555) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`) VALUES
(8, 'Afiya', 'Ayman', 'aa@gmail.com', '012364478', 'Chittagong', '8b430bbcb360b07417150b7916cfb860'),
(9, 'SS', 'SS', 'sohana_a27@yahoo.com', '123', '123', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fooditem`
--
ALTER TABLE `fooditem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mappingorder`
--
ALTER TABLE `mappingorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderfood`
--
ALTER TABLE `orderfood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fooditem`
--
ALTER TABLE `fooditem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `mappingorder`
--
ALTER TABLE `mappingorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `orderfood`
--
ALTER TABLE `orderfood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
