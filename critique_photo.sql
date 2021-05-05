-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 mai 2021 à 09:53
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `critique_photo`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` varchar(50) NOT NULL,
  `create_at` date NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `id_user` int NOT NULL,
  `id_photo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_users_FK` (`id_user`),
  KEY `comments_photos0_FK` (`id_photo`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `create_at`, `visible`, `id_user`, `id_photo`) VALUES
(1, 'belle photo', '2021-05-04', 1, 1, 1),
(2, 'j\'aime cette photo', '2021-05-04', 1, 2, 1),
(17, 'c&#39;est ma photo', '0000-00-00', 1, 1, 13),
(18, 'Très belle photo', '0000-00-00', 1, 1, 2),
(19, 'Une très belle prise', '0000-00-00', 1, 1, 15),
(20, 'Je trouve cette photo très belle', '0000-00-00', 1, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_photo` varchar(50) NOT NULL,
  `name_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_at` date NOT NULL,
  `publication` tinyint(1) NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photos_users_FK` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id`, `title_photo`, `name_file`, `post_at`, `publication`, `id_user`) VALUES
(1, 'Ma première photo', 'photos/monimage.jpg', '2021-04-30', 1, 1),
(2, 'Ma deuxième photo', 'photos/monimage.jpg', '2021-05-01', 1, 1),
(3, 'Ma troisième photo', 'photos/monimage.jpg', '2021-05-01', 1, 1),
(5, 'Ma cinquième photo', 'photos/monimage.jpg', '2021-05-01', 1, 1),
(13, 'Bocar photo', 'photos/monimage.jpg', '0000-00-00', 0, 1),
(14, 'Bocar photo 2', 'photos/monimage.jpg', '0000-00-00', 0, 1),
(15, 'Spain Photo-by-Jose-Ramon-Irusta-600x328', 'photos/Photo-by-Jose-Ramon-Irusta-600x328.jpg', '0000-00-00', 0, 1),
(17, 'deuxième Photo de Toto', 'photos/Photo-by-Lars-Van-De-Goor-600x366-toto-2.jpg', '0000-00-00', 0, 4),
(18, 'troisième Photo de Toto', 'photos/Halnaker-England-Photo-by-Colin-Michaelis-toto-3.jpg', '0000-00-00', 0, 4),
(19, 'quatrième Photo de Toto', 'photos/Belgium-Photo-by-Raimund-Linke-600x341-toto-4.jpg', '0000-00-00', 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `roles` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `psw`, `pseudo`, `roles`) VALUES
(1, 'bgueye@gmail.com', '$2y$10$4XDjVCSPVgcj./.JbZKPr.XW5MdLQNEPjhvlI0.zwxg7O9IYHAAde', 'Boubacar', 'Admin'),
(2, 'azerty@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$RVRhZURUVWR0Q1lIRkRvVg$2aOgJy4HZf0yVthR5rXZ6TQSn4IeKM03XDXNhuN9QRo', 'bgueye', 'membre'),
(3, 'dupond@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TnlNL2pKd1IycXB6SjFPTg$oLPdfBKFnra8kHv84yhvxqc4GCl6ZDzo7UWmAZZg99U', 'Dupond', 'membre'),
(4, 'toto@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$akZ3WXVaSlp3eU05ejRidg$uRL/+lDopHA8h8DEg2IVI8B3VPif4zGbG5/HNo4G1EI', 'toto', 'membre');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_photos0_FK` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id`),
  ADD CONSTRAINT `comments_users_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_users_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
