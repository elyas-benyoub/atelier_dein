

<?php

/**
 * Récupère un utilisateur par son email
 */
function get_user_by_email($email) {
    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    return db_select_one($query, [$email]);
}

function get_all_admins() {
    $query = "SELECT * FROM users WHERE role = 'admin'";
    return db_select($query);
}

/**
 * Récupère un utilisateur par son ID
 */
function get_user_by_id($id) {
    $query = "SELECT * FROM users WHERE id = ? LIMIT 1";
    return db_select_one($query, [$id]);
}

/**
 * Crée un nouvel utilisateur
 */
function create_user($name, $email, $password, $role = 'user', $profile_picture = null) {
    $hashed_password = hash_password($password);
    $query = "INSERT INTO users (name, email, password, role, profile_picture, created_at, updated_at) 
              VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
    
    if (db_execute($query, [$name, $email, $hashed_password, $role, $profile_picture])) {
        return db_last_insert_id();
    }
    
    return false;
}

/**
 * Met à jour un utilisateur
 */
function update_user($id, $name, $email, $role) {
    $query = "UPDATE users SET name = ?, email = ?, role= ?, updated_at = NOW() where id = ?";

    return db_execute($query, [$name, $email, $role, $id]);
}

/**
 * Met à jour le mot de passe d'un utilisateur
 */
function update_user_password($id, $password) {
    $hashed_password = hash_password($password);
    $query = "UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?";
    return db_execute($query, [$hashed_password, $id]);
}

/**
 * Supprime un utilisateur
 */
function delete_user($id) {
    $query = "DELETE FROM users WHERE id = ?";
    return db_execute($query, [$id]);
}

/**
 * Récupère tous les utilisateurs
 */
function get_all_users($limit = null, $offset = 0) {
    $query = "SELECT id, name, email, role, created_at, updated_at FROM users ORDER BY created_at DESC";
    
    if ($limit !== null) {
        $query .= " LIMIT $offset, $limit";
    }
    
    return db_select($query);
}

/**
 * Compte le nombre total d'utilisateurs
 */
function count_users() {
    $query = "SELECT COUNT(*) as total FROM users";
    $result = db_select_one($query);
    return $result['total'] ?? 0;
}

function count_admin() {
    $query = "SELECT COUNT(*) FROM users WHERE role = ?";
    $result = db_select_one($query, ["admin"]);
    return (int) $result;
}

function has_other_admins(int $exclude_id): bool {
    $row = db_select_one(
        "SELECT COUNT(*) AS c FROM users WHERE role = 'admin' AND id <> ?",
        [$exclude_id]
    );
    return ((int)$row['c']) > 0;
}

/**
 * Vérifie si un email existe déjà
 */
function email_exists($email, $exclude_id = null) {
    $query = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $params = [$email];
    
    if ($exclude_id) {
        $query .= " AND id != ?";
        $params[] = $exclude_id;
    }
    
    $result = db_select_one($query, $params);
    return $result['count'] > 0;
}
 
