-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2022 at 10:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buspro`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(100) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_mail` varchar(255) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `bus_no` varchar(10) NOT NULL,
  `booked_amount` int(100) NOT NULL,
  `booked_seat` varchar(100) NOT NULL,
  `booking_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `booking_id`, `customer_name`, `customer_mail`, `route_id`, `bus_no`, `booked_amount`, `booked_seat`, `booking_created`) VALUES
(51, '6840N51', 'neeraj', 'nk@gmail.com', 'RI-6147237', 'UK10TT1001', 300, '1', '2022-11-18 14:51:27'),
(52, 'DBSVT52', 'SHUBHAM', 'sb@gmail.com', 'RI-6147237', 'UK10TT1001', 300, '2', '2022-11-18 14:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` int(100) NOT NULL,
  `bus_no` varchar(255) NOT NULL,
  `bus_assigned` tinyint(1) NOT NULL DEFAULT 0,
  `bus_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_no`, `bus_assigned`, `bus_created`) VALUES
(51, 'UK10TT1001', 0, '2022-11-18 14:13:25'),
(52, 'UK10TT1002', 0, '2022-11-18 14:13:52'),
(53, 'UK10TT1003', 0, '2022-11-18 14:27:24'),
(54, 'UK10TT1004', 0, '2022-11-18 14:27:36'),
(55, 'UK10TT1005', 0, '2022-11-18 14:27:50'),
(56, 'UK10TT1006', 0, '2022-11-18 14:28:12'),
(57, 'UK10TT1007', 0, '2022-11-18 14:28:28'),
(58, 'UK10TT1008', 0, '2022-11-18 14:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `buslist`
--

CREATE TABLE `buslist` (
  `busno` varchar(10) NOT NULL,
  `fromcity` varchar(30) NOT NULL,
  `tocity` varchar(30) NOT NULL,
  `departure` time NOT NULL,
  `duration` varchar(100) NOT NULL,
  `arrival` time NOT NULL,
  `price` int(11) NOT NULL,
  `seats` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buslist`
--

INSERT INTO `buslist` (`busno`, `fromcity`, `tocity`, `departure`, `duration`, `arrival`, `price`, `seats`) VALUES
('', '', '', '00:00:00', '', '00:00:00', 0, 0),
('uk03sa8877', 'rishikesh', 'nanital', '28:33:29', '1h', '32:33:29', 60, 12),
('uk06uy7898', 'rishikesh', 'haridwar', '15:33:29', '1h', '36:33:29', 60, 12),
('UK07df5456', 'ramjhula', 'dehradun', '17:04:29', '1h', '24:04:29', 12, 12),
('UK07TC5469', 'RISHIKESH', 'DELHI', '10:44:33', '5 H', '11:44:33', 565, 10),
('uk09ty1245', 'rishikesh', 'haridwar', '15:33:29', '1h', '36:33:29', 60, 12),
('uk14ou8975', 'rishikesh', 'haridwar', '28:33:29', '1h', '32:33:29', 60, 12),
('UK88TT9138', 'HARIDWAR', 'AGRA', '11:30:00', '7 h', '06:30:00', 550, 30),
('uk88tu1212', 'RISHIKESH', 'delhi', '02:20:00', '5 H', '07:45:00', 500, 30);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(100) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `bus_no` varchar(155) NOT NULL,
  `fromcity` varchar(255) NOT NULL,
  `tocity` varchar(255) NOT NULL,
  `route_cities` varchar(255) NOT NULL,
  `route_dep_date` date NOT NULL,
  `route_dep_time` time NOT NULL,
  `route_arr_date` date NOT NULL,
  `route_arr_time` time NOT NULL,
  `cost` int(100) NOT NULL,
  `route_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `route_id`, `bus_no`, `fromcity`, `tocity`, `route_cities`, `route_dep_date`, `route_dep_time`, `route_arr_date`, `route_arr_time`, `cost`, `route_created`) VALUES
(37, 'RI-6147237', 'UK10TT1001', 'RISHIKESH', 'DEHRADUN', 'RISHIKESH,DEHRADUN', '2022-11-20', '14:20:00', '2022-11-20', '16:14:00', 300, '2022-11-18 14:14:47'),
(38, 'RI-4557138', 'UK10TT1001', 'RAMJHULA', 'HARIDWAR', 'RAMJHULA,HARIDWAR', '2022-11-20', '16:22:00', '2022-11-19', '16:22:00', 300, '2022-11-18 14:22:55'),
(39, 'RI-9510839', 'UK10TT1002', 'RISHIKESH', 'DELHI', 'RISHIKESH,DELHI', '2022-11-21', '22:30:00', '2022-11-21', '17:30:00', 400, '2022-11-18 14:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `bus_no` varchar(155) NOT NULL,
  `seat_booked` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`bus_no`, `seat_booked`) VALUES
('UK07TT9654', NULL),
('UK10TT1001', '1,2'),
('UK10TT1002', NULL),
('UK10TT1003', NULL),
('UK10TT1004', NULL),
('UK10TT1005', NULL),
('UK10TT1006', NULL),
('UK10TT1007', NULL),
('UK10TT1008', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `Adminname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `mobileno` bigint(10) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `sno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`Adminname`, `username`, `mobileno`, `mail`, `password`, `datetime`, `sno`) VALUES
('Admin', 'admin', 987654321, 'admin@gmail.com', 'Admin@123', '2022-10-17 15:40:37', 3),
('admin2', 'admin2', 9875642314, 'admin2@gmail.com', 'Admin@123', '2022-10-18 13:20:57', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblbuslist`
--

CREATE TABLE `tblbuslist` (
  `SNO` int(11) NOT NULL,
  `busno` varchar(10) NOT NULL,
  `fromcity` varchar(50) NOT NULL,
  `tocity` varchar(50) NOT NULL,
  `godate` date NOT NULL,
  `departure` time NOT NULL,
  `duration` varchar(100) NOT NULL,
  `arrival` time NOT NULL,
  `price` bigint(20) NOT NULL,
  `seats` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbuslist`
--

INSERT INTO `tblbuslist` (`SNO`, `busno`, `fromcity`, `tocity`, `godate`, `departure`, `duration`, `arrival`, `price`, `seats`) VALUES
(1, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(2, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(3, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(4, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(5, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(6, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(7, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(8, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(9, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(10, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(11, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(12, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(13, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(14, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(15, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(16, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(17, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(18, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(19, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(20, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30),
(21, 'UK07RK1001', 'RISHIKESH', 'DEHRADUN', '2022-10-18', '10:30:20', '1 H', '11:30:20', 120, 30);

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `username` varchar(20) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `mobileno` bigint(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sno` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`username`, `mail`, `mobileno`, `password`, `sno`, `datetime`) VALUES
('neeraj', 'nk@gmail.com', 12345678999999999, '$2y$10$Fw/NzJcqOYknMrA7qemRbOkHFySx83SKM9ohWvVyjWgIwtYOPQOwi', 38, '2022-10-15 13:27:53'),
('neeraj', 'uk@gmail.com', 8456256321, '', 39, '2022-10-15 13:28:47'),
('neeraj', 'user@gmail.com', 98765432101, '123', 40, '2022-10-15 13:31:07'),
('xczbzsdf', 'zxdgzxdfg@d', 986546568544, 'adfsdfasf', 41, '2022-10-15 13:39:51'),
('rahul', 'rahul@gmail.com', 987654321, '1234', 42, '2022-10-28 13:19:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buslist`
--
ALTER TABLE `buslist`
  ADD PRIMARY KEY (`busno`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`bus_no`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `tblbuslist`
--
ALTER TABLE `tblbuslist`
  ADD PRIMARY KEY (`SNO`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblbuslist`
--
ALTER TABLE `tblbuslist`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
