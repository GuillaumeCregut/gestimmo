-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 25 Juin 2018 à 00:23
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `laurent`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Acheteur`(IN `el` INT(11), IN `tb` INT(11), IN `fv` INT(11), IN `tel` VARCHAR(10), IN `mail` VARCHAR(150), IN `nom` VARCHAR(100), IN `prenom` VARCHAR(100), IN `p_min` INT(11), IN `p_max` INT(11), IN `s_min` INT(11), IN `s_max` INT(11), IN `ad` VARCHAR(500), IN `dist` INT(11))
    MODIFIES SQL DATA
insert into acheteur (fk_etat_lieux,fk_type_bien,fk_ville,tel,mail,nom,prenom,prix_mini,prix_maxi,surf_mini,surf_maxi,adresse,dist_max)
VALUES(el,tb,fv,tel,mail,nom,prenom,p_min,p_max,s_min,s_max,ad,dist)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

CREATE TABLE IF NOT EXISTS `acheteur` (
  `pk_acheteur` int(11) NOT NULL AUTO_INCREMENT,
  `fk_etat_lieux` int(11) NOT NULL,
  `fk_type_bien` int(11) NOT NULL,
  `fk_ville` int(11) NOT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `prix_mini` int(11) NOT NULL,
  `prix_maxi` int(11) NOT NULL,
  `surf_mini` int(11) NOT NULL,
  `surf_maxi` int(11) NOT NULL,
  `adresse` varchar(500) DEFAULT NULL,
  `dist_max` int(11) NOT NULL,
  PRIMARY KEY (`pk_acheteur`),
  UNIQUE KEY `fk_ville` (`fk_ville`),
  KEY `fk_etat_lieux` (`fk_etat_lieux`,`fk_type_bien`,`fk_ville`),
  KEY `fk_type_bien` (`fk_type_bien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `acheteur`
--

INSERT INTO `acheteur` (`pk_acheteur`, `fk_etat_lieux`, `fk_type_bien`, `fk_ville`, `tel`, `mail`, `nom`, `prenom`, `prix_mini`, `prix_maxi`, `surf_mini`, `surf_maxi`, `adresse`, `dist_max`) VALUES
(2, 1, 2, 1, '0686973228', 'gcregut@free.fr', 'Crégut', 'Guillaume', 150000, 300000, 90, 120, '9 route de Juscors St Regle', 10);

-- --------------------------------------------------------

--
-- Structure de la table `etat_bien`
--

CREATE TABLE IF NOT EXISTS `etat_bien` (
  `id_etat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `etat_bien`
--

INSERT INTO `etat_bien` (`id_etat`, `nom_etat`) VALUES
(1, 'Neuf'),
(2, '10-30 ans'),
(3, '30 - 50 ans'),
(4, 'plus de 50 ans');

-- --------------------------------------------------------

--
-- Structure de la table `type_bien`
--

CREATE TABLE IF NOT EXISTS `type_bien` (
  `pk_bien` int(11) NOT NULL AUTO_INCREMENT,
  `nom_bien` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_bien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_bien`
--

INSERT INTO `type_bien` (`pk_bien`, `nom_bien`) VALUES
(1, 'Terrain'),
(2, 'Maison'),
(3, 'Appartement');

-- --------------------------------------------------------

--
-- Structure de la table `t_ville`
--

CREATE TABLE IF NOT EXISTS `t_ville` (
  `pk_ville` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_ville`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `t_ville`
--

INSERT INTO `t_ville` (`pk_ville`, `nom_ville`) VALUES
(1, 'Amboise'),
(2, 'Bléré'),
(3, 'Chissay'),
(4, 'St Ouen les vignes'),
(5, 'Chissaux');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_acheteur`
--
CREATE TABLE IF NOT EXISTS `vue_acheteur` (
`nom` varchar(100)
,`prenom` varchar(100)
,`tel` varchar(10)
,`mail` varchar(150)
,`adresse` varchar(500)
,`dist_max` int(11)
,`prix_mini` int(11)
,`prix_maxi` int(11)
,`surf_mini` int(11)
,`surf_maxi` int(11)
,`nom_etat` varchar(50)
,`nom_bien` varchar(50)
,`nom_ville` varchar(100)
);
-- --------------------------------------------------------

--
-- Structure de la vue `vue_acheteur`
--
DROP TABLE IF EXISTS `vue_acheteur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_acheteur` AS select `ac`.`nom` AS `nom`,`ac`.`prenom` AS `prenom`,`ac`.`tel` AS `tel`,`ac`.`mail` AS `mail`,`ac`.`adresse` AS `adresse`,`ac`.`dist_max` AS `dist_max`,`ac`.`prix_mini` AS `prix_mini`,`ac`.`prix_maxi` AS `prix_maxi`,`ac`.`surf_mini` AS `surf_mini`,`ac`.`surf_maxi` AS `surf_maxi`,`eb`.`nom_etat` AS `nom_etat`,`tb`.`nom_bien` AS `nom_bien`,`tv`.`nom_ville` AS `nom_ville` from (((`acheteur` `ac` join `etat_bien` `eb` on((`ac`.`fk_etat_lieux` = `eb`.`id_etat`))) join `type_bien` `tb` on((`ac`.`fk_type_bien` = `tb`.`pk_bien`))) join `t_ville` `tv` on((`ac`.`fk_ville` = `tv`.`pk_ville`)));

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD CONSTRAINT `fk_etat_acheteur` FOREIGN KEY (`fk_etat_lieux`) REFERENCES `etat_bien` (`id_etat`),
  ADD CONSTRAINT `fk_type_acheteur` FOREIGN KEY (`fk_type_bien`) REFERENCES `type_bien` (`pk_bien`),
  ADD CONSTRAINT `fk_ville_acheteur` FOREIGN KEY (`fk_ville`) REFERENCES `t_ville` (`pk_ville`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
