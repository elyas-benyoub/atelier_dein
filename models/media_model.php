<?php
function get_book_by_id($id) {
    $query = "SELECT * FROM books WHERE id = :id LIMIT 1";
    return db_select_one($query, [':id' => $id]);
}

function create_book($titre, $auteur, $isbn, $genre, $resume, $pages, $pb_year, $genre_id) {
    // Insert into media table
    $query = "INSERT INTO media (title, year) VALUES (?, ?);";
    if (!db_execute($query, [$titre, $pb_year])) {
        return false; // stop if media insert fails
    }

    $media_id = db_last_insert_id();

    // Insert into books table
    $query = "INSERT INTO books (media_id, author, isbn, page_count, summary, publication_year)
              VALUES (?, ?, ?, ?, ?, ?);";

    if (db_execute($query, [$media_id, $auteur, $isbn, $pages, $resume, $pb_year])) {
        return $media_id; // return media_id as the reference
    }


    // Insert into media_genres table
    $query = "INSERT INTO media_genres (media_id, genre_id)
              VALUES (?, ?);";

    if (db_execute($query, [$media_id, $genre_id])) {
        return $media_id; // return media_id as the reference
    }

    return false;
}

function get_all_genres()  {
    $query = "SELECT id, name from genres";
    return db_select($query);
}


