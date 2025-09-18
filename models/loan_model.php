<?php


// gestion emprunts


function create_loan($user_id, $media_id, $loan_date, $due_date)
{
    $sql = "INSERT INTO loans (id_u, id_m, loan_date, due_date, status)
            VALUES (?, ?, ?, ?, 'borrowed')";
    return db_execute($sql, [$user_id, $media_id, $loan_date, $due_date]);
}


// Compter le nombre d'emprunts actifs pour un utilisateur
function count_active_loans($user_id)
{
    $sql = "SELECT COUNT(*) AS total 
            FROM loans
            WHERE id_u = ? AND status = 'borrowed'";
    $row = db_select_one($sql, [$user_id]);
    return $row ? (int) $row['total'] : 0;
}

// Vérifier si un média est déjà emprunté
function is_media_borrowed($media_id)
{
    $sql = "SELECT id 
            FROM loans
            WHERE id_m = ? AND status = 'borrowed'";
    $row = db_select_one($sql, [$media_id]);
    return !empty($row);
}


// prendre les emprunts titre 

function get_all_media_loans()
{
    $sql = "SELECT l.*, u.name, m.title
            FROM loans l
            INNER JOIN media m ON l.id_m = m.id
            INNER JOIN users u ON l.id_u = u.id
           ORDER BY status = 'returned', loan_date DESC";
    return db_select($sql);
}

function get_all_media_loans_by_user_id($user_id)
{
    $sql = "SELECT l.*, u.name, m.title
            FROM loans l
            INNER JOIN media m ON l.id_m = m.id
            INNER JOIN users u ON l.id_u = u.id
            WHERE u.id = ?
            ORDER BY m.created_at DESC, u.created_at DESC";
    return db_select($sql, [$user_id]);
}

function return_loan($id) {
    $query = "UPDATE loans SET status = 'returned', return_date = NOW()
            WHERE id = ? AND status = 'borrowed'";
    return db_execute($query, [$id]);
}

function get_loan_by_id($id) {
    $query = "SELECT * FROM loans WHERE id = ? LIMIT 1";
    return db_select_one($query, [$id]);
}

function sort_loan_list() {
    $query = "SELECT * FROM loans ORDER BY status = 'returned', loan_date DESC";
    return db_select($query);
}

function get_loan_by_media_id($media_id) {
    $query = "SELECT * FROM loans WHERE id_m = ?";
    return db_select_one($query, [$media_id]);
}