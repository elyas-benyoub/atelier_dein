
<?php


require_once MODEL_PATH . '/loan_model.php';
require_once MODEL_PATH . '/user_model.php';
require_once MODEL_PATH . '/media_model.php';

function loan_users()
{
    only_admin(); // juste admin

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id  = post('user_id');
        $media_id = post('media_id');

        // Vérifier les règles d’emprunt
        if (count_active_loans($user_id) >= 3) {
            set_flash('error', "L'utilisateur a déjà 3 emprunts en cours.");
        } elseif (is_media_borrowed($media_id)) {
            set_flash('error', "Ce média est déjà emprunté.");
        } else {
            $loan_date = date('Y-m-d H:i:s');
            $due_date  = date('Y-m-d H:i:s', strtotime('+14 jours'));

            create_loan($user_id, $media_id, $loan_date, $due_date);
            set_flash('success', "Emprunt enregistré avec succès !");
        }
    }

    // Toujours recharger la vue avec les données à jour
    $users  = get_all_users();
    $medias = get_all_media();       // médias disponibles
    $loans  = get_all_media_loans(); // emprunts en cours

    $data = [
        'title'  => "Créer un emprunt ",
        'users'  => $users,
        'medias' => $medias,
        'loans'  => $loans
    ];

    load_view_with_layout('/admin/loan_users', $data);
}



