<?php


// gestion emprunts


// creer un emprunt
function create_loan($title, $user_id, $media_id, $loan_date, $due_date)
{
    global $db;
    $sql = "INSERT INTO loans ($title, id_u, id_m, loan_date, due_date, status)
            VALUES ( ?, ?, ?, ?, ?, 'borrowed')";
    return $db->query($sql, [$title, $user_id, $media_id, $loan_date, $due_date]);
}

// nb d'emprunts  d'un utilisateur
function count_active_loans($user_id)
{
    global $db;
    $sql = "SELECT COUNT(*) AS total FROM loans
            WHERE id_u = ? AND status = 'borrowed'";
    $row = $db->query($sql, [$user_id])->fetch();
    return $row ? $row['total'] : 0;
}

//  nd d'emprunt
function is_media_borrowed($media_id)
{
    global $db;
    $sql = "SELECT id FROM loans
            WHERE id_m = ? AND status = 'borrowed'";
    $row = $db->query($sql, [$media_id])->fetch();
    return !empty($row);
}


// prendre les emprunts titre 

function get_all_media_loans()
{
    global $db;
    $sql = "SELECT l.*, u.name, m.title
    FROM loans l
    INNER JOIN media m ON l.id_m = m.id
    INNER JOIN users u ON l.id_u = u.id
    ORDER BY m.created_at, u.created_at DESC";
    return $db->query($sql)->fetchAll();
}



