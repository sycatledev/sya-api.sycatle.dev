-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 12 fév. 2023 à 16:46
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sycatle_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_nickname` varchar(32) NOT NULL,
  `user_firstname` varchar(64) NOT NULL,
  `user_lastname` varchar(64) NOT NULL,
  `user_mail` varchar(64) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_gender` tinyint(4) NOT NULL DEFAULT '0',
  `user_password` varchar(64) NOT NULL,
  `user_city` varchar(64) NOT NULL,
  `user_joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_lastseen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_ip_adresses` varchar(1024) NOT NULL DEFAULT '{}'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users table';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nickname`, `user_firstname`, `user_lastname`, `user_mail`, `user_birthdate`, `user_gender`, `user_password`, `user_city`, `user_joindate`, `user_lastseen`, `user_ip_adresses`) VALUES
(1, 'Sycatle', 'Charlie', 'Dallier-Wood', 'sycatle@pm.me', '2003-07-03', 1, '$2y$10$d0COgcLA3LtRsrV/S/3YduBSRc9FL7NlduVZRnThPy9WPXjyeFz9u', 'Le Mans', '2023-02-12 08:26:13', '2023-02-12 08:26:13', '{}');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_nickname`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
