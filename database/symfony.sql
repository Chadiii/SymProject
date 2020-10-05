-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 05 oct. 2020 à 15:14
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `nom`, `description`, `image`, `prix`) VALUES
(1, 'Tacos au Choix', 'Poulet et viande', 'https://img.cuisineaz.com/660x660/2019-04-17/i146583-tacos-poulet-curry.jpeg', 50),
(2, 'Pizza', 'Frite Inclus', 'https://img.cuisineaz.com/610x610/2013-12-20/i387-pizza-thon.jpeg', 80),
(4, 'Burger', 'Burger au fromage', 'https://img.cuisine-etudiant.fr/image/recette/800500/10b0e7ddb5aafb6ee194a80b1e97fa2d5283fdfe-burger-maison.jpg', 90);

-- --------------------------------------------------------

--
-- Structure de la table `menu_supplement`
--

CREATE TABLE `menu_supplement` (
  `menu_id` int(11) NOT NULL,
  `supplement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `menu_supplement`
--

INSERT INTO `menu_supplement` (`menu_id`, `supplement_id`) VALUES
(1, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(1, 3),
(4, 1),
(4, 2),
(4, 3),
(4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `supplement`
--

CREATE TABLE `supplement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `supplement`
--

INSERT INTO `supplement` (`id`, `nom`, `prix`) VALUES
(1, 'Frites', 5),
(2, 'Sauces au Choix', 3),
(3, 'Fromage', 3),
(4, 'Jambon', 6),
(6, 'Salade', 11);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `supplement`
--
ALTER TABLE `supplement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `supplement`
--
ALTER TABLE `supplement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
