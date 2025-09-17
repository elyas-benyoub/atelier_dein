<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="loan-getting-started">
    <!-- Formulaire création d'emprunt -->
    <div class="loan-container">
        <div class="auth-card">
            <form method="POST" class="auth-form">
                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

                <div class="form-group">
                    <label for="user_id">Utilisateur</label>
                    <select name="user_id" id="user_id" required>
                        <option value="">Sélectionner un utilisateur</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php e($user['id']); ?>">
                                <?php e($user['name']); ?> (<?php e($user['email']); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="media_id">Média</label>
                    <select name="media_id" id="media_id" required>
                        <option value="">Sélectionner un média à emprunter disponible</option>
                        <?php foreach ($medias as $media): ?>
                            <option value="<?php e($media['id']); ?>">
                                <?php e($media['title']); ?> (<?php e($media['type']); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-book"></i> Créer l'emprunt
                </button>
            </form>
        </div>
    </div>
</section>




<!-- Tableau des emprunts en cours en tableau css j'arrive pas -->
<section class="current-loans">
    <div class="container">
        <h2>Emprunts en cours des utilisateurs</h2>
        <table class="table-loans">
            <thead>
                <tr>
                    <!-- En-têtes du tableau -->
                    <th>Utilisateur</th>
                    <th>Média</th>
                    <th>Date d'emprunt</th>
                    <th>Date limite</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <!-- Vérifie s'il y a des emprunts à afficher -->
                <?php if (!empty($loans)): ?>
                    <!-- Parcourt chaque emprunt contenu dans $loans -->
                    <?php foreach ($loans as $loan): ?>
                        <tr>
                            <!-- Nom de l'utilisateur -->
                            <td><?php e($loan['name']); ?></td>
                            <!-- Titre du média (film, livre, jeu) -->
                            <td><?php e($loan['title']); ?></td>
                            <!-- Date de début d'emprunt (formatée en jour/mois/année heure:minute) -->
                            <td><?php e(format_date($loan['loan_date'])); ?></td>
                            <!-- Date limite de retour -->
                            <td><?php e(format_date($loan['due_date'])); ?></td>
                            <!-- Statut de l'emprunt avec une classe CSS différente selon le cas -->
                            <td class="<?php
                            echo $loan['status'] === 'borrowed' ? 'status-borrowed' :
                                ($loan['status'] === 'returned' ? 'status-returned' : 'status-overdue');
                            ?>">
                                <!-- ucfirst met la première lettre en majuscule (ex : borrowed -> Borrowed) -->
                                <?php e(ucfirst(translate_status($loan['status']))); ?>
                                <a href="<?= url('admin/handle_return_loan?id=' . $loan['id'] )?>"><i class="fa-solid fa-right-from-bracket"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- Si aucun emprunt n'existe, on affiche un message -->
                <?php else: ?>
                    <tr>
                        <!-- colspan="5" veut dire que la cellule prend toute la largeur du tableau -->
                        <td colspan="5">Aucun emprunt en cours.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>