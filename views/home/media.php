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
  <form method="POST" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
    <input type="hidden" name="media_id" value="<?= e($media['id']); ?>">
    <!-- pas nécessaire d'envoyer user_id si tu utilises la session côté serveur -->
    <button type="submit" class="btn btn-primary">
      <i class="fas fa-book"></i> Emprunter
    </button>
  </form>
<?php else: ?>
  <p><a href="<?= BASE_URL ?>/login" class="btn btn-secondary">Connectez-vous pour emprunter</a></p>
<?php endif; ?>

    </div>
  </div>
</div>






