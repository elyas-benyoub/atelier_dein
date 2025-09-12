
<?php

function loan_users()
{
    only_admin(); // sécurité admin

    // Si on reçoit un POST (formulaire soumis)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = post('user_id');
        $media_id = post('media_id');

        // Vérifier les règles d’emprunt
        if (count_active_loans($user_id) >= 3) {
            set_flash('error', "L'utilisateur a déjà 3 emprunts en cours.");
            redirect('admin/loan_users');
        }

        if (is_media_borrowed($media_id)) {
            set_flash('error', "Ce média est déjà emprunté.");
            redirect('admin/loan_users');
        }

        // Calcul des dates
        $loan_date = date('Y-m-d H:i:s');
        $due_date = date('Y-m-d H:i:s', strtotime('+14 days'));

        // Création de l’emprunt
        create_loan($user_id, $media_id, $loan_date, $due_date);

        set_flash('success', "Emprunt enregistré avec succès !");
        redirect('admin/loan_users');
    }

    // Sinon, on affiche le formulaire
    $users = get_all_users();
    $medias = get_all_media_loans(); // seulement ceux pas empruntés

    $data = [
        'title' => "Créer un emprunt",
        'users' => $users,
        'medias' => $medias
    ];

    load_view_with_layout('/admin/loan_users', $data);
}













// function loan_users()
// {
//     only_admin();

//     // Charger les users
//     $users = get_all_users();

//     // Charger les emprunts
//     $media = get_all_loans();

//     $data = [
//         'title' => 'Créer un emprunt',
//         'users' => $users,
//         'loans' => $media
//     ];

//     load_view_with_layout('/admin/loan_users', $data);
// }




// function loan_users()
// {
//     only_admin();

//     // Charger les users
//     $users = get_all_users();

//     // Charger les médias disponibles
//     $media = get_all_loans();


//     $data = [
//         'title' => 'Créer un emprunt d un média disponible',
//         'users' => $users,
//         'loans' => $media
//     ];

//     load_view_with_layout('/admin/loan_users', $data);
// }
