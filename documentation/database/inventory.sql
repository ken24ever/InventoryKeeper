-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 11:48 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `status` text NOT NULL,
  `item_unique_no` bigint(20) DEFAULT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `category` text NOT NULL,
  `quantity_in_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `status`, `item_unique_no`, `item_name`, `item_description`, `purchase_price`, `sale_price`, `category`, `quantity_in_stock`) VALUES
(1, 'purchase', 12904845757, 'PlayStation 5', 'Gaming console', '450900.00', '490500.25', 'Electronics', 18),
(2, 'purchase', 4799274626354, 'A4 papers', 'OFFICE Stationaries', '1700.00', '1800.00', 'Office Supplies', 36),
(3, 'purchase', 3995858580232, 'Milo', 'beverages', '250.00', '290.00', 'Food and Groceries', 59),
(4, 'purchase', 8927283623762, 'Shaving stick packs', 'shaves', '1000.00', '1200.00', 'Others', 105),
(5, 'purchase', 9034348747473, 'Harry Porter Vol 1', 'Harry Portal book volume 1', '5000.00', '6500.00', 'Books', 28),
(6, 'purchase', 4299238982383, 'Bigs Pen Pack', 'Writing pen', '1200.00', '1300.00', 'Office Supplies', 47),
(7, 'purchase', 2489348937444, 'Wanmore Bread', 'Loaves of Bread, wanmore bakery', '890.00', '950.00', 'Food and Groceries', 36),
(8, 'purchase', 1943434378282, 'Meat pie', 'snacks', '150.00', '250.00', 'Food and Groceries', 10),
(9, 'purchase', 4583846645253, 'Indomie Super Pack', 'Noodles', '100.50', '210.45', 'Food and Groceries', 87),
(10, 'purchase', 8924561278390, 'Indomie Hungry Man', 'Noodles', '300.70', '450.60', 'Food and Groceries', 79),
(11, 'purchase', 3287746692237, 'LG Smart 54 Inches', 'Flat Screen and Smart functionality, with screen size of 54 inches', '390700.88', '405900.90', 'Electronics', 12),
(12, 'purchase', 1273943847625, 'Hisense 32 Inches', 'Hisense flat screen of size 32 inches', '95890.90', '102560.50', 'Electronics', 18),
(13, 'purchase', 8376355527237, 'Vasline Body Lotion', 'Body cream', '1200.22', '1340.56', 'Beauty and Personal Care', 20),
(14, 'purchase', 5939489849849, 'Teddy Bear', 'Toy', '2389.30', '3508.56', 'Toys', 19),
(15, 'purchase', 6384738434822, 'Car Seat Covers', 'Car Interiors , Chairs covers', '2500.60', '3400.78', 'Automotive', 14),
(16, 'purchase', 9038474773473, 'Bubble Gums', 'Chew Gums', '45.90', '65.95', 'Food and Groceries', 89),
(17, 'purchase', 3822128876654, 'Rose Flowers', 'Flowers', '3200.00', '3340.22', 'Home Decor', 37),
(18, 'purchase', 6838743847347, 'Kiddies Building Blocks', 'Toy for kids', '4532.55', '4866.89', 'Toys', 19),
(19, 'purchase', 4236727382382, 'Fry Pans', 'Kitchen Wares', '2300.00', '2890.78', 'Kitchenware', 10),
(20, 'purchase', 2343434348898, 'Nick Sport Boots', 'sports foot wears', '12000.23', '12590.90', 'Sports Equipment', 10),
(21, 'purchase', 7354353543545, 'Footballs', 'football', '1500.00', '1700.00', 'Sports Equipment', 17),
(22, 'purchase', 9837437643646, 'Clubs Jerseys', 'Football club sporting wears', '13500.70', '14580.89', 'Clothing', 94),
(23, 'purchase', 3332239289328, 'Walframes', 'Home decor', '16900.90', '17500.23', 'Home Decor', 21),
(24, 'purchase', 1111443333366, 'Rolex Watches', 'Rolex wrist watches', '20490.00', '24900.80', 'Electronics', 19),
(25, 'purchase', 9999955555333, 'Playstation 5 Game Controllers', 'Game Pads PS 5', '14700.89', '15345.99', 'Electronics', 18),
(26, 'purchase', 7622211114444, 'Cream Crackers', 'Biscuits and snacks', '60.00', '70.00', 'Food and Groceries', 170),
(27, 'purchase', 3333111198888, 'Peak Milk Sachets', 'Peak sachets', '75.90', '100.90', 'Food and Groceries', 464),
(28, 'purchase', 8884444411112, 'Peak Milk Medium Tin', 'Peak milk medium tin', '1679.90', '1890.90', 'Food and Groceries', 40),
(29, 'purchase', 7777111002222, 'Sony Sound Systems', 'Sound Electronics', '120500.90', '140500.23', 'Electronics', 15),
(30, 'purchase', 2222999900022, 'Facial Make Up kits', 'Women make up kits', '12000.00', '13600.90', 'Beauty and Personal Care', 26),
(31, 'purchase', 5551111999222, 'Colgate Tooth Paste', 'Colgate tooth paste', '700.90', '800.90', 'Health and Wellness', 26),
(32, 'purchase', 1111111177777, 'Single Executive Chair', 'furniture', '80400.90', '100500.80', 'Furniture', 12),
(33, 'purchase', 7771111111888, 'Stapplers', 'Office supplies', '1300.90', '1500.99', 'Office Supplies', 14),
(34, 'purchase', 5553331111199, 'Snickers', 'chocolate snacks', '230.23', '300.90', 'Food and Groceries', 28),
(35, 'purchase', 6666111199956, 'Electric Lunch Box', 'Portable Lunch box that can warm your food when cold', '10510.90', '12500.90', 'Electronics', 16),
(36, 'purchase', 7777111333444, 'Rite-tek Pressing Iron', 'Pressing Iron, Steam iron.', '12567.45', '13950.90', 'Electronics', 25),
(37, 'purchase', 5551111777222, 'Ceramics Tea Cups', 'Quality Ceramics', '2506.60', '2950.80', 'Others', 52),
(38, 'purchase', 4442222888811, 'Bread Cake', 'cake', '10222.34', '11456.50', 'Food and Groceries', 18),
(39, 'purchase', 1333332211111, 'Blazzers', 'Quality men suite', '35789.90', '45900.69', 'Clothing', 20),
(40, 'purchase', 2221118882223, 'Italian Suite', 'men suite', '23590.50', '26790.90', 'Clothing', 21),
(41, 'purchase', 6621111111111, 'Tin Tomato', 'Tomatoe paste medium (tin)', '560.90', '600.89', 'Food and Groceries', 50),
(42, 'purchase', 4555111118888, 'Pair of Chinos Trouser', 'Chinos Trouser', '7800.45', '8905.35', 'Clothing', 92),
(43, 'purchase', 2111117777777, 'Merchant Of Vernice', 'Merchant Of Vernice by Williams Shakespares', '1590.90', '2500.90', 'Books', 20),
(44, 'purchase', 6666633333211, 'Bama', 'Bama cream big size', '2400.00', '2950.00', 'Food and Groceries', 16),
(46, 'purchase', 4444411111138, 'Ceramic Set of Plates', 'Broke-able sets of plate', '12500.00', '15699.00', 'Kitchenware', 19),
(48, 'purchase', 1119000222222, 'HP PAVILON', 'HP PAVILON i-Core 8 , 12GIGABYTE-RAM', '304980.90', '345894.75', 'Electronics', 15),
(49, 'purchase', 6622711118728, 'TV Stand (foreign)', 'A TV stand with great quality', '29033.00', '34698.00', 'Furniture', 21);

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

CREATE TABLE `qrcodes` (
  `qr_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qr_code_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qrcodes`
--

INSERT INTO `qrcodes` (`qr_id`, `item_id`, `qr_code_image`) VALUES
(1, 1, 'qrCodeImg/12904845757.png'),
(2, 2, 'qrCodeImg/4799274626354.png'),
(3, 3, 'qrCodeImg/3995858580232.png'),
(4, 4, 'qrCodeImg/8927283623762.png'),
(5, 5, 'qrCodeImg/9034348747473.png'),
(6, 6, 'qrCodeImg/4299238982383.png'),
(7, 7, 'qrCodeImg/2489348937444.png'),
(8, 8, 'qrCodeImg/1943434378282.png'),
(9, 9, 'qrCodeImg/4583846645253.png'),
(10, 10, 'qrCodeImg/8924561278390.png'),
(11, 11, 'qrCodeImg/3287746692237.png'),
(12, 12, 'qrCodeImg/1273943847625.png'),
(13, 13, 'qrCodeImg/8376355527237.png'),
(14, 14, 'qrCodeImg/5939489849849.png'),
(15, 15, 'qrCodeImg/6384738434822.png'),
(16, 16, 'qrCodeImg/9038474773473.png'),
(17, 17, 'qrCodeImg/3822128876654.png'),
(18, 18, 'qrCodeImg/6838743847347.png'),
(19, 19, 'qrCodeImg/4236727382382.png'),
(20, 20, 'qrCodeImg/2343434348898.png'),
(21, 21, 'qrCodeImg/7354353543545.png'),
(22, 22, 'qrCodeImg/9837437643646.png'),
(23, 23, 'qrCodeImg/3332239289328.png'),
(24, 24, 'qrCodeImg/1111443333366.png'),
(25, 25, 'qrCodeImg/9999955555333.png'),
(26, 26, 'qrCodeImg/7622211114444.png'),
(27, 27, 'qrCodeImg/3333111198888.png'),
(28, 28, 'qrCodeImg/8884444411112.png'),
(29, 29, 'qrCodeImg/7777111002222.png'),
(30, 30, 'qrCodeImg/2222999900022.png'),
(31, 31, 'qrCodeImg/5551111999222.png'),
(32, 32, 'qrCodeImg/1111111177777.png'),
(33, 33, 'qrCodeImg/7771111111888.png'),
(34, 34, 'qrCodeImg/5553331111199.png'),
(35, 35, 'qrCodeImg/6666111199956.png'),
(36, 36, 'qrCodeImg/7777111333444.png'),
(37, 37, 'qrCodeImg/5551111777222.png'),
(38, 38, 'qrCodeImg/4442222888811.png'),
(39, 39, 'qrCodeImg/1333332211111.png'),
(40, 40, 'qrCodeImg/2221118882223.png'),
(41, 41, 'qrCodeImg/6621111111111.png'),
(42, 42, 'qrCodeImg/4555111118888.png'),
(43, 43, 'qrCodeImg/2111117777777.png'),
(44, 44, 'qrCodeImg/6666633333211.png'),
(46, 46, 'qrCodeImg/4444411111138.png'),
(47, 48, 'qrCodeImg/1119000222222.png'),
(49, 49, 'qrCodeImg/6622711118728.png');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Super Admin'),
(2, 'Accountant'),
(3, 'Store Keeper'),
(4, 'Admin'),
(5, 'Sales Manager'),
(7, 'Auditor'),
(8, 'Secretary');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `modeOfPayment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `transaction_type` enum('sale','purchase','adjustment') DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `profit_loss` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `modeOfPayment`, `user_id`, `item_id`, `transaction_date`, `transaction_type`, `quantity`, `total_amount`, `profit_loss`) VALUES
(1, 'cash', 21, 3, '2023-07-23', 'sale', 4, '1160.00', '40.00'),
(2, 'cash', 21, 2, '2023-07-23', 'sale', 10, '18000.00', '100.00'),
(9, 'cash', 21, 3, '2023-07-23', 'sale', 5, '1450.00', '40.00'),
(10, 'cash', 21, 5, '2023-07-23', 'sale', 1, '6500.00', '1500.00'),
(11, 'cash', 21, 2, '2023-07-23', 'sale', 4, '7200.00', '100.00'),
(12, 'cash', 21, 2, '2023-07-23', 'sale', 2, '3600.00', '100.00'),
(191, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(192, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(193, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(194, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(195, 'cash', 22, 6, '2023-07-24', 'sale', 1, '1300.00', '100.00'),
(196, 'cash', 22, 6, '2023-07-24', 'sale', 1, '1300.00', '100.00'),
(197, 'cash', 22, 6, '2023-07-24', 'sale', 1, '1300.00', '100.00'),
(198, 'cash', 22, 6, '2023-07-24', 'sale', 1, '1300.00', '100.00'),
(199, 'cash', 22, 4, '2023-07-24', 'sale', 1, '1200.00', '200.00'),
(200, 'cash', 22, 4, '2023-07-24', 'sale', 1, '1200.00', '200.00'),
(201, 'cash', 22, 4, '2023-07-24', 'sale', 1, '1200.00', '200.00'),
(202, 'cash', 22, 4, '2023-07-24', 'sale', 1, '1200.00', '200.00'),
(203, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(204, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(205, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(206, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(207, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(208, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(209, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(210, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(211, 'cash', 22, 8, '2023-07-24', 'sale', 4, '1000.00', '100.00'),
(212, 'cash', 22, 1, '2023-07-24', 'sale', 1, '490500.25', '39600.25'),
(213, 'cash', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(214, 'cash', 22, 3, '2023-07-24', 'sale', 5, '1450.00', '40.00'),
(215, 'cash', 22, 5, '2023-07-24', 'sale', 1, '6500.00', '1500.00'),
(216, 'cash', 22, 6, '2023-07-24', 'sale', 2, '2600.00', '100.00'),
(217, 'cash', 22, 4, '2023-07-24', 'sale', 3, '3600.00', '200.00'),
(218, 'cash', 22, 7, '2023-07-24', 'sale', 4, '3800.00', '60.00'),
(219, 'cash', 22, 8, '2023-07-24', 'sale', 2, '500.00', '100.00'),
(220, 'pos', 22, 2, '2023-07-24', 'sale', 1, '1800.00', '100.00'),
(221, 'pos', 22, 3, '2023-07-24', 'sale', 5, '1450.00', '40.00'),
(222, 'mobile_transfer', 21, 2, '2023-07-25', 'sale', 1, '1800.00', '100.00'),
(223, 'mobile_transfer', 21, 1, '2023-07-25', 'sale', 1, '490500.25', '39600.25'),
(224, 'mobile_transfer', 21, 3, '2023-07-25', 'sale', 12, '3480.00', '40.00'),
(225, 'mobile_transfer', 21, 4, '2023-07-25', 'sale', 1, '1200.00', '200.00'),
(226, 'mobile_transfer', 21, 5, '2023-07-25', 'sale', 1, '6500.00', '1500.00'),
(227, 'mobile_transfer', 21, 6, '2023-07-25', 'sale', 2, '2600.00', '100.00'),
(228, 'mobile_transfer', 21, 14, '2023-07-25', 'sale', 2, '7017.12', '1119.26'),
(229, 'mobile_transfer', 21, 12, '2023-07-25', 'sale', 1, '102560.50', '6669.60'),
(230, 'mobile_transfer', 21, 9, '2023-07-25', 'sale', 8, '1683.60', '109.95'),
(231, 'mobile_transfer', 21, 16, '2023-07-25', 'sale', 10, '659.50', '20.05'),
(232, 'mobile_transfer', 21, 23, '2023-07-25', 'sale', 1, '17500.23', '599.33'),
(233, 'mobile_transfer', 21, 22, '2023-07-25', 'sale', 2, '29161.78', '1080.19'),
(234, 'cash', 22, 30, '2023-07-25', 'sale', 1, '13600.90', '1600.90'),
(235, 'cash', 22, 26, '2023-07-25', 'sale', 30, '2100.00', '10.00'),
(236, 'cash', 22, 27, '2023-07-25', 'sale', 24, '2421.60', '25.00'),
(237, 'cash', 22, 31, '2023-07-25', 'sale', 4, '3203.60', '100.00'),
(238, 'cash', 22, 33, '2023-07-25', 'sale', 1, '1500.99', '200.09'),
(239, 'cash', 22, 23, '2023-07-25', 'sale', 2, '35000.46', '599.33'),
(240, 'cash', 22, 19, '2023-07-25', 'sale', 2, '5781.56', '590.78'),
(241, 'cash', 22, 14, '2023-07-25', 'sale', 1, '3508.56', '1119.26'),
(242, 'cash', 21, 29, '2023-07-27', 'sale', 1, '140500.23', '19999.33'),
(243, 'cash', 21, 27, '2023-07-27', 'sale', 12, '1210.80', '25.00'),
(244, 'cash', 21, 31, '2023-07-27', 'sale', 2, '1601.80', '100.00'),
(245, 'cash', 21, 24, '2023-07-27', 'sale', 2, '49801.60', '4410.80'),
(246, 'cash', 21, 22, '2023-07-27', 'sale', 2, '29161.78', '1080.19'),
(247, 'cash', 21, 21, '2023-07-27', 'sale', 2, '3400.00', '200.00'),
(248, 'cash', 21, 20, '2023-07-27', 'sale', 1, '12590.90', '590.67'),
(249, 'cash', 21, 8, '2023-07-27', 'sale', 8, '2000.00', '100.00'),
(250, 'cash', 21, 7, '2023-07-27', 'sale', 6, '5700.00', '60.00'),
(251, 'cash', 22, 19, '2023-07-29', 'sale', 1, '2890.78', '590.78'),
(252, 'cash', 22, 24, '2023-07-29', 'sale', 1, '24900.80', '4410.80'),
(253, 'cash', 22, 18, '2023-07-29', 'sale', 1, '4866.89', '334.34'),
(254, 'cash', 22, 14, '2023-07-29', 'sale', 1, '3508.56', '1119.26'),
(255, 'pos', 26, 35, '2023-07-29', 'sale', 1, '12500.90', '1990.00'),
(256, 'pos', 26, 34, '2023-07-29', 'sale', 6, '1805.40', '70.67'),
(257, 'pos', 26, 31, '2023-07-29', 'sale', 2, '1601.80', '100.00'),
(258, 'pos', 26, 9, '2023-07-29', 'sale', 5, '1052.25', '109.95'),
(259, 'pos', 28, 44, '2023-07-30', 'sale', 2, '5900.00', '550.00'),
(260, 'pos', 28, 43, '2023-07-30', 'sale', 2, '5001.80', '910.00'),
(261, 'pos', 28, 42, '2023-07-30', 'sale', 6, '53432.10', '1104.90'),
(262, 'pos', 28, 39, '2023-07-30', 'sale', 1, '45900.69', '10110.79'),
(263, 'pos', 28, 40, '2023-07-30', 'sale', 1, '26790.90', '3200.40'),
(264, 'pos', 28, 38, '2023-07-30', 'sale', 4, '45826.00', '1234.16'),
(265, 'pos', 28, 37, '2023-07-30', 'sale', 3, '8852.40', '444.20'),
(266, 'pos', 28, 36, '2023-07-30', 'sale', 1, '13950.90', '1383.45'),
(267, 'pos', 28, 34, '2023-07-30', 'sale', 8, '2407.20', '70.67'),
(268, 'pos', 28, 2, '2023-08-01', 'sale', 1, '1800.00', '100.00'),
(269, 'pos', 28, 3, '2023-08-01', 'sale', 3, '870.00', '40.00'),
(270, 'cash', 22, 14, '2023-08-14', 'sale', 1, '3508.56', '1119.26'),
(271, 'cash', 22, 17, '2023-08-14', 'sale', 1, '3340.22', '140.22'),
(272, 'cash', 22, 19, '2023-08-14', 'sale', 1, '2890.78', '590.78'),
(273, 'cash', 22, 20, '2023-08-14', 'sale', 1, '12590.90', '590.67'),
(274, 'cash', 28, 2, '2023-08-16', 'sale', 1, '1800.00', '100.00'),
(275, 'cash', 28, 1, '2023-08-16', 'sale', 1, '490500.25', '39600.25'),
(276, 'cash', 28, 2, '2023-08-24', 'sale', 1, '1800.00', '100.00'),
(277, 'cash', 28, 3, '2023-08-24', 'sale', 1, '290.00', '40.00'),
(278, 'pos', 22, 49, '2023-08-27', 'sale', 1, '34698.00', '5665.00'),
(279, 'pos', 22, 12, '2023-08-27', 'sale', 1, '102560.50', '6669.60'),
(280, 'pos', 22, 23, '2023-08-27', 'sale', 1, '17500.23', '599.33'),
(281, 'pos', 22, 24, '2023-08-27', 'sale', 1, '24900.80', '4410.80'),
(282, 'pos', 22, 34, '2023-08-27', 'sale', 6, '1805.40', '70.67'),
(283, 'pos', 22, 31, '2023-08-27', 'sale', 1, '800.90', '100.00'),
(284, 'cash', 22, 31, '2023-08-28', 'sale', 1, '800.90', '100.00'),
(285, 'cash', 22, 34, '2023-08-28', 'sale', 1, '300.90', '70.67'),
(286, 'cash', 22, 35, '2023-08-28', 'sale', 1, '12500.90', '1990.00'),
(287, 'cash', 22, 38, '2023-08-28', 'sale', 1, '11456.50', '1234.16'),
(288, 'cash', 22, 39, '2023-08-28', 'sale', 1, '45900.69', '10110.79'),
(289, 'cash', 22, 40, '2023-08-28', 'sale', 1, '26790.90', '3200.40'),
(290, 'cash', 22, 42, '2023-08-28', 'sale', 1, '8905.35', '1104.90'),
(291, 'cash', 22, 46, '2023-08-28', 'sale', 1, '15699.00', '3199.00'),
(292, 'cash', 22, 36, '2023-08-28', 'sale', 1, '13950.90', '1383.45'),
(293, 'pos', 22, 49, '2023-09-01', 'sale', 1, '34698.00', '5665.00'),
(294, 'pos', 22, 19, '2023-09-01', 'sale', 1, '2890.78', '590.78'),
(295, 'pos', 22, 17, '2023-09-01', 'sale', 1, '3340.22', '140.22'),
(296, 'pos', 22, 7, '2023-09-01', 'sale', 3, '2850.00', '60.00'),
(297, 'pos', 22, 22, '2023-09-01', 'sale', 1, '14580.89', '1080.19'),
(298, 'pos', 22, 18, '2023-09-01', 'sale', 1, '4866.89', '334.34'),
(299, 'pos', 22, 34, '2023-09-01', 'sale', 1, '300.90', '70.67'),
(300, 'pos', 22, 24, '2023-09-03', 'sale', 1, '24900.80', '4410.80'),
(301, 'pos', 22, 17, '2023-09-03', 'sale', 1, '3340.22', '140.22'),
(302, 'pos', 22, 28, '2023-09-03', 'sale', 8, '15127.20', '211.00'),
(303, 'pos', 22, 38, '2023-09-03', 'sale', 2, '22913.00', '1234.16'),
(304, 'pos', 22, 7, '2023-09-03', 'sale', 2, '1900.00', '60.00'),
(305, 'pos', 22, 14, '2023-09-03', 'sale', 1, '3508.56', '1119.26'),
(306, 'pos', 22, 10, '2023-09-03', 'sale', 1, '450.60', '149.90'),
(307, 'pos', 22, 7, '2023-09-03', 'sale', 1, '950.00', '60.00'),
(308, 'pos', 22, 16, '2023-09-03', 'sale', 1, '65.95', '20.05'),
(309, 'pos', 22, 18, '2023-09-03', 'sale', 1, '4866.89', '334.34'),
(310, 'pos', 28, 4, '2023-09-08', 'sale', 1, '1200.00', '200.00'),
(311, 'pos', 28, 5, '2023-09-08', 'sale', 1, '6500.00', '1500.00'),
(312, 'pos', 28, 22, '2023-09-08', 'sale', 1, '14580.89', '1080.19'),
(313, 'pos', 28, 42, '2023-09-08', 'sale', 1, '8905.35', '1104.90'),
(314, 'pos', 28, 7, '2023-09-08', 'sale', 2, '1900.00', '60.00'),
(315, 'pos', 28, 6, '2023-09-11', 'sale', 1, '1300.00', '100.00'),
(316, 'pos', 28, 21, '2023-09-11', 'sale', 1, '1700.00', '200.00'),
(317, 'pos', 28, 15, '2023-09-11', 'sale', 1, '3400.78', '900.18'),
(318, 'pos', 28, 8, '2023-09-11', 'sale', 2, '500.00', '100.00'),
(319, 'pos', 28, 38, '2023-09-11', 'sale', 2, '22913.00', '1234.16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role_id`) VALUES
(18, 'ken24ever', '$2y$10$GVDFWMo7EhYMaVEPlmXHPOzeVjkWKcUXOxkucwjruhm6XuaIpXZSi', 1),
(19, 'emma24_ever', '$2y$10$bg9dh78o3alro69xs0ewEecdE4zM4boMrDZzxzTACDYp1QCGlHaae', 4),
(20, 'katie1234', '$2y$10$25sdG1xOtwXqFRAxmFSl/OJSB8RWmJTOE17N9IpUPkBLWNIsfd8ee', 3),
(21, 'david_jackson12345', '$2y$10$IlZxaB0zQ26uLEFfy95Nju3jzhqUW6pKA4BSdPby2B.Df674ukqd2', 5),
(22, 'sara_24', '$2y$10$AD58iadK5Lpyrir1i1aCPujve2zYK199qBIw9RkUI27gQTsFeGy72', 5),
(23, 'jason123', '$2y$10$LGuX2nbuQcjbifIsP0puGOT214b4335kxnDZeAOCYoJQcfRy44p8.', 3),
(24, 'Clara123', '$2y$10$xPmRoBBFIM5ivT93d8bKpu7Jyviki0ShwgSuXBHWTEegMjPejvZ1y', 3),
(28, 'Tatiana_134', '$2y$10$JNdG8OTzejNtyzQUHrhU..F2HgB4ym46AT7DD5WzJiflcazfgzoyW', 5),
(36, 'wealth123', '$2y$10$otKi/ewkxKXor9xQdS7vyu/O8BlTRTjnn1Wl6ExbumYQ3wIBt02Ci', 4),
(37, 'fiona12345', '$2y$10$PbhXqEQ7brqIv0y2YY/AnODLeNKgLhGvUCEZQbYv0vRwAinukILQO', 3),
(41, 'admin', '$2y$10$Nn/QDXEJ1x/zafYDD9lg3OsHboY.TrcS14aSX3gBWe9M8tcPnrlwq', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`qr_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `qr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
