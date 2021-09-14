-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 25 jan. 2020 à 22:07
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `perezlacoste`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID_Categorie` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom_Categorie` text COLLATE utf8_bin NOT NULL,
  `Logo_Categorie` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_Categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`ID_Categorie`, `Nom_Categorie`, `Logo_Categorie`) VALUES
(1, 'FPS', 'images/categories/fps.png'),
(2, 'Action', 'images/categories/action.png'),
(3, 'Sport', 'images/categories/sport.jpg'),
(4, 'Simulation', 'images/categories/simulation.png'),
(5, 'Multijoueur', 'images/categories/multijoueur.jpg'),
(6, 'Coopération', 'images/categories/cooperation.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `ID_Client` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom_Client` text COLLATE utf8_bin NOT NULL,
  `Prenom_Client` text COLLATE utf8_bin NOT NULL,
  `Adresse_Client` text COLLATE utf8_bin NOT NULL,
  `CP_Client` text COLLATE utf8_bin NOT NULL,
  `Ville_Client` text COLLATE utf8_bin NOT NULL,
  `DDN_Client` date NOT NULL,
  `Login_Client` text COLLATE utf8_bin NOT NULL,
  `Empreinte_Client` text COLLATE utf8_bin NOT NULL,
  `Sel_Client` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_Client`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`ID_Client`, `Nom_Client`, `Prenom_Client`, `Adresse_Client`, `CP_Client`, `Ville_Client`, `DDN_Client`, `Login_Client`, `Empreinte_Client`, `Sel_Client`) VALUES
(55, 'a', 'a', 'a', 'a', 'a', '1999-09-20', 'test', '61428b2c703df3d5f8277ff92f0cba22f439c6561aa4c0fedf962ed40fc33367', 'CqxynxunV'),
(0, 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', '2019-01-01', 'Admin', '16dc442639bf68f73bad8c3342f7d8cba18a94c287e2841971f1753a77c2b59e', 'beqicheuWH');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `ID_Commande` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Client` bigint(20) NOT NULL,
  `Date_Commande` bigint(20) NOT NULL,
  PRIMARY KEY (`ID_Commande`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`ID_Commande`, `ID_Client`, `Date_Commande`) VALUES
(16, 55, 1579989925),
(15, 55, 1579970190);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `ID_Commentaire` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom_Commentaire` text COLLATE utf8_bin NOT NULL,
  `Mail_Commentaire` text COLLATE utf8_bin NOT NULL,
  `Commentaire_Commentaire` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_Commentaire`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`ID_Commentaire`, `Nom_Commentaire`, `Mail_Commentaire`, `Commentaire_Commentaire`) VALUES
(1, 'a', 'a', 'a'),
(2, 'a', 'a', 'a'),
(3, 'a', 'a', 'a'),
(4, 'a', 'a', 'a'),
(5, 'a', 'a', 'a'),
(6, 'a', 'a', 'a'),
(7, 'a', 'a', 'a'),
(8, 'a', 'a', 'a'),
(9, 'a', 'a', 'a'),
(10, 'a', 'a', 'a'),
(11, 'a', 'a', 'a'),
(12, 'b', 'b', 'b'),
(13, 'b', 'b', 'b'),
(14, 'grefvdc', 'refvdc', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff'),
(15, 'moi ', 'je ', 'suis');

-- --------------------------------------------------------

--
-- Structure de la table `detailscommandes`
--

DROP TABLE IF EXISTS `detailscommandes`;
CREATE TABLE IF NOT EXISTS `detailscommandes` (
  `ID_DetailCommande` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Commande` bigint(20) NOT NULL,
  `ID_Produit` bigint(20) NOT NULL,
  PRIMARY KEY (`ID_DetailCommande`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `detailscommandes`
--

INSERT INTO `detailscommandes` (`ID_DetailCommande`, `ID_Commande`, `ID_Produit`) VALUES
(26, 16, 2),
(25, 16, 2),
(24, 16, 2),
(23, 16, 2),
(22, 16, 19),
(21, 15, 17);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `ID_Note` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_Client` bigint(20) NOT NULL,
  `ID_Produit` bigint(20) NOT NULL,
  `Valeur_Note` int(11) NOT NULL,
  `Commentaire_Note` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_Note`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`ID_Note`, `ID_Client`, `ID_Produit`, `Valeur_Note`, `Commentaire_Note`) VALUES
(7, 55, 17, 3, 'Trop bien!!!'),
(6, 1, 1, 5, 'ervfcd');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `ID_Produit` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom_Produit` text COLLATE utf8_bin NOT NULL,
  `Prix_Produit` decimal(10,2) NOT NULL,
  `ID_Categorie` bigint(20) NOT NULL,
  `Image_Produit` text COLLATE utf8_bin NOT NULL,
  `Description_Produit` text COLLATE utf8_bin NOT NULL,
  `Date_Produit` date NOT NULL,
  PRIMARY KEY (`ID_Produit`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`ID_Produit`, `Nom_Produit`, `Prix_Produit`, `ID_Categorie`, `Image_Produit`, `Description_Produit`, `Date_Produit`) VALUES
(1, 'Battlefield 3', '30.00', 1, 'images/jeux/fps/battlefield-3.jpg', 'Battlefield 3 est un jeu vidéo de tir à la première personne édité par Electronic Arts et développé par DICE, partie intégrante de la série Battlefield, commercialisé le 25 octobre 2011 en Amérique du Nord et le 27 octobre 2011 en Europe ', '2011-10-27'),
(2, 'Battlefield: Bad Company 2', '5.00', 1, 'images/jeux/fps/battlefield-bad-company-2.jpg', 'Battlefield: Bad Company 2 est un jeu vidéo développé par DICE et édité par Electronic Arts. Il s’agit d’un jeu de tir à la première personne, publié en mars 2010 sur Xbox 360, PlayStation 3 et Windows.', '2010-03-02'),
(3, 'BioShock Infinite', '40.00', 1, 'images/jeux/fps/bioshock-infinite.jpg', 'BioShock Infinite est un jeu vidéo d\'aventure en vue à la première personne développé par Irrational Games et édité par 2K Games, sorti le 26 mars 2013 sur PC, PlayStation 3 et Xbox 360. ', '2013-03-26'),
(4, 'Borderlands 3', '49.99', 1, 'images/jeux/fps/borderlands-3.jpg', 'Borderlands 3 est un jeu vidéo de tir à la première personne développé par Gearbox Software et édité par 2K Games. Il est sorti le 13 septembre 2019 sur PC, PlayStation 4 et Xbox One. Il s\'agit du quatrième jeu principal de la série Borderlands.', '2019-09-13'),
(5, 'The Last of Us', '15.45', 2, 'images/jeux/action/last-of-us.jpg', 'The Last of Us est un jeu vidéo d’action-aventure en vue à la troisième personne de type survival horror développé par Naughty Dog et édité par Sony Computer Entertainment sur PlayStation 3, sorti le 14 juin 2013.', '2013-06-14'),
(6, 'The Last of Us Part II', '75.15', 2, 'images/jeux/action/last-of-us-2.jpg', 'The Last of Us Part II est un jeu vidéo d’action-aventure en vue à la troisième personne de type survie développé par Naughty Dog et édité par Sony Computer Entertainment qui sortira le 29 mai 2020 uniquement sur PlayStation 4.', '2020-05-29'),
(7, 'Prince of Persia : Les Sables du temps', '4.55', 2, 'images/jeux/action/prince-of-persia-sables-du-temps.jpg', 'Prince of Persia : Les Sables du temps est un jeu vidéo développé et édité par Ubisoft. Mélange de jeu de plates-formes et d’action, il est sorti en 2003 sur PC, PlayStation 2, Xbox et GameCube, puis a été adapté sur Game Boy Advance et téléphone mobile. Il est le quatrième jeu de la franchise Prince of Persia.', '2003-10-28'),
(8, 'Resident Evil 4', '12.35', 2, 'images/jeux/action/Resident-Evil-4.jpg', 'Resident Evil 4, sorti au Japon sous le nom Biohazard 4, est un jeu vidéo de tir à la troisième personne de type survival horror, développé par Capcom Production Studio 4 et édité par l\'entreprise japonaise Capcom. L\'histoire se déroule six ans après les événements de Resident Evil 2. ', '2005-01-11'),
(9, 'Splinter Cell', '8.55', 2, 'images/jeux/action/Splinter_Cell.jpg', 'Splinter Cell est une série de jeux vidéo développée et éditée par Ubisoft. Celle-ci raconte l\'histoire de Sam Fisher, agent spécial du groupe secret d\'Echelon 3 à la NSA.', '2002-11-28'),
(10, 'Mario et Sonic aux Jeux olympiques d\'hiver', '20.00', 3, 'images/jeux/sport/mario-sonic-JO.jpg', 'Mario et Sonic aux Jeux olympiques d\'hiver connu sous le nom de \"Mario & Sonic at the Vancouver Olympics\" au Japon est un jeu de sport officiel des Jeux olympiques d\'hiver de 2010 développé par Nintendo SPD et Sega Sports R&D sous la supervision de Nintendo et Sega, sorti le 13 octobre 2009 sur Wii et Nintendo DS.', '2009-10-13'),
(11, 'Steep', '25.00', 3, 'images/jeux/sport/Steep.jpg', 'Steep est un jeu vidéo de sports extrêmes ayant pour cadre les Alpes et les Rocheuses d\'Alaska, se déroulant en monde ouvert, développé par Ubisoft Annecy et édité par Ubisoft, sorti le 2 décembre 2016 sur Microsoft Windows, PlayStation 4 et Xbox One.', '2016-12-02'),
(12, 'Wii Sports', '3.00', 3, 'images/jeux/sport/wii-sports.jpg', 'Wii Sports est un jeu vidéo de sport développé et édité par Nintendo comme titre de lancement pour la console de jeux vidéo Wii. Il est commercialisé dans un premier temps en Amérique du Nord le 19 novembre 2006, et sort le mois suivant au Japon, en Australie et en Europe.', '2006-11-19'),
(13, 'Combat Flight Simulator 2', '11.20', 4, 'images/jeux/simulation/combat-flight-simulator2.jpg', 'Combat Flight Simulator 2 est un simulateur de vol de combat développé et édité par Microsoft en 2000 sous Windows. C\'est le second volet de la série de jeux débutée en 1998.', '2000-10-13'),
(14, 'Farming Simulator', '10.00', 4, 'images/jeux/simulation/farming-simulator.jpg', 'Farming Simulator est une série de jeux vidéo de simulation développés par la société suisse Giants Software et édités par la société française Focus Home Interactive.', '2018-11-19'),
(15, 'Flight Simulator X', '14.60', 4, 'images/jeux/simulation/flight-simulator.jpg', 'Flight Simulator X est un simulateur de vol de la série Flight Simulator pour PC développé par ACES Studio et commercialisé en 2006. Ce jeu propose au joueur, à travers diverses missions, de se mettre dans la peau d\'un pilote de ligne, d\'un cascadeur aérien ou encore d\'un contrôleur.', '2006-10-13'),
(16, 'Destiny 2: Forsaken', '80.00', 5, 'images/jeux/multijoueur/destiny.jpg', 'Destiny 2 est un jeu vidéo de tir en vue à la première personne multijoueur développé par Bungie Studios et édité par Activision, sorti le 6 septembre 2017 sur PlayStation 4 et Xbox One et le 24 octobre sur Microsoft Windows. Il est également prévu pour novembre 2019 sur Stadia.', '2017-09-06'),
(17, 'New Super Mario Bros. Wii', '14.00', 5, 'images/jeux/multijoueur/mario-bros.jpg', 'New Super Mario Bros. Wii est un jeu vidéo de plates-formes sorti fin 2009 sur Wii. C\'est le premier jeu de la série des Super Mario à proposer un mode multijoueur jusqu\'à 4 joueurs et le « Super Guide », un système d\'aide pour le joueur.', '2009-11-11'),
(18, 'Mario Kart Wii', '6.00', 5, 'images/jeux/multijoueur/mario-kart.jpg', 'Mario Kart Wii est un jeu vidéo de course développé par Nintendo EAD et édité par Nintendo. Il est sorti sur la Wii le 10 avril 2008 au Japon, le 11 avril 2008 Europe, et le 24 avril 2008 en Australie et en Amérique du Nord.', '2008-04-24'),
(19, 'Tom Clancy\'s Rainbow Six: Siege', '25.00', 5, 'images/jeux/multijoueur/rainbow-six-siege.jpg', 'Tom Clancy\'s Rainbow Six: Siege est un jeu vidéo de tir tactique développé par Ubisoft Montréal et édité par Ubisoft, sorti le 1ᵉʳ décembre 2015 sur PlayStation 4, Xbox One et Windows.', '2015-12-01'),
(20, 'Broforce', '11.00', 6, 'images/jeux/cooperation/Broforce.jpg', 'Broforce est un jeu vidéo de plates-formes en 2D développé par le studio sud-africain Free Lives et édité par Devolver Digital. Il était disponible en accès anticipé depuis le 7 avril 2014 sur Steam, et est sorti le 15 octobre 2015.', '2015-10-15'),
(21, 'Portal 2', '22.00', 6, 'images/jeux/cooperation/Portal-2.jpg', 'Portal 2 est un jeu vidéo de plates-formes et de réflexion en vue subjective développé et édité par Valve. Le jeu paraît sur Windows, OS X, PlayStation 3 et Xbox 360 le 19 avril 2011 en Amérique du Nord, et le surlendemain pour le reste du monde. La version pour Linux a été mise en bêta-test le 25 février 2014.', '2011-04-18'),
(22, 'Wolfenstein Young Blood', '45.00', 1, 'images/jeux/fps/wolfenstein_youngblood.png', 'Wolfenstein: Youngblood est un jeu vidéo de tir à la première personne développé par MachineGames et Arkane Studios, et édité par Bethesda Softworks le 26 juillet 2019 sur PC, PlayStation 4, Xbox One et Nintendo Switch.', '2019-07-25'),
(23, 'Company of heroes', '12.00', 2, 'images/jeux/action/company_of_heroes.jpg', 'Company of Heroes est un jeu de stratégie en temps réel développé par Relic Entertainment et édité par THQ sur PC, sorti en septembre 2006. Le moteur permet des détails de qualité cinématographique dans un environnement respectant les lois de la physique et totalement destructible.', '2006-09-12'),
(24, 'Wolfenstein The New Order', '22.00', 1, 'images/jeux/fps/wolfenstein_the_new_order.jpg', 'Wolfenstein: The New Order est un jeu de tir à la première personne sorti le 20 mai 2014, développé par MachineGames et édité par Bethesda Softworks. Il utilise également le moteur de jeu id Tech 5 conçu par id Software.', '2014-05-20'),
(25, 'Mario & Sonic aux Jeux Olympiques', '32.00', 3, 'images/jeux/sport/mario_sonic_jo.jpg', 'Mario et Sonic aux Jeux olympiques est un jeu vidéo de sport développé par Nintendo SPD et Sega Sports R&D. Il est publié par Nintendo et Sega.', '2007-11-06'),
(26, 'Need For Speed Payback', '30.00', 3, 'images/jeux/sport/need_for_speed.jpg', 'Need For Speed est une série de jeux vidéo de courses de voitures éditée par Electronic Arts et apparue en 1994. Le premier épisode sort sur les consoles 3DO puis PlayStation et Saturn.', '2017-11-10'),
(27, 'F-ZERO', '14.23', 3, 'images/jeux/sport/f-zero.jpg', 'F-Zero est un jeu vidéo de course futuriste développé et édité par Nintendo pour la Super Nintendo. Il est sorti au Japon le 21 novembre 1990, en Amérique du Nord le 23 août 1991 et en Europe le 11 avril 1992.', '1990-11-21'),
(28, 'Euro Truck Simulator', '5.00', 4, 'images/jeux/simulation/euro-truck-simulator.jpg', 'Euro Truck Simulator est un jeu vidéo de simulation de conduite de poids lourds, développé par la société tchèque SCS Software et sorti en 2008.', '2008-08-29'),
(29, 'European Ship Simulator', '31.00', 4, 'images/jeux/simulation/european_ship_simulator.jpg', 'Ship Simulator est un jeu de simulation maritime créé par la société hollandaise VSTEP et édité par Lighthouse Interactive. Dans la version initiale parue en 2006, le joueur peut se mettre d\'un des différents navires suivants : Le paquebot transatlantique Titanic, un porte-conteneurs, un yacht de luxe.', '2006-08-15'),
(30, 'Professional Construction : The simulation', '20.00', 4, 'images/jeux/simulation/construction_simulator.jpg', 'Immergez-vous dans le monde vaste et fascinant de la construction de routes ! Vivez la vie des professionnels de la construction et utilisez des équipements et des engins de travaux publics. Entrez dans un scénario à ciel ouvert pour achever une grande variété de missions. Une large gamme d’équipements de travaux publics n’attendent que vous. Utilisez le fraisage de revêtement, des bétonnières, des camions à benne, des mini excavatrices pratiques et bien plus !', '2018-06-15'),
(31, 'Monster Hunter World Iceborn', '65.00', 5, 'images/jeux/multijoueur/monster-hunter-world-iceborne.jpg', 'Monster Hunter World : Iceborne est la première extension pour le RPG de Capcom Monster Hunter World. Annoncée pour l\'automne 2019, elle s’annonce massive avec une toute nouvelle histoire se déroulant après les événements du jeu, des nouveaux rangs de chasse et des nouveaux monstres comme le Nargacuga.', '2019-09-06'),
(32, 'Sea Of Thieves', '29.00', 5, 'images/jeux/multijoueur/sea_of_thieves.jpg', 'Sea of Thieves est un jeu vidéo d\'action-aventure développé par Rare et édité par Microsoft Studios, sorti le 20 mars 2018 sur Xbox One et Windows 10.', '2018-01-24'),
(33, 'Borderlands', '9.00', 6, 'images/jeux/cooperation/borderlands.jpg', 'Borderlands est un jeu vidéo mélangeant RPG et tir à la première personne développé par Gearbox Software pour l\'éditeur américain 2K Games. Il est sorti sur PlayStation 3, Xbox 360, Windows, Mac et Linux en octobre 2009. Il possède quatre contenus additionnels téléchargeables : The Zombie Island Of Dr.', '2009-08-20'),
(34, 'Left 4 Dead', '16.00', 6, 'images/jeux/cooperation/left_4_dead', 'Left 4 Dead, aussi abrégé L4D, est un jeu vidéo coopératif de tir à la première personne sorti en novembre 2008 développé par Turtle Rock Studios. Il met en scène une équipe de quatre survivants qui traversent un monde rempli de zombies appelés « infectés ».', '2008-11-17'),
(35, 'Pay Day', '6.00', 6, 'images/jeux/cooperation/pay_day.jpg', 'Payday: The Heist est un jeu vidéo, en mode coopératif, de tir à la première personne téléchargeable développé par Overkill Software et publié par Sony Online Entertainment. Il est commercialisé le 18 octobre 2011 sur console PlayStation 3 en Amérique du Nord et le 2 novembre 2011 en Europe.', '2011-08-18'),
(36, 'Rabbids Invasion', '14.00', 6, 'images/jeux/cooperation/rabbids_invasion.jpg', 'Bwaaah !!! Un vent de folie souffle sur la planète bleue. Les Lapins Crétins envahissent la Terre. Ils sont partout, fouillant les poubelles, tripotant tout !', '2013-08-03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
