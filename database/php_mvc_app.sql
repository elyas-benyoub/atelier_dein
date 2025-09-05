-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 04 sep. 2025 à 09:36
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_mvc_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_count` int DEFAULT NULL,
  `summary` text COLLATE utf8mb4_general_ci,
  `publication_year` smallint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `fk_books_media` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `media_id`, `author`, `isbn`, `page_count`, `summary`, `publication_year`, `created_at`, `updated_at`) VALUES
(18, 40, 'George Orwell', '9780451524935', 328, 'Dans un régime totalitaire, Winston Smith remet en cause la propagande du Parti et rêve de liberté.', 1949, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(19, 41, 'J.R.R. Tolkien', '9780547928227', 310, 'Un hobbit tranquille se lance malgré lui dans une quête avec treize nains pour reprendre un trésor volé par un dragon.', 1937, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(20, 42, 'J.K. Rowling', '9780590353427', 320, 'Orphelin, Harry découvre qu\'il est sorcier et rejoint Poudlard, où un terrible secret l\'attend.', 1997, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(21, 43, 'Paulo Coelho', '9780061122415', 208, 'Un jeune berger andalou traverse le désert à la recherche d\'un trésor et de sa Légende personnelle.', 1988, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(22, 44, 'Dan Brown', '9780307474278', 592, 'Un professeur de symbologie et une cryptologue enquêtent sur un meurtre au Louvre et un secret millénaire.', 2003, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(23, 45, 'Stephen King', '9780307743657', 688, 'Dans un hôtel isolé, un écrivain sombre dans la folie tandis que des forces maléfiques s\'acharnent sur sa famille.', 1977, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(24, 46, 'Victor Hugo', '9782070409181', 1463, 'L\'épopée de Jean Valjean dans la France du XIXe siècle, entre rédemption, injustice et luttes sociales.', 1862, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(25, 47, 'J.D. Salinger', '9780316769488', 277, 'Holden Caulfield erre dans New York, en proie au désenchantement de l\'adolescence.', 1951, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(26, 48, 'Frank Herbert', '9780441172719', 896, 'Sur la planète désertique Arrakis, Paul Atréides affronte complots et prophéties autour de l\'épice.', 1965, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(27, 49, 'J.R.R. Tolkien', '9780547928210', 432, 'Frodon entreprend de détruire l\'Anneau unique avec l\'aide d\'une communauté de héros.', 1954, '2025-08-31 19:55:58', '2025-08-31 19:55:58');

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `min_age` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_games_media` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `media_id`, `publisher`, `min_age`, `description`, `created_at`, `updated_at`) VALUES
(12, 60, 'CD Projekt', 18, 'RPG en monde ouvert : Geralt de Riv traque la Chasse sauvage pour retrouver Ciri.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(13, 61, 'Mojang Studios', 7, 'Jeu bac à sable : explore, mine, construis et survie dans des mondes procéduraux.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(14, 62, 'Rockstar Games', 18, 'Western en monde ouvert : Arthur Morgan lutte entre loyauté et survie à la fin du Far West.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(15, 63, 'Square', 12, 'JRPG culte : Cloud et ses alliés combattent la Shinra et un antagoniste mythique.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(16, 64, 'Nintendo', 12, 'Aventure action : Link voyage dans le temps pour vaincre Ganondorf et sauver Hyrule.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(17, 65, 'Nintendo', 7, 'Plateformer 3D : Mario parcourt des royaumes variés avec Cappy pour sauver Peach.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(18, 66, 'FromSoftware / Bandai Namco', 16, 'Action-RPG en monde ouvert : dans l''Entre-terre, le Sans-éclat cherche à reforger l''Anneau Primal.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(19, 67, 'FromSoftware / Bandai Namco', 16, 'Action-RPG exigeant : le Morteflamme affronte des seigneurs déchus dans un monde en cendres.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(20, 68, 'Microsoft / Bungie', 16, 'FPS de science-fiction : le Spartan Master Chief combat le Covenant et découvre l''anneau Halo.', '2025-08-31 19:55:58', '2025-08-31 19:55:58');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Action', '2025-08-31 17:44:57', '2025-08-31 17:44:57'),
(2, 'Adventure', '2025-08-31 17:44:57', '2025-08-31 17:44:57'),
(3, 'Fantasy', '2025-08-31 17:44:57', '2025-08-31 17:44:57'),
(4, 'Sci-Fi', '2025-08-31 17:44:57', '2025-08-31 17:44:57'),
(5, 'Drama', '2025-08-31 17:44:57', '2025-08-31 17:44:57');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` enum('movie','book','game') COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `year` smallint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_media_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=398 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `user_id`, `type`, `title`, `image_path`, `year`, `created_at`, `updated_at`) VALUES
(40, 3, 'book', '1984', '/uploads/media/ad3b9ece69ebc397e2e5de2d405df144.jpg', 1949, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(41, 3, 'book', 'Bilbo le Hobbit', '/uploads/media/86e9282f45a5744f685ca1c12e0cb757.jpg', 1937, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(42, 3, 'book', 'Harry Potter à l\'école des sorciers', '/uploads/media/b1bb3e8783e91185f98cb3fb29516fd9.jpg', 1997, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(43, 3, 'book', 'L\'Alchimiste', '/uploads/media/f66a4b6704d3752afcfb355cbfc1cc1a.jpg', 1988, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(44, 3, 'book', 'Da Vinci Code', '/uploads/media/8cffcbdf04c02cfb5117658bccab0d53.jpg', 2003, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(45, 3, 'book', 'Shining', '/uploads/media/a4197e2dd27408b2f5c7441841209ba0.jpg', 1977, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(46, 3, 'book', 'Les Misérables', '/uploads/media/7c62574013d884ab970513aeff326b14.jpg', 1862, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(47, 3, 'book', 'L\'Attrape-cœurs', '/uploads/media/28eff675a8c68c3ce0b2750776e384cb.jpg', 1951, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(48, 3, 'book', 'Dune', '/uploads/media/73f9b4c23e220bfe24c83e30f879150a.jpg', 1965, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(49, 3, 'book', 'La Communauté de l\'Anneau', '/uploads/media/9a277c652203be985b1759b091d4c404.jpg', 1954, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(50, 3, 'movie', 'Matrix', '/uploads/media/7b918619530b47b28b9f4dcf9ff71254.jpg', 1999, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(51, 3, 'movie', 'Interstellar', '/uploads/media/afb069b2151a1c11ca00b8932334d231.jpg', 2014, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(52, 3, 'movie', 'The Dark Knight : Le Chevalier noir', '/uploads/media/eb0187d754b3856cab19a9267618cde3.jpg', 2008, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(53, 3, 'movie', 'Titanic', '/uploads/media/f7e7edc37378a72d163fb8582a47955f.jpg', 1997, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(54, 3, 'movie', 'Le Parrain', '/uploads/media/f9b8c0af15f571e9991ba050e747b4d6.jpg', 1972, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(55, 3, 'movie', 'Les Évadés', '/uploads/media/146d83a4427c39cf06d9e178ab80c994.jpg', 1994, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(56, 3, 'movie', 'Blade Runner', '/uploads/media/5a7ffb3cda2636a78cddcc7de78f67a9.jpg', 1982, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(57, 3, 'movie', 'Star Wars, épisode IV : Un nouvel espoir', '/uploads/media/e33665af5587661c5a5e9037f8331f1f.jpg', 1977, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(58, 3, 'movie', 'Le Seigneur des anneaux : La Communauté de l\'Anneau', '/uploads/media/2822438d99faf8f665100fa03105b0d7.jpg', 2001, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(59, 3, 'movie', 'Avatar', '/uploads/media/81cd1a93c5dd87048410a42791562b5f.jpg', 2009, '2025-08-31 19:55:58', '2025-09-03 18:56:16'),
(60, 3, 'game', 'The Witcher 3 : Wild Hunt', '/uploads/media/5bf0dd3c85b957b643c8534368e431f1.jpg', 2015, '2025-08-31 19:55:58', '2025-09-03 19:02:05'),
(61, 3, 'game', 'Minecraft', '/uploads/media/d103061767e725e03904cb096a75fe00.jpg', 2011, '2025-08-31 19:55:58', '2025-09-03 19:02:08'),
(62, 3, 'game', 'Red Dead Redemption 2', '/uploads/media/80f3f88b313066ec3332b1751f790751.jpg', 2018, '2025-08-31 19:55:58', '2025-09-03 19:02:10'),
(63, 3, 'game', 'Final Fantasy VII', '/uploads/media/7e5ccbb0d551c0d5f7209b932bf58e5f.jpg', 1997, '2025-08-31 19:55:58', '2025-09-03 19:02:12'),
(64, 3, 'game', 'The Legend of Zelda : Ocarina of Time', '/uploads/media/72038bfa8653921dadb3aede8a1427c5.jpg', 1998, '2025-08-31 19:55:58', '2025-09-03 19:02:15'),
(65, 3, 'game', 'Super Mario Odyssey', '/uploads/media/09733dbac91ee6484bc75546e2d51480.jpg', 2017, '2025-08-31 19:55:58', '2025-09-03 19:02:17'),
(66, 3, 'game', 'Elden Ring', '/uploads/media/d7b958733eef2d4e80336e0db0ffcb6d.jpg', 2022, '2025-08-31 19:55:58', '2025-09-03 19:02:20'),
(67, 3, 'game', 'Dark Souls III', '/uploads/media/887729faff5fcac71f0ca547b5e9fde0.jpg', 2016, '2025-08-31 19:55:58', '2025-09-03 19:02:23'),
(68, 3, 'game', 'Halo : Combat Evolved', '/uploads/media/d5af576c87e619a062abe299ea3e500c.jpg', 2001, '2025-08-31 19:55:58', '2025-09-03 19:02:26');

-- --------------------------------------------------------

--
-- Structure de la table `media_genres`
--

CREATE TABLE IF NOT EXISTS `media_genres` (
  `media_id` int NOT NULL,
  `genre_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`media_id`,`genre_id`),
  KEY `fk_media_genres_genre` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `media_genres`
--

INSERT INTO `media_genres` (`media_id`, `genre_id`, `created_at`, `updated_at`) VALUES
(40, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(40, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(41, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(41, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(42, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(42, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(43, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(44, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(44, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(45, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(46, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(47, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(48, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(48, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(48, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(49, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(49, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(50, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(50, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(51, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(51, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(51, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(52, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(52, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(53, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(54, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(54, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(55, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(56, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(56, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(57, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(57, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(57, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(58, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(58, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(58, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(59, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(59, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(59, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(60, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(60, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(60, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(61, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(62, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(62, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(62, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(63, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(63, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(64, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(64, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(65, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(65, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(66, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(66, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(66, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(67, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(67, 3, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(68, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(68, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58');

-- --------------------------------------------------------

--
-- Structure de la table `media_platform`
--

CREATE TABLE IF NOT EXISTS `media_platform` (
  `media_id` int NOT NULL,
  `platform_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`media_id`,`platform_id`),
  KEY `idx_media_platform_platform` (`platform_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `media_platform`
INSERT INTO `media_platform` (`media_id`, `platform_id`, `created_at`, `updated_at`) VALUES
(60, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(60, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(60, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(60, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(61, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(61, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(61, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(61, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(61, 6, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(62, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(62, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(62, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(63, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(64, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(65, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(66, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(66, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(66, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(67, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(67, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(67, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(68, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(68, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `duration_minutes` int DEFAULT NULL,
  `synopsis` text COLLATE utf8mb4_general_ci,
  `classification` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_movies_media` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `media_id`, `director`, `duration_minutes`, `synopsis`, `classification`, `created_at`, `updated_at`) VALUES
(12, 50, 'Lana et Lilly Wachowski', 136, 'Un hacker découvre que sa réalité est une simulation et rejoint la lutte contre les machines.', '-16', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(13, 51, 'Christopher Nolan', 169, 'Dans un futur proche, la Terre se meurt ; des astronautes franchissent un trou de ver pour sauver l\'humanité.', '-12', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(14, 52, 'Christopher Nolan', 152, 'Batman affronte le Joker, agent du chaos, et repousse ses propres limites morales.', '-12', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(15, 53, 'James Cameron', 195, 'À bord du Titanic, l\'amour naît entre Rose et Jack avant la tragédie.', 'Tous publics', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(16, 54, 'Francis Ford Coppola', 175, 'Chronique de la famille Corleone et de l\'ascension de Michael au sein de la mafia.', '-16', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(17, 55, 'Frank Darabont', 142, 'Deux prisonniers nouent une amitié indéfectible et gardent l\'espoir de s\'évader.', '-16', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(18, 56, 'Ridley Scott', 117, 'À Los Angeles en 2019, un blade runner traque des réplicants et questionne l\'humanité.', '-16', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(19, 57, 'George Lucas', 121, 'Un jeune fermier devient le héros de la Rébellion contre l\'Empire galactique.', 'Tous publics', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(20, 58, 'Peter Jackson', 178, 'Neuf compagnons escortent Frodon pour détruire l\'Anneau et vaincre Sauron.', '-12', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(21, 59, 'James Cameron', 162, 'Sur Pandora, un soldat paraplégique s\'unit aux Na\'vi et remet en cause sa loyauté.', '-12', '2025-08-31 19:55:58', '2025-08-31 19:55:58');

-- --------------------------------------------------------

--
-- Structure de la table `platform`
--

CREATE TABLE IF NOT EXISTS `platform` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `platform`
INSERT INTO `platform` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PC', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(2, 'PlayStation', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(3, 'Xbox', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(4, 'Nintendo 64', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(5, 'Nintendo Switch', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(6, 'Mobile', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'PHP MVC Starter', 'Nom du site web', '2025-08-26 13:40:58', '2025-08-26 13:40:58'),
(2, 'maintenance_mode', '0', 'Mode maintenance (0 = désactivé, 1 = activé)', '2025-08-26 13:40:58', '2025-08-26 13:40:58'),
(3, 'max_login_attempts', '5', 'Nombre maximum de tentatives de connexion', '2025-08-26 13:40:58', '2025-08-26 13:40:58'),
(4, 'session_timeout', '3600', 'Timeout de session en secondes', '2025-08-26 13:40:58', '2025-08-26 13:40:58');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_users_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john@example.com', '$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6', '2025-08-26 13:40:58', '2025-08-26 13:40:58'),
(2, 'Jane Smith', 'jane@example.com', '$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6', '2025-08-26 13:40:58', '2025-08-26 13:40:58'),
(3, 'Admin User', 'admin@example.com', '$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6', '2025-08-26 13:40:58', '2025-08-26 13:40:58'),
(4, 'Elyas Benyoub', 'ebenyoub@me.com', '$2y$10$Ujgg/K9w8jJSmwLvnWn.PuzDqbaJTor..B7p8DC.U4dF4Mv8fVCyu', '2025-08-26 18:59:27', '2025-08-26 18:59:27');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `user_stats`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE IF NOT EXISTS `user_stats` (
`new_users_30d` bigint
,`new_users_7d` bigint
,`total_users` bigint
);

-- --------------------------------------------------------

--
-- Structure de la vue `user_stats`
--
DROP TABLE IF EXISTS `user_stats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_stats`  AS SELECT count(0) AS `total_users`, count((case when (`users`.`created_at` >= (now() - interval 30 day)) then 1 end)) AS `new_users_30d`, count((case when (`users`.`created_at` >= (now() - interval 7 day)) then 1 end)) AS `new_users_7d` FROM `users` ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk_games_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media_genres`
--
ALTER TABLE `media_genres`
  ADD CONSTRAINT `fk_media_genres_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_media_genres_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `fk_movies_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;
COMMIT;

-- Contraintes pour la table `media_platform`
ALTER TABLE `media_platform`
  ADD CONSTRAINT `fk_media_platform_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_media_platform_platform` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
