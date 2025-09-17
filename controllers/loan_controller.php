<?php


require_once MODEL_PATH . '/loan_model.php';
require_once MODEL_PATH . '/user_model.php';
require_once MODEL_PATH . '/media_model.php';

function loan_users()
{
    only_admin(); // juste admin

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = post('user_id');
        $media_id = post('media_id');

        // Vérifier les règles d’emprunt
        if (count_active_loans($user_id) >= 3) {
            set_flash('error', "L'utilisateur a déjà 3 emprunts en cours.");
        } elseif (is_media_borrowed($media_id)) {
            set_flash('error', "Ce média est déjà emprunté.");
        } else {
            $loan_date = date('Y-m-d H:i:s');
            $due_date = date('Y-m-d H:i:s', strtotime('+14 jours'));

            create_loan($user_id, $media_id, $loan_date, $due_date);
            set_flash('success', "Emprunt enregistré avec succès !");
        }
    }

    // Toujours recharger la vue avec les données à jour
    $users = get_all_users();
    $medias = get_all_media();       // médias disponibles
    $loans = get_all_media_loans(); // emprunts en cours

    $data = [
        'title' => "Créer un emprunt ",
        'users' => $users,
        'medias' => $medias,
        'loans' => $loans
    ];

    load_view_with_layout('/admin/loan_users', $data);
}



// Nouvelle fonction côté user
function borrow_media() {
    is_logged_in(); // sécurité : seulement les utilisateurs connectés

    $user_id = post('user_id');
    $media_id = post('media_id');

    // Vérifier si le média est déjà emprunté
    if (is_media_borrowed($media_id)) {
        set_flash('error', "Ce média est déjà emprunté.");
        redirect("media/show/$media_id"); // retour à la fiche du média
    }

    // Vérifier si l'utilisateur a déjà atteint la limite
    if (count_active_loans($user_id) >= 3) {
        set_flash('error', "Vous avez déjà atteint la limite d'emprunts.");
        redirect("media/show/$media_id");
    }

    // Calcul des dates
    $loan_date = date('Y-m-d H:i:s');
    $due_date = date('Y-m-d H:i:s', strtotime('+14 days'));

    // Créer l’emprunt
    create_loan($user_id, $media_id, $loan_date, $due_date);

    // Message + redirection
    set_flash('success', "Vous avez emprunté ce média avec succès !");
    redirect("media/show/$media_id");
}

function loan_create()
{
    if (!is_logged_in()) {
        set_flash("error", "Vous devez être connecté pour emprunter un média.");
        redirect('auth/login');
    }

    $user_id  = $_SESSION['user_id'] ?? null;
    $media_id = get('id') ?? null;

    if (!$media_id) {
        set_flash("error", "Aucun média spécifié.");
        redirect();
    }

    $loanDate = date('Y-m-d H:i:s');
    $dueDate  = date('Y-m-d H:i:s', strtotime('+14 days'));

    $data = [
        'user_id'   => $user_id,
        'media_id'  => $media_id,
        'loan_date' => $loanDate,
        'due_date'  => $dueDate
    ];

    // Ici tu insères en BDD
    if (create_loan($user_id, $media_id, $loanDate, $dueDate)) {
        set_flash("success", "Emprunt enregistré !");
    } else {
        set_flash("error", "Impossible d'enregistrer l'emprunt.");
    }

    // 🔹 Redirection vers la page info du média
    redirect('home/info?id=' . $media_id);
}

function handle_return_loan() {
    $id = get('id') ?? null;

    if ($id === null) {
        set_flash('error', 'Id de l\'user manquant.');
        redirect('admin/show_users');
    }

    $status = get('status');

    $ok = return_loan($id, $status);

    if(!$ok) {
        set_flash('error', "Retour impossible.");
    } else {
        set_flash('success', "Media retourne avec succès !");
    }
}