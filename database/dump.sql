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
                         PRIMARY KEY (`idpost`),
                         KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
                                                                                                                  (16,	'amaury',	NULL,	NULL,	NULL,	NULL,	'$2y$12$cP/DRVfKnPepJpBxZqiGWOFsPBuLADR37o8RMXhyFGGZkURnrolQe',	NULL),
                                                                                                                  (17,	'Raviere',	NULL,	NULL,	NULL,	NULL,	'$2y$12$PqAA4pAW8YBgAFjAM57TfO1Aooc5kobrJFws0smtS7nNOA07ioopC',	NULL);

-- 2022-11-26 21:14:27


