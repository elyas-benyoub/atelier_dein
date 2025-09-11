<?php

/**
 * Ajoute un nouveau livre dans la base de données.
 *
 * @param int $media_id ID du média associé
 * @param string $author Auteur du livre
 * @param string $isbn Numéro ISBN
 * @param int $page_count Nombre de pages
 * @param string $summary Résumé du livre
 * @param int $pb_year Année de publication
 * @return bool True en cas de succès, false en cas d'échec.
 */
function add_book($media_id, $author, $isbn, $page_count, $summary, $pb_year)
{
    $query = "INSERT INTO books (media_id, author, isbn, page_count, summary, publication_year) VALUES (?, ?, ?, ?, ?, ?)";
    return db_execute($query, [$media_id, $author, $isbn, $page_count, $summary, $pb_year]);
}

/**
 * Crée un nouveau livre ainsi que son média et ses genres dans une transaction.
 *
 * @param string $title Titre du livre
 * @param string $author Auteur du livre
 * @param string $isbn Numéro ISBN
 * @param int $page_count Nombre de pages
 * @param string $summary Résumé du livre
 * @param int $pb_year Année de publication
 * @param array $genres Genres associés au livre
 * @param string $img_url URL ou chemin de l'image du livre
 * @return bool True en cas de succès, false en cas d'échec.
 */
function create_book($title, $author, $isbn, $page_count, $summary, $pb_year, $genres, $img_url)
{
    try {
        db_begin_transaction();

        $media_id = add_media($title, 'book', $pb_year, $img_url);
        
        if (!$media_id) {
            throw new Exception("Échec de l'ajout dans 'media'.");
        }

        if (!add_book($media_id, $author, $isbn, $page_count, $summary, $pb_year)) {
            throw new Exception("Echec de l'ajout dans la table 'books'.");
        }

        if (!add_genres($media_id, $genres)) {
            throw new Exception("Echec de l'ajout dans la table 'genres'.");
        }
    
        db_commit();
        return true;
    } catch (Throwable $e) {
        db_rollback();
        app_log('[create_book] ' . $e->getMessage());
        return false;
    }
}