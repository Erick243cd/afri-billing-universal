#
# TABLE STRUCTURE FOR: lq_factures
#

DROP TABLE IF EXISTS `lq_factures`;

CREATE TABLE `lq_factures` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `qte_achetee` varchar(50) NOT NULL,
  `subtotal` double NOT NULL DEFAULT '0',
  `totalWithRemise` double NOT NULL DEFAULT '0',
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
  `is_remise` enum('0','1') DEFAULT '0',
  `userId` int(11) NOT NULL,
  `salespointId` int(11) NOT NULL,
  `currency` double DEFAULT '1',
  PRIMARY KEY (`id_facture`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (1, 2, '1', '6500', '6500', '0', '85354', '32792', '2023-02-01', 1040, '6500', '6500', '5000', 'Banze', '0', '1256500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (2, 1, '1', '400000', '400000', '0', '85354', '32792', '2023-02-01', 64000, '400000', '400000', '35000', 'Banze', '0', '1256500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (3, 4, '1', '600000', '600000', '0', '85354', '32792', '2023-02-01', 96000, '600000', '600000', '400000', 'Banze', '0', '1256500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (4, 3, '1', '250000', '250000', '0', '85354', '32792', '2023-02-01', 40000, '250000', '250000', '200000', 'Banze', '0', '1256500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (5, 2, '2', '13000', '13000', '0', '92481', '61723', '2023-02-01', 2080, '6500', '6500', '5000', 'Banze', '0', '13000', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (6, 2, '1', '6500', '6500', '0', '75845', '44584', '2023-02-01', 1040, '6500', '6500', '5000', 'Dave', '200', '6500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (7, 1, '1', '400000', '400000', '0', '75845', '44584', '2023-02-01', 64000, '400000', '400000', '35000', 'Dave', '200', '6500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (8, 2, '1', '6500', '6500', '0', '17465', '69458', '2023-02-01', 1040, '6500', '6500', '5000', 'Dave', '200', '6500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (9, 1, '1', '400000', '400000', '0', '17465', '69458', '2023-02-01', 64000, '400000', '400000', '35000', 'Dave', '200', '6500', '1', '1', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (10, 3, '1', '250000', '240000', '10000', '45559', '78962', '2023-02-01', 0, '250000', '250000', '200000', '', '0', '253000', '1', '0', '0', 3, 9, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (11, 2, '2', '13000', '13000', '0', '45559', '78962', '2023-02-01', 0, '6500', '6500', '5000', '', '0', '253000', '1', '0', '0', 3, 9, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (12, 2, '10', '65000', '65000', '0', '16786', '41849', '2023-02-01', 10400, '6500', '6500', '5000', '', '0', '315000', '1', '0', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (13, 3, '1', '250000', '250000', '0', '16786', '41849', '2023-02-01', 40000, '250000', '250000', '200000', '', '0', '315000', '1', '0', '0', 2, 7, '1.5');
INSERT INTO `lq_factures` (`id_facture`, `id_article`, `qte_achetee`, `subtotal`, `totalWithRemise`, `remise`, `fact_token`, `client_token`, `date_facture`, `product_tva`, `prix_vente`, `prix_unitaire`, `prix_achat`, `client_name`, `usd_amount`, `cdf_amount`, `is_cash`, `is_canceled`, `is_remise`, `userId`, `salespointId`, `currency`) VALUES (14, 2, '3', '19500', '14500', '5000', '67278', '57652', '2023-02-01', 0, '6500', '6500', '5000', '', '0', '14500', '1', '0', '0', 3, 9, '1.5');


