<?php
function loan_admin_form()
{
    only_admin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_valid_csrf('loan/show_loans');

        $user_id = post('user_id');
        $media_id = post('media_id');

        if (count_active_loans($user_id) >= 3) {
            set_flash('error', "L'utilisateur a déjà 3 emprunts en cours.");
        } elseif (is_media_borrowed($media_id)) {
            set_flash('error', "Ce média est déjà emprunté.");
        } else {
            $loan_date = date('Y-m-d H:i:s');
            $due_date = date('Y-m-d H:i:s', strtotime('+14 days'));

            $ok = create_loan($user_id, $media_id, $loan_date, $due_date);
            if ($ok) {
                set_flash('success', "Emprunt enregistré avec succès.");
            } else {
                set_flash('error', "Echec de l'emprunt.");
            }
        }
    }

    redirect('loan/show_loans');
}

function loan_show_loans()
{
    only_admin();

    $users = get_all_users() ?? [];
    $medias = get_all_media() ?? [];       // médias disponibles
    $loans = get_all_media_loans() ?? []; // emprunts en cours
    $loan_id = get('loan_id') ?? null;

    $data = [
        'title' => "Gestion des emprunts",
        'users' => $users,
        'medias' => $medias,
        'loans' => $loans,
        'loan_id' => $loan_id
    ];

    // var_dump($data['medias']); exit;
    load_view_with_layout('admin/loan_users', $data);
}

function loan_create()
{
    if (!is_post()) {
        redirect('home');
    }

    require_valid_csrf('home');

    if (!is_logged_in()) {
        set_flash("error", "Vous devez être connecté pour emprunter un média.");
        redirect('auth/login');
    }

    $user_id  = $_SESSION['user_id'] ?? null;
    $media_id = post('media_id');
    $user_loans = count(get_all_loans_by_user_id($user_id));
    
    if ($user_loans >= 3) {
        set_flash('error', "Vous avez déjà emprunté 3 médias.");
        redirect('home/info?id=' . $media_id);
    }

    if (!$media_id) {
        set_flash("error", "Aucun média spécifié.");
        redirect();
    }

    if (is_media_borrowed($media_id)) {
        set_flash('error', "Ce média est déjà emprunté.");
        redirect('home/info?id=' . $media_id);
    }

    $loanDate = date('Y-m-d H:i:s');
    $dueDate  = date('Y-m-d H:i:s', strtotime('+14 days'));



    if (!create_loan($user_id, $media_id, $loanDate, $dueDate)) {
        set_flash("error", "Impossible d'enregistrer l'emprunt.");
    } else {
        set_flash("success", "Emprunt enregistré !");
    }

    redirect('home/info?id=' . $media_id);
}

function loan_return_loan()
{
    if (!is_post()) {
        redirect('home');
    }

    require_valid_csrf('home');

    $loan_id = post('loan_id');
    $page = post('page');

    if (!is_logged_in()) {
        set_flash('error', "Vous devez être connecté pour rendre un média.");
        redirect('auth/login');
    }

    if (!$loan_id || !ctype_digit((string) $loan_id)) {
        set_flash('error', "Identifiant d'emprunt manquant.");
        redirect('home');
    }

    $loan = get_loan_by_id($loan_id);
    if (!$loan || $loan['status'] !== 'borrowed') {
        set_flash('error', "Emprunt introuvable ou déjà retourné.");
        redirect('home');
    }

    $media_id = (int) $loan['id_m'];
    $is_admin = is_admin();
    if (!$is_admin && (int) $loan['id_u'] !== (int) current_user_id()) {
        set_flash('error', "Vous ne pouvez pas rendre cet emprunt.");
        redirect('home/info?id=' . $media_id);
    }

    $redirect_path = ($is_admin && $page === 'loans')
        ? 'loan/show_loans'
        : 'home/info?id=' . $media_id;

    $ok = return_loan($loan_id);

    if (!$ok) {
        set_flash('error', "Retour impossible.");
    } else {
        set_flash('success', "Media retourne avec succès !");
    }

    redirect($redirect_path);
}
