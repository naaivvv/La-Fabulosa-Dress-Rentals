-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 07:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dressrent`
--

-- --------------------------------------------------------

--
-- Table structure for table `approveddresses`
--

CREATE TABLE `approveddresses` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `dress_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `dress_return_date` date DEFAULT NULL,
  `dress_price` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `approveddresses`
--

INSERT INTO `approveddresses` (`id`, `customer_username`, `dress_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `dress_return_date`, `dress_price`, `charge_type`, `no_of_days`, `total_amount`, `return_status`) VALUES
(574681276, 'lucas', 3, '2024-01-04', '2024-01-04', '2024-01-07', '2024-01-04', 450, 'days', 3, 1350, 'R'),
(574681277, 'lucas', 1, '2024-01-04', '2024-01-04', '2024-01-07', '2024-01-04', 500, 'days', 3, 1500, 'R'),
(574681278, 'lucas', 4, '2024-01-04', '2024-01-04', '2024-01-08', '2024-01-04', 1500, 'days', 4, 6000, 'R'),
(574681280, 'lucas', 5, '2024-01-04', '2024-01-05', '2024-01-06', '2024-01-04', 900, 'days', 1, 900, 'R'),
(574681281, 'lucas', 2, '2024-01-04', '2024-01-05', '2024-01-05', '2024-01-04', 800, 'days', 0, 0, 'R'),
(574681282, 'lucas', 1, '2024-01-04', '2024-01-05', '2024-01-05', '2024-01-04', 500, 'days', 0, 0, 'R');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_username` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `client_email` varchar(25) NOT NULL,
  `client_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `client_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_username`, `client_name`, `client_phone`, `client_email`, `client_address`, `client_password`) VALUES
('harry', 'Harry Den', '9876543210', 'harryden@gmail.com', '2477  Harley Vincent Drive', 'password'),
('jenny', 'Jeniffer Washington', '7850000069', 'washjeni@gmail.com', '4139  Mesa Drive', 'jenny'),
('tom', 'Tommy Doee', '900696969', 'tom@gmail.com', '4645  Dawson Drive', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('antonio', 'Antonio M', '0785556580', 'antony@gmail.com', '2677  Burton Avenue', 'password'),
('christine', 'Christine', '8544444444', 'chr@gmail.com', '3701  Fairway Drive', 'password'),
('ethan', 'Ethan Hawk', '69741111110', 'thisisethan@gmail.com', '4554  Rowes Lane', 'password'),
('james', 'James Washington', '0258786969', 'james@gmail.com', '2316  Mayo Street', 'password'),
('lucas', 'Lucas Rhoades', '7003658500', 'lucas@gmail.com', '2737  Fowler Avenue', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `dresses`
--

CREATE TABLE `dresses` (
  `dress_id` int(20) NOT NULL,
  `dress_name` varchar(50) NOT NULL,
  `dress_type` varchar(50) NOT NULL,
  `dress_color` varchar(50) NOT NULL,
  `dress_size` varchar(50) NOT NULL,
  `dress_price` float NOT NULL,
  `dress_price_per_day` float NOT NULL,
  `dress_price_per_rent` float NOT NULL,
  `dress_img` varchar(50) DEFAULT 'NA',
  `dress_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dresses`
--

INSERT INTO `dresses` (`dress_id`, `dress_name`, `dress_type`, `dress_color`, `dress_size`, `dress_price`, `dress_price_per_day`, `dress_price_per_rent`, `dress_img`, `dress_availability`) VALUES
(1, 'Pink Dress', 'Gown', 'Pink', 'M', 500, 500, 500, 'assets/img/dresses/pinkdress.jpg', 'yes'),
(2, 'Peach Dress', 'Gown', 'Peach', 'XL', 800, 800, 800, 'assets/img/dresses/peach.jpg', 'yes'),
(3, 'Pink Slim Dress', 'Gown', 'Pink', 'M', 450, 450, 450, 'assets/img/dresses/pinkslim.jpg', 'yes'),
(4, 'Wedding Dress', 'Gown', 'White', 'M', 1500, 1500, 1500, 'assets/img/dresses/wedding.jpg', 'yes'),
(5, 'Violet Dress', 'Gown', 'Violet', 'L', 900, 900, 900, 'assets/img/dresses/violet.jpg', 'yes'),
(7, 'Green Sleeveless Dress', 'Sleeveless', 'Green', 'M', 300, 300, 250, 'assets/img/dresses/sleeveless green.jpg', 'yes'),
(8, 'Peach Wedding Dress', 'Wedding Dress', 'Peach', 'L', 2000, 2000, 1800, 'assets/img/dresses/peach wedding.jpg', 'yes'),
(9, 'Pattern Yellow Dress', 'Casual', 'Yellow', 'S', 800, 700, 800, 'assets/img/dresses/pattern yellow.jpg', 'yes'),
(10, 'Yellow Corduroy Dress', 'Casual', 'Yellow', 'M', 900, 800, 900, 'assets/img/dresses/corduroy yellow.jpg', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `subject`, `email`, `message`) VALUES
('Nikhil', '', 'nikhil@gmail.com', 'Hope this works.'),
('Jason Pascual', 'Inquiry', 'jason@gmail.com', 'mahulam ko bayo');

-- --------------------------------------------------------

--
-- Table structure for table `renteddresses`
--

CREATE TABLE `renteddresses` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `dress_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `dress_return_date` date DEFAULT NULL,
  `dress_price` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL,
  `decision` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `renteddresses`
--

INSERT INTO `renteddresses` (`id`, `customer_username`, `dress_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `dress_return_date`, `dress_price`, `charge_type`, `no_of_days`, `total_amount`, `return_status`, `decision`) VALUES
(574681276, 'lucas', 3, '2024-01-04', '2024-01-04', '2024-01-07', '2024-01-04', 450, 'days', 3, 1350, 'R', 'Approved'),
(574681277, 'lucas', 1, '2024-01-04', '2024-01-04', '2024-01-07', '2024-01-04', 500, 'days', 3, 1500, 'R', 'Approved'),
(574681278, 'lucas', 4, '2024-01-04', '2024-01-04', '2024-01-08', '2024-01-04', 1500, 'days', 4, 6000, 'R', 'Approved'),
(574681280, 'lucas', 5, '2024-01-04', '2024-01-05', '2024-01-06', '2024-01-04', 900, 'days', 1, 900, 'R', 'Approved'),
(574681283, 'lucas', 5, '2024-01-05', '2024-01-05', '2024-01-09', '2024-01-05', 900, 'days', 4, 3600, 'R', 'Approved'),
(574681285, 'james', 4, '2024-01-05', '2024-01-17', '2024-01-18', '2024-01-05', 1500, 'days', 1, 1500, 'NR', 'Rejected'),
(574681287, 'lucas', 2, '2024-01-05', '2024-01-05', '2024-01-07', '2024-01-05', 800, 'days', 2, 1600, 'R', 'Approved'),
(574681288, 'lucas', 5, '2024-01-05', '2024-01-05', '2024-01-07', '2024-01-06', 900, 'days', 2, 1800, 'R', 'Approved'),
(574681289, 'james', 2, '2024-01-05', '2024-01-05', '2024-01-06', '2024-01-05', 800, 'days', 1, 800, 'R', 'Approved'),
(574681290, 'lucas', 3, '2024-01-06', '2024-01-06', '2024-01-09', '2024-01-06', 450, 'days', 3, 1350, 'R', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approveddresses`
--
ALTER TABLE `approveddresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `dress_id` (`dress_id`) USING BTREE;

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_username`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indexes for table `dresses`
--
ALTER TABLE `dresses`
  ADD PRIMARY KEY (`dress_id`);

--
-- Indexes for table `renteddresses`
--
ALTER TABLE `renteddresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `dress_id` (`dress_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approveddresses`
--
ALTER TABLE `approveddresses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681283;

--
-- AUTO_INCREMENT for table `dresses`
--
ALTER TABLE `dresses`
  MODIFY `dress_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `renteddresses`
--
ALTER TABLE `renteddresses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681291;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
