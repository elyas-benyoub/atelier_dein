


<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="getting-started">
    <!-- Formulaire création d'emprunt -->
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
</section>




<!-- Tableau des emprunts en cours en tableau css j'arrive pas -->
<section class="current-loans">
    <div class="container">
        <h2>Emprunts en cours des users</h2>
        <table class="table-loans">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Média</th>
                    <th>Date d'emprunt</th>
                    <th>Date limite</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($loans)): ?>
                    <?php foreach ($loans as $loan): ?>
                        <tr>
                            <td><?php e($loan['name']); ?></td>
                            <td><?php e($loan['title']); ?></td>
                            <td><?php e(date('d/m/Y H:i', strtotime($loan['loan_date']))); ?></td>
                            <td><?php e(date('d/m/Y H:i', strtotime($loan['due_date']))); ?></td>
                            <td class="<?php 
                                echo $loan['status'] === 'borrowed' ? 'status-borrowed' : 
                                     ($loan['status'] === 'returned' ? 'status-returned' : 'status-overdue');
                            ?>">
                                <?php e(ucfirst($loan['status'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucun emprunt en cours.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>













