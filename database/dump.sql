-- Adminer 4.8.1 MySQL 5.5.5-10.9.3-MariaDB-1:10.9.3+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `glad_blog`;
CREATE DATABASE `glad_blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `glad_blog`;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `post` varchar(255) NOT NULL,
                         `user_id` int(11) DEFAULT NULL,
                         `title` varchar(150) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         KEY `user_id` (`user_id`),
                         CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `post`, `user_id`, `title`) VALUES
                                                           (7,	'Une lame de mer ',	NULL,	'Lame'),
                                                           (9,	'ma terre est dur',	NULL,	'la brute');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `username` varchar(100) NOT NULL,
                        `password` varchar(100) NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `username`, `password`) VALUES
    (16,	'amaury',	'$2y$12$LDobHZJwD2oez4x7asOYI.u5q7rWq3bwYQq2fBB3rOZEzU1e/0hLi');

-- 2022-10-16 21:15:46