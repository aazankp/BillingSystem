-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 04:26 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bill_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_bill`
--

CREATE TABLE `account_bill` (
  `id` int(255) NOT NULL,
  `account_id` int(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `paid_amount` int(255) NOT NULL,
  `remaining_amount` int(255) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `bill_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_bill`
--

INSERT INTO `account_bill` (`id`, `account_id`, `total_amount`, `paid_amount`, `remaining_amount`, `date`, `image`, `description`, `bill_type`) VALUES
(1, 1, 10000, 0, 10000, '2023-01-07', 'Cursor types.jpeg', 'Cash', 'Sell'),
(2, 2, 2000, 0, 2000, '2023-01-08', '00e0830cf439d2599b2d21374a7ed2e1.jpg', 'Cash', 'Purchaser'),
(3, 1, 4000, 0, 4000, '2023-01-08', '8-83719_best-wallpaper-for-laptop.jpg', 'Cash', 'Sell'),
(5, 3, 7000, 7000, 0, '2023-01-09', 'bg img.jpg', 'Cash', 'Purchaser');

-- --------------------------------------------------------

--
-- Table structure for table `add_account`
--

CREATE TABLE `add_account` (
  `id` int(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `opening_balance` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_account`
--

INSERT INTO `add_account` (`id`, `account_type`, `account_name`, `phone`, `address`, `opening_balance`) VALUES
(1, 'Customer', 'Shahzaib', 2147483647, 'Karachi', 50000),
(2, 'Purchaser', 'Farhan', 896785764, 'Pathan Goth', 10000),
(3, 'Purchaser', 'Haris', 2147483647, 'Qasimabad', 20000),
(5, 'Purchaser', 'Khan', 2147483647, 'Qasimabad', 25000),
(6, 'Customer', 'Bilal', 7967855, 'Pathan Goth', 30000),
(7, 'Customer', 'Rawat', 979789797, 'Kotri', 10000),
(8, 'Customer', 'Awais', 768564747, 'Karachi', 20000),
(9, 'Customer', 'Umair', 2147483647, 'Hussainabad', 100000),
(10, 'Customer', 'asif', 2147483647, 'Karachi', 500);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(255) NOT NULL,
  `bill_type` varchar(255) NOT NULL,
  `acc_id` int(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `paid_amount` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `bill_type`, `acc_id`, `total_amount`, `paid_amount`, `date`) VALUES
(3, 'customer', 6, 16000, 16000, '2023-01-21'),
(5, 'customer', 1, 12000, 12000, '2023-01-25'),
(6, 'customer', 7, 300, 300, '2023-01-25'),
(8, 'customer', 8, 24700, 24700, '2023-01-27'),
(9, 'customer', 1, 24700, 24600, '2023-01-29'),
(10, 'customer', 9, 800, 800, '2023-01-31'),
(11, 'customer', 1, 300, 300, '2023-02-04'),
(12, 'customer', 6, 200, 200, '2023-02-04'),
(13, 'purchaser', 2, 450, 450, '2023-02-05'),
(14, 'purchaser', 3, 1050, 1050, '2023-02-05'),
(15, 'purchaser', 5, 1350, 1350, '2023-02-05'),
(16, 'customer', 10, 2400, 500, '2023-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL,
  `bill_id` text NOT NULL,
  `product_id` text NOT NULL,
  `price` text NOT NULL,
  `quantity` text NOT NULL,
  `total` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `bill_id`, `product_id`, `price`, `quantity`, `total`) VALUES
(1, '3', '4', '200', '80', '16000.00'),
(2, '4', '5', '150', '7', '1050.00'),
(3, '5', '6', '12000', '1', '12000.00'),
(4, '6', '5', '150', '2', '300.00'),
(5, '7', '5', '150', '2', '300.00'),
(6, '8', '5', '150', '2', '300.00'),
(7, '8', '4', '200', '2', '400.00'),
(8, '8', '6', '12000', '2', '24000.00'),
(9, '9', '6', '12000', '2', '24000.00'),
(10, '9', '5', '150', '2', '300.00'),
(11, '9', '4', '200', '2', '400.00'),
(12, '10', '10', '200', '4', '800.00'),
(13, '11', '5', '150', '2', '300.00'),
(14, '12', '4', '200', '1', '200.00'),
(15, '13', '5', '150', '3', '450.00'),
(16, '14', '5', '150', '3', '450.00'),
(17, '14', '4', '200', '3', '600.00'),
(18, '15', '5', '150', '3', '450.00'),
(19, '15', '4', '200', '3', '600.00'),
(20, '15', '5', '150', '2', '300.00'),
(21, '16', '4', '200', '6', '1200.00'),
(22, '16', '4', '200', '6', '1200.00');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'khan123');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `purchase_price` int(255) NOT NULL,
  `sell_price` int(255) NOT NULL,
  `opening_stock` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `variant` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `purchase_price`, `sell_price`, `opening_stock`, `image`, `unit`, `variant`, `status`) VALUES
(4, 'Pizza', 1500, 200, 2000, 'bg img.jpg', 'abc', '', 'Active'),
(5, 'Roll', 100, 150, 2000, '00e0830cf439d2599b2d21374a7ed2e1.jpg', 'abc', 'Color', 'Active'),
(6, 'Pizza', 10000, 12000, 10, '', 'piece', 'Color', 'Active'),
(7, '', 0, 0, 0, '', '', 'Array', 'Active'),
(8, '', 0, 0, 0, '', '', 'Array', 'Active'),
(9, 'Chicken Roll', 100, 150, 10, '', '', '1,2', 'Active'),
(10, 'Burger', 100, 200, 50, '', 'piece', '3', 'Active'),
(11, 'Burger', 100, 200, 50, '', 'piece', '2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `account_id` int(255) NOT NULL,
  `paid_amount` int(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_type`, `account_id`, `paid_amount`, `description`, `payment_type`, `date`) VALUES
(2, 'Customer', 1, 600000, 'test', 'Cash', '2023-01-25'),
(3, 'Purchaser', 2, 800, 'text', 'Cash', '2023-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `id` int(255) NOT NULL,
  `variant_name` varchar(500) NOT NULL,
  `variant_value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id`, `variant_name`, `variant_value`) VALUES
(1, 'size', 'L'),
(2, 'Color', 'Red'),
(3, 'Flavour', 'Pepsi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_bill`
--
ALTER TABLE `account_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_account`
--
ALTER TABLE `add_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_bill`
--
ALTER TABLE `account_bill`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `add_account`
--
ALTER TABLE `add_account`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
