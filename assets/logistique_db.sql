-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table logistique_db. lq_articles
CREATE TABLE IF NOT EXISTS `lq_articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(250) NOT NULL,
  `prix_unitaire` varchar(100) NOT NULL,
  `prix_achat` varchar(100) DEFAULT NULL,
  `devise` varchar(20) NOT NULL,
  `qte_initial` varchar(100) NOT NULL,
  `qte_actuelle` varchar(100) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `image_article` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` varchar(12) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_articles : ~2 rows (environ)
/*!40000 ALTER TABLE `lq_articles` DISABLE KEYS */;
INSERT INTO `lq_articles` (`id_article`, `designation`, `prix_unitaire`, `prix_achat`, `devise`, `qte_initial`, `qte_actuelle`, `id_categorie`, `image_article`, `created_at`, `deleted`) VALUES
	(1, 'PINCE UNIVERSAIRE', '5', '3', 'USD', '25', '80', 6, 'IMG-20211115-WA0002.jpg', '2021-12-30 20:01:20', 'not'),
	(22, 'Sandales', '250', '200', 'USD', '258', '258', 9, 'IMG_20210411_155801412_BURST004.jpg', '2022-01-26 12:19:55', 'not'),
	(33, 'CUVE', '35', '15', 'USD', '200', '200', 4, 'IMG-20211116-WA0017.jpg', '2022-01-28 07:09:56', 'not');
/*!40000 ALTER TABLE `lq_articles` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_categories
CREATE TABLE IF NOT EXISTS `lq_categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` varchar(20) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_categories : ~5 rows (environ)
/*!40000 ALTER TABLE `lq_categories` DISABLE KEYS */;
INSERT INTO `lq_categories` (`id_categorie`, `nom_categorie`, `created_at`, `deleted`) VALUES
	(1, 'Divers', '2020-10-21 15:18:13', 'not'),
	(2, 'Habillement', '2020-10-21 15:18:13', 'not'),
	(3, 'Logistique', '2020-10-21 19:52:22', 'not'),
	(4, 'Consommable', '2020-10-21 19:52:22', 'not'),
	(6, 'Autres', '2021-10-06 17:16:10', 'not');
/*!40000 ALTER TABLE `lq_categories` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_factures
CREATE TABLE IF NOT EXISTS `lq_factures` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `qte_achetee` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `remise` varchar(50) NOT NULL,
  `fact_token` varchar(50) NOT NULL,
  `client_token` varchar(50) NOT NULL,
  `date_facture` date NOT NULL,
  `product_tva` int(11) NOT NULL DEFAULT '0',
  `prix_vente` varchar(50) NOT NULL,
  `prix_unitaire` varchar(50) NOT NULL,
  `prix_achat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_facture`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_factures : ~8 rows (environ)
/*!40000 ALTER TABLE `lq_factures` DISABLE KEYS */;
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`) VALUES
	(1, 2, '1', '250', '0', '73572', '66129', '2022-01-27', 0, '250', '250', '200'),
	(2, 1, '3', '15', '0', '73572', '66129', '2022-01-27', 0, '5', '5', '3'),
	(3, 2, '2', '490', '5', '42771', '13365', '2022-01-27', 0, '245', '250', '200'),
	(4, 1, '2', '10', '0', '42771', '13365', '2022-01-27', 0, '5', '5', '3'),
	(5, 2, '1', '250', '0', '75741', '71569', '2022-01-28', 0, '250', '250', '200'),
	(6, 1, '4', '20', '0', '75741', '71569', '2022-01-28', 0, '5', '5', '3'),
	(7, 1, '3', '15', '0', '74343', '77917', '2022-01-28', 0, '5', '5', '3'),
	(8, 1, '1', '5', '0', '81627', '98735', '2022-01-28', 0, '5', '5', '3'),
	(9, 3, '10', '350', '0', '34418', '12186', '2022-01-28', 0, '35', '35', '15');
/*!40000 ALTER TABLE `lq_factures` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_quantites_entree
CREATE TABLE IF NOT EXISTS `lq_quantites_entree` (
  `id_qte` int(11) NOT NULL AUTO_INCREMENT,
  `key_entree` varchar(50) DEFAULT NULL,
  `qte_restante` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_qte`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_quantites_entree : ~1 rows (environ)
/*!40000 ALTER TABLE `lq_quantites_entree` DISABLE KEYS */;
INSERT INTO `lq_quantites_entree` (`id_qte`, `key_entree`, `qte_restante`) VALUES
	(1, '4942373', '80');
/*!40000 ALTER TABLE `lq_quantites_entree` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_quantites_sortie
CREATE TABLE IF NOT EXISTS `lq_quantites_sortie` (
  `id_qte` int(11) NOT NULL AUTO_INCREMENT,
  `key_sortie` varchar(50) DEFAULT NULL,
  `qte_restante` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_qte`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_quantites_sortie : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_quantites_sortie` DISABLE KEYS */;
INSERT INTO `lq_quantites_sortie` (`id_qte`, `key_sortie`, `qte_restante`) VALUES
	(1, '2464409', '0');
/*!40000 ALTER TABLE `lq_quantites_sortie` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_reappro
CREATE TABLE IF NOT EXISTS `lq_reappro` (
  `id_reappro` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `date_reappro` date NOT NULL,
  `qte_reappro` int(11) NOT NULL,
  `nom_fournisseur` varchar(250) NOT NULL,
  `key_entree` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_reappro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_reappro : ~1 rows (environ)
/*!40000 ALTER TABLE `lq_reappro` DISABLE KEYS */;
INSERT INTO `lq_reappro` (`id_reappro`, `id_article`, `date_reappro`, `qte_reappro`, `nom_fournisseur`, `key_entree`) VALUES
	(1, 1, '2022-01-28', 80, 'jambo', '4942373');
/*!40000 ALTER TABLE `lq_reappro` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_retrieves
CREATE TABLE IF NOT EXISTS `lq_retrieves` (
  `id_retrieve` int(11) NOT NULL AUTO_INCREMENT,
  `preview_amount` double NOT NULL DEFAULT '0',
  `retrieve_amount` double NOT NULL DEFAULT '0',
  `current_amount` double NOT NULL DEFAULT '0',
  `motif` text NOT NULL,
  `retrieve_date` date DEFAULT NULL,
  PRIMARY KEY (`id_retrieve`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_retrieves : ~3 rows (environ)
/*!40000 ALTER TABLE `lq_retrieves` DISABLE KEYS */;
INSERT INTO `lq_retrieves` (`id_retrieve`, `preview_amount`, `retrieve_amount`, `current_amount`, `motif`, `retrieve_date`) VALUES
	(1, 290, 90, 200, 'Paiement facturier', '2022-01-28'),
	(2, 200, 25, 175, 'Paiement facturier2', '2022-01-28'),
	(3, 175, 5, 170, 'Paiement facturier ', '2022-01-28');
/*!40000 ALTER TABLE `lq_retrieves` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_soldes
CREATE TABLE IF NOT EXISTS `lq_soldes` (
  `id_solde` int(11) NOT NULL AUTO_INCREMENT,
  `date_solde` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `montant_entree` double NOT NULL,
  PRIMARY KEY (`id_solde`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_soldes : ~1 rows (environ)
/*!40000 ALTER TABLE `lq_soldes` DISABLE KEYS */;
INSERT INTO `lq_soldes` (`id_solde`, `date_solde`, `montant_entree`) VALUES
	(1, '2022-01-26 17:22:33', 520);
/*!40000 ALTER TABLE `lq_soldes` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_sorties
CREATE TABLE IF NOT EXISTS `lq_sorties` (
  `id_sortie` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `qte_sortie` varchar(100) NOT NULL,
  `date_sortie` date NOT NULL,
  `motif_sortie` varchar(250) NOT NULL,
  `key_sortie` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sortie`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_sorties : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_sorties` DISABLE KEYS */;
INSERT INTO `lq_sorties` (`id_sortie`, `id_article`, `qte_sortie`, `date_sortie`, `motif_sortie`, `key_sortie`) VALUES
	(1, 1, '25', '2021-03-01', 'VENTE', '2464409');
/*!40000 ALTER TABLE `lq_sorties` ENABLE KEYS */;

-- Listage de la structure de la table logistique_db. lq_users
CREATE TABLE IF NOT EXISTS `lq_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(200) NOT NULL,
  `role_utilisateur` varchar(50) NOT NULL,
  `user_name` varchar(75) DEFAULT NULL,
  `statut` varchar(50) DEFAULT 'online',
  `user_image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table logistique_db.lq_users : ~3 rows (environ)
/*!40000 ALTER TABLE `lq_users` DISABLE KEYS */;
INSERT INTO `lq_users` (`id`, `password`, `role_utilisateur`, `user_name`, `statut`, `user_image`) VALUES
	(1, '$2y$10$.xGyUSLbK00HsxCEVrkB6edqayH1Ooj88K7.95.DWkWG/Nl/h68p6', 'stock', 'Elie', 'online', 'erick.jpg'),
	(4, '$2y$10$.xGyUSLbK00HsxCEVrkB6edqayH1Ooj88K7.95.DWkWG/Nl/h68p6', 'billing', 'Erick', 'online', 'noimage_user.png'),
	(5, '$2y$10$.xGyUSLbK00HsxCEVrkB6edqayH1Ooj88K7.95.DWkWG/Nl/h68p6', 'admin', 'FREDDY', 'online', 'noimage_user.png');
/*!40000 ALTER TABLE `lq_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
