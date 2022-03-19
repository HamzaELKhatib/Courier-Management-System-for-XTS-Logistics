SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


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

INSERT INTO `branches` (`id`, `branch_code`, `street`, `city`, `state`, `zip_code`, `country`, `contact`, `date_created`) VALUES
(9, 'BbGfn6KJM1D23qT', '16 avenue el hajeb, Lotissement Attar, Mhannech 2', 'Tétouan', 'Tanger-Tétouan-Al Hoceima', 93000, 'Maroc', '+212 639493900', '2022-03-17 22:28:07'),
(10, '4ZJNjbIlxaiBK7R', 'tanger', 'tanger', 'tanger', 10000, 'Maroc', '0000', '2022-03-17 22:28:36'),
(11, 'AzrZo7vJQRjGneB', 'Rabat', 'Rabat', 'Rabat', 10000, 'Maroc', '0000', '2022-03-17 22:28:56'),
(12, 'dlLmf5W1eki9yvS', 'Casablanca', 'Casablanca', 'Casablanca', 10000, 'Maroc', '0000', '2022-03-17 22:29:15');

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

INSERT INTO `parcels` (`id`, `br_dec`, `expedition_number`, `sender_name`, `sender_id`, `sender_city`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_cin`, `recipient_city`, `recipient_address`, `recipient_contact`, `type`, `type_expedition`, `from_branch_id`, `to_branch_id`, `weight`, `number`, `taxateur`, `code_ramasseur`, `type_retour_de_fond`, `price_retour_de_fond`, `price_retour_bl`, `transport`, `manutention`, `declared_value`, `ramassage`, `delivery`, `avis`, `enregistrement`, `autre_frais`, `price`, `paid_price`, `status`, `date_created`) VALUES
(11, '657503', '', 'D', 'D1', 'D3', 'D2', '0000', 'C', 'C1', 'C3', 'C2', '1111', 2, 2, '9', '10', 10, 22, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.5, 0, 6, '2022-03-17 22:31:46'),
(12, '382486', '', 'D', 'D1', 'D3', 'D2', '0000', 'C', 'C1', 'C3', 'C2', '1111', 2, 2, '9', '10', 11, 2, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1.7, 0, 0, '2022-03-17 22:31:46'),
(13, '658043', '', 'N', 'N1', 'N3', 'N2', '2222', 'n', 'n1', 'n3', 'n2', '3333', 2, 1, '9', '10', 1, 2, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 8, '2022-03-17 22:33:17'),
(14, '117187', '', 'S', 'S1', 'S3', 'S2', '4444', 's', 's1', 's3', 's2', '5555', 1, 1, '10', '', 20, 4, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 50.2, 0, 5, '2022-03-17 22:36:10'),
(15, '397535', '', 'S', 'S1', 'S3', 'S2', '4444', 's', 's1', 's3', 's2', '5555', 1, 1, '10', '', 40, 1, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10.4, 0, 3, '2022-03-17 22:36:10'),
(16, '533980', '', 'y', 'y', 'y', 'y', '8888', 'y', 'y', 'y', 'y', '8888', 2, 1, '10', '9', 10, 2, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 50, 0, 7, '2022-03-17 22:42:34');

CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `status`, `user_id`, `date_created`) VALUES
(11, 14, 5, 1, '2022-03-17 22:36:23'),
(12, 15, 3, 1, '2022-03-17 22:36:30'),
(13, 11, 6, 1, '2022-03-17 22:36:37'),
(14, 13, 8, 1, '2022-03-17 22:36:49'),
(15, 16, 3, 1, '2022-03-17 22:42:49'),
(16, 16, 6, 1, '2022-03-19 16:08:08'),
(17, 16, 5, 1, '2022-03-19 16:14:04'),
(18, 16, 7, 8, '2022-03-19 16:14:33');

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

INSERT INTO `users` (`id`, `firstname`, `lastname`, `cin`, `email`, `password`, `type`, `branch_id`, `date_created`) VALUES
(1, 'Admin', 'A', '', 'admin@a.a', '$2y$10$.Ef6aowpbDuYYSB7Se141.J7/mHRUdgn.SZnaW1nqkdeypSH6.9dC', 1, 0, '2022-02-26 10:57:04'),
(8, 'Hamza', 'El Khatib', '', 'a@a.a', '$2y$10$P5D7GJ1JFu7mrZhKVDgZzuLY45nR3T/CfKSoVEM37HBjGHgvDoAYO', 2, 9, '2022-03-17 22:30:07'),
(9, 'Hamid', 'K', '', 'u@u.u', '$2y$10$cXtResCn8LEQA37VVDg1h..wyYcDg7bHxI5bavGSPiLBBhpxMYsY2', 2, 10, '2022-03-17 22:30:35');


ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `parcel_tracks`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `branches`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `parcels`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

