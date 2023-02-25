-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 fév. 2023 à 14:55
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stationmeteo`
--

-- --------------------------------------------------------

--
-- Structure de la table `capteurs`
--

CREATE TABLE `capteurs` (
  `Id_Donnees` int(11) NOT NULL,
  `NomCapteur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `donnees`
--

CREATE TABLE `donnees` (
  `Id_Donnees` int(11) NOT NULL,
  `Temperature` decimal(5,2) DEFAULT NULL,
  `Humidite` decimal(4,2) DEFAULT NULL,
  `Pression` decimal(6,2) DEFAULT NULL,
  `DateDonnee` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `meteos`
--

CREATE TABLE `meteos` (
  `Id_Meteos` int(11) NOT NULL,
  `TypeMeteo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ows`
--

CREATE TABLE `ows` (
  `Id_Donnees` int(11) NOT NULL,
  `Ville` varchar(100) DEFAULT NULL,
  `Id_Meteos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `capteurs`
--
ALTER TABLE `capteurs`
  ADD PRIMARY KEY (`Id_Donnees`);

--
-- Index pour la table `donnees`
--
ALTER TABLE `donnees`
  ADD PRIMARY KEY (`Id_Donnees`);

--
-- Index pour la table `meteos`
--
ALTER TABLE `meteos`
  ADD PRIMARY KEY (`Id_Meteos`);

--
-- Index pour la table `ows`
--
ALTER TABLE `ows`
  ADD PRIMARY KEY (`Id_Donnees`),
  ADD KEY `Id_Meteos` (`Id_Meteos`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `donnees`
--
ALTER TABLE `donnees`
  MODIFY `Id_Donnees` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `meteos`
--
ALTER TABLE `meteos`
  MODIFY `Id_Meteos` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capteurs`
--
ALTER TABLE `capteurs`
  ADD CONSTRAINT `capteurs_ibfk_1` FOREIGN KEY (`Id_Donnees`) REFERENCES `donnees` (`Id_Donnees`);

--
-- Contraintes pour la table `ows`
--
ALTER TABLE `ows`
  ADD CONSTRAINT `ows_ibfk_1` FOREIGN KEY (`Id_Donnees`) REFERENCES `donnees` (`Id_Donnees`),
  ADD CONSTRAINT `ows_ibfk_2` FOREIGN KEY (`Id_Meteos`) REFERENCES `meteos` (`Id_Meteos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
