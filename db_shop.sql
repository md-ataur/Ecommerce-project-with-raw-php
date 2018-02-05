-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2018 at 12:48 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
`adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Ataur Rahman', 'ataur', 'ataur@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
`brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(2, 'CANON'),
(3, 'SONY'),
(4, 'SAMSUNG'),
(5, 'Lanevo'),
(6, 'DELL'),
(7, 'Rang'),
(8, 'ACER'),
(9, 'Adidas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
`cartId` int(11) NOT NULL,
  `sessionId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
`catId` int(11) NOT NULL,
  `catname` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catname`) VALUES
(4, 'Desktop'),
(5, 'Laptop'),
(6, 'Accessories'),
(7, 'Software'),
(8, 'Mobile Phones'),
(9, 'Clothing'),
(11, 'Beauty &amp; Healthcare'),
(16, 'Kids &amp; Babies'),
(17, 'Jewellery'),
(18, 'Men Perfume');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE IF NOT EXISTS `tbl_compare` (
`id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `password`) VALUES
(2, 'Ataur Rahman', 'Mohammadpur H # 25 R # 1', 'Dhaka', 'Bangladesh', '1207', '01916862816', 'ataur@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(8, 'Kawsar Hossain', 'Mumbai H#50 R#152', 'Mumbai', 'India', '1209', '4564867897897', 'kawsar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
`id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `price`, `quantity`, `image`, `date`, `status`) VALUES
(19, 8, 21, 'Desktop Dell501', 8400.00, 3, 'upload/eb422b6622.jpg', '2018-02-03 13:54:09', 0),
(20, 8, 24, 'Demo ', 1400.00, 1, 'upload/0cdeedee6a.jpg', '2018-02-03 13:54:09', 1),
(22, 8, 19, 'Samsung Mobile T5', 200.00, 1, 'upload/09eb89114c.jpg', '2018-02-03 14:23:15', 1),
(23, 8, 22, 'CANON CAMERA 05T', 6000.00, 2, 'upload/80d14589dc.png', '2018-02-03 16:18:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
`productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(19, 'Samsung Mobile T5', 8, 3, '<p>Samsung Mobile T5&nbsp;Samsung Mobile T5&nbsp;Samsung Mobile T5</p>', 200.00, 'upload/09eb89114c.jpg', 0),
(20, 'Tab S5T', 8, 7, '<p>Tab S5T&nbsp;Tab S5T&nbsp;Tab S5T</p>', 1500.00, 'upload/2ce3433aa6.jpg', 0),
(21, 'Desktop Dell501', 4, 2, '<p>Desktop Dell501&nbsp;Desktop Dell501&nbsp;Desktop Dell501</p>', 2800.00, 'upload/eb422b6622.jpg', 0),
(22, 'CANON CAMERA 05T', 6, 4, '<p>CANON CAMERA 05T&nbsp;CANON CAMERA 05T&nbsp;CANON CAMERA 05T</p>', 3000.00, 'upload/80d14589dc.png', 0),
(23, 'Shirt', 9, 9, '<p>Mens Formal Shirt&nbsp;Mens Formal Shirt&nbsp;Mens Formal Shirt</p>', 1000.00, 'upload/3b96a83640.jpg', 1),
(24, 'Demo ', 11, 9, '<p>Hello</p>', 1400.00, 'upload/0cdeedee6a.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
`id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `cmrId`, `productId`, `productName`, `price`, `image`) VALUES
(2, 2, 21, 'Desktop Dell501', 2800.00, 'upload/eb422b6622.jpg'),
(3, 2, 20, 'Tab S5T', 1500.00, 'upload/2ce3433aa6.jpg'),
(5, 2, 22, 'CANON CAMERA 05T', 3000.00, 'upload/80d14589dc.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
 ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
 ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
 ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
 ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
 ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
