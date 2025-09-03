<?php

function media_add_book()
{
    $genres = get_all_genres();
    load_view_with_layout('/media/add_book', ['genres' => $genres]);
}

function media_add_game()
{
    $genres = get_all_genres();
    load_view_with_layout('/media/add_game', ['genres' => $genres]);
}

function media_add_movie()
{
    $genres = get_all_genres();
    load_view_with_layout('/media/add_movie', ['genres' => $genres]);
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
        $cover = clean_input(post('cover'));

        create_book($title, $author, $isbn, $pages, $resume, $pb_year, $genres, $cover);
        redirect('media/add_book');
    }
}

function media_store_game()
{
    if (is_post()) {
        $title = clean_input(post('title'));
        $publisher = clean_input(post('publisher'));
        $platform = clean_input(post('platform'));
        $min_age = post('min_age');
        $description = clean_input(post('description'));
        $genres = post('genres');


        create_game($title, $publisher, $platform, $min_age, $description, NULL, $genres, null);
        redirect('media/add_game');
    }
}

// Fonction qui récupère et enregistre les infos du formulaire après envoi
function media_store_movie()
{

    if (is_post()) {    // On vérifie si la requête est bien un POST (c'est-à-dire que le formulaire a été soumis)
        $title = clean_input(post('title'));
        $director = clean_input(post('director'));
        $duration = post('duration');
        $synopsis = clean_input(post('synopsis'));
        $year = (post('year'));
        $classification = clean_input(post('classification'));
        $genres = post('genres');

        create_movie($title, $director, $duration, $synopsis, $classification, $year, $genres, null);
        redirect('media/add_movie');
    }
}

if (isset($_POST['cover'])) {
    $image = $_FILES['image']['name'];
    $imageArr = explode('.', $image); //first index is file name and second index file type
    $rand = rand(10000, 99999);
    $newImageName = $imageArr[0] . $rand . '.' . $imageArr[1];
    $ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
    $newImageName = uniqid() . "." . strtolower($ext);
    $uploadPath = "../public/uploads/covers/book_" . $newImageName;

    resize_image($_FILES['cover']['tmp_name'], $uploadPath, 300, 400);

    $isUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath);
    if ($isUploaded)
        echo 'Image ajouter!';
    else
        echo 'Error';
}
