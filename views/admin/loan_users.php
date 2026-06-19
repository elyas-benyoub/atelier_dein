<div class="page-header">
    <div class="container">
        <h1><?= e($title ?? 'Créer un emprunt'); ?></h1>
    </div>
</div>

<section class="current-loans">
    <div class="container">
        <table class="table-loans responsive-table">
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
                        <?php $display_status = $loan['display_status'] ?? $loan['status']; ?>
                        <tr>
                            <td data-label="Utilisateur"><?php e($loan['name']); ?></td>
                            <td data-label="Média"><?php e($loan['title']); ?></td>
                            <td data-label="Date d'emprunt"><?php e(format_date($loan['loan_date'])); ?></td>
                            <td data-label="Date limite"><?php e(format_date($loan['due_date'])); ?></td>
                            <td data-label="Statut"
                                class="<?php echo $display_status === 'borrowed' ? 'status-borrowed' :
                                    ($display_status === 'returned' ? 'status-returned' : 'status-overdue'); ?>">
                                <?php e(ucfirst(translate_status($display_status))); ?>
                            </td>
                            <td data-label="Action"><?php if ($loan['status'] === 'borrowed'): ?>
                                    <form method="post" action="<?= url('loan/return_loan'); ?>" class="inline-form">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                                        <input type="hidden" name="loan_id" value="<?= e($loan['id']); ?>">
                                        <input type="hidden" name="media_id" value="<?= e($loan['id_m']); ?>">
                                        <input type="hidden" name="page" value="loans">
                                        <button type="submit" class="btn btn-return"><i class="fa-solid fa-right-from-bracket"></i>Retourner</button>
                                    </form>
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
