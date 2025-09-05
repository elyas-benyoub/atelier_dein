<?php

// Ajouter dans la table media, retourne le media_id
function add_media($title, $type, $pb_year)
{
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }

    $query = "INSERT INTO media (user_id, type, title, year) VALUES (?, ?, ?, ?)";

    if (db_execute($query, [$user_id, $type, $title, $pb_year])) {
        return db_last_insert_id();
    }

    return false;
}

// Ajouter les informations dans Books

function add_book($media_id, $author, $isbn, $page_count, $summary, $pb_year)
{
    $query = "INSERT INTO books (media_id, author, isbn, page_count, summary, publication_year) VALUES (?, ?, ?, ?, ?, ?)";
    db_execute($query, [$media_id, $author, $isbn, $page_count, $summary, $pb_year]);
}

function add_movie($media_id, $director, $duration, $synopsis, $classification)
{
    $query = "INSERT INTO movies (media_id, director, duration_minutes, synopsis, classification) VALUES (?, ?, ?, ?, ?)";
    db_execute($query, [$media_id, $director, $duration, $synopsis, $classification]);
}

function add_game($media_id, $publisher, $platform, $min_age, $description)
{
    $query = "INSERT INTO books (media_id, publisher, platform, min_age, description) VALUES (?, ?, ?, ?, ?)";
    db_execute($query, [$media_id, $publisher, $platform, $min_age, $description]);
}

// Ajouter les tous les genre selectionnés dans media_genres
function add_genres($media_id, $genres) {
    foreach ($genres as $genre) {
        $query = "INSERT INTO media_genres (media_id, genre_id) VALUES (?, ?)";
        db_execute($query, [$media_id, $genre]);
    }
}





// Fonctions principales pour ajouter un media

function create_book($title, $author, $isbn, $pages, $summary, $pb_year, $genres)
{
    $media_id = add_media($title, 'book', $pb_year);
    add_book($media_id, $author, $isbn, $pages, $summary, $pb_year);
    add_genres($media_id, $genres);

    return false;
}

function create_movie($title, $director, $duration, $synopsis, $classification, $pb_year, $genres)
{
    $media_id = add_media($title, 'movie', $pb_year);
    add_movie($media_id, $director, $duration, $synopsis, $classification);
    add_genres($media_id, $genres);

    return false;
}

function create_game($title, $publisher, $platform, $min_age, $description, $year, $genres)
{
    $media_id = add_media($title, 'game', $year);
    add_game($media_id, $publisher, $platform, $min_age, $description);
    add_genres($media_id, $genres);

    return false;
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
    $query = "SELECT image_path FROM media";
    return db_select($query); 
}





// UPLOAD IMAGES CODES → la logique d’accès à la base de données (insertion du média, mise à jour cover_image).


