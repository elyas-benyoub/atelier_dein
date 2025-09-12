<?php

function media_add_movie()
{
    $data = [
        'title' => "Films",
        'genres' => get_all_genres()
    ];

    load_view_with_layout('media/add_movie', $data);
}

/**
 * Enregistrement en base de donnée
 */

// Sauvegarde le jeu dans la base de donnee
function media_store_game()
{

    if (!is_post()) {
        redirect('media/add_game'); 
    return;
    }

    
    // on recupere et nettoie les info du jeu depuis la variable $_POST
    $title = post('title');
    $publisher = post('publisher');
    $platform = post('platform');
    $min_age = post('min_age');
    $description = post('description');
    $year = (post('year'));
    $genres = post('genres');
    $image_name = "/upoads/media/" . set_images();


    $ok = create_game($title, $publisher, $platform, $min_age, $description, $year, $genres, $image_name);
    create_game($title, $publisher, $min_age, $description, $genres, $platform);
    redirect('media/add_game');

    if ($ok) {
        set_flash('success', "Jeu ajouté avec succès.");
    } else {
        set_flash('error', "Échec lors de l’ajout du jeu.");
    }
    redirect('media/add_game');
 
}


// Fonction qui récupère et enregistre les infos du formulaire après envoi
function media_store_movie()
{
    if (!is_post()) {
        redirect('media/add_game');
        return;
    }

    // on recupere et nettoie les info film depuis la variable $_POST
    $title = clean_input(post('title'));
    $director = clean_input(post('director'));
    $duration = post('duration');
    $synopsis = clean_input(post('synopsis'));
    $year = (post('year'));
    $classification = clean_input(post('classification'));
    $genres = post('genres');
    $img_url = null;

    create_movie($title, $director, $duration, $synopsis, $classification, $year, $genres, $img_url);
    redirect('media/add_movie');
}
