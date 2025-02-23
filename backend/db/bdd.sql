-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 23 fév. 2025 à 19:54
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fablab_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int NOT NULL,
  `nom_commande` varchar(100) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `hauteur` decimal(6,2) NOT NULL,
  `longueur` decimal(6,2) NOT NULL,
  `largeur` decimal(6,2) NOT NULL,
  `fichier_stl` varchar(255) NOT NULL,
  `statut` enum('en attente','en cours','terminé') DEFAULT 'en attente',
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `imprimante_id` int DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `heure_debut` timestamp NULL DEFAULT NULL,
  `notification_envoyee` tinyint(1) DEFAULT '0',
  `type_impression` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `imprimante_id` (`imprimante_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `utilisateur_id`, `nom_commande`, `couleur`, `hauteur`, `longueur`, `largeur`, `fichier_stl`, `statut`, `date_creation`, `imprimante_id`, `duree`, `heure_debut`, `notification_envoyee`, `type_impression`) VALUES
(1, 2, 'dino', 'Blanc', 100.00, 50.00, 50.00, '1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'terminé', '2025-02-18 00:40:02', 3, 2, '2025-02-18 10:11:01', 0, ''),
(2, 2, 'dino', 'Jaune', 100.00, 50.00, 50.00, '1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 09:14:22', 2, 3, '2025-02-18 10:09:47', 0, ''),
(3, 2, 'dino', 'Rose', 100.00, 50.00, 50.00, '1739874037_1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'terminé', '2025-02-18 10:20:37', 4, 1, '2025-02-18 10:20:49', 0, ''),
(4, 2, 'dino', 'Jaune', 100.00, 50.00, 50.00, '1739881720_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:28:40', 2, 2, '2025-02-18 12:28:50', 0, ''),
(5, 2, 'dino', 'Violet', 100.00, 50.00, 50.00, '1739881887_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:31:27', 2, 2, '2025-02-18 12:31:35', 0, ''),
(6, 2, 'dino', 'Rouge', 120.00, 60.00, 60.00, '1739883094_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:51:34', 2, 2, '2025-02-18 12:51:42', 0, ''),
(7, 2, 'dino', 'Rouge', 120.00, 60.00, 60.00, '1739883247_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:54:07', 2, 2, '2025-02-18 12:54:13', 0, ''),
(8, 2, 'dino', 'Rouge', 100.00, 50.00, 50.00, '1739883412_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:56:52', 3, 30, '2025-02-18 13:58:56', 0, ''),
(9, 2, 'dino', 'Orange', 56.00, 30.00, 30.00, '1739883426_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:57:06', 2, 20, '2025-02-18 13:13:06', 0, ''),
(10, 2, 'dino', 'Bleu', 150.00, 75.00, 75.00, '1739883441_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:57:21', 2, 10, '2025-02-18 13:00:49', 0, ''),
(11, 2, 'dino', 'Blanc', 150.00, 75.00, 75.00, '1739889126_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 14:32:06', 2, 30, '2025-02-18 14:32:14', 0, ''),
(12, 3, 'dino 4', 'Rouge', 100.00, 50.00, 50.00, '1739959377_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-19 10:02:57', NULL, NULL, NULL, 0, ''),
(13, 3, 'dino 5', 'Rouge', 100.00, 50.00, 50.00, '1739960176_1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'terminé', '2025-02-19 10:16:16', 2, 30, '2025-02-19 10:33:58', 0, ''),
(14, 5, 'dino 6', 'Rouge', 100.00, 50.00, 50.00, '1739972944_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-19 13:49:04', 2, 60, '2025-02-19 13:50:43', 1, ''),
(15, 5, 'dino 7', 'Rouge', 100.00, 50.00, 50.00, '1739973085_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-19 13:51:25', 2, 60, '2025-02-19 14:51:59', 1, ''),
(16, 5, 'dino 8', 'Rouge', 100.00, 50.00, 50.00, '1739979116_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-19 15:31:56', 3, 1, '2025-02-19 15:32:13', 1, ''),
(27, 2, 'dino 14', 'Rouge', 100.00, 50.00, 50.00, '1740046089_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-20 10:08:09', 2, 5, '2025-02-20 10:13:57', 0, ''),
(26, 5, 'dino 13', 'Rouge', 100.00, 50.00, 50.00, '1740045920_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-20 10:05:20', 2, 1, '2025-02-20 10:20:13', 1, ''),
(25, 5, 'dino 12', 'Rouge', 100.00, 50.00, 50.00, '1740045906_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-20 10:05:06', 2, 20, '2025-02-20 14:32:42', 1, ''),
(24, 5, 'dino 11', 'Rouge', 100.00, 50.00, 50.00, '1740045895_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-20 10:04:55', 3, 1, '2025-02-21 12:59:19', 0, ''),
(28, 2, 'hdghh', 'Rouge', 100.00, 50.00, 50.00, '1740098302_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-21 00:38:22', 3, 3, '2025-02-21 00:45:12', 0, ''),
(29, 2, 'jhgfcvbn,jhg', 'Rouge', 100.00, 50.00, 50.00, '1740098318_1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'terminé', '2025-02-21 00:38:38', 2, 3, '2025-02-21 00:45:00', 0, ''),
(30, 2, 'dino 17', 'Rouge', 100.00, 50.00, 50.00, '1740142640_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-21 12:57:20', 2, 60, '2025-02-21 12:58:24', 0, ''),
(31, 5, 'dino 19', 'Rouge', 100.00, 50.00, 50.00, '1740143067_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-21 13:04:27', 4, 1, '2025-02-21 13:04:44', 0, ''),
(32, 5, 'dino20', 'Rouge', 100.00, 50.00, 50.00, '1740151074_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-21 15:17:54', 3, 1, '2025-02-21 15:18:58', 0, ''),
(33, 2, 'dino 21', 'Rouge', 100.00, 50.00, 50.00, '1740177437_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-21 22:37:17', 2, 2, '2025-02-21 22:37:46', 0, ''),
(39, 2, 'dino 26', 'Rouge', 100.00, 50.00, 50.00, '1740217281_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-22 09:41:21', 4, 1, '2025-02-22 09:42:32', 0, 'filament'),
(38, 2, 'dino 28', 'Rouge', 100.00, 50.00, 50.00, '1740216543_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 09:29:03', NULL, NULL, NULL, 0, 'résine'),
(40, 2, 'dino 28', 'Rouge', 100.00, 50.00, 50.00, '1740217856_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 09:50:56', NULL, NULL, NULL, 0, 'résine'),
(41, 5, 'dino 31', 'Jaune', 200.00, 100.00, 100.00, '1740245981_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 17:39:41', NULL, NULL, NULL, 0, 'filament'),
(42, 2, 'dino 28', 'Rouge', 100.00, 50.00, 50.00, '1740246168_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 17:42:48', NULL, NULL, NULL, 0, 'résine'),
(43, 5, 'dino 56', 'Rouge', 100.00, 50.00, 50.00, '1740246541_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 17:49:01', NULL, NULL, NULL, 0, 'résine'),
(44, 2, 'dino 100', 'Rouge', 100.00, 50.00, 50.00, '1740247790_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-22 18:09:50', 3, 2, '2025-02-22 23:26:03', 0, 'résine'),
(45, 5, 'dino 101', 'Rouge', 100.00, 50.00, 50.00, '1740247889_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:11:29', NULL, NULL, NULL, 0, 'résine'),
(46, 2, 'dino 102', 'Rouge', 100.00, 50.00, 50.00, '1740248018_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:13:38', NULL, NULL, NULL, 0, 'résine'),
(47, 2, 'dino 103', 'Rouge', 100.00, 50.00, 50.00, '1740248093_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:14:53', NULL, NULL, NULL, 0, 'résine'),
(48, 2, 'dino 104', 'Rouge', 100.00, 50.00, 50.00, '1740248122_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:15:22', NULL, NULL, NULL, 0, 'résine'),
(49, 2, 'dino 105', 'Rouge', 100.00, 50.00, 50.00, '1740248539_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:22:19', NULL, NULL, NULL, 0, 'résine'),
(50, 2, 'dino 106', 'Rouge', 100.00, 50.00, 50.00, '1740248749_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:25:49', NULL, NULL, NULL, 0, 'résine'),
(51, 2, 'dino 156', 'Rouge', 50.00, 100.00, 50.00, '1740248948_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:29:08', NULL, NULL, NULL, 0, 'résine'),
(52, 2, 'dino 250', 'Rouge', 100.00, 50.00, 50.00, '1740249204_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:33:24', NULL, NULL, NULL, 0, 'résine'),
(53, 2, 'dino 251', 'Rouge', 100.00, 50.00, 50.00, '1740249261_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:34:21', NULL, NULL, NULL, 0, ''),
(54, 2, 'dino 251', 'Rouge', 100.00, 50.00, 50.00, '1740249419_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:36:59', NULL, NULL, NULL, 0, ''),
(55, 2, 'dino 253', 'Rouge', 1.00, 1.00, 1.00, '1740249441_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:37:21', NULL, NULL, NULL, 0, ''),
(56, 2, 'dino 255', 'Rouge', 1.00, 1.00, 1.00, '1740249535_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:38:55', NULL, NULL, NULL, 0, ''),
(57, 2, 'dino 256', 'Rouge', 1.00, 1.00, 1.00, '1740249914_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 18:45:14', NULL, NULL, NULL, 0, ''),
(58, 2, 'dino 258', 'Rouge', 1.00, 1.00, 1.00, '1740252634_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 19:30:34', NULL, NULL, NULL, 0, ''),
(59, 2, 'dino 259', 'Rouge', 1.00, 1.00, 1.00, '1740253090_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 19:38:10', NULL, NULL, NULL, 0, ''),
(60, 2, 'dino 260', 'Rouge', 1.00, 1.00, 1.00, '1740253261_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 19:41:01', NULL, NULL, NULL, 0, ''),
(61, 2, 'dino 262', 'Rouge', 1.00, 1.00, 1.00, '1740253524_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 19:45:24', NULL, NULL, NULL, 0, ''),
(62, 2, 'dino 2555', 'Rouge', 25.00, 252.00, 25.00, '1740262066_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 22:07:46', NULL, NULL, NULL, 0, ''),
(63, 5, 'dino 333', 'Rouge', 1.00, 1.00, 1.00, '1740266822_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 23:27:02', NULL, NULL, NULL, 0, ''),
(64, 5, 'dino 2555', 'Rouge', 2.00, 2.00, 2.00, '1740267150_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-22 23:32:30', NULL, NULL, NULL, 0, 'résine'),
(65, 5, 'dino 2554', 'Rouge', 1.00, 1.00, 1.00, '1740268194_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-22 23:49:55', 3, 1, '2025-02-22 23:50:35', 0, 'résine'),
(66, 5, 'dino 2514', 'Rouge', 1.00, 1.00, 1.00, '1740271418_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-23 00:43:38', NULL, NULL, NULL, 0, 'résine'),
(67, 5, 'dino 2578', 'Rouge', 1.00, 1.00, 1.00, '1740271958_1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'en attente', '2025-02-23 00:52:38', NULL, NULL, NULL, 0, 'résine'),
(68, 5, 'dino 2525', 'Rouge', 2.00, 2.00, 2.00, '1740273187_1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'terminé', '2025-02-23 01:13:07', 2, 1, '2025-02-23 01:13:50', 0, 'résine'),
(69, 5, '5625862', 'Rouge', 2562.00, 215.00, 145.00, '1740273790_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-23 01:23:10', NULL, NULL, NULL, 0, 'résine'),
(70, 2, 'dino 2558', 'Rouge', 1.00, 1.00, 1.00, '1740323845_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-23 15:17:25', NULL, NULL, NULL, 0, 'résine'),
(71, 2, 'dino 2669', 'Rouge', 5.00, 5.00, 5.00, '1740326204_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-23 15:56:44', NULL, NULL, NULL, 0, 'résine'),
(72, 2, 'dino 5668', 'Rouge', 6.00, 6.00, 6.00, '1740326230_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-23 15:57:10', NULL, NULL, NULL, 0, 'résine'),
(73, 2, 'dino 25588', 'Rouge', 4.00, 4.00, 4.00, '1740327347_1739870062_hair_tie_osaur_-_container.stl', 'en attente', '2025-02-23 16:15:47', NULL, NULL, NULL, 0, 'résine'),
(74, 2, 'dino 252525', 'Rouge', 56.00, 56.00, 56.00, '1740329867_1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'en attente', '2025-02-23 16:57:47', NULL, NULL, NULL, 0, 'résine');

-- --------------------------------------------------------

--
-- Structure de la table `imprimantes`
--

DROP TABLE IF EXISTS `imprimantes`;
CREATE TABLE IF NOT EXISTS `imprimantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `type` enum('résine','filament') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `etat` enum('libre','en impression','maintenance') DEFAULT 'libre',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `imprimantes`
--

INSERT INTO `imprimantes` (`id`, `nom`, `type`, `photo`, `etat`) VALUES
(2, 'Saturn 3', 'résine', '1739835420_saturn3.png', 'libre'),
(3, 'Jupiter SE', 'résine', '1739836016_jupiter-se.png', 'libre'),
(4, 'Bambu Lab', 'filament', '1739836182_bambulab.png', 'libre');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `status`, `created_at`) VALUES
(1, 1, 'Nouvelle commande : dino 30 de ', '', '2025-02-22 17:39:41'),
(2, 1, 'Nouvelle commande : dino 28 de ', '', '2025-02-22 17:42:48'),
(3, 1, 'Nouvelle commande : dino 56 de ', '', '2025-02-22 17:49:01'),
(4, 1, 'Nouvelle commande : dino 100 de ', '', '2025-02-22 18:09:50'),
(5, 1, 'Nouvelle commande : dino 101 de ', '', '2025-02-22 18:11:29'),
(6, 1, 'Nouvelle commande : dino 102 de ', '', '2025-02-22 18:13:38'),
(7, 1, 'Nouvelle commande : dino 103 de ', '', '2025-02-22 18:14:53'),
(8, 1, 'Nouvelle commande : dino 104 de ', '', '2025-02-22 18:15:22'),
(9, 1, 'Nouvelle commande : dino 105 de ', '', '2025-02-22 18:22:19'),
(10, 1, 'Nouvelle commande : dino 106 de ', '', '2025-02-22 18:25:49'),
(11, 1, 'Nouvelle commande : dino 156 de ', '', '2025-02-22 18:29:08'),
(12, 1, 'Nouvelle commande : dino 255 de 2', '', '2025-02-22 18:38:55'),
(13, 2, 'Nouvelle commande : dino 255 de 2', '', '2025-02-22 18:38:55'),
(14, 4, 'Nouvelle commande : dino 255 de 2', '', '2025-02-22 18:38:55'),
(15, 1, 'Nouvelle commande : dino 256 de 2', '', '2025-02-22 18:45:14'),
(16, 2, 'Nouvelle commande : dino 256 de 2', '', '2025-02-22 18:45:14'),
(17, 4, 'Nouvelle commande : dino 256 de 2', 'read', '2025-02-22 18:45:14'),
(18, 1, 'Nouvelle commande : dino 258 de ', '', '2025-02-22 19:30:34'),
(20, 4, 'Nouvelle commande : dino 258 de ', 'read', '2025-02-22 19:30:34'),
(21, 1, 'Nouvelle commande : dino 259 de 2', 'read', '2025-02-22 19:38:10'),
(75, 1, 'Nouvelle commande : dino 25588 de johan', 'unread', '2025-02-23 16:15:47'),
(23, 4, 'Nouvelle commande : dino 259 de 2', 'read', '2025-02-22 19:38:10'),
(24, 1, 'Nouvelle commande : dino 260 de 2', 'unread', '2025-02-22 19:41:01'),
(26, 4, 'Nouvelle commande : dino 260 de 2', 'unread', '2025-02-22 19:41:01'),
(27, 1, 'Nouvelle commande : dino 262 de 2', 'unread', '2025-02-22 19:45:24'),
(74, 4, 'Nouvelle commande : dino 5668 de johan', 'unread', '2025-02-23 15:57:10'),
(29, 4, 'Nouvelle commande : dino 262 de 2', 'unread', '2025-02-22 19:45:24'),
(30, 1, 'Nouvelle commande : dino 2555 de 2', 'unread', '2025-02-22 22:07:46'),
(32, 4, 'Nouvelle commande : dino 2555 de 2', 'unread', '2025-02-22 22:07:46'),
(33, 1, 'Nouvelle commande : dino 333 de 5', 'unread', '2025-02-22 23:27:02'),
(73, 2, 'Nouvelle commande : dino 5668 de johan', 'read', '2025-02-23 15:57:10'),
(35, 4, 'Nouvelle commande : dino 333 de 5', 'unread', '2025-02-22 23:27:02'),
(36, 1, 'Nouvelle commande : dino 2555 de 5', 'unread', '2025-02-22 23:32:30'),
(38, 4, 'Nouvelle commande : dino 2555 de 5', 'unread', '2025-02-22 23:32:30'),
(39, 1, 'Nouvelle commande : dino 2554 de 5', 'unread', '2025-02-22 23:49:55'),
(72, 1, 'Nouvelle commande : dino 5668 de johan', 'unread', '2025-02-23 15:57:10'),
(41, 4, 'Nouvelle commande : dino 2554 de 5', 'unread', '2025-02-22 23:49:55'),
(42, 1, 'Nouvelle commande : dino 2514 de 5', 'unread', '2025-02-23 00:43:38'),
(44, 4, 'Nouvelle commande : dino 2514 de 5', 'unread', '2025-02-23 00:43:38'),
(45, 1, 'Nouvelle commande : dino 2578 de 5', 'unread', '2025-02-23 00:52:38'),
(71, 4, 'Nouvelle commande : dino 2669 de johan', 'unread', '2025-02-23 15:56:44'),
(47, 4, 'Nouvelle commande : dino 2578 de 5', 'unread', '2025-02-23 00:52:38'),
(48, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:06:33'),
(49, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:07:03'),
(50, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:07:33'),
(51, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:08:04'),
(52, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:08:35'),
(53, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:09:06'),
(54, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:09:37'),
(55, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:10:08'),
(56, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:11:06'),
(57, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:11:37'),
(58, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:12:07'),
(59, NULL, 'Votre commande \'\' a été terminée.', 'unread', '2025-02-23 01:12:37'),
(60, 1, 'Nouvelle commande : dino 2525 de 5', 'unread', '2025-02-23 01:13:07'),
(62, 4, 'Nouvelle commande : dino 2525 de 5', 'unread', '2025-02-23 01:13:07'),
(63, 1, 'Nouvelle commande : 5625862 de 5', 'unread', '2025-02-23 01:23:10'),
(70, 2, 'Nouvelle commande : dino 2669 de johan', 'read', '2025-02-23 15:56:44'),
(65, 4, 'Nouvelle commande : 5625862 de 5', 'unread', '2025-02-23 01:23:10'),
(66, 1, 'Nouvelle commande : dino 2558 de johan', 'unread', '2025-02-23 15:17:25'),
(69, 1, 'Nouvelle commande : dino 2669 de johan', 'unread', '2025-02-23 15:56:44'),
(68, 4, 'Nouvelle commande : dino 2558 de johan', 'unread', '2025-02-23 15:17:25'),
(76, 2, 'Nouvelle commande : dino 25588 de johan', 'read', '2025-02-23 16:15:47'),
(77, 4, 'Nouvelle commande : dino 25588 de johan', 'unread', '2025-02-23 16:15:47'),
(78, 1, 'Nouvelle commande : dino 252525 de johan', 'unread', '2025-02-23 16:57:47'),
(79, 2, 'Nouvelle commande : dino 252525 de johan', 'read', '2025-02-23 16:57:47'),
(80, 4, 'Nouvelle commande : dino 252525 de johan', 'unread', '2025-02-23 16:57:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'Admin FabLab', 'admin@fablab.com', '0600000000', '$2y$10$Cj7g/bH7J6z9cX5V9sWWsO0zkN8O1HZ3I3GhM8F0zgT4NT8zKzOme', 'admin', '2025-02-17 14:56:54'),
(2, 'johan', 'johan.tichit@ynov.com', '0000000000', '$2y$10$nS.w7UltL22w2vIFnTiJiOyTu5/WoE4Q9Srk5VRk1qZhKKrPC/k1y', 'admin', '2025-02-17 15:05:18'),
(4, 'jiji', 'jiji.jiji@jiji.fr', '2222222222', '$2y$10$Cz2erqUCiItwblslhd7n/ew6cNkdRSJkDl643bUza/G6JUu3bWsUa', 'admin', '2025-02-17 22:55:38'),
(5, 'paul', 'paul@exemple.fr', '1425367895', '$2y$10$VUdtZyPTgJGd5BG5CWqcNOW/nOWq00jX0qR4ZFnBEPP0Jm31noIe2', 'user', '2025-02-19 13:06:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;