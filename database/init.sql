-- Installation MySQL de référence pour Atelier Dein.
-- Ce fichier est exécuté automatiquement par Docker lors de la première
-- initialisation d'une base vide. Les anciens scripts SQL sont conservés
-- temporairement et ne sont plus utilisés par Docker.

SET NAMES utf8mb4;
USE php_mvc_app;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    profile_picture VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS genres (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_genres_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS platform (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_platform_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS media (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    type ENUM('movie', 'book', 'game') NOT NULL,
    title VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    year SMALLINT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_media_user_id (user_id),
    KEY idx_media_type (type),
    CONSTRAINT fk_media_user
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS books (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    media_id INT UNSIGNED NOT NULL,
    author VARCHAR(255) NOT NULL,
    isbn VARCHAR(20) DEFAULT NULL,
    page_count INT UNSIGNED DEFAULT NULL,
    summary TEXT DEFAULT NULL,
    publication_year SMALLINT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_books_media_id (media_id),
    UNIQUE KEY uq_books_isbn (isbn),
    CONSTRAINT fk_books_media
        FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS movies (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    media_id INT UNSIGNED NOT NULL,
    director VARCHAR(255) NOT NULL,
    duration_minutes INT UNSIGNED DEFAULT NULL,
    synopsis TEXT DEFAULT NULL,
    classification VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_movies_media_id (media_id),
    CONSTRAINT fk_movies_media
        FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS games (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    media_id INT UNSIGNED NOT NULL,
    publisher VARCHAR(255) NOT NULL,
    platform VARCHAR(100) DEFAULT NULL,
    min_age INT UNSIGNED DEFAULT NULL,
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_games_media_id (media_id),
    CONSTRAINT fk_games_media
        FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS media_genres (
    media_id INT UNSIGNED NOT NULL,
    genre_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (media_id, genre_id),
    KEY idx_media_genres_genre_id (genre_id),
    CONSTRAINT fk_media_genres_media
        FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE,
    CONSTRAINT fk_media_genres_genre
        FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS media_platform (
    media_id INT UNSIGNED NOT NULL,
    platform_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (media_id, platform_id),
    KEY idx_media_platform_platform_id (platform_id),
    CONSTRAINT fk_media_platform_media
        FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE,
    CONSTRAINT fk_media_platform_platform
        FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS loans (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_u INT UNSIGNED NOT NULL,
    id_m INT UNSIGNED NOT NULL,
    loan_date DATETIME NOT NULL,
    due_date DATETIME NOT NULL,
    return_date DATETIME DEFAULT NULL,
    status ENUM('borrowed', 'returned', 'overdue') NOT NULL DEFAULT 'borrowed',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_loans_user_status (id_u, status),
    KEY idx_loans_media_status (id_m, status),
    CONSTRAINT fk_loans_user
        FOREIGN KEY (id_u) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_loans_media
        FOREIGN KEY (id_m) REFERENCES media (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    read_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key_name VARCHAR(100) NOT NULL,
    value TEXT DEFAULT NULL,
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_settings_key_name (key_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Compte administrateur initial : admin@example.com / password123.
INSERT INTO users (id, name, email, password, role)
VALUES (1, 'Admin User', 'admin@example.com', '$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6', 'admin')
ON DUPLICATE KEY UPDATE role = VALUES(role);

INSERT INTO genres (id, name) VALUES
    (1, 'Action'), (2, 'Adventure'), (3, 'Fantasy'), (4, 'Sci-Fi'), (5, 'Drama')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO platform (id, name) VALUES
    (1, 'PC'), (2, 'PlayStation 5'), (3, 'PlayStation 4'), (4, 'Xbox Series X/S'),
    (5, 'Xbox One'), (6, 'Nintendo Switch'), (7, 'Mobile'), (8, 'Nintendo 64')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO settings (key_name, value, description) VALUES
    ('site_name', 'Atelier Dein', 'Nom du site web'),
    ('maintenance_mode', '0', 'Mode maintenance (0 = désactivé, 1 = activé)'),
    ('max_login_attempts', '5', 'Nombre maximum de tentatives de connexion'),
    ('session_timeout', '3600', 'Timeout de session en secondes')
ON DUPLICATE KEY UPDATE
    value = VALUES(value),
    description = VALUES(description);

-- LIVRES (IDs 1 à 15)
INSERT INTO media (id, user_id, type, title, image_path, year) VALUES
(1, 1, 'book', '1984', '/uploads/media/ad3b9ece69ebc397e2e5de2d405df144.jpg', 1949),
(2, 1, 'book', 'Le Seigneur des anneaux : La Communauté de l’Anneau', '/uploads/media/9a277c652203be985b1759b091d4c404.jpg', 1954),
(3, 1, 'book', 'Le Hobbit', '/uploads/media/86e9282f45a5744f685ca1c12e0cb757.jpg', 1937),
(4, 1, 'book', 'Harry Potter à l’école des sorciers', '/uploads/media/b1bb3e8783e91185f98cb3fb29516fd9.jpg', 1997),
(5, 1, 'book', 'Orgueil et Préjugés', '/uploads/media/cb25c047234d0c4003b0b983cabe38fb.jpg', 1813),
(6, 1, 'book', 'L’Attrape-cœurs', '/uploads/media/28eff675a8c68c3ce0b2750776e384cb.jpg', 1951),
(7, 1, 'book', 'Gatsby le Magnifique', '/uploads/media/8cffcbdf04c02cfb5117658bccab0d53.jpg', 1925),
(8, 1, 'book', 'Moby Dick', '/uploads/media/7c62574013d884ab970513aeff326b14.jpg', 1851),
(9, 1, 'book', 'Guerre et Paix', '/uploads/media/01d3777a7f990d6495b3be31fd4a4955.jpg', 1869),
(10, 1, 'book', 'Crime et Châtiment', '/uploads/media/cece1a4d988800e13621410586cf9810.jpg', 1866),
(11, 1, 'book', 'L’Alchimiste', '/uploads/media/f66a4b6704d3752afcfb355cbfc1cc1a.jpg', 1988),
(12, 1, 'book', 'Dune', '/uploads/media/73f9b4c23e220bfe24c83e30f879150a.jpg', 1965),
(13, 1, 'book', 'Le Meilleur des mondes', '/uploads/media/25a4201346389b7cbd334e7f3d7ea90f.jpg', 1932),
(14, 1, 'book', 'Le Nom de la rose', '/uploads/media/ab5976de6cd025c28cbb41a08e4e0949.jpg', 1980),
(15, 1, 'book', 'La Route', '/uploads/media/b6a801f5d5cce0f146afaea6684d5865.jpg', 2006);

INSERT INTO books (media_id, author, isbn, page_count, summary, publication_year) VALUES
(1, 'George Orwell', '9780451524935', 328, 'Dans un régime totalitaire, Winston Smith remet en cause la propagande du Parti et rêve de liberté.', 1949),
(2, 'J.R.R. Tolkien', '9780547928210', 432, 'Frodon entreprend de détruire l\'Anneau unique avec l\'aide d\'une communauté de héros.', 1954),
(3, 'J.R.R. Tolkien', '9780547928227', 310, 'Un hobbit tranquille se lance malgré lui dans une quête avec treize nains pour reprendre un trésor volé par un dragon.', 1937),
(4, 'J.K. Rowling', '9780590353427', 320, 'Orphelin, Harry découvre qu\'il est sorcier et rejoint Poudlard, où un terrible secret l\'attend.', 1997),
(5, 'Jane Austen', '9782070409182', 432, 'Résumé de "Orgueil et Préjugés" (édition FR).', 1813),
(6, 'J.D. Salinger', '9780316769488', 277, 'Holden Caulfield erre dans New York, en proie au désenchantement de l\'adolescence.', 1951),
(7, 'F. Scott Fitzgerald', '9780316769489', 180, 'Résumé de "Gatsby le Magnifique" (édition FR).', 1925),
(8, 'Herman Melville', '9780316769490', 585, 'Résumé de "Moby Dick" (édition FR).', 1851),
(9, 'Léon Tolstoï', '9782070409180', 1464, 'Résumé de "Guerre et Paix" (édition FR).', 1869),
(10, 'Fiodor Dostoïevski', '9782070409183', 671, 'Résumé de "Crime et Châtiment" (édition FR).', 1866),
(11, 'Paulo Coelho', '9780061122415', 208, 'Un jeune berger andalou traverse le désert à la recherche d\'un trésor et de sa Légende personnelle.', 1988),
(12, 'Frank Herbert', '9780441172719', 896, 'Sur la planète désertique Arrakis, Paul Atréides affronte complots et prophéties autour de l\'épice.', 1965),
(13, 'Aldous Huxley', '9780441172720', 288, 'Résumé de "Le Meilleur des mondes" (édition FR).', 1932),
(14, 'Umberto Eco', '9780441172721', 640, 'Résumé de "Le Nom de la rose" (édition FR).', 1980),
(15, 'Cormac McCarthy', '9780441172722', 256, 'Résumé de "La Route" (édition FR).', 2006);

-- FILMS (IDs 16 à 30)
INSERT INTO media (id, user_id, type, title, image_path, year) VALUES
(16, 1, 'movie', 'Les Évadés', '/uploads/media/146d83a4427c39cf06d9e178ab80c994.jpg', 1994),
(17, 1, 'movie', 'Le Parrain', '/uploads/media/f9b8c0af15f571e9991ba050e747b4d6.jpg', 1972),
(18, 1, 'movie', 'The Dark Knight : Le Chevalier noir', '/uploads/media/eb0187d754b3856cab19a9267618cde3.jpg', 2008),
(19, 1, 'movie', 'La Liste de Schindler', '/uploads/media/4a563733e419d9642812853daeed7691.jpeg', 1993),
(20, 1, 'movie', '12 Hommes en colère', '/uploads/media/4df31429a9bce39143c2ccb31fc5672b.jpeg', 1957),
(21, 1, 'movie', 'Le Parrain, 2e partie', '/uploads/media/6af013fd2dccb2fb4f3dfbd3e1c711a4.jpeg', 1974),
(22, 1, 'movie', 'Pulp Fiction', '/uploads/media/5a7ffb3cda2636a78cddcc7de78f67a9.jpg', 1994),
(23, 1, 'movie', 'Le Seigneur des anneaux : Le Retour du roi', '/uploads/media/81cd1a93c5dd87048410a42791562b5f.jpg', 2003),
(24, 1, 'movie', 'Le Bon, la Brute et le Truand', '/uploads/media/f7e7edc37378a72d163fb8582a47955f.jpg', 1966),
(25, 1, 'movie', 'Forrest Gump', '/uploads/media/7b918619530b47b28b9f4dcf9ff71254.jpg', 1994),
(26, 1, 'movie', 'Fight Club', '/uploads/media/e33665af5587661c5a5e9037f8331f1f.jpg', 1999),
(27, 1, 'movie', 'Inception', '/uploads/media/2822438d99faf8f665100fa03105b0d7.jpg', 2010),
(28, 1, 'movie', 'Le Seigneur des anneaux : La Communauté de l’Anneau', '/uploads/media/2822438d99faf8f665100fa03105b0d7.jpg', 2001),
(29, 1, 'movie', 'Star Wars, épisode V : L’Empire contre-attaque', '/uploads/media/ed6116a13c276395164ec4cc4082aebe.jpeg', 1980),
(30, 1, 'movie', 'Interstellar', '/uploads/media/afb069b2151a1c11ca00b8932334d231.jpg', 2014);

INSERT INTO movies (media_id, director, duration_minutes, synopsis, classification) VALUES
(16, 'Frank Darabont', 142, 'Deux prisonniers nouent une amitié indéfectible et gardent l\'espoir de s\'évader.', '-16'),
(17, 'Francis Ford Coppola', 175, 'Chronique de la famille Corleone et de l\'ascension de Michael au sein de la mafia.', '-16'),
(18, 'Christopher Nolan', 152, 'Batman affronte le Joker, agent du chaos, et repousse ses propres limites morales.', '-12'),
(19, 'Steven Spielberg', 195, 'Synopsis de "La Liste de Schindler" (édition FR).', 'Tous publics'),
(20, 'Sidney Lumet', 96, 'Synopsis de "12 Hommes en colère" (édition FR).', 'Tous publics'),
(21, 'Francis Ford Coppola', 202, 'Synopsis de "Le Parrain, 2e partie" (édition FR).', '-16'),
(22, 'Quentin Tarantino', 154, 'Synopsis de "Pulp Fiction" (édition FR).', '-16'),
(23, 'Peter Jackson', 201, 'Synopsis de "Le Seigneur des anneaux : Le Retour du roi" (édition FR).', 'Tous publics'),
(24, 'Sergio Leone', 178, 'Synopsis de "Le Bon, la Brute et le Truand" (édition FR).', '-12'),
(25, 'Robert Zemeckis', 142, 'Synopsis de "Forrest Gump" (édition FR).', 'Tous publics'),
(26, 'David Fincher', 139, 'Synopsis de "Fight Club" (édition FR).', '-16'),
(27, 'Christopher Nolan', 148, 'Synopsis de "Inception" (édition FR).', 'Tous publics'),
(28, 'Peter Jackson', 178, 'Neuf compagnons escortent Frodon pour détruire l\'Anneau et vaincre Sauron.', '-12'),
(29, 'Irvin Kershner', 124, 'Synopsis de "Star Wars, épisode V : L’Empire contre-attaque" (édition FR).', 'Tous publics'),
(30, 'Christopher Nolan', 169, 'Dans un futur proche, la Terre se meurt ; des astronautes franchissent un trou de ver pour sauver l\'humanité.', '-12');

-- JEUX (IDs 31 à 45)
INSERT INTO media (id, user_id, type, title, image_path, year) VALUES
(31, 1, 'game', 'The Legend of Zelda : Ocarina of Time', '/uploads/media/72038bfa8653921dadb3aede8a1427c5.jpg', 1998),
(32, 1, 'game', 'The Witcher 3 : Wild Hunt', '/uploads/media/5bf0dd3c85b957b643c8534368e431f1.jpg', 2015),
(33, 1, 'game', 'Red Dead Redemption 2', '/uploads/media/80f3f88b313066ec3332b1751f790751.jpg', 2018),
(34, 1, 'game', 'Super Mario Odyssey', '/uploads/media/09733dbac91ee6484bc75546e2d51480.jpg', 2017),
(35, 1, 'game', 'The Legend of Zelda : Breath of the Wild', '/uploads/media/cb25c047234d0c4003b0b983cabe38fb.jpg', 2017),
(36, 1, 'game', 'Elden Ring', '/uploads/media/d7b958733eef2d4e80336e0db0ffcb6d.jpg', 2022),
(37, 1, 'game', 'Half-Life 2', '/uploads/media/d103061767e725e03904cb096a75fe00.jpg', 2004),
(38, 1, 'game', 'Portal 2', '/uploads/media/7e5ccbb0d551c0d5f7209b932bf58e5f.jpg', 2011),
(39, 1, 'game', 'The Last of Us', '/uploads/media/d5af576c87e619a062abe299ea3e500c.jpg', 2013),
(40, 1, 'game', 'God of War (2018)', '/uploads/media/5630b851b6348abb12343f05a00ec734.jpg', 2018),
(41, 1, 'game', 'Grand Theft Auto V', '/uploads/media/5630b851b6348abb12343f05a00ec734.jpg', 2013),
(42, 1, 'game', 'Dark Souls', '/uploads/media/887729faff5fcac71f0ca547b5e9fde0.jpg', 2011),
(43, 1, 'game', 'Mass Effect 2', '/uploads/media/cb25c047234d0c4003b0b983cabe38fb.jpg', 2010),
(44, 1, 'game', 'Metal Gear Solid V : The Phantom Pain', '/uploads/media/5bf0dd3c85b957b643c8534368e431f1.jpg', 2015),
(45, 1, 'game', 'Halo : Combat Evolved', '/uploads/media/d5af576c87e619a062abe299ea3e500c.jpg', 2001);

INSERT INTO games (media_id, publisher, platform, min_age, description) VALUES
(31, 'Nintendo', 'Nintendo 64', 12, 'Aventure action : Link voyage dans le temps pour vaincre Ganondorf et sauver Hyrule.'),
(32, 'CD Projekt', 'PC / PlayStation / Xbox / Switch', 18, 'RPG en monde ouvert : Geralt de Riv traque la Chasse sauvage pour retrouver Ciri.'),
(33, 'Rockstar Games', 'PlayStation / Xbox / PC', 18, 'Western en monde ouvert : Arthur Morgan lutte entre loyauté et survie à la fin du Far West.'),
(34, 'Nintendo', 'Nintendo Switch', 7, 'Plateformer 3D : Mario parcourt des royaumes variés avec Cappy pour sauver Peach.'),
(35, 'Nintendo', 'Nintendo Switch / Wii U', 12, 'Description de "The Legend of Zelda : Breath of the Wild" (édition FR).'),
(36, 'Bandai Namco / FromSoftware', 'PC / PlayStation / Xbox', 16, 'Action-RPG en monde ouvert : dans l\'Entre-terre, le Sans-éclat cherche à reforger l\'Anneau Primal.'),
(37, 'Valve', 'PC', 16, 'Description de "Half-Life 2" (édition FR).'),
(38, 'Valve', 'PC / Console', 10, 'Description de "Portal 2" (édition FR).'),
(39, 'Sony Interactive Entertainment', 'PlayStation', 18, 'Description de "The Last of Us" (édition FR).'),
(40, 'Sony Interactive Entertainment', 'PlayStation', 18, 'Action-aventure : Kratos et son fils Atreus traversent les royaumes nordiques.'),
(41, 'Rockstar Games', 'PC / PlayStation / Xbox', 18, 'Description de "Grand Theft Auto V" (édition FR).'),
(42, 'Bandai Namco / FromSoftware', 'PC / PlayStation / Xbox', 18, 'Description de "Dark Souls" (édition FR).'),
(43, 'Electronic Arts', 'PC / PlayStation / Xbox', 18, 'Description de "Mass Effect 2" (édition FR).'),
(44, 'Konami', 'PC / PlayStation / Xbox', 18, 'Description de "Metal Gear Solid V : The Phantom Pain" (édition FR).'),
(45, 'Microsoft / Bungie', 'Xbox / PC', 16, 'FPS de science-fiction : le Spartan Master Chief combat le Covenant et découvre l\'anneau Halo.');

-- GENRES ASSOCIES
INSERT INTO media_genres (media_id, genre_id) VALUES
(1, 4), (1, 5),
(2, 2), (2, 3),
(3, 2), (3, 3),
(4, 2), (4, 3),
(5, 5),
(6, 5),
(7, 5),
(8, 2), (8, 5),
(9, 5),
(10, 5),
(11, 5), (11, 2),
(12, 4), (12, 2),
(13, 4), (13, 5),
(14, 2), (14, 5),
(15, 5), (15, 4),
(16, 5), (16, 2),
(17, 5), (17, 1),
(18, 1), (18, 5),
(19, 5),
(20, 5),
(21, 5), (21, 1),
(22, 1), (22, 5),
(23, 2), (23, 3),
(24, 1), (24, 2),
(25, 5),
(26, 5), (26, 1),
(27, 4), (27, 2),
(28, 2), (28, 3),
(29, 4), (29, 2),
(30, 4), (30, 5),
(31, 2), (31, 3),
(32, 2), (32, 3),
(33, 2), (33, 5),
(34, 2), (34, 1),
(35, 2), (35, 3),
(36, 1), (36, 2),
(37, 1), (37, 4),
(38, 2), (38, 4),
(39, 1), (39, 5),
(40, 1), (40, 2),
(41, 1), (41, 2),
(42, 1), (42, 2),
(43, 2), (43, 4),
(44, 1), (44, 2),
(45, 1), (45, 4)
ON DUPLICATE KEY UPDATE media_id = VALUES(media_id);

-- PLATEFORMES ASSOCIEES
INSERT INTO media_platform (media_id, platform_id) VALUES
(31, 8),
(32, 1), (32, 3), (32, 5), (32, 6),
(33, 1), (33, 3), (33, 5),
(34, 6),
(35, 6),
(36, 1), (36, 3), (36, 5),
(37, 1),
(38, 1), (38, 3),
(39, 3),
(40, 3),
(41, 1), (41, 3), (41, 5),
(42, 1), (42, 3), (42, 5),
(43, 1), (43, 3), (43, 5),
(44, 1), (44, 3), (44, 5),
(45, 1), (45, 5)
ON DUPLICATE KEY UPDATE media_id = VALUES(media_id);
