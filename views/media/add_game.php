<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?= e($title) ?></h1>
            <p>Ajouter un nouveau jeu</p>
        </div>

        <form method="POST" class="auth-form" action="<?php echo url('media/store_game'); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre du jeu</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="publisher">Éditeur</label>
                <input type="text" id="publisher" name="publisher" required>
            </div>

            <div role="group" aria-labelledby="legend-plateformes">
                <p id="legend-plateformes">Plateforme(s) :</p>
                <div class="checkbox-list">
                    <?php
                    $plateformes = ["PC", "PlayStation", "Xbox", "Nintendo 64", "Mobile"];
                    foreach ($plateformes as $plateforme): ?>
                        <label class="chk">
                            <input type="checkbox" name="plateformes[]" value="PC">
                            <p><?= e($plateforme) ?></p>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" id="description" name="description" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="min_age">Âge minimum (PEGI)</label>
                <select id="min_age" name="min_age" required>
                    <option value="">-- Sélectionne un âge --</option>
                    <option value="3">PEGI 3</option>
                    <option value="7">PEGI 7</option>
                    <option value="12">PEGI 12</option>
                    <option value="16">PEGI 16</option>
                    <option value="18">PEGI 18</option>
                </select>
            </div>

            <div role="group" aria-labelledby="legend-genres">
                <p id="legend-genres">Genre(s) :</p>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="genres[]" value="<?= e($id) ?>">
                            <p><?= e($name) ?></p>
                        </label>
                    <?php endforeach; ?>
                </div>
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