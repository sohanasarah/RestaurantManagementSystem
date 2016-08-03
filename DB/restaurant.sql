-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2016 at 05:00 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `address` varchar(555) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`) VALUES
(1, 'TUSHAR1', 'ADMIN', 'tusharadmin@gmail.com', '248774', 'Chittagong', '202cb962ac59075b964b07152d234b70'),
(2, 'Test', 'Admin', 'test@admin.com', '53647436352', 'Bangladesh', '202cb962ac59075b964b07152d234b70');

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
(14, 'DESSERTS or DRINKS', 'Coffee-Regular', 'Coffee-Regular_drinks.jpg', 1014, 180, NULL),
(15, 'APPETIZER', 'Saslik', 'Saslik_DSC_0964_798x532.JPG', 1015, 180, NULL),
(16, 'Appetizer', 'Nachos', 'Nachos_Edited-2643_800x533.jpg', 1016, 280, NULL),
(17, 'Main Course', 'Chicken Steak Meal', 'Chicken Steak Meal_DSC_7319_800x533.JPG', 1017, 290, NULL),
(18, 'Main Course', 'Chicken Peri Peri', 'Chicken Peri Peri_Edited-7322_800x533.jpg', 1018, 400, NULL),
(19, 'MAIN COURSE', 'Pizza-Chicken Supreme', 'Pizza-Chicken Supreme_untitled-1600_800x477.jpg', 1019, 800, NULL),
(20, 'DESSERTS or DRINKS', 'Coca Cola', 'Coca Cola_hhgg.jpg', 1020, 80, NULL),
(21, 'DESSERTS or DRINKS', 'Ebony & Ivory', 'Ebony & Ivory_IMG_20140115_174248_1067x800_800x600.JPG', 1021, 200, NULL),
(22, 'Main Course', 'Half Grilled Chicken Mean', 'Half Grilled Chicken Mean_Edited-2647_800x533.jpg', 1022, 300, NULL),
(23, 'Main Course', 'Chicken Jambalaya Fried Rice', 'Chicken Jambalaya Fried Rice_DSC_8306_800x533.jpg', 1023, 550, NULL),
(24, 'Main Course', 'Lemon Butter Chicken Meal', 'Lemon Butter Chicken Meal_DSC_7316_798x532.JPG', 1024, 350, NULL),
(25, 'DESSERTS or DRINKS', 'Coffee Tiramisu', 'Coffee Tiramisu_Edited-4379_800x429.jpg', 1025, 200, NULL),
(26, 'Main Course', 'Butter Chicken Roast', 'Butter Chicken Roast_Edited-7320_800x458.jpg', 1026, 300, NULL),
(27, 'DESSERTS or DRINKS', 'Mango Lemon Mint', 'Mango Lemon Mint_aaas.jpg', 1027, 350, NULL);

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
(52, 58, 1020, 3),
(53, 58, 1021, 8),
(54, 59, 1014, 1),
(55, 59, 1020, 1),
(56, 60, 1021, 5),
(57, 60, 1020, 4),
(60, 62, 1020, 1),
(61, 62, 1021, 1),
(62, 63, 1022, 1),
(63, 63, 1024, 1),
(64, 63, 1027, 1),
(65, 63, 1015, 1),
(66, 64, 1015, 1),
(67, 64, 1027, 1),
(68, 65, 1021, 1),
(69, 65, 1023, 1),
(70, 66, 1022, 1),
(71, 67, 1024, 1);

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
  `current_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `delivery_status` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderfood`
--

INSERT INTO `orderfood` (`id`, `user_id`, `invoice_id`, `food_code`, `total`, `current_date`, `payment`, `transaction_id`, `delivery_status`) VALUES
(46, 9, 'inv46_9', '1013,1014', 270, '2016-07-29 21:52:01', '', '', 'DELIVERED'),
(47, 9, 'inv47_9', '1014', 180, '2016-07-30 04:06:56', '', '', 'DELIVERED'),
(48, 9, 'inv48_9', '1014', 720, '2016-07-30 04:07:24', '', '', 'DELIVERED'),
(49, 8, 'inv49_8', '1014', 360, '2016-07-30 05:05:25', '', '', 'DELIVERED'),
(54, 8, 'inv54_8', '1014', 360, '2016-07-30 05:15:42', '', '', 'DELIVERED'),
(56, 10, 'inv56_10', '1018,1017,1019,1023', 6840, '2016-07-30 08:49:58', '', '', 'DELIVERED'),
(57, 11, 'inv57_11', '1018', 800, '2016-08-03 03:08:49', '01822666893', '5214536', 'DELIVERED'),
(58, 11, 'inv58_11', '1020,1021', 1840, '2016-08-03 04:17:14', '01822666893', '87656563', NULL),
(59, 11, 'inv59_11', '1014,1020', 260, '2016-08-03 04:33:41', 'Card', 'Check Account', NULL),
(60, 11, 'inv60_11', '1021,1020', 1320, '2016-08-03 04:53:05', 'Cash On delivery', 'N/A', NULL),
(61, 11, 'inv61_11', '1017,1018', 690, '2016-08-03 04:54:58', '4526436', '6456456', 'DELIVERED'),
(62, 8, 'inv62_8', '1020,1021', 280, '2016-08-03 07:25:45', 'Cash On delivery', 'N/A', NULL),
(63, 10, 'inv63_10', '1022,1024,1027,1015', 1180, '2016-08-03 12:43:25', 'Card', 'Check Account', NULL),
(64, 10, 'inv64_10', '1015,1027', 530, '2016-08-03 13:26:33', 'Reserve Table', 'Successful', NULL),
(65, 12, 'inv65_12', '1021,1023', 750, '2016-08-03 14:07:06', 'Reserve Table', 'Successful', NULL),
(66, 12, 'inv66_12', '1022', 300, '2016-08-03 14:49:54', 'Cash On delivery', 'N/A', NULL),
(67, 12, 'inv67_12', '1024', 350, '2016-08-03 14:53:22', 'Cash On delivery', 'N/A', NULL);

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
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(222) NOT NULL,
  `invoice_id` varchar(11) NOT NULL,
  `table_info` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date`, `time_slot`, `invoice_id`, `table_info`) VALUES
(1, '2016-08-01', '8:00pm-8:59pm', '12', 'Table#8 - 4 Seated'),
(2, '2016-08-02', '10:00pm-10:59pm', '24', 'Table#10 - 4 Seated'),
(5, '2016-08-03', '5:00pm-5:59pm', 'inv63_10', 'Table#2 - 4 Seated'),
(6, '2016-08-10', '10:00pm-10:59pm', 'inv64_10', 'Table#10 - 4 Seated'),
(7, '2016-08-03', '12:00pm-12:59pm', 'inv65_12', 'Table#5 - 4 Seated'),
(8, '2016-08-03', '12:00pm-12:59pm', 'inv65_12', 'Table#3 - 4 Seated'),
(9, '2016-08-15', '7:00pm-7:59pm', 'inv65_12', 'Table#10 - 4 Seated');

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
(9, 'SS', 'SS', 'sohana_a27@yahoo.com', '123', '123', '202cb962ac59075b964b07152d234b70'),
(10, 'tusharbd', 'tusharbd', 'tusharbd@gmail.com', '864827', 'sdif jfskfj slkjfksf', '202cb962ac59075b964b07152d234b70'),
(11, 'Shibli', 'Emon', 'shibli.emon@gmail.com', '0155554454554', 'CUET', '202cb962ac59075b964b07152d234b70'),
(12, 'Tushar', 'Chowdhury', 'tushar.chowdhury@gmail.com', '01711666162', 'Chittagong', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fooditem`
--
ALTER TABLE `fooditem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `mappingorder`
--
ALTER TABLE `mappingorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `orderfood`
--
ALTER TABLE `orderfood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
