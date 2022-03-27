-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 01:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(30) NOT NULL,
  `branch_code` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` int(11) NOT NULL,
  `country` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `street`, `city`, `state`, `zip_code`, `country`, `contact`, `date_created`) VALUES
(1, '0O6rFyf1s7vwRoJ', '16 avenue el hajeb, Lotissement Attar, Mhannech 2', 'Tétouan', 'Tanger-Tétouan-Al Hoceima', 93000, 'Maroc', '+212 639493900', '2022-03-27 00:56:40'),
(2, 'W6qKaEXFb2nuOsx', '48, Avenue dahab, Souani', 'Tanger', 'Tanger-Tétouan-Al Hoceima', 96587, 'Maroc', '000000000', '2022-03-27 00:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(30) NOT NULL,
  `br_dec` varchar(100) NOT NULL,
  `expedition_number` varchar(100) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `sender_city` varchar(100) NOT NULL,
  `sender_address` text DEFAULT NULL,
  `sender_contact` text NOT NULL,
  `recipient_name` text NOT NULL,
  `recipient_cin` varchar(100) NOT NULL,
  `recipient_city` text NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_contact` text NOT NULL,
  `type` int(1) NOT NULL COMMENT '1=Domicile, 2=Agence',
  `type_expedition` int(1) NOT NULL COMMENT '1=Express, 2=Simple',
  `from_branch_id` varchar(30) NOT NULL,
  `to_branch_id` varchar(30) NOT NULL,
  `weight` float NOT NULL,
  `number` int(11) NOT NULL,
  `taxateur` int(11) NOT NULL,
  `code_ramasseur` varchar(20) NOT NULL,
  `type_retour_de_fond` int(1) NOT NULL COMMENT '1=C/Espèce, 2=C/Chèque, 3=C/Traité',
  `price_retour_de_fond` float NOT NULL,
  `price_retour_bl` float NOT NULL,
  `transport` float NOT NULL,
  `manutention` float NOT NULL,
  `declared_value` float NOT NULL,
  `ramassage` float NOT NULL,
  `delivery` float NOT NULL,
  `avis` float NOT NULL,
  `enregistrement` float NOT NULL,
  `autre_frais` float NOT NULL,
  `price` float NOT NULL,
  `paid_price` float NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `br_dec`, `expedition_number`, `sender_name`, `sender_id`, `sender_city`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_cin`, `recipient_city`, `recipient_address`, `recipient_contact`, `type`, `type_expedition`, `from_branch_id`, `to_branch_id`, `weight`, `number`, `taxateur`, `code_ramasseur`, `type_retour_de_fond`, `price_retour_de_fond`, `price_retour_bl`, `transport`, `manutention`, `declared_value`, `ramassage`, `delivery`, `avis`, `enregistrement`, `autre_frais`, `price`, `paid_price`, `status`, `date_created`) VALUES
(1, '942017', '', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 1, 2, '2', '1', 3, 3, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, '2022-03-27 00:57:51'),
(2, '874070', '', 'popj', 'kpmkpk', 'k^pkkjoihj', 'kp', 'poijojoijp', 'ojpoijpoij', 'oijopijoijo', 'jopijoijoij', 'ijopijpoijpoi', 'opijopjoijoi', 2, 1, '2', '2', 5, 5, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.24, 0, 0, '2022-03-27 01:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcel_tracks`
--

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `status`, `user_id`, `date_created`) VALUES
(1, 1, 0, 1, '2022-03-27 00:57:51'),
(2, 2, 0, 3, '2022-03-27 01:05:16'),
(3, 0, 0, 3, '2022-03-27 01:11:08'),
(4, 0, 0, 3, '2022-03-27 01:11:42'),
(5, 0, 0, 3, '2022-03-27 01:12:44'),
(6, 0, 0, 3, '2022-03-27 01:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `cin` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `branch_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `cin`, `email`, `password`, `type`, `branch_id`, `date_created`) VALUES
(1, 'Admin', 'A', 'LM666589', 'admin@a.a', '$2y$10$.Ef6aowpbDuYYSB7Se141.J7/mHRUdgn.SZnaW1nqkdeypSH6.9dC', 1, 1, '2022-03-27 00:55:42'),
(2, 'Hamza', 'El Khatib', '', 'a@a.a', '$2y$10$biFV7HkCTVWUsQvdiTElA.dOjrttvJnByN/fE/.122yynSAkQ/r5i', 2, 1, '2022-03-27 01:02:28'),
(3, 'Hamid', 'Azouzi', '', 'u@u.u', '$2y$10$kNCGDr0aUbU3UBZKQrQnhubbnOsDEicZ.bODwq7DKx2iBcA0KSbby', 2, 2, '2022-03-27 01:02:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
