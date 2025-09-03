<!-- FORMULAIRE JEU ET RAJOUTER JEU DS LA DB -->

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>GAMES WAOUH</h1>
            <p>Ajouter un nouveau jeu</p>
        </div>

        <form method="POST" class="auth-form" action="<?php echo url('media/store_game'); ?>">
            <!-- Protection CSRF -->
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="titre">Titre du jeu</label>
                <input type="text" id="titre" name="titre" required 
                       placeholder="Entrez le titre du jeu"
                       value="<?php echo escape(post('title', '')); ?>">
            </div>


            <div class="form-group">
                <label for="titre">Editeur</label>
                <input type="text" id="editeur" name="editeur" required 
                       placeholder="Entrez le titre du jeu"
                       value="<?php echo escape(post('publisher', '')); ?>">
            </div>
            

            <<div class="form-group">
                <label for="genre">Genre:</label>
                <select name="genre_id" id="genre" multiple>
                    <?php foreach ($genres as $id => $name): ?>
                        <option value="<?= htmlspecialchars($id) ?>">
                            <?= htmlspecialchars($name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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
                <label for="age_minimum">Âge minimum</label>
                <select id="age_minimum" name="age_minimum" required>
                    <option value="3">3</option>
                    <option value="7">7</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required
                       placeholder="Description"
                       value="<?php echo escape(post('description', '')); ?>">
            </div>


            <div class="form-group">
                <label for="titre">Année  : </label>
                <input type="text" id="year" name="year" required 
                       placeholder="Entrez l'année du jeu"
                       value="<?php echo escape(post('Year', '')); ?>">
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









