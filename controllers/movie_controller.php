<?php

function movie_add()
{
    $data = [
        'title' => "Films",
        'genres' => get_all_genres(),
        'form' => $_SESSION['form'] ?? [],
        'errors' => $_SESSION['errors'] ?? []
    ];

    unset($_SESSION['form'], $_SESSION['errors']);

    load_view_with_layout('media/add_movie', $data);
}

/**
 * Traite la soumission du formulaire d'ajout de films,
 * gère la validation, l'upload, l'appel au modèle.
 *
 * @return void
 */
function movie_store()
{
    if (!is_post()) {
        redirect('media/add_movie');
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

    // on stock les variables dans SESSION
    $_SESSION['form'] = compact('title', 'director', 'duration', 'synopsis', 'year', 'classification', 'genres');

    $errors = validate_movie_input();

    // upload de l'image
    $image = null;
    if (!empty($_FILES['img_cover']['name'])) {
        $image = upload_img();
        if ($image === null) {
            $errors['img_cover'] = $_SESSION['errors']['img_cover'] ?? "Upload de l'image impossible.";
        }
    }

    // si on recupere des erreurs, on retourne sur le formulaire pour les afficher
    if ($errors) {
        $_SESSION['errors'] = $errors;
        set_flash('error', "Certains champs sont invalides");
        redirect('movie/add');
        return;
    }

    $duration = (int) $duration;
    $year = ($year === '' ? null : (int) $year);
    $img_url = $image['url'] ?? null;

    $ok = create_movie($title, $director, $duration, $synopsis, $classification, $year, $genres, $img_url);

    if ($ok) {
        set_flash('success', "Film ajouté.");
        unset($_SESSION['form']);
    } else {
        if ($image && is_file($image['full_path'])) {
            unlink($image['full_path']);
        }
        set_flash('error', "Insertion annulée.");
    }

    redirect('movie/add');
}

/**
 * Valide les données du formulaire d'ajout de film,
 * lit depuis $_SESSION['form'],
 * retourne un tableau d'erreurs.
 *
 * @return array
 */
function validate_movie_input()
{
    extract($_SESSION['form']);

    $errors = [];

    if ($title === '')
        $errors['title'] = "Le titre est obligatoire.";
    if ($director === '')
        $errors['director'] = "Le réalisateur est obligatoire.";
    if ($duration === '' || !ctype_digit((string) $duration))
        $errors['duration'] = "Durée obligatoire";
    if ($synopsis === "")
        $errors['synopsis'] = "Le synopsis est obligatoire";
    if ($year !== '' && (!ctype_digit((string) $year) || (int) $year < 1900 || (int) $year > 9999))
        $errors['year'] = "Année invalide.";
    if (empty($genres))
        $errors['genres'] = "Sélectionnez au moins un genre.";
    if ($classification === '' || !in_array($classification, ['Tous publics', '-10', '-12', '-16', '-18'], true))
        $errors['classification'] = "Classification invalide.";

    return $errors;
}