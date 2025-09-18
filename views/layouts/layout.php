<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-brand">
                <a href="<?php echo url(); ?>"><?php echo APP_NAME; ?></a>
            </div>
            <ul class="nav-menu">
                <li><a href="<?php echo url(); ?>">Accueil</a></li>
                <li><a href="<?php echo url('home/about'); ?>">À propos</a></li>
                <li><a href="<?php echo url('home/contact'); ?>">Contact</a></li>

                <!-- acces media et users / admin only  -->
                <?php if (is_logged_in()): ?>
                    <li class="deroulant">
                        <div class="bouton-deroulant btn">
                            <span class="profil-nom"><?php echo e($_SESSION['user_name']); ?></span>
                            <?php if (!empty($_SESSION['user_profile'])): ?>
                                <img src="<?php echo url('uploads/profiles/' . $_SESSION['user_profile']); ?>" alt="Profil"
                                    class="photo-profil">
                            <?php else: ?>
                                <i class="fas fa-user-circle fa-2x"></i>
                            <?php endif; ?>
                        </div>

                        <!-- Liste déroulante -->
                        <ul class="menu-deroulant">
                            <?php if (is_admin()): ?>
                                <li><a href="<?php echo url('admin/show_users'); ?>">Gérer les utilisateurs</a></li>
                                <li><a href="<?php echo url('admin/show_medias'); ?>">Gérer les medias</a></li>
                                <li><a href="<?php echo url('loan/users'); ?>">Gérer les emprunts</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo url('home/profile'); ?>">Profile</a></li>
                            <li><a href="<?php echo url('auth/logout'); ?>">Déconnexion</a></li>
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