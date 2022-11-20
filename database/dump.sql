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
                         `content` varchar(255) NOT NULL,
                         `author` int(11) DEFAULT NULL,
                         `title` varchar(150) DEFAULT NULL,
                         `public` int(11) NULL,
                         PRIMARY KEY (`id`),
                         KEY `author` (`author`),
                         CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `username` varchar(100) NOT NULL,
                        `first_name` varchar(100) NULL,
                        `last_name` varchar(100) NULL,
                        `email` varchar(150) NULL,
                        `birth_date` varchar(50) NULL,
                        `password` varchar(100) NOT NULL,
                        `status` varchar(100) NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `author` int(11) NOT NULL,
                        `content` varchar(255) NOT NULL,
                        `title` varchar(50) NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
