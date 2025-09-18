<?php
// this fumctiom ic made to connect database table users amd view to qffiche a list
function admin_show_users()
{
    only_admin(); //only admin can see it
    $users = get_all_users(); //
    $role = $_SESSION['user_role'];
    $admin_id = $_SESSION['user_id'];

    $data = [
        'title' => "Les Utilisateurs",
        'users' => $users,
        'role' => $role,
        'admin_id' => $admin_id
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

function admin_show_medias()
{
    only_admin(); //only admin can see it
    $medias = get_all_medias();
    $genres = get_all_genres();
    $media_genres = get_all_media_genres();

    $media_to_genres = [];
    foreach ($media_genres as $row) {
        $media_id = $row['media_id'];
        $genre_id = $row['genre_id'];
        if (isset($genres[$genre_id])) {
            $media_to_genres[$media_id][] = $genres[$genre_id];
        }
    }

    $data = [
        'title' => "Medias",
        'medias' => $medias,
        'media_to_genres' => $media_to_genres,
    ];

    load_view_with_layout('/admin/media_admin', $data);
}

function admin_handle_edit_user()
{

    only_admin()
    $ids = get('id') ?? null;

    if ($ids === null) {
        set_flash('error', 'Id de l\'user manquant.');
        redirect('admin/show_users');
    }

    $user = get_user_by_id($id);

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

function admin_handle_delete_media()
{
    $id = get('id') ?? null;

    $media = get_media_by_id($id);

    if (!$media) {
        set_flash('error', 'Id de media manquant.');
        redirect('admin/show_medias');
    }

    if (!empty($media['image_path']) && file_exists($media['image_path'])) {
        unlink($media['image_path']);
    }

    $ok = delete_media($id);

    if (!$ok) {
        set_flash('error', 'Erreur lors de la suppression de media.');
    } else {
        set_flash('success', 'Media supprimé avec succès.');
    }

    redirect('admin/show_medias');
}

