-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2016 at 02:56 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `address` varchar(555) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`) VALUES
(1, 'Tushar', 'Chowdhury', 'tusharbd@gmail.com', '56477463532255', 'Male', '202cb962ac59075b964b07152d234b70'),
(2, 'lfdkjslkf', 'sdfjslfkdj', 'a@b.c', '3897837', 'Female', 'd41d8cd98f00b204e9800998ecf8427e'),
(3, 'Someone', 'Chowdhury', 'someone@gmail.com', '46436', 'Female', '202cb962ac59075b964b07152d234b70'),
(5, 'Yameen', 'Hossain', 'yameen15@gmail.com', '123254353', 'Male', '202cb962ac59075b964b07152d234b70'),
(6, 'Test', 'User', 'test@user.com', '398549385787', 'Female', '202cb962ac59075b964b07152d234b70'),
(7, '', '', '', '', 'Male', 'd41d8cd98f00b204e9800998ecf8427e'),
(8, 'Manha', 'Hasnain', 'manha@gmail.com', '243253636', '4kjdkfjsfksjk ksjfksjfksjere', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
