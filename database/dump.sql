-- Adminer 5.4.1 MariaDB 12.3.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

-- La base glad_blog est déjà créée par MYSQL_DATABASE au démarrage du conteneur.
USE `glad_blog`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `comments` (`id_comment`, `author_comment`, `publish_date`, `content_comment`, `id_post`, `id_upper_comment`, `post_title`, `admin_comment`) VALUES
(1,	'amaury',	'2026-07-19',	'Petit rappel : bien vérifier le volume ./app:/var/www/html avant de relancer docker compose, sinon Composer réinstalle tout à chaque fois.',	1,	NULL,	'Docker Compose en pratique',	1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `posts` (`idpost`, `content`, `author`, `title`, `public`, `image`, `author_name`, `post_date`) VALUES
(1,	'Pour démarrer un blog MVC en local, Docker Compose suffit : un service PHP/Apache, une base MariaDB et éventuellement Adminer. Les points essentiels sont build (Dockerfile), volumes (code monté dans le conteneur), ports (1300:80) et environment (identifiants MySQL). Une fois les conteneurs démarrés, composer install s’exécute au boot pour générer vendor/.',	16,	'Docker Compose en pratique',	1,	'/public/assets/ordinateur.jpg',	'amaury',	'2026-07-19'),
(2,	'L’architecture MVC sépare clairement les responsabilités : les Controllers orchestrent la requête, les Entities portent les règles métier, les Managers gèrent la persistance SQL. Le Front Controller (index.php) route via des attributs #[Route] et injecte les dépendances grâce à AppContainer. Objectif : des contrôleurs fins et un domaine riche, sans framework.',	16,	'Architecture MVC sans framework',	1,	'/public/assets/ordinateur.jpg',	'amaury',	'2026-07-19');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `birth_date`, `password`, `status`, `creation_date`) VALUES
(16,	'amaury',	'Amaury',	'Dupont',	'amaury@example.com',	'',	'$2y$12$cP/DRVfKnPepJpBxZqiGWOFsPBuLADR37o8RMXhyFGGZkURnrolQe',	'admin',	NULL);

-- 2026-07-19 07:21:31 UTC
