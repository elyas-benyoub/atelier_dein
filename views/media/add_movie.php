<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Ajoutez un film</p>
        </div>
        
        <form method="POST" class="auth-form" action="<?php echo url('media/store_movie'); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
            
            <div class="form-group">
                <label for="text">Titre</label>
                <input type="text" id="title" name="title" required 
                       value="<?php echo escape(post('title', '')); ?>"
                       placeholder="titre">
            </div>
            
            <div class="form-group">
                <label for="director">Réalisateur</label>
                <input type="text" id="director" name="director" required
                       placeholder="réalisateur">
            </div>

            <div class="form-group">
                <label for="duration">Durée</label>
                <input type="text" id="duration" name="duration" required
                       placeholder="durée">
            </div>

            <div class="form-group">
                <label for="synopsis">Sysnopsis</label>
                <textarea type="text" id="synopsis" name="synopsis" required
                       placeholder="durée"></textarea>
            </div>

            <div class="form-group">
                <label for="year">Année</label>
                <input type="number" id="year" name="year" required
                       placeholder="Année">
            </div>
            
            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-sign-in-alt"></i>
                Ajouter
            </button>
        </form>
    </div>
</div> 