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
    <table class="table table-striped table-bordered">
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
                        <td>
                            <?php if (!empty($media['image_path'])): ?>
                                <img src="<?= BASE_URL . $media['image_path']; ?>" alt="<?= e($media['title']); ?>"
                                    style="width:60px; height:auto; border-radius:4px;">
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?= e($media['title']); ?></td>
                        <td><?= e($media['type']); ?></td>
                        <td>
                            <?php
                            if (!empty($media_to_genres[$media['id']])) {
                                echo implode(', ', $media_to_genres[$media['id']]);
                            } else {
                                echo '—';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?= url('admin/handle_edit_media?id=' . $media['id']); ?>"
                                class="btn btn-sm btn-danger">Edit</a>
                        </td>
                        <td>
                            <a href="<?= url('admin/handle_delete_media?id=' . $media['id']); ?>"
                                class="btn btn-sm btn-danger">Supprimer</a>
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