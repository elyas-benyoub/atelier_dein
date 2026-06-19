<div class="page-header">
    <div class="container">
        <h1>Médias</h1>
    </div>
    <ul class="add-media">
        <li><a href="<?php echo url('book/add'); ?>">Ajouter un livre</a></li>
        <li><a href="<?php echo url('movie/add'); ?>">Ajouter un film</a></li>
        <li><a href="<?php echo url('game/add'); ?>">Ajouter un jeu</a></li>
    </ul>
</div>

<section class="getting-started">
    <table class="table table-striped table-bordered responsive-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Type</th>
                <th>Genres</th>
                <th>Modifier</th>
                <th>Effacer</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($medias)): ?>
                <?php foreach ($medias as $media): ?>
                    <tr>
                        <td data-label="Image">
                            <img src="<?= e(media_image_url($media['image_path'] ?? null)); ?>" alt="<?= e($media['title']); ?>"
                                style="width:60px; height:auto; border-radius:4px;">
                        </td>
                        <td data-label="Titre"><?= e($media['title']); ?></td>
                        <td data-label="Type"><?= e($media['type'] === 'book' ? 'Livre' : ($media['type'] === 'movie' ? 'Film' : 'Jeu')); ?></td>
                        <td data-label="Genres">
                            <?php
                            if (!empty($media_to_genres[$media['id']])) {
                                echo implode(', ', $media_to_genres[$media['id']]);
                            } else {
                                echo '—';
                            }
                            ?>
                        </td>
                        <td data-label="Modifier">
                            <a href="<?= url('admin/handle_edit_media?id=' . $media['id']); ?>"
                                class="btn btn-sm btn-info">Modifier</a>
                        </td>
                        <td data-label="Effacer">
                            <form method="post" action="<?= url('admin/handle_delete_media'); ?>" class="inline-form">
                                <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                                <input type="hidden" name="id" value="<?= e($media['id']); ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun média trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>
