<?php

function game_add()
{
    $data = [
        'title' => "Jeux vidéos",
        'genres' => get_all_genres(),
        'platforms' => get_all_platforms(),
        'form' => $_SESSION['form'] ?? [],
        'errors' => $_SESSION['errors'] ?? [],
    ];

    unset($_SESSION['form'], $_SESSION['errors']);

    load_view_with_layout('media/add_game', $data);
}

function game_store()
{
    if (!is_post()) {
        redirect('game/add');
        return;
    }

    // Récupération et nettoyage
    $title = clean_input(post('title'));
    $publisher = clean_input(post('publisher'));
    $min_age = post('min_age');
    $description = clean_input(post('description'));
    $genres = post('genres');
    $platforms = post('platforms');


    // Sauvegarde des variables dans un tableau dans $_SESSION
    $_SESSION['form'] = compact('title','publisher', 'min_age', 'description', 'genres', 'platforms');

    // Validation et recupération des erreurs
    $errors = validate_game_input();

    // Upload de l'image
    $image = null;
    if (!empty($_FILES['img_cover']['name'])) {
        $image = upload_img();
        if ($image === null) {
            $errors['img_cover'] = $_SESSION['errors']['img_cover'] ?? "Upload de l'image impossible.";
        }
    }

    if ($errors) {
        $_SESSION['errors'] = $errors;
        set_flash('error', "Certains champs sont invalides");
        redirect('game/add');
        return;
    }

    // Normalisation
    $min_age = (int)$min_age;
    $img_url = $image['url'] ?? null;

    $ok = create_game($title, $publisher, $min_age, $description, $genres, $platforms, $img_url);

    if ($ok) {
        set_flash('success', "Jeu ajouté.");
        unset($_SESSION['form']);
    } else {
        if ($image && !empty($image['full_path']) && is_file($image['full_path'])) {
            unlink($image['full_path']); // suppression de l'image enregistré dans /uploads/media
        }
        set_flash('error', "Insertion annulée.");
    }

    redirect('game/add');
}


function validate_game_input(): array
{
    extract($_SESSION['form']);
    $errors = [];

    if ($title === '') $errors['title'] = "Le titre est obligatoire";
    if ($publisher === '') $errors['publisher'] = "L'éditeur est obligatoire";
    if ($min_age === null || !ctype_digit((string)$min_age) || (int)$min_age < 3) {
        $errors['min_age'] = "Âge minimum invalide (entier ≥ 3)";
    }
    if ($description === '') $errors['description'] = "La description est obligatoire";
    if (empty($genres)) $errors['genres'] = "Sélectionne au moins un genre";
    if (empty($platforms)) $errors['platforms'] = "Sélectionne au moins une plateforme";

    return $errors;
}