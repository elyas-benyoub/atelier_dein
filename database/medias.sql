-- ==================================================================
-- Seed médias RÉELS (15 livres, 15 films, 15 jeux) pour l'utilisateur #3
-- Schéma: media (movie|book|game), books, movies, games, genres(1..5), media_genres
-- Idempotent: vérifie l'absence avant d'insérer (par (user_id,type,title))
-- Exécution : mysql -u root -p php_mvc_app < database/medias.sql
-- ==================================================================

START TRANSACTION;

SET @uid := 3;

-- =============================
--   Helpers: table temporaire
-- =============================
DROP TEMPORARY TABLE IF EXISTS tmp_items;
CREATE TEMPORARY TABLE tmp_items (
  kind ENUM('book','movie','game') NOT NULL,
  title VARCHAR(255) NOT NULL,
  year SMALLINT UNSIGNED NULL,
  g1 TINYINT NULL,
  g2 TINYINT NULL,
  UNIQUE KEY uq_kind_title_year(kind,title,year)
) ENGINE=MEMORY;

-- =============================
--   LIVRES (15 titres réels)
-- =============================
INSERT IGNORE INTO tmp_items(kind,title,year,g1,g2) VALUES
('book','1984',1949,4,5),
('book','Le Seigneur des anneaux : La Communauté de l’Anneau',1954,2,3),
('book','Le Hobbit',1937,2,3),
('book','Harry Potter à l’école des sorciers',1997,2,3),
('book','Orgueil et Préjugés',1813,5,NULL),
('book','L’Attrape-cœurs',1951,5,NULL),
('book','Gatsby le Magnifique',1925,5,NULL),
('book','Moby Dick',1851,2,5),
('book','Guerre et Paix',1869,5,NULL),
('book','Crime et Châtiment',1866,5,NULL),
('book','L’Alchimiste',1988,5,2),
('book','Dune',1965,4,2),
('book','Le Meilleur des mondes',1932,4,5),
('book','Le Nom de la rose',1980,2,5),
('book','La Route',2006,5,4);

-- Crée media s’il manque
INSERT INTO media(user_id,type,title,year)
SELECT @uid, t.kind, t.title, t.year
FROM tmp_items t
LEFT JOIN media m
  ON m.user_id=@uid AND m.type=t.kind AND m.title=t.title AND (m.year <=> t.year)
WHERE m.id IS NULL AND t.kind='book';

-- Détails books (ISBN NULL si inconnu, respecte UNIQUE)
INSERT INTO books(media_id,author,isbn,page_count,summary,publication_year)
SELECT m.id,
       CASE m.title
         WHEN '1984' THEN 'George Orwell'
         WHEN 'Le Seigneur des anneaux : La Communauté de l’Anneau' THEN 'J.R.R. Tolkien'
         WHEN 'Le Hobbit' THEN 'J.R.R. Tolkien'
         WHEN 'Harry Potter à l’école des sorciers' THEN 'J.K. Rowling'
         WHEN 'Orgueil et Préjugés' THEN 'Jane Austen'
         WHEN 'L’Attrape-cœurs' THEN 'J.D. Salinger'
         WHEN 'Gatsby le Magnifique' THEN 'F. Scott Fitzgerald'
         WHEN 'Moby Dick' THEN 'Herman Melville'
         WHEN 'Guerre et Paix' THEN 'Léon Tolstoï'
         WHEN 'Crime et Châtiment' THEN 'Fiodor Dostoïevski'
         WHEN 'L’Alchimiste' THEN 'Paulo Coelho'
         WHEN 'Dune' THEN 'Frank Herbert'
         WHEN 'Le Meilleur des mondes' THEN 'Aldous Huxley'
         WHEN 'Le Nom de la rose' THEN 'Umberto Eco'
         WHEN 'La Route' THEN 'Cormac McCarthy'
         ELSE 'Auteur inconnu'
       END AS author,
       NULL AS isbn,
       CASE m.title
         WHEN '1984' THEN 328
         WHEN 'Le Seigneur des anneaux : La Communauté de l’Anneau' THEN 432
         WHEN 'Le Hobbit' THEN 310
         WHEN 'Harry Potter à l’école des sorciers' THEN 320
         WHEN 'Orgueil et Préjugés' THEN 432
         WHEN 'L’Attrape-cœurs' THEN 277
         WHEN 'Gatsby le Magnifique' THEN 180
         WHEN 'Moby Dick' THEN 585
         WHEN 'Guerre et Paix' THEN 1464
         WHEN 'Crime et Châtiment' THEN 671
         WHEN 'L’Alchimiste' THEN 208
         WHEN 'Dune' THEN 896
         WHEN 'Le Meilleur des mondes' THEN 288
         WHEN 'Le Nom de la rose' THEN 640
         WHEN 'La Route' THEN 256
         ELSE 250
       END AS page_count,
       CONCAT('Résumé de "',m.title,'" (édition FR).') AS summary,
       m.year
FROM media m
LEFT JOIN books b ON b.media_id=m.id
WHERE m.user_id=@uid AND m.type='book' AND b.media_id IS NULL;

-- Genres pour livres
INSERT INTO media_genres(media_id,genre_id)
SELECT m.id, t.g1 FROM tmp_items t
JOIN media m ON m.user_id=@uid AND m.type='book' AND m.title=t.title
LEFT JOIN media_genres mg ON mg.media_id=m.id AND mg.genre_id=t.g1
WHERE t.kind='book' AND t.g1 IS NOT NULL AND mg.media_id IS NULL;

INSERT INTO media_genres(media_id,genre_id)
SELECT m.id, t.g2 FROM tmp_items t
JOIN media m ON m.user_id=@uid AND m.type='book' AND m.title=t.title
LEFT JOIN media_genres mg ON mg.media_id=m.id AND mg.genre_id=t.g2
WHERE t.kind='book' AND t.g2 IS NOT NULL AND mg.media_id IS NULL;

-- =============================
--   FILMS (15 titres réels)
-- =============================
INSERT IGNORE INTO tmp_items(kind,title,year,g1,g2) VALUES
('movie','Les Évadés',1994,5,2), -- The Shawshank Redemption
('movie','Le Parrain',1972,5,1),
('movie','The Dark Knight : Le Chevalier noir',2008,1,5),
('movie','La Liste de Schindler',1993,5,NULL),
('movie','12 Hommes en colère',1957,5,NULL),
('movie','Le Parrain, 2e partie',1974,5,1),
('movie','Pulp Fiction',1994,1,5),
('movie','Le Seigneur des anneaux : Le Retour du roi',2003,2,3),
('movie','Le Bon, la Brute et le Truand',1966,1,2),
('movie','Forrest Gump',1994,5,NULL),
('movie','Fight Club',1999,5,1),
('movie','Inception',2010,4,2),
('movie','Le Seigneur des anneaux : La Communauté de l’Anneau',2001,2,3),
('movie','Star Wars, épisode V : L’Empire contre-attaque',1980,4,2),
('movie','Interstellar',2014,4,5);

INSERT INTO media(user_id,type,title,year)
SELECT @uid, t.kind, t.title, t.year
FROM tmp_items t
LEFT JOIN media m
  ON m.user_id=@uid AND m.type=t.kind AND m.title=t.title AND (m.year <=> t.year)
WHERE m.id IS NULL AND t.kind='movie';

INSERT INTO movies(media_id,director,duration_minutes,synopsis,classification)
SELECT m.id,
       CASE m.title
         WHEN 'Les Évadés' THEN 'Frank Darabont'
         WHEN 'Le Parrain' THEN 'Francis Ford Coppola'
         WHEN 'The Dark Knight : Le Chevalier noir' THEN 'Christopher Nolan'
         WHEN 'La Liste de Schindler' THEN 'Steven Spielberg'
         WHEN '12 Hommes en colère' THEN 'Sidney Lumet'
         WHEN 'Le Parrain, 2e partie' THEN 'Francis Ford Coppola'
         WHEN 'Pulp Fiction' THEN 'Quentin Tarantino'
         WHEN 'Le Seigneur des anneaux : Le Retour du roi' THEN 'Peter Jackson'
         WHEN 'Le Bon, la Brute et le Truand' THEN 'Sergio Leone'
         WHEN 'Forrest Gump' THEN 'Robert Zemeckis'
         WHEN 'Fight Club' THEN 'David Fincher'
         WHEN 'Inception' THEN 'Christopher Nolan'
         WHEN 'Le Seigneur des anneaux : La Communauté de l’Anneau' THEN 'Peter Jackson'
         WHEN 'Star Wars, épisode V : L’Empire contre-attaque' THEN 'Irvin Kershner'
         WHEN 'Interstellar' THEN 'Christopher Nolan'
         ELSE 'Réalisateur inconnu'
       END AS director,
       CASE m.title
         WHEN 'Les Évadés' THEN 142
         WHEN 'Le Parrain' THEN 175
         WHEN 'The Dark Knight : Le Chevalier noir' THEN 152
         WHEN 'La Liste de Schindler' THEN 195
         WHEN '12 Hommes en colère' THEN 96
         WHEN 'Le Parrain, 2e partie' THEN 202
         WHEN 'Pulp Fiction' THEN 154
         WHEN 'Le Seigneur des anneaux : Le Retour du roi' THEN 201
         WHEN 'Le Bon, la Brute et le Truand' THEN 178
         WHEN 'Forrest Gump' THEN 142
         WHEN 'Fight Club' THEN 139
         WHEN 'Inception' THEN 148
         WHEN 'Le Seigneur des anneaux : La Communauté de l’Anneau' THEN 178
         WHEN 'Star Wars, épisode V : L’Empire contre-attaque' THEN 124
         WHEN 'Interstellar' THEN 169
         ELSE 120
       END AS duration_minutes,
       CONCAT('Synopsis de "',m.title,'" (édition FR).') AS synopsis,
       CASE m.title
         WHEN 'The Dark Knight : Le Chevalier noir' THEN '-12'
         WHEN 'Pulp Fiction' THEN '-16'
         WHEN 'Fight Club' THEN '-16'
         WHEN 'Le Bon, la Brute et le Truand' THEN '-12'
         WHEN 'Le Parrain' THEN '-16'
         WHEN 'Le Parrain, 2e partie' THEN '-16'
         ELSE 'Tous publics'
       END AS classification
FROM media m
LEFT JOIN movies mv ON mv.media_id=m.id
WHERE m.user_id=@uid AND m.type='movie' AND mv.media_id IS NULL;

-- Genres films
INSERT INTO media_genres(media_id,genre_id)
SELECT m.id, t.g1 FROM tmp_items t
JOIN media m ON m.user_id=@uid AND m.type='movie' AND m.title=t.title
LEFT JOIN media_genres mg ON mg.media_id=m.id AND mg.genre_id=t.g1
WHERE t.kind='movie' AND t.g1 IS NOT NULL AND mg.media_id IS NULL;

INSERT INTO media_genres(media_id,genre_id)
SELECT m.id, t.g2 FROM tmp_items t
JOIN media m ON m.user_id=@uid AND m.type='movie' AND m.title=t.title
LEFT JOIN media_genres mg ON mg.media_id=m.id AND mg.genre_id=t.g2
WHERE t.kind='movie' AND t.g2 IS NOT NULL AND mg.media_id IS NULL;

-- =============================
--   JEUX (15 titres réels)
-- =============================
INSERT IGNORE INTO tmp_items(kind,title,year,g1,g2) VALUES
('game','The Legend of Zelda : Ocarina of Time',1998,2,3),
('game','The Witcher 3 : Wild Hunt',2015,2,3),
('game','Red Dead Redemption 2',2018,2,5),
('game','Super Mario Odyssey',2017,2,1),
('game','The Legend of Zelda : Breath of the Wild',2017,2,3),
('game','Elden Ring',2022,1,2),
('game','Half-Life 2',2004,1,4),
('game','Portal 2',2011,2,4),
('game','The Last of Us',2013,1,5),
('game','God of War (2018)',2018,1,2),
('game','Grand Theft Auto V',2013,1,2),
('game','Dark Souls',2011,1,2),
('game','Mass Effect 2',2010,2,4),
('game','Metal Gear Solid V : The Phantom Pain',2015,1,2),
('game','Halo : Combat Evolved',2001,1,4);

INSERT INTO media(user_id,type,title,year)
SELECT @uid, t.kind, t.title, t.year
FROM tmp_items t
LEFT JOIN media m
  ON m.user_id=@uid AND m.type=t.kind AND m.title=t.title AND (m.year <=> t.year)
WHERE m.id IS NULL AND t.kind='game';

INSERT INTO games(media_id,publisher,platform,min_age,description)
SELECT m.id,
       CASE m.title
         WHEN 'The Legend of Zelda : Ocarina of Time' THEN 'Nintendo'
         WHEN 'The Witcher 3 : Wild Hunt' THEN 'CD Projekt'
         WHEN 'Red Dead Redemption 2' THEN 'Rockstar Games'
         WHEN 'Super Mario Odyssey' THEN 'Nintendo'
         WHEN 'The Legend of Zelda : Breath of the Wild' THEN 'Nintendo'
         WHEN 'Elden Ring' THEN 'Bandai Namco / FromSoftware'
         WHEN 'Half-Life 2' THEN 'Valve'
         WHEN 'Portal 2' THEN 'Valve'
         WHEN 'The Last of Us' THEN 'Sony Interactive Entertainment'
         WHEN 'God of War (2018)' THEN 'Sony Interactive Entertainment'
         WHEN 'Grand Theft Auto V' THEN 'Rockstar Games'
         WHEN 'Dark Souls' THEN 'Bandai Namco / FromSoftware'
         WHEN 'Mass Effect 2' THEN 'Electronic Arts'
         WHEN 'Metal Gear Solid V : The Phantom Pain' THEN 'Konami'
         WHEN 'Halo : Combat Evolved' THEN 'Microsoft / Bungie'
         ELSE 'Éditeur inconnu'
       END AS publisher,
       CASE m.title
         WHEN 'The Legend of Zelda : Ocarina of Time' THEN 'Nintendo 64'
         WHEN 'The Witcher 3 : Wild Hunt' THEN 'PC / PlayStation / Xbox / Switch'
         WHEN 'Red Dead Redemption 2' THEN 'PlayStation / Xbox / PC'
         WHEN 'Super Mario Odyssey' THEN 'Nintendo Switch'
         WHEN 'The Legend of Zelda : Breath of the Wild' THEN 'Nintendo Switch / Wii U'
         WHEN 'Elden Ring' THEN 'PC / PlayStation / Xbox'
         WHEN 'Half-Life 2' THEN 'PC'
         WHEN 'Portal 2' THEN 'PC / Console'
         WHEN 'The Last of Us' THEN 'PlayStation'
         WHEN 'God of War (2018)' THEN 'PlayStation'
         WHEN 'Grand Theft Auto V' THEN 'PC / PlayStation / Xbox'
         WHEN 'Dark Souls' THEN 'PC / PlayStation / Xbox'
         WHEN 'Mass Effect 2' THEN 'PC / PlayStation / Xbox'
         WHEN 'Metal Gear Solid V : The Phantom Pain' THEN 'PC / PlayStation / Xbox'
         WHEN 'Halo : Combat Evolved' THEN 'Xbox / PC'
         ELSE 'Multi-platform'
       END AS platform,
       CASE m.title
         WHEN 'Super Mario Odyssey' THEN 7
         WHEN 'Portal 2' THEN 10
         WHEN 'Half-Life 2' THEN 16
         WHEN 'Halo : Combat Evolved' THEN 16
         ELSE 18
       END AS min_age,
       CONCAT('Description de "',m.title,'" (édition FR).') AS description
FROM media m
LEFT JOIN games g ON g.media_id=m.id
WHERE m.user_id=@uid AND m.type='game' AND g.media_id IS NULL;

-- Genres jeux
INSERT INTO media_genres(media_id,genre_id)
SELECT m.id, t.g1 FROM tmp_items t
JOIN media m ON m.user_id=@uid AND m.type='game' AND m.title=t.title
LEFT JOIN media_genres mg ON mg.media_id=m.id AND mg.genre_id=t.g1
WHERE t.kind='game' AND t.g1 IS NOT NULL AND mg.media_id IS NULL;

INSERT INTO media_genres(media_id,genre_id)
SELECT m.id, t.g2 FROM tmp_items t
JOIN media m ON m.user_id=@uid AND m.type='game' AND m.title=t.title
LEFT JOIN media_genres mg ON mg.media_id=m.id AND mg.genre_id=t.g2
WHERE t.kind='game' AND t.g2 IS NOT NULL AND mg.media_id IS NULL;

COMMIT;