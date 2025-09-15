<div class="media-detail-container">
  <div class="media-card-detail">
    
    <!-- Affichage de l'image -->
    <div class="media-poster">
      <img src="<?= BASE_URL . $media['image_path']; ?>" alt="<?= e($media['title']); ?>">
    </div>

    <!-- Affichage des infos -->
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
            <form method="POST" action="<?= url('loan/borrow_media/' . $media['id']); ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-book"></i> Emprunter
                </button>
            </form>
            <?php endif; ?>



    </div>
  </div>
</div>





