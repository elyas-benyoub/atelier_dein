<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?= e($title) ?></h1>
            <p>Ajoute un livre</p>
        </div>

        <form enctype="multipart/form-data" action="<?php echo url('book/store'); ?>" method="post" class="auth-form">

            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" value="<?= !empty($form['title']) ? e($form['title']) : "" ?>" required>
                <?php if (!empty($errors['title'])): ?>
                    <p class="error"><?= e($errors['title']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="author">Auteur:</label>
                <input type="text" name="author" value="<?= !empty($form['author']) ? e($form['author']) : "" ?>"
                    required>
                <?php if (!empty($errors['author'])): ?>
                    <p class="error"><?= e($errors['author']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="number" name="isbn" value="<?= !empty($form['isbn']) ? e($form['isbn']) : "" ?>" required>
                <?php if (!empty($errors['isbn'])): ?>
                    <p class="error"><?= e($errors['isbn']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="pages">Nombre de pages:</label>
                <input type="number" name="pages" value="<?= !empty($form['pages']) ? e($form['pages']) : "" ?>"
                    required>
                <?php if (!empty($errors['pages'])): ?>
                    <p class="error"><?= e($errors['pages']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="resume">Résumé:</label>
                <textarea id="resume" name="resume" required><?= e($form['resume'] ?? '') ?></textarea>
                <?php if (!empty($errors['resume'])): ?>
                    <p class="error"><?= e($errors['resume']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="pb_year">Année de publication:</label>
                <input
                    type="number" name="pb_year" min="1900" max="9999"
                    value="<?= !empty($form['pb_year']) ? e($form['pb_year']) : "" ?>"
                    required
                >
                <?php if (!empty($errors['pb_year'])): ?>
                    <p class="error"><?= e($errors['pb_year']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="img_cover">Ajouter l'image de couverture:</label>
                <input type="file" name="img_cover">
                <?php if (!empty($errors['img_cover'])): ?>
                    <p class="error"><?= e($errors['img_cover']) ?></p>
                <?php endif; ?>
            </div>

            <div role="group" aria-labelledby="legend-genres">
                <p id="legend-genres">Genre(s) :</p>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="genres[]" value="<?= $id ?>"
                                <?= (!empty($form['genres']) && in_array((int)$id, $form['genres'])) ? 'checked' : '' ?>>
                            <p><?= e($name) ?></p>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($errors['genres'])): ?>
                    <p class="error"><?= e($errors['genres']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-sign-in-alt"></i>
                Ajouter
            </button>
        </form>

        <div class="auth-footer">
            <p>Revenir à la page d'accueil ?
                <a href="<?php echo url(); ?>">Accueil</a>
            </p>
        </div>
    </div>
</div>