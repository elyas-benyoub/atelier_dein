
<?php
function add_movie($title, $director, $year, $genre, $duration, $synopsis, $classification) {
    // La requête SQL pour insérer un film
    $query = "INSERT INTO movie (titre, realisateur, annee, genre, duree, synopsis, classification, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    
    // Exécuter la requête avec les valeurs
    $success = db_execute($query, [
        $title,
        $director,
        $year,
        $genre,
        $duration,
        $synopsis,
        $classification
    ]);

    // Si ça marche → retourne l'ID du film inséré
    if ($success) {
        return db_last_insert_id();
    }

    // Sinon → retourne false
    return false;
}