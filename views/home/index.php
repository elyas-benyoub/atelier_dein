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

<div class="search-bar">
    <form method="get" action="<?= url('home/index'); ?>">
        <!-- Type media -->
        <select name="type">
            <option value="">-- Type --</option>
            <option value="book" <?= ($_GET['type'] ?? '') === 'book' ? 'selected' : '' ?>>Livre</option>
            <option value="movie" <?= ($_GET['type'] ?? '') === 'movie' ? 'selected' : '' ?>> Film</option>
            <option value="game" <?= ($_GET['type'] ?? '') === 'game' ? 'selected' : '' ?>>Jeu</option>
        </select>

        <!-- Genre -->
        <select name="genre">
            <option value="">-- Genre --</option>
            <?php foreach ($genres as $id => $name): ?>
                <option value="<?= $id ?>" <?= ($_GET['genre'] ?? '') == $id ? 'selected' : '' ?>>
                    <?= e($name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Disponibilité -->
        <select name="availability">
            <option value="">-- Disponibilité --</option>
            <!-- !isset($_GET['availability']) → vérifie si aucune valeur n’est passée dans l’URL.
              ($_GET['availability'] ?? '') === 'available' → sinon, sélectionne “Disponible” si c’est bien la valeur demandée. DISPONIBLE PAR DEFAUT -->
            <option value="available" <?= (!isset($_GET['availability']) || ($_GET['availability'] ?? '') === 'available') ? 'selected' : '' ?>>Disponible</option>
            <option value="borrowed" <?= ($_GET['availability'] ?? '') === 'borrowed' ? 'selected' : '' ?>>Emprunté
            </option>
        </select>

        <!-- Bouton -->
        <button class="search-button">
           Valider
        </button>
    </form>
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