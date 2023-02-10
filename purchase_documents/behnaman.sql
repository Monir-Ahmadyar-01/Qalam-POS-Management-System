-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 05:24 AM
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
-- Database: `behnaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `bardasht`
--

CREATE TABLE `bardasht` (
  `id` int(11) NOT NULL,
  `emp_id` int(50) NOT NULL,
  `bardasht_amount` int(11) NOT NULL,
  `rate` float NOT NULL,
  `total_dollar` float(20,2) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bardasht`
--

INSERT INTO `bardasht` (`id`, `emp_id`, `bardasht_amount`, `rate`, `total_dollar`, `description`, `date`) VALUES
(9, 8, 90, 100, 0.90, 'موجود نیست ', '2022-08-02'),
(10, 8, 3500, 100, 35.00, 'موجود نیست ', '2022-08-02'),
(11, 8, 150, 120, 1.25, 'موجود نیست ', '2022-08-02'),
(12, 14, 500, 200, 500.00, 'hjhkjkjk', '2022-08-16'),
(13, 8, 10500, 90, 116.67, 'موجود نیست ', '2022-08-16');

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
(1, 'دالر', 1),
(2, 'افغانی', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `code_no` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `company_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `email_address` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` text COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `code_no`, `full_name`, `company_name`, `phone_number`, `email_address`, `status`, `address`, `date`) VALUES
(1, ' B-001', 'Ahmad Masih Ahmadyar', 'یبب', '0797548234', 'masihahmadyar@yahoo.com', 'غیر فعال', 'Guzar Hazda Chaman', '2022-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `install_date` date NOT NULL,
  `valid_date` date NOT NULL,
  `equipment` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `emp_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` (`id`, `customer_id`, `install_date`, `valid_date`, `equipment`, `emp_id`) VALUES
(36, '1', '2022-08-13', '2022-08-19', '- روتر    - 20 متر لین', '8');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `ex_cate_id` int(50) NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL,
  `amount` float NOT NULL,
  `rate` float NOT NULL,
  `currenycy_id` int(50) NOT NULL,
  `total_dollar` float(20,3) NOT NULL,
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

--
-- Dumping data for table `expenses_categories`
--

INSERT INTO `expenses_categories` (`id`, `name`) VALUES
(1, 'کرایه نان چاشت'),
(2, 'کرایه ماهانه ');

-- --------------------------------------------------------

--
-- Table structure for table `fixed_assets`
--

CREATE TABLE `fixed_assets` (
  `id` int(11) NOT NULL,
  `item_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `staff_id` int(11) NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `serial_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `bill_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixed_assets`
--

INSERT INTO `fixed_assets` (`id`, `item_name`, `staff_id`, `description`, `serial_number`, `bill_no`, `quantity`, `price`, `purchase_date`, `date`) VALUES
(2, 'لپتاپ تjk', 8, 'موجود نیست jk', '7878787878l3212', '898e', 10, 1000, '2022-08-15', '2022-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `info_id` int(11) NOT NULL,
  `logo` varchar(510) COLLATE utf8mb4_persian_ci NOT NULL,
  `persion_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_persian_ci NOT NULL,
  `email` varchar(510) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` text COLLATE utf8mb4_persian_ci NOT NULL,
  `backup_address` varchar(510) COLLATE utf8mb4_persian_ci NOT NULL,
  `slogan` text COLLATE utf8mb4_persian_ci NOT NULL,
  `website` varchar(510) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`info_id`, `logo`, `persion_name`, `phone`, `email`, `address`, `backup_address`, `slogan`, `website`) VALUES
(1, '', 'شرکت خدمات انترنتی بهنامان', '0786267943', 'info@behnaman.af', 'چهارراهی محب، سرک راضیه عالمی، بیک پلازا', 'C:\\xampp\\htdocs\\behnaman\\backup', 'خدمات انترنتی با کیفیت در سطح مزارشریف', 'www.behnaman.af');

-- --------------------------------------------------------

--
-- Table structure for table `initial_investment`
--

CREATE TABLE `initial_investment` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `initial_investment`
--

INSERT INTO `initial_investment` (`id`, `full_name`, `amount`, `description`, `date`) VALUES
(5, 'کریم امینی ', 200, 'موجود نیست ', '2022-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `internet_purchase`
--

CREATE TABLE `internet_purchase` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `comp_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `rate_id` float NOT NULL,
  `total_dollar` float(20,3) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `receipt` int(11) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internet_purchase`
--

INSERT INTO `internet_purchase` (`id`, `bill_number`, `comp_id`, `pack_id`, `price`, `currency_id`, `rate_id`, `total_dollar`, `description`, `receipt`, `purchase_date`) VALUES
(23, ' PA-0023', 1, 3, 98, 0, 8, 0.000, 'jkj', 88, '2022-08-13'),
(24, ' PA-0024', 1, 3, 900, 1, 90, 900.000, 'موجود نیست', 300, '2022-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `internet_sale`
--

CREATE TABLE `internet_sale` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `cust_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `pack_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `sale_pr` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `rate_id` float NOT NULL,
  `total_dollar` float(20,3) NOT NULL,
  `referral` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `equipment` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `receipt` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internet_sale`
--

INSERT INTO `internet_sale` (`id`, `bill_number`, `cust_id`, `pack_id`, `pack_type`, `sale_pr`, `currency_id`, `rate_id`, `total_dollar`, `referral`, `equipment`, `description`, `discount`, `receipt`, `sale_date`, `start_date`) VALUES
(55, ' SA-055', 1, 6, 'تمدید', 78, 0, 78, 0.000, 'ui', 'ضمانت', 'ui', 10, 7, '2022-08-12', '2022-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `month_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`id`, `month_name`) VALUES
(1, 'جنوری'),
(2, 'فبروری'),
(3, 'مارچ'),
(4, 'آپریل'),
(5, 'می'),
(6, 'جون'),
(7, 'جولای'),
(8, 'آگوست'),
(9, 'سپتمبر'),
(10, 'اکتوبر'),
(11, 'نومبر'),
(12, 'دسمبر');

-- --------------------------------------------------------

--
-- Table structure for table `onlease`
--

CREATE TABLE `onlease` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(50) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `usage_cost` int(11) NOT NULL,
  `rate` float(20,3) NOT NULL,
  `total_dollar` float(20,3) NOT NULL,
  `emp_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `onlease_minor`
--

CREATE TABLE `onlease_minor` (
  `id` int(11) NOT NULL,
  `stock_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `stock_item_unit` int(11) NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `rate_id` float(20,2) NOT NULL,
  `total_dollar` float(20,3) NOT NULL,
  `pay` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `emp_id`, `month`, `amount`, `currency_id`, `rate_id`, `total_dollar`, `pay`, `date`) VALUES
(10, 8, '1', 9649, 0, 90.00, 107.211, 'اجرا شد', '2022-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_major`
--

CREATE TABLE `purchase_major` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `supplier_id` int(50) DEFAULT NULL,
  `currency_id` int(50) NOT NULL,
  `rate` float NOT NULL,
  `date` date NOT NULL,
  `receipt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_minor`
--

CREATE TABLE `purchase_minor` (
  `id` int(11) NOT NULL,
  `purchase_major_id` int(50) NOT NULL,
  `item_id_stock_major` int(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` float NOT NULL,
  `purchase_price` float NOT NULL,
  `extra_expense` int(11) NOT NULL,
  `total_dollar` float(20,3) NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `purchase_minor`
--

INSERT INTO `purchase_minor` (`id`, `purchase_major_id`, `item_id_stock_major`, `quantity`, `amount`, `purchase_price`, `extra_expense`, `total_dollar`, `details`) VALUES
(1, 2, 7, 10, 30, 200, 50, 55.000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `reciepts`
--

CREATE TABLE `reciepts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `amount` float NOT NULL,
  `currency_id` int(150) NOT NULL,
  `rate` float NOT NULL,
  `total_dollar` float(20,2) NOT NULL,
  `internet_purchase_id` int(11) DEFAULT NULL,
  `internet_sale_id` int(11) DEFAULT NULL,
  `device_sale_id` int(11) NOT NULL,
  `device_purchase_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `reciepts`
--

INSERT INTO `reciepts` (`id`, `full_name`, `amount`, `currency_id`, `rate`, `total_dollar`, `internet_purchase_id`, `internet_sale_id`, `device_sale_id`, `device_purchase_id`, `date`, `details`) VALUES
(1, 'ahmad', 200, 12, 97, 0.00, 89, 6, 0, 0, '2022-07-31', 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `register_package`
--

CREATE TABLE `register_package` (
  `id` int(11) NOT NULL,
  `package_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register_package`
--

INSERT INTO `register_package` (`id`, `package_name`, `description`, `date`) VALUES
(3, 'بسته 120 جی بی ماهانه', '-', '2022-08-13 17:54:43'),
(5, 'بسته 100 جی بی ', '3 ام بی سرعت', '2022-08-11 17:21:38'),
(6, 'بسته 120 جی بی ماهانه', 'یک ام بی', '2022-08-11 17:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `sale_major`
--

CREATE TABLE `sale_major` (
  `id` int(11) NOT NULL,
  `bill_number` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `customer_id` int(50) NOT NULL,
  `currency_id` int(50) NOT NULL,
  `rate` float NOT NULL,
  `date` date NOT NULL,
  `discount` int(11) NOT NULL,
  `receipt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `sale_major`
--

INSERT INTO `sale_major` (`id`, `bill_number`, `customer_id`, `currency_id`, `rate`, `date`, `discount`, `receipt`) VALUES
(1, '898', 1, 1, 200, '2022-08-13', 20, 30);

-- --------------------------------------------------------

--
-- Table structure for table `sale_minor`
--

CREATE TABLE `sale_minor` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sale_rate` float NOT NULL,
  `total_dollar` float(20,2) NOT NULL,
  `details` text COLLATE utf8mb4_persian_ci NOT NULL,
  `purchase_minor_id` int(100) NOT NULL,
  `sale_major_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `sale_minor`
--

INSERT INTO `sale_minor` (`id`, `item_id`, `quantity`, `sale_rate`, `total_dollar`, `details`, `purchase_minor_id`, `sale_major_id`) VALUES
(1, 6, 20, 400, 0.00, '-', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `email_address` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `position` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `hire_date` date NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `full_name`, `phone_number`, `email_address`, `position`, `salary`, `image`, `hire_date`, `date`) VALUES
(8, 'کریم امینی ', '0789662312', 'jk', 'مدیر', 10300, '', '2022-07-23', '2022-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `stock_major`
--

CREATE TABLE `stock_major` (
  `id` int(11) NOT NULL,
  `item_id` int(50) NOT NULL,
  `buy_quantity` float NOT NULL,
  `sale_quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `stock_major`
--

INSERT INTO `stock_major` (`id`, `item_id`, `buy_quantity`, `sale_quantity`) VALUES
(7, 5, 400, 0),
(8, 7, 200, 50);

-- --------------------------------------------------------

--
-- Table structure for table `stock_minor`
--

CREATE TABLE `stock_minor` (
  `id` int(11) NOT NULL,
  `item_name` varchar(150) COLLATE utf8mb4_persian_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `company_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `stock_minor`
--

INSERT INTO `stock_minor` (`id`, `item_name`, `unit`, `serial_number`, `company_name`) VALUES
(7, 'روتر', 'متر', '9808', 'tp-link');

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

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `full_name`, `phone_number`, `address`, `date`) VALUES
(1, 'شرکت افغان بیسیم ', '079788989', '  شرکت ام تی ان 2', '2022-08-04');

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
(11, 8, 'masih', 'bWFzaWg=', 'SuperAdmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bardasht`
--
ALTER TABLE `bardasht`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_ex_cat` (`ex_cate_id`);

--
-- Indexes for table `expenses_categories`
--
ALTER TABLE `expenses_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixed_assets`
--
ALTER TABLE `fixed_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `initial_investment`
--
ALTER TABLE `initial_investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internet_purchase`
--
ALTER TABLE `internet_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internet_sale`
--
ALTER TABLE `internet_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlease`
--
ALTER TABLE `onlease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlease_minor`
--
ALTER TABLE `onlease_minor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_major`
--
ALTER TABLE `purchase_major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_minor`
--
ALTER TABLE `purchase_minor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reciepts`
--
ALTER TABLE `reciepts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_package`
--
ALTER TABLE `register_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_major`
--
ALTER TABLE `sale_major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_minor`
--
ALTER TABLE `sale_minor`
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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bardasht`
--
ALTER TABLE `bardasht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses_categories`
--
ALTER TABLE `expenses_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fixed_assets`
--
ALTER TABLE `fixed_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `initial_investment`
--
ALTER TABLE `initial_investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `internet_purchase`
--
ALTER TABLE `internet_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `internet_sale`
--
ALTER TABLE `internet_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `onlease`
--
ALTER TABLE `onlease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `onlease_minor`
--
ALTER TABLE `onlease_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `purchase_major`
--
ALTER TABLE `purchase_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_minor`
--
ALTER TABLE `purchase_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reciepts`
--
ALTER TABLE `reciepts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `register_package`
--
ALTER TABLE `register_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sale_major`
--
ALTER TABLE `sale_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sale_minor`
--
ALTER TABLE `sale_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stock_major`
--
ALTER TABLE `stock_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stock_minor`
--
ALTER TABLE `stock_minor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
