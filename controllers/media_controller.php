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
    only_admin();
    $data = [
        'title' => "JEUX VIDEOS",
        'genres' => get_all_genres(),
        'images' => get_all_images()
    ];


    load_view_with_layout('/media/add_game', $data);
}



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
    $title = post('title');
    $publisher = post('publisher');
    $platform = post('platform');
    $min_age = post('min_age');
    $description = post('description');
    $year = (post('year'));
    $genres = post('genres');
    $image_name = "/upoads/media/" . set_images();


        $ok = create_game($title, $publisher, $platform, $min_age, $description, $year, $genres, $image_name);

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



function set_images()
{
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['cover_image']['tmp_name'];
        $name = basename($_FILES['cover_image']['name']);
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        // 1. Vérifier la taille (max 2 Mo par ex.)
        if ($_FILES['cover_image']['size'] > 2 * 1024 * 1024) {
            set_flash("error", "Erreur : fichier trop volumineux (max 2 Mo).");
        }

        // 2. Vérifier l’extension
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowed_ext)) {
            set_flash("error", "Erreur : extension non autorisée.");
        }

        // 3. Vérifier le type MIME réel avec finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($tmp_name);
        $allowed_mime = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime, $allowed_mime)) {
            set_flash("error", "Erreur : le fichier n'est pas une image valide.");
        }

        // 4. Générer un nouveau nom unique
        $new_name = bin2hex(random_bytes(16)) . '.' . $ext;

        // 5. Déplacer le fichier
        $destination = __DIR__ . "/../public/uploads/media/" . $new_name;
        if (move_uploaded_file($tmp_name, $destination)) {
            set_flash("success", "Upload réussi : " . $new_name);
        } else {
            set_flash("error", "Erreur lors du déplacement.");
        }
    }

  return $new_name;



}






