-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 20 Octobre 2013 à 16:20
-- Version du serveur: 5.1.53-community-log
-- Version de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `game_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `battles`
--

CREATE TABLE IF NOT EXISTS `battles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user_1` int(11) DEFAULT NULL,
  `id_user_2` int(11) DEFAULT NULL,
  `turn` int(11) DEFAULT NULL,
  `turn_is` int(11) DEFAULT NULL,
  `action` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'waiting',
  PRIMARY KEY (`id`),
  KEY `id_user_1` (`id_user_1`),
  KEY `id_user_2` (`id_user_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `champions`
--

CREATE TABLE IF NOT EXISTS `champions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `health` int(10) unsigned DEFAULT NULL,
  `strength` int(10) unsigned DEFAULT NULL,
  `intelligence` int(10) unsigned DEFAULT NULL,
  `mana` int(10) unsigned DEFAULT NULL,
  `classe` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `champions_has_users`
--

CREATE TABLE IF NOT EXISTS `champions_has_users` (
  `id_champion` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_champion`,`id_user`),
  KEY `fk_champions_has_users_users1` (`id_user`),
  KEY `fk_champions_has_users_champions1` (`id_champion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `weapons`
--

CREATE TABLE IF NOT EXISTS `weapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `health_bonus` int(11) DEFAULT '0',
  `strength_bonus` int(11) DEFAULT '0',
  `intelligence_bonus` int(11) DEFAULT '0',
  `mana_bonus` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `weapons_has_champions`
--

CREATE TABLE IF NOT EXISTS `weapons_has_champions` (
  `id_weapon` int(11) NOT NULL,
  `id_champion` int(11) NOT NULL,
  PRIMARY KEY (`id_weapon`,`id_champion`),
  KEY `fk_weapons_has_champions_champions1` (`id_champion`),
  KEY `fk_weapons_has_champions_weapons` (`id_weapon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `battles`
--
ALTER TABLE `battles`
  ADD CONSTRAINT `battles_ibfk_4` FOREIGN KEY (`id_user_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `battles_ibfk_3` FOREIGN KEY (`id_user_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Contraintes pour la table `champions_has_users`
--
ALTER TABLE `champions_has_users`
  ADD CONSTRAINT `champions_has_users_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `champions_has_users_ibfk_1` FOREIGN KEY (`id_champion`) REFERENCES `champions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `weapons_has_champions`
--
ALTER TABLE `weapons_has_champions`
  ADD CONSTRAINT `weapons_has_champions_ibfk_7` FOREIGN KEY (`id_champion`) REFERENCES `champions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weapons_has_champions_ibfk_6` FOREIGN KEY (`id_weapon`) REFERENCES `weapons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
