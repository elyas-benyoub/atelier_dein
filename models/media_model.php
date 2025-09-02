

<?php
// Modèle pour les médias games

// db_select() = pour récupérer plusieurs lignes (tableau d’enregistrements).
// db_select_one() = pour récupérer un seul enregistrement (ou false si rien trouvé).
// db_log = ecrit les traces log ds storage(requete error,sucess..)
// LIMIT(SQL) = Sert à limiter le nombre de résultats retournés par la requête.
// OFFSET(SQL) = Sert à décaler le point de départ de la sélection.



/**
 * Crée un nouveau média (jeu)
 */
function create_media($media_id, $publisher, $platform, $min_age, $description) {
    $query = "INSERT INTO games (media_id, publisher, platform, min_age, description, created_at, updated_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $ok = db_execute($query, [$media_id, $publisher, $platform, $min_age, $description]);
        db_log("create_media: id=$last_id media_id=$media_id publisher=$publisher");
    return false;
}


























/**
 * Récupère un média (jeu) par son ID
 */
function get_media_by_id($id) {
    $query = "SELECT * FROM game WHERE id = ? LIMIT 1";
    db_log("get_media_by_id: id=$id"); 
    return db_select_one($query, [$id]);;
}

/**
 * Récupère tous les médias jeux ordre decroissant
 */
function get_all_media($limit = null, $offset = 0) {
    $query = "SELECT id, media_id, publisher, platform, min_age, description, created_at, updated_at 
              FROM game 
              ORDER BY created_at DESC";
    
    if ($limit !== null) {
        $query .= " LIMIT $offset, $limit";
    } 

        // Si $limit est défini → on ajoute une limite SQL.
        // $offset = le nombre de lignes à sauter (ex : pour la page 2 d’une pagination).
        // $limit = combien de lignes retourner.
    
    db_log("get_all_media: limit=$limit offset=$offset");
    return db_select($query);
}

 
















/**
 * Met à jour un média (jeu)
 */
function update_media($id, $publisher, $platform, $min_age, $description) {
    $query = "UPDATE game 
              SET publisher = ?, platform = ?, min_age = ?, description = ?, updated_at = NOW() 
              WHERE id = ?";
    
    $ok = db_execute($query, [$publisher, $platform, $min_age, $description, $id]);
    db_log("update_media: id=$id status=" . ($ok ? "OK" : "FAIL"));
    return $ok;
}

/**
 * Supprime un média (jeu)
 */
function delete_media($id) {
    $query = "DELETE FROM game WHERE id = ?";
    $ok = db_execute($query, [$id]);
    db_log("delete_media: id=$id status=" . ($ok ? "OK" : "FAIL"));
    return $ok;
}

/**
 * Compte le nombre total de médias
 */
function count_media() {
    $query = "SELECT COUNT(*) as total FROM game";
    $result = db_select_one($query);
    $total = $result['total'] ?? 0;
    db_log("count_media: total=$total");
    return $total;
}

/**
 * Vérifie si un jeu existe déjà par son media_id
 */
function media_exists($media_id, $exclude_id = null) {
    $query = "SELECT COUNT(*) as count FROM game WHERE media_id = ?";
    $params = [$media_id];
    
    if ($exclude_id) {
        $query .= " AND id != ?";
        $params[] = $exclude_id;
    }
    
    $result = db_select_one($query, $params);
    $exists = $result['count'] > 0;
    db_log("media_exists: media_id=$media_id exclude_id=$exclude_id exists=" . ($exists ? "YES" : "NO"));
    return $exists;
}
