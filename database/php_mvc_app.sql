-- MySQL dump 10.13  Distrib 8.0.40, for macos12.7 (arm64)
--
-- Host: localhost    Database: php_mvc_app
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `php_mvc_app`
--

/*!40000 DROP DATABASE IF EXISTS `php_mvc_app`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `php_mvc_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `php_mvc_app`;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `page_count` int DEFAULT NULL,
  `summary` text,
  `publication_year` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `fk_books_media` (`media_id`),
  CONSTRAINT `fk_books_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (18,40,'George Orwell','9780451524935',328,'Dans un régime totalitaire, Winston Smith remet en cause la propagande du Parti et rêve de liberté.',1949,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(19,41,'J.R.R. Tolkien','9780547928227',310,'Un hobbit tranquille se lance malgré lui dans une quête avec treize nains pour reprendre un trésor volé par un dragon.',1937,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(20,42,'J.K. Rowling','9780590353427',320,'Orphelin, Harry découvre qu\'il est sorcier et rejoint Poudlard, où un terrible secret l\'attend.',1997,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(21,43,'Paulo Coelho','9780061122415',208,'Un jeune berger andalou traverse le désert à la recherche d\'un trésor et de sa Légende personnelle.',1988,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(22,44,'Dan Brown','9780307474278',592,'Un professeur de symbologie et une cryptologue enquêtent sur un meurtre au Louvre et un secret millénaire.',2003,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(23,45,'Stephen King','9780307743657',688,'Dans un hôtel isolé, un écrivain sombre dans la folie tandis que des forces maléfiques s\'acharnent sur sa famille.',1977,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(24,46,'Victor Hugo','9782070409181',1463,'L\'épopée de Jean Valjean dans la France du XIXe siècle, entre rédemption, injustice et luttes sociales.',1862,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(25,47,'J.D. Salinger','9780316769488',277,'Holden Caulfield erre dans New York, en proie au désenchantement de l\'adolescence.',1951,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(26,48,'Frank Herbert','9780441172719',896,'Sur la planète désertique Arrakis, Paul Atréides affronte complots et prophéties autour de l\'épice.',1965,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(27,49,'J.R.R. Tolkien','9780547928210',432,'Frodon entreprend de détruire l\'Anneau unique avec l\'aide d\'une communauté de héros.',1954,'2025-08-31 19:55:58','2025-08-31 19:55:58');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `platform` varchar(100) DEFAULT NULL,
  `min_age` int DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_games_media` (`media_id`),
  CONSTRAINT `fk_games_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (12,60,'CD Projekt','PC / PlayStation / Xbox / Switch',18,'RPG en monde ouvert : Geralt de Riv traque la Chasse sauvage pour retrouver Ciri.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(13,61,'Mojang Studios','Multi-platform',7,'Jeu bac à sable : explore, mine, construis et survie dans des mondes procéduraux.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(14,62,'Rockstar Games','PlayStation / Xbox / PC',18,'Western en monde ouvert : Arthur Morgan lutte entre loyauté et survie à la fin du Far West.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(15,63,'Square','PlayStation',12,'JRPG culte : Cloud et ses alliés combattent la Shinra et un antagoniste mythique.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(16,64,'Nintendo','Nintendo 64',12,'Aventure action : Link voyage dans le temps pour vaincre Ganondorf et sauver Hyrule.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(17,65,'Nintendo','Nintendo Switch',7,'Plateformer 3D : Mario parcourt des royaumes variés avec Cappy pour sauver Peach.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(18,66,'FromSoftware / Bandai Namco','PC / PlayStation / Xbox',16,'Action-RPG en monde ouvert : dans l\'Entre-terre, le Sans-éclat cherche à reforger l\'Anneau Primal.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(19,67,'FromSoftware / Bandai Namco','PC / PlayStation / Xbox',16,'Action-RPG exigeant : le Morteflamme affronte des seigneurs déchus dans un monde en cendres.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(20,68,'Microsoft / Bungie','Xbox / PC',16,'FPS de science-fiction : le Spartan Master Chief combat le Covenant et découvre l\'anneau Halo.','2025-08-31 19:55:58','2025-08-31 19:55:58'),(21,69,'Sony Interactive Entertainment','PlayStation',18,'Action-aventure : Kratos et son fils Atreus traversent les royaumes nordiques.','2025-08-31 19:55:58','2025-08-31 19:55:58');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,'Action','2025-08-31 17:44:57','2025-08-31 17:44:57'),(2,'Adventure','2025-08-31 17:44:57','2025-08-31 17:44:57'),(3,'Fantasy','2025-08-31 17:44:57','2025-08-31 17:44:57'),(4,'Sci-Fi','2025-08-31 17:44:57','2025-08-31 17:44:57'),(5,'Drama','2025-08-31 17:44:57','2025-08-31 17:44:57');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` enum('movie','book','game') NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_media_user` (`user_id`),
  CONSTRAINT `fk_media_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (40,3,'book','1984',1949,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(41,3,'book','Bilbo le Hobbit',1937,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(42,3,'book','Harry Potter à l\'école des sorciers',1997,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(43,3,'book','L\'Alchimiste',1988,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(44,3,'book','Da Vinci Code',2003,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(45,3,'book','Shining',1977,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(46,3,'book','Les Misérables',1862,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(47,3,'book','L\'Attrape-cœurs',1951,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(48,3,'book','Dune',1965,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(49,3,'book','La Communauté de l\'Anneau',1954,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(50,3,'movie','Matrix',1999,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(51,3,'movie','Interstellar',2014,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(52,3,'movie','The Dark Knight : Le Chevalier noir',2008,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(53,3,'movie','Titanic',1997,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(54,3,'movie','Le Parrain',1972,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(55,3,'movie','Les Évadés',1994,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(56,3,'movie','Blade Runner',1982,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(57,3,'movie','Star Wars, épisode IV : Un nouvel espoir',1977,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(58,3,'movie','Le Seigneur des anneaux : La Communauté de l\'Anneau',2001,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(59,3,'movie','Avatar',2009,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(60,3,'game','The Witcher 3 : Wild Hunt',2015,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(61,3,'game','Minecraft',2011,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(62,3,'game','Red Dead Redemption 2',2018,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(63,3,'game','Final Fantasy VII',1997,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(64,3,'game','The Legend of Zelda : Ocarina of Time',1998,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(65,3,'game','Super Mario Odyssey',2017,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(66,3,'game','Elden Ring',2022,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(67,3,'game','Dark Souls III',2016,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(68,3,'game','Halo : Combat Evolved',2001,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(69,3,'game','God of War (2018)',2018,'2025-08-31 19:55:58','2025-08-31 19:55:58');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_genres`
--

DROP TABLE IF EXISTS `media_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_genres` (
  `media_id` int NOT NULL,
  `genre_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`media_id`,`genre_id`),
  KEY `fk_media_genres_genre` (`genre_id`),
  CONSTRAINT `fk_media_genres_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_media_genres_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_genres`
--

LOCK TABLES `media_genres` WRITE;
/*!40000 ALTER TABLE `media_genres` DISABLE KEYS */;
INSERT INTO `media_genres` VALUES (40,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(40,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(41,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(41,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(42,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(42,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(43,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(44,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(44,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(45,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(46,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(47,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(48,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(48,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(48,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(49,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(49,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(50,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(50,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(51,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(51,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(51,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(52,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(52,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(53,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(54,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(54,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(55,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(56,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(56,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(57,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(57,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(57,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(58,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(58,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(58,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(59,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(59,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(59,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(60,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(60,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(60,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(61,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(62,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(62,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(62,5,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(63,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(63,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(64,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(64,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(65,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(65,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(66,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(66,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(66,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(67,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(67,3,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(68,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(68,4,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(69,1,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(69,2,'2025-08-31 19:55:58','2025-08-31 19:55:58'),(69,5,'2025-08-31 19:55:58','2025-08-31 19:55:58');
/*!40000 ALTER TABLE `media_genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `director` varchar(255) NOT NULL,
  `duration_minutes` int DEFAULT NULL,
  `synopsis` text,
  `classification` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_movies_media` (`media_id`),
  CONSTRAINT `fk_movies_media` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (12,50,'Lana et Lilly Wachowski',136,'Un hacker découvre que sa réalité est une simulation et rejoint la lutte contre les machines.','-16','2025-08-31 19:55:58','2025-08-31 19:55:58'),(13,51,'Christopher Nolan',169,'Dans un futur proche, la Terre se meurt ; des astronautes franchissent un trou de ver pour sauver l\'humanité.','-12','2025-08-31 19:55:58','2025-08-31 19:55:58'),(14,52,'Christopher Nolan',152,'Batman affronte le Joker, agent du chaos, et repousse ses propres limites morales.','-12','2025-08-31 19:55:58','2025-08-31 19:55:58'),(15,53,'James Cameron',195,'À bord du Titanic, l\'amour naît entre Rose et Jack avant la tragédie.','Tous publics','2025-08-31 19:55:58','2025-08-31 19:55:58'),(16,54,'Francis Ford Coppola',175,'Chronique de la famille Corleone et de l\'ascension de Michael au sein de la mafia.','-16','2025-08-31 19:55:58','2025-08-31 19:55:58'),(17,55,'Frank Darabont',142,'Deux prisonniers nouent une amitié indéfectible et gardent l\'espoir de s\'évader.','-16','2025-08-31 19:55:58','2025-08-31 19:55:58'),(18,56,'Ridley Scott',117,'À Los Angeles en 2019, un blade runner traque des réplicants et questionne l\'humanité.','-16','2025-08-31 19:55:58','2025-08-31 19:55:58'),(19,57,'George Lucas',121,'Un jeune fermier devient le héros de la Rébellion contre l\'Empire galactique.','Tous publics','2025-08-31 19:55:58','2025-08-31 19:55:58'),(20,58,'Peter Jackson',178,'Neuf compagnons escortent Frodon pour détruire l\'Anneau et vaincre Sauron.','-12','2025-08-31 19:55:58','2025-08-31 19:55:58'),(21,59,'James Cameron',162,'Sur Pandora, un soldat paraplégique s\'unit aux Na\'vi et remet en cause sa loyauté.','-12','2025-08-31 19:55:58','2025-08-31 19:55:58');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key_name` varchar(100) NOT NULL,
  `value` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','PHP MVC Starter','Nom du site web','2025-08-26 13:40:58','2025-08-26 13:40:58'),(2,'maintenance_mode','0','Mode maintenance (0 = désactivé, 1 = activé)','2025-08-26 13:40:58','2025-08-26 13:40:58'),(3,'max_login_attempts','5','Nombre maximum de tentatives de connexion','2025-08-26 13:40:58','2025-08-26 13:40:58'),(4,'session_timeout','3600','Timeout de session en secondes','2025-08-26 13:40:58','2025-08-26 13:40:58');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `user_stats`
--

DROP TABLE IF EXISTS `user_stats`;
/*!50001 DROP VIEW IF EXISTS `user_stats`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `user_stats` AS SELECT 
 1 AS `total_users`,
 1 AS `new_users_30d`,
 1 AS `new_users_7d`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_users_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','john@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-08-26 13:40:58','2025-08-26 13:40:58'),(2,'Jane Smith','jane@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-08-26 13:40:58','2025-08-26 13:40:58'),(3,'Admin User','admin@example.com','$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6','2025-08-26 13:40:58','2025-08-26 13:40:58'),(4,'Elyas Benyoub','ebenyoub@me.com','$2y$10$Ujgg/K9w8jJSmwLvnWn.PuzDqbaJTor..B7p8DC.U4dF4Mv8fVCyu','2025-08-26 18:59:27','2025-08-26 18:59:27');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'php_mvc_app'
--

--
-- Dumping routines for database 'php_mvc_app'
--

--
-- Current Database: `php_mvc_app`
--

USE `php_mvc_app`;

--
-- Final view structure for view `user_stats`
--

/*!50001 DROP VIEW IF EXISTS `user_stats`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_stats` AS select count(0) AS `total_users`,count((case when (`users`.`created_at` >= (now() - interval 30 day)) then 1 end)) AS `new_users_30d`,count((case when (`users`.`created_at` >= (now() - interval 7 day)) then 1 end)) AS `new_users_7d` from `users` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-31 22:00:16
