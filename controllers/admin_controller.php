<?php
function admin_show_users()
{
    only_admin();
    $users = get_all_users();

    $data = [
        'title' => "Utilisateurs",
        'users' => $users
    ];

    load_view_with_layout('/admin/users', $data);
}
