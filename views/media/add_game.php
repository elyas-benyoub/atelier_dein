

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?= e($title) ?></h1>
            <p>Ajouter un nouveau jeu</p>
        </div>

        <form method="POST" class="auth-form" action="<?php echo url('media/store_game'); ?>">
            <!-- Protection CSRF -->
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="titre">Titre du jeu</label>
                <input type="text" id="titre" name="titre" required 
                       placeholder="Entrez le titre du jeu"
                       value="<?php echo escape(post('titre', '')); ?>">
            </div>

            <div class="form-group">
                <label for="editeur">Éditeur</label>
                <input type="text" id="editeur" name="editeur" required
                       placeholder="Nom de l'éditeur"
                       value="<?php echo escape(post('editeur', '')); ?>">
            </div>

            <div class="form-group">
                <label for="plateforme">Plateforme</label>
                <select id="plateforme" name="plateforme" required>
                    <option value="PC">PC</option>
                    <option value="PlayStation">PlayStation</option>
                    <option value="Xbox">Xbox</option>
                    <option value="Nintendo 64">Nintendo</option>
                    <option value="Mobile">Mobile</option>
                </select>
            </div>

            <div class="form-group">
                <label for="genre">Genre:</label>
                <select name="genre[]" id="genre" multiple>
                    <?php foreach($genres as $id => $name): ?>
                        <option value="<?= htmlspecialchars($id) ?>">
                            <?= htmlspecialchars($name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required
                       placeholder="Description"
                       value="<?php echo escape(post('description', '')); ?>">
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








<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Jeu ajouté avec succès</h1>
            <p>les infos que vous avez enregistrées :</p>
        </div>

        <div class="game-details">
            <p><strong>Titre :</strong> <?php e($titre); ?></p>
            <p><strong>Éditeur :</strong> <?php e($editeur); ?></p>
            <p><strong>Plateforme :</strong> <?php e($plateforme); ?></p>
            <p><strong>Âge minimum :</strong> <?php e($age_minimum); ?> ans</p>
            <p><strong>Description :</strong> <?php e($description); ?></p>
        </div>

        <div class="auth-footer">
            <a href="<?php echo url('media/add_game'); ?>"> Ajouter un autre jeu</a>
        </div>
    </div>
</div>




