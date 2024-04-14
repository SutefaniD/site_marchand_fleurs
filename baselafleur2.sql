-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 16 déc. 2023 à 12:12
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `baselafleur2`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_code` char(3) NOT NULL DEFAULT '',
  `cat_libelle` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cat_code`, `cat_libelle`) VALUES
('bul', 'Bulbes'),
('mas', 'Plantes '),
('ros', 'Rosiers');

-- --------------------------------------------------------

--
-- Structure de la table `clientconnu`
--

CREATE TABLE `clientconnu` (
  `clt_code` varchar(5) NOT NULL DEFAULT '',
  `clt_nom` varchar(30) NOT NULL DEFAULT '',
  `clt_adresse` varchar(50) NOT NULL DEFAULT '',
  `clt_tel` varchar(20) NOT NULL DEFAULT '',
  `clt_email` varchar(50) NOT NULL DEFAULT '',
  `clt_motPasse` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clientconnu`
--

INSERT INTO `clientconnu` (`clt_code`, `clt_nom`, `clt_adresse`, `clt_tel`, `clt_email`, `clt_motPasse`) VALUES
('c0001', 'Dupont', '12, rue haute 75001 Paris', '01 05 22 35 97', 'dupont@wanadoo.fr', 'aaa'),
('c0002', 'Dubois', '4, bld d\'Alsace 75002 Paris', '01 44 97 62 54', 'dubois@club-internet.fr', 'bbb'),
('c0003', 'Durand', '5, allée des Ifs 8000 Amiens', '03 22 79 64 56', 'durand@free.fr', 'ccc');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `cde_moment` varchar(20) NOT NULL DEFAULT '',
  `cde_client` varchar(5) NOT NULL DEFAULT '',
  `cde_date` varchar(10) NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`cde_moment`, `cde_client`, `cde_date`) VALUES
('1101461660', 'c0001', '2004-11-26'),
('1692011041', 'c0003', '2023-08-14'),
('1692011309', 'c0003', '2023-08-14'),
('1692014507', 'c0003', '2023-08-14');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `cde_moment` varchar(20) NOT NULL DEFAULT '',
  `cde_client` varchar(5) NOT NULL DEFAULT '',
  `produit` char(3) NOT NULL DEFAULT '',
  `quantite` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`cde_moment`, `cde_client`, `produit`, `quantite`) VALUES
('1101461660', 'c0001', 'b01', 1),
('1101461660', 'c0001', 'r03', 2),
('1692011041', 'c0003', 'b01', 1),
('1692011041', 'c0003', 'm02', 10),
('1692011041', 'c0003', 'r01', 1),
('1692011309', 'c0003', 'b01', 1),
('1692011309', 'c0003', 'm02', 10),
('1692011309', 'c0003', 'r01', 1),
('1692014507', 'c0003', 'm01', 7),
('1692014507', 'c0003', 'm02', 4);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `pdt_ref` char(3) NOT NULL DEFAULT '',
  `pdt_designation` varchar(50) NOT NULL DEFAULT '',
  `pdt_prix` decimal(5,2) NOT NULL DEFAULT '0.00',
  `pdt_image` varchar(50) NOT NULL DEFAULT '',
  `pdt_categorie` char(3) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`pdt_ref`, `pdt_designation`, `pdt_prix`, `pdt_image`, `pdt_categorie`) VALUES
('b01', '3 bulbes de bégonias', 5.00, 'bulbes_begonia', 'bul'),
('b02', '10 bulbes de dahlias', 12.00, 'bulbes_dahlia', 'bul'),
('b03', '50 glaïeuls', 9.00, 'bulbes_glaieul', 'bul'),
('m01', 'Lot de 3 marguerites', 5.00, 'massif_marguerite', 'mas'),
('m02', 'Pour un bouquet de 6 pensées', 6.00, 'massif_pensee', 'mas'),
('m03', 'Mélange varié de 10 plantes à massif', 15.00, 'massif_melange', 'mas'),
('r01', '1 pied spécial grandes fleurs', 20.00, 'rosiers_gdefleur', 'ros'),
('r02', 'Une variété sélectionnée pour son parfum', 9.00, 'rosiers_parfum', 'ros'),
('r03', 'Rosier arbuste', 8.00, 'rosiers_arbuste', 'ros');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_code`);

--
-- Index pour la table `clientconnu`
--
ALTER TABLE `clientconnu`
  ADD PRIMARY KEY (`clt_code`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`cde_moment`,`cde_client`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`cde_moment`,`cde_client`,`produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`pdt_ref`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
