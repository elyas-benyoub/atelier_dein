<?php
// Contrôleur pour la page d'accueil

/**
 * Page d'accueil
 */
function home_index()
{
    $results = null;
    $movies = null;
    $books = null;
    $games = null;

    if (isset($_GET['search'])) {
        $q = $_GET['search'];
        $results = search_media_by_title($q);
    } else {
        $movies = get_all_movies();
        $books = get_all_books();
        $games = get_all_games();
    }

    // 🔹 Préparer les données pour la vue
    $data = [
        'title' => 'Accueil Médiathèque',
        'movies' => $movies ?? [],
        'books' => $books ?? [],
        'games' => $games ?? [],
        'results' => $results ?? []
    ];

    // 🔹 Charger la vue avec ces 3 tableaux
    load_view_with_layout('home/index', $data);
}

function home_info()
{
    $media_id = get('id');
    $media = get_media_by_id($media_id);
    $movie = get_movie_by_id($media_id);

    // tester si les informations du film marche avec var_dump
    $data = [
        'media' => $media[0],
        'movie' => $movie[0],
    ];

    load_view_with_layout('home/media', $data);
}

/**
 * Page à propos
 */
function home_about()
{
    $data = [
        'title' => 'À propos',
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.'
    ];

    load_view_with_layout('home/about', $data);
}

/**
 * Page contact
 */
function home_contact()
{
    $data = [
        'title' => 'Contact'
    ];

    if (is_post()) {
        $name = clean_input(post('name'));
        $email = clean_input(post('email'));
        $message = clean_input(post('message'));

        // Validation simple
        if (empty($name) || empty($email) || empty($message)) {
            set_flash('error', 'Tous les champs sont obligatoires.');
        } elseif (!validate_email($email)) {
            set_flash('error', 'Adresse email invalide.');
        } else {
            // Ici vous pourriez envoyer l'email ou sauvegarder en base
            set_flash('success', 'Votre message a été envoyé avec succès !');
            redirect('home/contact');
        }
    }

    load_view_with_layout('home/contact', $data);
}


/**
 * Page profile
 */
function home_profile()
{
    $data = [
        'title' => 'Profile',
        'message' => 'Bienvenue sur votre profil',
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.'
    ];

    load_view_with_layout('home/profile', $data);
}

/**
 * Page test
 */
function home_test()
{
    $data = [
        'title' => 'Page test',
        'message' => 'Bienvenue sur votre page test',
    ];

    load_view_with_layout('home/test', $data);
}