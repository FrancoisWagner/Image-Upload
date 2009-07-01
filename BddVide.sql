-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 25 Mai 2009 à 15:42
-- Version du serveur: 5.1.32
-- Version de PHP: 5.2.9-1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `image_upload_v2`
--
CREATE DATABASE `image_upload_v2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `image_upload_v2`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` TINYTEXT NOT NULL,
  `description` TINYTEXT NOT NULL,
  `parentDirectory` SMALLINT UNSIGNED NOT NULL,
  `FK_member` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_member` (`FK_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`, `parentDirectory`, `FK_member`) VALUES
(1, 'NO_CATEGORY', '', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` TINYTEXT NOT NULL,
  `mail` TINYTEXT NOT NULL,
  `mailAddress` TINYTEXT NOT NULL,
  `timestamp` INT UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `contact`
--


-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE IF NOT EXISTS `groupes` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` TINYTEXT NOT NULL,
  `numero_bit` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `groupes`
--

INSERT INTO `groupes` (`id`, `nom`, `numero_bit`) VALUES
(1, 'Administrator', 7),
(2, 'User', 1);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` TINYTEXT NOT NULL,
  `taille` TINYTEXT NOT NULL,
  `poids` TINYTEXT NOT NULL,
  `type` TINYTEXT NOT NULL,
  `directory` TINYTEXT NOT NULL,
  `FK_category` SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  `FK_member` SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  `timestamp` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_member` (`FK_member`),
  KEY `FK_category` (`FK_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` TINYTEXT NOT NULL,
  `password` TINYTEXT NOT NULL,
  `mail` TINYTEXT NOT NULL,
  `timestamp` INT UNSIGNED NOT NULL,
  `activation` INT UNSIGNED NOT NULL,
  `id_session` TINYTEXT NOT NULL,
  `nbrImages` SMALLINT UNSIGNED NOT NULL,
  `FK_droit` SMALLINT UNSIGNED NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`),
  KEY `FK_droit` (`FK_droit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`id`, `login`, `password`, `mail`, `timestamp`, `activation`, `id_session`, `nbrImages`, `FK_droit`) VALUES
(1, 'Image-Upload', '1', '', 0, 15897856, '', 0, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`FK_member`) REFERENCES `members` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`FK_member`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `images_ibfk_2` FOREIGN KEY (`FK_category`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`FK_droit`) REFERENCES `groupes` (`id`);
