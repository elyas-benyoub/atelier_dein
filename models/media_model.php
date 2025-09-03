

<?php
// Modèle pour les médias games

// db_select() = pour récupérer plusieurs lignes (tableau d’enregistrements).
// db_select_one() = pour récupérer un seul enregistrement (ou false si rien trouvé).
// db_log = ecrit les traces log ds storage(requete error,sucess..)
// LIMIT(SQL) = Sert à limiter le nombre de résultats retournés par la requête.
// OFFSET(SQL) = Sert à décaler le point de départ de la sélection.




// Ajouter dans la table media, retourne le media_id
// function add_media($title, $type, $pb_year)
// {
//     if (isset($_SESSION['user_id'])) {
//         $user_id = $_SESSION['user_id'];
//     }

//     $query = "INSERT INTO media (user_id, type, title, year) VALUES (?, ?, ?, ?)";

//     if (db_execute($query, [$user_id, $type, $title, $pb_year])) {
//         return db_last_insert_id();
//     }

//     return false;
// }


// Ajouter dans la table media, retourne le media_id
function add_media($title, $type, $pb_year = null)
{
    // sécurise la variable
    $user_id = $_SESSION['user_id'] ?? null;

    // si aucun utilisateur connecté → on arrête
    if (!$user_id) {
        return false;
    }

    $query = "INSERT INTO media (user_id, type, title, year, created_at, updated_at) 
              VALUES (?, ?, ?, ?, NOW(), NOW())";

    if (db_execute($query, [$user_id, $type, $title, $pb_year])) {
        return db_last_insert_id();
    }

    return false;
}




// Ajouter les informations dans Books

function add_book($media_id, $author, $isbn, $page_count, $summary, $pb_year)
{
    $query = "INSERT INTO books (media_id, author, isbn, page_count, summary, publication_year) VALUES (?, ?, ?, ?, ?, ?)";
    db_execute($query, [$media_id, $author, $isbn, $page_count, $summary, $pb_year]);
}

function add_movie($media_id, $director, $duration, $synopsis, $classification)
{
    $query = "INSERT INTO movies (media_id, director, duration_minutes, synopsis, classification) VALUES (?, ?, ?, ?, ?)";
    db_execute($query, [$media_id, $director, $duration, $synopsis, $classification]);
}

function add_game($media_id, $publisher, $genres, $platform, $min_age, $description, $year)
{
    $query = "INSERT INTO games (media_id, publisher,genres, platform, min_age, description, $year) VALUES (?, ?, ?, ?, ?)";
    db_execute($query, [$media_id, $publisher, $genres, $platform, $min_age, $description, $year]);
}



// Ajouter les tous les genre selectionnÃ©s dans media_genres
function add_genres($media_id, $genres) {
    foreach ($genres as $genre) {
        $query = "INSERT INTO media_genres (media_id, genre_id) VALUES (?, ?)";
        db_execute($query, [$media_id, $genre]);
    }
}

// Fonctions principales pour ajouter un media

function create_book($title, $author, $isbn, $pages, $summary, $pb_year, $genres)
{
    $media_id = add_media($title, 'book', $pb_year);
    add_book($media_id, $author, $isbn, $pages, $summary, $pb_year);
    add_genres($media_id, $genres);

    return false;
}

function create_movie($title, $director, $duration, $synopsis, $classification, $pb_year, $genres)
{
    $media_id = add_media($title, 'movie', $pb_year);
    add_movie($media_id, $director, $duration, $synopsis, $classification);
    add_genres($media_id, $genres);

    return false;
}

function create_game($title, $publisher,$genres, $platform, $min_age, $description,$year)
{
    $media_id = add_media($title, 'game', $year);
    add_game($media_id, $publisher, $genres, $platform, $min_age,$description,$year);
    add_genres($media_id, $genres);

    return false;
}





function get_all_genres()
{
    $query = "SELECT id, name FROM genres";

    $data = db_select($query);
    $genres = [];

    foreach ($data as $genre) {
        $genres[$genre['id']] = $genre['name'];
    }

    return $genres;
}







































//     /**
//  * Crée un nouveau média (jeu)
//  */
// function create_media($media_id, $publisher, $platform, $min_age, $description) {
//     $query = "INSERT INTO game (media_id, publisher, platform, min_age, description, created_at, updated_at) 
//               VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
    
//     $ok = db_execute($query, [$media_id, $publisher, $platform, $min_age, $description]);
//     if ($ok) {
//         $last_id = db_last_insert_id();
//         db_log("create_media: id=$last_id media_id=$media_id publisher=$publisher");
//         return $last_id;
//     }
//     return false;
// }

// /**
//  * Met à jour un média (jeu)
//  */
// function update_media($id, $publisher, $platform, $min_age, $description) {
//     $query = "UPDATE game 
//               SET publisher = ?, platform = ?, min_age = ?, description = ?, updated_at = NOW() 
//               WHERE id = ?";
    
//     $ok = db_execute($query, [$publisher, $platform, $min_age, $description, $id]);
//     db_log("update_media: id=$id status=" . ($ok ? "OK" : "FAIL"));
//     return $ok;
// }

// /**
//  * Supprime un média (jeu)
//  */
// function delete_media($id) {
//     $query = "DELETE FROM game WHERE id = ?";
//     $ok = db_execute($query, [$id]);
//     db_log("delete_media: id=$id status=" . ($ok ? "OK" : "FAIL"));
//     return $ok;
// }

// /**
//  * Compte le nombre total de médias
//  */
// function count_media() {
//     $query = "SELECT COUNT(*) as total FROM game";
//     $result = db_select_one($query);
//     $total = $result['total'] ?? 0;
//     db_log("count_media: total=$total");
//     return $total;
// }

// /**
//  * Vérifie si un jeu existe déjà par son media_id
//  */
// function media_exists($media_id, $exclude_id = null) {
//     $query = "SELECT COUNT(*) as count FROM game WHERE media_id = ?";
//     $params = [$media_id];
    
//     if ($exclude_id) {
//         $query .= " AND id != ?";
//         $params[] = $exclude_id;
//     }
    
//     $result = db_select_one($query, $params);
//     $exists = $result['count'] > 0;
//     db_log("media_exists: media_id=$media_id exclude_id=$exclude_id exists=" . ($exists ? "YES" : "NO"));
//     return $exists;
// }
    




















