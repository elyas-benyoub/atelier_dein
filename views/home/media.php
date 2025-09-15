<div class="media-detail-container">
    <div class="media-card-detail">

        <div class="media-poster">
            <img src="<?= BASE_URL . $media['image_path']; ?>" alt="<?= e($media['title']); ?>">
        </div>

        <div class="media-info">
            <h1 class="media-title"><?= e($media['title']); ?> <span>(<?= e($media['year']); ?>)</span></h1>

            <div class="sub-title">
                <p class="classification"><?= e($data['classification'] ?? $data['min_age'] ?? 'N/A'); ?></p>
                <p class="genres-"><?= e(implode(', ', $genres)); ?></p>
            </div>
            <p><strong>Durée :</strong> <?= e($data['duration_minutes'] ?? 'N/A'); ?> min</p>

            <h2>Synopsis</h2>
            <p><?= e($data['synopsis'] ?? $data['summary'] ?? $data['description']); ?></p>

            <!-- Bouton Emprunter : POST vers la même page -->
            <?php if (is_logged_in()): ?>
                <?php if (!is_media_borrowed($media['id'])): ?>
                    <a href="<?php e(url("loan/create?id=" . $media['id'])) ?>">Emprunter</a>
                <?php endif; ?>
            <?php else: ?>
                <p><a href="<?= BASE_URL ?>/login" class="btn btn-secondary">Connectez-vous pour emprunter</a></p>
            <?php endif; ?>

        </div>
    </div>
</div>