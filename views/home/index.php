<div class="hero">

    <div class="hero-content">
        <h1><?php e($title); ?></h1>
        <p class="hero-subtitle">Un lieu magique pour les médias!</p>

        <form class="search-bar" method="get" action="<?php echo url('home/index'); ?>">
            <input type="text" name="search" placeholder="Recherche">
            <button type="submit" class="search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

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
            <h2 class="main-title">📚 Résultats de recherche (<?= count($results) ?>)</h2>
            <div class="feature-grid">
                <?php foreach ($results as $result): ?>
                    <div class="feature-card">
                        <a href="<?= url("home/info?id=" . $result['id']); ?>" class="card-link">
                            <img src="<?= BASE_URL . $result['image_path'] ?>" alt="<?= e($result['title']); ?>">
                            <h3><?php e($result['title']); ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>

            <!-- section de medias (nesrine) -->
            <section class="features">
                <div class="container">
                    <!-- Titre général -->
                    <h2 class="main-title">📚 Découvrez notre médiathèque</h2>

                    <!-- Grille des films -->
                    <div class="media-section">
                        <h3 class="section-title margin-bottom-25 margin-top-50">🎥 Films</h3>
                        <div class="feature-grid">
                            <?php foreach ($movies as $movie): ?>
                                <div class="feature-card">
                                    <a href="<?= url("home/info?id=" . $movie['id']); ?>" class="card-link">
                                        <img src="<?= BASE_URL . $movie['image_path'] ?>" alt="<?= e($movie['title']); ?>">
                                        <h3><?php e($movie['title']); ?></h3>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Grille des livres -->
                    <div class="media-section">
                        <h3 class="section-title margin-bottom-25 margin-top-50">📖 Livres</h3>
                        <div class="feature-grid">
                            <?php foreach ($books as $book): ?>
                                <div class="feature-card">
                                    <a href="<?= url("home/info?id=" . $book['id']); ?>" class="card-link">
                                        <img src="<?= BASE_URL . $book['image_path'] ?>" alt="<?= e($book['title']); ?>">
                                        <h3><?php e($book['title']); ?></h3>
                                    </a>
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
                                    <a href="<?= url("home/info?id=" . $game['id']); ?>" class="card-link">
                                        <img src="<?= BASE_URL . $game['image_path'] ?>" alt="<?= e($game['title']); ?>">
                                        <h3><?php e($game['title']); ?></h3>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </section>

        <?php endif; ?>