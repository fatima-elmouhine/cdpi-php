-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 16 sep. 2024 à 11:01
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cdpi-sql`
--

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `brand_name`, `price`, `createdAt`) VALUES
(1, 'Toyota2', '100', '2024-09-16 11:13:12'),
(2, 'Skoda', '300', '2024-09-16 11:13:12'),
(3, 'Mercedes', '500', '2024-09-16 11:13:12'),
(4, 'Toyota', '399', '2024-09-16 11:13:12'),
(7, 'Suzuki', '1000', '2024-09-16 11:13:12'),
(8, 'Ford', '2122', '2024-09-16 11:13:12'),
(14, 'toto', '1000', '2024-09-16 11:13:41'),
(16, 'citroen', '2000', '2024-09-16 11:28:44');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Michelle', 'Durand', 'michelle.durand@gmail.com', 'toto'),
(2, 'Laura', 'Moriaux', 'laura.moriaux@gmail.com', 'toto');

-- --------------------------------------------------------

--
-- Structure de la table `user_car`
--

CREATE TABLE `user_car` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_car` int(11) NOT NULL,
  `owned_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_car`
--

INSERT INTO `user_car` (`id`, `id_user`, `id_car`, `owned_date`) VALUES
(1, 1, 3, '2024-09-11'),
(2, 1, 1, '2024-09-10'),
(3, 2, 1, '2024-09-10');

-- --------------------------------------------------------

--
-- Structure de la table `user_car_like`
--

CREATE TABLE `user_car_like` (
  `isLike` tinyint(1) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `id_car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_car_like`
--

INSERT INTO `user_car_like` (`isLike`, `id_user`, `id_car`) VALUES
(1, 2, 3);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `user_like`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `user_like` (
`firstname` varchar(255)
,`lastname` varchar(255)
,`brand_name` varchar(255)
,`price` decimal(10,0)
);

-- --------------------------------------------------------

--
-- Structure de la vue `user_like`
--
DROP TABLE IF EXISTS `user_like`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_like`  AS SELECT `user`.`firstname` AS `firstname`, `user`.`lastname` AS `lastname`, `car`.`brand_name` AS `brand_name`, `car`.`price` AS `price` FROM ((`user_car_like` join `car` on((`user_car_like`.`id_car` = `car`.`id`))) join `user` on((`user_car_like`.`id_user` = `user`.`id`)))  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `user_car`
--
ALTER TABLE `user_car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_car` (`id_car`);

--
-- Index pour la table `user_car_like`
--
ALTER TABLE `user_car_like`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_car` (`id_car`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_car`
--
ALTER TABLE `user_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user_car`
--
ALTER TABLE `user_car`
  ADD CONSTRAINT `user_car_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_car_ibfk_2` FOREIGN KEY (`id_car`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_car_like`
--
ALTER TABLE `user_car_like`
  ADD CONSTRAINT `user_car_like_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_car_like_ibfk_2` FOREIGN KEY (`id_car`) REFERENCES `car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
