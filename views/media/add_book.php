<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?= e($title) ?></h1>
            <p>Ajoute un livre</p>
        </div>

        <form method="post" class="auth-form" action="<?php echo url('media/store_book'); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label for="author">Auteur:</label>
                <input type="text" name="author" required>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="number" name="isbn" required>
            </div>

            <div class="form-group">
                <label for="pages">Nombre de pages:</label>
                <input type="number" name="pages" required>
            </div>

            <div class="form-group">
                <label for="resume">Résumé:</label>
                <textarea id="resume" name="resume" required></textarea>
            </div>

            <div class="form-group">
                <label for="pb_year">Année de publication:</label>
                <input type="number" name="pb_year" min="1900" max="9999">
            </div>


            <div role="group" aria-labelledby="legend-genres">
                <p id="legend-genres">Genre(s) :</p>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="genres[]" value="<?= $id ?>">
                            <p><?= e($name) ?></p>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-sign-in-alt"></i>
                Ajouter
            </button>
        </form>

    </div>
</div>