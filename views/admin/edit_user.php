<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Modifier l'utilisateur</p>
        </div>

        <form method="POST" action="<?php echo url('admin/handle_edit_user?id=' . $user['id']); ?>" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">


            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" value="<?php echo e($user['name']); ?>">
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?php echo e($user['email']); ?>">
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" value="<?php echo e($user['role']); ?>">
            </div>

            <button type="submit" name="action" value="edit" class="btn btn-primary btn-full">
                <i class="fas fa-user-plus"></i>
                Modifier
            </button>
        </form>