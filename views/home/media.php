<div class="media-detail-container">

    <div class="media-card-detail">

        <div class="media-poster">
            <img src="<?= BASE_URL . $media['image_path']; ?>" alt="<?= e($media['title']); ?>">
        </div>

        <div class="media-info">
            <h1 class="media-title"><?= e($media['title']); ?> <span>(<?= e($media['year']); ?>)</span></h1>

            <div class="sub-title">
                <?php if (isset($data['classification'], $data['min_age'])): ?>
                    <p class="classification"><?= e($data['classification'] ?? $data['min_age']); ?></p>
                <?php endif; ?>
                <p class="genres-"><?= e(implode(', ', $genres)); ?></p>
            </div>
            <?php if (isset($data['duration_minutes'])): ?>
                <p><strong>Durée :</strong> <?= e($data['duration_minutes']); ?> min</p>
            <?php endif; ?>

            <h2>Synopsis</h2>
            <p><?= e($data['synopsis'] ?? $data['summary'] ?? $data['description']); ?></p>

            <?php if (is_logged_in()): ?>
                <?php if ($available): ?>
                    <a href="<?php e(url("loan/create?id=" . $media['id'])) ?>" class="btn btn-primary">Emprunter</a>
                <?php else: ?>
                    <?php if ($loan_user_id === $_SESSION['user_id']): ?>
                        <a href="<?= url('loan/return_loan?loan_id=' . $loan_id . "&media_id=" . $media['id'] . "&page=info") ?>"
                            class="btn btn-return">Retour</a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <p><a href="<?= BASE_URL ?>/login" class="btn btn-secondary">Connectez-vous pour emprunter</a></p>
            <?php endif; ?>

        </div>
    </div>
</div>