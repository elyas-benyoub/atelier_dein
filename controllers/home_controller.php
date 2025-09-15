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
    $data_type = [];
    $media_id = get('id');
    $media = get_media_by_id($media_id)[0];

    if ($media['type'] === 'movie') {
        $data_type = get_movie_by_id($media_id)[0];
    }

    if ($media['type'] === 'book') {
        $data_type = get_book_by_id($media_id)[0];
    }

    if ($media['type'] === 'game') {
        $data_type = get_game_by_id($media_id)[0];
    }

    $genres = get_genres_by_media_id($media_id);


    $data = [
        'media' => $media ?? [],
        'data' => $data_type ?? [],
        'genres' => $genres ?? [],
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
        'content' => "Atelier Dein est une plateforme de médiathèque de pointe conçue pour simplifier la gestion des livres, films, jeux et autres types de médias. Développée à l'aide d'un puissant framework PHP MVC, elle offre une interface utilisateur intuitive qui facilite la navigation, l'emprunt et l'organisation de votre collection multimédia. Que vous soyez passionné de lecture, de cinéma ou de jeux vidéo, notre plateforme vous offre une expérience fluide et agréable pour gérer vos médias préférés."
    ];

    load_view_with_layout('home/about', $data);
}

/**
 * Page contact
 */
function home_contact()
{
    $user_name = $_SESSION['user_name'] ?? "";
    $user_email = $_SESSION['user_email'] ?? "";

    $data = [
        'title' => 'Contact',
        'name' => $user_name,
        'email' => $user_email
    ];

    if (is_post()) {
        $name = clean_input(post('name'));
        $email = clean_input(post('email'));
        $message = clean_input(post('message'));

        // Validation simple
        if (empty($name) || empty($email) || empty($message)) {
            set_flash('error', 'Tous les champs sont obligatoires.');
            redirect('home/contact');
        } elseif (!validate_email($email)) {
            set_flash('error', 'Adresse email invalide.');
            redirect('home/contact');
        } else {
            if (!send_message($name, $email, $message)) {
                set_flash('error', "Le message n'a pas été envoyé");
            } else {
                set_flash('success', "Message envoyé avec succès");
            }
        }
        redirect('home/contact');
    }


    load_view_with_layout('/home/contact', $data);
}


/**
 * Page profile
 */
function home_profile()
{
    $user_id = $_SESSION['user_id'];
    $loans = get_all_media_loans_by_user_id($user_id);

    $data = [
        'title' => 'Profile',
        'message' => "Liste des empruns",
        'loans' => $loans
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


