<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Créez votre compte</p>
        </div>
        
        <form method="POST" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
            
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" required 
                       value="<?php echo escape(post('name', '')); ?>"
                       placeholder="Votre nom complet" autocomplete="name">
            </div>
            
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required 
                       value="<?php echo escape(post('email', '')); ?>"
                       placeholder="votre@email.com" autocomplete="email">
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required
                       placeholder="Au moins 6 caractères" autocomplete="new-password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                       placeholder="Confirmez votre mot de passe" autocomplete="new-password">
            </div>
            
            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-user-plus" aria-hidden="true"></i>
                S'inscrire
            </button>
        </form>
        
        <div class="auth-footer">
            <p>Déjà un compte ? 
                <a href="<?php echo url('auth/login'); ?>">Se connecter</a>
            </p>
        </div>
    </div>
</div> 
