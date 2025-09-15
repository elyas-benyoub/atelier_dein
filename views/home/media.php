<div class="media-detail-container">
  <div class="media-card-detail">
    
    <!-- Affichage de l'image -->
    <div class="media-poster">
      <img src="<?= PUBLIC_URL . $media['image_path']; ?>" alt="<?= e($media['title']); ?>">
    </div>

    <!-- Affichage des infos -->
    <div class="media-info">
      <h1 class="media-title"><?= e($media['title']); ?> (<?= e($media['year']); ?>)</h1>

      <p><strong>Durée :</strong> <?= e($data['duration_minutes'] ?? 'N/A'); ?> min</p>
      <p><strong>Classification :</strong> <?= e($data['classification'] ?? $data['min_age'] ?? 'N/A'); ?></p>
      <p><strong>Réalisateur / Auteur :</strong> <?= e($data['director'] ?? $data['publisher'] ?? $data['author']); ?></p>

      <h2>Synopsis</h2>
      <p><?= e($data['synopsis'] ?? $data['summary'] ?? $data['description']); ?></p>
    </div>
  </div>
</div>
