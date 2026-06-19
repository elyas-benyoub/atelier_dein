<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php $current_route = trim($_GET['url'] ?? '', '/'); ?>
    <a class="skip-link" href="#main-content">Aller au contenu principal</a>
    <header class="header">
        <nav class="navbar" aria-label="Navigation principale">
            <div class="nav-brand">
                <a href="<?php echo url(); ?>"><?php echo APP_NAME; ?></a>
            </div>

            <button type="button" class="menu-toggle" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="primary-navigation">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>

            <ul id="primary-navigation" class="nav-menu">
                <li><a href="<?php echo url(); ?>" <?= in_array($current_route, ['', 'home/index'], true) ? 'aria-current="page"' : '' ?>>Accueil</a></li>
                <li><a href="<?php echo url('home/about'); ?>" <?= $current_route === 'home/about' ? 'aria-current="page"' : '' ?>>À propos</a></li>
                <li><a href="<?php echo url('home/contact'); ?>" <?= $current_route === 'home/contact' ? 'aria-current="page"' : '' ?>>Contact</a></li>

                <!-- acces media et users / admin only  -->
                <?php if (is_logged_in()): ?>
                    <li class="deroulant">
                        <button type="button" class="bouton-deroulant account-menu-toggle" aria-expanded="false" aria-controls="account-navigation">
                            <span class="profil-nom"><?php echo e($_SESSION['user_name']); ?></span>
                            <?php if (!empty($_SESSION['user_profile'])): ?>
                                <img src="<?php echo url('uploads/profiles/' . $_SESSION['user_profile']); ?>" alt="Profil"
                                    class="photo-profil">
                            <?php else: ?>
                                <i class="fas fa-user-circle fa-2x" aria-hidden="true"></i>
                            <?php endif; ?>
                        </button>

                        <!-- Liste déroulante -->
                        <ul id="account-navigation" class="menu-deroulant">
                            <?php if (is_admin()): ?>
                                <li><a href="<?php echo url('admin/show_users'); ?>">Gérer les utilisateurs</a></li>
                                <li><a href="<?php echo url('admin/show_medias'); ?>">Gérer les media</a></li>
                                <li><a href="<?php echo url('loan/show_loans'); ?>">Gérer les emprunts</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo url('home/profile'); ?>">Profil</a></li>
                            <li><a href="<?php echo url('auth/logout'); ?>">Déconnexion</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo url('auth/login'); ?>" <?= $current_route === 'auth/login' ? 'aria-current="page"' : '' ?>>Connexion</a></li>
                    <li><a href="<?php echo url('auth/register'); ?>" <?= $current_route === 'auth/register' ? 'aria-current="page"' : '' ?>>Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main id="main-content" class="main-content" tabindex="-1">
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
