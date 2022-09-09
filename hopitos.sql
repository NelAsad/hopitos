-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 29 avr. 2021 à 11:36
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hopitos`
--

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

CREATE TABLE `configs` (
  `config_id` int(11) NOT NULL,
  `config_nom` varchar(50) NOT NULL,
  `config_val` varchar(50) NOT NULL,
  `config_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `depense` (
  `depense_id` int(11) NOT NULL,
  `depense_motif` varchar(200) NOT NULL,
  `depense_montant` varchar(10) NOT NULL,
  `depense_datetime` datetime NOT NULL,
  `fk_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `examen` (
  `exam_id` int(11) NOT NULL,
  `fk_fiche_id` int(11) NOT NULL,
  `fk_patient_id` int(11) NOT NULL,
  `fk_demandeur_id` int(11) NOT NULL,
  `fk_laborantin_id` int(11) DEFAULT NULL,
  `exam_date_demande` datetime NOT NULL DEFAULT current_timestamp(),
  `exam_date_reponse` datetime NOT NULL,
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
  `autres_examens` text NOT NULL,
  `autres_examens_resultats` text NOT NULL,
  `exam_etape` varchar(10) NOT NULL DEFAULT '1',
  `motif_declasse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(40, 9, 2, 1, NULL, '2020-06-14 10:10:14', '0000-00-00 00:00:00', 'ncdjd', 'x_dem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '1', NULL),
(41, 15, 8, 2, 3, '2021-04-25 22:17:53', '2021-04-26 10:33:03', 'conscience service', '12', '12', '', '', '', '', '', '', '', '', '', '12', '12', '', '', '', '12', '', '', '', '', '', '', '', '', '', '', '', '12', '', '', '', '', '', '', '', 'voici les autres examens', 'les resultats des examans', '2', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

CREATE TABLE `fiche` (
  `fiche_id` int(11) NOT NULL,
  `fk_patient_id` int(11) NOT NULL,
  `poids` double NOT NULL,
  `tension` double NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `symptomes` text NOT NULL,
  `diagnostic` text NOT NULL,
  `traitement` text NOT NULL,
  `resultat_labo` text NOT NULL,
  `fiche_ouverture_date` datetime NOT NULL,
  `fiche_cloture_date` datetime NOT NULL,
  `fiche_etape` varchar(50) NOT NULL DEFAULT '1',
  `pres_medicale` text NOT NULL,
  `fiche_fk_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(13, 7, 0, 0, '', '', '', '', '', '2020-06-10 19:44:23', '0000-00-00 00:00:00', '1', '', 1),
(14, 7, 4, 4, '', '4', '4', '', 'is_widal_TO = mm \n <br>', '2020-06-10 20:45:34', '0000-00-00 00:00:00', '2', '', 1),
(15, 8, 12, 12, '12', 'nckdjcndjkcndjkc\ncdnkcndjcnjkdc\ncndjcndskcjsdc', 'vnfkvnjkjvn\nvnfkvfkvndfjkv\nvdfkvnvjfkv\nvndfkvnjfvnjdf', 'mon traitement est la', '', '2021-04-25 22:09:35', '2021-04-26 10:36:31', '3', 'Les prescriptions sont la', 2);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_dossier_numero` varchar(50) NOT NULL,
  `patient_fiche_numero` varchar(50) NOT NULL,
  `patient_nom` varchar(100) NOT NULL,
  `patient_postnom` varchar(100) NOT NULL,
  `patient_prenom` varchar(100) NOT NULL,
  `patient_date_naissance` date NOT NULL,
  `patient_sexe` varchar(10) NOT NULL,
  `patient_adresse` text NOT NULL,
  `patient_statut` varchar(100) NOT NULL,
  `fk_patient_conv` int(11) NOT NULL,
  `patient_affiliation` varchar(100) DEFAULT NULL,
  `patient_code_convention` varchar(100) DEFAULT NULL,
  `patient_occupation` varchar(100) DEFAULT NULL,
  `fk_users_id` int(11) NOT NULL,
  `patient_save_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 'GM1', 'GMF1', 'Tshientu', 'Mputu', 'Glodi', '2001-06-06', 'M', 'mont ngagula', 'simple', 0, '', '', '', 1, '2021-04-21 11:40:18');

-- --------------------------------------------------------

--
-- Structure de la table `payement`
--

CREATE TABLE `payement` (
  `pay_id` int(11) NOT NULL,
  `pay_montant` varchar(10) NOT NULL,
  `num_facture` varchar(20) NOT NULL,
  `pay_date` datetime NOT NULL,
  `pay_motif` varchar(5) NOT NULL,
  `pay_description` text NOT NULL,
  `utilise` int(11) NOT NULL,
  `fk_pay_patient_id` int(11) NOT NULL,
  `fk_pay_exam_id` int(11) NOT NULL,
  `fk_pay_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `payement`
--

INSERT INTO `payement` (`pay_id`, `pay_montant`, `num_facture`, `pay_date`, `pay_motif`, `pay_description`, `utilise`, `fk_pay_patient_id`, `fk_pay_exam_id`, `fk_pay_user_id`) VALUES
(1, '10000', '25048232021', '2021-04-25 22:07:21', '1', '', 0, 3, 0, 1),
(2, '10000', '25047842021', '2021-04-25 22:07:39', '1', '', 1, 8, 0, 1),
(3, '10000', '25046722021', '2021-04-25 22:26:26', '1', '', 0, 8, 0, 1),
(4, '17000', '26041912021', '2021-04-26 10:23:12', '2', '', 1, 0, 41, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `produit_id` int(11) NOT NULL,
  `produit_nom` varchar(50) NOT NULL,
  `produit_dosage` varchar(50) NOT NULL,
  `produit_dosage_unite` varchar(10) NOT NULL,
  `produit_pv` varchar(10) NOT NULL,
  `produit_qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_nom`, `produit_dosage`, `produit_dosage_unite`, `produit_pv`, `produit_qte`) VALUES
(1, 'Quinine', '500', 'mg', '2000', 5);

-- --------------------------------------------------------

--
-- Structure de la table `sortie_produit`
--

CREATE TABLE `sortie_produit` (
  `sortie_produit_id` int(11) NOT NULL,
  `sortie_produit_qte` int(11) NOT NULL,
  `sortie_produit_datetime` datetime NOT NULL,
  `sortie_produit_fk_produit_id` int(11) NOT NULL,
  `sortie_produit_fk_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `user_titre` varchar(100) NOT NULL,
  `user_poste` varchar(100) NOT NULL,
  `user_sexe` varchar(10) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privilege` varchar(50) NOT NULL,
  `etat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `prenom`, `nom`, `user_titre`, `user_poste`, `user_sexe`, `login`, `password`, `privilege`, `etat`) VALUES
(1, 'Elysee', 'Asad', 'Docteur', 'Administrateur', 'm', 'nel7', 'nel', '1', 'actif'),
(2, 'Yannick', 'Moyo', 'medecin generaliste', 'consultant', 'm', 'wise', 'wise', '3', 'actif'),
(3, 'Daniel', 'Mwema', 'virologue', 'laborantin', 'm', 'dan', 'dan', '4', 'actif'),
(4, 'Glory', 'Lisole', 'infirmier', 'réceptionniste ', 'm', 'glory', 'glory', '2', 'actif');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `configs`
--
ALTER TABLE `configs`
  ADD UNIQUE KEY `config_id` (`config_id`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`depense_id`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`exam_id`);

--
-- Index pour la table `fiche`
--
ALTER TABLE `fiche`
  ADD PRIMARY KEY (`fiche_id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Index pour la table `payement`
--
ALTER TABLE `payement`
  ADD PRIMARY KEY (`pay_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`produit_id`);

--
-- Index pour la table `sortie_produit`
--
ALTER TABLE `sortie_produit`
  ADD PRIMARY KEY (`sortie_produit_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `configs`
--
ALTER TABLE `configs`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `depense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `examen`
--
ALTER TABLE `examen`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `fiche`
--
ALTER TABLE `fiche`
  MODIFY `fiche_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `payement`
--
ALTER TABLE `payement`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `produit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `sortie_produit`
--
ALTER TABLE `sortie_produit`
  MODIFY `sortie_produit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
