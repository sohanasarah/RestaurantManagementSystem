-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2016 at 11:58 AM
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
(2, 'DESSERTS or DRINKS', 'Lemon Shock', 'Lemon Shock_Ayman-2655_400x600.jpg', 0, 110, NULL),
(3, '', 'Cucumber Splash', 'Cucumber Splash_DSC_8326_418x600.jpg', 0, 180, NULL),
(4, '', 'Cucumber Splash', 'Cucumber Splash_DSC_8326_418x600.jpg', 0, 180, NULL),
(5, '', 'Cucumber Splash', 'Cucumber Splash_DSC_8326_418x600.jpg', 0, 180, NULL),
(6, '', 'Mango Lemon Mint', 'Mango Lemon Mint_DSC_0046_413x600.jpg', 1009, 250, NULL),
(8, '', 'Mango Lemon Mint', 'Mango Lemon Mint_DSC_0046_413x600.jpg', 1009, 250, NULL),
(9, '', 'Mango Lemon Mint', 'Mango Lemon Mint_DSC_0046_413x600.jpg', 1009, 250, NULL),
(10, '', 'Chicken Steak Meal', 'Chicken Steak Meal_DSC_7319_800x533.JPG', 1010, 290, NULL),
(11, 'Drinks', 'Mint lemon', 'Mint lemon_Ayman-2655_400x600.jpg', 1013, 90, NULL),
(12, 'Drinks', 'Mint lemon', 'Mint lemon_Ayman-2655_400x600.jpg', 1013, 90, NULL),
(13, 'Drinks', 'Mint lemon', 'Mint lemon_Ayman-2655_400x600.jpg', 1013, 90, NULL),
(14, 'DESSERTS or DRINKS', 'Coffee-Mocha', 'Coffee-Mocha_drinks.jpg', 1014, 180, NULL);

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
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`) VALUES
(7, 'Shibli', 'shibli.emon@gmail.com', '01822666893', 'CUET', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fooditem`
--
ALTER TABLE `fooditem`
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
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
