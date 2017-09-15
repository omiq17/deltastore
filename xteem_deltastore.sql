-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2017 at 09:37 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xteem_deltastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(32) NOT NULL,
  `f_username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`c_id`, `c_name`, `f_username`) VALUES
(1, 'Shampoo', 'anik'),
(2, 'Soap', 'anik'),
(3, 'body spray', 'anik'),
(4, 'News Paper', 'delta'),
(5, 'Domain', 'evan'),
(6, 'laptop', 'omiq'),
(7, 'monitor', 'omiq'),
(8, 'keyboard', 'omiq'),
(9, 'mouse', 'omiq'),
(10, 'pendrive', 'omiq'),
(11, 'pen', 'omiq'),
(17, 'Square', 'Md.'),
(18, 'Beximco', 'Md.'),
(19, 'Unilever', 'Md.'),
(20, 'shoe', 'turjoh'),
(21, 'rice', 'turjoh'),
(22, 'laptop', 'nayem'),
(23, 'ram', 'nayem'),
(24, 'processor', 'nayem'),
(25, 'hard disk', 'omiq');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cu_id` int(11) NOT NULL,
  `cu_name` varchar(32) NOT NULL,
  `cu_phone` varchar(32) NOT NULL,
  `f_username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cu_id`, `cu_name`, `cu_phone`, `f_username`) VALUES
(1, 'Meem', '01737845003', 'anik'),
(2, 'Zubaer', '01684584003', 'anik'),
(3, 'Ridwan ', '097854738', 'delta'),
(4, 'Piash', '017489789789', 'evan'),
(5, 'bane', '0195684523', 'omiq'),
(6, 'bane', '016896545', 'omiq'),
(8, 'sunny', '017589457', 'omiq'),
(9, 'zubaer', '01647856821', 'omiq'),
(10, 'anik', '01758954256', 'omiq'),
(14, 'Ridwan', '097854738', 'Md.'),
(15, 'Niloy', '00937726', 'Md.'),
(16, 'Aritro', '1347900', 'Md.'),
(17, 'bane', '016666666666', 'turjoh'),
(18, 'zubaer', '1234567', 'nayem'),
(19, 'Zihad', '0189789789', 'omiq');

-- --------------------------------------------------------

--
-- Table structure for table `foreman`
--

CREATE TABLE `foreman` (
  `f_username` varchar(32) CHARACTER SET latin1 NOT NULL,
  `f_firstname` varchar(32) CHARACTER SET latin1 NOT NULL,
  `f_lastname` varchar(32) CHARACTER SET latin1 NOT NULL,
  `f_email` varchar(32) CHARACTER SET latin1 NOT NULL,
  `f_password` varchar(55) CHARACTER SET latin1 NOT NULL,
  `f_storename` varchar(32) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foreman`
--

INSERT INTO `foreman` (`f_username`, `f_firstname`, `f_lastname`, `f_email`, `f_password`, `f_storename`) VALUES
('111111111111111', 'Md.', 'Kalam', 'apj@kalam.com', '115941c4a60f1d3c05352acbfce4b3aa081dd233', 'kalam store'),
('aa', 'Alfred Schmidt', 'Hamburg', 'gmail@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Hamburg'),
('anik', 'RIad', 'Mahmud', 'anik@gmail.com', '0c46e147e86245a0515f379483798cf9a04411d1', 'Anik Store'),
('delta', 'MD.', 'Nayeem', 'delta@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Delta Store'),
('evan', 'Mahbub ', 'Alam', 'evan@yahoo.com', '98cc7d37dc7b90c14a59ef0c5caa8995', 'Mamuni Store'),
('Md.', 'Nayeem', 'naem', 'hkjh@jhjk.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Delta Store'),
('nai', 'nai', 'nai', 'nai@hkjs.com', 'de2f9d7c98fbeecf090faeea50917e9b380e744d', 'nai'),
('nayem', 'Md.', 'Nayeem', 'nayeem899@gmail.com', '912ec803b2ce49e4a541068d495ab570', 'DeltaStore'),
('omiq', 'Rakib', 'Hasan', 'omiq17@gmail.com', '0c46e147e86245a0515f379483798cf9a04411d1', 'Exteem Store'),
('turjoh', 'Turjo', 'Hasan', 'turjohasan08@gmail.com', '717729ce391c20ef3e722c3e6ef79a58', 'ePiC');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `i_id` int(11) NOT NULL,
  `cu_id` int(11) NOT NULL,
  `i_sub_total` double NOT NULL,
  `i_vat` double NOT NULL,
  `i_total_price` double NOT NULL,
  `i_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`i_id`, `cu_id`, `i_sub_total`, `i_vat`, `i_total_price`, `i_date`) VALUES
(1001, 2, 1200, 5, 1260, '2015-07-06'),
(1002, 1, 360, 10, 396, '2015-08-14'),
(1004, 8, 367000, 0, 367000, '2015-08-14'),
(1005, 8, 16500, 7, 17655, '2015-08-14'),
(1007, 5, 37100, -5, 35245, '2015-08-14'),
(1008, 5, 37100, 5, 38955, '2015-08-14'),
(1009, 8, 44300, 5, 46515, '2015-08-14'),
(1010, 10, 90000, 15, 103500, '2015-08-14'),
(1014, 5, 35000, 15, 40250, '2015-08-21'),
(1016, 16, 116.25, 5, 122.0625, '2015-08-23'),
(1017, 15, 212.5, -5, 201.875, '2015-08-23'),
(1018, 8, 317750, 5, 333637.5, '2015-08-25'),
(1019, 5, 35000, 0, 35000, '2015-08-25'),
(1020, 17, -400, 15, -460, '2015-08-30'),
(1021, 18, 53400, 0, 53400, '2015-08-31'),
(1022, 9, 2750, 0, 2750, '2015-09-01'),
(1026, 5, 35000, 0, 35000, '2015-09-02'),
(1027, 5, 70000, 0, 70000, '2015-09-02'),
(1030, 19, 5000, 2, 5100, '2017-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_dt`
--

CREATE TABLE `invoice_dt` (
  `i_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_dt`
--

INSERT INTO `invoice_dt` (`i_id`, `o_id`) VALUES
(1001, 102),
(1001, 103),
(1002, 101),
(1004, 109),
(1004, 112),
(1004, 113),
(1004, 114),
(1005, 109),
(1005, 112),
(1005, 114),
(1007, 115),
(1008, 115),
(1009, 109),
(1010, 116),
(1014, 120),
(1016, 122),
(1016, 123),
(1016, 124),
(1017, 127),
(1017, 128),
(1018, 113),
(1018, 114),
(1019, 115),
(1020, 130),
(1021, 131),
(1021, 132),
(1022, 133),
(1026, 115),
(1027, 115),
(1027, 120),
(1030, 134);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `o_ammount` double NOT NULL,
  `cu_id` int(11) NOT NULL,
  `o_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`o_id`, `p_id`, `o_ammount`, `cu_id`, `o_price`) VALUES
(101, 1, 2, 1, 360),
(102, 2, 3, 2, 660),
(103, 1, 3, 2, 540),
(104, 6, 5, 3, 50),
(105, 7, 1, 4, 700),
(109, 12, 1, 8, 8800),
(112, 14, 11, 8, 4950),
(113, 9, 7, 8, 315000),
(114, 11, 5, 8, 2750),
(115, 10, 1, 5, 35000),
(116, 9, 2, 10, 90000),
(120, 10, 1, 5, 35000),
(122, 24, 15, 16, 75),
(123, 26, 10, 16, 25),
(124, 23, 5, 16, 16.25),
(127, 24, 15, 15, 75),
(128, 26, 55, 15, 137.5),
(129, 25, 15, 14, 105),
(130, 27, 2, 17, -400),
(131, 29, 1, 18, 51000),
(132, 30, 1, 18, 2400),
(133, 11, 5, 9, 2750),
(134, 32, 1, 19, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `p_price` double NOT NULL,
  `c_id` int(11) NOT NULL,
  `f_username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_price`, `c_id`, `f_username`) VALUES
(1, 'Fox', 180, 3, 'anik'),
(2, 'Fox Red', 220, 3, 'anik'),
(3, 'All clear', 150, 1, 'anik'),
(4, 'Dove', 75, 2, 'anik'),
(5, 'sunsilk', 120, 1, 'anik'),
(6, 'Prothom Alo ', 10, 4, 'delta'),
(7, 'dot com', 700, 5, 'evan'),
(8, 'dell inspiron 5420', 58000, 6, 'omiq'),
(9, 'hp probook', 45000, 6, 'omiq'),
(10, 'asus', 35000, 6, 'omiq'),
(11, 'asus', 550, 9, 'omiq'),
(12, 'hp', 8800, 7, 'omiq'),
(13, 'samsung', 7100, 7, 'omiq'),
(14, 'havit', 450, 8, 'omiq'),
(15, 'apacer 8gb', 700, 10, 'omiq'),
(23, 'Napa', 3.25, 18, 'Md.'),
(24, 'Ace', 5, 19, 'Md.'),
(25, 'Alatrol', 7, 17, 'Md.'),
(26, 'Histasin', 2.5, 17, 'Md.'),
(27, 'apex', -200, 20, 'turjoh'),
(28, 'dell inspiron 5420', 52000, 22, 'nayem'),
(29, 'acer aspire', 51000, 22, 'nayem'),
(30, 'adata', 2400, 23, 'nayem'),
(31, 'transcend', 2500, 23, 'nayem'),
(32, 'Transcend 1Tb', 5000, 25, 'omiq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `f_username` (`f_username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cu_id`),
  ADD KEY `f_username` (`f_username`),
  ADD KEY `f_username_2` (`f_username`);

--
-- Indexes for table `foreman`
--
ALTER TABLE `foreman`
  ADD PRIMARY KEY (`f_username`),
  ADD KEY `f_username` (`f_username`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`i_id`),
  ADD KEY `cu_id` (`cu_id`);

--
-- Indexes for table `invoice_dt`
--
ALTER TABLE `invoice_dt`
  ADD KEY `i_id` (`i_id`),
  ADD KEY `o_id` (`o_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `i_id` (`cu_id`),
  ADD KEY `p_id_2` (`p_id`),
  ADD KEY `cu_id` (`cu_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `f_username` (`f_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1031;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `catagory`
--
ALTER TABLE `catagory`
  ADD CONSTRAINT `catagory_fk` FOREIGN KEY (`f_username`) REFERENCES `foreman` (`f_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_fk_cu` FOREIGN KEY (`f_username`) REFERENCES `foreman` (`f_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_fk` FOREIGN KEY (`cu_id`) REFERENCES `customer` (`cu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_dt`
--
ALTER TABLE `invoice_dt`
  ADD CONSTRAINT `invice_dt_fk_i` FOREIGN KEY (`i_id`) REFERENCES `invoice` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invice_dt_fk_o` FOREIGN KEY (`o_id`) REFERENCES `order` (`o_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_fk_cu` FOREIGN KEY (`cu_id`) REFERENCES `customer` (`cu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_fk_p` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_fk_c` FOREIGN KEY (`c_id`) REFERENCES `catagory` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_fk_f` FOREIGN KEY (`f_username`) REFERENCES `foreman` (`f_username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
