
SET time_zone = "+00:00";




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



CREATE TABLE `parcels` (
  `id` int(30) NOT NULL,
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



CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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




ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `parcel_tracks`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `branches`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `parcels`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


