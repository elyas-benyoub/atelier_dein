<div class="media-detail-container">
  <div class="media-card-detail">

    <!-- Affichage de l'image -->
    <div class="media-poster">
      <img src="<?= PUBLIC_URL . $media['image_path']; ?>" alt="<?= e($media['title']); ?>">
    </div>

    <!-- Affichage des infos -->
    <div class="media-info">
      <h1 class="media-title">
        <?= e($media['title']); ?> 
        <?php if (!empty($media['year'])): ?>
          (<?= e($media['year']); ?>)
        <?php endif; ?>
      </h1>

      <!-- Durée (films), sinon N/A -->
      <p><strong>Durée :</strong> <?= e($data['duration_minutes'] ?? 'N/A'); ?> min</p>

      <!-- Classification : film = classification, livre/jeu = min_age -->
      <p><strong>Classification :</strong> 
        <?= e($data['classification'] ?? $data['min_age'] ?? 'N/A'); ?>
      </p>

      <!-- Réalisateur / Auteur / Éditeur -->
      <p><strong>Réalisateur / Auteur :</strong> 
        <?= e($data['director'] ?? $data['author'] ?? $data['publisher'] ?? 'N/A'); ?>
      </p>

      <!-- Genres -->
      <h2>Genres</h2>
      <ul>
        <?php if (!empty($genres)): ?>
          <?php foreach ($genres as $id => $name): ?>
            <li><?= e($name); ?></li>
          <?php endforeach; ?>
        <?php else: ?>
          <li>Aucun genre trouvé</li>
        <?php endif; ?>
      </ul>

      <!-- Synopsis / Résumé / Description -->
      <h2>Synopsis</h2>
      <p><?= e($data['synopsis'] ?? $data['summary'] ?? $data['description'] ?? 'Non disponible'); ?></p>
    </div>
  </div>
</div>