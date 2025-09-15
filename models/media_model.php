<?php

/**
 * Ajoute un média dans la base.
 *
 * Insère une nouvelle ligne dans la table `media` avec l'utilisateur courant,
 * le type de média (book, movie, game, ...), un titre, une image optionnelle
 * et une année de publication optionnelle.
 *
 * @param string      $title   Titre du média (obligatoire).
 * @param string      $type    Type de média ('book', 'movie', 'game', ...).
 * @param int|null    $pb_year Année de publication (NULL si non renseignée).
 * @param string|null $img_url URL/chemin de l'image (NULL si pas d'image).
 *
 * @return int|false  Retourne l'ID auto-incrémenté du média inséré
 *                    ou false si l'insertion a échoué.
 *
 */
function add_media($title, $type, $pb_year, $img_url)
{
    if (!is_logged_in()) {
        return false;
    }

    $user_id = current_user_id();

    $query = "INSERT INTO media (user_id, type, title, image_path, year) VALUES (?, ?, ?, ?, ?)";

    try {
        $ok = db_execute($query, [$user_id, $type, $title, $img_url, $pb_year]);

        if (!$ok) {
            app_log("[add_media] La requête à échoué.");
            return false;
        }

        return db_last_insert_id();
    } catch (Throwable $e) {
        app_log("[add_media] " . $e->getMessage());
        return false;
    }
}

/**
 * Supprime un média par son ID.
 *
 * @param int $media_id
 * @return bool succès/échec
 */
function delete_media($media_id)
{
    $media = get_media_by_id($media_id);

    $type = $media['type'];

    if ($type === 'book') {
        $query = "DELETE FROM books WHERE media_id = ?";
        db_execute($query, [$media_id]);
    } 
    elseif ($type === 'movie') {
        $query = "DELETE FROM movies WHERE media_id = ?";
        db_execute($query, [$media_id]);
    }
    elseif ($type === 'games') {
        $query = "DELETE FROM games WHERE media_id = ?";
        db_execute($query, [$media_id]);
    }

    $query = "DELETE FROM media_genres WHERE media_id = ?";
    db_execute($query, [$media_id]);

    $query = "DELETE FROM media WHERE id = ?";
    return db_execute($query, [$media_id]);
}

/**
 * Ajoute tous les genres liés à un média.
 *
 * @param int   $media_id
 * @param array $genres   IDs de genres
 * @return bool succès/échec
 */
function add_genres($media_id, $genres)
{
    foreach ($genres as $genre) {
        $query = "INSERT INTO media_genres (media_id, genre_id) VALUES (?, ?)";
        if (!db_execute($query, [$media_id, $genre])) {
           set_flash('error', "Les genres n'ont pas pu être ajoutés");
           return false;
        }
    }

    return true;
}

/**
 * Ajoute toutes les plateformes liées à un média.
 *
 * @param int   $media_id
 * @param array $platforms IDs de plateformes
 * @return bool succès/échec
 */
function add_platform($media_id, $platforms)
{
    foreach ($platforms as $platform) {
        $query = "INSERT INTO media_platform (media_id, platform_id) VALUES (?, ?)";
        if (!db_execute($query, [$media_id, $platform])) {
           set_flash('error', "Les plateformes n'ont pas pu être ajoutés");
            return false;
        }
    }

    return true;
}


/**
 * Récupère tous les genres.
 *
 * @return array [id => name]
 */
function get_all_genres()
{
    $query = "SELECT id, name FROM genres";

    $data = db_select($query);
    $genres = [];

    foreach ($data as $genre) {
        $genres[$genre['id']] = $genre['name'];
    }

    return $genres;
}

function get_all_media_genres(){

    $query = "SELECT media_id, genre_id FROM media_genres";

    $data = db_select($query);

    return $data;
}

function get_all_medias()
{
    $query = "SELECT * FROM media";

    $data = db_select($query);
    
    return $data;
}

function get_media_by_id($media_id) {
    $query = "SELECT * FROM media WHERE id = ?";
    return db_select($query, [$media_id]);
}

function get_book_by_id($media_id) {
    $query = "SELECT author, isbn, page_count, summary, publication_year FROM books WHERE media_id = ?";
    return db_select($query, [$media_id]);
}

function get_game_by_id($media_id) {
    $query = "SELECT publisher, min_age, description FROM games WHERE media_id = ?";
    return db_select($query, [$media_id]);
}

function search_media_by_title($q) {
    $q = strtolower(trim($q)); // make lowercase + clean spaces

    $like = '%' . $q . '%'; // wrap with % signs

    $query = "SELECT * FROM media WHERE LOWER(title) LIKE ?";

    return db_select($query, [$like]);
}

/**
 * Récupère toutes les plateformes.
 *
 * @return array [id => name]
 */
function get_all_platforms()
{
    $query = "SELECT id, name FROM platform";
    $data = db_select($query);

    $platforms = [];
    foreach ($data as $row) {
        $platforms[(int)$row['id']] = $row['name'];
    }
    return $platforms;
}

function get_genres_by_media_id($media_id) {
    $query = "
        select g.name
        from genres g
        join media_genres mg on mg.genre_id = g.id
        join media m on mg.media_id = m.id
        where m.id = ?;
    ";

    $data = db_select($query, [$media_id]);
    
    $genres = [];
    foreach ($data as $row) {
        $genres[] = $row['name'];
    }

    return $genres;
 }


/**
 * Récupère tous les médias disponibles (non empruntés)
 */
function get_all_media() {
    $sql = "SELECT m.*
            FROM media m
            WHERE m.id NOT IN (
                SELECT id_m 
                FROM loans 
                WHERE status = 'borrowed'
            )
            ORDER BY m.created_at DESC";
    return db_select($sql);
}

/**
 * Récupère tous les médias (même ceux empruntés)
 */
function get_all_media_with_status() {
    $sql = "SELECT m.*, 
                   CASE 
                     WHEN l.status = 'borrowed' THEN 'Emprunté'
                     ELSE 'Disponible'
                   END AS loan_status
            FROM media m
            LEFT JOIN loans l ON l.id_m = m.id AND l.status = 'borrowed'
            ORDER BY m.created_at DESC";
    return db_select($sql);
}


