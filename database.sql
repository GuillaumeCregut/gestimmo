-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 22 jan. 2022 à 21:02
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laurent`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `pk_acheteur` int NOT NULL AUTO_INCREMENT,
  `fk_etat_lieux` int NOT NULL,
  `fk_type_bien` int NOT NULL,
  `fk_ville` int NOT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `tel2` varchar(10) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `prix_mini` int NOT NULL,
  `prix_maxi` int NOT NULL,
  `surf_mini` int NOT NULL,
  `surf_maxi` int NOT NULL,
  `adresse` varchar(500) DEFAULT NULL,
  `dist_max` int NOT NULL,
  `Surf_Hab_min` int NOT NULL DEFAULT '0',
  `Surf_Hab_Max` int NOT NULL DEFAULT '0',
  `Nbre_Pieces` int NOT NULL DEFAULT '0',
  `servit` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pk_acheteur`),
  KEY `fk_etat_lieux` (`fk_etat_lieux`,`fk_type_bien`,`fk_ville`),
  KEY `fk_type_bien` (`fk_type_bien`),
  KEY `fk_ville` (`fk_ville`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etat_bien`
--

DROP TABLE IF EXISTS `etat_bien`;
CREATE TABLE IF NOT EXISTS `etat_bien` (
  `id_etat` int NOT NULL AUTO_INCREMENT,
  `nom_etat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat_bien`
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

DROP TABLE IF EXISTS `type_bien`;
CREATE TABLE IF NOT EXISTS `type_bien` (
  `pk_bien` int NOT NULL AUTO_INCREMENT,
  `nom_bien` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_bien`
--

INSERT INTO `type_bien` (`pk_bien`, `nom_bien`) VALUES
(1, 'Terrain'),
(2, 'Maison'),
(3, 'Appartement');

-- --------------------------------------------------------

--
-- Structure de la table `t_bien`
--

DROP TABLE IF EXISTS `t_bien`;
CREATE TABLE IF NOT EXISTS `t_bien` (
  `id_bien` int NOT NULL AUTO_INCREMENT,
  `prix` int NOT NULL,
  `commission` int NOT NULL,
  `fk_vendeur` int NOT NULL,
  `fk_Etat` int NOT NULL,
  `fk_type` int NOT NULL,
  `surface_terrain` int NOT NULL,
  `fk_ville` int NOT NULL,
  `surface_habitable` int NOT NULL,
  `Nbre_pieces` int NOT NULL,
  `Adresse` varchar(200) DEFAULT NULL,
  `vendue` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_bien`),
  KEY `idx_vendeur` (`fk_vendeur`),
  KEY `idx_ville` (`fk_ville`),
  KEY `idx_Etat` (`fk_Etat`),
  KEY `idx_type` (`fk_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_distance_villes`
--

DROP TABLE IF EXISTS `t_distance_villes`;
CREATE TABLE IF NOT EXISTS `t_distance_villes` (
  `id_ligne` int NOT NULL AUTO_INCREMENT,
  `fk_ville1` int NOT NULL,
  `fk_ville2` int NOT NULL,
  `distance` int NOT NULL,
  PRIMARY KEY (`id_ligne`),
  KEY `idx_fk_ville1` (`fk_ville1`),
  KEY `idx_fk_ville2` (`fk_ville2`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_vente`
--

DROP TABLE IF EXISTS `t_vente`;
CREATE TABLE IF NOT EXISTS `t_vente` (
  `pk_vente` int NOT NULL AUTO_INCREMENT,
  `fk_bien` int NOT NULL,
  `fk_acheteur` int NOT NULL,
  `prix` int NOT NULL,
  `commission` int NOT NULL,
  `date_vente` date NOT NULL,
  PRIMARY KEY (`pk_vente`),
  KEY `fk_bien` (`fk_bien`,`fk_acheteur`),
  KEY `idx_achteur_vente` (`fk_acheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_ville`
--

DROP TABLE IF EXISTS `t_ville`;
CREATE TABLE IF NOT EXISTS `t_ville` (
  `pk_ville` int NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_ville`),
  UNIQUE KEY `nom_ville` (`nom_ville`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_visite`
--

DROP TABLE IF EXISTS `t_visite`;
CREATE TABLE IF NOT EXISTS `t_visite` (
  `pk_visite` int NOT NULL AUTO_INCREMENT,
  `fk_client` int NOT NULL,
  `fk_bien` int NOT NULL,
  `date_visite` date NOT NULL,
  `comm` varchar(500) NOT NULL,
  PRIMARY KEY (`pk_visite`),
  KEY `fk_client` (`fk_client`,`fk_bien`),
  KEY `idx_visite_bien` (`fk_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `pk_vendeur` int NOT NULL AUTO_INCREMENT,
  `tel` varchar(10) DEFAULT NULL,
  `tel2` varchar(10) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`pk_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_acheteur`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_acheteur`;
CREATE TABLE IF NOT EXISTS `vue_acheteur` (
`nom` varchar(100)
,`prenom` varchar(100)
,`tel` varchar(10)
,`tel2` varchar(10)
,`mail` varchar(150)
,`adresse` varchar(500)
,`dist_max` int
,`prix_mini` int
,`prix_maxi` int
,`surf_mini` int
,`surf_maxi` int
,`nom_etat` varchar(50)
,`nom_bien` varchar(50)
,`nom_ville` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_acheteur_sans_contact`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_acheteur_sans_contact`;
CREATE TABLE IF NOT EXISTS `vue_acheteur_sans_contact` (
`pk_acheteur` int
,`nom` varchar(100)
,`prenom` varchar(100)
,`dist_max` int
,`Nbre_Pieces` int
,`prix_mini` int
,`prix_maxi` int
,`Surf_Hab_Max` int
,`Surf_Hab_min` int
,`surf_maxi` int
,`surf_mini` int
,`tel` varchar(10)
,`tel2` varchar(10)
,`mail` varchar(150)
,`nom_etat` varchar(50)
,`nom_bien` varchar(50)
,`nom_ville` varchar(100)
,`servit` tinyint(1)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_biens_multicriteres`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_biens_multicriteres`;
CREATE TABLE IF NOT EXISTS `vue_biens_multicriteres` (
`id_bien` int
,`prix` int
,`fk_Etat` int
,`fk_type` int
,`surface_terrain` int
,`fk_ville` int
,`surface_habitable` int
,`Nbre_pieces` int
,`commission` int
,`nom` varchar(100)
,`prenom` varchar(100)
,`nom_ville` varchar(100)
,`nom_bien` varchar(50)
,`nom_etat` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_bien_a_vendre`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_bien_a_vendre`;
CREATE TABLE IF NOT EXISTS `vue_bien_a_vendre` (
`id_bien` int
,`fk_vendeur` int
,`prix` int
,`surface_habitable` int
,`surface_terrain` int
,`Nbre_pieces` int
,`Adresse` varchar(200)
,`nom_ville` varchar(100)
,`commission` int
,`nom_etat` varchar(50)
,`nom_bien` varchar(50)
,`nom` varchar(100)
,`prenom` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_bien_full`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_bien_full`;
CREATE TABLE IF NOT EXISTS `vue_bien_full` (
`id_bien` int
,`prix` int
,`surface_habitable` int
,`surface_terrain` int
,`Nbre_pieces` int
,`Adresse` varchar(200)
,`nom_ville` varchar(100)
,`commission` int
,`nom_etat` varchar(50)
,`nom_bien` varchar(50)
,`pk_vendeur` int
,`nom` varchar(100)
,`prenom` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_distances_villes`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_distances_villes`;
CREATE TABLE IF NOT EXISTS `vue_distances_villes` (
`id_ligne` int
,`fk_ville1` int
,`fk_ville2` int
,`distance` int
,`nom_ville1` varchar(100)
,`nomville2` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_visite`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_visite`;
CREATE TABLE IF NOT EXISTS `vue_visite` (
`pk_visite` int
,`fk_client` int
,`fk_bien` int
,`date_visite` date
,`comm` varchar(500)
,`adresse` varchar(200)
,`prix` int
,`commission` int
,`nom` varchar(100)
,`prenom` varchar(100)
,`nom_etat` varchar(50)
,`nom_ville` varchar(100)
,`nom_bien` varchar(50)
,`ven_nom` varchar(100)
,`ven_prenom` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_acheteur`
--
DROP TABLE IF EXISTS `vue_acheteur`;

DROP VIEW IF EXISTS `vue_acheteur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_acheteur`  AS  select `ac`.`nom` AS `nom`,`ac`.`prenom` AS `prenom`,`ac`.`tel` AS `tel`,`ac`.`tel2` AS `tel2`,`ac`.`mail` AS `mail`,`ac`.`adresse` AS `adresse`,`ac`.`dist_max` AS `dist_max`,`ac`.`prix_mini` AS `prix_mini`,`ac`.`prix_maxi` AS `prix_maxi`,`ac`.`surf_mini` AS `surf_mini`,`ac`.`surf_maxi` AS `surf_maxi`,`eb`.`nom_etat` AS `nom_etat`,`tb`.`nom_bien` AS `nom_bien`,`tv`.`nom_ville` AS `nom_ville` from (((`acheteur` `ac` join `etat_bien` `eb` on((`ac`.`fk_etat_lieux` = `eb`.`id_etat`))) join `type_bien` `tb` on((`ac`.`fk_type_bien` = `tb`.`pk_bien`))) join `t_ville` `tv` on((`ac`.`fk_ville` = `tv`.`pk_ville`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_acheteur_sans_contact`
--
DROP TABLE IF EXISTS `vue_acheteur_sans_contact`;

DROP VIEW IF EXISTS `vue_acheteur_sans_contact`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_acheteur_sans_contact`  AS  select `t_a`.`pk_acheteur` AS `pk_acheteur`,`t_a`.`nom` AS `nom`,`t_a`.`prenom` AS `prenom`,`t_a`.`dist_max` AS `dist_max`,`t_a`.`Nbre_Pieces` AS `Nbre_Pieces`,`t_a`.`prix_mini` AS `prix_mini`,`t_a`.`prix_maxi` AS `prix_maxi`,`t_a`.`Surf_Hab_Max` AS `Surf_Hab_Max`,`t_a`.`Surf_Hab_min` AS `Surf_Hab_min`,`t_a`.`surf_maxi` AS `surf_maxi`,`t_a`.`surf_mini` AS `surf_mini`,`t_a`.`tel` AS `tel`,`t_a`.`tel2` AS `tel2`,`t_a`.`mail` AS `mail`,`e_b`.`nom_etat` AS `nom_etat`,`t_b`.`nom_bien` AS `nom_bien`,`t_v`.`nom_ville` AS `nom_ville`,`t_a`.`servit` AS `servit` from (((`acheteur` `t_a` join `etat_bien` `e_b` on((`t_a`.`fk_etat_lieux` = `e_b`.`id_etat`))) join `type_bien` `t_b` on((`t_a`.`fk_type_bien` = `t_b`.`pk_bien`))) join `t_ville` `t_v` on((`t_a`.`fk_ville` = `t_v`.`pk_ville`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_biens_multicriteres`
--
DROP TABLE IF EXISTS `vue_biens_multicriteres`;

DROP VIEW IF EXISTS `vue_biens_multicriteres`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_biens_multicriteres`  AS  select `tb`.`id_bien` AS `id_bien`,`tb`.`prix` AS `prix`,`tb`.`fk_Etat` AS `fk_Etat`,`tb`.`fk_type` AS `fk_type`,`tb`.`surface_terrain` AS `surface_terrain`,`tb`.`fk_ville` AS `fk_ville`,`tb`.`surface_habitable` AS `surface_habitable`,`tb`.`Nbre_pieces` AS `Nbre_pieces`,`tb`.`commission` AS `commission`,`tv`.`nom` AS `nom`,`tv`.`prenom` AS `prenom`,`tville`.`nom_ville` AS `nom_ville`,`tbien`.`nom_bien` AS `nom_bien`,`te`.`nom_etat` AS `nom_etat` from ((((`t_bien` `tb` join `vendeur` `tv` on((`tv`.`pk_vendeur` = `tb`.`fk_vendeur`))) join `t_ville` `tville` on((`tville`.`pk_ville` = `tb`.`fk_ville`))) join `type_bien` `tbien` on((`tbien`.`pk_bien` = `tb`.`fk_type`))) join `etat_bien` `te` on((`tb`.`fk_Etat` = `te`.`id_etat`))) where (`tb`.`vendue` = 0) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_bien_a_vendre`
--
DROP TABLE IF EXISTS `vue_bien_a_vendre`;

DROP VIEW IF EXISTS `vue_bien_a_vendre`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_bien_a_vendre`  AS  select `t_b`.`id_bien` AS `id_bien`,`t_b`.`fk_vendeur` AS `fk_vendeur`,`t_b`.`prix` AS `prix`,`t_b`.`surface_habitable` AS `surface_habitable`,`t_b`.`surface_terrain` AS `surface_terrain`,`t_b`.`Nbre_pieces` AS `Nbre_pieces`,`t_b`.`Adresse` AS `Adresse`,`t_vi`.`nom_ville` AS `nom_ville`,`t_b`.`commission` AS `commission`,`t_e`.`nom_etat` AS `nom_etat`,`t_t`.`nom_bien` AS `nom_bien`,`t_ve`.`nom` AS `nom`,`t_ve`.`prenom` AS `prenom` from ((((`t_bien` `t_b` join `t_ville` `t_vi` on((`t_b`.`fk_ville` = `t_vi`.`pk_ville`))) join `vendeur` `t_ve` on((`t_b`.`fk_vendeur` = `t_ve`.`pk_vendeur`))) join `type_bien` `t_t` on((`t_b`.`fk_type` = `t_t`.`pk_bien`))) join `etat_bien` `t_e` on((`t_b`.`fk_Etat` = `t_e`.`id_etat`))) where (`t_b`.`vendue` = 0) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_bien_full`
--
DROP TABLE IF EXISTS `vue_bien_full`;

DROP VIEW IF EXISTS `vue_bien_full`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_bien_full`  AS  select `t_b`.`id_bien` AS `id_bien`,`t_b`.`prix` AS `prix`,`t_b`.`surface_habitable` AS `surface_habitable`,`t_b`.`surface_terrain` AS `surface_terrain`,`t_b`.`Nbre_pieces` AS `Nbre_pieces`,`t_b`.`Adresse` AS `Adresse`,`t_vi`.`nom_ville` AS `nom_ville`,`t_b`.`commission` AS `commission`,`t_e`.`nom_etat` AS `nom_etat`,`t_t`.`nom_bien` AS `nom_bien`,`t_ve`.`pk_vendeur` AS `pk_vendeur`,`t_ve`.`nom` AS `nom`,`t_ve`.`prenom` AS `prenom` from ((((`t_bien` `t_b` join `t_ville` `t_vi` on((`t_b`.`fk_ville` = `t_vi`.`pk_ville`))) join `vendeur` `t_ve` on((`t_b`.`fk_vendeur` = `t_ve`.`pk_vendeur`))) join `type_bien` `t_t` on((`t_b`.`fk_type` = `t_t`.`pk_bien`))) join `etat_bien` `t_e` on((`t_b`.`fk_Etat` = `t_e`.`id_etat`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_distances_villes`
--
DROP TABLE IF EXISTS `vue_distances_villes`;

DROP VIEW IF EXISTS `vue_distances_villes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_distances_villes`  AS  select `td`.`id_ligne` AS `id_ligne`,`td`.`fk_ville1` AS `fk_ville1`,`td`.`fk_ville2` AS `fk_ville2`,`td`.`distance` AS `distance`,`tv`.`nom_ville` AS `nom_ville1`,`tv2`.`nom_ville` AS `nomville2` from ((`t_distance_villes` `td` join `t_ville` `tv` on((`td`.`fk_ville1` = `tv`.`pk_ville`))) join `t_ville` `tv2` on((`td`.`fk_ville2` = `tv2`.`pk_ville`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_visite`
--
DROP TABLE IF EXISTS `vue_visite`;

DROP VIEW IF EXISTS `vue_visite`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_visite`  AS  select `t_vis`.`pk_visite` AS `pk_visite`,`t_vis`.`fk_client` AS `fk_client`,`t_vis`.`fk_bien` AS `fk_bien`,`t_vis`.`date_visite` AS `date_visite`,`t_vis`.`comm` AS `comm`,`tb`.`Adresse` AS `adresse`,`tb`.`prix` AS `prix`,`tb`.`commission` AS `commission`,`t_a`.`nom` AS `nom`,`t_a`.`prenom` AS `prenom`,`t_e`.`nom_etat` AS `nom_etat`,`t_ville`.`nom_ville` AS `nom_ville`,`t_t`.`nom_bien` AS `nom_bien`,`t_ven`.`nom` AS `ven_nom`,`t_ven`.`prenom` AS `ven_prenom` from ((((((`t_visite` `t_vis` join `acheteur` `t_a` on((`t_vis`.`fk_client` = `t_a`.`pk_acheteur`))) join `t_bien` `tb` on((`t_vis`.`fk_bien` = `tb`.`id_bien`))) join `etat_bien` `t_e` on((`tb`.`fk_Etat` = `t_e`.`id_etat`))) join `t_ville` on((`tb`.`fk_ville` = `t_ville`.`pk_ville`))) join `type_bien` `t_t` on((`tb`.`fk_type` = `t_t`.`pk_bien`))) join `vendeur` `t_ven` on((`tb`.`fk_vendeur` = `t_ven`.`pk_vendeur`))) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD CONSTRAINT `fk_etat_acheteur` FOREIGN KEY (`fk_etat_lieux`) REFERENCES `etat_bien` (`id_etat`),
  ADD CONSTRAINT `fk_type_acheteur` FOREIGN KEY (`fk_type_bien`) REFERENCES `type_bien` (`pk_bien`),
  ADD CONSTRAINT `fk_ville_acheteur` FOREIGN KEY (`fk_ville`) REFERENCES `t_ville` (`pk_ville`);

--
-- Contraintes pour la table `t_bien`
--
ALTER TABLE `t_bien`
  ADD CONSTRAINT `fk_bien_vendeur` FOREIGN KEY (`fk_vendeur`) REFERENCES `vendeur` (`pk_vendeur`),
  ADD CONSTRAINT `fk_bien_ville` FOREIGN KEY (`fk_ville`) REFERENCES `t_ville` (`pk_ville`),
  ADD CONSTRAINT `t_bien_ibfk_1` FOREIGN KEY (`fk_Etat`) REFERENCES `etat_bien` (`id_etat`),
  ADD CONSTRAINT `t_bien_ibfk_2` FOREIGN KEY (`fk_type`) REFERENCES `type_bien` (`pk_bien`);

--
-- Contraintes pour la table `t_distance_villes`
--
ALTER TABLE `t_distance_villes`
  ADD CONSTRAINT `fk_distance_ville1` FOREIGN KEY (`fk_ville1`) REFERENCES `t_ville` (`pk_ville`),
  ADD CONSTRAINT `fk_distance_ville2` FOREIGN KEY (`fk_ville2`) REFERENCES `t_ville` (`pk_ville`);

--
-- Contraintes pour la table `t_vente`
--
ALTER TABLE `t_vente`
  ADD CONSTRAINT `c_acheteur_vente` FOREIGN KEY (`fk_acheteur`) REFERENCES `acheteur` (`pk_acheteur`),
  ADD CONSTRAINT `c_bien_vente` FOREIGN KEY (`fk_bien`) REFERENCES `t_bien` (`id_bien`);

--
-- Contraintes pour la table `t_visite`
--
ALTER TABLE `t_visite`
  ADD CONSTRAINT `fk_visite_ach` FOREIGN KEY (`fk_client`) REFERENCES `acheteur` (`pk_acheteur`),
  ADD CONSTRAINT `fk_visite_bien` FOREIGN KEY (`fk_bien`) REFERENCES `t_bien` (`id_bien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
