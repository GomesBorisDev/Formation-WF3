-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 08 août 2019 à 11:26
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e_com`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `post` text NOT NULL,
  `date` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `post`, `date`, `id_user`) VALUES
(94, 'mince alors !\r\n', '2019-08-07 12:00:54', 1),
(96, 'lal la  allallallalal', '2019-08-07 12:26:46', 1),
(97, ' cezifjskqkfbj qkjlezfhulqsee', '2019-08-07 12:27:25', 1),
(98, 'on y voie deja plus clair!', '2019-08-07 12:28:37', 1),
(100, 'test 40 18', '0000-00-00 00:00:00', 2),
(118, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 14:43:44', 1),
(119, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 14:44:42', 1),
(120, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 14:48:29', 1),
(121, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 14:56:10', 1),
(122, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 15:00:49', 1),
(123, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 15:01:30', 1),
(124, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 15:02:30', 1),
(125, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 15:03:17', 1),
(126, 'ca, c\'est pas vraiment sur hein...', '2019-08-07 15:03:47', 1),
(127, 'youps', '2019-08-07 15:03:56', 1),
(128, 'youps', '2019-08-07 15:04:37', 1),
(129, 'youps', '2019-08-07 15:06:23', 1),
(130, 'alors', '2019-08-07 15:06:29', 1),
(131, 'alors', '2019-08-07 15:08:25', 1),
(132, 'alors', '2019-08-07 15:09:31', 1),
(133, 'alors', '2019-08-07 15:12:17', 1),
(134, 'alors', '2019-08-07 15:13:37', 1),
(135, 'alors', '2019-08-07 15:13:40', 1),
(136, 'alors', '2019-08-07 15:14:25', 1),
(137, 'alors', '2019-08-07 15:15:22', 1),
(170, 'ezeze', '2019-08-07 16:35:46', 1),
(171, 'ezeze', '2019-08-07 16:39:14', 1),
(172, 'ezeze', '2019-08-07 16:40:48', 1),
(173, 'ezeze', '2019-08-07 16:40:59', 1),
(174, 'ezeze', '2019-08-07 16:41:10', 1),
(175, 'ezeze', '2019-08-07 16:41:26', 1),
(176, 'ezeze', '2019-08-07 16:42:11', 1),
(177, 'ezeze', '2019-08-07 16:42:56', 1),
(178, 'ezeze', '2019-08-07 16:44:08', 1),
(179, 'ezeze', '2019-08-07 16:50:23', 1),
(180, 'test 56 830', '0000-00-00 00:00:00', 2),
(181, 'dgbcfghch\r\n', '2019-08-07 17:09:36', 1),
(182, 'dgbcfghch\r\n', '2019-08-07 17:09:49', 1),
(183, 'dgbcfghch\r\n', '2019-08-07 17:10:26', 1),
(184, 'sdffdsfsdf', '2019-08-07 17:10:30', 1),
(185, 'gukiufigyj', '2019-08-07 17:10:39', 1),
(186, 'gukiufigyj', '2019-08-07 17:10:55', 1),
(187, 'gukiufigyj', '2019-08-07 17:11:32', 1),
(188, 'ghfhgfhf', '2019-08-07 17:11:37', 1),
(189, 'ghfhgfhf', '2019-08-07 17:17:32', 1),
(190, 'ghfhgfhf', '2019-08-07 17:17:50', 1),
(191, 'ghfhgfhf', '2019-08-07 17:18:40', 1),
(192, 'ghfhgfhf', '2019-08-07 17:20:36', 1),
(193, 'ghfhgfhf', '2019-08-07 17:20:49', 1),
(194, '564545', '2019-08-07 17:21:52', 1),
(195, 'kooplop; ', '2019-08-07 17:22:25', 1),
(196, 'kooplop; ', '2019-08-07 17:23:00', 1),
(197, 'kooplop; ', '2019-08-07 17:23:40', 1),
(198, 'kooplop; ', '2019-08-07 17:23:58', 1),
(199, 'kooplop; ', '2019-08-07 17:25:00', 1),
(200, 'bonjour à tous !', '2019-08-08 09:51:31', 2),
(201, 'coucou végéta !', '2019-08-08 09:52:00', 1),
(202, 'bonjour à tous !', '2019-08-08 09:54:45', 2),
(203, 'bonjour à tous !', '2019-08-08 09:55:04', 2),
(204, 'bonjour à tous !', '2019-08-08 09:57:00', 2),
(205, 'bonjour à tous !', '2019-08-08 09:57:12', 2),
(206, 'bonjour à tous !', '2019-08-08 09:57:25', 2),
(207, 'bonjour à tous !', '2019-08-08 09:57:36', 2),
(208, 'bonjour à tous !', '2019-08-08 09:58:11', 2),
(209, 'bonjour à tous !', '2019-08-08 10:01:40', 2),
(210, 'bonjour à tous !', '2019-08-08 10:01:57', 2),
(211, 'bonjour à tous !', '2019-08-08 10:03:01', 2),
(212, 'bonjour à tous !', '2019-08-08 10:03:47', 2),
(213, 'bonjour à tous !', '2019-08-08 10:05:08', 2),
(214, 'bonjour à tous !', '2019-08-08 10:05:47', 2),
(215, 'bonjour à tous !', '2019-08-08 10:06:31', 2),
(216, 'bonjour à tous !', '2019-08-08 10:09:08', 2),
(217, 'bonjour à tous !', '2019-08-08 10:09:35', 2),
(218, 'bonjour à tous !', '2019-08-08 10:13:44', 2),
(219, 'bonjour à tous !', '2019-08-08 10:14:53', 2),
(220, 'bonjour à tous !', '2019-08-08 10:15:15', 2),
(221, 'send a message\r\n', '2019-08-08 10:17:33', 2),
(222, 'send a message\r\n', '2019-08-08 10:18:08', 2),
(223, 'jhuyjhuyuy_uy_uy_u_yuyj_', '0000-00-00 00:00:00', 1),
(224, '85*858*58*58', '2019-08-08 10:18:57', 2),
(225, '85*858*58*58', '2019-08-08 10:19:06', 2),
(226, '85*858*58*58', '2019-08-08 10:21:38', 2),
(227, '85*858*58*58', '2019-08-08 10:23:05', 2),
(228, '85*858*58*58', '2019-08-08 10:23:17', 2),
(229, '85*858*58*58', '2019-08-08 10:25:23', 2),
(230, '85*858*58*58', '2019-08-08 10:25:50', 2),
(231, '85*858*58*58', '2019-08-08 10:27:38', 2),
(232, '85*858*58*58', '2019-08-08 10:28:03', 2),
(233, '85*858*58*58', '2019-08-08 10:28:44', 2),
(234, '85*858*58*58', '2019-08-08 10:29:45', 2),
(235, '85*858*58*58', '2019-08-08 10:29:52', 2),
(236, '85*858*58*58', '2019-08-08 10:30:30', 2),
(237, '85*858*58*58', '2019-08-08 10:30:52', 2),
(238, '85*858*58*58', '2019-08-08 10:31:20', 2),
(239, '85*858*58*58', '2019-08-08 10:31:50', 2),
(240, '85*858*58*58', '2019-08-08 10:32:27', 2),
(241, '85*858*58*58', '2019-08-08 10:32:38', 2),
(242, '85*858*58*58', '2019-08-08 10:34:09', 2),
(243, '85*858*58*58', '2019-08-08 10:34:25', 2),
(244, '85*858*58*58', '2019-08-08 10:38:51', 2),
(245, '85*858*58*58', '2019-08-08 10:40:07', 2),
(246, 'fgffdfgd', '2019-08-08 11:19:25', 2),
(247, 'fgffdfgd', '2019-08-08 11:19:35', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `email`, `pwd`, `avatar`) VALUES
(1, 'ondine', 'pratlong.estelle@outlook.fr', '$2y$10$4g8uEF/UL5rH9sho4ai8.OwoIFHTqwKeCU/IxOq7E7oOYU7Wvdxr6', ''),
(2, 'vegeta', 'machin@truc.net', '$2y$10$HQNM39OZZhZUimGn6QmFv.SDlzgX6G/3CA5bSbXafeEqObPDkaU2C', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `fk_test` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_test` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
