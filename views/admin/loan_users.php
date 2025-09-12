<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="getting-started">
    <form method="POST" class="auth-form">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

        <div class="form-group">
            <label for="user_id">Utilisateur</label>
            <select name="user_id" id="user_id" required>
                <option value="">Sélectionner un utilisateur</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php e($user['id']); ?>">
                        <?php e($user['name']); ?> (<?php e($user['email']); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="media_id">Média</label>
            <select name="media_id" id="media_id" required>
                <option value="">Sélectionner un média à emprunter disponible</option>
                <?php foreach ($medias as $media): ?>
                    <option value="<?php e($media['id']); ?>">
                        <?php e($media['title']); ?> (<?php e($media['type']); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-book"></i> Créer l'emprunt
        </button>
    </form>
</section>


