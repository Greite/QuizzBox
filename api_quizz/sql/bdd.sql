-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(500) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `id_quizz` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `quizz`;
CREATE TABLE `quizz` (
  `id` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_createur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id` varchar(100) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `theme2quizz`;
CREATE TABLE `theme2quizz` (
  `id_quizz` varchar(100) NOT NULL,
  `id_theme` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(2500) NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2018-02-14 15:41:10
