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
                                                                                                                (17,	'Pour rappel, voici les arguments que nous avons pu voir dans ce chapitre :\r\nimage qui permet de spécifier l\'image source pour le conteneur ;\r\nbuild qui permet de spécifier le Dockerfile source pour créer l\'image du conteneur ;\r\nvolume qui permet de spécifier les points de montage entre le système hôte et les conteneurs ;\r\nrestart qui permet de définir le comportement du conteneur en cas d\'arrêt du processus ;\r\nenvironment qui permet de définir les variables d’environnement ;\r\ndepends_on qui permet de dire que le conteneur dépend d\'un autre conteneur ;\r\nports qui permet de définir les ports disponibles entre la machine host et le conteneur.\r\nRejoignez-moi dans le chapitre suivant pour vous entraîner à utiliser Docker Compose.\r\n',	NULL,	'Palazzio',	1,	'https://images.pexels.com/photos/12704642/pexels-photo-12704642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',	'Amaury',	NULL);

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
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `birth_date`, `password`, `status`) VALUES
                                                                                                                  (16,	'amaury',	NULL,	NULL,	NULL,	NULL,	'$2y$12$cP/DRVfKnPepJpBxZqiGWOFsPBuLADR37o8RMXhyFGGZkURnrolQe',	'admin'),
                                                                                                                  (17,	'Raviere',	NULL,	NULL,	NULL,	NULL,	'$2y$12$PqAA4pAW8YBgAFjAM57TfO1Aooc5kobrJFws0smtS7nNOA07ioopC',	NULL);

-- 2022-11-27 09:07:57