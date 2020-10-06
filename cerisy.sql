-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cerisy
CREATE DATABASE IF NOT EXISTS `cerisy` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cerisy`;

-- Listage de la structure de la table cerisy. intervenants
CREATE TABLE IF NOT EXISTS `intervenants` (
  `id` char(50) NOT NULL,
  `url_photo` varchar(255) DEFAULT NULL,
  `biographie` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table cerisy.intervenants : ~4 rows (environ)
/*!40000 ALTER TABLE `intervenants` DISABLE KEYS */;
INSERT INTO `intervenants` (`id`, `url_photo`, `biographie`) VALUES
	('61hervedefalvard', 'https://cloud.scic-tetris.org/s/Kg6OEbOZZSLXDp5', 'Docteur en économie et maître de conférences à l’université Gustave Eiffel (UGE), Hervé Defalvard est auteur de plusieurs ouvrages, dont La Révolution de l’économie en dix leçons (Éditions de l’Atelier, 2015 ; Prix du livre ESS). Il a co-organisé le colloque "Territoires solidaires en commun : controverses à l\'horizon du translocalisme".'),
	('62elisabettabuccolo', 'https://cloud.scic-tetris.org/s/EodeaOoYM1hFsSN', 'Elisabetta Bucolo est sociologue, maîtresse de conférences au Cnam. Elle est responsable du Master « Intervention et développement social : Économie sociale et solidaire ». Elle a co-organisé le colloque "Territoires solidaires en commun : controverses à l\'horizon du translocalisme".'),
	('63genevievefontaine', 'https://cloud.scic-tetris.org/s/M4RS81wwOk2EiMq', 'Geneviève Fontaine est docteur en économie salariée de l\'Institut Godin et l’une des initiatrices du Pôle territorial de coopération économique (PTCE) TETRIS (Transition écologique territoriale par la recherche et l’innovation sociale) basé à Grasse. Elle a co-organisé le colloque "Territoires solidaires en commun : controverses à l\'horizon du translocalisme".'),
	('64philippechemla', 'https://cloud.scic-tetris.org/s/1ZQsUde4ZvV5QkR', 'Philippe Chemla est l\'un des initiateurs du Pôle territorial de coopération économique (PTCE) TETRIS (Transition écologique territoriale par la recherche et l’innovation sociale) basé à Grasse. Il y coordonne le développement du tiers-lieu de la transition écologique (Sainte-Marthe) labelisé Fabrique Numérique de Territoire en 2019. Il fait partie du groupe des capteurs de liens qui a oeuvré aux côtés des co-organisateurs et de l\'équipe des Editions de l\'Atelier pendant et après le colloque pour vous proposer ce livre et ce site compagnon.');
/*!40000 ALTER TABLE `intervenants` ENABLE KEYS */;

-- Listage de la structure de la table cerisy. timeline
CREATE TABLE IF NOT EXISTS `timeline` (
  `id` varchar(128) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT '2019',
  `order` smallint(6) DEFAULT NULL,
  `showintimeline` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table cerisy.timeline : ~34 rows (environ)
/*!40000 ALTER TABLE `timeline` DISABLE KEYS */;
INSERT INTO `timeline` (`id`, `nom`, `date`, `url`, `edition`, `order`, `showintimeline`) VALUES
	('dp1formesdesolidariteetcommun', 'DP 1 - Formes de solidarité et commun', 'Samedi 13 Juillet', 'https://cloud.scic-tetris.org/s/t4sry40KbBdNfTb', '2019', 6, 1),
	('dp2regardscroisesnordsuduneepistemologiecommune', 'DP 2 - Regards croisés Nord-Sud, une épistémologie commune?', 'Dimanche 14 Juillet', 'https://cloud.scic-tetris.org/s/qvgZ0n6xhwGFY9h', '2019', 8, 1),
	('dp3valeursetcommunspourlesterritoires', 'DP 3 - Valeurs et communs pour les territoires', 'Lundi 15 Juillet', 'https://cloud.scic-tetris.org/s/PGl4JkXEogPkgFq', '2019', 13, 1),
	('dp4pouvoirspublicsetcommun', 'DP 4 - Pouvoirs publics et commun', 'Lundi 15 Juillet', 'https://cloud.scic-tetris.org/s/ItXT8tG7d58nyP7', '2019', 15, 1),
	('dp5emancipationetcommun', 'DP 5- Emancipation et commun', 'Mercredi 17 Juillet', 'https://cloud.scic-tetris.org/s/hWpVwwrtaZ730Wm', '2019', 21, 1),
	('dp6monnaieetcommun', 'DP 6 - Monnaie et commun', 'Mercredi 17 Juillet', 'https://cloud.scic-tetris.org/s/Z2Ypw3fOazqc54v', '2019', 23, 1),
	('dp7criteresetoutilsdegestionetcommun', 'DP 7 - Critères et outils de gestion et commun', 'Mercredi 17 Juillet', 'https://cloud.scic-tetris.org/s/CV3psJTfKMmGU4S', '2019', 24, 1),
	('dp8droitcommunetterritoire', 'DP 8 - Droit, commun et territoire', 'Jeudi 18 Juillet', 'https://cloud.scic-tetris.org/s/rE2GNADxrEFa7IJ', '2019', 28, 1),
	('dp9cooperativesetcommunpourquellessolidarites', 'DP 9 - Coopératives et commun pour quelles solidarités?', 'Jeudi 18 Juillet', 'https://cloud.scic-tetris.org/s/POUk7wApQ8ULHnJ', '2019', 29, 1),
	('enjeuxetcontroverses1', 'Enjeux et controverses - 1', 'Lundi 15 Juillet', 'https://cloud.scic-tetris.org/s/X6JoajHaH9eicRi', '2019', 14, 1),
	('enjeuxetcontroverses2pouvoirspublicsetcommuns', 'Enjeux et controverses 2 - Pouvoirs publics et communs', 'Mercredi 17 Juillet', 'https://cloud.scic-tetris.org/s/gOwqcAV8ApWmLpk', '2019', 25, 1),
	('horslesmursvisitesdeterrains', 'Hors les murs - visites de terrains', 'Mardi 16 Juillet', 'https://cloud.scic-tetris.org/s/EWFcvdEPSQmQ3BM', '2019', 18, 1),
	('introduction', 'Introduction', 'Samedi 13 Juillet', 'https://cloud.scic-tetris.org/s/JRqfNEivO6IQrJo', '2019', 2, 1),
	('lelivre', 'le livre', 'Après le colloque', 'https://cloud.scic-tetris.org/s/yYbYJ6yUQ8twWW3', '2019', 33, 1),
	('lesautresmomentsinformels', 'Les autres moments informels', 'Toute la semaine', 'https://cloud.scic-tetris.org/s/hQm49icbbZdbVq1', '2019', 32, 1),
	('lessuitesducolloque', 'les suites du colloque', 'Après le colloque', 'https://cloud.scic-tetris.org/s/GB7S1F9AseG45kk', '2019', 34, 1),
	('makingoffducolloqueintroduction', 'Making off du colloque', 'Avant le colloque', 'https://cloud.scic-tetris.org/s/PIa2StPjHXmjmRB', '2019', 1, 1),
	('pleniere1democratieetsolidarite', 'Plénière 1 - Démocratie et solidarité', 'Samedi 13 Juillet', 'https://cloud.scic-tetris.org/s/ktIqwns5pFcVOcg', '2019', 5, 1),
	('pleniere2faireatterirlescommunsnumeriques', 'Plénière 2 - Faire attérir les communs numériques ', 'Dimanche 14 Juillet', 'https://cloud.scic-tetris.org/s/bBLB8bzIBHEmcM5', '2019', 9, 1),
	('pleniere3letempsdesmesorepubliquesintercooperatives', 'Plénière 3 - Le temps des méso-républiques inter-coopératives', 'Lundi 15 Juillet', 'https://cloud.scic-tetris.org/s/EiyPUqyW2569Nux', '2019', 10, 1),
	('pleniere4economiesymbiotiqueecologieetcommun', 'Plénière 4 - Economie symbiotique, écologie et commun', 'Mercredi 17 Juillet', 'https://cloud.scic-tetris.org/s/CXz9XxkWUPshyOa', '2019', 22, 1),
	('rapportsdetonnements', 'Rapports d\'étonnements', 'Vendredi 19 Juillet', 'https://cloud.scic-tetris.org/s/ZLMHtngrHCDk2s3', '2019', 31, 1),
	('soireeavecjacquesjouet', 'Soirée avec Jacques Jouet', 'Mardi 16 Juillet', 'https://cloud.scic-tetris.org/s/YFIXeFjK9iw4l6e', '2019', 19, 1),
	('soireepoemes', 'Soirée Poémes', 'Jeudi 18 Juillet', 'https://cloud.scic-tetris.org/s/FngdEOCfJNaCfev', '2019', 30, 1),
	('tr10educationpopulaireconstruireunmondecommun', 'TR 10 - Education populaire, construire un monde commun', 'Jeudi 18 Juillet', 'https://cloud.scic-tetris.org/s/yotIZdxgvwZq8qa', '2019', 27, 1),
	('tr1ressourcesdesterritoiresareveler', 'TR 1 - Ressources des territoires à révéler', 'Samedi 13 Juillet', 'https://cloud.scic-tetris.org/s/4ijULKqkvd1al8K', '2019', 3, 1),
	('tr2territoiressolidairesetemploi', 'TR 2 - Territoires solidaires et emploi', 'Samedi 13 Juillet', 'https://cloud.scic-tetris.org/s/E8bnyfbXQhw9HUE', '2019', 4, 1),
	('tr3energiedurableetterritoire', 'TR 3 - Energie durable et territoire', 'Mercredi 17 Juillet', 'https://cloud.scic-tetris.org/s/2Pi4qzxoB33WClF', '2019', 20, 1),
	('tr4systemesalimentairessolidairesterritorialises', 'TR 4 - Systèmes alimentaires solidaires territorialisés', 'Dimanche 14 Juillet', 'https://cloud.scic-tetris.org/s/JwE6n7Rgjdbj85E', '2019', 7, 1),
	('tr5cultureetcommundanslesterritoires', 'TR 5 - Culture et commun dans les territoires', 'Lundi 15 Juillet', 'https://cloud.scic-tetris.org/s/AoOyHBBdOtVxRpX', '2019', 11, 1),
	('tr6grandeentrepriseetterritoire', 'TR 6 - Grande entreprise et territoire', 'Lundi 15 Juillet', 'https://cloud.scic-tetris.org/s/7po4OW6Om0mXNt0', '2019', 12, 1),
	('tr7echellesterritorialesdelasanteencommun', 'TR 7 - Echelles territoriales de la santé en commun', 'Mardi 16 Juillet', 'https://cloud.scic-tetris.org/s/p7taRappvXgBNZn', '2019', 16, 1),
	('tr8habiterencommunlesterritoires', 'TR 8 - Habiter en commun les territoires', 'Mardi 16 Juillet', 'https://cloud.scic-tetris.org/s/aXh76XanJqlFQp4', '2019', 17, 1),
	('tr9frichesencommunetterritoires', 'TR 9 - Friches en commun et territoires', 'Jeudi 18 Juillet', 'https://cloud.scic-tetris.org/s/4xt1NEluftdbLRx', '2019', 26, 1);
/*!40000 ALTER TABLE `timeline` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
