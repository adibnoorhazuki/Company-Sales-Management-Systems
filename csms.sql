-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 07:04 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csms`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_phone` text NOT NULL,
  `cust_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_address`, `cust_phone`, `cust_email`) VALUES
(4, 'Muhammad Adib Noor Hazuki', 'Lot 2636 Jalan Jabar Meru', '0182556064', 'adibnoorhazuki@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(3) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `dept_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `dept_desc`) VALUES
(1, 'HouseKeeping', 'For housekeeping item'),
(2, 'Firefighting System', 'For firefighting system item'),
(3, 'Silver & Scupture', 'For silver and sculpture item'),
(4, 'Mechanical & Electrical', 'For mechanical and electrical item'),
(5, 'Stationary', 'For stationary item'),
(6, 'Machinery', 'For machinery item'),
(7, 'Computer & Accessories', 'For computer and accessories item'),
(8, 'Marketing', 'marketing department item place');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(3) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_desc` text NOT NULL,
  `total_in` int(5) NOT NULL,
  `total_out` int(5) NOT NULL,
  `balance` int(5) NOT NULL,
  `unit_measure` text NOT NULL,
  `unit_price` double(6,2) NOT NULL,
  `department` int(5) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `video_name` varchar(100) NOT NULL,
  `date_in` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_desc`, `total_in`, `total_out`, `balance`, `unit_measure`, `unit_price`, `department`, `image_name`, `video_name`, `date_in`) VALUES
(15, 'Fire Extingusher', 'Pemadam Api', 100, 20, 80, 'Bundle', 200.00, 2, 'download.jpg', 'IMG_0439.MOV', '2020-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(5) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_total_amount` double(6,2) NOT NULL,
  `sales_qty` int(5) NOT NULL,
  `sales_desc` text NOT NULL,
  `sales_delivery_date` date NOT NULL,
  `user_id` int(5) NOT NULL,
  `item_id` int(5) NOT NULL,
  `cust_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_date`, `sales_total_amount`, `sales_qty`, `sales_desc`, `sales_delivery_date`, `user_id`, `item_id`, `cust_id`) VALUES
(4, '2020-05-20', 4000.00, 20, 'Pemadam Api', '2020-05-20', 0, 15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supp_id` int(3) NOT NULL,
  `supp_name` varchar(100) NOT NULL,
  `supp_address` text NOT NULL,
  `supp_no` text NOT NULL,
  `supp_email` varchar(30) NOT NULL,
  `fax_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supp_id`, `supp_name`, `supp_address`, `supp_no`, `supp_email`, `fax_no`) VALUES
(2, 'Nescafe', '22-1, 22nd Floor, Menara Surian, No.1 Jalan PJU 7/3, Mutiara Damansara, 47810 Petaling Jaya, Selangor', '0609891222', 'nescafe@gmail.com', '1800883633'),
(3, 'Dell', '7, Jalan Bintang, Bukit Bintang, 55100 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur', '1800880038', 'dell@gmail.com', '1800880038'),
(6, 'Mydin', 'Ayer Keroh', '0333929078', 'mydin@gmail.com', '1800332525'),
(7, 'FF Berhad Maju', 'Universiti Teknikal Malaysia Melaka, Hang Tuah Jaya, 76100 Durian Tunggal, Melaka', '01825560641', 'adibnoorhazuki@gmail.com', '0634115444');

-- --------------------------------------------------------

--
-- Table structure for table `supply_item`
--

CREATE TABLE `supply_item` (
  `no` int(10) NOT NULL,
  `supp_id` int(3) NOT NULL,
  `item_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply_item`
--

INSERT INTO `supply_item` (`no`, `supp_id`, `item_id`) VALUES
(13, 2, 13),
(15, 7, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_ic` bigint(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` text NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `password` longtext NOT NULL,
  `confirm_password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_ic`, `user_email`, `user_phone`, `user_type`, `password`, `confirm_password`) VALUES
(1, 'Admin', 940208106251, 'admin@gmail.com', '0182556064', 'admin', '123456', '123456'),
(2, 'Accountant', 123456789456, 'accountant@gmail.com', '01945976440', 'accountant', '123456', '123456'),
(4, 'Staff', 123456789456, 'staff@gmail.com', '0133690191', 'staff', '123456', '123456'),
(5, 'Production', 789456132465, 'production@gmail.com', '0167662525', 'production', '123456', '123456'),
(6, 'Nur Hazirah bt Mohd Shabri', 970201065730, 'ehziraaa@gmail.com', '0107666064', 'staff', '12345', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supp_id`);

--
-- Indexes for table `supply_item`
--
ALTER TABLE `supply_item`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supp_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supply_item`
--
ALTER TABLE `supply_item`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
