-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2022 at 10:01 PM
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
(1, '0O6rFyf1s7vwRoJ', '16 avenue el hajeb, Lotissement Attar, M\'hannech 2', 'Tétouan', 'Tanger-Tétouan-Al Hoceima', 93000, 'Maroc', '+212 639493900', '2022-03-27 00:56:40'),
(2, 'W6qKaEXFb2nuOsx', '48, Avenue dahab, Souani', 'Tanger', 'Tanger-Tétouan-Al Hoceima', 96587, 'Maroc', '000000000', '2022-03-27 00:57:17'),
(3, 'LvDr7AQaP8KYx3i', 'eeu-yety', 'jrtyj', 'jrtuj', 0, 'ryujry', 'ryujr', '2022-04-12 18:45:07'),
(4, 'PcdADwvSkh2QjaZ', 'fghsf', 'gfg', 'ggg', 0, 'ggg', 'ggg', '2022-04-12 19:57:06'),
(5, 'FnQt3PprhZ9dBSK', 'xghnx', 'fgndf', 'gnfg', 0, 'fg', 'fg', '2022-04-12 20:13:39'),
(6, 'kTeMC5N3yO1valu', 'ghgjhhg', 'hghh', 'hhh', 0, 'ghggh', 'ghgh', '2022-04-12 20:18:22'),
(7, 'UcKxqWjhbdAsVSu', 'ghjngdhdg', 'hjdgjh', 'gdh', 0, 'jghj', 'ghj', '2022-04-12 20:19:01'),
(8, 'TPtAOj3Udo8YlCB', 'fg', 'fgg', 'gg', 0, 'gg', 'fgg', '2022-04-12 20:25:54'),
(9, 'qfiygmSweDaQbZY', 'fhjkf', 'fhj', 'fghj', 0, 'jfghj', 'fghj', '2022-04-12 20:27:59'),
(10, 'wmAhUCb4EQsurOH', 'gds', 'gh', 'g', 0, 'g', 'g', '2022-04-12 20:36:04'),
(11, '0IolFCv5146YTEA', 'hgggg', 'hhh', 'hh', 0, 'h', 'h', '2022-04-12 22:10:36'),
(12, 'iPTOdWE0x6aMSzC', 'v\'', 'f', 'f', 0, 'f', 'f', '2022-04-12 22:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(30) NOT NULL,

  `br_dec` varchar(50) NOT NULL,
  `reference` varchar(100) NOT NULL,
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

  `type_retour_de_fond` int(1) NOT NULL COMMENT '1=C/Espèce, 2=C/Chèque, 3=C/Traité',
  `price_retour_de_fond` float NOT NULL,
  `price_retour_bl` float NOT NULL,
  `price` float NOT NULL,
  `due_price` float NOT NULL,

  `status` int(2) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `reference`, `expedition_number`, `sender_name`, `sender_id`, `sender_city`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_cin`, `recipient_city`, `recipient_address`, `recipient_contact`, `type`, `type_expedition`, `from_branch_id`, `to_branch_id`, `weight`, `number`, `taxateur`, `code_ramasseur`, `type_retour_de_fond`, `price_retour_de_fond`, `price_retour_bl`, `price`, `due_price`, `status`, `date_created`) VALUES
(1, '942017', '', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 1, 2, '2', '1', 3, 3, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, '2022-03-27 00:57:51'),
(2, '874070', '', 'popj', 'kpmkpk', 'k^pkkjoihj', 'kp', 'poijojoijp', 'ojpoijpoij', 'oijopijoijo', 'jopijoijoij', 'ijopijpoijpoi', 'opijopjoijoi', 2, 1, '2', '2', 5, 5, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5.24, 0, 2, '2022-03-27 01:05:16'),
(3, '609014', '', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 2, 2, '1', '1', 5, 5, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 2, '2022-03-28 15:43:55'),
(4, '149711', '', 'j', 'j', 'j', 'j', 'j', 'j', 'j', 'j', 'j', 'j', 1, 1, '1', '1', 7, 4475, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 54.14, 0, 3, '2022-03-28 15:45:38'),
(5, '410218', '', 'Aziz Hammoudi', 'ML845852', 'Tetouan', 'Lot sounanir 548 Avenue Saltanat oman', '0303232030', 'ihhpoiojoj ojojijoojioj', 'opkoomik4545', 'pojopihoiuh hihih oiuhoih', '54564564pîu poijopjpoijh oijhopij', 'iuhoihiohioh', 1, 2, '1', '2', 10, 20, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.36, 0, 3, '2022-03-28 15:46:56'),
(6, '537321', '', 'ytjtyj', 'dstyjedty', 'yjtyjety', 'jtdje', 'jteyjtjyet', 'tyjtyj', 'tyjy', 'yjte', 'jytyt', 'ytydj', 1, 1, '1', '2', 10, 2, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20.45, 0, 3, '2022-03-28 15:47:21'),
(7, '405699', '', 'ml', 'ml', 'l', 'm', 'ml', 'ml', 'ml', 'ml', 'ml', 'm', 2, 2, '1', '1', 4, 4, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, '2022-03-28 15:48:34'),
(8, '083447', '', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 2, 2, '1', '2', 65, 6, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, '2022-03-28 15:48:50'),
(9, '884903', '', 'b', 'b', 'n', 'b', 'j', 'mjlmlk', 'lmklmklk', 'kllkmlkklm', 'lklmklk', 'lkklkm', 2, 2, '1', '1', 4, 4, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, '2022-03-28 15:49:10'),
(10, '577417', '', 'oihouhh', 'oiuhoiuhuh', 'oiuhoiuhiouh', 'uihoihoiuh', 'oiuhiouhhiu', 'iouhhoiuhoiuiouh', 'huihuihiuo', 'hiuhiuhiuhiu', 'hiuhuihuhiuo', 'hiuhiuhiuhui', 2, 2, '1', '2', 4, 4, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, '2022-03-28 15:49:30'),
(11, '693816', '', 'ioug', 'gigioug', 'oiugoiugoiug', 'iougiougioug', 'giouiuiug', 'iuiuiuiou', 'iouiug', 'iuiuiu', 'giuouigguiiuo', 'iuggiuiuo', 2, 2, '1', '1', 4, 5, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, '2022-03-28 15:50:07'),
(12, '210702', '', 'po', 'po', 'op', 'o', 'op', 'op', 'po', 'op', 'op', 'o', 1, 1, '1', '2', 4, 4, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, '2022-03-28 15:50:36'),
(13, '635911', '', 'uhoi', 'hio', 'iou', 'hoih', 'h', 'ui', 'houi', 'ouih', 'huih', 'ohuiu', 2, 1, '1', '1', 4, 5, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, '2022-03-28 15:51:17'),
(14, '799014', '', 'iogiug', 'iogoig', 'iuygiuyg', 'yguyg', 'iugiuyg', 'ouygiyug', 'iuygyug', 'yuiuy', 'iyugiygu', 'uyiigiuy', 1, 2, '1', '1', 4, 5, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 0, '2022-03-28 15:51:44'),
(15, '428067', '', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 2, 2, '1', '1', 45, 45, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 45, 0, 1, '2022-03-28 15:52:11'),
(16, '319038', '', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 2, 2, '1', '1', 4, 4, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 1, '2022-03-28 15:52:26'),
(17, '794708', '', 'mlk', 'mlkm', 'lkk', 'lkm', 'pojo', 'ijo', 'ihj', 'gu', 'uhio', 'f', 2, 1, '1', '2', 44, 54, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 544.12, 0, 0, '2022-03-28 15:53:31'),
(18, '616363', '', 'nbv', 'n', 'nv', 'nv', 'n', 'vnv', 'jvjvjhv', 'hgvjhgv', 'hvjhvjhv', 'kgkgv', 2, 2, '1', '1', 54, 5, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.36, 0, 0, '2022-03-28 15:54:19'),
(19, '768819', '', 'khblk', 'oih', 'poh', 'oph', 'opi', 'ho', 'ih', 'hoi', 'oiho', 'hpoih', 2, 2, '1', '1', 654, 6, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20.21, 0, 1, '2022-03-28 15:55:06'),
(20, '449121', '', 'uygogi', 'pohpouhuiop', 'iouhiuhiuh', 'piuiuhiu', 'iuhiuhiuh', 'ohhpuh', 'pohpohiu', 'iuhiouh', 'piuhpiuhipu', 'uhiuhihu', 2, 1, '1', '2', 10, 50, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.5, 0, 0, '2022-03-28 15:55:35'),
(21, '661289', '', 'k', 'lkj', 'ljk', 'ljk', 'jlk', 'ljk', 'ljk', 'ljk', 'ljk', 'lkj', 2, 2, '1', '2', 21, 21, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 21.31, 0, 1, '2022-03-28 16:00:35'),
(22, '311333', '', 'lkm', 'jmkih', 'fytu', 'iguuyt', 'dyd', 'yurdiuy', 't', 'tdytdythd', 'dy', 'poiughoi', 1, 1, '1', '1', 54, 56454, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 1, '2022-03-28 16:00:54'),
(23, '330284', '', 'opijoij', 'oijoijoijoij', 'jhbibiob', 'oihiughiguyhkllk', 'iobibibib', 'iuoiubibihboib', 'iobio', 'biu', 'bio', 'biou', 2, 1, '1', '1', 654, 65465, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4654, 0, 1, '2022-03-28 16:01:31'),
(24, '353530', '', 'poj', 'poij', 'poij', 'poij', 'poi', 'jpoij', 'oij', 'poij', 'pioj', 'poij', 2, 2, '1', '2', 4, 58, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, '2022-03-28 16:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0=Enregistré, 1=Envoyé, 2=Gars, 3=Domicile',
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcel_tracks`
--

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `status`, `user_id`, `date_created`) VALUES
(1, 1, 0, 1, '2022-03-27 00:57:51'),
(2, 2, 0, 3, '2022-03-27 01:05:16'),
(7, 2, 1, 1, '2022-03-28 15:43:42'),
(8, 3, 0, 1, '2022-03-28 15:43:55'),
(9, 4, 0, 1, '2022-03-28 15:45:38'),
(10, 5, 0, 1, '2022-03-28 15:46:56'),
(11, 6, 0, 1, '2022-03-28 15:47:21'),
(12, 6, 1, 1, '2022-03-28 15:47:28'),
(13, 5, 1, 1, '2022-03-28 15:47:32'),
(14, 4, 1, 1, '2022-03-28 15:47:35'),
(15, 6, 3, 1, '2022-03-28 15:47:41'),
(16, 4, 3, 1, '2022-03-28 15:47:45'),
(17, 5, 3, 1, '2022-03-28 15:47:52'),
(18, 2, 2, 1, '2022-03-28 15:47:59'),
(19, 3, 1, 1, '2022-03-28 15:48:07'),
(20, 3, 2, 1, '2022-03-28 15:48:11'),
(21, 7, 0, 1, '2022-03-28 15:48:34'),
(22, 8, 0, 1, '2022-03-28 15:48:50'),
(23, 9, 0, 1, '2022-03-28 15:49:10'),
(24, 10, 0, 1, '2022-03-28 15:49:30'),
(25, 11, 0, 1, '2022-03-28 15:50:07'),
(26, 0, 0, 1, '2022-03-28 15:50:21'),
(27, 12, 0, 1, '2022-03-28 15:50:36'),
(28, 0, 0, 1, '2022-03-28 15:50:58'),
(29, 13, 0, 1, '2022-03-28 15:51:17'),
(30, 14, 0, 1, '2022-03-28 15:51:44'),
(31, 15, 0, 1, '2022-03-28 15:52:11'),
(32, 16, 0, 1, '2022-03-28 15:52:26'),
(33, 17, 0, 1, '2022-03-28 15:53:31'),
(34, 18, 0, 1, '2022-03-28 15:54:19'),
(35, 19, 0, 1, '2022-03-28 15:55:06'),
(36, 20, 0, 1, '2022-03-28 15:55:35'),
(37, 21, 0, 1, '2022-03-28 16:00:35'),
(38, 22, 0, 1, '2022-03-28 16:00:54'),
(39, 23, 0, 1, '2022-03-28 16:01:31'),
(40, 24, 0, 1, '2022-03-28 16:01:47'),
(41, 24, 1, 1, '2022-03-28 16:03:00'),
(42, 23, 1, 1, '2022-03-28 16:03:03'),
(43, 22, 1, 1, '2022-03-28 16:03:06'),
(44, 21, 1, 1, '2022-03-28 16:03:09'),
(45, 20, 1, 1, '2022-03-28 16:03:12'),
(46, 19, 1, 1, '2022-03-28 16:03:16'),
(47, 17, 1, 1, '2022-03-28 16:03:22'),
(48, 16, 1, 1, '2022-03-28 16:03:26'),
(49, 15, 1, 1, '2022-03-28 16:03:29'),
(50, 13, 1, 1, '2022-03-28 16:03:32'),
(51, 21, 0, 3, '2022-03-28 16:04:15'),
(52, 20, 0, 3, '2022-03-28 16:04:18'),
(53, 17, 0, 3, '2022-03-28 16:04:21'),
(54, 24, 0, 1, '2022-03-30 18:42:26'),
(55, 24, 1, 1, '2022-03-30 18:50:44'),
(56, 24, 0, 2, '2022-03-30 18:51:32'),
(57, 24, 1, 2, '2022-03-30 18:54:31'),
(58, 24, 0, 1, '2022-03-30 18:55:26'),
(59, 24, 1, 1, '2022-03-30 18:55:49'),
(60, 24, 0, 1, '2022-03-30 18:56:04'),
(61, 24, 1, 1, '2022-03-30 18:56:11'),
(62, 24, 0, 1, '2022-03-30 18:56:19'),
(63, 24, 1, 1, '2022-03-30 18:57:10'),
(64, 24, 2, 1, '2022-03-30 18:57:15'),
(65, 21, 1, 1, '2022-03-30 20:33:53'),
(66, 0, 0, 1, '2022-03-31 22:09:41'),
(67, 24, 0, 1, '2022-03-31 22:10:54'),
(68, 24, 1, 1, '2022-04-03 00:18:26'),
(69, 24, 0, 3, '2022-04-04 21:24:00');

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
