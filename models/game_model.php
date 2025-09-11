<?php

/**
 * Ajoute un nouveau jeu dans la base de données.
 *
 * @param int $media_id L’ID du média associé au jeu.
 * @param string $publisher L’éditeur du jeu.
 * @param int $min_age L’âge minimum requis pour jouer.
 * @param string $description Une description du jeu.
 * @return bool True en cas de succès, false en cas d’échec.
 */
function add_game($media_id, $publisher, $min_age, $description)
{
    $query = "INSERT INTO games (media_id, publisher, min_age, description) VALUES (?, ?, ?, ?)";
    return db_execute($query, [$media_id, $publisher, $min_age, $description]);
}

/**
 * Crée un nouveau jeu ainsi que son média, ses genres et ses plateformes dans une transaction.
 *
 * @param string $title Le titre du jeu.
 * @param string $publisher L’éditeur du jeu.
 * @param int $min_age L’âge minimum requis pour jouer.
 * @param string $description Une description du jeu.
 * @param array $genres Tableau de genres associés au jeu.
 * @param array $platforms Tableau de plateformes disponibles pour le jeu.
 * @param ?string $img_url URL optionnelle de l’image du jeu.
 * @return bool True en cas de succès, false en cas d’échec.
 */
function create_game($title, $publisher, $min_age, $description, $genres, $platforms, $img_url)
{
    try {
        db_begin_transaction();

        $media_id = add_media($title, 'game', null, $img_url);
        
        if (!$media_id) {
            throw new Exception("Échec de l'ajout dans 'media'.");
        }

        if (!add_game($media_id, $publisher, $min_age, $description)) {
            throw new Exception("Echec de l'ajout dans la table 'games'.");
        }

        if (!add_genres($media_id, $genres)) {
            throw new Exception("Echec de l'ajout dans la table 'genres'.");
        }

        if (!add_platform($media_id, $platforms)) {
            throw new Exception("Echec de l'ajout dans la table 'platform'");
        }

        db_commit();
        set_flash('success', "Jeu ajouté avec succès");
        return true;
    } catch (Throwable $e) {
        db_rollback();
        set_flash('error', "Insertion annulée.");
        return false;
    }
}