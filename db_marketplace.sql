-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 03:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('success','process','failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_product`, `qty`, `price`, `status`) VALUES
(1, 3, 1, 1, 150000, 'process'),
(2, 3, 3, 2, 400000, 'process');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(1, 'horror'),
(2, 'fiction'),
(3, 'Sci-Fi'),
(4, 'Education'),
(5, 'Biography');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `author` varchar(1000) NOT NULL,
  `price` int(15) NOT NULL,
  `stock` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `id_category`, `img`, `title`, `author`, `price`, `stock`) VALUES
(1, 1, '653b2a6b51175.png', 'call of cthulu', 'h.p.lovecraft', 150000, 1000),
(3, 2, '653af9a914dc5.png', 'batman: the killing joke', 'alan moore', 200000, 150),
(4, 2, '653af9e5cb847.png', 'batman: white knight', 'sean murphy', 130000, 200),
(5, 5, '653afa8661bf6.png', 'My Inventions', 'nikola tesla', 120000, 70);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(60) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `phnumber` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `gender`, `birthdate`, `address`, `phnumber`, `img`, `role`) VALUES
(1, 'admin', '$2y$10$R19tOsiRt3FBUrrVDi1BIej3Wky4hoRFXZiVZINIwP2tuWNcRip9i', 'admin@gmail.com', 'male', '1111-11-11', 'admin', '087820983999', '654425b234713.png', 'admin'),
(3, 'raihan123', '$2y$10$rZjqU2k61AnZjxhadfpRXOifzwOVzfKfHQbs7GFHRKGQhWWEeaN3i', 'raihanjansmaillendra.rjs@gmail.com', 'male', '2001-01-02', 'Jln Buana Megah Blok B1 No 50 Buana Garden', '087820983999', '1697541893_1.png', 'admin'),
(4, 'jane smith', '$2y$10$0yiQ6qMqWtOVg2SDuSD3RuXO18Z//IOhpvHU9iaZIIXYgyqpaxFK2', 'jane123@gmail.com', 'female', '1999-01-20', 'mango street number 12', '087829798', '6544317f88a65.png', 'admin'),
(7, 'ducky', '$2y$10$7IuPl23PwVeWJNas5n4SbOui/lRQSu.6NVz98ngvJF4zUx2DK43Ka', 'duck@yahoo.com', 'male', '1997-10-21', 'River street number 12', '087890385919', '1697637775_3.gif', 'user'),
(8, 'sammy', '$2y$10$.115ETJpvcH4yvkQFpnDget9Gn1qxG0j0qH1RZL7AYnyTrYKCW9Ha', 'sammy123@gmail.com', 'male', '2000-05-11', 'Wich avenue number 9', '087820913123', '1697637901_3.png', 'user'),
(9, 'jameson12', '$2y$10$L0CVMTcxz7i39Y5.91e2LObHOWU7/MDMNuWn55/.X5joGDVybKIfe', 'Jameson12@gmail.com', 'male', '1999-11-11', 'random street number 11', '087820983111', '6539cc2741b58.png', 'user'),
(15, 'raveenov02', '$2y$10$HBh/KbFmb.sbdaKx8gLJF.wppNmhNLl8zrUSJtcMNcStjjIyLXNM6', 'raihanjansmaillendra.rjs@gmail.com', 'male', '2001-01-02', 'Jln Buana Megah Blok B1 No 50 Buana Garden', '087820983999', '653ab48337929.png', 'user'),
(16, 'jane123', '$2y$10$Uu.f.LQ24JHkNJr7JL4qpulZGqHgxh8DwjKTkYijkswPZ1hmhvbEm', 'jane123@gmail.com', 'female', '1999-12-11', 'mangga street number 12', '384243847249', '653ef5e41850e.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
