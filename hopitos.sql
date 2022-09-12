-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 12 sep. 2022 à 17:09
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hopitos`
--

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

DROP TABLE IF EXISTS `configs`;
CREATE TABLE IF NOT EXISTS `configs` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_nom` varchar(50) NOT NULL,
  `config_val` varchar(50) NOT NULL,
  `config_type` varchar(10) NOT NULL,
  UNIQUE KEY `config_id` (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `configs`
--

INSERT INTO `configs` (`config_id`, `config_nom`, `config_val`, `config_type`) VALUES
(1, 'Frais de la fiche', '10000', '1'),
(2, 'hemato_Hbg', '2000', '1'),
(3, 'hemato_GB', '2000', '1'),
(4, 'hemato_VS', '2000', '1'),
(5, 'hemato_FL_E', '2000', '1'),
(6, 'hemato_FL_B', '2000', '1'),
(7, 'hemato_FL_L', '2000', '1'),
(8, 'hemato_FL_M', '2000', '1'),
(9, 'hemato_TS', '2000', '1'),
(10, 'hemato_TC', '2000', '1'),
(11, 'hemato_GS', '2000', '1'),
(12, 'hemato_HTC', '2000', '1'),
(13, 'parasito_GE', '2000', '1'),
(14, 'parasito_GF', '2000', '1'),
(15, 'parasito_CATT', '2000', '1'),
(16, 'parasito_frais_mince', '2000', '1'),
(17, 'parasito_selles_exam_direct', '2000', '1'),
(18, 'parasito_urines_sediment', '2000', '1'),
(19, 'parasito_PVUF', '2000', '1'),
(20, 'parasito_ecr_element', '2000', '1'),
(21, 'parasito_bacterio_nature_produit', '2000', '1'),
(22, 'parasito_bacterio_gramme', '2000', '1'),
(23, 'parasito_bacterio_ziehl', '2000', '1'),
(24, 'bio_nature_produit', '2000', '1'),
(25, 'bio_glucose', '2000', '1'),
(26, 'bio_bilirubine', '2000', '1'),
(27, 'bio_albumine', '2000', '1'),
(28, 'bio_acetone', '2000', '1'),
(29, 'bio_PH', '2000', '1'),
(30, 'bio_nitrite', '2000', '1'),
(31, 'is_test_grossesse', '2000', '1'),
(32, 'is_widal_TO', '2000', '1'),
(33, 'is_TH', '2000', '1'),
(34, 'is_CATT', '2000', '1'),
(35, 'is_HBS', '2000', '1'),
(36, 'is_HC', '2000', '1'),
(37, 'is_P120', '2000', '1');

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `depense_id` int(11) NOT NULL AUTO_INCREMENT,
  `depense_motif` varchar(200) NOT NULL,
  `depense_montant` varchar(10) NOT NULL,
  `depense_datetime` datetime NOT NULL,
  `fk_users_id` int(11) NOT NULL,
  PRIMARY KEY (`depense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`depense_id`, `depense_motif`, `depense_montant`, `depense_datetime`, `fk_users_id`) VALUES
(1, 'transport', '2000', '2021-04-24 11:52:43', 1),
(2, 'manger', '12000', '2021-04-24 20:36:08', 1);

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

DROP TABLE IF EXISTS `examen`;
CREATE TABLE IF NOT EXISTS `examen` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_fiche_id` int(11) NOT NULL,
  `fk_patient_id` int(11) NOT NULL,
  `fk_demandeur_id` int(11) NOT NULL,
  `fk_laborantin_id` int(11) DEFAULT NULL,
  `exam_date_demande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `exam_date_reponse` datetime DEFAULT NULL,
  `exam_service` varchar(200) DEFAULT NULL,
  `hemato_Hbg` varchar(50) DEFAULT NULL,
  `hemato_GB` varchar(50) DEFAULT NULL,
  `hemato_VS` varchar(50) DEFAULT NULL,
  `hemato_FL_E` varchar(50) DEFAULT NULL,
  `hemato_FL_B` varchar(50) DEFAULT NULL,
  `hemato_FL_L` varchar(50) DEFAULT NULL,
  `hemato_FL_M` varchar(50) DEFAULT NULL,
  `hemato_TS` varchar(50) DEFAULT NULL,
  `hemato_TC` varchar(50) DEFAULT NULL,
  `hemato_GS` varchar(50) DEFAULT NULL,
  `hemato_HTC` varchar(50) DEFAULT NULL,
  `parasito_GE` varchar(50) DEFAULT NULL,
  `parasito_GF` varchar(50) DEFAULT NULL,
  `parasito_CATT` varchar(50) DEFAULT NULL,
  `parasito_frais_mince` varchar(50) DEFAULT NULL,
  `parasito_selles_exam_direct` varchar(200) DEFAULT NULL,
  `parasito_urines_sediment` varchar(50) DEFAULT NULL,
  `parasito_PVUF` varchar(200) DEFAULT NULL,
  `parasito_ecr_element` varchar(50) DEFAULT NULL,
  `parasito_bacterio_nature_produit` varchar(50) DEFAULT NULL,
  `parasito_bacterio_gramme` varchar(50) DEFAULT NULL,
  `parasito_bacterio_ziehl` varchar(50) DEFAULT NULL,
  `bio_nature_produit` varchar(50) DEFAULT NULL,
  `bio_glucose` varchar(50) DEFAULT NULL,
  `bio_bilirubine` varchar(50) DEFAULT NULL,
  `bio_albumine` varchar(50) DEFAULT NULL,
  `bio_acetone` varchar(50) DEFAULT NULL,
  `bio_PH` varchar(50) DEFAULT NULL,
  `bio_nitrite` varchar(50) DEFAULT NULL,
  `is_test_grossesse` varchar(50) DEFAULT NULL,
  `is_widal_TO` varchar(50) DEFAULT NULL,
  `is_TH` varchar(50) DEFAULT NULL,
  `is_CATT` varchar(50) DEFAULT NULL,
  `is_HBS` varchar(50) DEFAULT NULL,
  `is_HC` varchar(50) DEFAULT NULL,
  `is_P120` varchar(50) DEFAULT NULL,
  `autres_examens` text,
  `autres_examens_resultats` text,
  `exam_etape` varchar(10) NOT NULL DEFAULT '1',
  `motif_declasse` text,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`exam_id`, `fk_fiche_id`, `fk_patient_id`, `fk_demandeur_id`, `fk_laborantin_id`, `exam_date_demande`, `exam_date_reponse`, `exam_service`, `hemato_Hbg`, `hemato_GB`, `hemato_VS`, `hemato_FL_E`, `hemato_FL_B`, `hemato_FL_L`, `hemato_FL_M`, `hemato_TS`, `hemato_TC`, `hemato_GS`, `hemato_HTC`, `parasito_GE`, `parasito_GF`, `parasito_CATT`, `parasito_frais_mince`, `parasito_selles_exam_direct`, `parasito_urines_sediment`, `parasito_PVUF`, `parasito_ecr_element`, `parasito_bacterio_nature_produit`, `parasito_bacterio_gramme`, `parasito_bacterio_ziehl`, `bio_nature_produit`, `bio_glucose`, `bio_bilirubine`, `bio_albumine`, `bio_acetone`, `bio_PH`, `bio_nitrite`, `is_test_grossesse`, `is_widal_TO`, `is_TH`, `is_CATT`, `is_HBS`, `is_HC`, `is_P120`, `autres_examens`, `autres_examens_resultats`, `exam_etape`, `motif_declasse`) VALUES
(23, 8, 3, 1, 1, '2020-05-29 18:26:48', '2020-05-28 18:50:08', 'consultation gÃ©nÃ©rale', 'x_dem', 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '4', ''),
(24, 7, 3, 1, 1, '2020-05-31 11:38:03', '2020-05-31 11:40:52', 'consultation all', '43', '11', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2', ''),
(26, 9, 2, 1, 1, '2020-06-06 17:54:37', '2020-06-06 18:31:14', 'consultation all', 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '4', 'je suis le boss et je refuse. c\'est tout :)'),
(27, 9, 2, 1, 1, '2020-06-06 21:30:03', '2020-06-06 21:32:33', 'consultation', 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '4', 'le motif est que ceci est un teste :)'),
(28, 8, 3, 1, NULL, '2020-06-06 22:04:39', '0000-00-00 00:00:00', 'mmmm', 'x_dem', 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '4', NULL),
(29, 8, 3, 1, NULL, '2020-06-06 22:12:59', '0000-00-00 00:00:00', 'nnjh', 'x_dem', 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '4', NULL),
(30, 4, 2, 1, 1, '2020-06-08 15:39:04', '2020-06-08 15:39:37', 'extra..mdr', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'nn', 'nb', 'nj', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2', NULL),
(31, 8, 3, 1, 1, '2020-06-08 16:25:28', '2020-06-08 16:34:07', 'vcd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '3', 'jamais na sala'),
(32, 10, 5, 1, 1, '2020-06-09 12:40:15', '2020-06-09 12:43:16', 'ematho', 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, 'x_dem', NULL, 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, 'x_dem', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '4', 'pas fonde'),
(33, 10, 5, 1, 1, '2020-06-09 12:44:31', '2020-06-09 12:45:57', 'ematho', '12', '11', '', '', '', '', '', '', '', '', '', 'K7', '', 'C33', '', '', '', '', '', '', '', '', '', '', '', '', '', '3.1', '7.1E', '', '', '', '', '', '', '', '', '', '2', NULL),
(34, 9, 2, 1, 1, '2020-06-10 12:18:40', '2020-06-10 12:18:52', 'cons', 'x_dem', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '4', NULL),
(35, 12, 5, 1, NULL, '2020-06-10 19:47:41', '0000-00-00 00:00:00', 'nvbd', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '4', NULL),
(36, 12, 5, 1, 1, '2020-06-10 19:50:45', '2020-06-10 19:50:55', 'cndjs', 'xc', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2', NULL),
(37, 11, 5, 1, 1, '2020-06-10 19:55:05', '2020-06-10 19:55:39', 'cmdlvk', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', '', '', '4', 'mldvmdlvnk'),
(38, 11, 5, 1, 1, '2020-06-10 19:56:02', '2020-06-10 19:56:14', 'cnkdjd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'cmlx', '', '', '2', NULL),
(39, 14, 7, 1, 1, '2020-06-10 20:46:01', '2020-06-10 20:46:13', 'mm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'mm', '', '', '', '', '', '', '', '2', NULL),
(40, 9, 2, 1, 3, '2020-06-14 10:10:14', '2022-09-06 11:29:18', 'ncdjd', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '3', 'null\n'),
(41, 15, 8, 2, 3, '2021-04-25 22:17:53', '2021-04-26 10:33:03', 'conscience service', '12', '12', '', '', '', '', '', '', '', '', '', '12', '12', '', '', '', '12', '', '', '', '', '', '', '', '', '', '', '', '12', '', '', '', '', '', '', '', 'voici les autres examens', 'les resultats des examans', '2', NULL),
(42, 16, 85, 2, 3, '2022-09-06 11:21:13', '2022-09-06 11:28:23', 'Le service', '12', '12', '', '', '', '', '', '', '', '', '', '12', '', '', '', '', '12', '', '', '', '', '', '', '12', '', '', '', '12', '', '', '', '', '', '', '', '', 'ndjbdj autres examens', 'resultats autres vlkjfldndkllfdk', '2', NULL),
(43, 13, 7, 1, NULL, '2022-09-12 09:56:37', NULL, 'Imagerie', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

DROP TABLE IF EXISTS `fiche`;
CREATE TABLE IF NOT EXISTS `fiche` (
  `fiche_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_patient_id` int(11) NOT NULL,
  `poids` double NOT NULL,
  `tension` double NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `symptomes` text,
  `diagnostic` text,
  `traitement` text,
  `resultat_labo` text,
  `fiche_ouverture_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fiche_cloture_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fiche_etape` varchar(50) NOT NULL DEFAULT '1',
  `pres_medicale` text,
  `fiche_fk_users_id` int(11) NOT NULL,
  PRIMARY KEY (`fiche_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fiche`
--

INSERT INTO `fiche` (`fiche_id`, `fk_patient_id`, `poids`, `tension`, `temperature`, `symptomes`, `diagnostic`, `traitement`, `resultat_labo`, `fiche_ouverture_date`, `fiche_cloture_date`, `fiche_etape`, `pres_medicale`, `fiche_fk_users_id`) VALUES
(1, 3, 67, 0, '', ' c n  mnvm n', 'ckcndkjnckdjs', ' le traitement', 'resultatat labo', '1996-05-14 00:00:00', '2020-05-14 22:15:50', '3', 'les prescriptions', 1),
(2, 3, 0, 0, '', '', '', ' le traitement', 'resultatat labo', '2020-05-15 15:44:24', '2020-05-15 22:17:29', '3', 'les prescriptions', 1),
(3, 4, 88, 0, '', 'maux de tete\nfatigue\nfiÃ¨vre', 'palu et covid :)', 'Traitement symptomatique', 'ph: 3\nuri: 4%\nhemoglobine : 44H', '2020-05-15 23:28:32', '2020-05-15 23:33:50', '3', 'luther forte 500g\nAmoxi 250g\nvitamince c x10\nmultivite CP', 1),
(4, 2, 75.3, 0, '', 'cdnlklscn', 'nclndljdldj cdlcjd cdclnc\ncdcnkc  ncdnd cdlcjnd dlnd \nd dcdncd  clcclknjkc clcjdnc', 'nkjnjknkjnkj', 'parasito_frais_mince = nn \n <br>parasito_selles_exam_direct = nb \n <br>parasito_urines_sediment = nj \n <br>', '2020-05-16 16:55:54', '2020-06-08 16:59:45', '3', 'mlkjnkjlklkmlkm', 1),
(5, 4, 77, 77, '', 'nkb jknkkj', 'vvvbjnjknnl', 'cndknvnfvj\ncvnfjkvnvjk\ncdvnfkvnfnvf\nvfkvnfjvnfjkn', 'cnjdncdkcnd\ncdcndkncjnc\ndccndjncdjncc\ncdjcndkcndkc', '2020-05-16 17:06:15', '2020-05-17 12:47:59', '3', 'cndjnverujkd\ndcnkdjvnf\nsdvnkfnvjf', 1),
(6, 3, 84.6, 67.5, '', 'vvnnv jnjkl njnjk jnl njln jn ln jnjnuhu mnljhbh', 'bnvvbcfd fgddddys  dfsdfxc kjkbkj jjn vbnvb', 'mlcmd ldl', 'mcllml m', '2020-05-16 17:07:16', '2020-05-16 22:52:43', '3', 'cldfn nvndj', 1),
(7, 3, 68, 21, '', 'symp\nmaux de tete et autres', 'le diagnostic du medecin', 'voila le bon traitement ', 'hemato_Hbg = 43 \n <br>hemato_GB = 11 \n <br>', '2020-05-24 21:40:31', '2020-06-07 15:46:19', '3', 'une prescription digne de ce nom', 1),
(8, 3, 64, 11, '', 'maux de tete /\nfatigue / \nvertige / ', 'un tres bon diagnostic', 'un traiment sans exam', '', '2020-05-29 17:41:46', '2020-06-08 16:58:23', '3', 'une prescription sans exam', 1),
(9, 2, 77, 12, '', 'njkj\njljn\nnjnjkn\nnjknkjn\njknkjnkj', 'bjbjh njnkj n\n njnjkn njnlj\n kmkmklmk', '', 'hemato_Hbg = mmn \n <br>', '2020-06-03 14:11:48', '0000-00-00 00:00:00', '2', '', 1),
(10, 5, 77, 11, '', 'maux de tete\nfatigue', 'mon diag', 'un traitemnet mldkndd', 'hemato_Hbg = 12 \n <br>hemato_GB = 11 \n <br>parasito_GE = K7 \n <br>parasito_CATT = C33 \n <br>bio_PH = 3.1 \n <br>bio_nitrite = 7.1E \n <br>', '2020-06-09 12:35:52', '2020-06-09 12:51:20', '3', 'cnksdcndjkncd\ncndjcndjncd cndjcd\ncndcjdncdjnc\\cndjcndjc', 1),
(11, 5, 4, 4, '', '4', '4', 'cmxlkmvck', '', '2020-06-10 19:29:24', '2020-06-10 20:19:35', '3', 'cmlkvmldvkd', 1),
(12, 5, 54, 55, '', '544', '445', 'vdvfvfdv', 'hemato_Hbg = xc \n <br>', '2020-06-10 19:29:42', '2020-06-10 20:19:02', '3', 'vfvdfvvfv', 1),
(13, 7, 0, 0, '', 'vnjfjknjnfdj', 'nkvnfkvnvjndkfjjk', '', '', '2020-06-10 19:44:23', '0000-00-00 00:00:00', '2', '', 1),
(14, 7, 4, 4, '', '4', '4', '', 'is_widal_TO = mm \n <br>', '2020-06-10 20:45:34', '0000-00-00 00:00:00', '2', '', 1),
(15, 8, 12, 12, '12', 'nckdjcndjkcndjkc\ncdnkcndjcnjkdc\ncndjcndskcjsdc', 'vnfkvnjkjvn\nvnfkvfkvndfjkv\nvdfkvnvjfkv\nvndfkvnjfvnjdf', 'mon traitement est la', '', '2021-04-25 22:09:35', '2021-04-26 10:36:31', '3', 'Les prescriptions sont la', 2),
(16, 85, 75, 12, '35', 'histoire de la maladie', 'mon diag fdksfdkfkfjkjdsf', 'v,flvnfjnfjnfvnfnfj', 'hemato_Hbg = 12 <br>hemato_GB = 12 <br>parasito_GE = 12 <br>parasito_urines_sediment = 12 <br>bio_glucose = 12 <br>bio_PH = 12 <br><span>Resultats autres examens : </span><br>resultats autres vlkjfldndkllfdk', '2022-09-06 11:05:13', '2022-09-06 11:33:44', '3', 'vfvnvkjfv\nvfjnkjnvkj\nvfnvvnj', 2),
(17, 8, 75, 12, '35', NULL, NULL, NULL, NULL, '2022-09-12 11:01:41', '2022-09-12 11:01:41', '1', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_dossier_numero` varchar(50) NOT NULL,
  `patient_fiche_numero` varchar(50) NOT NULL,
  `patient_nom` varchar(100) NOT NULL,
  `patient_postnom` varchar(100) NOT NULL,
  `patient_prenom` varchar(100) NOT NULL,
  `patient_date_naissance` date NOT NULL,
  `patient_sexe` varchar(10) NOT NULL,
  `patient_adresse` text NOT NULL,
  `patient_statut` varchar(100) NOT NULL,
  `fk_patient_conv` int(11) DEFAULT NULL,
  `patient_affiliation` varchar(100) DEFAULT NULL,
  `patient_code_convention` varchar(100) DEFAULT NULL,
  `patient_occupation` varchar(100) DEFAULT NULL,
  `fk_users_id` int(11) NOT NULL,
  `patient_save_date` datetime NOT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_dossier_numero`, `patient_fiche_numero`, `patient_nom`, `patient_postnom`, `patient_prenom`, `patient_date_naissance`, `patient_sexe`, `patient_adresse`, `patient_statut`, `fk_patient_conv`, `patient_affiliation`, `patient_code_convention`, `patient_occupation`, `fk_users_id`, `patient_save_date`) VALUES
(1, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(2, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(3, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(4, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(5, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(6, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(7, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(8, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(9, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(10, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(11, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(12, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(13, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(14, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(15, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(16, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(17, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(18, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(19, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(20, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(21, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(22, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(23, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(24, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(25, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(26, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(27, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(28, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(29, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(30, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(31, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(32, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(33, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(34, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(35, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(36, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(37, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(38, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(39, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(40, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(41, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(42, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(43, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(44, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(45, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(46, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(47, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(48, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(49, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(50, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(51, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(52, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(53, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(54, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(55, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(56, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(57, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(58, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(59, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(60, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(61, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(62, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(63, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(64, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(65, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(66, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(67, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(68, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(69, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(70, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(71, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(72, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(73, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(74, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(75, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(76, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(77, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(78, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(79, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(80, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23'),
(81, 'D76', 'F57', 'Mwema', 'Info', 'Daniel', '2000-10-10', 'M', 'ndjili', 'simple', 0, '', '', '', 1, '2020-06-10 19:35:22'),
(82, 'nkjd', ' ndjf', 'mckdj', 'cndiu', 'nkfj', '2020-06-10', 'M', 'mckjdj', 'simple', 0, '', '', '', 1, '2020-06-10 19:37:57'),
(83, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18'),
(84, 'rtr', 'et', 're', 'etre', 'rytr', '2022-09-06', 'M', 'tretre', 'simple', 0, '', '0', '', 4, '2022-09-06 10:23:27'),
(85, 'DM123', 'DMF123', 'Mubake', 'Walia', 'Jonathan', '2022-09-06', 'M', 'chez lui', 'familleConv', 0, '', '0', '', 4, '2022-09-06 10:25:10'),
(86, 'AA1', 'AAF1', 'Asad', 'Luboya', 'ElysÃ©e', '1990-07-27', 'M', 'Av. Kikama N:2 C/Masina Q/Television', 'simple', 0, '', '', '', 1, '2020-05-15 10:33:43'),
(87, 'ABB', 'ABB1', 'Omba', 'Awumba', 'Joel', '1998-03-20', 'M', 'Kianza n:2 Q/Boba C/Masina', 'simple', 0, '', '', '', 1, '2020-05-15 10:39:58'),
(88, 'ABB', 'ABB2', 'Musinga', 'Thana', 'Elsie', '2000-10-02', 'F', 'tunnel and digue', 'conventionne', 0, 'CNSS', 'C473', 'Informaticienne', 1, '2020-05-15 14:44:56'),
(89, 'ADD', 'ADD9', 'Bokoto', 'Ikwa', 'Grace', '2001-08-24', 'F', 'prÃ©s de chez moi', 'simple', 0, '', '', '', 1, '2020-05-15 23:27:38'),
(90, 'DD4', 'DD4F2', 'makanzu', 'kiang', 'caleb', '2002-03-08', 'M', 'bbbdhfjyjry', 'simple', 0, '', '', '', 1, '2020-06-09 12:34:23');

-- --------------------------------------------------------

--
-- Structure de la table `payement`
--

DROP TABLE IF EXISTS `payement`;
CREATE TABLE IF NOT EXISTS `payement` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_montant` varchar(10) NOT NULL,
  `num_facture` varchar(20) NOT NULL,
  `pay_date` datetime NOT NULL,
  `pay_motif` varchar(5) NOT NULL,
  `pay_description` text NOT NULL,
  `utilise` int(11) DEFAULT '0',
  `fk_pay_patient_id` int(11) NOT NULL,
  `fk_pay_exam_id` int(11) NOT NULL,
  `fk_pay_user_id` int(11) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `payement`
--

INSERT INTO `payement` (`pay_id`, `pay_montant`, `num_facture`, `pay_date`, `pay_motif`, `pay_description`, `utilise`, `fk_pay_patient_id`, `fk_pay_exam_id`, `fk_pay_user_id`) VALUES
(1, '10000', '25048232021', '2021-04-25 22:07:21', '1', '', 0, 3, 0, 1),
(2, '10000', '25047842021', '2021-04-25 22:07:39', '1', '', 1, 8, 0, 1),
(3, '10000', '25046722021', '2021-04-25 22:26:26', '1', '', 1, 8, 0, 1),
(4, '17000', '26041912021', '2021-04-26 10:23:12', '2', '', 1, 0, 41, 1),
(5, '10000', '06094502022', '2022-09-06 10:52:37', '1', '', 1, 85, 0, 1),
(6, '19800', '06092552022', '2022-09-06 11:25:03', '2', '', 1, 0, 42, 1),
(7, '10000', '07092532022', '2022-09-07 16:37:04', '1', '', 0, 90, 0, 1),
(8, '6000', '12092472022', '2022-09-12 10:24:26', '2', '', 0, 0, 43, 1),
(9, '10000', '12094472022', '2022-09-12 11:00:37', '1', '', 1, 8, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id_agent` int(11) NOT NULL AUTO_INCREMENT,
  `nom_agent` varchar(100) DEFAULT NULL,
  `postnom_agent` varchar(100) DEFAULT NULL,
  `prenom_agent` varchar(100) DEFAULT NULL,
  `sexe_agent` varchar(10) DEFAULT NULL,
  `tel_agent` varchar(20) DEFAULT NULL,
  `email_agent` varchar(50) DEFAULT NULL,
  `fonction_agent` varchar(225) DEFAULT NULL,
  `site_agent` varchar(100) DEFAULT NULL,
  `matricule_agent` text,
  `etat_civil` varchar(20) DEFAULT NULL,
  `nbre_enfant` int(11) DEFAULT NULL,
  `epoux` varchar(100) DEFAULT NULL,
  `nais_agent` varchar(200) NOT NULL,
  `date_nais_agent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse_agent` text NOT NULL,
  PRIMARY KEY (`id_agent`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_agent`, `nom_agent`, `postnom_agent`, `prenom_agent`, `sexe_agent`, `tel_agent`, `email_agent`, `fonction_agent`, `site_agent`, `matricule_agent`, `etat_civil`, `nbre_enfant`, `epoux`, `nais_agent`, `date_nais_agent`, `adresse_agent`) VALUES
(2, 'Mubake', 'WAl', 'Jonathan', 'm', '3123', 'nel7luboya@gmail.com', 'eztrer', 'zert', '98745', 'celibataire', 1, 'pou', '', '2022-09-12 16:47:27', ''),
(3, 'Mubake', 'WAl', 'Jonathan', 'm', '3123', 'nel7luboya@gmail.com', 'eztrer', 'zert', '98745', 'celibataire', 1, 'pou', '', '2022-09-12 16:47:27', ''),
(4, 'Mubake', 'WAl', 'Jonathan', 'm', '3123', 'nel7luboya@gmail.com', 'eztrer', 'zert', '98745', 'celibataire', 1, 'pou', '', '2022-09-12 16:47:27', ''),
(5, 'Mubake', 'WAl', 'Jonathan', 'm', '3123', 'nel7luboya@gmail.com', 'eztrer', 'zert', '98745', 'celibataire', 1, 'pou', '', '2022-09-12 16:47:27', ''),
(6, 'oui', 'uoi', 'rt', 'm', '21546', 'nel7luboya@gmail.com', 'ret', 'ert', '12123', 'marie', 1, 'dgfg', 'eede', '2022-09-12 00:00:00', 'rtyt');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `produit_id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_nom` varchar(50) NOT NULL,
  `produit_dosage` varchar(50) NOT NULL,
  `produit_dosage_unite` varchar(10) NOT NULL,
  `produit_pv` varchar(10) NOT NULL,
  `produit_qte` int(11) NOT NULL,
  PRIMARY KEY (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_nom`, `produit_dosage`, `produit_dosage_unite`, `produit_pv`, `produit_qte`) VALUES
(1, 'Quinine', '500', 'mg', '2000', 5);

-- --------------------------------------------------------

--
-- Structure de la table `sortie_produit`
--

DROP TABLE IF EXISTS `sortie_produit`;
CREATE TABLE IF NOT EXISTS `sortie_produit` (
  `sortie_produit_id` int(11) NOT NULL AUTO_INCREMENT,
  `sortie_produit_qte` int(11) NOT NULL,
  `sortie_produit_datetime` datetime NOT NULL,
  `sortie_produit_fk_produit_id` int(11) NOT NULL,
  `sortie_produit_fk_users_id` int(11) NOT NULL,
  PRIMARY KEY (`sortie_produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sortie_produit`
--

INSERT INTO `sortie_produit` (`sortie_produit_id`, `sortie_produit_qte`, `sortie_produit_datetime`, `sortie_produit_fk_produit_id`, `sortie_produit_fk_users_id`) VALUES
(1, 10, '2021-04-24 11:50:17', 1, 1),
(2, 2, '2021-04-24 20:36:30', 1, 1),
(3, 3, '2021-04-24 20:39:11', 1, 1),
(4, 7, '2021-04-24 20:40:49', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privilege` varchar(50) NOT NULL,
  `etat` varchar(50) NOT NULL,
  `agent_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `login`, `password`, `privilege`, `etat`, `agent_id`) VALUES
(1, 'nel7', 'nel', '1', 'actif', 0),
(2, 'wise', 'wise', '3', 'actif', 0),
(3, 'dan', 'dan', '4', 'actif', 0),
(4, 'glory', 'glory', '2', 'actif', 0),
(5, 'john', 'john', '2', 'inactif', 0),
(6, 'nel7luboya@gmail.com', '1234', '1', 'actif', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
