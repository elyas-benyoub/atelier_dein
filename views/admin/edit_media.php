<!-- <div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Modifier le Media</p>
        </div>

        <form method="POST" action="<?php echo url('admin/handle_edit_media?id=' . $media['id']); ?>" class="auth-form" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

   
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" value="<?= e($media['title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" required>
                    <option value="">-- Type --</option>
                    <option value="book" <?= ($media['type'] ?? '') === 'book' ? 'selected' : '' ?>>Livre</option>
                    <option value="movie" <?= ($media['type'] ?? '') === 'movie' ? 'selected' : '' ?>>Film</option>
                    <option value="game" <?= ($media['type'] ?? '') === 'game' ? 'selected' : '' ?>>Jeu</option>
                </select>
            </div>

            <fieldset class="form-group">
                <legend>Genre(s) :</legend>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="genres[]" value="<?= $id ?>"
                                <?= in_array($id, $media['genres'] ?? []) ? 'checked' : '' ?>>
                            <span><?= e($name) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <div class="form-group">
                <label for="img_cover">Changer l'image de couverture:</label>
                <input type="file" name="img_cover">
                <?php if (!empty($media['image_path'])): ?>
                    <br>
            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <img src="<?= BASE_URL . $media['image_path']; ?>" width="100" alt="Image du média">
            </div>
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


            <div class="form-group">
                <label for="duration">Nombre de duration:</label>
                <input type="number" name="duration"
                    value="<?= !empty($form['duration']) ? e($form['duration']) : "" ?>" required>
                <?php if (!empty($errors['duration'])): ?>
                    <p class="error"><?= e($errors['duration']) ?></p>
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



            <button type="submit" name="action" value="edit" class="btn btn-primary btn-full">
                <i class="fas fa-user-plus"></i>
                Modifier
            </button>
        </form>
    </div>
</div> -->




<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?= e($title); ?></h1>
            <p>Modifier le Média</p>
        </div>

        <form method="POST" action="<?= url('admin/handle_edit_media?id=' . ($media['id'] ?? '')); ?>" class="auth-form" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" value="<?= e($media['title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" required>
                    <option value="">-- Type --</option>
                    <option value="book" <?= ($media['type'] ?? '') === 'book' ? 'selected' : '' ?>>Livre</option>
                    <option value="movie" <?= ($media['type'] ?? '') === 'movie' ? 'selected' : '' ?>>Film</option>
                    <option value="game" <?= ($media['type'] ?? '') === 'game' ? 'selected' : '' ?>>Jeu</option>
                </select>
            </div>

            <!-- Champs spécifiques selon le type -->
            <?php if (($media['type'] ?? '') === 'book'): ?>
                <div class="form-group">
                    <label for="author">Auteur</label>
                    <input type="text" name="author" value="<?= e($media['author'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" value="<?= e($isbn['isbn'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="pages">Nombre de pages</label>
                    <input type="number" name="pages" value="<?= e($media['pages'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="resume">Résumé</label>
                    <textarea name="resume" required><?= e($media['resume'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="pb_year">Année de publication</label>
                    <input type="number" name="pb_year" min="1900" max="9999" value="<?= e($media['pb_year'] ?? '') ?>" required>
                </div>

            <?php elseif (($media['type'] ?? '') === 'movie'): ?>
                <div class="form-group">
                    <label for="director">Réalisateur</label>
                    <input type="text" name="director" value="<?= e($media['director'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="duration">Durée (minutes)</label>
                    <input type="number" name="duration" value="<?= e($media['duration'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="classification">Classification</label>
                    <select name="classification" required>
                        <?php foreach (['Tous publics','-10','-12','-16','-18'] as $c): ?>
                            <option value="<?= $c ?>" <?= ($media['classification'] ?? '') === $c ? 'selected' : '' ?>><?= $c ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            <?php elseif (($media['type'] ?? '') === 'game'): ?>
                <div class="form-group">
                    <label for="publisher">Éditeur</label>
                    <input type="text" name="publisher" value="<?= e($media['publisher'] ?? '') ?>" required>
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
                    <label for="min_age">Âge minimum (PEGI)</label>
                    <select name="min_age" required>
                        <?php foreach ([3,7,12,16,18] as $age): ?>
                            <option value="<?= $age ?>" <?= ($media['min_age'] ?? '') == $age ? 'selected' : '' ?>>PEGI <?= $age ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <fieldset class="form-group">
                <legend>Genre(s)</legend>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label>
                            <input type="checkbox" name="genres[]" value="<?= $id ?>" <?= in_array($id, $media['genres'] ?? []) ? 'checked' : '' ?>>
                            <?= e($name) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <div class="form-group">
                <label for="img_cover">Changer l'image de couverture</label>
                <input type="file" name="img_cover">
                <?php if (!empty($media['image_path'])): ?>
                    <div style="margin-top:10px;">
                        <img src="<?= BASE_URL . $media['image_path'] ?>" width="100" alt="Image du média">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary btn-full">Modifier</button>
        </form>
    </div>
</div>

<!-- editeur , auteur , isbn , nb de pages, resumé, année de publication , genres, réalisateur, durée minutes, plateforme  -->


