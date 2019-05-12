-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2019 at 04:15 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sik`
--

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `id_bom` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `quantity` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`id_bom`, `name`, `quantity`, `fk_product`, `created_by`, `datecreated`) VALUES
(2, '1', 1, 1, 2, '2019-05-12 03:14:57'),
(3, 'asd', 1, 1, 2, '2019-05-12 06:19:57'),
(4, 'Aldhan Biuzar Yahya', 10, 5, 2, '2019-05-12 13:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `bom_component`
--

CREATE TABLE `bom_component` (
  `id_bom_component` int(11) NOT NULL,
  `fk_bom` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bom_component`
--

INSERT INTO `bom_component` (`id_bom_component`, `fk_bom`, `fk_product`, `quantity`) VALUES
(18, 3, 1, 1),
(19, 4, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturing`
--

CREATE TABLE `manufacturing` (
  `id_manufacturing` int(11) NOT NULL,
  `fk_bom` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturing`
--

INSERT INTO `manufacturing` (`id_manufacturing`, `fk_bom`, `quantity`, `status`, `created_by`, `datecreated`) VALUES
(2, 2, 1, 4, 2, '2019-05-12 03:17:00'),
(3, 2, 1, 4, 2, '2019-05-12 06:59:31'),
(4, 3, 10, 4, 2, '2019-05-12 07:22:15'),
(5, 4, 10, 4, 2, '2019-05-12 13:16:32'),
(6, 2, 1, 4, 2, '2019-05-12 13:29:44'),
(7, 4, 1, 0, 2, '2019-05-12 13:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name`, `price`, `quantity`, `image`, `type`, `created_by`, `datecreated`) VALUES
(1, '1', 1, 103, '3f9a24d18d2b2217ac68a52e73fcff74.jpg', 1, 2, '2019-05-12 02:48:58'),
(4, 'ald ans sorry', 1, 100, '38033b020e4eae7edd06c6e033e9ceb0.png', 1, 2, '2019-05-12 04:37:38'),
(5, 'Aldhan', 100000, 20, '4375f57a7ee08f7c35691093751f370f.png', 1, 2, '2019-05-12 13:15:20'),
(6, 'Ald_han', 1000, 0, 'bfd6c84b5a64a283e27e6a6ca40f8bca.png', 1, 2, '2019-05-12 13:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` int(1) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `password`, `role`, `is_active`, `created_by`, `datecreated`) VALUES
(2, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, NULL, '2019-05-12 01:53:16'),
(11, '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, 2, '2019-05-12 04:23:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`id_bom`),
  ADD KEY `fk_product` (`fk_product`),
  ADD KEY `create_by` (`created_by`);

--
-- Indexes for table `bom_component`
--
ALTER TABLE `bom_component`
  ADD PRIMARY KEY (`id_bom_component`),
  ADD KEY `fk_bom` (`fk_bom`),
  ADD KEY `fk_product` (`fk_product`);

--
-- Indexes for table `manufacturing`
--
ALTER TABLE `manufacturing`
  ADD PRIMARY KEY (`id_manufacturing`),
  ADD KEY `fk_bom` (`fk_bom`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bom`
--
ALTER TABLE `bom`
  MODIFY `id_bom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bom_component`
--
ALTER TABLE `bom_component`
  MODIFY `id_bom_component` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `manufacturing`
--
ALTER TABLE `manufacturing`
  MODIFY `id_manufacturing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bom`
--
ALTER TABLE `bom`
  ADD CONSTRAINT `bom_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `bom_component`
--
ALTER TABLE `bom_component`
  ADD CONSTRAINT `bom_component_ibfk_1` FOREIGN KEY (`fk_bom`) REFERENCES `bom` (`id_bom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bom_component_ibfk_2` FOREIGN KEY (`fk_product`) REFERENCES `product` (`id_product`);

--
-- Constraints for table `manufacturing`
--
ALTER TABLE `manufacturing`
  ADD CONSTRAINT `manufacturing_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_users`),
  ADD CONSTRAINT `manufacturing_ibfk_2` FOREIGN KEY (`fk_bom`) REFERENCES `bom` (`id_bom`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
