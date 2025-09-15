<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?= e($title) ?></h1>
            <p>Ajouter un jeu</p>
        </div>

        <form enctype="multipart/form-data" action="<?php echo url('game/store'); ?>" method="post" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" value="<?= !empty($form['title']) ? e($form['title']) : "" ?>" required>
                <?php if (!empty($errors['title'])): ?>
                    <p class="error"><?= e($errors['title']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="publisher">Editeur:</label>
                <input type="text" name="publisher"
                    value="<?= !empty($form['publisher']) ? e($form['publisher']) : "" ?>" required>
                <?php if (!empty($errors['publisher'])): ?>
                    <p class="error"><?= e($errors['publisher']) ?></p>
                <?php endif; ?>
            </div>

            <fieldset class="form-group">   
                <legend>Plateforme(s) :</legend>
                <div class="checkbox-list">
                    <?php foreach ($platforms as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="platforms[]" value="<?= $id ?>" <?= (!empty($form['platforms']) && in_array((int) $id, (array) $form['platforms'], true)) ? 'checked' : '' ?>>
                            <span><?= e($name) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($errors['platforms'])): ?>
                    <p class="error"><?= e($errors['platforms']) ?></p>
                <?php endif; ?>
            </fieldset>


            <div class="form-group">
                <label for="description">Résumé:</label>
                <textarea id="description" name="description" required><?= e($form['description'] ?? '') ?></textarea>
                <?php if (!empty($errors['description'])): ?>
                    <p class="error"><?= e($errors['description']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="min_age">Âge minimum (PEGI)</label>
                <?php $minAge = (string) ($form['min_age'] ?? ''); ?>
                <select id="min_age" name="min_age" aria-describedby="min_age-error" required>
                    <option value="">-- Sélectionnez un âge --</option>
                    <option value="3" <?= $minAge === '3' ? 'selected' : '' ?>>PEGI 3</option>
                    <option value="7" <?= $minAge === '7' ? 'selected' : '' ?>>PEGI 7</option>
                    <option value="12" <?= $minAge === '12' ? 'selected' : '' ?>>PEGI 12</option>
                    <option value="16" <?= $minAge === '16' ? 'selected' : '' ?>>PEGI 16</option>
                    <option value="18" <?= $minAge === '18' ? 'selected' : '' ?>>PEGI 18</option>
                </select>
                <?php if (!empty($errors['min_age'])): ?>
                    <p class="error" id="min_age-error"><?= e($errors['min_age']) ?></p>
                <?php endif; ?>
            </div>

            <fieldset class="form-group" aria-describedby="genres-error">
                <legend>Genre(s) :</legend>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="genres[]" value="<?= $id ?>" <?= (!empty($form['genres']) && in_array((int) $id, (array) $form['genres'], true)) ? 'checked' : '' ?>>
                            <span><?= e($name) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($errors['genres'])): ?>
                    <p class="error" id="genres-error"><?= e($errors['genres']) ?></p>
                <?php endif; ?>
            </fieldset>

            <div class="form-group">
                <label for="img_cover">Ajouter l'image de couverture:</label>
                <input type="file" name="img_cover">
                <?php if (!empty($errors['img_cover'])): ?>
                    <p class="error"><?= e($errors['img_cover']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-plus"></i>
                Ajouter le jeu
            </button>
        </form>

        <div class="auth-footer">
            <p>Revenir à la page d'accueil ?
                <a href="<?php echo url(); ?>">Accueil</a>
            </p>
        </div>
    </div>
</div>
