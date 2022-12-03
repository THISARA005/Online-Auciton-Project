-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2022 at 07:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eauction`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `nic_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address`, `nic_no`) VALUES
(1, 'house# 1', '890-123213-123'),
(2, 'house# 2', '899-123213-123'),
(3, 'house# 3', '898-123213-123'),
(4, 'house# 4', '897-123213-123'),
(5, 'house# 5', '895-123213-123'),
(6, 'House # 6788 Street', '892-123213-123'),
(7, 'house# 7', '893-123213-123'),
(18, 'House # ABC Street 12B', '123123123V');

-- --------------------------------------------------------

--
-- Table structure for table `administrate`
--

CREATE TABLE `administrate` (
  `ad_id` int(11) NOT NULL,
  `ad_firstname` varchar(30) NOT NULL,
  `ad_lastname` varchar(30) NOT NULL,
  `ad_email` varchar(50) NOT NULL,
  `ad_password` varchar(255) NOT NULL,
  `ad_img` varchar(50) NOT NULL,
  `ad_address` varchar(50) NOT NULL,
  `ad_contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrate`
--

INSERT INTO `administrate` (`ad_id`, `ad_firstname`, `ad_lastname`, `ad_email`, `ad_password`, `ad_img`, `ad_address`, `ad_contact`) VALUES
(1, 'Zain', 'Abc', 'zain@gmail.com', '23d42f5f3f66498b2c8ff4c20b8c5ac826e47146', 'profile1.png', 'House#5123 Street Abc, Pakistan', 765423458),
(2, 'RANA', 'ABC', 'zain1@gmail.com', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'profile1.jpg', 'House#5123 Street Abc, Pakistan', 876545678);

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
--

CREATE TABLE `bidding` (
  `bid_id` int(11) NOT NULL,
  `user_byerid` int(11) NOT NULL,
  `ve_id` int(11) NOT NULL,
  `bid_amount` int(15) NOT NULL,
  `bid_time` varchar(20) NOT NULL,
  `bid_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidding`
--

INSERT INTO `bidding` (`bid_id`, `user_byerid`, `ve_id`, `bid_amount`, `bid_time`, `bid_date`) VALUES
(15, 74, 43, 3000, '09:01:23', '20 AUG, 2022'),
(16, 78, 43, 3000, '09:01:23', '20 AUG, 2022'),
(17, 76, 43, 221, '09:02:20', '20 AUG, 2022'),
(18, 77, 43, 1000, '09:03:28', '20 AUG, 2022'),
(19, 74, 43, 8000, '09:04:21', '20 AUG, 2022'),
(20, 78, 43, 220, '09:05:54', '20 AUG, 2022'),
(21, 75, 43, 4000, '09:06:26', '20 AUG, 2022'),
(22, 74, 43, 8000, '09:11:07', '2022-08-24'),
(23, 74, 43, 8000, '09:11:18', '2022-08-24'),
(24, 74, 54, 123, '10:35:24', '2022-08-26'),
(39, 74, 54, 1233, '10:58:38', '2022-08-26'),
(40, 74, 54, 6562, '10:59:23', '2022-08-26'),
(41, 74, 54, 1231, '11:00:20', '2022-08-26'),
(42, 74, 54, 112, '11:09:40', '2022-08-26'),
(43, 74, 54, 1821, '11:14:06', '2022-08-26'),
(44, 74, 54, 3123, '11:15:23', '2022-08-26'),
(51, 74, 54, 12909, '22:32:35', '2022-08-26'),
(52, 74, 54, 198, '22:41:29', '2022-08-26'),
(53, 74, 54, 12333, '22:42:14', '2022-08-26'),
(54, 74, 54, 12333, '22:42:56', '2022-08-26'),
(55, 96, 55, 12, '15:42:13', '2022-08-27'),
(56, 74, 55, 123, '15:42:24', '2022-08-27'),
(57, 96, 55, 13, '15:42:52', '2022-08-27'),
(58, 96, 55, 13, '15:43:15', '2022-08-27'),
(59, 74, 55, 123, '15:43:17', '2022-08-27'),
(60, 74, 55, 135, '15:45:03', '2022-08-27'),
(61, 74, 55, 148, '15:45:43', '2022-08-27'),
(62, 74, 55, 148, '15:46:38', '2022-08-27'),
(63, 74, 55, 148, '15:47:25', '2022-08-27'),
(64, 74, 55, 162, '15:47:35', '2022-08-27'),
(65, 74, 55, 162, '15:57:24', '2022-08-27'),
(66, 74, 55, 178, '15:57:42', '2022-08-27'),
(67, 74, 55, 178, '16:22:41', '2022-08-27'),
(68, 74, 55, 1232, '16:23:05', '2022-08-27'),
(69, 74, 55, 1355, '16:23:18', '2022-08-27'),
(70, 96, 55, 1490, '16:24:19', '2022-08-27'),
(71, 96, 55, 1639, '16:24:34', '2022-08-27'),
(72, 74, 55, 1355, '16:25:25', '2022-08-27'),
(73, 96, 55, 1802, '16:28:46', '2022-08-27'),
(74, 98, 56, 1233, '23:09:18', '2022-08-27'),
(75, 98, 56, 1356, '23:10:10', '2022-08-27'),
(76, 98, 56, 32, '23:11:16', '2022-08-27'),
(77, 108, 56, 1233, '14:55:41', '2022-09-04'),
(78, 108, 56, 1356, '14:56:18', '2022-09-04'),
(79, 108, 56, 1346, '14:58:02', '2022-09-04'),
(80, 108, 56, 1390, '14:58:09', '2022-09-04'),
(81, 109, 55, 1802, '22:50:24', '2022-09-05'),
(82, 109, 55, 1982, '22:51:26', '2022-09-05'),
(83, 109, 50, 242, '18:54:00', '2022-09-07'),
(84, 109, 50, 242, '18:54:58', '2022-09-07'),
(85, 109, 59, 123122, '13:33:23', '2022-09-08'),
(86, 109, 59, 135434, '13:33:32', '2022-09-08'),
(87, 109, 59, 135434, '13:40:21', '2022-09-08'),
(88, 74, 59, 135434, '15:41:03', '2022-09-08'),
(89, 74, 59, 135434, '15:41:03', '2022-09-08'),
(90, 74, 59, 135434, '15:41:14', '2022-09-08'),
(91, 74, 59, 135434, '15:41:15', '2022-09-08'),
(92, 74, 59, 148977, '15:47:09', '2022-09-08'),
(93, 74, 59, 163874, '16:31:03', '2022-09-08'),
(94, 109, 59, 180261, '17:08:02', '2022-09-08'),
(95, 74, 59, 198287, '17:10:20', '2022-09-08'),
(96, 109, 59, 218115, '19:26:47', '2022-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `bodystyle`
--

CREATE TABLE `bodystyle` (
  `bodyst_id` int(11) NOT NULL,
  `body_style` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bodystyle`
--

INSERT INTO `bodystyle` (`bodyst_id`, `body_style`) VALUES
(1, 'SUV'),
(2, 'Sedan'),
(3, 'Wagon'),
(4, 'Hatchback'),
(5, 'Pickup'),
(6, 'Coupe'),
(7, 'Van/minivan'),
(8, 'Convertible');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_nam` varchar(30) NOT NULL,
  `client_img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_nam`, `client_img`) VALUES
(1, 'AnyOne', 'car10.jpg'),
(2, 'AnyOne', 'car11.jpg'),
(3, 'AnyOne', 'car12.jpg'),
(4, 'AnyOne', 'car13.jpg'),
(5, 'AnyOne', 'car14.jpg'),
(6, 'AnyOne', 'car7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `comp_id` int(11) NOT NULL,
  `comp_nam` varchar(30) NOT NULL,
  `comp_reg` varchar(30) NOT NULL,
  `comp_img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`comp_id`, `comp_nam`, `comp_reg`, `comp_img`) VALUES
(1, 'Dream Jeep', 'D23FG23', 'Dice.png'),
(2, 'CARED', 'D23FG24', 'Dice.png\n'),
(3, 'MobVe', 'D23FG57', 'Dice.png'),
(4, 'Car Hunt', 'D23FG98', 'Dice.png\n'),
(5, 'Land Lord', 'D23FS12', 'Dice.png\n'),
(6, 'TES VE', 'D23HJ23', 'Dice.png\n'),
(7, 'Honda COM', 'IY3FG23', 'Dice.png'),
(26, 'Apani', 'REG123A', 'Dice.png'),
(27, 'asdd', 'asd213', 'Dice.png'),
(28, 'cvbjkl', 'fgh567', 'Why.jpeg'),
(29, 'Aertyu', '4321n3b', 'Dice.png'),
(30, 'asdfsd', '4321n3b', 'Dice.png'),
(31, 'sdfghj', 'ertyu', 'java.jpg'),
(32, '123sad', '123dsad2', 'React.jpg'),
(33, 'asdabn', '456cvb', 'html.jpg'),
(34, 'jhkjh', 'xcvjnb', 'html.jpg'),
(35, 'vvhhjkk', 'cvbn567', 'C-Programming.png'),
(36, 'dfgh', 'dfg', 'html.jpg'),
(37, '34567v ', 'sdfghj', 'html.jpg'),
(38, 'sqqq', 'qqqqqq', 'html.jpg'),
(39, 'sqqqq', 'qqqqqq', 'html.jpg'),
(48, 'Apani Group', 'REG123SC', 'car10.jpg'),
(49, 'Group\'s', 'REF12312', 'car.jpg'),
(50, 'Auction Comp', 'REG1231', 'car1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `condition`
--

CREATE TABLE `condition` (
  `cond_id` int(11) NOT NULL,
  `ve_condition` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `condition`
--

INSERT INTO `condition` (`cond_id`, `ve_condition`) VALUES
(1, 'Good'),
(2, 'Nornmal'),
(3, 'Average'),
(4, 'Bad');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `fuel_id` int(11) NOT NULL,
  `fuel_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuel_type`
--

INSERT INTO `fuel_type` (`fuel_id`, `fuel_type`) VALUES
(1, 'Petrol'),
(2, 'Diesel');

-- --------------------------------------------------------

--
-- Table structure for table `gallary`
--

CREATE TABLE `gallary` (
  `id` int(11) NOT NULL,
  `gal_name` varchar(30) NOT NULL,
  `gal_images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallary`
--

INSERT INTO `gallary` (`id`, `gal_name`, `gal_images`) VALUES
(1, 'Gallary1', 'car.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg,car12.jpg,car13.jpg,car14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `make_id` int(11) NOT NULL,
  `make_nam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`make_id`, `make_nam`) VALUES
(1, 'Acura'),
(2, 'Alfa Romeo'),
(3, 'Aston Martin'),
(4, 'Audi'),
(5, 'Bentley'),
(6, 'BMW'),
(7, 'Buick'),
(8, 'Cadillac'),
(9, 'Chevrolet'),
(10, 'Chrysler'),
(11, 'Dodge'),
(12, 'Ferrari'),
(13, 'FIAT'),
(14, 'Ford'),
(15, 'Freightliner'),
(16, 'Genesis'),
(17, 'GMC'),
(18, 'Honda'),
(19, 'Hyundai'),
(20, 'INFINITI'),
(21, 'Jaguar'),
(22, 'Jeep'),
(23, 'Kia'),
(24, 'Lamborghini'),
(25, 'Land Rover'),
(26, 'Lexus'),
(27, 'Lincoln'),
(28, 'Lotus'),
(29, 'Maserati'),
(30, 'MAZDA'),
(31, 'Mercedes-Benz'),
(32, 'MINI'),
(33, 'Mitsubishi'),
(34, 'Nissan'),
(35, 'Polestar'),
(36, 'Porsche'),
(37, 'Ram'),
(38, 'Rivian'),
(39, 'Rolls-Royce'),
(40, 'Subaru'),
(41, 'Tesla'),
(42, 'Toyota'),
(43, 'Volkswagen'),
(44, 'Volvo');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `msg_from_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `schedule_date` date NOT NULL,
  `msg_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `msg_from_id`, `detail`, `schedule_date`, `msg_status`) VALUES
(1, 98, 'Hi , I want to place an auction.', '2022-08-20', 1),
(2, 98, 'hi, i want to schedule an auction', '2022-08-21', 1),
(3, 98, 'hi, i want to schedule an auction', '2022-08-21', 1),
(4, 98, 'hi, i want to schedule an auction', '2022-08-21', 1),
(5, 98, 'hi i want to sell my vehicle', '2022-08-25', 1),
(6, 96, 'Please allow to add auction', '2022-08-28', 1),
(7, 98, 'E auction ', '2022-08-28', 1),
(8, 98, 'Hi, I want to auction vehicle', '2022-09-05', 1),
(9, 109, 'Auction', '2022-09-07', 1),
(10, 109, 'Hi, I want to make an auction for y vehicle', '2022-09-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_nam` varchar(30) NOT NULL,
  `news_date` varchar(10) NOT NULL,
  `news_img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_nam`, `news_date`, `news_img`) VALUES
(1, 'Hella Kogi Whathever', '2022-09-22', 'car6.jpg'),
(2, 'Hella Kogi Whathever', '2022-08-29', 'car7.jpg'),
(3, 'Hella Kogi Whathever', '2022-09-03', 'car8.jpg'),
(4, 'Hella Kogi Whathever', '2022-10-22', 'car9.jpg'),
(5, 'Hella Kogi Whathever', '2022-04-19', 'car10.jpg'),
(6, 'Hella Kogi Whathever', '2022-05-22', 'car11.jpg'),
(7, 'Hella Kogi Whathever', '2022-12-10', 'car12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `album_nam` varchar(30) NOT NULL,
  `album_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `album_nam`, `album_img`) VALUES
(1, 'album1', 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

CREATE TABLE `sold` (
  `sold_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `ve_id` int(11) NOT NULL,
  `price` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold`
--

INSERT INTO `sold` (`sold_id`, `buyer_id`, `ve_id`, `price`) VALUES
(1, 74, 54, '12500'),
(2, 74, 43, '8000'),
(3, 109, 59, '218115');

-- --------------------------------------------------------

--
-- Table structure for table `transmission`
--

CREATE TABLE `transmission` (
  `trans_id` int(11) NOT NULL,
  `trans_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transmission`
--

INSERT INTO `transmission` (`trans_id`, `trans_type`) VALUES
(1, 'Manual'),
(2, 'Automatic'),
(3, 'CVT transmissio');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `contact` varchar(16) NOT NULL,
  `reg_date` varchar(10) NOT NULL,
  `user_img` varchar(30) NOT NULL,
  `agrement` tinyint(4) NOT NULL,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pasword`, `user_type`, `comp_id`, `address_id`, `contact`, `reg_date`, `user_img`, `agrement`, `resettoken`, `resettokenexpire`, `status`) VALUES
(74, 'Rana', 'Abc', 'zain417@gmail.com', '3336b7395b750b031110ae6ae274324605ff55ea', 'buyer', NULL, 6, '+94-12-123-1233', '2022-08-27', 'car2.jpg', 0, NULL, NULL, 1),
(75, 'poiuy', 'oiuhg', 'test1@gmail.com', '202cb962ac59075b964b07152d234b70', 'buyer', NULL, 3, '+94314567', '2022-08-28', 'Monkey.jpg', 0, NULL, NULL, 0),
(76, 'qwer', 'qaz', 'test2@gmail.com', '202cb962ac59075b964b07152d234b70', 'buyer', NULL, 2, '+94310987', '2022-08-27', 'Monkey.jpg', 0, NULL, NULL, 0),
(77, 'kjyt', 'mlpl', 'test3@gmail.com', '202cb962ac59075b964b07152d234b70', 'buyer', NULL, 4, '+94312474', '2022-08-29', 'Monkey.jpg', 0, NULL, NULL, 0),
(78, 'zxfgh', 'edfv', 'test4@gmail.com', '202cb962ac59075b964b07152d234b70', 'buyer', NULL, 1, '+94312124', '2022-08-21', 'Monkey.jpg', 0, NULL, NULL, 0),
(84, 'pasindu', 'perara', 'test2@gmail.com', '202cb962ac59075b964b07152d234b70', 'seller', 1, NULL, '+94323452', '2022-08-20', '', 0, NULL, NULL, 0),
(85, 'poiuy', 'oiuhg', 'test3@gmail.com', '202cb962ac59075b964b07152d234b70', 'seller', 3, NULL, '+94314567', '2022-08-23', '', 0, NULL, NULL, 0),
(86, 'qwer', 'qaz', 'test4@gmail.com', '202cb962ac59075b964b07152d234b70', 'seller', 4, NULL, '+94310987', '2022-08-24', '', 0, NULL, NULL, 0),
(87, 'kjyt', 'mlpl', 'test5@gmail.com', '202cb962ac59075b964b07152d234b70', 'seller', 7, NULL, '+94312474', '2022-08-25', '', 0, NULL, NULL, 0),
(88, 'zxfgh', 'edfv', 'test6@gmail.com', '202cb962ac59075b964b07152d234b70', 'seller', 6, NULL, '+94312124', '2022-08-26', '', 0, NULL, NULL, 0),
(96, 'zain', 'abc', 'zain@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'seller', 26, NULL, '034345745424', '2022-08-20', 'Profile2.png', 1, NULL, NULL, 1),
(97, 'zain', 'abc', 'zain1@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'seller', 27, NULL, '234567', '2022-08-19', 'Profile1.jpg', 1, NULL, NULL, 0),
(98, 'Hunter', 'King', 'zainrao419@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'seller', 28, NULL, '30283342', '2022-08-18', 'java.jpg', 1, NULL, NULL, 1),
(105, 'Zain', 'Rana', 'zainrao411@gmail.com', 'bd07d4916e3aec0d43834f33add5a10aff6bf2a7', 'seller', 48, NULL, '+94-1231233', '2022-09-01', 'car1.jpg', 1, NULL, NULL, 1),
(106, 'Zain', 'King', 'zainrao410@gmail.com', 'c400e1043b264669a64509aa835b96ce7f8c7ea0', 'seller', 49, NULL, '+94-1231231', '2022-09-03', 'avatar.png', 1, NULL, NULL, 1),
(108, 'Zain', 'Infinity', 'zainrao41@gmail.com', 'e331020ed49b412d386b3f53183d9d1b67de08d5', 'buyer', NULL, 18, '+94-12-412-2343', '2022-09-04', 'car2.jpg', 1, NULL, NULL, 1),
(109, 'Zain', 'Auction', 'zain447@gmail.com', 'b808acea44de17b57d59839515881ef7c50fdc23', 'seller', 50, NULL, '+94-12-123-1235', '2022-09-05', 'car2.jpg', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `ve_id` int(11) NOT NULL,
  `ve_code` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ve_typeid` int(11) DEFAULT NULL,
  `ve_modelid` varchar(25) NOT NULL,
  `ve_makeid` int(11) DEFAULT NULL,
  `ve_colorid` varchar(15) NOT NULL,
  `ve_conditionid` int(11) DEFAULT NULL,
  `ve_year` year(4) NOT NULL,
  `ve_transmissionid` int(11) NOT NULL,
  `ve_fueltypeid` int(11) DEFAULT NULL,
  `ve_encapacity` varchar(11) NOT NULL,
  `ve_mileage` varchar(11) NOT NULL,
  `ve_desc` varchar(255) NOT NULL,
  `ve_startprice` int(11) NOT NULL,
  `ve_img` varchar(255) NOT NULL,
  `ve_date` date NOT NULL,
  `auc_strt_time` varchar(20) NOT NULL,
  `auc_end_time` varchar(20) NOT NULL,
  `ve_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`ve_id`, `ve_code`, `user_id`, `ve_typeid`, `ve_modelid`, `ve_makeid`, `ve_colorid`, `ve_conditionid`, `ve_year`, `ve_transmissionid`, `ve_fueltypeid`, `ve_encapacity`, `ve_mileage`, `ve_desc`, `ve_startprice`, `ve_img`, `ve_date`, `auc_strt_time`, `auc_end_time`, `ve_status`) VALUES
(2, 'bc21c', 84, 3, 'RYUH', 3, 'Black', 2, 2019, 3, 2, '1500', '15000', 'ABCSDDADBKJJADHJAH JAHDBADB', 300, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-08-23', '08:00:00 am', '23:00:00', 0),
(13, 'asd213', 85, 4, 'ASB', 8, 'Black', 2, 2018, 1, 2, '1300', '10000', 'mnsafhds asbdhag SBDJHADS amsdbHBASD hadsgjHAD', 120, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-08-23', '08:00:00 am', '23:00:00', 0),
(35, 'asd215', 86, 7, 'SAA', 11, 'Black', 3, 2018, 1, 2, '1300', '10000', 'mnsafhds asbdhag SBDJHADS amsdbHBASD hadsgjHAD', 190, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2021-08-11', '09:00:00 am', '11:00:00 pm', 0),
(36, 'asd216', 87, 4, 'ASAS', 12, 'Black', 2, 2018, 1, 2, '1300', '10000', 'mnsafhds asbdhag SBDJHADS amsdbHBASD hadsgjHAD', 120, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2021-09-09', '09:00:00 am', '11:00:00 pm', 0),
(37, 'asd218', 88, 4, 'SA', 17, 'White', 2, 2018, 1, 2, '1300', '10000', 'mnsafhds asbdhag SBDJHADS amsdbHBASD hadsgjHAD', 330, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-12-07', '09:00:00 am', '11:00:00 pm', 0),
(38, 'asd219', 84, 4, 'NNNJ', 12, 'Purple', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 200, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-09-12', '09:00:00 am', '11:00:00 pm', 0),
(39, 'asd210', 85, 4, 'BHHJ', 8, 'Yellow', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 320, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-07-07', '09:00:00 am', '11:00:00 pm', 0),
(40, 'asd212', 86, 4, 'DFG', 8, 'Orange', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 820, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-08-12', '09:00:00 am', '11:00:00 pm', 0),
(41, 'asd219', 87, 4, 'YUII', 9, 'Blue', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 420, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-09-03', '09:00:00 am', '11:00:00 pm', 0),
(42, 'asd218', 88, 4, 'HJJ', 10, 'Green', 2, 2018, 2, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 220, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2021-09-03', '09:00:00 am', '11:00:00 pm', 0),
(43, 'asd214', 85, 8, 'JHGG', 8, 'RED', 2, 2018, 3, 2, '1800', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 222, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-04-03', '09:00:00 am', '11:00:00 pm', 0),
(44, 'asd216', 84, 4, 'RTY', 12, 'Yellow', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 120, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2021-01-01', '09:00:00 am', '11:00:00 pm', 0),
(45, 'asd218', 84, 4, 'MNB', 17, 'Orange', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 330, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-09-06', '09:00:00 am', '11:00:00 pm', 0),
(46, 'asd219', 88, 4, 'HJJK', 12, 'purple', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 200, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-02-12', '09:00:00 am', '11:00:00 pm', 0),
(47, 'asd210', 85, 4, 'BNM', 8, 'Cyan', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 320, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-03-12', '09:00:00 am', '11:00:00 pm', 0),
(48, 'asd212', 86, 4, 'ASA', 8, 'blue', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 820, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-10-11', '09:00:00 am', '11:00:00 pm', 0),
(49, 'asd219', 87, 4, 'YYTB', 9, 'Red', 2, 2018, 1, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 420, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2023-09-12', '09:00:00 am', '11:00:00 pm', 0),
(50, 'asd218', 87, 4, 'ASas', 10, 'white', 2, 2018, 2, 2, '1300', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 220, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2023-10-12', '09:00:00 am', '11:00:00 pm', 0),
(51, 'asd214', 84, 8, 'SAN', 8, 'Yellow', 2, 2018, 3, 2, '1800', '10000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 222, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2023-08-11', '09:00:00 am', '11:00:00 pm', 0),
(53, 'bf66', 98, 7, 'BHG', 14, 'Green', 2, 2017, 1, 2, '1300CC', '1523km', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 1378, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-08-20', '16:47', '17:47', 0),
(54, '57b1', 98, 3, 'BHG', 1, 'Yellow', 3, 2006, 2, 1, '4567CC', '1231KM', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 12320, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-08-21', '20:26', '23:27', 1),
(55, '27fa', 98, 4, 'BGC', 6, 'RED', 1, 2019, 2, 2, '1423CC', '12312KM', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam deleniti, sunt eos consequuntur aut sapiente doloremque. Quibusdam recusandae quo id soluta ad officia rerum iure modi, officiis, distinctio corrupti fuga!', 1232, 'car1.jpg,car2.jpg,car3.jpg,car4.jpg,car5.jpg', '2022-08-28', '10:51', '23:51', 0),
(56, '3d9e', 96, 4, 'GFG', 8, 'Yellow', 3, 2019, 1, 2, '1500CC', '1312km', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 1233, '96car10.jpg,96car3.jpg,96car6.jpg,96car2.jpg,96car.jpg', '2022-08-27', '07:49', '23:49', 0),
(58, '22e0', 109, 4, 'GHH', 4, 'White', 1, 2021, 3, 2, '1500CC', '1233km', 'This is the auction detail.', 12322, '631b259544aee2022-09-09.jpg,109car2.jpg,109car6.jpg,109car10.jpg,109draw1.jpg', '2022-09-09', '01:48', '23:48', 0),
(59, '83d1', 109, 4, 'DOK', 6, 'RED', 1, 2022, 3, 2, '4500CC', '1230KM', 'This is the vehicle info', 123122, '109car6.jpg,109car11.jpg,109car14.jpg,109car10.jpg,109car1.jpg', '2022-09-08', '09:50', '23:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verified_auction`
--

CREATE TABLE `verified_auction` (
  `code_id` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verified_auction`
--

INSERT INTO `verified_auction` (`code_id`, `code`, `user_id`, `code_date`) VALUES
(1, 'bf66', 98, '2022-08-20'),
(2, '57b1', 98, '2022-08-21'),
(3, 'd7f4', 98, '2022-08-20'),
(4, '81f1', 98, '2022-08-24'),
(6, '6e15', 98, '2022-08-20'),
(7, 'de54', 98, '2022-08-20'),
(8, '27fa', 98, '2022-08-25'),
(9, 'c1e3', 98, '2022-08-20'),
(10, 'ca4e', 98, '2022-08-21'),
(11, '2539', 85, '2022-08-23'),
(12, '5f13', 98, '2022-08-21'),
(13, '3d9e', 96, '2022-08-28'),
(14, 'e750', 98, '2022-08-27'),
(15, 'bdbd', 98, '2022-09-05'),
(16, '22e0', 109, '2022-09-09'),
(18, '83d1', 109, '2022-09-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `administrate`
--
ALTER TABLE `administrate`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `bidding`
--
ALTER TABLE `bidding`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `ve_bidfk` (`ve_id`),
  ADD KEY `user_byerbidfk` (`user_byerid`);

--
-- Indexes for table `bodystyle`
--
ALTER TABLE `bodystyle`
  ADD PRIMARY KEY (`bodyst_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `condition`
--
ALTER TABLE `condition`
  ADD PRIMARY KEY (`cond_id`);

--
-- Indexes for table `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`fuel_id`);

--
-- Indexes for table `gallary`
--
ALTER TABLE `gallary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`make_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `sellerfk` (`msg_from_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold`
--
ALTER TABLE `sold`
  ADD PRIMARY KEY (`sold_id`);

--
-- Indexes for table `transmission`
--
ALTER TABLE `transmission`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `compfk` (`comp_id`),
  ADD KEY `addressfk` (`address_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`ve_id`),
  ADD KEY `conditionfk` (`ve_conditionid`),
  ADD KEY `fueltypefk` (`ve_fueltypeid`),
  ADD KEY `makefk` (`ve_makeid`),
  ADD KEY `typefk` (`ve_typeid`),
  ADD KEY `userfk` (`user_id`);

--
-- Indexes for table `verified_auction`
--
ALTER TABLE `verified_auction`
  ADD PRIMARY KEY (`code_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `administrate`
--
ALTER TABLE `administrate`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bidding`
--
ALTER TABLE `bidding`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `bodystyle`
--
ALTER TABLE `bodystyle`
  MODIFY `bodyst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `condition`
--
ALTER TABLE `condition`
  MODIFY `cond_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `fuel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallary`
--
ALTER TABLE `gallary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `make_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sold`
--
ALTER TABLE `sold`
  MODIFY `sold_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transmission`
--
ALTER TABLE `transmission`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `ve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `verified_auction`
--
ALTER TABLE `verified_auction`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidding`
--
ALTER TABLE `bidding`
  ADD CONSTRAINT `user_byerbidfk` FOREIGN KEY (`user_byerid`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ve_bidfk` FOREIGN KEY (`ve_id`) REFERENCES `vehicles` (`ve_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
