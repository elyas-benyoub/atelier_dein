<div class="media-detail-container">

    <div class="media-card-detail">

        <div class="media-poster">
            <img
                src="<?= $media['image_path'] ? (str_starts_with($media['image_path'], 'http') ? $media['image_path'] : BASE_URL . $media['image_path']) : '/assets/images/default-media.svg' ?>"
                alt="<?= e($media['title']); ?>"
                onerror="this.onerror=null; this.src='/assets/images/default-media.svg';"
            >
        </div>

        <div class="media-info">
            <h1 class="media-title"><?= e($media['title']); ?> <span>(<?= e($media['year']); ?>)</span></h1>

            <div class="sub-title">
                <?php if (!empty($data['classification'])): ?>
                    <p class="classification">Classification : <?= e($data['classification']); ?></p>
                <?php elseif (isset($data['min_age'])): ?>
                    <p class="classification">PEGI : <?= e($data['min_age']); ?></p>
                <?php endif; ?>
                <div class="genre-badges">
                    <?php foreach ($genres as $genre): ?>
                        <span class="badge badge-genre"><?= e($genre); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if (isset($data['duration_minutes'])): ?>
                <p><strong>Durée :</strong> <?= e($data['duration_minutes']); ?> min</p>
            <?php endif; ?>

            <h2>Synopsis</h2>
            <p><?= e($data['synopsis'] ?? $data['summary'] ?? $data['description']); ?></p>

            <?php if (is_logged_in()): ?>
                <?php if ($available): ?>
                    <form method="post" action="<?= url('loan/create'); ?>" class="inline-form">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                        <input type="hidden" name="media_id" value="<?= e($media['id']); ?>">
                        <button type="submit" class="btn btn-primary">Emprunter</button>
                    </form>
                <?php else: ?>
                    <?php if ($loan_user_id === $_SESSION['user_id']): ?>
                        <form method="post" action="<?= url('loan/return_loan'); ?>" class="inline-form">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                            <input type="hidden" name="loan_id" value="<?= e($loan_id); ?>">
                            <input type="hidden" name="media_id" value="<?= e($media['id']); ?>">
                            <input type="hidden" name="page" value="info">
                            <button type="submit" class="btn btn-return">Retour</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <p><a href="<?= url('auth/login') ?>" class="btn btn-secondary">Connectez-vous pour emprunter</a></p>
            <?php endif; ?>

        </div>
    </div>
</div>
