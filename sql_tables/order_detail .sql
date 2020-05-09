-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2019 at 11:32 AM
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
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` varchar(6) NOT NULL,
  `pid` varchar(3) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` float NOT NULL,
  `image` text NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `pid`, `quantity`, `price`, `image`, `name`) VALUES
('213550', 'Amm', 1, 20, 'productimages/bev_coke.jpg', 'Coke'),
('213550', 'E4L', 4, 120, 'productimages/Pizza.jpg', 'Pizza'),
('227879', 'A1B', 1, 150, 'productimages/burger.jpg', 'Burger'),
('246754', 'E4L', 1, 120, 'productimages/Pizza.jpg', 'Pizza'),
('278766', 'A1B', 2, 150, 'productimages/burger.jpg', 'Burger'),
('278766', 'Amm', 1, 20, 'productimages/bev_coke.jpg', 'Coke'),
('278766', 'FFF', 3, 75, 'productimages/frittata.jpg', 'Frittata'),
('718028', 'A1B', 1, 150, 'productimages/burger.jpg', 'Burger'),
('718028', 'FFF', 1, 75, 'productimages/frittata.jpg', 'Frittata');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
