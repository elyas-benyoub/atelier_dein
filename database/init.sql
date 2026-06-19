-- Installation MySQL de référence pour Atelier Dein.
-- Ce fichier est exécuté automatiquement par Docker lors de la première
-- initialisation d'une base vide. Les anciens scripts SQL sont conservés
-- temporairement et ne sont plus utilisés par Docker.

SET NAMES utf8mb4;

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

-- Compte de démonstration : admin@example.com / password123.
INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@example.com', '$2y$10$/vD8hGtkBJsAae2TiSkbV.jg0bnNDAFv8xBewH14.OKvR0PpeVbq6', 'admin')
ON DUPLICATE KEY UPDATE role = VALUES(role);

INSERT INTO genres (name) VALUES
    ('Action'), ('Adventure'), ('Fantasy'), ('Sci-Fi'), ('Drama')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO platform (name) VALUES
    ('PC'), ('PlayStation 5'), ('PlayStation 4'), ('Xbox Series X/S'),
    ('Xbox One'), ('Nintendo Switch'), ('Mobile')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO settings (key_name, value, description) VALUES
    ('site_name', 'Atelier Dein', 'Nom du site web'),
    ('maintenance_mode', '0', 'Mode maintenance (0 = désactivé, 1 = activé)'),
    ('max_login_attempts', '5', 'Nombre maximum de tentatives de connexion'),
    ('session_timeout', '3600', 'Timeout de session en secondes')
ON DUPLICATE KEY UPDATE
    value = VALUES(value),
    description = VALUES(description);
