-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE `commentaire` (
  `id` varchar(100) NOT NULL,
  `message` varchar(140) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_auteur` varchar(100) NOT NULL,
  `id_quizz` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_auteur` (`id_auteur`),
  KEY `id_quizz` (`id_quizz`),
  CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `user` (`id`),
  CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_quizz`) REFERENCES `quizz` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `commentaire` (`id`, `message`, `created_at`, `updated_at`, `id_auteur`, `id_quizz`) VALUES
('06238223-5ecb-47e0-985d-747a4be4f241',	'dab',	'2018-04-03 16:07:18',	'2018-04-03 16:07:18',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
('12',	'salut',	'2018-04-03 15:40:40',	'0000-00-00 00:00:00',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'52209571-2215-11e8-bbfa-0242ac1a0002'),
('2f78fc64-9c69-4c93-a05b-f38258d336a7',	'ciao',	'2018-04-03 15:57:37',	'2018-04-03 15:57:37',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'83f877a2-2215-11e8-bbfa-0242ac1a0002'),
('7ad7744a-7dc3-4595-934b-b75265643746',	'salut',	'2018-04-03 16:07:08',	'2018-04-03 16:07:08',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
('7b7f27a5-8441-46e9-baa4-9a14cdeae93c',	'salut',	'2018-04-03 15:40:40',	'0000-00-00 00:00:00',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'83f877a2-2215-11e8-bbfa-0242ac1a0002'),
('84ed2411-f254-45ad-8e2b-bb6834b43b43',	'waw',	'2018-04-03 15:51:55',	'2018-04-03 15:51:55',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'83f877a2-2215-11e8-bbfa-0242ac1a0002'),
('864653cd-6a96-4fbe-8bde-33c80d848f2f',	'salut',	'2018-04-03 15:40:40',	'0000-00-00 00:00:00',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
('b8c306de-09ac-44cd-b54f-159c14064407',	'ciao',	'2018-04-03 15:51:29',	'2018-04-03 15:51:29',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'83f877a2-2215-11e8-bbfa-0242ac1a0002'),
('f1fea308-bd52-4917-aff4-e80482053379',	'zern',	'2018-04-03 16:07:25',	'2018-04-03 16:07:25',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
('f6b783d1-d7ca-4227-988a-41a6afdf4225',	'waw',	'2018-04-03 15:40:40',	'0000-00-00 00:00:00',	'9a9b6183-c420-4fe5-8cc8-547a96961392',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002'),
('f6b849d3-c747-42ec-80a8-8dca1ddd2100',	'aaaaaaa',	'2018-04-03 15:40:40',	'0000-00-00 00:00:00',	'32a4d78c-75c7-4bc1-bc81-2a55b5afde17',	'2c5c4bfd-2215-11e8-bbfa-0242ac1a0002');

-- 2018-04-03 16:09:03
