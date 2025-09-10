<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-brand">
                <a href="<?php echo url(); ?>"><?php echo APP_NAME; ?></a>
            </div>
            <ul class="nav-menu">
                <li><a href="<?php echo url(); ?>">Accueil</a></li>
                <li><a href="<?php echo url('media/add_book'); ?>">Livres</a></li>
                <li><a href="<?php echo url('media/add_movie'); ?>">Films</a></li>
                <li><a href="<?php echo url('media/add_game'); ?>">Jeux</a></li>
                <li><a href="<?php echo url('home/about'); ?>">À propos</a></li>
                <li><a href="<?php echo url('home/contact'); ?>">Contact</a></li>




                    <?php if (is_logged_in()): ?>
                        <li class="dropdown"> 
                            <button type="button" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                                <?php if (!empty($_SESSION['user_profile'])): ?>
                                    <img src="<?php echo url('uploads/profiles/' . $_SESSION['user_profile']); ?>" 
                                        alt="Profile" class="profile-pic">
                                <?php else: ?>
                                    <i class="fas fa-user-circle fa-2x"></i>
                                <?php endif; ?>
                                <span class="nav-username"><?= e($_SESSION['user_name']); ?></span>
                                <i class="fas fa-caret-down caret-icon" aria-hidden="true"></i>
                            </button>

                            <ul class="dropdown-menu" role="menu" aria-label="Menu utilisateur">
                                <?php if (is_admin()): ?>
                                    <li><a href="<?php echo url('media/add_book'); ?>"><i class="fas fa-book"></i> Ajouter un livre</a></li>
                                    <li><a href="<?php echo url('media/add_movie'); ?>"><i class="fas fa-film"></i> Ajouter un film</a></li>
                                    <li><a href="<?php echo url('media/add_game'); ?>"><i class="fas fa-gamepad"></i> Ajouter un jeu</a></li>
                                    <li class="divider" aria-hidden="true"></li>
                                <?php endif; ?>
                                <li><a href="<?php echo url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="<?php echo url('auth/login'); ?>">Connexion</a></li>
                        <li><a href="<?php echo url('auth/register'); ?>">Inscription</a></li>
                    <?php endif; ?>






            </ul>
        </nav>
    </header>

    <main class="main-content">
        <?php flash_messages(); ?>
        <?php echo $content ?? ''; ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. Tous droits réservés.</p>
            <p>Version <?php echo APP_VERSION; ?></p>
        </div>
    </footer>

    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
</body>
</html>
