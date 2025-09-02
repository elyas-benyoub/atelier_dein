<?php

// Fonction qui affiche le formulaire pour ajouter un film
function media_add_movie() {
    // On prépare un petit tableau de données à envoyer à la vue
    $data = [
        'title' => 'Formulaire Films' // Ici, "title" est le titre affiché dans la page
    ];

    // On charge la vue "media/add_movie" en utilisant le layout général du site
    load_view_with_layout('media/add_movie', $data);
}

// Fonction qui récupère et enregistre les infos du formulaire après envoi
function media_store_movie() {
    // On vérifie si la requête est bien un POST (c'est-à-dire que le formulaire a été soumis)
    if (is_post()) {
        // On nettoie et récupère la valeur du champ "title" du formulaire
        $title = clean_input(post('title'));

        // On nettoie et récupère la valeur du champ "director" du formulaire
        $director = clean_input(post('director'));

        // On récupère la valeur du champ "duration" (pas besoin de nettoyer si c’est un nombre)
        $duration = post('duration');

        // On nettoie et récupère la valeur du champ "synopsis"
        $synopsis = clean_input(post('synopsis'));

        // On récupère l'année depuis le formulaire (pas nettoyée, mais ça peut être utile de vérifier plus tard)
        $year = (post('year'));
    }

    // Pour tester : on affiche toutes les données récupérées du formulaire
    var_dump([$title, $director, $duration, $synopsis, $year]);

    // On arrête le script ici pour ne pas continuer plus loin (utile pour déboguer)
    exit;
}

