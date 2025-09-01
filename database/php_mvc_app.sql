-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 01 sep. 2025 à 08:06
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

CREATE TABLE `books` (
  `id` int NOT NULL,
  `media_id` int NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_count` int DEFAULT NULL,
  `summary` text COLLATE utf8mb4_general_ci,
  `publication_year` smallint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `contact_messages` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `media_id` int NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `platform` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `min_age` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `media_id`, `publisher`, `platform`, `min_age`, `description`, `created_at`, `updated_at`) VALUES
(12, 60, 'CD Projekt', 'PC / PlayStation / Xbox / Switch', 18, 'RPG en monde ouvert : Geralt de Riv traque la Chasse sauvage pour retrouver Ciri.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(13, 61, 'Mojang Studios', 'Multi-platform', 7, 'Jeu bac à sable : explore, mine, construis et survie dans des mondes procéduraux.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(14, 62, 'Rockstar Games', 'PlayStation / Xbox / PC', 18, 'Western en monde ouvert : Arthur Morgan lutte entre loyauté et survie à la fin du Far West.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(15, 63, 'Square', 'PlayStation', 12, 'JRPG culte : Cloud et ses alliés combattent la Shinra et un antagoniste mythique.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(16, 64, 'Nintendo', 'Nintendo 64', 12, 'Aventure action : Link voyage dans le temps pour vaincre Ganondorf et sauver Hyrule.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(17, 65, 'Nintendo', 'Nintendo Switch', 7, 'Plateformer 3D : Mario parcourt des royaumes variés avec Cappy pour sauver Peach.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(18, 66, 'FromSoftware / Bandai Namco', 'PC / PlayStation / Xbox', 16, 'Action-RPG en monde ouvert : dans l\'Entre-terre, le Sans-éclat cherche à reforger l\'Anneau Primal.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(19, 67, 'FromSoftware / Bandai Namco', 'PC / PlayStation / Xbox', 16, 'Action-RPG exigeant : le Morteflamme affronte des seigneurs déchus dans un monde en cendres.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(20, 68, 'Microsoft / Bungie', 'Xbox / PC', 16, 'FPS de science-fiction : le Spartan Master Chief combat le Covenant et découvre l\'anneau Halo.', '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(21, 69, 'Sony Interactive Entertainment', 'PlayStation', 18, 'Action-aventure : Kratos et son fils Atreus traversent les royaumes nordiques.', '2025-08-31 19:55:58', '2025-08-31 19:55:58');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `media` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` enum('movie','book','game') COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `year` smallint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `user_id`, `type`, `title`, `year`, `created_at`, `updated_at`) VALUES
(40, 3, 'book', '1984', 1949, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(41, 3, 'book', 'Bilbo le Hobbit', 1937, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(42, 3, 'book', 'Harry Potter à l\'école des sorciers', 1997, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(43, 3, 'book', 'L\'Alchimiste', 1988, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(44, 3, 'book', 'Da Vinci Code', 2003, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(45, 3, 'book', 'Shining', 1977, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(46, 3, 'book', 'Les Misérables', 1862, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(47, 3, 'book', 'L\'Attrape-cœurs', 1951, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(48, 3, 'book', 'Dune', 1965, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(49, 3, 'book', 'La Communauté de l\'Anneau', 1954, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(50, 3, 'movie', 'Matrix', 1999, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(51, 3, 'movie', 'Interstellar', 2014, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(52, 3, 'movie', 'The Dark Knight : Le Chevalier noir', 2008, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(53, 3, 'movie', 'Titanic', 1997, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(54, 3, 'movie', 'Le Parrain', 1972, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(55, 3, 'movie', 'Les Évadés', 1994, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(56, 3, 'movie', 'Blade Runner', 1982, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(57, 3, 'movie', 'Star Wars, épisode IV : Un nouvel espoir', 1977, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(58, 3, 'movie', 'Le Seigneur des anneaux : La Communauté de l\'Anneau', 2001, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(59, 3, 'movie', 'Avatar', 2009, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(60, 3, 'game', 'The Witcher 3 : Wild Hunt', 2015, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(61, 3, 'game', 'Minecraft', 2011, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(62, 3, 'game', 'Red Dead Redemption 2', 2018, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(63, 3, 'game', 'Final Fantasy VII', 1997, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(64, 3, 'game', 'The Legend of Zelda : Ocarina of Time', 1998, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(65, 3, 'game', 'Super Mario Odyssey', 2017, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(66, 3, 'game', 'Elden Ring', 2022, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(67, 3, 'game', 'Dark Souls III', 2016, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(68, 3, 'game', 'Halo : Combat Evolved', 2001, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(69, 3, 'game', 'God of War (2018)', 2018, '2025-08-31 19:55:58', '2025-08-31 19:55:58');

-- --------------------------------------------------------

--
-- Structure de la table `media_genres`
--

CREATE TABLE `media_genres` (
  `media_id` int NOT NULL,
  `genre_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
(68, 4, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(69, 1, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(69, 2, '2025-08-31 19:55:58', '2025-08-31 19:55:58'),
(69, 5, '2025-08-31 19:55:58', '2025-08-31 19:55:58');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `media_id` int NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `duration_minutes` int DEFAULT NULL,
  `synopsis` text COLLATE utf8mb4_general_ci,
  `classification` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `key_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
CREATE TABLE `user_stats` (
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
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `fk_books_media` (`media_id`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_games_media` (`media_id`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_user` (`user_id`);

--
-- Index pour la table `media_genres`
--
ALTER TABLE `media_genres`
  ADD PRIMARY KEY (`media_id`,`genre_id`),
  ADD KEY `fk_media_genres_genre` (`genre_id`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movies_media` (`media_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_name` (`key_name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
