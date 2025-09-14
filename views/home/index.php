<div class="hero">

  <div class="hero-content">
    <h1><?php e($title); ?></h1>
    <p class="hero-subtitle">Un starter kit PHP avec architecture MVC procédurale</p>
    <div class="search-bar">
      <form class="search-btn" method="get" action="<?php echo url('home/index'); ?>">
        <input type="text" name="search" placeholder="Recherche">
        <button class="search-button">
          <i class="fa fa-search"></i>
        </button>
      </form>
    </div>
    <?php if (!is_logged_in()): ?>
      <div class="hero-buttons">
        <a href="<?php echo url('auth/register'); ?>" class="btn btn-primary">Commencer</a>
        <a href="<?php echo url('auth/login'); ?>" class="btn btn-secondary">Se connecter</a>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if (!empty($results)): ?>

  <section class="features">
    <div class="container">
      <h2 class="main-title">📚 Résultats de recherche</h2>

      <!-- Films -->
      <div class="media-section">
        <h3 class="section-title margin-bottom-25 margin-top-50">🎥 Films</h3>
        <div class="feature-grid">
          <?php foreach ($results as $result): ?>
            <?php if ($result['type'] === 'movie'): ?>
              <div class="feature-card">
                <img src="<?= BASE_URL . $result['image_path'] ?>" alt="<?= e($result['title']); ?>">
                <h3><?php e($result['title']); ?></h3>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Livres -->
      <div class="media-section">
        <h3 class="section-title margin-bottom-25 margin-top-50">📖 Livres</h3>
        <div class="feature-grid">
          <?php foreach ($results as $result): ?>
            <?php if ($result['type'] === 'book'): ?>
              <div class="feature-card">
                <img src="<?= BASE_URL . $result['image_path'] ?>" alt="<?= e($result['title']); ?>">
                <h3><?php e($result['title']); ?></h3>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Jeux -->
      <div class="media-section">
        <h3 class="section-title margin-bottom-25 margin-top-50">🎮 Jeux</h3>
        <div class="feature-grid">
          <?php foreach ($results as $result): ?>
            <?php if ($result['type'] === 'game'): ?>
              <div class="feature-card">
                <img src="<?= BASE_URL . $result['image_path'] ?>" alt="<?= e($result['title']); ?>">
                <h3><?php e($result['title']); ?></h3>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

<?php else: ?>


  <!-- section de medias (nesrine) -->
  <section class="features">
    <div class="container">
      <!-- Titre général -->
      <h2 class="main-title">📚 Découvrez notre médiathèque</h2>

      <!-- Grille des films -->
      <div class="media-section">
        <h3 class="section-title margin-bottom-25 margin-top-50">🎮 Films</h3>
        <div class="feature-grid">
          <?php foreach ($movies as $movie): ?>
            <a href="<?= url("home/info?id=" . $movie['id']); ?>">
              <div class="feature-card">
                <img src="<?= BASE_URL . $movie['image_path'] ?>" alt="<?= e($movie['title']); ?>">
                <h3><?php e($movie['title']); ?></h3>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Grille des livres -->
      <div class="media-section">
        <h3 class="section-title margin-bottom-25 margin-top-50">🎮 Livres</h3>
        <div class="feature-grid">
          <?php foreach ($books as $book): ?>
            <div class="feature-card">
              <img src="<?= BASE_URL . $book['image_path'] ?>" alt="<?= e($book['title']); ?>">
              <h3><?php e($book['title']); ?></h3>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Grille des jeux -->
      <div class="media-section">
        <h3 class="section-title margin-bottom-25 margin-top-50">🎮 Jeux</h3>
        <div class="feature-grid">
          <?php foreach ($games as $game): ?>
            <div class="feature-card">
              <img src="<?= BASE_URL . $game['image_path'] ?>" alt="<?= e($game['title']); ?>">
              <h3><?php e($game['title']); ?></h3>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </section>

<?php endif; ?>

<!-- ************************************************************************ -->

<section class="getting-started">
  <div class="container">
    <h2>Commencer rapidement</h2>
    <div class="steps">
      <div class="step">
        <div class="step-number">1</div>
        <h3>Configuration</h3>
        <p>Configurez votre base de données dans <code>config/database.php</code></p>
      </div>
      <div class="step">
        <div class="step-number">2</div>
        <h3>Développement</h3>
        <p>Créez vos contrôleurs, modèles et vues dans leurs dossiers respectifs</p>
      </div>
      <div class="step">
        <div class="step-number">3</div>
        <h3>Déploiement</h3>
        <p>Uploadez votre application sur votre serveur web</p>
      </div>
    </div>
  </div>
</section>