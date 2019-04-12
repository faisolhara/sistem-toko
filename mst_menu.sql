-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2017 at 02:07 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_menu`
--

CREATE TABLE `mst_menu` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `series_number` int(11) NOT NULL,
  `resource` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privilege` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_menu`
--

INSERT INTO `mst_menu` (`menu_id`, `series_number`, `resource`, `privilege`) VALUES
(1, 1, 'Master User', 'view'),
(2, 1, 'Master User', 'add'),
(3, 1, 'Master User', 'update'),
(4, 2, 'Master Role', 'view'),
(5, 2, 'Master Role', 'add'),
(6, 2, 'Master Role', 'update'),
(7, 3, 'Master Uom', 'view'),
(8, 3, 'Master Uom', 'add'),
(9, 3, 'Master Uom', 'update'),
(10, 4, 'Master Category', 'view'),
(11, 4, 'Master Category', 'add'),
(12, 4, 'Master Category', 'update'),
(13, 5, 'Master Conversion', 'view'),
(14, 5, 'Master Conversion', 'add'),
(15, 5, 'Master Conversion', 'update'),
(16, 6, 'Master Item', 'view'),
(17, 6, 'Master Item', 'add'),
(18, 6, 'Master Item', 'update'),
(19, 7, 'Master Supplier', 'view'),
(20, 7, 'Master Supplier', 'add'),
(21, 7, 'Master Supplier', 'update'),
(22, 8, 'Item Stock', 'view'),
(23, 9, 'Receipt Item', 'view'),
(24, 9, 'Receipt Item', 'add');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_menu`
--
ALTER TABLE `mst_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_menu`
--
ALTER TABLE `mst_menu`
  MODIFY `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
