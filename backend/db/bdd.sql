-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 18 fév. 2025 à 14:04
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
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `imprimante_id` (`imprimante_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `utilisateur_id`, `nom_commande`, `couleur`, `hauteur`, `longueur`, `largeur`, `fichier_stl`, `statut`, `date_creation`, `imprimante_id`, `duree`, `heure_debut`) VALUES
(1, 2, 'dino', 'Blanc', 100.00, 50.00, 50.00, '1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'terminé', '2025-02-18 00:40:02', 3, 2, '2025-02-18 10:11:01'),
(2, 2, 'dino', 'Jaune', 100.00, 50.00, 50.00, '1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 09:14:22', 2, 3, '2025-02-18 10:09:47'),
(3, 2, 'dino', 'Rose', 100.00, 50.00, 50.00, '1739874037_1739839202_hair_tie_osaur_-_no_supports_-_Dinosaur_body.stl', 'terminé', '2025-02-18 10:20:37', 4, 1, '2025-02-18 10:20:49'),
(4, 2, 'dino', 'Jaune', 100.00, 50.00, 50.00, '1739881720_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:28:40', 2, 2, '2025-02-18 12:28:50'),
(5, 2, 'dino', 'Violet', 100.00, 50.00, 50.00, '1739881887_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:31:27', 2, 2, '2025-02-18 12:31:35'),
(6, 2, 'dino', 'Rouge', 120.00, 60.00, 60.00, '1739883094_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:51:34', 2, 2, '2025-02-18 12:51:42'),
(7, 2, 'dino', 'Rouge', 120.00, 60.00, 60.00, '1739883247_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:54:07', 2, 2, '2025-02-18 12:54:13'),
(8, 2, 'dino', 'Rouge', 100.00, 50.00, 50.00, '1739883412_1739870062_hair_tie_osaur_-_container.stl', 'en cours', '2025-02-18 12:56:52', 3, 30, '2025-02-18 13:58:56'),
(9, 2, 'dino', 'Orange', 56.00, 30.00, 30.00, '1739883426_1739870062_hair_tie_osaur_-_container.stl', 'en cours', '2025-02-18 12:57:06', 2, 20, '2025-02-18 13:13:06'),
(10, 2, 'dino', 'Bleu', 150.00, 75.00, 75.00, '1739883441_1739870062_hair_tie_osaur_-_container.stl', 'terminé', '2025-02-18 12:57:21', 2, 10, '2025-02-18 13:00:49');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `imprimantes`
--

INSERT INTO `imprimantes` (`id`, `nom`, `type`, `photo`, `etat`) VALUES
(2, 'Saturn 3', 'résine', '1739835420_saturn3.png', 'en impression'),
(3, 'Jupiter SE', 'résine', '1739836016_jupiter-se.png', 'en impression'),
(4, 'Bambu Lab', 'filament', '1739836182_bambulab.png', 'libre');

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
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Admin FabLab', 'admin@fablab.com', '0600000000', 'admin', '$2y$10$Cj7g/bH7J6z9cX5V9sWWsO0zkN8O1HZ3I3GhM8F0zgT4NT8zKzOme', 'admin', '2025-02-17 14:56:54'),
(2, 'johan', 'johan.tichit@ynov.com', '0000000000', 'johan', '$2y$10$nS.w7UltL22w2vIFnTiJiOyTu5/WoE4Q9Srk5VRk1qZhKKrPC/k1y', 'admin', '2025-02-17 15:05:18'),
(3, 'johann', 'johan.tichit@exemple.fr', '1111111111', 'johann', '$2y$10$P07bq3WrAFqR/JTJhTSa6.Byw0qGnqm6w5dDB4J/1Whv63DP.s2si', 'user', '2025-02-17 15:11:16'),
(4, 'jiji', 'jiji.jiji@jiji.fr', '2222222222', '', '$2y$10$Cz2erqUCiItwblslhd7n/ew6cNkdRSJkDl643bUza/G6JUu3bWsUa', 'user', '2025-02-17 22:55:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;