<div class="page-header">
    <div class="container">
        <h1><?= e($title ?? 'Créer un emprunt'); ?></h1>
    </div>
</div>

<section class="current-loans">
    <div class="container">
        <table class="table-loans">
            <thead>
                <tr>
                    <!-- En-têtes du tableau -->
                    <th>Utilisateur</th>
                    <th>Média</th>
                    <th>Date d'emprunt</th>
                    <th>Date limite</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Vérifie s'il y a des emprunts à afficher -->

                <?php if (!empty($loans)): ?>
                    <!-- Parcourt chaque emprunt contenu dans $loans -->
                    <?php foreach ($loans as $loan): ?>
                        <tr>
                            <td><?php e($loan['name']); ?></td>
                            <td><?php e($loan['title']); ?></td>
                            <td><?php e(format_date($loan['loan_date'])); ?></td>
                            <td><?php e(format_date($loan['due_date'])); ?></td>
                            <td
                                class="<?php echo $loan['status'] === 'borrowed' ? 'status-borrowed' :
                                    ($loan['status'] === 'returned' ? 'status-returned' : 'status-overdue'); ?>">
                                <?php e(ucfirst(translate_status($loan['status']))); ?>
                            </td>
                            <td><?php if ($loan['status'] === 'borrowed'): ?>
                                    <a
                                        href="<?= url('loan/return_loan?loan_id=' . $loan['id'] . "&media_id=" . $loan['id_m'] . "&page=loans") ?>">
                                        <i class="fa-solid fa-right-from-bracket"></i>Retourner</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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