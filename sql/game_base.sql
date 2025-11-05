-- Story 1 : Création de la base de données game_base et des tables associées --

CREATE DATABASE `game_base` ;

USE `game_base`;

-- Création de la table `user` -- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pseudo` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Création de la table `score` --

CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `difficulty` ENUM ('1', '2', '3') NOT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Création de la table `message` --
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Création de la table `game` --

CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Story 2 : Insertion des données de test dans les tables de la base de données game_base --

-- Insertion des utilisateurs de test dans la table `user` --

INSERT INTO `user` (`email`, `password`, `pseudo`) VALUES
('john.doe@gmail.com', 'hashedpassword123', 'JohnDoe'),
('emma.smith@gmail.com', 'hashedpassword456', 'EmmaGamer'),
('alex.garcia@gmail.com', 'hashedpassword789', 'AlexPro'),
('sarah.wilson@gmail.com', 'hashedpassword101', 'SarahW'),
('mike.jones@gmail.com', 'hashedpassword202', 'MikeGaming'),
('test@gmail.com', 'test123', 'TestUser');

-- Insertion des scores de test dans la table `score` --

INSERT INTO `score` (`user_id`, `game_id`, `difficulty`, `score`) VALUES
(1, 1, '2', 1580),
(1, 2, '1', 760),
(2, 1, '3', 2380),
(2, 3, '2', 1765),
(3, 1, '1', 920),
(3, 2, '2', 1420),
(4, 3, '3', 3050),
(4, 1, '2', 1890),
(5, 2, '3', 2750),
(5, 3, '1', 640),
(1, 3, '3', 2100),
(2, 2, '1', 430),
(3, 3, '2', 1630),
(4, 2, '1', 980),
(5, 1, '2', 1505),
(1, 1, '1', 520),
(2, 1, '2', 1340),
(3, 2, '3', 2600),
(4, 3, '2', 1980),
(5, 2, '1', 710);

-- Insertion des messages de test dans la table `message` --

INSERT INTO `message` (`game_id`, `user_id`, `message`) VALUES
(1, 1, 'gg bg'),
(1, 2, 'fallait eco mat'),
(1, 3, 'monstre brother'),
(1, 4, 'Très addictif, bravo aux devs.'),
(1, 5, 'J''ai battu mon record, merci !'),
(1, 1, 'Graphismes simples mais efficaces.'),
(1, 2, 'Peut-on avoir plus de niveaux ?'),
(1, 3, 'Le temps imparti est parfois court.'),
(1, 4, 'Interface fluide et rapide.'),
(1, 5, 'alt f4 si trop dur '),
(1, 1, 'Jouer en ligne serait un plus.'),
(1, 2, 'Les sons encouragent bien le gameplay.'),
(1, 3, 'Je suggère un tutoriel.'),
(1, 4, 'ez pz.'),
(1, 5, 'Challenge accepté pour la difficulté 3.'),
(1, 1, 'Merci pour les mises à jour !'),
(1, 2, 'Petit bug sur le score affiché.'),
(1, 3, 'Jouer avec des amis serait top.'),
(1, 4, 'Les couleurs sont agréables.'),
(1, 5, 'prend ton temps'),
(1, 1, 'Idée: ajouter des badges.'),
(1, 2, 'Bon équilibre entre réflexe et mémoire.'),
(1, 3, 'La progression est bien dosée.'),
(1, 4, 'Temps de chargement rapide.'),
(1, 5, 'ez au lobby go dodo');

-- Insertion des jeux de test dans la table `game` --

INSERT INTO `game` (`name`) 
VALUES ('Power of memory');

-- Story 3 : la réquête permettant d'ajouter un utilisateur avec son email, son mot de passe (hashé) et son pseudo -- 

INSERT INTO `user` (`email`, `password`, `pseudo`) VALUES
('@email','@password', '@pseudo');

-- Story 4 : les requêtes permettant de modifier le mot de passe et l’adresse email d’un utilisateur -- 

-- Requête pour modifier le mot de passe --

UPDATE `user`
SET `password` = @new_password
WHERE `id` = @id_user;

-- Requête pour modifier l'adresse email--

UPDATE  `user`
SET `email` = 'newemail'
WHERE `id` = @id_user AND `password` = @password_provided;

-- Story 5 : la requête permettant de s’identifier sur le site --

SELECT *
FROM `user`
WHERE `email` = @email_provided
  AND `password` = @password_provided;

-- Story 6 : La requête permettant de voir les scores des utilisateurs & les différentes requêtes de filtrages--

-- La requête permettant de voir les scores des utilisateurs --

SELECT game.name, user.pseudo, score.difficulty, score.score, score.created_at FROM `score`
JOIN `user` ON user.id = score.user_id
JOIN `game` ON game.id = score.game_id
ORDER BY game.name, difficulty DESC, score;

-- Les différents filtrages --

SELECT game.name, user.pseudo, score.difficulty, score.score, score.created_at FROM `score`
JOIN `user` ON user.id = score.user_id
JOIN `game` ON game.id = score.game_id
WHERE game.name = @game_name
ORDER BY game.name, difficulty DESC, score;

SELECT game.name, user.pseudo, score.difficulty, score.score, score.created_at FROM `score`
JOIN `user` ON user.id = score.user_id
JOIN `game` ON game.id = score.game_id
WHERE score.difficulty = @difficulty_level
ORDER BY game.name, difficulty DESC, score;

SELECT game.name, user.pseudo, score.difficulty, score.score, score.created_at FROM `score`
JOIN `user` ON user.id = score.user_id
JOIN `game` ON game.id = score.game_id
WHERE game.name = @game_name AND score.difficulty = @difficulty_level
ORDER BY game.name, difficulty DESC, score;

-- Story 7 : La requête permettant de rechercher des scores à partir du pseudo d’un utilisateur --

SELECT game.name, user.pseudo, score.difficulty, score.score, score.created_at FROM `score`
JOIN `user` ON user.id = score.user_id
JOIN `game` ON game.id = score.game_id
WHERE user.pseudo LIKE `%@char_search%`
ORDER BY game.name, difficulty DESC, score;

-- Story 8 : la requête permettant d’enregistrer le score d’un joueur qui a terminé sa partie --

INSERT INTO `score` (`user_id`, `game_id`, `difficulty`, `score`)
VALUES (@user_id, @game_id, @difficulty, @score);
