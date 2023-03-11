-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2023 at 12:05 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qalam_mis_dental_version`
--

-- --------------------------------------------------------

--
-- Table structure for table `alterant`
--

CREATE TABLE `alterant` (
  `id` int(11) NOT NULL,
  `main_product` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `main_product_amount` float NOT NULL,
  `first_catched_product` int(11) NOT NULL,
  `first_catched_product_amount` float NOT NULL,
  `second_catched_product` int(11) NOT NULL,
  `second_catched_product_amount` float NOT NULL,
  `expense_per_ton` float NOT NULL,
  `losses_amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL,
  `party_number` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL,
  `purchase_commission` tinyint(4) NOT NULL,
  `purchase_office_expense` float NOT NULL,
  `commission_taker` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_takers`
--

CREATE TABLE `commission_takers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` text COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `base` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `base`) VALUES
(2, 'افغانی', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` text COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_billance`
--

CREATE TABLE `customer_billance` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_persian_ci NOT NULL,
  `credit_amount` float NOT NULL,
  `debit_amount` float NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(50) DEFAULT NULL,
  `sale_id` int(50) DEFAULT NULL,
  `currency_id` int(50) NOT NULL,
  `rate` float NOT NULL,
  `commission` float NOT NULL,
  `transfer_supplier` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `ex_cate_id` int(50) NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL,
  `amount` float NOT NULL,
  `rate` float NOT NULL,
  `currenycy_id` int(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_categories`
--

CREATE TABLE `expenses_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `losses`
--

CREATE TABLE `losses` (
  `id` int(11) NOT NULL,
  `alterant_id` int(50) NOT NULL,
  `losses_amount` float NOT NULL,
  `price_per_ton` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderer` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL,
  `price` float NOT NULL,
  `currency_id` int(50) NOT NULL,
  `rate` float NOT NULL,
  `register_date` text COLLATE utf8mb4_persian_ci NOT NULL,
  `return_date` text COLLATE utf8mb4_persian_ci NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'بدخشان'),
(2, 'بادغیس'),
(3, 'بغلان'),
(4, 'بلخ'),
(5, 'بامیان'),
(6, 'دایکندی'),
(7, 'فراه'),
(8, 'فاریاب'),
(9, ' غزنی'),
(11, ' غور'),
(12, 'هلمند'),
(13, 'هرات'),
(14, 'جوزجان'),
(15, 'کابل'),
(16, 'کندهار'),
(17, 'کاپیسا'),
(18, 'خوست'),
(19, 'کنر'),
(20, 'کندز'),
(21, 'لغمان'),
(22, 'لوگر'),
(23, 'ننگرهار'),
(24, 'نیمروز'),
(25, 'نورستان'),
(26, 'ارزگان'),
(27, 'پکتیا'),
(28, 'پکتیکا'),
(29, 'پنجشیر'),
(30, 'پروان'),
(31, 'سمنگان'),
(32, 'سرپل'),
(33, 'تخار'),
(34, 'وردک'),
(35, 'زابل');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_major`
--

CREATE TABLE `purchase_major` (
  `id` int(11) NOT NULL,
  `supplier_id` int(50) DEFAULT NULL,
  `reciept` float NOT NULL,
  `currency_id` int(50) NOT NULL,
  `date` date NOT NULL,
  `file` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `party_number` text COLLATE utf8mb4_persian_ci NOT NULL,
  `alterant` int(10) DEFAULT NULL,
  `purchase_status` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_minor`
--

CREATE TABLE `purchase_minor` (
  `id` int(11) NOT NULL,
  `purchase_major_id` int(50) NOT NULL,
  `item_id_stock_major` int(50) NOT NULL,
  `amount` float NOT NULL,
  `purchase_price` float NOT NULL,
  `sale_price` float NOT NULL,
  `vagon_quantity` float NOT NULL,
  `per_vagon_weight` float NOT NULL,
  `vagon_number` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `office_expense` float NOT NULL,
  `commision_expense` float NOT NULL,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reciepts`
--

CREATE TABLE `reciepts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `amount` float NOT NULL,
  `commission` float NOT NULL,
  `currency_id` int(150) NOT NULL,
  `rate` float NOT NULL,
  `purchase_id` int(150) DEFAULT NULL,
  `sale_id` int(150) DEFAULT NULL,
  `date` date NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL,
  `supplier_id` int(100) DEFAULT NULL,
  `customer_id` int(50) DEFAULT NULL,
  `purchase_commission` int(50) NOT NULL,
  `transfer` int(10) NOT NULL,
  `purchase_office_expense` float NOT NULL,
  `commission_taker_id` int(50) DEFAULT NULL,
  `supp_purchase_id` int(50) DEFAULT NULL,
  `cus_sale_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_major`
--

CREATE TABLE `sale_major` (
  `id` int(11) NOT NULL,
  `customer_id` int(50) DEFAULT NULL,
  `reciept` float NOT NULL,
  `currency_id` int(50) NOT NULL,
  `date` date NOT NULL,
  `alterant_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_minor`
--

CREATE TABLE `sale_minor` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `sale_rate` float NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL,
  `purchase_minor_id` int(100) NOT NULL,
  `sale_major_id` int(50) NOT NULL,
  `expense` float NOT NULL,
  `commission` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shafaf`
--

CREATE TABLE `shafaf` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `amount` float NOT NULL,
  `type` int(50) NOT NULL,
  `commission` float NOT NULL,
  `currency_id` int(50) NOT NULL,
  `rate` float NOT NULL,
  `date` date NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shafaf_transaction_type`
--

CREATE TABLE `shafaf_transaction_type` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` text COLLATE utf8mb4_persian_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_major`
--

CREATE TABLE `stock_major` (
  `id` int(11) NOT NULL,
  `item_id` int(50) NOT NULL,
  `amount` float NOT NULL,
  `unit_id` int(50) NOT NULL,
  `minor_unit_id` int(50) NOT NULL,
  `barcode` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `less_then` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_minor`
--

CREATE TABLE `stock_minor` (
  `id` int(11) NOT NULL,
  `item_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` text COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_billance`
--

CREATE TABLE `supplier_billance` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_persian_ci NOT NULL,
  `credit_amount` float NOT NULL,
  `debit_amount` float NOT NULL,
  `date` date NOT NULL,
  `supplier_id` int(50) DEFAULT NULL,
  `purchase_id` int(50) DEFAULT NULL,
  `currency_id` int(50) NOT NULL,
  `rate` float NOT NULL,
  `commission` float NOT NULL,
  `transfer_supplier` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_major`
--

CREATE TABLE `unit_major` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `unit_major`
--

INSERT INTO `unit_major` (`id`, `unit_name`) VALUES
(1, 'دانه');

-- --------------------------------------------------------

--
-- Table structure for table `unit_minor`
--

CREATE TABLE `unit_minor` (
  `id` int(11) NOT NULL,
  `unit_major_id` int(50) NOT NULL,
  `unit_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `pack_quantity` float NOT NULL,
  `major_factor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `unit_minor`
--

INSERT INTO `unit_minor` (`id`, `unit_major_id`, `unit_name`, `pack_quantity`, `major_factor`) VALUES
(1, 1, 'دانه', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `user_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `authority` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `employee_id`, `user_name`, `password`, `authority`) VALUES
(2, 2, 'admin', 'YWRtaW4=', 'SuperAdmin'),
(5, 1, 'faroq', 'ZmFyb3E=', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alterant`
--
ALTER TABLE `alterant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_takers`
--
ALTER TABLE `commission_takers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id_1` (`province_id`);

--
-- Indexes for table `customer_billance`
--
ALTER TABLE `customer_billance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_customer_x1` (`customer_id`),
  ADD KEY `to_sale_major_x1` (`sale_id`),
  ADD KEY `to_cu_xx2` (`currency_id`),
  ADD KEY `to_transfer_customer` (`transfer_supplier`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_ex_cat` (`ex_cate_id`),
  ADD KEY `to_currency_id_1` (`currenycy_id`);

--
-- Indexes for table `expenses_categories`
--
ALTER TABLE `expenses_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `losses`
--
ALTER TABLE `losses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_currency_id_ww` (`currency_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_major`
--
ALTER TABLE `purchase_major`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_currency_id_2` (`currency_id`),
  ADD KEY `to_alterant_01` (`alterant`),
  ADD KEY `to_supplier_id_1` (`supplier_id`);

--
-- Indexes for table `purchase_minor`
--
ALTER TABLE `purchase_minor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_purchase_major` (`purchase_major_id`),
  ADD KEY `to_stock_major_id` (`item_id_stock_major`);

--
-- Indexes for table `reciepts`
--
ALTER TABLE `reciepts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_currency_3` (`currency_id`),
  ADD KEY `ro_purchase_major` (`purchase_id`),
  ADD KEY `to_sale_major` (`sale_id`),
  ADD KEY `to_sup_pur_id` (`supp_purchase_id`),
  ADD KEY `to_cus_sale_id` (`cus_sale_id`);

--
-- Indexes for table `sale_major`
--
ALTER TABLE `sale_major`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_currency_4` (`currency_id`),
  ADD KEY `to_customer_id` (`customer_id`),
  ADD KEY `to_alterant_02` (`alterant_id`);

--
-- Indexes for table `sale_minor`
--
ALTER TABLE `sale_minor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_sale_major_2` (`sale_major_id`),
  ADD KEY `to_purchase_minor_2` (`purchase_minor_id`);

--
-- Indexes for table `shafaf`
--
ALTER TABLE `shafaf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shafaf_transaction_type`
--
ALTER TABLE `shafaf_transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_major`
--
ALTER TABLE `stock_major`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD UNIQUE KEY `item_id` (`item_id`),
  ADD KEY `to_stock_minor_id` (`item_id`),
  ADD KEY `to_major_unit` (`unit_id`),
  ADD KEY `to_unit_minor` (`minor_unit_id`);

--
-- Indexes for table `stock_minor`
--
ALTER TABLE `stock_minor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_billance`
--
ALTER TABLE `supplier_billance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_supplier_xx1` (`supplier_id`),
  ADD KEY `to_currency_xx1` (`currency_id`),
  ADD KEY `to_tr_sup_x1` (`transfer_supplier`),
  ADD KEY `to_purchase_x1_major` (`purchase_id`);

--
-- Indexes for table `unit_major`
--
ALTER TABLE `unit_major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_minor`
--
ALTER TABLE `unit_minor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_unit_major_x` (`unit_major_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alterant`
--
ALTER TABLE `alterant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commission_takers`
--
ALTER TABLE `commission_takers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_billance`
--
ALTER TABLE `customer_billance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses_categories`
--
ALTER TABLE `expenses_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `losses`
--
ALTER TABLE `losses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `purchase_major`
--
ALTER TABLE `purchase_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_minor`
--
ALTER TABLE `purchase_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reciepts`
--
ALTER TABLE `reciepts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sale_major`
--
ALTER TABLE `sale_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sale_minor`
--
ALTER TABLE `sale_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shafaf`
--
ALTER TABLE `shafaf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shafaf_transaction_type`
--
ALTER TABLE `shafaf_transaction_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_major`
--
ALTER TABLE `stock_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_minor`
--
ALTER TABLE `stock_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier_billance`
--
ALTER TABLE `supplier_billance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_major`
--
ALTER TABLE `unit_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `unit_minor`
--
ALTER TABLE `unit_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `province_id_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Constraints for table `customer_billance`
--
ALTER TABLE `customer_billance`
  ADD CONSTRAINT `to_cu_xx2` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `to_customer_x1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_sale_major_x1` FOREIGN KEY (`sale_id`) REFERENCES `sale_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_transfer_customer` FOREIGN KEY (`transfer_supplier`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `to_currency_id_1` FOREIGN KEY (`currenycy_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_ex_cat` FOREIGN KEY (`ex_cate_id`) REFERENCES `expenses_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `to_currency_id_ww` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `purchase_major`
--
ALTER TABLE `purchase_major`
  ADD CONSTRAINT `to_alterant_01` FOREIGN KEY (`alterant`) REFERENCES `alterant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_currency_id_2` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_supplier_id_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_minor`
--
ALTER TABLE `purchase_minor`
  ADD CONSTRAINT `to_purchase_major` FOREIGN KEY (`purchase_major_id`) REFERENCES `purchase_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_stock_major_id` FOREIGN KEY (`item_id_stock_major`) REFERENCES `stock_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reciepts`
--
ALTER TABLE `reciepts`
  ADD CONSTRAINT `ro_purchase_major` FOREIGN KEY (`purchase_id`) REFERENCES `purchase_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_currency_3` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_cus_sale_id` FOREIGN KEY (`cus_sale_id`) REFERENCES `sale_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_sale_major` FOREIGN KEY (`sale_id`) REFERENCES `sale_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_sup_pur_id` FOREIGN KEY (`supp_purchase_id`) REFERENCES `purchase_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_major`
--
ALTER TABLE `sale_major`
  ADD CONSTRAINT `to_alterant_02` FOREIGN KEY (`alterant_id`) REFERENCES `alterant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_currency_4` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_minor`
--
ALTER TABLE `sale_minor`
  ADD CONSTRAINT `to_purchase_minor_2` FOREIGN KEY (`purchase_minor_id`) REFERENCES `purchase_minor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_sale_major_2` FOREIGN KEY (`sale_major_id`) REFERENCES `sale_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_major`
--
ALTER TABLE `stock_major`
  ADD CONSTRAINT `to_major_unit` FOREIGN KEY (`unit_id`) REFERENCES `unit_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_stock_minor_id` FOREIGN KEY (`item_id`) REFERENCES `stock_minor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_unit_minor` FOREIGN KEY (`minor_unit_id`) REFERENCES `unit_minor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `supplier_billance`
--
ALTER TABLE `supplier_billance`
  ADD CONSTRAINT `to_currency_xx1` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `to_purchase_x1_major` FOREIGN KEY (`purchase_id`) REFERENCES `purchase_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_supplier_xx1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_tr_sup_x1` FOREIGN KEY (`transfer_supplier`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_minor`
--
ALTER TABLE `unit_minor`
  ADD CONSTRAINT `to_unit_major_x` FOREIGN KEY (`unit_major_id`) REFERENCES `unit_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
