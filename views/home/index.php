<div class="hero">
    <div class="hero-content">
        <h1><?php e($title); ?></h1>
        <p class="hero-subtitle">Un lieu magique pour les médias!</p>

        <form class="search-bar" method="get" action="<?php echo url('home/index'); ?>">
            <label class="sr-only" for="hero-search">Rechercher un média</label>
            <input type="text" id="hero-search" name="search" placeholder="Rechercher un média">
            <button type="submit" class="search-button" aria-label="Lancer la recherche">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
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
        <select name="type" aria-label="Filtrer par type de média">
            <option value="">-- Type --</option>
            <option value="book" <?= ($_GET['type'] ?? '') === 'book' ? 'selected' : '' ?>>Livre</option>
            <option value="movie" <?= ($_GET['type'] ?? '') === 'movie' ? 'selected' : '' ?>>Film</option>
            <option value="game" <?= ($_GET['type'] ?? '') === 'game' ? 'selected' : '' ?>>Jeu</option>
        </select>

        <!-- Genre -->
        <select name="genre" aria-label="Filtrer par genre">
            <option value="">-- Genre --</option>
            <?php foreach ($genres as $id => $name): ?>
                <option value="<?= $id ?>" <?= ($_GET['genre'] ?? '') == $id ? 'selected' : '' ?>>
                    <?php e($name); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Disponibilité -->
        <select name="availability" aria-label="Filtrer par disponibilité">
            <option value="">-- Disponibilité --</option>
            <option value="available" <?= ($_GET['availability'] ?? '') === 'available' ? 'selected' : '' ?>>Disponible</option>
            <option value="borrowed" <?= ($_GET['availability'] ?? '') === 'borrowed' ? 'selected' : '' ?>>Emprunté</option>
        </select>

        <!-- Bouton -->
        <button type="submit" class="search-button">Valider les filtres</button>
    </form>
</div>

<?php if (!empty($results)): ?>
    <!-- Résultats de recherche -->
    <section class="features">
        <div class="container">
            <h2 class="main-title">📚 Résultats de recherche (<?= count($results) ?>)</h2>
            <div class="feature-grid">
                <?php foreach ($results as $result): ?>
                    <div class="feature-card">
                        <a href="<?= url("home/info?id=" . $result['id']); ?>" class="card-link">
                            <div class="card-image-wrapper">
                                <img
                                    src="<?= $result['image_path'] ? (str_starts_with($result['image_path'], 'http') ? $result['image_path'] : BASE_URL . $result['image_path']) : '/assets/images/default-media.svg' ?>"
                                    alt="<?= e($result['title']); ?>"
                                    onerror="this.onerror=null; this.src='/assets/images/default-media.svg';"
                                >
                                <span class="card-badge-type <?= e($result['type']); ?>">
                                    <?= $result['type'] === 'book' ? 'Livre' : ($result['type'] === 'movie' ? 'Film' : 'Jeu') ?>
                                </span>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title"><?php e($result['title']); ?></h3>
                                <div class="card-meta">
                                    <span class="card-year"><?= e($result['year']); ?></span>
                                    <?php $is_borrowed = is_media_borrowed($result['id']); ?>
                                    <span class="card-availability <?= $is_borrowed ? 'borrowed' : 'available' ?>">
                                        <span class="dot"></span>
                                        <?= $is_borrowed ? 'Emprunté' : 'Disponible' ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <!-- Vue par défaut avec films, livres, jeux -->
    <section class="features">
        <div class="container">
            <h2 class="main-title">📚 Découvrez notre médiathèque</h2>
 
            <!-- Films -->
            <div class="media-section">
                <h3 class="section-title margin-bottom-25 margin-top-50">🎥 Films</h3>
                <div class="feature-grid">
                    <?php foreach (array_slice($movies, 0, 10) as $movie): ?>
                        <div class="feature-card">
                            <a href="<?= url("home/info?id=" . $movie['id']); ?>" class="card-link">
                                <div class="card-image-wrapper">
                                    <img
                                        src="<?= $movie['image_path'] ? (str_starts_with($movie['image_path'], 'http') ? $movie['image_path'] : BASE_URL . $movie['image_path']) : '/assets/images/default-media.svg' ?>"
                                        alt="<?= e($movie['title']); ?>"
                                        onerror="this.onerror=null; this.src='/assets/images/default-media.svg';"
                                    >
                                    <span class="card-badge-type <?= e($movie['type']); ?>">
                                        <?= $movie['type'] === 'book' ? 'Livre' : ($movie['type'] === 'movie' ? 'Film' : 'Jeu') ?>
                                    </span>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title"><?php e($movie['title']); ?></h3>
                                    <div class="card-meta">
                                        <span class="card-year"><?= e($movie['year']); ?></span>
                                        <?php $is_borrowed = is_media_borrowed($movie['id']); ?>
                                        <span class="card-availability <?= $is_borrowed ? 'borrowed' : 'available' ?>">
                                            <span class="dot"></span>
                                            <?= $is_borrowed ? 'Emprunté' : 'Disponible' ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
 
            <!-- Livres -->
            <div class="media-section">
                <h3 class="section-title margin-bottom-25 margin-top-50">📖 Livres</h3>
                <div class="feature-grid">
                    <?php foreach (array_slice($books, 0, 10) as $book): ?>
                        <div class="feature-card">
                            <a href="<?= url("home/info?id=" . $book['id']); ?>" class="card-link">
                                <div class="card-image-wrapper">
                                    <img
                                        src="<?= $book['image_path'] ? (str_starts_with($book['image_path'], 'http') ? $book['image_path'] : BASE_URL . $book['image_path']) : '/assets/images/default-media.svg' ?>"
                                        alt="<?= e($book['title']); ?>"
                                        onerror="this.onerror=null; this.src='/assets/images/default-media.svg';"
                                    >
                                    <span class="card-badge-type <?= e($book['type']); ?>">
                                        <?= $book['type'] === 'book' ? 'Livre' : ($book['type'] === 'movie' ? 'Film' : 'Jeu') ?>
                                    </span>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title"><?php e($book['title']); ?></h3>
                                    <div class="card-meta">
                                        <span class="card-year"><?= e($book['year']); ?></span>
                                        <?php $is_borrowed = is_media_borrowed($book['id']); ?>
                                        <span class="card-availability <?= $is_borrowed ? 'borrowed' : 'available' ?>">
                                            <span class="dot"></span>
                                            <?= $is_borrowed ? 'Emprunté' : 'Disponible' ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
 
            <!-- Jeux -->
            <div class="media-section">
                <h3 class="section-title margin-bottom-25 margin-top-50">🎮 Jeux</h3>
                <div class="feature-grid">
                    <?php foreach (array_slice($games, 0, 10) as $game): ?>
                        <div class="feature-card">
                            <a href="<?= url("home/info?id=" . $game['id']); ?>" class="card-link">
                                <div class="card-image-wrapper">
                                    <img
                                        src="<?= $game['image_path'] ? (str_starts_with($game['image_path'], 'http') ? $game['image_path'] : BASE_URL . $game['image_path']) : '/assets/images/default-media.svg' ?>"
                                        alt="<?= e($game['title']); ?>"
                                        onerror="this.onerror=null; this.src='/assets/images/default-media.svg';"
                                    >
                                    <span class="card-badge-type <?= e($game['type']); ?>">
                                        <?= $game['type'] === 'book' ? 'Livre' : ($game['type'] === 'movie' ? 'Film' : 'Jeu') ?>
                                    </span>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title"><?php e($game['title']); ?></h3>
                                    <div class="card-meta">
                                        <span class="card-year"><?= e($game['year']); ?></span>
                                        <?php $is_borrowed = is_media_borrowed($game['id']); ?>
                                        <span class="card-availability <?= $is_borrowed ? 'borrowed' : 'available' ?>">
                                            <span class="dot"></span>
                                            <?= $is_borrowed ? 'Emprunté' : 'Disponible' ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
