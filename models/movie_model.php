<?php

/**
 * Ajoute un nouveau film dans la base de données.
 *
 * @param int    $media_id       ID du média associé au film
 * @param string $director       Réalisateur du film
 * @param int    $duration       Durée du film en minutes
 * @param string $synopsis       Synopsis du film
 * @param string $classification Classification du film (ex. PG, R)
 * @return bool  True en cas de succès, false en cas d'échec
 */
function add_movie($media_id, $director, $duration, $synopsis, $classification)
{
    $query = "INSERT INTO movies (media_id, director, duration_minutes, synopsis, classification) VALUES (?, ?, ?, ?, ?)";
    return db_execute($query, [$media_id, $director, $duration, $synopsis, $classification]);
}

/**
 * Crée un nouveau film ainsi que son média et ses genres dans une transaction.
 *
 * @param string      $title           Titre du film
 * @param string      $director        Réalisateur du film
 * @param int         $duration        Durée du film en minutes
 * @param string      $synopsis        Synopsis du film
 * @param string      $classification  Classification du film (ex. PG, R)
 * @param int|null    $pb_year         Année de publication (ou null si non renseignée)
 * @param array       $genres          Genres associés au film (IDs)
 * @param string|null $img_url         URL/chemin de l'image (ou null si absent)
 * @return bool       True en cas de succès, false en cas d'échec
 */
function create_movie($title, $director, $duration, $synopsis, $classification, $pb_year, $genres, $img_url)
{
    try {
        db_begin_transaction();

        $media_id = add_media($title, 'movie', $pb_year, $img_url);
        if (!$media_id) {
            throw new Exception("Échec de l'ajout dans 'media'.");
        }

        if (!add_movie($media_id, $director, $duration, $synopsis, $classification)) {
            throw new Exception("Echec de l'ajout dans la table 'movies'.");
        }

        if (!add_genres($media_id, $genres)) {
            throw new Exception("Echec de l'ajout dans la table 'genres'.");
        }

        db_commit();
        app_log('[create_movie] Ajout du film réussi.');
        return true;
    } catch (Throwable $e) {
        db_rollback();
        app_log('[create_movie] ' . $e->getMessage());
        return false;
    }
}

function get_all_movies()
{
    $query = "SELECT * FROM media where type = 'movie'";

    $data = db_select($query);
    
    return $data;
}

function get_movie_by_id($media_id) {
    $query = "SELECT director, duration_minutes, synopsis, classification FROM movies WHERE media_id = ?";
    return db_select($query, [$media_id]);
}