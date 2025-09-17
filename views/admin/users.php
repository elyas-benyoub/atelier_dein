<div class="page-header">
  <div class="container">
    <h1>Utilisateurs</h1>
  </div>
</div>

<section class="getting-started">
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Role</th>
        <th>Créé à</th>
        <th>Mis à jour le</th>
        <th>Emprunts</th>
      </tr>
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
            <!-- <?php e($user['emprunts']); ?></td>  -->
            <!-- <td><?php e($user['emprunts']); ?></td> -->
            <td>
              <a href="<?php echo url('admin/form_edit_user?id=' . $user['id']); ?>">Edit</a>
              <?php if (($role === 'admin') && ($user['id'] === $admin_id)): ?>
                <?php if (count_admin() > 1): ?>
                  <a href="<?= url('admin/handle_delete_user?id=' . $user['id']); ?>" class="btn btn-danger">Delete</a>
                <?php endif; ?>
              <?php else: ?>
                <a href="<?= url('admin/handle_delete_user?id=' . $user['id']); ?>" class="btn btn-danger">Delete</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7">Aucun utilisateur trouvé.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>