-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `commentaire` (`id`, `message`, `id_auteur`, `id_quizz`) VALUES
('12',	'salut',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'52209571-2215-11e8-bbfa-0242ac1a0002'),
('7b7f27a5-8441-46e9-baa4-9a14cdeae93c',	'salut',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'83f877a2-2215-11e8-bbfa-0242ac1a0002'),
('84ed2411-f254-45ad-8e2b-bb6834b43b43',	'salut',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'83f877a2-2215-11e8-bbfa-0242ac1a0002'),
('864653cd-6a96-4fbe-8bde-33c80d848f2f',	'salut',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
('f6b849d3-c747-42ec-80a8-8dca1ddd2100',	'aaaaaaa',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002');

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id` varchar(100) NOT NULL,
  `valeur` int(1) NOT NULL,
  `id_quizz` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quizz` (`id_quizz`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `note_ibfk_1` FOREIGN KEY (`id_quizz`) REFERENCES `quizz` (`id`),
  CONSTRAINT `note_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `note` (`id`, `valeur`, `id_quizz`, `id_user`) VALUES
('10324eb4-cb87-4d2c-bb73-fcddd1b13b1f',	3,	'3f9e4072-2215-11e8-bbfa-0242ac1a0002',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('1d6355a2-3c39-420b-864d-b1f8cbb066fa',	5,	'83f877a2-2215-11e8-bbfa-0242ac1a0002',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('48896d76-976b-4cfd-9588-793e6f3eccf7',	4,	'c2d75e9d-2214-11e8-bbfa-0242ac1a0002',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('a9392c7d-299a-46b0-9377-4f899d0c44da',	3,	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('ae2a07c9-92bf-443c-91c3-d11c1aeab0aa',	2,	'df0077a7-2213-11e8-bbfa-0242ac1a0002',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('baf08400-cd7d-4bcf-8e48-06911043dad6',	1,	'52209571-2215-11e8-bbfa-0242ac1a0002',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17');

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

INSERT INTO `quizz` (`id`, `nom`, `id_createur`) VALUES
('2c5c4bfd-2215-11e8-bbfa-0242ac1a0002',	'La Coupe du Monde de football',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('3f9e4072-2215-11e8-bbfa-0242ac1a0002',	'La Nintendo GameCube',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('52209571-2215-11e8-bbfa-0242ac1a0002',	'Les peintres du XIXe siècle',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('83f877a2-2215-11e8-bbfa-0242ac1a0002',	'Culture vidéoludique',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('c2d75e9d-2214-11e8-bbfa-0242ac1a0002',	'La 1ère guerre mondiale',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17'),
('df0077a7-2213-11e8-bbfa-0242ac1a0002',	'La Révolution française',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17');

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
(10,	38,	'ook',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(11,	190,	'Frago',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
(12,	76,	'Clelia',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002');

INSERT INTO `theme` (`id`, `nom`, `description`) VALUES
('6a830f22-15a8-11e8-9896-0242ac1a0002',	'Histoire',	'Des quizz pour Jean-Napoléon !'),
('7a33ec02-15a8-11e8-9896-0242ac1a0002',	'Sport',	'Des quizz pour Jean-Zinédine !'),
('8cb3c075-15a8-11e8-9896-0242ac1a0002',	'Jeux vidéos',	'Des quizz pour Jean-Pacman !'),
('a8de01fb-15a8-11e8-9896-0242ac1a0002',	'Art',	'Des quizz pour Jean-Pablo !');

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
('32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'Michel',	'$2y$10$QgcFe0lt/crzktNQ0KUcjO3iyPYdNaYxt1LfwfFl04EZax4H.ASQW',	'michel@cestlebresil.samba'),
('84562a3c-d47e-4d8f-8933-1ff8fb0baea0',	'Greite',	'$2y$10$PnxaceEqlfbp1wg0IbU4Iuh163VRlsGdmzilKr3to.9ESISRmAmhG',	'greite@greite.fr'),
('9a9b6183-c420-4fe5-8cc8-547a96961392',	'Frago',	'$2y$10$BaDWuidKlRcZy9sxyKyMHOF4LvMc37a5.er4/8AgxPCco98/aq3Dm',	'frago@frago.fr');

-- 2018-03-30 15:54:33
