<?php
function loan_show_loans()
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
    $id = get('id') ?? null;
    $users = get_all_users() ?? [];
    $medias = get_all_media() ?? [];       // médias disponibles
    $loans = get_all_media_loans() ?? []; // emprunts en cours
    $loan_id = get_loan_by_id($id) ?? [];

    $data = [
        'title' => "Créer un emprunt ",
        'users' => $users,
        'medias' => $medias,
        'loans' => $loans,
        'loan_id' => $loan_id
    ];

    load_view_with_layout('admin/loan_users', $data);
}


// ????????????????????????????????????????
// Nouvelle fonction côté user
function loan_borrow_media() {
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

function loan_handle_return_loan() {
    $id = get('id') ?? null;

    if ($id === null) {
        set_flash('error', "Identifiant d'emprunt manquant.");
        redirect('admin/loan_users');
    }

    $ok = return_loan($id);

    if(!$ok) {
        set_flash('error', "Retour impossible.");
    } else {
        set_flash('success', "Media retourne avec succès !");
    }
  
    load_view_with_layout('admin/loan_users');
}