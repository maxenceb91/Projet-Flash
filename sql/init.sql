CREATE DATABASE `game_base` ;

USE `game_base`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) UNIQUE DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pseudo` varchar(100) UNIQUE DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `difficulty` ENUM ('1', '2', '3') NOT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `private_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_sender_id` int(11) NOT NULL,
  `user_receiver_id` int(11) NOT NULL,
  `message` TEXT NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `read_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_sender_id`) REFERENCES `user`(`id`),
  FOREIGN KEY (`user_receiver_id`) REFERENCES `user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

INSERT INTO score (user_id, game_id, difficulty, score) VALUES
-- Utilisateur 1
(1, 1, 1, 35),
(1, 1, 2, 47),
(1, 1, 3, 66),
(1, 1, 1, 30),
(1, 1, 2, 50),
(1, 1, 3, 70),
(1, 1, 1, 32),
(1, 1, 2, 48),
(1, 1, 3, 68),

-- Utilisateur 2
(2, 1, 1, 33),
(2, 1, 2, 46),
(2, 1, 3, 64),
(2, 1, 1, 29),
(2, 1, 2, 51),
(2, 1, 3, 75),
(2, 1, 1, 31),
(2, 1, 2, 49),
(2, 1, 3, 67);
