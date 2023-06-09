-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 09 juin 2023 à 13:37
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `calendar`
--

-- --------------------------------------------------------

--
-- Structure de la table `accountactivate`
--

DROP TABLE IF EXISTS `accountactivate`;
CREATE TABLE IF NOT EXISTS `accountactivate` (
  `accountActivateId` int(11) NOT NULL AUTO_INCREMENT,
  `accountActivateEmail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountActivateSelector` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountActivateToken` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountActivateExpires` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`accountActivateId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminUsername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adminPassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `adminUsername`, `adminPassword`) VALUES
(1, 'admin', 'Rengret1!*');

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL,
  `temporary` tinyint(1) NOT NULL,
  `id_bookings` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `admin_locked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`id`, `day`, `temporary`, `id_bookings`, `id_room`, `admin_locked`) VALUES
(110, '2023-06-30', 1, 83, 11, 0),
(109, '2023-06-29', 1, 83, 11, 0),
(108, '2023-06-27', 1, 83, 11, 0),
(95, '2023-06-16', 1, 79, 7, 0),
(94, '2023-06-15', 1, 79, 7, 0),
(93, '2023-06-08', 1, 79, 7, 0),
(107, '2023-06-23', 1, 83, 11, 0),
(106, '2023-06-22', 1, 83, 11, 0),
(105, '2023-06-20', 1, 83, 11, 0);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `name`, `firstname`, `email`, `password`, `phone`, `business`, `siret`, `address`, `address_complement`, `city`, `postal_code`, `activated`, `country`, `creation_day`) VALUES
(20, 'Elias', 'Oumghar', 'eoumghar@gmail.com', '$2y$10$CQEdeIL.X.L945T2mLOiEuldV3UT8VVU4oP.T6hibkGEQMrW0hoM.', '0666648609', 'Cdo formation', '80140021300011', '4 Rue du couvent', '', 'MillanÃ§ay', '41200', 1, 'France', '2023-02-08 11:41:56'),
(30, 'Thupin', 'MÃ©lissandre', 'melissandrethupin@gmail.com', 'TEST', '0254960447', 'Kyuden Doji', '123456789123456789', 'Clan de la grue', NULL, 'Courmemin', '41160', 0, 'France', '2023-05-15 11:41:56'),
(31, 'Lincoln', 'Abraham', 'darknightdel@gmail.com', '$2y$10$x8pgAWq8stbeU.9pz0Z11u85Qqnis9uEVzJaMjc89uniE6iMyEcNa', '0630821884', 'LogAdmin', '12345678945678945', '15 rue de la madeleine', '', 'MillanÃ§ay', '41200', 1, 'France', '2023-06-01 12:20:58');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `days` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int(11) NOT NULL,
  `temporary` tinyint(1) NOT NULL,
  `id_room` int(11) NOT NULL,
  `admin_locked` tinyint(1) NOT NULL,
  `booking_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `id_client`, `number_of_days`, `days`, `reason`, `total_price`, `temporary`, `id_room`, `admin_locked`, `booking_day`) VALUES
(83, 20, 6, '2023-06-20,2023-06-22,2023-06-23,2023-06-27,2023-06-29,2023-06-30', 'Test rÃ©servation numÃ©ro 200', 240, 1, 11, 0, '2023-06-08 09:46:53');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_room` int(11) NOT NULL,
  `min` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id`, `id_room`, `min`) VALUES
(58, 11, 1),
(59, 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pwdresets`
--

DROP TABLE IF EXISTS `pwdresets`;
CREATE TABLE IF NOT EXISTS `pwdresets` (
  `pwdResetId` int(11) NOT NULL AUTO_INCREMENT,
  `pwdResetEmail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwdResetSelector` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwdResetToken` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwdResetExpires` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`pwdResetId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_complement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projector` tinyint(1) DEFAULT NULL,
  `wifi` tinyint(1) DEFAULT NULL,
  `coffee` tinyint(1) DEFAULT NULL,
  `water` tinyint(1) DEFAULT NULL,
  `paperboard` tinyint(1) DEFAULT NULL,
  `tv` tinyint(1) DEFAULT NULL,
  `toilets` tinyint(1) DEFAULT NULL,
  `parking` tinyint(1) DEFAULT NULL,
  `disabledAccess` tinyint(1) DEFAULT NULL,
  `airConditioning` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `capacity`, `seats`, `description`, `imagePath`, `price`, `location`, `size`, `address`, `address_complement`, `postal_code`, `city`, `projector`, `wifi`, `coffee`, `water`, `paperboard`, `tv`, `toilets`, `parking`, `disabledAccess`, `airConditioning`) VALUES
(11, 'Parafit', 40, 10, 'claquÃ© mais Ã§a marche', '../images', 40, 'MillanÃ§ay', 400, '2 rue de la victoire', '', 41200, 'MillanÃ§ay', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 'Randomisateur', 505, 300, 'Une salle gigantesque aux proportions exag&eacute;r&eacute;e pour soutenir la Macronie', 'nique', 1000, 'Paname prÃ¨s des riches', 3400, '3 rue des Perdus', '', 78400, 'Bourges', 1, 0, 0, 1, 0, 0, 1, 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
