<?php var_dump($form, $errors);  ?>
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Ajoutez un film</p>
        </div>

        <form enctype="multipart/form-data" method="POST" class="auth-form"
            action="<?php echo url('movie/store'); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" value="<?= !empty($form['title']) ? e($form['title']) : "" ?>" required>
                <?php if (!empty($errors['title'])): ?>
                    <p class="error"><?= e($errors['title']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="director">Auteur:</label>
                <input type="text" name="director" value="<?= !empty($form['director']) ? e($form['director']) : "" ?>"
                    required>
                <?php if (!empty($errors['director'])): ?>
                    <p class="error"><?= e($errors['director']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="duration">Nombre de duration:</label>
                <input type="number" name="duration"
                    value="<?= !empty($form['duration']) ? e($form['duration']) : "" ?>" required>
                <?php if (!empty($errors['duration'])): ?>
                    <p class="error"><?= e($errors['duration']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="synopsis">Résumé:</label>
                <textarea id="synopsis" name="synopsis" required><?= e($form['synopsis'] ?? '') ?></textarea>
                <?php if (!empty($errors['synopsis'])): ?>
                    <p class="error"><?= e($errors['synopsis']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="year">Année de publication:</label>
                <input type="number" name="year" min="1900" max="9999"
                    value="<?= !empty($form['year']) ? e($form['year']) : "" ?>" required>
                <?php if (!empty($errors['year'])): ?>
                    <p class="error"><?= e($errors['year']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="classification">Classification (âge)</label>
                <select id="classification" name="classification" required>
                    <option value="" <?= ($form['classification'] ?? '') === '' ? 'selected' : '' ?> disabled>
                        -- Sélectionne une classification --
                    </option>
                    <option value="Tous publics" <?= ($form['classification'] ?? '') === 'Tous publics' ? 'selected' : '' ?>>Tous publics</option>
                    <option value="-10" <?= ($form['classification'] ?? '') === '-10' ? 'selected' : '' ?>>-10 ans</option>
                    <option value="-12" <?= ($form['classification'] ?? '') === '-12' ? 'selected' : '' ?>>-12 ans</option>
                    <option value="-16" <?= ($form['classification'] ?? '') === '-16' ? 'selected' : '' ?>>-16 ans</option>
                    <option value="-18" <?= ($form['classification'] ?? '') === '-18' ? 'selected' : '' ?>>-18 ans</option>
                </select>

                <?php if (!empty($errors['classification'])): ?>
                    <p class="error" role="alert"><?= e($errors['classification']) ?></p>
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
                            <input type="checkbox" name="genres[]" value="<?= $id ?>" <?= (!empty($form['genres']) && in_array((int) $id, $form['genres'])) ? 'checked' : '' ?>>
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