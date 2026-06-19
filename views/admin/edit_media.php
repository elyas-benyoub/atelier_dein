<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Modifier le Media</p>
        </div>

        <form method="POST" action="<?php echo url('admin/handle_edit_media?id=' . $media['id']); ?>" class="auth-form" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

   
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="<?= e($media['title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label>Type</label>
                <p><?= e($media['type'] ?? '—') ?></p>
            </div>

            <fieldset class="form-group">
                <legend>Genre(s) :</legend>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="genres[]" value="<?= $id ?>"
                                <?= in_array((int) $id, $selected_genre_ids ?? [], true) ? 'checked' : '' ?>>
                            <span><?= e($name) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <div class="form-group">
                <label for="img_cover">Changer l'image de couverture:</label>
                <input type="file" id="img_cover" name="img_cover">
                <br>
                <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <img src="<?= e(media_image_url($media['image_path'] ?? null)); ?>" width="100" alt="Image du média">
                </div>
            </div>

            <button type="submit" name="action" value="edit" class="btn btn-primary btn-full">
                <i class="fas fa-user-plus"></i>
                Modifier
            </button>
        </form>
    </div>
</div>
