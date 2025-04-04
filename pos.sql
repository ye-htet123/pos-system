-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 02:03 PM
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
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not_ban,1=ban',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `is_ban`, `created_at`) VALUES
(9, 'ye htet Aung', 'abc@23gmail.com', '$2y$10$4Bvq2Uj4fMq2NiILc2cCJeLVAgdIa3ppu5jeJVxHzC8H0E4KinJSu', '09030330300', 0, '2024-08-22'),
(11, 'oipl', 'qwe23@gmail.com', '$2y$10$mJ8xzbK5j1A11Ued/et0TerYmGRKD62HUyeKdWJvwNl/WtP8xptt.', '09030330300', 1, '2024-08-22'),
(12, 'ye win thu', 'yewin123@gmail.com', '$2y$10$IAmN/JSPiMgBRURH4IpvweEzAqunivOb.0CBAn1Ar/HaT526aKeFy', '09448920113', 0, '2024-09-09'),
(13, 'Zinyaw Khing', 'zinyaw2345owner@gmail.com', '$2y$10$bNl7gDYkn.CwCRZQq8eHOuMwWxukea7C0fzkZ2J5ehiDcDxiLZR/6', '09426711142', 0, '2024-10-11'),
(14, 'Ye Htet Aung', 'yehtet456owner@gmail.com', '$2y$10$HsctJbz/wg1dQ5KZ8BCQi.BESDA45MNUnZ3CBG1/9YOjY1kRyHD16', '09426711142', 0, '2024-10-13'),
(15, 'po ke mon', 'abcm@23gmail.com', '$2y$10$qqBZLfH1ZtdfbRb6VDpRteNQzXRxvss5iUJaJSllb/sbZLQLSFHu2', '098766', 0, '2024-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(15, 'phone', 'instok', 0),
(17, 'vegetable', 'main product of this industry', 0),
(18, 'ganger', 'use for medicine', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `status`, `created_at`) VALUES
(10, 'lopk', '', '09000000000000000', 0, '2024-09-06'),
(11, 'kkkk', '', '09877654321', 0, '2024-09-06'),
(12, 'lop', '', '0987654321', 0, '2024-09-06'),
(13, 'someone', '', '09876', 0, '2024-09-06'),
(14, 'ye', '', '0942671142', 0, '2024-09-07'),
(17, 'yair htet', '', '09404782219', 0, '2024-10-13'),
(18, 'leo', '', '2', 0, '2024-10-15'),
(19, 'joe', '', '09832', 0, '2024-10-19'),
(20, 'joda', '', '1234567890', 0, '2024-10-19'),
(21, 'Jolo', '', '123456', 0, '2024-10-19'),
(22, 'kogyi', '', '12345678', 0, '2024-10-19'),
(23, 'hi', '', '87', 0, '2024-10-19'),
(24, 'jiol', '', '09874', 0, '2024-10-19'),
(25, 'piuo', '', '09876543211', 0, '2024-10-19'),
(26, 'Ye htet aung', '', '09426711142', 0, '2024-10-20'),
(27, 'ko hla', '', '09876543288', 0, '2024-10-22'),
(28, 'moe', '', '09687854321', 0, '2024-10-23'),
(29, 'moe yu', '', '09887766548', 0, '2024-12-17'),
(30, 'kj', '', '09876543218', 0, '2024-12-17'),
(31, 'lll', '', '09876543210', 0, '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(100) NOT NULL COMMENT 'cash, online',
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `order_status`, `payment_mode`, `order_placed_by_id`) VALUES
(55, '15', '67414', 'INV-402833', '3600', '2024-09-07', 'booked', 'Online Payment', 9),
(68, '13', '66015', 'INV-129799', '32800', '2024-09-19', 'booked', 'Online Payment', 9),
(77, '13', '56477', 'INV-502829', '9000', '2024-10-05', 'booked', 'Online Payment', 12),
(80, '16', '50765', 'INV-743149', '767000', '2024-10-08', 'booked', 'cash_payment', 12),
(81, '13', '79748', 'INV-159458', '1200', '2024-10-12', 'order', 'online_payment', 13),
(82, '13', '86117', 'INV-896380', '900', '2024-10-12', 'booked', 'online_payment', 13),
(84, '17', '93845', 'INV-876605', '900', '2024-10-13', 'booked', 'online_payment', 14),
(85, '13', '31110', 'INV-326582', '13000', '2024-10-14', 'booked', 'online_payment', 14),
(86, '13', '29868', 'INV-174628', '9000', '2024-10-14', 'booked', 'online_payment', 14),
(87, '12', '99455', 'INV-265147', '213000', '2024-10-14', 'booked', 'online_payment', 12),
(88, '18', '29583', 'INV-594147', '523000', '2024-10-15', 'booked', 'online_payment', 12),
(89, '22', '54132', 'INV-572721', '22909', '2024-10-19', 'booked', 'online_payment', 9),
(90, '23', '87164', 'INV-993014', '13000', '2024-10-19', 'booked', 'online_payment', 9),
(91, '25', '41754', 'INV-441597', '18909', '2024-10-19', 'booked', 'online_payment', 9),
(92, '26', '76770', 'INV-643111', '13000', '2024-10-20', 'booked', 'cash_payment', 9),
(93, '26', '99254', 'INV-136482', '9000', '2024-10-20', 'booked', 'online_payment', 9),
(94, '26', '93599', 'INV-114638', '200000', '2024-10-22', 'booked', 'cash_payment', 13),
(95, '26', '99014', 'INV-443121', '909', '2024-10-22', 'booked', 'cash_payment', 13),
(96, '26', '66769', 'INV-836263', '9000', '2024-10-22', 'booked', 'online_payment', 13),
(97, '26', '36288', 'INV-331773', '200000', '2024-10-22', 'booked', 'online_payment', 13),
(98, '27', '62271', 'INV-140960', '209000', '2024-10-22', 'booked', 'online_payment', 0),
(99, '26', '33139', 'INV-901736', '200000', '2024-10-22', 'booked', 'online_payment', 0),
(100, '26', '15991', 'INV-236744', '9000', '2024-10-22', 'booked', 'cash_payment', 0),
(101, '26', '80879', 'INV-195252', '200000', '2024-10-22', 'booked', 'cash_payment', 0),
(102, '26', '80766', 'INV-170796', '13000', '2024-10-22', 'booked', 'online_payment', 13),
(103, '26', '79826', 'INV-790383', '13000', '2024-10-22', 'booked', 'online_payment', 13),
(104, '26', '73172', 'INV-483899', '13000', '2024-10-22', 'booked', 'cash_payment', 0),
(105, '26', '33586', 'INV-721319', '13001', '2024-10-22', 'booked', 'cash_payment', 0),
(106, '26', '92166', 'INV-201709', '13000', '2024-10-22', 'booked', 'online_payment', 13),
(107, '26', '75695', 'INV-999480', '13000', '2024-10-22', 'booked', 'online_payment', 0),
(108, '26', '98305', 'INV-349310', '13000', '2024-10-23', 'booked', 'online_payment', 0),
(109, '28', '62807', 'INV-651918', '13000', '2024-10-23', 'booked', 'online_payment', 0),
(110, '26', '92210', 'INV-930431', '909', '2024-10-23', 'booked', 'online_payment', 0),
(111, '26', '55698', 'INV-841452', '13000', '2024-10-23', 'booked', 'online_payment', 0),
(112, '26', '41432', 'INV-537225', '13000', '2024-10-23', 'booked', 'cash_payment', 13),
(113, '26', '34584', 'INV-984465', '9000', '2024-10-23', 'booked', 'cash_payment', 13),
(114, '26', '27634', 'INV-311799', '9000', '2024-10-23', 'booked', 'online_payment', 13),
(115, '26', '32794', 'INV-802323', '200909', '2024-10-23', 'booked', 'online_payment', 13),
(116, '26', '27185', 'INV-227871', '22000', '2024-10-23', 'booked', 'cash_payment', 0),
(117, '26', '61265', 'INV-219663', '9000', '2024-10-23', 'booked', 'online_payment', 0),
(118, '26', '58623', 'INV-944463', '9000', '2024-10-23', 'booked', 'online_payment', 0),
(120, '26', '83829', 'INV-420898', '0', '2024-10-27', 'booked', 'online_payment', 13),
(121, '26', '58932', 'INV-313726', '213008', '2024-10-27', 'booked', 'online_payment', 13),
(122, '26', '40980', 'INV-305885', '13000', '2024-10-27', 'booked', 'online_payment', 14),
(123, '26', '83158', 'INV-763573', '22909', '2024-10-27', 'booked', 'online_payment', 14),
(124, '26', '75095', 'INV-502441', '13000', '2024-11-01', 'booked', 'online_payment', 13),
(125, '26', '89561', 'INV-801686', '91000', '2024-11-01', 'booked', 'cash_payment', 14),
(126, '17', '57207', 'INV-485379', '13000', '2024-12-17', 'booked', 'cash_payment', 14),
(127, '26', '39557', 'INV-865908', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(128, '29', '67898', 'INV-894640', '9000', '2024-12-17', 'booked', 'online_payment', 0),
(129, '26', '45708', 'INV-515590', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(130, '30', '25946', 'INV-841506', '200000', '2024-12-17', 'booked', 'online_payment', 0),
(131, '26', '86421', 'INV-351820', '130000', '2024-12-17', 'booked', 'online_payment', 14),
(132, '31', '47647', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(133, '31', '94106', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(134, '31', '25486', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(135, '31', '15151', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(136, '31', '47034', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(137, '31', '85915', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(138, '31', '20943', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(139, '31', '37765', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(140, '31', '88076', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(141, '31', '52880', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(142, '31', '44524', 'INV-737101', '13000', '2024-12-17', 'booked', 'online_payment', 0),
(143, '26', '34405', 'INV-382854', '13000', '2024-12-19', 'booked', 'online_payment', 0),
(144, '26', '60973', 'INV-503921', '13000', '2024-12-19', 'booked', 'online_payment', 14),
(145, '26', '99377', 'INV-201312', '200909', '2024-12-19', 'booked', 'online_payment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 10, '230000', '5'),
(2, 2, 12, '4000', '5'),
(3, 3, 12, '4000', '5'),
(4, 4, 11, '89000', '1'),
(5, 4, 12, '4000', '1'),
(6, 5, 11, '89000', '5'),
(7, 6, 10, '230000', '1'),
(8, 7, 10, '230000', '1'),
(9, 8, 11, '89000', '10'),
(10, 9, 11, '89000', '6'),
(11, 10, 12, '4000', '6'),
(12, 11, 11, '89000', '6'),
(13, 12, 10, '230000', '1'),
(14, 13, 10, '230000', '1'),
(15, 14, 10, '230000', '1'),
(16, 15, 11, '89000', '1'),
(17, 16, 10, '230000', '1'),
(18, 17, 11, '89000', '1'),
(19, 18, 12, '4000', '1'),
(20, 19, 12, '4000', '1'),
(21, 20, 12, '4000', '1'),
(22, 21, 12, '4000', '1'),
(23, 22, 12, '4000', '1'),
(24, 23, 12, '4000', '1'),
(25, 24, 12, '4000', '1'),
(26, 25, 12, '4000', '1'),
(27, 26, 12, '4000', '1'),
(28, 27, 12, '4000', '1'),
(29, 28, 12, '4000', '1'),
(30, 29, 12, '4000', '1'),
(31, 30, 12, '4000', '1'),
(32, 30, 11, '89000', '2'),
(33, 31, 12, '4000', '1'),
(34, 31, 11, '89000', '2'),
(35, 31, 13, '78', '27'),
(36, 32, 12, '4000', '1'),
(37, 32, 11, '89000', '2'),
(38, 32, 13, '78', '27'),
(39, 33, 11, '89000', '1'),
(40, 34, 13, '78', '1'),
(41, 35, 11, '89000', '1'),
(42, 36, 11, '89000', '1'),
(43, 37, 10, '230000', '1'),
(44, 38, 10, '230000', '4'),
(45, 39, 11, '89000', '1'),
(46, 40, 11, '89000', '1'),
(47, 41, 11, '89000', '1'),
(48, 42, 10, '230000', '4'),
(49, 43, 11, '89000', '1'),
(50, 43, 13, '78', '1'),
(51, 44, 13, '78', '1'),
(52, 45, 13, '78', '8'),
(53, 46, 13, '78', '1'),
(54, 47, 15, '1200', '5'),
(55, 48, 15, '1200', '12'),
(56, 49, 15, '1200', '1'),
(57, 50, 15, '1200', '8'),
(58, 51, 16, '13000', '2'),
(59, 51, 15, '1200', '1'),
(60, 52, 15, '1200', '6'),
(61, 53, 15, '1200', '1'),
(62, 53, 16, '13000', '7'),
(63, 54, 16, '13000', '7'),
(64, 55, 15, '1200', '3'),
(65, 56, 16, '13000', '4'),
(66, 57, 15, '1200', '8'),
(67, 58, 17, '9000', '4'),
(68, 59, 15, '1200', '1'),
(69, 59, 17, '9000', '2'),
(70, 59, 16, '13000', '5'),
(71, 60, 17, '9000', '1'),
(72, 61, 15, '1200', '1'),
(73, 62, 15, '1200', '1'),
(74, 63, 17, '9000', '1'),
(75, 64, 16, '13000', '1'),
(76, 65, 15, '1200', '1'),
(77, 66, 15, '1200', '1'),
(78, 67, 16, '13000', '1'),
(79, 67, 15, '1200', '1'),
(80, 68, 15, '1200', '9'),
(81, 68, 16, '13000', '1'),
(82, 68, 17, '9000', '1'),
(83, 69, 15, '1200', '4'),
(84, 70, 16, '13000', '7'),
(85, 71, 16, '13000', '4'),
(86, 72, 16, '13000', '9'),
(87, 72, 17, '9000', '4'),
(88, 73, 17, '9000', '8'),
(89, 73, 16, '13000', '1'),
(90, 74, 16, '13000', '1'),
(91, 75, 16, '13000', '1'),
(92, 76, 17, '9000', '1'),
(93, 77, 17, '9000', '1'),
(94, 78, 16, '13000', '1'),
(95, 79, 15, '1200', '96'),
(96, 80, 16, '13000', '59'),
(97, 81, 15, '1200', '1'),
(98, 82, 18, '900', '1'),
(99, 83, 17, '9000', '4'),
(100, 84, 18, '900', '1'),
(101, 85, 16, '13000', '1'),
(102, 86, 17, '9000', '1'),
(103, 87, 16, '13000', '1'),
(104, 87, 19, '200000', '1'),
(105, 88, 17, '9000', '3'),
(106, 88, 16, '13000', '-8'),
(107, 88, 19, '200000', '3'),
(108, 89, 16, '13000', '1'),
(109, 89, 17, '9000', '1'),
(110, 89, 20, '909', '1'),
(111, 90, 16, '13000', '1'),
(112, 91, 17, '9000', '2'),
(113, 91, 20, '909', '1'),
(114, 92, 16, '13000', '1'),
(115, 93, 17, '9000', '1'),
(116, 94, 19, '200000', '1'),
(117, 95, 20, '909', '1'),
(118, 96, 17, '9000', '1'),
(119, 97, 19, '200000', '1'),
(120, 98, 17, '9000', '1'),
(121, 98, 19, '200000', '1'),
(122, 99, 19, '200000', '1'),
(123, 100, 17, '9000', '1'),
(124, 101, 19, '200000', '1'),
(125, 102, 16, '13000', '1'),
(126, 103, 16, '13000', '1'),
(127, 104, 16, '13000', '1'),
(128, 105, 16, '13000', '1'),
(129, 105, 21, '1', '1'),
(130, 106, 16, '13000', '1'),
(131, 107, 16, '13000', '1'),
(132, 108, 16, '13000', '1'),
(133, 109, 16, '13000', '1'),
(134, 110, 20, '909', '1'),
(135, 111, 16, '13000', '1'),
(136, 112, 16, '13000', '1'),
(137, 113, 17, '9000', '1'),
(138, 114, 17, '9000', '1'),
(139, 115, 19, '200000', '1'),
(140, 115, 20, '909', '1'),
(141, 116, 17, '9000', '1'),
(142, 116, 16, '13000', '1'),
(143, 117, 17, '9000', '1'),
(144, 118, 17, '9000', '1'),
(145, 119, 16, '13000', '1'),
(146, 121, 21, '1', '8'),
(147, 121, 19, '200000', '1'),
(148, 121, 16, '13000', '1'),
(149, 122, 16, '13000', '1'),
(150, 123, 16, '13000', '1'),
(151, 123, 17, '9000', '1'),
(152, 123, 20, '909', '1'),
(153, 124, 16, '13000', '1'),
(154, 125, 16, '13000', '7'),
(155, 126, 16, '13000', '1'),
(156, 127, 16, '13000', '1'),
(157, 128, 17, '9000', '1'),
(158, 129, 16, '13000', '1'),
(159, 130, 19, '200000', '1'),
(160, 131, 16, '13000', '10'),
(161, 132, 16, '13000', '1'),
(162, 133, 16, '13000', '1'),
(163, 134, 16, '13000', '1'),
(164, 135, 16, '13000', '1'),
(165, 136, 16, '13000', '1'),
(166, 137, 16, '13000', '1'),
(167, 138, 16, '13000', '1'),
(168, 139, 16, '13000', '1'),
(169, 140, 16, '13000', '1'),
(170, 141, 16, '13000', '1'),
(171, 142, 16, '13000', '1'),
(172, 143, 16, '13000', '1'),
(173, 144, 16, '13000', '1'),
(174, 145, 20, '909', '1'),
(175, 145, 19, '200000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` varchar(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` int(200) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(16, '15', 'iphone13', 'good', 13000, 188, 'assets/uploads/products/1725646337.webp', 0, '2024-09-07'),
(17, '', 'beer', 'alcohol', 9000, 55, 'assets/uploads/products/1725697659.webp', 0, '2024-09-07'),
(19, '15', 'realme', 'budget', 200000, 187, 'assets/uploads/products/1728703930.jpg', 1, '2024-10-12'),
(20, '18', 'pop', 'op', 909, 83, 'assets/uploads/products/1728706139.jpg', 0, '2024-10-12'),
(21, '18', 'fuo', 'dss', 1, -1, 'assets/uploads/products/1729316356.htm', 0, '2024-10-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
