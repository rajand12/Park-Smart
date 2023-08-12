-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 03:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `park_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_table`
--

CREATE TABLE `booking_table` (
  `booking_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `slot_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `booked_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  `departure_time` time NOT NULL,
  `price` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_request_id` varchar(50) DEFAULT NULL,
  `cancel_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking_table`
--

INSERT INTO `booking_table` (`booking_id`, `slot_id`, `slot_name`, `user_id`, `full_name`, `vehicle_no`, `booked_date`, `arrival_time`, `departure_time`, `price`, `payment_status`, `payment_request_id`, `cancel_status`) VALUES
(1, 1, 'a1', 1, 'Rajan Dotel', '1222', '2023-07-02', '07:50:00', '08:50:00', 20, 0, NULL, 0),
(2, 4, 'a4', 1, 'Rajan Dotel', '1222', '2023-07-02', '07:50:00', '08:50:00', 20, 0, NULL, 0),
(3, 23, 'c1', 1, 'Rajan Dotel', '1555', '2023-07-02', '08:30:00', '09:30:00', 20, 0, NULL, 0),
(5, 1, 'a1', 1, 'Rajan Dotel', '1222', '2023-07-03', '08:30:00', '16:40:00', 160, 0, NULL, 0),
(6, 4, 'a4', 1, 'Rajan Dotel', '1555', '2023-07-03', '08:35:00', '17:50:00', 190, 0, NULL, 0),
(7, 12, 'b1', 1, 'Rajan Dotel', '1666', '2023-07-03', '08:50:00', '23:50:00', 300, 0, NULL, 0),
(8, 15, 'b4', 1, 'Rajan Dotel', '1011', '2023-07-04', '10:25:00', '14:12:00', 80, 0, NULL, 0),
(9, 1, 'a1', 1, 'Rajan Dotel', '1222', '2023-08-09', '12:00:00', '20:00:00', 160, 0, NULL, 0),
(10, 12, 'b1', 1, 'Rajan Dotel', '5454', '2023-08-09', '12:50:00', '16:48:00', 80, 0, NULL, 0),
(11, 13, 'b2', 1, 'Rajan Dotel', '1222', '2023-08-09', '19:50:00', '20:50:00', 20, 0, NULL, 0),
(12, 23, 'c1', 1, 'Rajan Dotel', '1222', '2023-08-09', '22:45:00', '23:30:00', 20, 0, NULL, 0),
(13, 23, 'c1', 1, 'Rajan Dotel', '1222', '2023-08-09', '22:45:00', '23:30:00', 20, 0, NULL, 0),
(14, 23, 'c1', 1, 'Rajan Dotel', '1222', '2023-08-09', '22:45:00', '23:30:00', 20, 0, NULL, 0),
(15, 23, 'c1', 1, 'Rajan Dotel', '1222', '2023-08-09', '22:45:00', '23:30:00', 20, 0, NULL, 0),
(16, 35, 'd2', 1, 'Rajan Dotel', '4555', '2023-08-10', '08:45:00', '12:00:00', 70, 0, NULL, 0),
(17, 12, 'b1', 1, 'Rajan Dotel', '4666', '2023-08-10', '08:45:00', '20:45:00', 240, 0, NULL, 0),
(18, 48, 'e4', 1, 'Rajan Dotel', '8888', '2023-08-10', '07:55:00', '23:55:00', 640, 0, NULL, 0),
(19, 31, 'c9', 1, 'Rajan Dotel', '1222', '2023-08-10', '07:50:00', '08:50:00', 20, 0, NULL, 0),
(20, 35, 'd2', 1, 'Rajan Dotel', '1222', '2023-08-10', '13:25:00', '14:55:00', 36, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(11) NOT NULL,
  `vehicle_class` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `vehicle_class`, `cost`) VALUES
(1, 'bike', 10),
(2, 'car', 20);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `slot_id` int(11) NOT NULL,
  `slot_name` varchar(20) NOT NULL,
  `slot_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`slot_id`, `slot_name`, `slot_status`) VALUES
(1, 'a1', 0),
(2, 'a2', 1),
(3, 'a3', 1),
(4, 'a4', 0),
(5, 'a5', 0),
(6, 'a6', 0),
(7, 'a7', 0),
(8, 'a8', 0),
(9, 'a9', 0),
(10, 'a10', 0),
(11, 'a11', 1),
(12, 'b1', 0),
(13, 'b2', 0),
(14, 'b3', 0),
(15, 'b4', 0),
(16, 'b5', 0),
(17, 'b6', 0),
(18, 'b7', 0),
(19, 'b8', 1),
(20, 'b9', 0),
(21, 'b10', 1),
(22, 'b11', 1),
(23, 'c1', 0),
(24, 'c2', 0),
(25, 'c3', 0),
(26, 'c4', 0),
(27, 'c5', 0),
(28, 'c6', 0),
(29, 'c7', 0),
(30, 'c8', 0),
(31, 'c9', 0),
(32, 'c10', 0),
(33, 'c11', 0),
(34, 'd1', 0),
(35, 'd2', 0),
(36, 'd3', 0),
(37, 'd4', 0),
(38, 'd5', 0),
(39, 'd6', 0),
(40, 'd7', 0),
(41, 'd8', 0),
(42, 'd9', 0),
(43, 'd10', 0),
(44, 'd11', 0),
(45, 'e1', 0),
(46, 'e2', 1),
(47, 'e3', 0),
(48, 'e4', 0),
(49, 'e5', 0),
(50, 'e6', 0),
(51, 'f1', 0),
(52, 'f2', 0),
(53, 'f3', 0),
(54, 'f4', 0),
(55, 'f5', 0),
(56, 'f6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact` double NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `full_name`, `email`, `contact`, `user_name`, `password`, `is_admin`) VALUES
(1, 'Rajan Dotel', 'rajan.dotel11@gmail.com', 9860939695, 'rajandotel', '$2y$10$Y3jVQNZcDb.Ux7pEWOPX0.B2FyK4afstxsJUViP/A5KtzYy3wUJba', 0),
(2, 'Rohan Napit', 'rohan.napit@gmail.com', 9818500673, 'rohannapit', '$2y$10$YyR73eYQWW9PEWQL/TbmFO/tz3G4clMB1R2hqh4GjAK/4YokxL/b.', 1),
(3, 'Karuna Dotel', 'karuna.dotel123@gmail.com', 9841223344, 'karunadotel', '$2y$10$GvS4Sfcl25XKrsWXZCBaAOXoi1gdjkyndPEdi26V4E9X2DIDeYlBi', 0),
(4, 'Anil Maharjan', 'anilmaharjan995@gmail.com', 9823445566, 'anilmaharjan', '$2y$10$a2iHDMT7C7FhPicpgY9WUe./4h89YwCDK2RLHca.ks0XPk0wGg/oq', 1),
(12, 'Rajan Dotel', 'rajan.dotel11@gmail.com', 9860939695, 'rajandotelll', '$2y$10$sCjmpmMnAhJGkdydUvfFs.gBUxykA3SftIpIYAFWODzHltrJ8TXg.', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_table`
--
ALTER TABLE `booking_table`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
