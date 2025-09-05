<?php

// Ajouter dans la table media, retourne le media_id
function add_media($title, $type, $pb_year)
{
    if (!is_logged_in()) {
        set_flash('error', "Vous devez être connecté pour ajouter un média.");
        redirect('/login');
    }

    $user_id = current_user_id();

    $query = "INSERT INTO media (user_id, type, title, year) VALUES (?, ?, ?, ?)";

    if (!db_execute($query, [$user_id, $type, $title, $pb_year])) {
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

function add_game($media_id, $publisher, $min_age, $description)
{
    $query = "INSERT INTO games (media_id, publisher, min_age, description) VALUES (?, ?, ?, ?)";
    return db_execute($query, [$media_id, $publisher, $min_age, $description]);
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

function create_game($title, $publisher, $platform, $min_age, $description, $year, $genres)
{
    $media_id = add_media($title, 'game', $year);
    if (!add_game($media_id, $publisher, $min_age, $description)) {
        set_flash('error', "Echec de l'ajout du jeu dans la table 'games'.");
    }

    $res_genres = add_genres($media_id, $genres);

    if (is_array($res_genres)) {
        set_flash('error', "Certaines genres n'ont pas pu être ajoutés : " . implode(', ', $res_genres));
    }

    $res_platform = add_platform($media_id, $platform);

    if (is_array($res_platform)) {
        set_flash('error', "Certaines plateformes n'ont pas pu être ajoutées : " . implode(', ', $res_platform));
    }

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

<<<<<<< HEAD

function get_all_images() {
    $query = "SELECT image_path FROM media";
    return db_select($query); 
}





// UPLOAD IMAGES CODES → la logique d’accès à la base de données (insertion du média, mise à jour cover_image).


=======
function get_all_platforms()
{
    $query = "SELECT id, name FROM platform";

    $data = db_select($query);
    $platforms = [];

    foreach ($data as $platform) {
        $platforms[$platform['id']] = $platform['name'];
    }

    return $platforms;
}
>>>>>>> d45165fb4348441cbe3ac6ce4bbb59349b62aa72
