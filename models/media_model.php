<?php

// Ajouter dans la table media, retourne le media_id
function 
add_media($title, $type, $pb_year, $images_name)
{
    if (!is_logged_in()) {
        set_flash('error', "Vous devez être connecté pour ajouter un média.");
        redirect('/login');
    }

    $user_id = current_user_id();

    $query = "INSERT INTO media (user_id, type, title, year, image_path) VALUES (?, ?, ?, ?, ?)";

    if (!db_execute($query, [$user_id, $type, $title, $pb_year, $images_name])) {
        set_flash('error', "Impossible d'ajouter le média.");
        return false;
    }

    return db_last_insert_id();
}

function delete_media($media_id)
{
    $query = "DELETE FROM media WHERE id = ?";
    return db_execute($query, [$media_id]);
}

// Ajouter les informations dans Books

function add_book($media_id, $author, $isbn, $page_count, $summary, $pb_year)
{
    $query = "INSERT INTO books (media_id, author, isbn, page_count, summary, publication_year) VALUES (?, ?, ?, ?, ?, ?)";
    return db_execute($query, [$media_id, $author, $isbn, $page_count, $summary, $pb_year]);
}

function add_movie($media_id, $director, $duration, $synopsis, $classification)
{
    $query = "INSERT INTO movies (media_id, director, duration_minutes, synopsis, classification) VALUES (?, ?, ?, ?, ?)";
    return db_execute($query, [$media_id, $director, $duration, $synopsis, $classification]);
}




function add_game($media_id, $publisher, $platform, $min_age, $description)
{

    if (is_array($platform)) {
        $platform = implode(' / ', $platform);
    }

    $query = "INSERT INTO games (media_id, publisher, platform, min_age, description) VALUES (?, ?, ?, ?, ?)";
    return db_execute($query, [$media_id, $publisher, $platform, $min_age, $description]);
}





// Ajouter les tous les genre selectionnés dans media_genres
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




// Fonctions principales pour ajouter un media

function create_book($title, $author, $isbn, $pages, $summary, $pb_year, $genres)
{
    db_begin_transaction();
    
    $media_id = add_media($title, 'book', $pb_year);
    if (!add_book($media_id, $author, $isbn, $pages, $summary, $pb_year)) {
        set_flash('error', "Echec de l'ajout du livre dans la table 'books'.");

    }

    $res_genres = add_genres($media_id, $genres);

    if (is_array($res_genres)) {
        set_flash('error', "Certaines genres n'ont pas pu être ajoutés : " . implode(', ', $res_genres));
    }

    return false;
}

function create_movie($title, $director, $duration, $synopsis, $classification, $pb_year, $genres)
{
    $media_id = add_media($title, 'movie', $pb_year);
    if (!add_movie($media_id, $director, $duration, $synopsis, $classification)) {
        set_flash('error', "Echec de l'ajout du film dans la table 'movies'.");
    }
    if (!add_genres($media_id, $genres)) {
        set_flash('error', "Echec de l'ajout du genre dans la table 'genres'.");
    }

    return false;
}




function create_game($title, $publisher, $platform, $min_age, $description, $year, $genres, $image_name)
{
    $media_id = add_media($title, 'game', $year, $image_name);

    if (!add_game($media_id, $publisher, $platform, $min_age, $description)) {
        set_flash('error', "Échec de l'ajout du jeu dans la table 'games'.");
    }

    if (!add_genres($media_id, $genres)) {
        set_flash('error', "Échec lors de l’ajout des genres.");
    }

    return true;
}




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




function get_all_images() {
    $query = "SELECT id, title, image_path FROM media WHERE image_path IS NOT NULL";
    $data = db_select($query);
    $images = [];

    foreach ($data as $image) {
        $images[$image['id']] = $image['image_path'];
    }

    return $images;
}




function get_all_platforms()
{
    $query = "SELECT media_id, platform FROM games";
    $data = db_select($query);

    $platforms = [];
    foreach ($data as $row) {
        $platforms[$row['media_id']] = $row['platform'];
    }

    return $platforms;
}

// les EMPRUNTSSSSSSSSSSSSSS


require_once __DIR__ . '/../core/database.php';

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
