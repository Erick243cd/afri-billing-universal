-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table inventory-manager_db. lq_articles
CREATE TABLE IF NOT EXISTS `lq_articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(250) NOT NULL,
  `prix_unitaire` varchar(100) NOT NULL,
  `prix_achat` varchar(100) DEFAULT NULL,
  `devise` varchar(20) NOT NULL,
  `qte_initial` varchar(100) NOT NULL,
  `qte_actuelle` varchar(100) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `image_article` varchar(100) NOT NULL DEFAULT 'product_image.png',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` varchar(12) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_articles : ~4 rows (environ)
/*!40000 ALTER TABLE `lq_articles` DISABLE KEYS */;
INSERT INTO `lq_articles` (`id_article`, `designation`, `prix_unitaire`, `prix_achat`, `devise`, `qte_initial`, `qte_actuelle`, `id_categorie`, `image_article`, `created_at`, `deleted`) VALUES
	(2, 'Veste Daro Mars 2022', '100', '90', 'USD', '12', '8', 1, 'aea0e8cdd45d7a11b2caa1e1e95fe6f2.jpeg', '2022-06-22 14:01:36', 'not'),
	(3, 'Toles', '65', '50', 'USD', '500', '367', 6, 'b5fa3a87488017f443530175285b8354.png', '2022-11-15 16:30:28', 'not'),
	(4, 'Sac de ciment', '10', '16000', 'USD', '500', '500', 1, 'product_image.png', '2022-11-21 10:14:02', 'not'),
	(5, 'Tole BG32', '15', '10500', 'USD', '800', '800', 1, 'product_image.png', '2022-11-21 10:17:33', 'not');
/*!40000 ALTER TABLE `lq_articles` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_categories
CREATE TABLE IF NOT EXISTS `lq_categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` varchar(20) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_categories : ~7 rows (environ)
/*!40000 ALTER TABLE `lq_categories` DISABLE KEYS */;
INSERT INTO `lq_categories` (`id_categorie`, `nom_categorie`, `created_at`, `deleted`) VALUES
	(1, 'Construction', '2020-10-21 15:18:13', 'not'),
	(2, 'Pieces de rechange', '2020-10-21 15:18:13', 'not'),
	(3, 'Divers', '2020-10-21 19:52:22', 'not'),
	(4, 'Electrogene', '2020-10-21 19:52:22', 'not'),
	(6, 'Autres', '2021-10-06 17:16:10', 'yes'),
	(7, 'Nouvelle catégorie', '2022-11-21 10:51:14', 'yes'),
	(8, 'Transport', '2022-11-21 11:46:33', 'not');
/*!40000 ALTER TABLE `lq_categories` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_factures
CREATE TABLE IF NOT EXISTS `lq_factures` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `qte_achetee` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `remise` double NOT NULL DEFAULT '0',
  `fact_token` varchar(50) NOT NULL,
  `client_token` varchar(50) NOT NULL,
  `date_facture` date NOT NULL,
  `product_tva` int(11) NOT NULL DEFAULT '0',
  `prix_vente` varchar(50) NOT NULL,
  `prix_unitaire` varchar(50) NOT NULL,
  `prix_achat` varchar(50) NOT NULL,
  `client_name` varchar(50) DEFAULT NULL,
  `usd_amount` double DEFAULT NULL,
  `cdf_amount` double DEFAULT NULL,
  `is_cash` enum('1','0') NOT NULL DEFAULT '1',
  `is_canceled` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id_facture`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_factures : ~6 rows (environ)
/*!40000 ALTER TABLE `lq_factures` DISABLE KEYS */;
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`) VALUES
	(1, 3, '10', '650', 10, '47155', '62318', '2022-11-17', 0, '65', '65', '50', 'Erick Banze', 135, 10000, '1', '0'),
	(2, 2, '5', '500', 10, '47155', '62318', '2022-11-17', 0, '100', '100', '90', 'Erick Banze', 135, 10000, '1', '0'),
	(3, 2, '2', '200', 0, '55873', '86371', '2022-11-17', 0, '100', '100', '90', 'Kasongo Banze', 330, 0, '1', '0'),
	(4, 3, '2', '130', 0, '55873', '86371', '2022-11-17', 0, '65', '65', '50', 'Kasongo Banze', 330, 0, '1', '0'),
	(5, 3, '1', '65', 5, '56948', '26175', '2022-11-18', 0, '65', '65', '50', 'Nyembo', 260, 0, '1', '0'),
	(6, 2, '2', '200', 5, '56948', '26175', '2022-11-18', 0, '100', '100', '90', 'Nyembo', 260, 0, '1', '0'),
	(7, 3, '12', '780', 10, '77632', '83584', '2022-11-18', 0, '65', '65', '50', 'Kasongo', 770, 0, '1', '0'),
	(8, 5, '10', '150', 0, '96259', '57587', '2022-11-21', 0, '15', '15', '10500', 'Jeanclaude', 140, 20000, '1', '1');
/*!40000 ALTER TABLE `lq_factures` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_quantites_entree
CREATE TABLE IF NOT EXISTS `lq_quantites_entree` (
  `id_qte` int(11) NOT NULL AUTO_INCREMENT,
  `key_entree` varchar(50) DEFAULT NULL,
  `qte_restante` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_qte`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_quantites_entree : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_quantites_entree` DISABLE KEYS */;
INSERT INTO `lq_quantites_entree` (`id_qte`, `key_entree`, `qte_restante`) VALUES
	(1, '0', '0');
/*!40000 ALTER TABLE `lq_quantites_entree` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_quantites_sortie
CREATE TABLE IF NOT EXISTS `lq_quantites_sortie` (
  `id_qte` int(11) NOT NULL AUTO_INCREMENT,
  `key_sortie` varchar(50) DEFAULT NULL,
  `qte_restante` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_qte`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_quantites_sortie : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_quantites_sortie` DISABLE KEYS */;
INSERT INTO `lq_quantites_sortie` (`id_qte`, `key_sortie`, `qte_restante`) VALUES
	(1, '0', '0');
/*!40000 ALTER TABLE `lq_quantites_sortie` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_reappro
CREATE TABLE IF NOT EXISTS `lq_reappro` (
  `id_reappro` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `date_reappro` date NOT NULL,
  `qte_reappro` int(11) NOT NULL,
  `nom_fournisseur` varchar(250) NOT NULL,
  `key_entree` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_reappro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_reappro : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_reappro` DISABLE KEYS */;
INSERT INTO `lq_reappro` (`id_reappro`, `id_article`, `date_reappro`, `qte_reappro`, `nom_fournisseur`, `key_entree`) VALUES
	(1, 3, '2022-11-15', 100, 'JC', '7514876');
/*!40000 ALTER TABLE `lq_reappro` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_retrieves
CREATE TABLE IF NOT EXISTS `lq_retrieves` (
  `id_retrieve` int(11) NOT NULL AUTO_INCREMENT,
  `preview_amount` double NOT NULL DEFAULT '0',
  `retrieve_amount` double NOT NULL DEFAULT '0',
  `current_amount` double NOT NULL DEFAULT '0',
  `motif` text NOT NULL,
  `retrieve_date` date DEFAULT NULL,
  PRIMARY KEY (`id_retrieve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_retrieves : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_retrieves` DISABLE KEYS */;
/*!40000 ALTER TABLE `lq_retrieves` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_shops
CREATE TABLE IF NOT EXISTS `lq_shops` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(50) DEFAULT NULL,
  `shop_created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_shops : ~4 rows (environ)
/*!40000 ALTER TABLE `lq_shops` DISABLE KEYS */;
INSERT INTO `lq_shops` (`shop_id`, `shop_name`, `shop_created_at`) VALUES
	(1, 'Kipushi', '2022-11-18 09:57:52'),
	(2, 'Lubumbashi', '2022-11-18 09:58:01'),
	(3, 'Kolwezi', NULL),
	(4, 'Kamina', NULL);
/*!40000 ALTER TABLE `lq_shops` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_soldes
CREATE TABLE IF NOT EXISTS `lq_soldes` (
  `id_solde` int(11) NOT NULL AUTO_INCREMENT,
  `date_solde` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `montant_entree` double NOT NULL,
  `cdf_amount` double DEFAULT NULL,
  `usd_amount` double DEFAULT NULL,
  PRIMARY KEY (`id_solde`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_soldes : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_soldes` DISABLE KEYS */;
INSERT INTO `lq_soldes` (`id_solde`, `date_solde`, `montant_entree`, `cdf_amount`, `usd_amount`) VALUES
	(1, '2022-11-21 11:40:54', 140, 20000, 140);
/*!40000 ALTER TABLE `lq_soldes` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_sorties
CREATE TABLE IF NOT EXISTS `lq_sorties` (
  `id_sortie` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `qte_sortie` varchar(100) NOT NULL,
  `date_sortie` date NOT NULL,
  `motif_sortie` varchar(250) NOT NULL,
  `key_sortie` varchar(50) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sortie`),
  KEY `FK_Shop` (`shop_id`),
  CONSTRAINT `FK_Shop` FOREIGN KEY (`shop_id`) REFERENCES `lq_shops` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_sorties : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_sorties` DISABLE KEYS */;
INSERT INTO `lq_sorties` (`id_sortie`, `id_article`, `qte_sortie`, `date_sortie`, `motif_sortie`, `key_sortie`, `shop_id`) VALUES
	(1, 3, '200', '2022-11-15', 'Ventes', '6023045', NULL);
/*!40000 ALTER TABLE `lq_sorties` ENABLE KEYS */;

-- Listage de la structure de la table inventory-manager_db. lq_users
CREATE TABLE IF NOT EXISTS `lq_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(200) NOT NULL,
  `role_utilisateur` varchar(50) NOT NULL,
  `shop_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(75) DEFAULT NULL,
  `statut` varchar(50) DEFAULT 'online',
  `user_image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Shopsd` (`shop_id`),
  CONSTRAINT `FK_Shopsd` FOREIGN KEY (`shop_id`) REFERENCES `lq_shops` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table inventory-manager_db.lq_users : ~0 rows (environ)
/*!40000 ALTER TABLE `lq_users` DISABLE KEYS */;
INSERT INTO `lq_users` (`id`, `password`, `role_utilisateur`, `shop_id`, `user_name`, `statut`, `user_image`) VALUES
	(1, '$2y$10$caYW1Uo4QsbJBiUN/HeqEu36x6TrM2vS6ok8u/dnICBwtUj2t8fJy', 'admin', 1, 'Erick', 'online', 'noimage_user.png');
/*!40000 ALTER TABLE `lq_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
