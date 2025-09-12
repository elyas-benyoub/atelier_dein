<div class="page-header">
    <div class="container">
        <h1>Utilisateurs</h1>
    </div>
</div>
<section class="getting-started">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Role</th>
                <th>Créé à</th>
                <th>Mis à jour le</th>
                <!-- <th>Emprunts</th> -->
                <th>Actions</th>

        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php e($user['id']); ?></td>
                        <td><?php e($user['name']); ?></td>
                        <td><?php e($user['email']); ?></td>
                        <td><?php e($user['role']); ?></td>
                        <td><?php e($user['created_at']); ?></td>
                        <td><?php e($user['updated_at']); ?></td>
                        <!-- <td><?php e($user['emprunts']); ?></td> -->
                        <td>
                            <a href="<?php echo url('admin/form_edit_user?id=' . $user['id']); ?>">Edit</a>
                            <a href="<?php echo url('admin/handle_delete_user?id=' . $user['id']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>