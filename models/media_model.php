<?php

/**
 * Ajoute un média dans la base.
 *
 * Insère une nouvelle ligne dans la table `media` avec l'utilisateur courant,
 * le type de média (book, movie, game, ...), un titre, une image optionnelle
 * et une année de publication optionnelle.
 *
 * @param string      $title   Titre du média (obligatoire).
 * @param string      $type    Type de média ('book', 'movie', 'game', ...).
 * @param int|null    $pb_year Année de publication (NULL si non renseignée).
 * @param string|null $img_url URL/chemin de l'image (NULL si pas d'image).
 *
 * @return int|false  Retourne l'ID auto-incrémenté du média inséré
 *                    ou false si l'insertion a échoué.
 *
 */
function add_media($title, $type, $pb_year, $img_url)
{
    if (!is_logged_in()) {
        return false;
    }

    $user_id = current_user_id();

    $query = "INSERT INTO media (user_id, type, title, image_path, year) VALUES (?, ?, ?, ?, ?)";

    try {
        $ok = db_execute($query, [$user_id, $type, $title, $img_url, $pb_year]);

        if (!$ok) {
            app_log("[add_media] La requête à échoué.");
            return false;
        }

        return db_last_insert_id();
    } catch (Throwable $e) {
        app_log("[add_media] " . $e->getMessage());
        return false;
    }
}

/**
 * Supprime un média par son ID.
 *
 * @param int $media_id
 * @return bool succès/échec
 */
function delete_media($media_id)
{
    $media = get_media_by_id($media_id);

    $type = $media['type'];

    if ($type === 'book') {
        $query = "DELETE FROM books WHERE media_id = ?";
        db_execute($query, [$media_id]);
    } 
    elseif ($type === 'movie') {
        $query = "DELETE FROM movies WHERE media_id = ?";
        db_execute($query, [$media_id]);
    }
    elseif ($type === 'game') {
        $query = "DELETE FROM games WHERE media_id = ?";
        db_execute($query, [$media_id]);
    }

    $query = "DELETE FROM media_genres WHERE media_id = ?";
    db_execute($query, [$media_id]);

    $query = "DELETE FROM media WHERE id = ?";
    return db_execute($query, [$media_id]);
}


// function edit_media($media_id)
// {

//     $media_edits = get_media_by_id($media_id);
//     $type = $media_edits["type"];


// //     UPDATE table
// // SET nom_colonne_1 = 'nouvelle valeur'
// // WHERE condition


//     if ($type === 'book') {
//         $query = "UPDATE books SET ? WHERE media_id = ?";
//         db_execute($query, [$media_id]);
//     } 

//  return db_execute($query, [$media_id]);

// }


function edit_media($id, $title, $genres = [], $image_path = null) {

    $query = "UPDATE media SET title = ?" . ($image_path ? ", image_path = ?" : "") . " WHERE id = ?";
    $params = [$title];
    if ($image_path) {
        $params[] = $image_path;
    }
    $params[] = $id;
    db_execute($query, $params);

    // 2. Supprimer les anciens genres
    db_execute("DELETE FROM media_genres WHERE media_id = ?", [$id]);

    // 3. Réinsérer les nouveaux genres
    foreach ($genres as $genre_id) {
        db_execute("INSERT INTO media_genres (media_id, genre_id) VALUES (?, ?)", [$id, $genre_id]);
    }

    return true;
}










/**
 * Ajoute tous les genres liés à un média.
 *
 * @param int   $media_id
 * @param array $genres   IDs de genres
 * @return bool succès/échec
 */
function add_genres($media_id, $genres)
{
    foreach ($genres as $genre) {
        $query = "INSERT INTO media_genres (media_id, genre_id) VALUES (?, ?)";
        if (!db_execute($query, [$media_id, $genre])) {
           set_flash('error', "Les genres n'ont pas pu être ajoutés");
           return false;
        }
    }

    return true;
}

/**
 * Ajoute toutes les plateformes liées à un média.
 *
 * @param int   $media_id
 * @param array $platforms IDs de plateformes
 * @return bool succès/échec
 */
function add_platform($media_id, $platforms)
{
    foreach ($platforms as $platform) {
        $query = "INSERT INTO media_platform (media_id, platform_id) VALUES (?, ?)";
        if (!db_execute($query, [$media_id, $platform])) {
           set_flash('error', "Les plateformes n'ont pas pu être ajoutés");
            return false;
        }
    }

    return true;
}


/**
 * Récupère tous les genres.
 *
 * @return array [id => name]
 */
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

function get_all_media_genres(){

    $query = "SELECT media_id, genre_id FROM media_genres";

    $data = db_select($query);

    return $data;
}

function get_all_medias()
{
    $query = "SELECT * FROM media";

    $data = db_select($query);
    
    return $data;
}

function get_media_by_id($media_id) {
    $query = "SELECT * FROM media WHERE id = ?";
    $result = db_select($query, [$media_id]);
    return $result ? $result[0] : null;
}

function search_media_by_title($q) {
    $q = strtolower(trim($q)); // make lowercase + clean spaces

    $like = '%' . $q . '%'; // wrap with % signs

    $query = "SELECT * FROM media WHERE LOWER(title) LIKE ?";

    return db_select($query, [$like]);
}


/**
 * 
 * Filtre les médias dans la base selon plusieurs critères.
 *
 * @param string $q          Texte à rechercher dans le titre (optionnel)
 * @param string $type       Type de média ('book', 'movie', 'game', ...) (optionnel)
 * @param string $genre      ID du genre (optionnel)
 * @param string $availability Disponibilité ('available' ou 'borrowed') (optionnel)
 *
 * @return array             Retourne un tableau de médias correspondant aux critères
 */
function filter_media($q = '', $type = '', $genre = '', $availability = '')
{
    // 🔹 Requête de base pour récupérer tous les médias
    // LEFT JOIN media_genres pour récupérer les genres associés
    // LEFT JOIN loans pour savoir si le média est emprunté
    $sql = "SELECT m.* 
            FROM media m
            LEFT JOIN media_genres mg ON m.id = mg.media_id
            LEFT JOIN loans l ON l.id_m = m.id AND l.status = 'borrowed'
            WHERE 1=1"; // 1=1 permet de concaténer facilement des conditions avec AND

    $params = []; // Tableau pour stocker les valeurs à sécuriser dans la requête (protection contre SQL injection)

    // Recherche texte dans le titre du média = barre de recherche
    if (!empty($q)) {
        $sql .= " AND LOWER(m.title) LIKE ?"; // On convertit le titre en minuscules pour une recherche insensible à la casse
        $params[] = "%" . strtolower(trim($q)) . "%"; // On ajoute % pour une recherche partielle (LIKE)
    }

    // Filtrer par type de média
    if (!empty($type)) {
        $sql .= " AND m.type = ?"; // Ex: book, movie, game = sql prend le type du media
        $params[] = $type; // $params = sécuriser la requête => donc ajout valeur dans le tableau 
    }

    // Filtrer par genre
    if (!empty($genre)) { // si genres n'est pas vide(différent) traduct°
        $sql .= " AND mg.genre_id = ?"; // Filtre sur l'ID du genre
        $params[] = $genre;
    }

    // Filtrer par disponibilité
    if ($availability === 'available') {
        $sql .= " AND l.id IS NULL"; // Aucun prêt actif → le média est disponible
    } elseif ($availability === 'borrowed') {
        $sql .= " AND l.id IS NOT NULL"; // Il y a un prêt actif → le média est emprunté
    }

    // regroupe les résultats par média (évite les doublons si plusieurs genres) et on trie par date de création
    $sql .= " GROUP BY m.id ORDER BY m.created_at DESC";

    // exécute la requête et on renvoie les résultats
    return db_select($sql, $params);
}























/**
 * Récupère toutes les plateformes.
 *
 * @return array [id => name]
 */
function get_all_platforms()
{
    $query = "SELECT id, name FROM platform";
    $data = db_select($query);

    $platforms = [];
    foreach ($data as $row) {
        $platforms[(int)$row['id']] = $row['name'];
    }
    return $platforms;
}

function get_genres_by_media_id($media_id) {
    $query = "
        select g.name
        from genres g
        join media_genres mg on mg.genre_id = g.id
        join media m on mg.media_id = m.id
        where m.id = ?;
    ";

    $data = db_select($query, [$media_id]);
    
    $genres = [];
    foreach ($data as $row) {
        $genres[] = $row['name'];
    }

    return $genres;
 }

function get_genre_ids_by_media_id($media_id)
{
    $rows = db_select(
        "SELECT genre_id FROM media_genres WHERE media_id = ?",
        [$media_id]
    );

    return array_map('intval', array_column($rows, 'genre_id'));
}

/**
 * Récupère tous les médias disponibles (non empruntés)
 */
function get_all_media() {
    $sql = "SELECT m.*
            FROM media m
            WHERE m.id NOT IN (
                SELECT id_m 
                FROM loans 
                WHERE status = 'borrowed'
            )
            ORDER BY m.created_at DESC";
    return db_select($sql);
}

/**
 * Récupère tous les médias (même ceux empruntés)
 */
function get_all_media_with_status() {
    $sql = "SELECT m.*, 
                   CASE 
                     WHEN l.status = 'borrowed' THEN 'Emprunté'
                     ELSE 'Disponible'
                   END AS loan_status
            FROM media m
            LEFT JOIN loans l ON l.id_m = m.id AND l.status = 'borrowed'
            ORDER BY m.created_at DESC";
    return db_select($sql);
}
