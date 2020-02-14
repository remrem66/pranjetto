-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2020 at 05:11 PM
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
-- Table structure for table `amenity_tbl`
--

CREATE TABLE `amenity_tbl` (
  `amenity_id` int(10) NOT NULL,
  `amenity_name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenity_tbl`
--

INSERT INTO `amenity_tbl` (`amenity_id`, `amenity_name`, `price`, `description`, `image`, `status`) VALUES
(2, 'Paint ball', '200', 'paint', 'IMG_6823.JPG', '1');

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
-- Table structure for table `gallery_tbl`
--

CREATE TABLE `gallery_tbl` (
  `gallery_id` int(10) NOT NULL,
  `image` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_tbl`
--

INSERT INTO `gallery_tbl` (`gallery_id`, `image`, `date`) VALUES
(2, 'Emerald.JPG', '2020-02-13 15:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `online_reservation_tbl`
--

CREATE TABLE `online_reservation_tbl` (
  `reservation_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `no_of_persons` varchar(250) NOT NULL,
  `extra_mattress` int(10) NOT NULL,
  `reservation_code` varchar(10) DEFAULT NULL,
  `receipt_image` varchar(50) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `quantity` int(10) NOT NULL,
  `total_price` varchar(250) DEFAULT NULL,
  `amount_paid` varchar(250) DEFAULT NULL,
  `reservation_status` int(10) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_reservation_tbl`
--

INSERT INTO `online_reservation_tbl` (`reservation_id`, `user_id`, `room_id`, `no_of_persons`, `extra_mattress`, `reservation_code`, `receipt_image`, `check_in`, `check_out`, `quantity`, `total_price`, `amount_paid`, `reservation_status`, `date`) VALUES
(2, 2, 1, '5', 0, '7KjuY21', NULL, '2020-01-27', '2020-01-29', 0, '4800', '2400', 4, '2020-02-13 14:36:53'),
(5, 2, 1, '5', 0, '5PbR21', '1581532362.jpg', '2020-02-14', '2020-02-15', 0, '0', '0', 2, '2020-02-13 16:04:23'),
(7, 2, 2, '4', 0, 'suHq21', NULL, '2020-02-12', '2020-02-13', 0, '2400', '2400', 2, '2020-02-13 14:30:56'),
(8, 2, 1, '4', 0, 'njHa12', NULL, '2020-02-28', '2020-03-05', 0, '7200', '3600', 1, '2020-02-13 16:06:53'),
(9, 2, 1, '3', 0, '3GbR21', NULL, '2020-02-28', '2020-03-05', 0, '7200', '7200', 2, '2020-02-13 14:26:13');

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
  `twentyfourhr_price` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `main_pic` varchar(250) DEFAULT NULL,
  `pictures` varchar(250) DEFAULT NULL,
  `slot` varchar(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_tbl`
--

INSERT INTO `room_tbl` (`room_id`, `room_num`, `floor`, `room_name`, `category`, `capacity`, `twentyfourhr_price`, `description`, `main_pic`, `pictures`, `slot`, `status`) VALUES
(1, 101, 1, 'Emerald', 'Emerald', '5', '2400', 'Emerald Room', 'Emerald.JPG', 'Emerald.JPG,Emerald1.JPG,IMG_6796.JPG,IMG_6819.JPG', '4', 1),
(2, 201, 2, 'Sapphire', 'Sapphire', '4', '2400', 'Sapphire Room', 'Room_Sapphire.JPG', NULL, '5', 1);

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
(4, '1200', 'Initial payment of customer Mina Kiram', '2020-02-06 12:07:13'),
(5, '1050', 'Payment of balance of customer Mina Kiram', '2020-02-13 05:57:01'),
(6, '1200', 'Initial payment of customer Robert Acuyan', '2020-02-13 06:13:56'),
(7, '1050', 'Payment of balance of customer Robert Acuyan', '2020-02-13 06:45:26'),
(8, '1450', 'Initial payment of customer Mina Kiram', '2020-02-13 07:33:31'),
(9, '0', 'Initial payment of customer Mina Kiram', '2020-02-13 14:15:08'),
(10, '0', 'Payment of balance of customer Mina Kiram', '2020-02-13 14:22:34'),
(11, '7200', 'Initial payment of customer Mina Kiram', '2020-02-13 14:25:00'),
(12, '7200', 'Payment of balance of customer Mina Kiram', '2020-02-13 14:25:15'),
(13, '7200', 'Initial payment of customer Mina Kiram', '2020-02-13 14:26:03'),
(14, '7200', 'Payment of balance of customer Mina Kiram', '2020-02-13 14:26:13'),
(15, '1200', 'Initial payment of customer Mina Kiram', '2020-02-13 14:28:00'),
(16, '1200', 'Payment of balance of customer Mina Kiram', '2020-02-13 14:30:32'),
(17, '1200', 'Initial payment of customer Mina Kiram', '2020-02-13 14:30:47'),
(18, '1200', 'Payment of balance of customer Mina Kiram', '2020-02-13 14:30:56');

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

-- --------------------------------------------------------

--
-- Table structure for table `walkin_reservation_tbl`
--

CREATE TABLE `walkin_reservation_tbl` (
  `walkin_id` int(10) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact_num` varchar(250) NOT NULL,
  `room_id` int(10) NOT NULL,
  `no_of_persons` int(10) NOT NULL,
  `extra_mattress` int(10) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `quantity` int(10) NOT NULL,
  `total_price` varchar(250) NOT NULL,
  `amount_paid` varchar(250) DEFAULT NULL,
  `reservation_status` int(10) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `walkin_reservation_tbl`
--

INSERT INTO `walkin_reservation_tbl` (`walkin_id`, `customer_name`, `email`, `contact_num`, `room_id`, `no_of_persons`, `extra_mattress`, `check_in`, `check_out`, `quantity`, `total_price`, `amount_paid`, `reservation_status`, `date`) VALUES
(1, 'Robert Acuyan', 'rhemacuyan@gmail.com', '9977233740', 1, 3, 0, '2020-02-15', '2020-02-16', 1, '2400', NULL, 0, '2020-02-13 14:06:49'),
(2, 'Robert Acuyan', 'rhemacuyan@gmail.com', '9977233740', 2, 1, 0, '2020-02-13', '2020-02-14', 1, '2400', NULL, 0, '2020-02-13 11:35:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenity_tbl`
--
ALTER TABLE `amenity_tbl`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `bank_accounts_tbl`
--
ALTER TABLE `bank_accounts_tbl`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `gallery_tbl`
--
ALTER TABLE `gallery_tbl`
  ADD PRIMARY KEY (`gallery_id`);

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
-- Indexes for table `walkin_reservation_tbl`
--
ALTER TABLE `walkin_reservation_tbl`
  ADD PRIMARY KEY (`walkin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenity_tbl`
--
ALTER TABLE `amenity_tbl`
  MODIFY `amenity_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_accounts_tbl`
--
ALTER TABLE `bank_accounts_tbl`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery_tbl`
--
ALTER TABLE `gallery_tbl`
  MODIFY `gallery_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `online_reservation_tbl`
--
ALTER TABLE `online_reservation_tbl`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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

--
-- AUTO_INCREMENT for table `walkin_reservation_tbl`
--
ALTER TABLE `walkin_reservation_tbl`
  MODIFY `walkin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
