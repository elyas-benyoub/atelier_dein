<?php
function media_add_book()
{
    $genres = get_all_genres();

$assoc = array_column($genres, 'name', 'id');

$data['genres'] = $assoc;


load_view_with_layout('media/add_book', $data);
}



function media_store_book()
{
    if (is_post()) {
        $titre = clean_input(post('titre'));
        $auteur = clean_input(post('auteur'));
        $isbn = post('isbn');
        $genres = post('genres'); 
        $pages = post('pages');
        $resume = clean_input(post('resume'));
        $pb_year = post('pb_year');

        if (empty($titre) || empty($auteur) || empty($isbn) || empty($pages) || empty($resume) || empty($pb_year) || empty($genres)) {
            set_flash('error', 'Tous les champs sont obligatoires.');
            return;
        }
        
        }
    }