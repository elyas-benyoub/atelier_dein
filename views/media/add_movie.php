<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Ajoutez un film</p>
        </div>

        <form method="POST" class="auth-form" action="<?php echo url('media/store_movie'); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" required >
            </div>

            <div class="form-group">
                <label for="director">Réalisateur</label>
                <input type="text" id="director" name="director" required>
            </div>

            <div class="form-group">
                <label for="duration">Durée</label>
                <input type="number" id="duration" name="duration" required placeholder="durée">
            </div>

            <div class="form-group">
                <label for="synopsis">Sysnopsis</label>
                <textarea type="text" id="synopsis" name="synopsis" required></textarea>
            </div>

            <div class="form-group">
                <label for="year">Année</label>
                <input type="number" id="year" name="year" required placeholder="Année">
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