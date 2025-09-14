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
 * Supprime un média par son ID.
 *
 * @param int $media_id
 * @return bool succès/échec
 */
function delete_media($media_id)
{
    $query = "DELETE FROM media WHERE id = ?";
    return db_execute($query, [$media_id]);
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


