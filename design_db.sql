-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 fév. 2023 à 17:36
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
-- Base de données : `design_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `user`, `mdp`) VALUES
(1, 'user', '$argon2i$v=19$m=1024,t=2,p=2$Um5lTWphOU96R1JDTi80Qw$XkWND/iex4mqIvu+sOh42Ip5DPbEkG0QBkgOHBSYVYs');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `nomLogo` varchar(255) NOT NULL,
  `logoUser` varchar(255) DEFAULT NULL,
  `idSecteur` int(11) NOT NULL,
  `idStyleLogo` int(11) NOT NULL,
  `idCouleur` varchar(100) NOT NULL,
  `couleurCustom` varchar(10) DEFAULT NULL,
  `idStyle` varchar(100) NOT NULL,
  `idForfait` int(11) NOT NULL,
  `idEtat` int(11) NOT NULL,
  `logoFinal` varchar(255) NOT NULL,
  PRIMARY KEY (`numero`,`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`numero`, `idUser`, `nomLogo`, `logoUser`, `idSecteur`, `idStyleLogo`, `idCouleur`, `couleurCustom`, `idStyle`, `idForfait`, `idEtat`, `logoFinal`) VALUES
(33, 3, 'Dimitry', NULL, 8, 9, '4/5/', NULL, '9/10/11/16/15/', 3, 3, 'oculus.webp'),
(26, 1, 'Bleu ciel', 'Yuzu_Emulator.svg.png', 8, 6, '5/on/', '#ff7b00', '10/11/', 4, 3, 'w7.png'),
(35, 1, 'Bleu ciel', NULL, 9, 6, '5/', NULL, '11/', 3, 3, 'Yuzu_Emulator.svg.png');

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `codeHexa` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `libelle`, `codeHexa`) VALUES
(2, 'Rouge', '#d70909'),
(4, 'Vert', '#33cc14'),
(5, 'Bleu ciel', '#26bde3');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
(1, 'En attente'),
(2, 'En cours de traitement'),
(3, 'Terminé');

-- --------------------------------------------------------

--
-- Structure de la table `forfait`
--

DROP TABLE IF EXISTS `forfait`;
CREATE TABLE IF NOT EXISTS `forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `prix` float NOT NULL,
  `nbUtilisation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `forfait`
--

INSERT INTO `forfait` (`id`, `libelle`, `description`, `prix`, `nbUtilisation`) VALUES
(1, 'Bronze', '- Avantage 1\r\n- Avantage 2\r\n- Avantage 3', 34.99, 12),
(3, 'Argent', '- Avantage 1\r\n- Avantage 2\r\n- Avantage 3\r\n- Avantage 4\r\n- Avantage 5', 44.99, 37),
(4, 'Or', '- Avantage 1 \r\n- Avantage 2 \r\n- Avantage 3 \r\n- Avantage 4 \r\n- Avantage 5 \r\n- Avantage 6 \r\n- Avantage 7', 99.99, 10);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numCommande` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `numCommande`, `idUser`) VALUES
(74, 35, 1),
(55, 33, 3),
(57, 26, 3),
(64, 26, 1);

-- --------------------------------------------------------

--
-- Structure de la table `limite`
--

DROP TABLE IF EXISTS `limite`;
CREATE TABLE IF NOT EXISTS `limite` (
  `limCouleur` int(11) NOT NULL,
  `limStyle` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `limite`
--

INSERT INTO `limite` (`limCouleur`, `limStyle`) VALUES
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `secteuract`
--

DROP TABLE IF EXISTS `secteuract`;
CREATE TABLE IF NOT EXISTS `secteuract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `secteuract`
--

INSERT INTO `secteuract` (`id`, `libelle`, `description`) VALUES
(10, 'Loisir', 'Lorem ipsum dolor sit amet, co'),
(9, 'Alimentaire', 'Desc-Alimentaire'),
(8, 'Informatique', 'Desc-Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

DROP TABLE IF EXISTS `style`;
CREATE TABLE IF NOT EXISTS `style` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `nbUtilisation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `style`
--

INSERT INTO `style` (`id`, `libelle`, `img`, `nbUtilisation`) VALUES
(12, 'Fire lion', 'Best-Logo-Makers-for-Custom-Logos-FREE-to-Use-image31.png', 40),
(9, 'C-MOON', 'moon.png', 11),
(10, 'Lorem Ipsum', 'flat.webp', 7),
(11, 'Target', 'images.png', 18),
(13, 'dribble', 'free_logos_dribbble_ph.webp', 26),
(16, 'Red snake', 'snake-on-circle-5523ld.png', 29),
(15, 'FF7', 'il_570xN.1818738761_1659.webp', 17);

-- --------------------------------------------------------

--
-- Structure de la table `stylelogo`
--

DROP TABLE IF EXISTS `stylelogo`;
CREATE TABLE IF NOT EXISTS `stylelogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `nbUtilisation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stylelogo`
--

INSERT INTO `stylelogo` (`id`, `libelle`, `description`, `img`, `nbUtilisation`) VALUES
(8, 'Urban', 's', '15-151145_picture-freeuse-library-and-current-logos-mhs-panther.png', 5),
(6, 'Modene', 'battle.net', '2.webp', 17),
(9, 'RÃ©tro', '', 'SeekPng.com_genji-sword-png_1714017.png', 8);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mdp` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `numTel` varchar(255) DEFAULT NULL,
  `adrRue` varchar(255) NOT NULL,
  `ville` varchar(60) NOT NULL,
  `codePostal` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mdp`, `nom`, `prenom`, `username`, `mail`, `numTel`, `adrRue`, `ville`, `codePostal`) VALUES
(1, '$argon2i$v=19$m=1024,t=2,p=2$ektNdksuZXViT3hIWHI5Sw$yWvrBX6GZEQ8r18w7ZBgmIWjoyszbMMgQjeDhdms/PU', 'LAU-TAI', 'Dimitry', 'SuperDimi', 'dimitry9790@gmail.com', '08000', 'NULL', 'NULL', 'NULL'),
(3, '$argon2i$v=19$m=1024,t=2,p=2$bXJQUlFvUEdUckxOcG1IOA$EHnzhTdvT0bvD67z6UAFZ1yhbvqcA66hkoeYqwFg5vY', 'Ipsum', 'Lorem', 'dimi', 'dimitry9790@gmail.com', '08000', '8 rue des rue', 'st-clotilde', '97490');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
