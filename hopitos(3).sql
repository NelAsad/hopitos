-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 07 oct. 2022 à 16:10
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
-- Structure de la table `actes`
--

DROP TABLE IF EXISTS `actes`;
CREATE TABLE IF NOT EXISTS `actes` (
  `pk_acte` int(11) NOT NULL,
  `nom_acte` int(11) NOT NULL,
  `description_acte` int(11) NOT NULL,
  `fk_tarif` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Structure de la table `demande_labo`
--

DROP TABLE IF EXISTS `demande_labo`;
CREATE TABLE IF NOT EXISTS `demande_labo` (
  `pk_demande_labo` int(11) NOT NULL,
  `fk_diagnostic` int(11) NOT NULL,
  `fk_acte` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Structure de la table `details_facture`
--

DROP TABLE IF EXISTS `details_facture`;
CREATE TABLE IF NOT EXISTS `details_facture` (
  `pk_details_facture` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `fk_acte` int(11) NOT NULL,
  `fk_facture` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `diagnostic`
--

DROP TABLE IF EXISTS `diagnostic`;
CREATE TABLE IF NOT EXISTS `diagnostic` (
  `pk_diagnostic` int(11) NOT NULL,
  `note_plainte` varchar(225) NOT NULL,
  `note_diagnostic` varchar(225) NOT NULL,
  `fk_transfert` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int(11) NOT NULL AUTO_INCREMENT,
  `nom_entreprise` varchar(225) NOT NULL,
  PRIMARY KEY (`id_entreprise`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`) VALUES
(1, 'Entreprise 1'),
(2, 'Entreprise 2');

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
  `radiographie` varchar(225) DEFAULT NULL,
  `echographie` varchar(225) DEFAULT NULL,
  `irm` varchar(225) DEFAULT NULL,
  `endoscopie` varchar(225) DEFAULT NULL,
  `scanner` varchar(225) DEFAULT NULL,
  `img_inserted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`exam_id`, `fk_fiche_id`, `fk_patient_id`, `fk_demandeur_id`, `fk_laborantin_id`, `exam_date_demande`, `exam_date_reponse`, `exam_service`, `hemato_Hbg`, `hemato_GB`, `hemato_VS`, `hemato_FL_E`, `hemato_FL_B`, `hemato_FL_L`, `hemato_FL_M`, `hemato_TS`, `hemato_TC`, `hemato_GS`, `hemato_HTC`, `parasito_GE`, `parasito_GF`, `parasito_CATT`, `parasito_frais_mince`, `parasito_selles_exam_direct`, `parasito_urines_sediment`, `parasito_PVUF`, `parasito_ecr_element`, `parasito_bacterio_nature_produit`, `parasito_bacterio_gramme`, `parasito_bacterio_ziehl`, `bio_nature_produit`, `bio_glucose`, `bio_bilirubine`, `bio_albumine`, `bio_acetone`, `bio_PH`, `bio_nitrite`, `is_test_grossesse`, `is_widal_TO`, `is_TH`, `is_CATT`, `is_HBS`, `is_HC`, `is_P120`, `autres_examens`, `autres_examens_resultats`, `exam_etape`, `motif_declasse`, `radiographie`, `echographie`, `irm`, `endoscopie`, `scanner`, `img_inserted`) VALUES
(1, 1, 1, 2, NULL, '2022-09-15 20:26:25', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 2, 2, 2, 3, '2022-09-20 16:57:17', '2022-09-20 17:00:23', 'EXAMEN LABO', '12', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '21', '', '12', '', '', '', '', '12', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Autres examens', 'resultats autres examens', '2', NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `exam_image`
--

DROP TABLE IF EXISTS `exam_image`;
CREATE TABLE IF NOT EXISTS `exam_image` (
  `id_image` int(11) NOT NULL,
  `lien_image` varchar(200) NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `pk_facture` int(11) NOT NULL,
  `fk_type_facture` int(11) NOT NULL,
  `fk_visite` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture_demande`
--

DROP TABLE IF EXISTS `facture_demande`;
CREATE TABLE IF NOT EXISTS `facture_demande` (
  `pk_facture_demande` int(11) NOT NULL,
  `fk_facture` int(11) NOT NULL,
  `fk_demande` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fiche`
--

INSERT INTO `fiche` (`fiche_id`, `fk_patient_id`, `poids`, `tension`, `temperature`, `symptomes`, `diagnostic`, `traitement`, `resultat_labo`, `fiche_ouverture_date`, `fiche_cloture_date`, `fiche_etape`, `pres_medicale`, `fiche_fk_users_id`) VALUES
(1, 1, 63, 13, '35', 'AnamnÃ¨se', 'Oui', NULL, NULL, '2022-09-15 20:11:43', '2022-09-15 20:11:43', '2', NULL, 2),
(2, 2, 70, 12, '20', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint, illum reprehenderit? Asperiores aut impedit quas vitae, in possimus quis at?', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint, illum reprehenderit? Asperiores aut impedit quas vitae, in possimus quis at?', 'Lorem ipsum dolor, sit amet consectus quis at?', 'hemato_Hbg = 12 <br>parasito_selles_exam_direct = 21 <br>parasito_PVUF = 12 <br>bio_nature_produit = 12 <br><span>Resultats autres examens : </span><br>resultats autres examens', '2022-09-20 16:54:44', '2022-09-20 17:03:56', '3', 'Lorem ipsum dolor, sit amet consectetur ', 2);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_dossier_numero` varchar(50) DEFAULT NULL,
  `patient_fiche_numero` varchar(50) DEFAULT NULL,
  `patient_nom` varchar(100) DEFAULT NULL,
  `patient_postnom` varchar(100) DEFAULT NULL,
  `patient_prenom` varchar(100) DEFAULT NULL,
  `patient_date_naissance` date DEFAULT NULL,
  `patient_sexe` varchar(10) DEFAULT NULL,
  `patient_adresse` text,
  `patient_statut` varchar(100) DEFAULT NULL,
  `fk_patient_conv` int(11) DEFAULT NULL,
  `patient_affiliation` varchar(100) DEFAULT NULL,
  `patient_code_convention` varchar(100) DEFAULT NULL,
  `patient_occupation` varchar(100) DEFAULT NULL,
  `fk_users_id` int(11) NOT NULL,
  `patient_save_date` datetime NOT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_dossier_numero`, `patient_fiche_numero`, `patient_nom`, `patient_postnom`, `patient_prenom`, `patient_date_naissance`, `patient_sexe`, `patient_adresse`, `patient_statut`, `fk_patient_conv`, `patient_affiliation`, `patient_code_convention`, `patient_occupation`, `fk_users_id`, `patient_save_date`) VALUES
(1, '', '', 'MUBAKE', 'WALIANABENGI', 'Jonathan', '2022-09-08', 'M', 'MARCHE 21', 'simple', 0, '0', '0', '0', 1, '2022-09-15 19:52:37'),
(2, '', '', 'Mbula', 'Muvudizi', 'Adonai', '2010-10-20', 'M', 'Ngiri-ngiri', 'simple', 0, '0', '0', '0', 1, '2022-09-20 16:53:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `payement`
--

INSERT INTO `payement` (`pay_id`, `pay_montant`, `num_facture`, `pay_date`, `pay_motif`, `pay_description`, `utilise`, `fk_pay_patient_id`, `fk_pay_exam_id`, `fk_pay_user_id`) VALUES
(1, '10000', '15093992022', '2022-09-15 19:59:56', '1', '', 1, 1, 0, 1),
(2, '10000', '15095652022', '2022-09-15 20:00:44', '1', '', 1, 1, 0, 1),
(3, '10000', '15093452022', '2022-09-15 20:02:54', '1', '', 1, 1, 0, 1),
(4, '10000', '15098122022', '2022-09-15 20:03:58', '1', '', 1, 1, 0, 1),
(5, '10000', '15097202022', '2022-09-15 20:09:16', '1', '', 1, 1, 0, 1),
(6, '2000', '15094062022', '2022-09-15 20:29:16', '2', '', 0, 0, 1, 1),
(7, '10000', '20091302022', '2022-09-20 16:53:35', '1', '', 1, 2, 0, 1),
(8, '10250', '20091682022', '2022-09-20 16:58:36', '2', '', 1, 0, 2, 1);

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
-- Structure de la table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `pk_prescription` int(11) NOT NULL,
  `medicament` varchar(225) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `posologie` varchar(255) NOT NULL,
  `fk_diagnostic` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Structure de la table `resultat_labo_demande`
--

DROP TABLE IF EXISTS `resultat_labo_demande`;
CREATE TABLE IF NOT EXISTS `resultat_labo_demande` (
  `pk_resultat_labo_demande` int(11) NOT NULL,
  `note_resultat` varchar(225) NOT NULL,
  `fk_agent` int(11) NOT NULL,
  `fk_demande` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `signe_vitaux`
--

DROP TABLE IF EXISTS `signe_vitaux`;
CREATE TABLE IF NOT EXISTS `signe_vitaux` (
  `pk_signe_vitaux` int(11) NOT NULL AUTO_INCREMENT,
  `poids` varchar(20) NOT NULL,
  `tension` varchar(20) NOT NULL,
  `temperature` varchar(20) NOT NULL,
  PRIMARY KEY (`pk_signe_vitaux`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `signe_vitaux`
--

INSERT INTO `signe_vitaux` (`pk_signe_vitaux`, `poids`, `tension`, `temperature`) VALUES
(5, '70', '14', '33');

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
-- Structure de la table `transfert_visite`
--

DROP TABLE IF EXISTS `transfert_visite`;
CREATE TABLE IF NOT EXISTS `transfert_visite` (
  `pk_transfert_visite` int(11) NOT NULL AUTO_INCREMENT,
  `etat_visite` int(11) NOT NULL,
  `fk_agent` int(11) NOT NULL,
  `fk_visite` int(11) NOT NULL,
  PRIMARY KEY (`pk_transfert_visite`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `transfert_visite`
--

INSERT INTO `transfert_visite` (`pk_transfert_visite`, `etat_visite`, `fk_agent`, `fk_visite`) VALUES
(1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_facture`
--

DROP TABLE IF EXISTS `type_facture`;
CREATE TABLE IF NOT EXISTS `type_facture` (
  `pk_type_facture` int(11) NOT NULL,
  `nom_type` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `login`, `password`, `privilege`, `etat`, `agent_id`) VALUES
(1, 'nel7', 'nel', '1', 'actif', 3),
(2, 'wise', 'wise', '3', 'actif', 4),
(3, 'dan', 'dan', '4', 'actif', 3),
(4, 'glory', 'glory', '2', 'actif', 6),
(6, 'nel7luboya@gmail.com', '1234', '1', 'actif', 2),
(7, 'jonathan', '123456', '2', 'actif', 5);

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `pk_visite` int(11) NOT NULL AUTO_INCREMENT,
  `debut_visite` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fin_visite` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_patient` int(11) NOT NULL,
  PRIMARY KEY (`pk_visite`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`pk_visite`, `debut_visite`, `fin_visite`, `fk_patient`) VALUES
(3, '2022-10-07 16:08:04', '2022-10-07 16:08:04', 2);

-- --------------------------------------------------------

--
-- Structure de la table `visite_signe_vitaux`
--

DROP TABLE IF EXISTS `visite_signe_vitaux`;
CREATE TABLE IF NOT EXISTS `visite_signe_vitaux` (
  `pk_visite_signe_vitaux` int(11) NOT NULL AUTO_INCREMENT,
  `fk_signe_vitaux` int(11) NOT NULL,
  `fk_visite` int(11) NOT NULL,
  PRIMARY KEY (`pk_visite_signe_vitaux`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visite_signe_vitaux`
--

INSERT INTO `visite_signe_vitaux` (`pk_visite_signe_vitaux`, `fk_signe_vitaux`, `fk_visite`) VALUES
(2, 5, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
