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
            ORDER BY m.created_at DESC, u.created_at DESC";
    return db_select($sql);
}

