-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 mai 2023 à 21:29
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `idClasse` int NOT NULL AUTO_INCREMENT,
  `profPrincipal` varchar(10) DEFAULT NULL,
  `anneeClasse` int DEFAULT NULL,
  `effectifClasse` int DEFAULT NULL,
  `nbHeuresTotal` int DEFAULT NULL,
  `libelleClasse` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idClasse`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`idClasse`, `profPrincipal`, `anneeClasse`, `effectifClasse`, `nbHeuresTotal`, `libelleClasse`) VALUES
(2, 'demede', 2020, 28, 25, 'SLAM');

-- --------------------------------------------------------

--
-- Structure de la table `comporter`
--

DROP TABLE IF EXISTS `comporter`;
CREATE TABLE IF NOT EXISTS `comporter` (
  `numEtudiant` int NOT NULL AUTO_INCREMENT,
  `idClasse` int NOT NULL,
  PRIMARY KEY (`numEtudiant`,`idClasse`),
  KEY `idClasse` (`idClasse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

DROP TABLE IF EXISTS `enseigner`;
CREATE TABLE IF NOT EXISTS `enseigner` (
  `numProfesseur` int NOT NULL AUTO_INCREMENT,
  `numMatiere` int NOT NULL,
  `idClasse` int NOT NULL,
  `nbHeuresEnseignées` int DEFAULT NULL,
  PRIMARY KEY (`numProfesseur`,`numMatiere`,`idClasse`),
  KEY `numMatiere` (`numMatiere`),
  KEY `idClasse` (`idClasse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `idEntreprise` int NOT NULL AUTO_INCREMENT,
  `nomEntreprise` varchar(20) DEFAULT NULL,
  `rueEntreprise` varchar(50) DEFAULT NULL,
  `cpEntreprise` int DEFAULT NULL,
  `villeEntreprise` varchar(20) DEFAULT NULL,
  `representantEntreprise` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `serviceEntreprise` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `telEntreprise` int DEFAULT NULL,
  `emailEntreprise` varchar(30) DEFAULT NULL,
  `secteurEntreprise` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `fonctionEntreprise` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`idEntreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`idEntreprise`, `nomEntreprise`, `rueEntreprise`, `cpEntreprise`, `villeEntreprise`, `representantEntreprise`, `serviceEntreprise`, `telEntreprise`, `emailEntreprise`, `secteurEntreprise`, `fonctionEntreprise`) VALUES
(8, 'energy by energy', 'jeanne d\'arc', 13009, 'marseille', 'antoine mendy', 'industrielle', 623232323, 'energy@gmail.com', 'btp', 'public');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `numEtudiant` int NOT NULL AUTO_INCREMENT,
  `nomEtudiant` varchar(25) DEFAULT NULL,
  `prenomEtudiant` varchar(25) DEFAULT NULL,
  `nombreStage` int DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `dateNaissance` varchar(40) DEFAULT NULL,
  `numTel` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `intituleFormation` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`numEtudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`numEtudiant`, `nomEtudiant`, `prenomEtudiant`, `nombreStage`, `adresse`, `dateNaissance`, `numTel`, `email`, `intituleFormation`) VALUES
(17, 'clement', 'vauclare', 2, '6 Allée *****', '10 novembre 2003', 'vauclareclement', '0623232323', 'SLAM'),
(18, 'billal', 'saidi', 2, '6 Allée *****', '24 janvier 2003', 'billal@gmail.co', '2213213', 'SLAM');

-- --------------------------------------------------------

--
-- Structure de la table `matière`
--

DROP TABLE IF EXISTS `matière`;
CREATE TABLE IF NOT EXISTS `matière` (
  `numMatiere` int NOT NULL AUTO_INCREMENT,
  `nomMatiere` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`numMatiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `Permission` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `email`, `mdp`, `Permission`) VALUES
(1, 'billal', 'zzere@gmail.com', 'gryryr', 0),
(2, 'a', 'a@gmail;com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 0);

-- --------------------------------------------------------

--
-- Structure de la table `paramètres`
--

DROP TABLE IF EXISTS `paramètres`;
CREATE TABLE IF NOT EXISTS `paramètres` (
  `numParam` int NOT NULL AUTO_INCREMENT,
  `nomEtablissement` varchar(30) DEFAULT NULL,
  `rueEtablissement` varchar(50) DEFAULT NULL,
  `cpEtablissement` int DEFAULT NULL,
  `villeEtablissement` varchar(20) DEFAULT NULL,
  `numEtablissement` int DEFAULT NULL,
  `faxEtablissement` varchar(30) DEFAULT NULL,
  `emailEtablissement` varchar(30) DEFAULT NULL,
  `chefEtablissement` varchar(15) DEFAULT NULL,
  `qualitéReprésentant` varchar(15) DEFAULT NULL,
  `domaine` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`numParam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `professeur_`
--

DROP TABLE IF EXISTS `professeur_`;
CREATE TABLE IF NOT EXISTS `professeur_` (
  `numProfesseur` int NOT NULL AUTO_INCREMENT,
  `nomProfesseur` varchar(25) DEFAULT NULL,
  `prenomProfesseur` varchar(10) DEFAULT NULL,
  `sexeProfesseur` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `suiviStage` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`numProfesseur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professeur_`
--

INSERT INTO `professeur_` (`numProfesseur`, `nomProfesseur`, `prenomProfesseur`, `sexeProfesseur`, `suiviStage`) VALUES
(3, 'demede', 'michel', 'Mr', 'oui'),
(4, 'tormento', 'sylvie', 'Mme', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `numStage` int NOT NULL AUTO_INCREMENT,
  `lieuStage` varchar(20) DEFAULT NULL,
  `joursEffectifs` int DEFAULT NULL,
  `typeStage` varchar(75) DEFAULT NULL,
  `sujetStage` varchar(75) DEFAULT NULL,
  `duréeStage` varchar(2) DEFAULT NULL,
  `débutStage_` date DEFAULT NULL,
  `finStage` date DEFAULT NULL,
  `presence` int DEFAULT NULL,
  `nomOutil` varchar(30) DEFAULT NULL,
  `utiliteOutil` varchar(50) DEFAULT NULL,
  `gratification` decimal(5,2) DEFAULT NULL,
  `idClasse` int NOT NULL,
  `numTuteur` int NOT NULL,
  `numProfesseur` int NOT NULL,
  `numEtudiant` int NOT NULL,
  PRIMARY KEY (`numStage`),
  KEY `idClasse` (`idClasse`),
  KEY `numTuteur` (`numTuteur`),
  KEY `numProfesseur` (`numProfesseur`),
  KEY `numEtudiant` (`numEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

DROP TABLE IF EXISTS `tuteur`;
CREATE TABLE IF NOT EXISTS `tuteur` (
  `numTuteur` int NOT NULL AUTO_INCREMENT,
  `nomTuteur` varchar(25) DEFAULT NULL,
  `prenom` varchar(10) DEFAULT NULL,
  `telTuteur` int DEFAULT NULL,
  `emailTuteur` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `idEntreprise` int DEFAULT NULL,
  PRIMARY KEY (`numTuteur`),
  KEY `idEntreprise` (`idEntreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tuteur`
--

INSERT INTO `tuteur` (`numTuteur`, `nomTuteur`, `prenom`, `telTuteur`, `emailTuteur`, `idEntreprise`) VALUES
(13, 'antoine', 'mendy', 623232323, 'energy@gmail.com', 8);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comporter`
--
ALTER TABLE `comporter`
  ADD CONSTRAINT `comporter_ibfk_1` FOREIGN KEY (`numEtudiant`) REFERENCES `etudiant` (`numEtudiant`),
  ADD CONSTRAINT `comporter_ibfk_2` FOREIGN KEY (`idClasse`) REFERENCES `classe` (`idClasse`);

--
-- Contraintes pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `enseigner_ibfk_1` FOREIGN KEY (`numProfesseur`) REFERENCES `professeur_` (`numProfesseur`),
  ADD CONSTRAINT `enseigner_ibfk_2` FOREIGN KEY (`numMatiere`) REFERENCES `matière` (`numMatiere`),
  ADD CONSTRAINT `enseigner_ibfk_3` FOREIGN KEY (`idClasse`) REFERENCES `classe` (`idClasse`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`idClasse`) REFERENCES `classe` (`idClasse`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`numTuteur`) REFERENCES `tuteur` (`numTuteur`),
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`numProfesseur`) REFERENCES `professeur_` (`numProfesseur`),
  ADD CONSTRAINT `stage_ibfk_4` FOREIGN KEY (`numEtudiant`) REFERENCES `etudiant` (`numEtudiant`);

--
-- Contraintes pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD CONSTRAINT `tuteur_ibfk_1` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`idEntreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
