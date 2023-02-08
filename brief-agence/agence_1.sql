-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 06 fév. 2023 à 15:50
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `ID` int(11) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Img` varchar(100) NOT NULL,
  `Dscr` varchar(100) NOT NULL,
  `Superficie` int(11) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `Montant` decimal(10,0) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`ID`, `Titre`, `Img`, `Dscr`, `Superficie`, `Adresse`, `Montant`, `Date`, `Type`) VALUES
(2, 'Appartement meublée', 'Appartmeuble.jpeg', 'Appartement meublée situé en plein centre ville ', 150, 'Tanger Castilla ', '5000', '2023-02-02', 'Location'),
(3, 'Villa semi finie', 'Villasemi.jpeg', 'Magnifique villa semi finie dans un quartier résidentiel ', 400, 'Tanger achakkar', '200000', '2023-02-02', 'Vente'),
(4, 'Appartement duplex', 'duplex.jpeg', 'Appartement située dans un quartier calme et proche de toutes les accommodations', 200, 'Tanger malabata', '150000', '2023-02-02', 'Vente'),
(5, 'Villa ', 'Villasurmer.jpeg', 'Magnifique villa vue sur mer  ', 450, 'Assilah', '400000', '2023-02-02', 'Vente'),
(6, 'Appartement ensoleillé', 'Appart.jpeg', 'Appartement spacieux situé dans un quartier résidentiel calme ', 200, 'Tanger Malabata', '200000', '2023-02-02', 'Vente'),
(7, 'Appartement vue sur mer', 'Appartluxe.jpeg', 'Appartement luxueux situé en plein centre ville, avec ascenseur et place parking dédiée', 350, 'Tanger Malabata', '8000', '2023-02-02', 'Location'),
(8, 'Villa vue sur mer', 'Villa.jpg', 'Magnifique villa pieds dans l\'eau pour location de vacances parfait pour un séjour en famille', 500, 'Assilah ', '3000', '2023-02-02', 'Location'),
(9, 'Appartement vue sur mer', 'Appartassilah.jpeg', 'Appartement spacieux pour location de vacances', 150, 'Assilah résidence le zéphyr', '2000', '2023-02-02', 'Location'),
(10, 'Studio ', 'Studio.jpeg', 'Studio très bien entretenue parfait pour les étudiants', 65, 'Tanger Aida village', '1500', '2023-02-02', 'Location'),
(11, 'Villa ', 'Villap.jpeg', 'Villa dans un quartier calme ', 500, 'Tanger achakkar', '500000', '2023-02-02', 'Vente'),
(12, 'Appartement meublée', 'Appart.jpeg', 'Appartement propre dans quartier calme proche du centre ville', 100, 'Tanger Iberia', '4000', '2023-02-02', 'Location'),
(13, 'Appartement ', 'Appartement.jpeg', 'Appartement dans quartier résidentiel, bien ensoleillé et proche du centre ville.', 100, 'Tanger Mssalah', '150000', '2023-02-02', 'Vente');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
