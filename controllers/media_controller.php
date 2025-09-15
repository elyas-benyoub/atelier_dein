<?php

/**
 * Affichage des formulaires
 */

// Affiche le formulaire d'ajout d'un livre
function media_add_book()
{
    $data = [
        'title' => "Livres",
        'genres' => get_all_genres()
    ];

    load_view_with_layout('/media/add_book', $data);
}

// Affiche le formulaire d'ajout d'un jeu
function media_add_game()
{

    $data = [
        'title' => "Jeux",
        'genres' => get_all_genres(),
        'platforms' => get_all_platforms()
    ];


    load_view_with_layout('/media/add_game', $data);
}

// Affiche le formulaire d'ajout d'un film
function media_add_movie()
{
    $data = [
        'title' => "Films",
        'genres' => get_all_genres()
    ];

    load_view_with_layout('/media/add_movie', $data);
}

/**
 * Enregistrement en base de donnée
 */

// Sauvegarde le livre dans la base de donnee
function media_store_book()
{
    if (is_post()) {
        // on recupere et nettoie les info du livre depuis la variable $_POST
        $title = clean_input(post('title'));
        $author = clean_input(post('author'));
        $isbn = post('isbn');
        $genres = post('genres');
        $pages = post('pages');
        $resume = clean_input(post('resume'));
        $pb_year = post('pb_year');

        $ok = create_book($title, $author, $isbn, $pages, $resume, $pb_year, $genres);
        
        if ($ok === true) {
            set_flash('success', "Livre ajouté avec succès.");
        } else {
            set_flash('error', "Échec lors de l’ajout du livre.");
        }
        redirect('media/add_book');
    }
}

// Sauvegarde le jeu dans la base de donnee
function media_store_game()
{
    if (!is_post()) {
        redirect('media/add_game');
        return;
    }

    // on recupere et nettoie les info du jeu depuis la variable $_POST
    $title = clean_input(post('title'));
    $publisher = clean_input(post('publisher'));
    $platform = clean_input(post('platform'));
    $min_age = post('min_age');
    $description = clean_input(post('description'));
    $genres = post('genres');


    create_game($title, $publisher, $platform, $min_age, $description, NULL, $genres);
    redirect('media/add_game');

}

// Sauvegarde le film dans la base de donnee
function media_store_movie()
{

    if (is_post()) {
        // on recupere et nettoie les info film depuis la variable $_POST
        $title = clean_input(post('title'));
        $director = clean_input(post('director'));
        $duration = post('duration');
        $synopsis = clean_input(post('synopsis'));
        $year = (post('year'));
        $classification = clean_input(post('classification'));
        $genres = post('genres');

        create_movie($title, $director, $duration, $synopsis, $classification, $year, $genres);
        redirect('media/add_movie');
    }
}







