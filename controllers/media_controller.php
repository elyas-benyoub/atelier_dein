<?php
function home_index() {
   

    // 🔹 Préparer les données pour la vue
    $data = [
        'title' => 'Accueil Médiathèque',
        'movie' => $movie,
        'books' => $book,
        'medias' => $medias
    ];

    // 🔹 Charger la vue avec ces 3 tableaux
    load_view_with_layout('home/index', $data);
}
function media_add_books()
{
    $data = [
        'title' => "Livres",
        'genres' => get_all_genres()
    ];

    load_view_with_layout('/media/add_book', $data);
}

function media_add_game()
{
    $data = [
        'title' => "Jeux",
        'genres' => get_all_genres()
    ];

    load_view_with_layout('/media/add_game', $data);
}

function media_add_movies()
{
    $data = [
        'title' => "Films",
        'genres' => get_all_genres()
    ];

    load_view_with_layout('/media/add_movie', $data);
}

function media_store_book()
{
    if (is_post()) {
        $title = clean_input(post('title'));
        $author = clean_input(post('author'));
        $isbn = post('isbn');
        $genres = post('genre');
        $pages = post('pages');
        $resume = clean_input(post('resume'));
        $pb_year = post('pb_year');

        create_book($title, $author, $isbn, $pages, $resume, $pb_year, $genres);
        redirect('media/add_book');
    }
}

function media_store_game()
{
    if (is_post()) {
        $title = clean_input(post('title'));
        $publisher = clean_input(post('publisher'));
        $platform = clean_input(post('platform'));
        $min_age = post('min_age');
        $description = clean_input(post('description'));
        $genres = post('genres');


        create_game($title, $publisher, $platform, $min_age, $description, NULL, $genres);
        redirect('media/add_game');
    }
}

// Fonction qui récupère et enregistre les infos du formulaire après envoi
function media_store_movie()
{

    if (is_post()) {    // On vérifie si la requête est bien un POST (c'est-à-dire que le formulaire a été soumis)
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