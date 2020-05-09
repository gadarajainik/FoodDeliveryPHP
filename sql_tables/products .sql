-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2019 at 11:31 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` varchar(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `category` varchar(15) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `price`, `category`, `image`) VALUES
('A1B', 'Burger', 80, 'mains', 'productimages/burger.jpg'),
('A1C', 'Garlic Bread', 80, 'sides', 'productimages/garlic_bread.jpg'),
('AKJ', 'Sprite', 20, 'beverages', 'productimages/bev_sprite.jpg'),
('Amm', 'Coke', 20, 'beverages', 'productimages/bev_coke.jpg'),
('AWQ', 'Fanta', 20, 'beverages', 'productimages/bev_fanta.jpg'),
('AWS', 'Mountain Dew', 20, 'beverages', 'productimages/bev_mountaindew.jpg'),
('BRW', 'Brownie', 40, 'dessert', 'productimages/brownie.jpg'),
('E4L', 'Pizza', 120, 'mains', 'productimages/Pizza.jpg'),
('FFF', 'Frittata', 75, 'mains', 'productimages/frittata.jpg'),
('min', 'Mini', 50, 'sides', 'productimages/mini.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
