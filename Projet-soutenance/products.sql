-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 11 sep. 2019 à 16:03
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shoes`
--

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand` int(2) NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shoe_size` float NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `picture1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `brand`, `model`, `sku`, `shoe_size`, `color`, `price`, `picture1`, `picture2`, `picture3`) VALUES
(3, 1, 'SB Dunk Low Nasty Boys', '304292 610', 8, 'red', '690.00', 'img/shoes/304292 610_1.jpg', 'img/shoes/304292 610_2.jpg', 'img/shoes/304292 610_3.jpg'),
(4, 1, 'AIR MAX 1 PREMIUM CHERRYWOOD', '394805 600', 8, 'purple', '7650.00', 'img/shoes/394805 600_1.jpg', 'img/shoes/394805 600_2.jpg', 'img/shoes/394805 600_3.jpg'),
(5, 1, 'AIR MAX 1 PRM ATMOS', '512033 003', 12, 'green', '750.00', 'img/shoes/512033 003_1.jpg', 'img/shoes/512033 003_2.jpg', 'img/shoes/512033 003_3.jpg'),
(6, 3, 'PW HUMAN RACE NMD TR PHARRELL', 'ac7359', 5, 'black', '500.00', 'img/shoes/ac7359_1.jpg', 'img/shoes/ac7359_2.jpg', 'img/shoes/ac7359_3.jpg'),
(7, 3, 'NMD R1 BAPE BAPE', 'ba7326', 15, 'green', '1000.00', 'img/shoes/ba7326_1.jpg', 'img/shoes/ba7326_2.jpg', 'img/shoes/ba7326_3.jpg'),
(8, 3, 'NAKED X ULTRABOOST 1.0 WAVES NAKED', 'bb1141', 1, 'green', '290.00', 'img/shoes/bb1141_1.jpg', 'img/shoes/bb1141_2.jpg', 'img/shoes/bb1141_3.jpg'),
(9, 6, 'ALL-STAR 70S HI PLAY', '150204c', 13, 'black', '225.00', 'img/shoes/150204c_1.jpg', 'img/shoes/150204c_2.jpg', 'img/shoes/150204c_3.jpg'),
(10, 6, 'CHUCK 70 HI OFF WHITE', '161034c', 6, 'white', '2500.00', 'img/shoes/161034c_1.jpg', 'img/shoes/161034c_2.jpg', 'img/shoes/161034c_3.jpg'),
(11, 6, 'FASTBREAK HI NO EASY BUCKETS', '161327c', 3, 'green', '145.00', 'img/shoes/161327c_1.jpg', 'img/shoes/161327c_2.jpg', 'img/shoes/161327c_3.jpg'),
(12, 2, 'AIR JORDAN 12 RETRO GYM RED', '130690 601', 7, 'red', '375.00', 'img/shoes/130690 601_1.jpg', 'img/shoes/130690 601_2.jpg', 'img/shoes/130690 601_3.jpg'),
(13, 2, 'AIR JORDAN 4 RETRO BRED 2019 RELEASE', '308497 060', 9, 'black', '395.00', 'img/shoes/308497 060_1.jpg', 'img/shoes/308497 060_2.jpg', 'img/shoes/308497 060_3.jpg'),
(14, 2, 'AIR JORDAN 11 RETRO CONCORD 2018 RELEASE', '378037 100', 8, 'black', '500.00', 'img/shoes/378037 100_1.jpg', 'img/shoes/378037 100_2.jpg', 'img/shoes/378037 100_3.jpg'),
(15, 5, 'QUESTION MID WHITE PEARLIZED RED', '79757', 5, 'white', '250.00', 'img/shoes/79757_1.jpg', 'img/shoes/79757_2.jpg', 'img/shoes/79757_3.jpg'),
(16, 5, 'KENDRICK LAMAR X CLASSIC LEATHER LUX \'OLIVE\' \"OLIVE\"', 'bs7465', 3, 'green', '240.00', 'img/shoes/bs7465_1.jpg', 'img/shoes/bs7465_2.jpg', 'img/shoes/bs7465_3.jpg'),
(17, 5, 'CL NYLON 4HUNNID YG X 4 HUNNID', 'cn2664', 12, 'red', '275.00', 'img/shoes/cn2664_1.jpg', 'img/shoes/cn2664_2.jpg', 'img/shoes/cn2664_3.jpg'),
(18, 4, 'YEEZY BOOST 350 OXFORD TAN', 'aq2661', 7, 'grey', '1500.00', 'img/shoes/aq2661_1.jpg', 'img/shoes/aq2661_2.jpg', 'img/shoes/aq2661_3.jpg'),
(19, 4, 'YEEZY BOOST 350 TURTLE DOVE', 'aq4832', 6, 'grey', '2900.00', 'img/shoes/aq4832_1.jpg', 'img/shoes/aq4832_2.jpg', 'img/shoes/aq4832_3.jpg'),
(20, 4, 'YEEZY BOOST 700 WAVE RUNNER', 'b75571', 2, 'grey', '525.00', 'img/shoes/b75571_1.jpg', 'img/shoes/b75571_2.jpg', 'img/shoes/b75571_3.jpg'),
(22, 1, '0', 'ac7359', 5, 'white', '9999.00', 'img/shoes/ac7359_1.jpg', 'img/shoes/ac7359_2.jpg', 'img/shoes/ac7359_3.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
