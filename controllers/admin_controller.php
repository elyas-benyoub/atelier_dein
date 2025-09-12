<?php
// this fumctiom ic made to connect database table users amd view to qffiche a list
function admin_show_users()
{
    only_admin(); //only admin can see it
    $users = get_all_users(); //

    $data = [
        'title' => "Utilisateurs",
        'users' => $users
    ];

    load_view_with_layout('/admin/users', $data);
}

function admin_form_edit_user()
{
    $user_id = get('id') ?? null;
    $user = get_user_by_id($user_id);
    $data = [
        'title' => "Modifier un utilisateur",
        'user' => $user
    ];

    load_view_with_layout('/admin/edit_user', $data);
}
function admin_handle_edit_user()
{
    $id = get('id') ?? null;

    if ($id === null) {
        set_flash('error', 'Id de l\'user manquant.');
        redirect('admin/show_users');
    }

    // $user = get_user_by_id($id);

    // Utiliser les données du formulaire pour la mise à jour
    $name = post('name');
    $email = post('email');
    $role = post('role');

    $ok = update_user($id, $name, $email, $role);

    if (!$ok) {
        set_flash('error', "La modification de l'utilisateur n'a pas été effectuée.");
    } else {
        set_flash('success', "L'utilisateur a été modifié avec succès !");
    }

    // Redirection vers la page des utilisateurs
    redirect('admin/show_users');
}

function admin_handle_delete_user()
{
    $id = get('id') ?? null;

    $user = get_user_by_id($id);
    if (!$user) {
        set_flash('error', 'Id de l\'user manquant.');
        redirect('admin/show_users');
    }
    $ok = delete_user($id);
    if (!$ok) {
        set_flash('error', 'Erreur lors de la suppression de l\'utilisateur.');
    } else {
        set_flash('success', 'Utilisateur supprimé avec succès.');
    }

    redirect('admin/show_users');
}
