-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2020 at 03:49 AM
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
-- Database: `pranjetto`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts_tbl`
--

CREATE TABLE `bank_accounts_tbl` (
  `account_id` int(10) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `account_num` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_accounts_tbl`
--

INSERT INTO `bank_accounts_tbl` (`account_id`, `bank_name`, `account_num`) VALUES
(1, 'BPI', '1234-467-8910');

-- --------------------------------------------------------

--
-- Table structure for table `online_reservation_tbl`
--

CREATE TABLE `online_reservation_tbl` (
  `reservation_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `no_of_persons` varchar(250) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` varchar(250) DEFAULT NULL,
  `amount_paid` varchar(250) DEFAULT NULL,
  `reservation_status` int(10) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_reservation_tbl`
--

INSERT INTO `online_reservation_tbl` (`reservation_id`, `user_id`, `room_id`, `no_of_persons`, `check_in`, `check_out`, `total_price`, `amount_paid`, `reservation_status`, `date`) VALUES
(2, 2, 1, '5', '2020-01-27', '2020-01-29', '4800', '2400', 2, '2020-02-03 09:33:53'),
(4, 2, 1, '4', '2020-02-04', '2020-02-05', '2400', '1200', 1, '2020-02-06 12:07:13'),
(5, 2, 1, '5', '2020-02-10', '2020-02-11', '2900', NULL, 0, '2020-02-09 18:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `room_mainpage_tbl`
--

CREATE TABLE `room_mainpage_tbl` (
  `id` int(10) NOT NULL,
  `category` varchar(250) NOT NULL,
  `picture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_mainpage_tbl`
--

INSERT INTO `room_mainpage_tbl` (`id`, `category`, `picture`) VALUES
(1, 'Topaz', 'IMG_6796.JPG'),
(2, 'Turquoise', 'IMG_6829.JPG'),
(3, 'Garnet', 'IMG_6866.JPG'),
(4, 'Jade', 'IMG_6848.JPG'),
(5, 'Pearl', 'Sapphire1.JPG'),
(6, 'Sapphire', 'Sapphire.JPG'),
(7, 'Emerald', 'IMG_6873.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `room_tbl`
--

CREATE TABLE `room_tbl` (
  `room_id` int(10) NOT NULL,
  `room_num` int(10) NOT NULL,
  `floor` int(10) NOT NULL,
  `room_name` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `capacity` varchar(250) NOT NULL,
  `twelvehr_price` varchar(250) NOT NULL,
  `twentyfourhr_price` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `main_pic` varchar(250) DEFAULT NULL,
  `pictures` varchar(250) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_tbl`
--

INSERT INTO `room_tbl` (`room_id`, `room_num`, `floor`, `room_name`, `category`, `capacity`, `twelvehr_price`, `twentyfourhr_price`, `description`, `main_pic`, `pictures`, `status`) VALUES
(1, 101, 1, 'Emerald', 'Emerald', '5', '1200', '2400', 'Emerald Room', 'Emerald.JPG', 'Emerald.JPG,Emerald1.JPG,IMG_6796.JPG,IMG_6819.JPG', 1),
(2, 201, 2, 'Sapphire', 'Sapphire', '4', '1200', '2400', 'Sapphire Room', 'Room_Sapphire.JPG', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `sales_id` int(10) NOT NULL,
  `sales_amount` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`sales_id`, `sales_amount`, `description`, `date`) VALUES
(1, '2400', 'Payment of balance of customer Mina Kiram', '2020-01-25 14:20:24'),
(2, '2400', 'Payment of balance of customer Mina Kiram', '2020-01-25 14:42:35'),
(3, '2400', 'Payment of balance of customer Mina Kiram', '2020-02-03 09:33:53'),
(4, '1200', 'Initial payment of customer Mina Kiram', '2020-02-06 12:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `settings_tbl`
--

CREATE TABLE `settings_tbl` (
  `setting_id` int(10) NOT NULL,
  `setting_name` varchar(250) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_tbl`
--

INSERT INTO `settings_tbl` (`setting_id`, `setting_name`, `price`) VALUES
(1, 'Extra Mattress', 500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact_num` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(10) NOT NULL DEFAULT '1',
  `user_status` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `name`, `email`, `contact_num`, `username`, `password`, `user_type`, `user_status`) VALUES
(1, 'Admin', '', '', 'administrator', 'admin123', 0, 1),
(2, 'Mina Kiram', 'norminalimbokiram@gmail.com', '09977233740', 'norminakiram', 'mina123', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts_tbl`
--
ALTER TABLE `bank_accounts_tbl`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `online_reservation_tbl`
--
ALTER TABLE `online_reservation_tbl`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `room_mainpage_tbl`
--
ALTER TABLE `room_mainpage_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_tbl`
--
ALTER TABLE `room_tbl`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `settings_tbl`
--
ALTER TABLE `settings_tbl`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts_tbl`
--
ALTER TABLE `bank_accounts_tbl`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `online_reservation_tbl`
--
ALTER TABLE `online_reservation_tbl`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_mainpage_tbl`
--
ALTER TABLE `room_mainpage_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `room_tbl`
--
ALTER TABLE `room_tbl`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings_tbl`
--
ALTER TABLE `settings_tbl`
  MODIFY `setting_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
