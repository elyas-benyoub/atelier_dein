<?php
function media_add_game(){
    load_view_with_layout('media/add_game');
    var_dump($_POST);
    exit;
}

// function media_store_game() {

//  if (is_post()) {
//     $titre = clean_input(post('titre')); 
//     $editeur = clean_input(post('editeur'));  
//     $plateforme = clean_input(post('plateforme')); 
//     $age_minimum = post('age_minimum');
//     $description = clean_input(post('description')); 
        
//                 $jeu = create_game($titre, $editeur, $plateforme, $age_minimum, $description);
          
            
//             if ($jeu) {
//                 set_flash('success', 'réussie !');
//                 redirect('storage/app');
//             } else {
//                 set_flash('error', 'Erreur pas de jeu.');
//             }

//     // $data = [
//     //     'titre'       => $titre,
//     //     'editeur'     => $editeur,
//     //     'plateforme'  => $plateforme,
//     //     'age_minimum' => $age_minimum,
//     //     'description' => $description
//     // ];

//     load_view_with_layout('media/add_game', $data);
// }
// }


function create_media($titre) {
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        return false; 
    }

    $query = "INSERT INTO media (title, user_id, created_at, updated_at) 
              VALUES (?, ?, ?, ?)";

    if (db_execute($query, [$titre, $user_id])) {
        return db_last_insert_id();
    }
    return false;
}


// function media_store_game() {
//     if (is_post()) {
//         $titre       = clean_input(post('titre'));
//         $publisher   = clean_input(post('editeur'));
//         $platform    = clean_input(post('plateforme'));
//         $min_age     = (int) post('age_minimum');
//         $description = clean_input(post('description'));


//         $media_id = create_media($titre);

//         if ($media_id) {

//             $jeu = create_game($publisher, $platform, $min_age, $description);

//             if ($jeu) {
//                 set_flash('success', 'Jeu ajouté avec succès !');
//                 redirect('media/add_game');
//             } else {
//                 set_flash('error', 'Erreur : le jeu n’a pas été ajouté.');
//             }
//         } else {
//             set_flash('error', 'Erreur : le media n’a pas pu être créé.');
//         }
//     }
// }




require_once MODEL_PATH . '/media_model.php'; 
function media_store_game() {
    if (is_post()) {
        $titre       = clean_input(post('titre')); 
        $editeur     = clean_input(post('editeur'));  
        $plateforme  = clean_input(post('plateforme')); 
        $age_minimum = post('age_minimum');
        $description = clean_input(post('description')); 

        
        $jeu = create_game($titre, $editeur, $plateforme, $age_minimum, $description);

        if ($jeu) {
            set_flash('success', 'Jeu ajouté avec succès !');
            redirect('media/add_game'); 
        } else {
            set_flash('error', 'Erreur : le jeu n’a pas été ajouté.');
            load_view_with_layout('media/add_game'); 
        }
    }
}



