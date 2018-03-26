-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE `commentaire` (
  `id` varchar(100) NOT NULL,
  `message` varchar(140) NOT NULL,
  `id_auteur` varchar(100) NOT NULL,
  `id_quizz` varchar(100) NOT NULL,
  KEY `id_auteur` (`id_auteur`),
  KEY `id_quizz` (`id_quizz`),
  CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `user` (`id`),
  CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_quizz`) REFERENCES `quizz` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `commentaire` (`id`, `message`, `id_auteur`, `id_quizz`) VALUES
('12',	'salut',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'52209571-2215-11e8-bbfa-0242ac1a0002');

-- 2018-03-26 14:01:40
