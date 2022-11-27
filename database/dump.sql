-- Adminer 4.8.1 MySQL 5.5.5-10.9.3-MariaDB-1:10.9.3+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
                            `id_comment` int(11) NOT NULL AUTO_INCREMENT,
                            `author_comment` varchar(150) DEFAULT NULL,
                            `publish_date` date DEFAULT NULL,
                            `content_comment` text DEFAULT NULL,
                            `id_post` int(10) unsigned DEFAULT NULL,
                            `id_upper_comment` int(10) unsigned DEFAULT NULL,
                            `post_title` varchar(150) DEFAULT NULL,
                            `admin_comment` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comments` (`id_comment`, `author_comment`, `publish_date`, `content_comment`, `id_post`, `id_upper_comment`, `post_title`, `admin_comment`) VALUES
                                                                                                                                                             (1,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (2,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (3,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (4,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (5,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (6,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (7,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (8,	'amaury',	NULL,	'Mon commentaire',	15,	NULL,	'Cookies',	0),
                                                                                                                                                             (9,	'Courte',	NULL,	'commentaire sur rendre',	18,	NULL,	'A rendre',	0),
                                                                                                                                                             (10,	'Courte',	NULL,	'commentaire sur rendre',	18,	NULL,	'A rendre',	0),
                                                                                                                                                             (11,	'Courte',	NULL,	'commentaire sur rendre',	18,	NULL,	'A rendre',	0),
                                                                                                                                                             (12,	'Courte',	NULL,	'commentaire sur rendre',	18,	NULL,	'A rendre',	0),
                                                                                                                                                             (13,	'Courte',	NULL,	'Mon commentaire',	19,	NULL,	'Node',	0),
                                                                                                                                                             (14,	'Courte',	NULL,	'Mon deuxième commentaire',	19,	NULL,	'Node',	0),
                                                                                                                                                             (15,	'Courte',	NULL,	'Mon deuxième commentaire',	19,	NULL,	'Node',	0),
                                                                                                                                                             (16,	'Courte',	'2022-11-27',	'Mon enième commentaire sur node',	19,	NULL,	'Node',	0),
                                                                                                                                                             (17,	'Courte',	'2022-11-27',	'Mon troisième commentaire',	19,	NULL,	'Node',	0);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `idpost` int(11) NOT NULL AUTO_INCREMENT,
                         `content` text NOT NULL,
                         `author` int(11) DEFAULT NULL,
                         `title` varchar(150) DEFAULT NULL,
                         `public` int(11) DEFAULT NULL,
                         `image` varchar(255) DEFAULT NULL,
                         `author_name` varchar(150) DEFAULT NULL,
                         `post_date` date DEFAULT NULL,
                         PRIMARY KEY (`idpost`),
                         KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`idpost`, `content`, `author`, `title`, `public`, `image`, `author_name`, `post_date`) VALUES
                                                                                                                (15,	'Boursorama et ses partenaires souhaitent utiliser des cookies ou technologies équivalentes sur les pages du site www.boursorama.com pour stocker et/ou accéder à des informations sur votre appareil. Les données personnelles non nominatives (adresse IP, données de navigation, identifiant publicitaire, etc.) et les données non personnelles collectées via ces cookies permettent de diffuser des publicités et du contenu personnalisés ou non, mesurer la performance du contenu et des publicités, produire des données d’audience, et développer et améliorer les produits et services des partenaires. Les partenaires de Boursorama souhaitent également analyser activement les caractéristiques de votre terminal pour l’identification et utiliser des données de géolocalisation précises.',	NULL,	'Cookies',	1,	'https://images.pexels.com/photos/12704642/pexels-photo-12704642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',	'Amaury',	NULL),
                                                                                                                (16,	'Boursorama et ses partenaires souhaitent utiliser des cookies ou technologies équivalentes sur les pages du site www.boursorama.com pour stocker et/ou accéder à des informations sur votre appareil. Les données personnelles non nominatives (adresse IP, données de navigation, identifiant publicitaire, etc.) et les données non personnelles collectées via ces cookies permettent de diffuser des publicités et du contenu personnalisés ou non, mesurer la performance du contenu et des publicités, produire des données d’audience, et développer et améliorer les produits et services des partenaires. Les partenaires de Boursorama souhaitent également analyser activement les caractéristiques de votre terminal pour l’identification et utiliser des données de géolocalisation précises.',	NULL,	'Boursorama',	2,	'https://images.pexels.com/photos/12704642/pexels-photo-12704642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',	'Harris',	NULL),
                                                                                                                (17,	'Pour rappel, voici les arguments que nous avons pu voir dans ce chapitre :\r\nimage qui permet de spécifier l\'image source pour le conteneur ;\r\nbuild qui permet de spécifier le Dockerfile source pour créer l\'image du conteneur ;\r\nvolume qui permet de spécifier les points de montage entre le système hôte et les conteneurs ;\r\nrestart qui permet de définir le comportement du conteneur en cas d\'arrêt du processus ;\r\nenvironment qui permet de définir les variables d’environnement ;\r\ndepends_on qui permet de dire que le conteneur dépend d\'un autre conteneur ;\r\nports qui permet de définir les ports disponibles entre la machine host et le conteneur.\r\nRejoignez-moi dans le chapitre suivant pour vous entraîner à utiliser Docker Compose.\r\n',	NULL,	'Palazzio',	1,	'https://images.pexels.com/photos/12704642/pexels-photo-12704642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',	'Amaury',	NULL),
                                                                                                                (18,	'Rendre le 27 novembre (on aura 2 week end => ce week end et le prochain)\r\n	Refaire un blog avec une architrecture entièrement MVC et entièrement orienté objet\r\n	Dockerisé\r\n-	Gestion des poste ExploryKod (Amaury Franssen) (github.com)\r\n-	Gestion des roles \r\n-	Gestion  des commentaire sur les poste\r\n-	Pouvoir commenter un ctaire\r\n-	Gestion des utilisateurs\r\n-	Gestion des droits et des roles\r\n',	20,	'A rendre',	1,	'https://images.pexels.com/photos/12704642/pexels-photo-12704642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',	'Courte',	NULL),
                                                                                                                (19,	'\r\n    node:\r\n        image: \"node:8\"\r\n        user: \"node\"\r\n        working_dir: /var/www/html\r\n        environment:\r\n            - NODE_ENV=production\r\n        volumes:\r\n            - ./app:/var/www/html\r\n        expose:\r\n            - \"8081\"\r\n        command: \"npm start\"',	20,	'Node',	1,	'https://images.pexels.com/photos/12704642/pexels-photo-12704642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',	'Courte',	'2022-11-27');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `username` varchar(100) NOT NULL,
                        `first_name` varchar(100) DEFAULT NULL,
                        `last_name` varchar(100) DEFAULT NULL,
                        `email` varchar(150) DEFAULT NULL,
                        `birth_date` varchar(50) DEFAULT NULL,
                        `password` varchar(100) NOT NULL,
                        `status` varchar(100) DEFAULT NULL,
                        `creation_date` date DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `birth_date`, `password`, `status`, `creation_date`) VALUES
                                                                                                                                   (16,	'amaury',	NULL,	NULL,	NULL,	NULL,	'$2y$12$cP/DRVfKnPepJpBxZqiGWOFsPBuLADR37o8RMXhyFGGZkURnrolQe',	'admin',	NULL),
                                                                                                                                   (17,	'',	'',	'',	'',	'',	'$2y$12$PqAA4pAW8YBgAFjAM57TfO1Aooc5kobrJFws0smtS7nNOA07ioopC',	'user',	NULL),
                                                                                                                                   (19,	'Mercredi',	NULL,	NULL,	NULL,	NULL,	'$2y$12$ojoABbPz64w/tYIkiG8Z..ZFcXjzFaI5luMzjlTW3k8iIjW9XUl/6',	NULL,	'2022-11-27'),
                                                                                                                                   (20,	'Courte',	'Joelle',	'West',	'Garamond@gmail.com',	'1986-01',	'$2y$12$vbEKmYhzVhxoTQQdGSbkte1JM7wIIE1H4PG4axAm9pWQbEGvPy2yO',	'user',	'2022-11-27');

-- 2022-11-27 22:34:35