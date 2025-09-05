<!-- <?php var_dump($medias); ?> -->
<div class="hero">
    <div class="hero-content">
        <h1><?php e($message); ?></h1>
        <p class="hero-subtitle">Un starter kit PHP avec architecture MVC procédurale</p>
        <?php if (!is_logged_in()): ?>
            <div class="hero-buttons">
                <a href="<?php echo url('auth/register'); ?>" class="btn btn-primary">Commencer</a>
                <a href="<?php echo url('auth/login'); ?>" class="btn btn-secondary">Se connecter</a>
            </div>
        <?php else: ?>
            <p class="welcome-message">
                <i class="fas fa-user"></i> 
                Bienvenue, <?php e($_SESSION['user_name']); ?> !
            </p>
        <?php endif; ?>
    </div>
</div>

<section class="features">
    <div class="container">
        <!-- Titre général -->
        <h2 class="main-title">📚 Découvrez notre médiathèque</h2>

        <!-- Grille des films -->
        <div class="media-section">
            <h3 class="section-title">🎥 Films</h3>
            <div class="feature-grid">
                <?php foreach ($movies as $movie): ?>
                    <div class="feature-card">
                        <img src="<?= PUBLIC_URL . $film['image_path'] ?>" alt="<?= e($film['title']); ?>">
                        <h3><?php e($film['title']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Grille des livres -->
        <div class="media-section">
            <h3 class="section-title">📖 Livres</h3>
            <div class="feature-grid">
                <?php foreach ($books as $book): ?>
                    <div class="feature-card">
                        <img src="<?= PUBLIC_URL . $book['image_path'] ?>" alt="<?= e($book['title']); ?>">
                        <h3><?php e($book['title']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Grille des médias (jeux vidéo, etc.) -->
        <div class="media-section">
            <h3 class="section-title">🎮 Médias</h3>
            <div class="feature-grid">
                <?php foreach ($medias as $media): ?>
                    <div class="feature-card">
                        <img src="<?= PUBLIC_URL . $media['image_path'] ?>" alt="<?= e($media['title']); ?>">
                        <h3><?php e($media['title']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

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