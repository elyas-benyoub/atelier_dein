<?php

/**
 * Affiche le formulaire d'ajout d'un livre.
 *
 * @return void
 */
function book_add()
{
     $data = [
        'title'  => "Livres",
        'genres' => get_all_genres(),
        'form'   => $_SESSION['form']   ?? [],
        'errors' => $_SESSION['errors'] ?? []
    ];

    unset($_SESSION['form'], $_SESSION['errors']);

    load_view_with_layout('media/add_book', $data);
}

/**
 * Traite la soumission du formulaire d'ajout de livre,
 * gère la validation, l'upload, l'appel au modèle.
 *
 * @return void
 */
function book_store()
{
    if (!is_post()) {
        redirect('book/add');
        return;
    }

    // on recupere et nettoie les info du livre depuis la variable $_POST
    $title = clean_input(post('title'));
    $author = clean_input(post('author'));
    $isbn = post('isbn');
    $genres = post('genres');
    $pages = post('pages');
    $resume = clean_input(post('resume'));
    $pb_year = post('pb_year');

    // on stock les variables dans SESSION
    $_SESSION['form'] = compact('title', 'author', 'isbn', 'genres', 'pages', 'resume', 'pb_year');

    $errors = validate_book_input();

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
        redirect('book/add');
        return;
    }

    $pages = (int) $pages;
    $pb_year = ($pb_year === '' ? null : (int) $pb_year);
    $img_url = $image['url'] ?? null;

    $ok = create_book($title, $author, $isbn, $pages, $resume, $pb_year, $genres, $img_url);

    if ($ok) {
        set_flash('success', "Livre ajouté.");
        unset($_SESSION['form']);
    } else {
        if ($image && is_file($image['full_path'])) {
            unlink($image['full_path']);
        }
        set_flash('error', "Insertion annulée.");
    }

    redirect('book/add');
}

/**
 * Valide les données du formulaire d'ajout de livre,
 * lit depuis $_SESSION['form'],
 * retourne un tableau d'erreurs.
 *
 * @return array
 */
function validate_book_input()
{
    extract($_SESSION['form']);

    $errors = [];

    if ($title === '')
        $errors['title'] = "Le titre est obligatoire.";
    if ($author === '')
        $errors['author'] = "L'auteur est obligatoire.";
    if ($isbn === '' || !ctype_digit((string)$isbn) || !in_array(strlen((string)$isbn), [10, 13], true))
        $errors['isbn'] = "ISBN invalide (10 ou 13 chiffres).";
    if ($pages === null || !ctype_digit((string) $pages) || (int) $pages <= 0)
        $errors['pages'] = "Nombre de pages invalide.";
    if ($resume === '')
        $errors['resume'] = "Le résumé est obligatoire.";
    if ($pb_year !== '' && (!ctype_digit((string) $pb_year) || (int) $pb_year < 1900 || (int) $pb_year > 9999))
        $errors['pb_year'] = "Année invalide.";
    if (empty($genres))
        $errors['genres'] = "Sélectionnez au moins un genre.";

    return $errors;
}
