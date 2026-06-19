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
                <p class="lead-text"><?php e($content); ?></p>

                <h3 class="subsection-title">🎯 Fonctionnalités Clés</h3>
                <p>Médiathèque DEIN vous permet de gérer et de rechercher facilement vos collections :</p>
                <div class="about-features-grid">
                    <div class="about-feature-card">
                        <div class="icon-wrapper book"><i class="fas fa-book" aria-hidden="true"></i></div>
                        <h4>Livres</h4>
                        <p>Suivi des auteurs, nombre de pages, résumés et numéros ISBN.</p>
                    </div>
                    <div class="about-feature-card">
                        <div class="icon-wrapper movie"><i class="fas fa-film" aria-hidden="true"></i></div>
                        <h4>Films</h4>
                        <p>Gestion des réalisateurs, durées, classifications et synopsis.</p>
                    </div>
                    <div class="about-feature-card">
                        <div class="icon-wrapper game"><i class="fas fa-gamepad" aria-hidden="true"></i></div>
                        <h4>Jeux</h4>
                        <p>Suivi des éditeurs, plateformes et restrictions d'âge PEGI.</p>
                    </div>
                </div>

                <h3 class="subsection-title">🛠️ Technologies Utilisées</h3>
                <p>L'application repose sur un écosystème robuste et performant :</p>
                <div class="tech-badges">
                    <span class="tech-badge"><i class="fab fa-php" aria-hidden="true"></i> PHP (Architecture MVC)</span>
                    <span class="tech-badge"><i class="fas fa-database" aria-hidden="true"></i> MySQL</span>
                    <span class="tech-badge"><i class="fas fa-server" aria-hidden="true"></i> Environnement Docker / WAMP</span>
                    <span class="tech-badge"><i class="fab fa-html5" aria-hidden="true"></i> HTML5 &amp; CSS3</span>
                    <span class="tech-badge"><i class="fab fa-js" aria-hidden="true"></i> JavaScript</span>
                    <span class="tech-badge"><i class="fab fa-css3-alt" aria-hidden="true"></i> Design Système Vanilla CSS</span>
                </div>
            </div>

            <div class="sidebar">
                <div class="info-box">
                    <h4>Informations système</h4>
                    <ul class="system-info-list">
                        <li><strong>Version PHP :</strong> <span><?php echo phpversion(); ?></span></li>
                        <li><strong>Version app :</strong> <span><?php echo APP_VERSION; ?></span></li>
                        <li><strong>Base URL :</strong> <code><?php echo BASE_URL ?: '/'; ?></code></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>