<?php
function media_add_game()
{
    $genres = get_all_genres();

    load_view_with_layout('/media/add_game', ['genres' => $genres]);
}


function media_store_game() {
 if (is_post()) {
    $title = clean_input(post('titre')); 
    $publisher= clean_input(post('editeur'));
    $genres = post('genres');   
    $platform = clean_input(post('plateforme')); 
    $min_age = post('age_minimum');
    $description = clean_input(post('description')); 
    $year = (int)post('year');
        
    create_game($title, $publisher, $genres, $platform, $min_age, $description,$year);
 }


    $data = [
        'titre'       => $title,
        'editeur'     => $publisher,
        'genres'     => $genres,
        'plateforme'  => $platform,
        'age_minimum' => $min_age,
        'description' => $description,
        'année'    => $year,
    ];
         load_view_with_layout('media/add_game', $data);
    }

function media_store_book()
{
    if (is_post()) {
        $title = clean_input(post('title'));
        $author = clean_input(post('author'));
        $isbn = post('isbn');
        $genres = post('genre');
        $pages = post('pages');
        $resume = clean_input(post('resume'));
        $pb_year = post('pb_year');

        create_book($title, $author, $isbn, $genres, $pages, $resume, $pb_year);
    }
}



