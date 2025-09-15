<?php
// Fonctions utilitaires

/**
 * Log les erreurs de l'app
 */

function app_log(string $msg): void {
    $file = __DIR__ . '/../storage/logs/app.log';
    $dir  = dirname($file);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true); 
    }

    $date = date('d/m/Y H:i:s'); 
    error_log("[$date] $msg\n", 3, $file);
}

/**
 * Sécurise l'affichage d'une chaîne de caractères (protection XSS)
 */
function escape($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Affiche une chaîne sécurisée (échappée)
 */
function e($string)
{
    echo escape($string);
}

/**
 * Retourne une chaîne sécurisée sans l'afficher
 */
function esc($string)
{
    return escape($string);
}

/**
 * Génère une URL absolue
 */
function url($path = '')
{
    $base_url = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');
    return $base_url . '/' . $path;
}

/**
 * Redirection HTTP
 */
function redirect($path = '')
{
    $url = url($path);
    header("Location: $url");
    exit;
}

/**
 * Génère un token CSRF
 */
function csrf_token()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie un token CSRF
 */
function verify_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Définit un message flash
 * soit error, success
 */
function set_flash($type, $message)
{
    $_SESSION['flash_messages'][$type][] = $message;

    $file = __DIR__ . '/../storage/logs/app.log';
    $dir = dirname($file);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);  // crée storage/logs si besoin
    }

    // Format français : 28/08/2025 21:10:54
    $date = date('d/m/Y H:i:s');
    error_log("[$date] FLASH [$type] $message\n", 3, $file);
}

/**
 * Récupère et supprime les messages flash
 */
function get_flash_messages($type = null)
{
    if (!isset($_SESSION['flash_messages'])) {
        return [];
    }

    if ($type) {
        $messages = $_SESSION['flash_messages'][$type] ?? [];
        unset($_SESSION['flash_messages'][$type]);
        return $messages;
    }

    $messages = $_SESSION['flash_messages'];
    unset($_SESSION['flash_messages']);
    return $messages;
}

/**
 * Vérifie s'il y a des messages flash
 */
function has_flash_messages($type = null)
{
    if (!isset($_SESSION['flash_messages'])) {
        return false;
    }

    if ($type) {
        return !empty($_SESSION['flash_messages'][$type]);
    }

    return !empty($_SESSION['flash_messages']);
}

/**
 * Nettoie une chaîne de caractères
 */
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    // $data = htmlspecialchars($data);
    return $data;
}

/**
 * Valide une adresse email
 */
function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Génère un mot de passe sécurisé
 */
function generate_password($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

/**
 * Hache un mot de passe
 */
function hash_password($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Vérifie un mot de passe
 */
function verify_password($password, $hash)
{
    return password_verify($password, $hash);
}

/**
 * Formate une date
 */
function format_date($date, $format = 'd/m/Y H:i')
{
    return date($format, strtotime($date));
}

/**
 * Vérifie si une requête est en POST
 */
function is_post()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Vérifie si une requête est en GET
 */
function is_get()
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Retourne la valeur d'un paramètre POST
 */
function post($key, $default = null)
{
    return $_POST[$key] ?? $default;
}

/**
 * Retourne la valeur d'un paramètre GET
 */
function get($key, $default = null)
{
    return $_GET[$key] ?? $default;
}

/**
 * Vérifie si un utilisateur est connecté
 */
function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

/**
 * Retourne l'ID de l'utilisateur connecté
 */
function current_user_id()
{
    return $_SESSION['user_id'] ?? null;
}

/**
 * Déconnecte l'utilisateur
 */
function logout()
{
    session_destroy();
    redirect('auth/login');
}

/**
 * Formate un nombre
 */
function format_number($number, $decimals = 2)
{
    return number_format($number, $decimals, ',', ' ');
}


/**
 * Veririfier le role admin ou user lors de la connexion
 */
function is_admin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function is_user() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user';
}


/**
 * accès reserver a l'admin
 */

function only_admin() {
    if (!is_logged_in() || !is_admin()){
        set_flash('error', 'Accès reservé à l admnistrateur');
        redirect('home');
    }
}

function upload_img()
{
    try {
        if (!isset($_FILES['img_cover']) && $_FILES['img_cover']['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException("Aucun fichier téléchargé.");
        }

        $tmp_name = $_FILES['img_cover']['tmp_name'];
        $name = basename($_FILES['img_cover']['name']);
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        // 1. Vérifier la taille (max 2 Mo)
        if ($_FILES['img_cover']['size'] > 2 * 1024 * 1024) {
            throw new DomainException("Erreur : fichier trop volumineux (max 2 Mo).");
        }

        // 2. Vérifier l’extension
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowed_ext)) {
            throw new DomainException("Erreur : extension non autorisée.");
        }

        // 3. Vérifier le type MIME réel avec finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($tmp_name);
        $allowed_mime = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime, $allowed_mime)) {
            throw new DomainException("Erreur : le fichier n'est pas une image valide.");
        }

        // 4. Générer un nouveau nom unique
        $new_name = bin2hex(random_bytes(16)) . '.' . $ext;

        // 5. Déplacer le fichier
        $dir = PUBLIC_PATH . "/uploads/media/";
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        $full_path = $dir . $new_name;

        if (!move_uploaded_file($tmp_name, $full_path)) {
            throw new RuntimeException("Erreur lors du déplacement du fichier.");
        }

        return [
            'name' => $new_name,
            'full_path' => $full_path,
            'url' => "/uploads/media/$new_name"
        ];
    } catch (Throwable $e) {
        $_SESSION['errors']['img_cover'] = $e->getMessage();
        app_log('[upload_image] error:' . $e->getMessage());
        return null;
    }
}
