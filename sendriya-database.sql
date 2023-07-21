-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2023 at 05:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sendriyah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@example.com', '$2y$10$OQmFSA.GKAPOD5AWHUJdhes0QZ4f0XH7xzQtv5wXbqh35mdZmZXWu');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(9, 'fruits'),
(10, 'vegetables'),
(11, 'grocery');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `orderBy` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Title`, `Category`, `Description`, `Price`, `Quantity`, `image`, `time`) VALUES
(1, 'G5 Granuels', 'Branded', 'G-5 organic granular fertilizer is world’s first multi-activity granules. Five different contents of G-5 not only brings about plant and root growth but also protects plants from pest-fungal attack and damping off/root.', 207, 145, 'e58daed17298c7445cf9f0952f974628.jpeg', '2023-01-19 15:00:42'),
(2, 'Foliar', 'Branded', 'NaNa', 187, 50, '8073b0e300729671a836f9d68e4044fe.jpg', '2023-01-19 15:09:34'),
(5, 'Relive', 'Branded', '', 417, 23, 'ff4fa6cb0dbae10c42c796c37d5e2f2c.jpeg', '2023-01-19 15:15:26'),
(6, 'Orgafung', 'Branded', '', 399, 156, 'f90fa8129a0d91852ac0bd8dc1ea4165.png', '2023-01-19 15:21:34'),
(7, 'Orgasuck', 'Branded', '', 314, 434, 'dc908a5bb30586e915987297e6750845.png', '2023-01-19 15:22:43'),
(11, 'masoor', 'Organically', 'earth fresh masoor dal', 78, 20, '7e5087e0ccee85aaf032511c4d09c41a.jfif', '2023-01-28 12:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `cart` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `address`, `cart`, `time`) VALUES
(5, 'user1', '7894561236', 'user1@example.com', '$2y$10$od4QQR6qsy6Tes2j3RB//uW4Q/Drgh79QARqwXu9MOrlwIs0zqkMq', 'userAddress', '', '2023-01-20 18:35:35'),
(6, 'user 2', '7894561235', 'user2@gmail.com', '$2y$10$2hwne.vCV00Id4SWooN5hOeDuy2MMLjNIaLJqpqq7mdWTARc95K/i', 'user 2 address', '', '2023-01-25 10:43:19'),
(7, 'pooja nipane', '8419944604', 'pooja31@gmail.com', '$2y$10$.fbTLLuu5Xz/JqJOfqKSv.GoDPeB5N/nbz82krdFqtDSglugUNNdm', '3 F trimurti sangarsha nagar chandivali farm road andheri E 400072\r\nNear chatrapati shivaji maharaj statue', '', '2023-02-25 19:48:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image` (`image`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
