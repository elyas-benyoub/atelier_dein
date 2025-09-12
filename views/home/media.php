

<?php /** @var array $media */ ?>
<div class="media-detail-container">
  <div class="media-card-detail">
    
    <!-- Affichage de l'image -->
    <div class="media-poster">
      <img src="<?= PUBLIC_URL . $media['image_path']; ?>" alt="<?= e($media['title']); ?>">
    </div>

    <!-- Affichage des infos -->
    <div class="media-info">
      <h1 class="media-title"><?= e($media['title']); ?> (<?= e($media['year']); ?>)</h1>

      <p><strong>Durée :</strong> <?= e($movie['duration_minutes']); ?> min</p>
      <p><strong>Classification :</strong> <?= e($movie['classification']); ?></p>
      <p><strong>Réalisateur / Auteur :</strong> <?= e($movie['director']); ?></p>

      <h2>Synopsis</h2>
      <p><?= e($movie['synopsis']); ?></p>
    </div>
  </div>
</div>
