<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <h2>À propos de cette application</h2>
                <p><?php e($content); ?></p>

                <h3>Détails</h3>
                <p>Ici, un utilisateur peut rechercher un média spécifique tel que :</p>
                <ul>
                    <li><strong>Livres</strong></li>
                    <li><strong>Films</strong></li>
                    <li><strong>Jeux</strong></li>
                </ul>

                <h3>Médiathèque DEIN est alimenté par :</h3>
                <ul>
                    <li>PHP (architecture MVC)</li>
                    <li>MySQL (gestion de base de données)</li>
                    <li>WAMP (environnement de développement local)</li>
                    <li>HTML/CSS/JS (développement front-end)</li>
                    <li>Bootstrap (UI Framework)</li>
                </ul>

            <div class="sidebar">
                <div class="info-box">
                    <h4>Informations système</h4>
                    <p><strong>Version PHP :</strong> <?php echo phpversion(); ?></p>
                    <p><strong>Version app :</strong> <?php echo APP_VERSION; ?></p>
                    <p><strong>Base URL :</strong> <code><?php echo BASE_URL; ?></code></p>
                </div>
            </div>
        </div>
    </div>
</section>