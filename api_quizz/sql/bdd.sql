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
  PRIMARY KEY (`id`),
  KEY `id_quizz` (`id_quizz`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_quizz`) REFERENCES `quizz` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `question` (`id`, `texte`, `image`, `id_quizz`) VALUES
(1,	'Quand s\'est déroulée la coupe du monde 1998 ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(2,	'Qui a marqué un doublé lors de la final 98 France-Brésil ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(3,	'Combien de coupe du monde la France a elle gagnée ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(4,	'Où s\'est déroulée la coupe du monde 2006 ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(5,	'Combien de coupe du monde l\'Allemagne a elle gagnée ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(6,	'Quelle équipe fut discalifiée contre toute attente pour le mondial 2018 ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(7,	'À quelle fréquence se déroule la coupe du monde ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(8,	'Quel joueur est le meilleur buteur toute compétition mondial confondue ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(9,	'Quelle forme a un ballon ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(10,	'Qui est le plus fort entre la France est la Lituanie ?',	NULL,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002');

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE `quizz` (
  `id` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_createur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_createur` (`id_createur`),
  CONSTRAINT `quizz_ibfk_1` FOREIGN KEY (`id_createur`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `quizz` (`id`, `nom`, `id_createur`) VALUES
('2c5c4bfd-2215-11e8-bbfa-0242ac1a0002',	'La Coupe du Monde de football',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('3f9e4072-2215-11e8-bbfa-0242ac1a0002',	'La Nintendo GameCube',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('52209571-2215-11e8-bbfa-0242ac1a0002',	'Les peintres du XIXe siècle',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('83f877a2-2215-11e8-bbfa-0242ac1a0002',	'Culture vidéoludique',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('c2d75e9d-2214-11e8-bbfa-0242ac1a0002',	'La 1ère guerre mondiale',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('df0077a7-2213-11e8-bbfa-0242ac1a0002',	'La Révolution française',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17');

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(250) NOT NULL,
  `etat` tinyint(4) NOT NULL,
  `id_question` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`),
  CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `reponse` (`id`, `texte`, `etat`, `id_question`) VALUES
(1,	'2005',	0,	1),
(2,	'3000',	0,	1),
(3,	'1998',	1,	1),
(5,	'5165166',	0,	1),
(6,	'bartez',	0,	2),
(7,	'zizou',	1,	2),
(8,	'valbuena',	0,	2),
(9,	'bob marley',	0,	2),
(10,	'12',	0,	3),
(11,	'1',	1,	3),
(12,	'0',	0,	3),
(13,	'85',	0,	3),
(14,	'Allemagne',	1,	4),
(15,	'bresil',	0,	4),
(16,	'chypre',	0,	4),
(17,	'usa',	0,	4),
(18,	'4',	1,	5),
(19,	'887',	0,	5),
(20,	'475',	0,	5),
(21,	'4',	0,	5),
(22,	'belgique',	0,	6),
(23,	'italie',	1,	6),
(24,	'France',	0,	6),
(25,	'Russie',	0,	6),
(26,	'Tous les 4 ans',	1,	7),
(27,	'Tous les 6 ans',	0,	7),
(28,	'Toutes les 4 semaines',	0,	7),
(29,	'tout les jours',	0,	7),
(30,	'Just Fontaine',	1,	8),
(31,	'Ronaldo',	0,	8),
(32,	'Miroslav Klose ',	0,	8),
(33,	'une carotte',	0,	8),
(34,	'noir',	0,	9),
(35,	'ronde',	1,	9),
(36,	'carré',	0,	9),
(37,	'trobonne',	0,	9),
(38,	'La Colombie',	0,	10),
(39,	'La Suisse',	0,	10),
(40,	'Le Pakistan',	0,	10),
(41,	'Marseille',	1,	10);

DROP TABLE IF EXISTS `score`;
CREATE TABLE `score` (
  `id` double NOT NULL AUTO_INCREMENT,
  `score` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `id_quizz` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quizz` (`id_quizz`),
  CONSTRAINT `score_ibfk_1` FOREIGN KEY (`id_quizz`) REFERENCES `quizz` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `score` (`id`, `score`, `pseudo`, `id_quizz`) VALUES
(1,	158,	'ok',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(2,	70,	'leo',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(3,	20,	'leo',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(4,	80,	'leo',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(5,	20,	'ok',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(6,	120,	'ok',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(7,	20,	'ok',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(8,	57,	'test',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(9,	0,	'ok',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(10,	38,	'ook',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002');

DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id` varchar(100) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `theme` (`id`, `nom`, `description`) VALUES
('6a830f22-15a8-11e8-9896-0242ac1a0002',	'Histoire',	'Des quizz pour Jean-Napoléon !'),
('7a33ec02-15a8-11e8-9896-0242ac1a0002',	'Sport',	'Des quizz pour Jean-Zinédine !'),
('8cb3c075-15a8-11e8-9896-0242ac1a0002',	'Jeux vidéos',	'Des quizz pour Jean-Pacman !'),
('a8de01fb-15a8-11e8-9896-0242ac1a0002',	'Art',	'Des quizz pour Jean-Pablo !');

DROP TABLE IF EXISTS `theme2quizz`;
CREATE TABLE `theme2quizz` (
  `id_quizz` varchar(100) NOT NULL,
  `id_theme` varchar(100) NOT NULL,
  KEY `id_theme` (`id_theme`),
  KEY `id_quizz` (`id_quizz`),
  CONSTRAINT `theme2quizz_ibfk_1` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id`),
  CONSTRAINT `theme2quizz_ibfk_2` FOREIGN KEY (`id_quizz`) REFERENCES `quizz` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `theme2quizz` (`id_quizz`, `id_theme`) VALUES
('df0077a7-2213-11e8-bbfa-0242ac1a0002',	'6a830f22-15a8-11e8-9896-0242ac1a0002'),
('c2d75e9d-2214-11e8-bbfa-0242ac1a0002',	'6a830f22-15a8-11e8-9896-0242ac1a0002'),
('2c5c4bfd-2215-11e8-bbfa-0242ac1a0002',	'7a33ec02-15a8-11e8-9896-0242ac1a0002'),
('83f877a2-2215-11e8-bbfa-0242ac1a0002',	'8cb3c075-15a8-11e8-9896-0242ac1a0002'),
('3f9e4072-2215-11e8-bbfa-0242ac1a0002',	'8cb3c075-15a8-11e8-9896-0242ac1a0002'),
('52209571-2215-11e8-bbfa-0242ac1a0002',	'a8de01fb-15a8-11e8-9896-0242ac1a0002');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(2500) NOT NULL,
  `mail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `login`, `password`, `mail`) VALUES
('32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'Michel',	'$2y$10$QgcFe0lt/crzktNQ0KUcjO3iyPYdNaYxt1LfwfFl04EZax4H.ASQW',	'michel@cestlebresil.samba');

-- 2018-03-21 13:08:28
