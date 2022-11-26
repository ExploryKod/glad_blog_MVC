-- Adminer 4.8.1 MySQL 5.5.5-10.9.3-MariaDB-1:10.9.3+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `author` int(11) NOT NULL,
                            `content` varchar(255) NOT NULL,
                            `title` varchar(50) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `content` text NOT NULL,
                         `author` int(11) DEFAULT NULL,
                         `title` varchar(150) DEFAULT NULL,
                         `public` int(11) DEFAULT NULL,
                         `image` varchar(255) DEFAULT NULL,
                         `author_name` varchar(150) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `content`, `author`, `title`, `public`, `image`, `author_name`) VALUES
    (1,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores nostrum praesentium qui labore eveniet saepe alias beatae, reiciendis perspiciatis! Velit ipsa consectetur nostrum, quia distinctio quam veniam vel rerum expedita!\r\nAb, voluptates numquam. Velit suscipit delectus porro distinctio minima! Nobis laudantium suscipit est a, nulla earum nam quidem accusamus aperiam ut veniam beatae cupiditate ipsa eum quam! Quae, repellat sint?\r\nNemo distinctio expedita pariatur itaque quod, blanditiis sit ipsam perspiciatis unde reprehenderit voluptatum accusamus sequi assumenda molestias error fuga perferendis facilis possimus cum culpa? Nam nisi eveniet totam architecto voluptatibus.\r\nNumquam sapiente quaerat consectetur dicta, quae, quo, magni quas alias inventore ab magnam. Enim, pariatur. Quibusdam, neque in. Possimus impedit optio facere nobis quidem incidunt dolorem nemo, vero ipsam cumque!\r\nAt aliquid excepturi esse, porro dolores ab explicabo doloribus facilis quam eos quo nulla quasi, minus dignissimos ad accusantium, adipisci sequi consequuntur neque molestias quis enim ducimus placeat asperiores! Exercitationem.\r\nEst quasi exercitationem mollitia impedit dolore perspiciatis, accusamus eaque sit reprehenderit voluptate vitae nulla earum! Architecto id officia expedita adipisci earum quam a eaque perferendis nulla. Totam voluptate ducimus non!\r\nIn debitis vel nesciunt molestiae aperiam odit odio ducimus nobis neque? Facilis explicabo qui eos harum exercitationem totam animi aperiam odio placeat? Corrupti consequatur facilis quasi voluptate velit iste blanditiis!\r\nRem, qui quo, vitae, voluptatum modi blanditiis tempore vero architecto molestiae aut alias unde enim tenetur porro placeat quos fuga. Earum similique fugit dolore numquam nulla distinctio incidunt quis facilis?\r\nModi reiciendis consequuntur sint, ut aliquid aspernatur asperiores, ducimus magni rem unde dolores porro. Nam deleniti suscipit, pariatur dicta ab perspiciatis laboriosam maxime, asperiores eveniet vero quas magnam deserunt rerum.\r\nQuos architecto, deleniti sed possimus placeat maiores. Veritatis harum dolor beatae vero impedit hic enim natus ipsam? Possimus, quod? Aspernatur vitae quod eveniet fugit doloribus ipsa fuga commodi, alias repellat.',	1,	'Premier article',	NULL,	NULL,	NULL);

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
                                                                                                                  (15,	'franssen',	NULL,	NULL,	NULL,	NULL,	'radis',	NULL),
                                                                                                                  (16,	'amaury',	NULL,	NULL,	NULL,	NULL,	'$2y$12$cP/DRVfKnPepJpBxZqiGWOFsPBuLADR37o8RMXhyFGGZkURnrolQe',	NULL);
-- 2022-11-26 09:59:29



