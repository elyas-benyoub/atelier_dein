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
        <th>Créé le</th>
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
            <td><?php e(format_date($user['created_at'])); ?></td>
            <td><?php e(format_date($user['updated_at'])); ?></td>
            <td class="user-actions">
              <form action="<?php echo url('admin/form_edit_user?id=' . $user['id']); ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <input type="hidden" name="id" value="<?= e($user['id']) ?>">
                <button type="submit" class="btn btn-secondary">Modifier</button>
              </form>

              <form action="<?= url('admin/handle_delete_user') ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <input type="hidden" name="id" value="<?= e($user['id']) ?>">
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
              </form>
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