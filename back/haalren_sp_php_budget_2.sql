-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-haalren.alwaysdata.net
-- Generation Time: Apr 27, 2020 at 08:22 PM
-- Server version: 10.3.17-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haalren_sp_php_budget`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE `category_type` (
  `idcategory_type` int(11) NOT NULL,
  `label` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`idcategory_type`, `label`) VALUES
(1, 'débit'),
(2, 'crédit');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `idpayment` int(11) NOT NULL,
  `user_iduser` int(11) NOT NULL,
  `payment_method_idpaying_method` int(11) NOT NULL,
  `payment_category_idpayment_category` int(11) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idpayment`, `user_iduser`, `payment_method_idpaying_method`, `payment_category_idpayment_category`, `amount`, `date`) VALUES
(1, 1, 1, 1, 49.35, '2020-03-11'),
(2, 1, 2, 2, 247.34, '2020-03-22'),
(3, 1, 1, 3, 7.95, '2020-03-23'),
(4, 1, 1, 3, 15.9, '2020-03-23'),
(5, 1, 1, 3, 7.95, '2020-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `payment_category`
--

CREATE TABLE `payment_category` (
  `idpayment_category` int(11) NOT NULL,
  `label` varchar(45) NOT NULL,
  `category_type_idcategory_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_category`
--

INSERT INTO `payment_category` (`idpayment_category`, `label`, `category_type_idcategory_type`) VALUES
(1, 'alimentation', 1),
(2, 'matériel', 1),
(3, 'menu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `idpaying_method` int(11) NOT NULL,
  `label` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`idpaying_method`, `label`) VALUES
(1, 'carte bancaire'),
(2, 'virement');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `firstname`, `lastname`, `login`, `password`) VALUES
(1, 'ramy', 'el-hani', 'ramy.elhani', '63a9f0ea7bb98050796b649e85481845');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_type`
--
ALTER TABLE `category_type`
  ADD PRIMARY KEY (`idcategory_type`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idpayment`),
  ADD KEY `fk_payment_user_idx` (`user_iduser`),
  ADD KEY `fk_payment_payment_method1_idx` (`payment_method_idpaying_method`),
  ADD KEY `fk_payment_payment_category1_idx` (`payment_category_idpayment_category`);

--
-- Indexes for table `payment_category`
--
ALTER TABLE `payment_category`
  ADD PRIMARY KEY (`idpayment_category`),
  ADD KEY `fk_payment_category_category_type1_idx` (`category_type_idcategory_type`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`idpaying_method`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `iduser_UNIQUE` (`iduser`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `idcategory_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `idpayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_category`
--
ALTER TABLE `payment_category`
  MODIFY `idpayment_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `idpaying_method` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_payment_category1` FOREIGN KEY (`payment_category_idpayment_category`) REFERENCES `payment_category` (`idpayment_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_payment_method1` FOREIGN KEY (`payment_method_idpaying_method`) REFERENCES `payment_method` (`idpaying_method`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_user` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_category`
--
ALTER TABLE `payment_category`
  ADD CONSTRAINT `fk_payment_category_category_type1` FOREIGN KEY (`category_type_idcategory_type`) REFERENCES `category_type` (`idcategory_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
