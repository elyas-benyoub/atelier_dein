<?php
// Système de vues et templating

/**
 * Charge une vue avec des données
 */
function load_view($view, $data = []) {
    // Extraire les données en variables
    if (!empty($data)) {
        extract($data);
    }
    
    // Chemin vers le fichier de vue
    $view_file = VIEW_PATH . '/' . $view . '.php';
    
    // Vérifier si la vue existe
    if (!file_exists($view_file)) {
        die("Vue non trouvée : $view");
    }
    // Charger la vue
    require $view_file;
}

/**
 * Charge une vue avec un layout
 */
function load_view_with_layout($view, $data = [], $layout = 'layout') {

    // 1) Rendre la vue dans un buffer
    ob_start();

    load_view($view, $data);
    
    $content = ob_get_clean();

    // 2) Ajouter le contenu au jeu de données
    $data['content'] = $content;

    // 3) Rendre le layout (load_view fera extract($data) ici aussi)
    load_view('layouts/' . $layout, $data);
}

/**
 * Inclut un partial
 */
function include_partial($partial, $data = []) {
    // Extraire les données en variables
    if (!empty($data)) {
        extract($data);
    }
    
    // Chemin vers le fichier partial
    $partial_file = VIEW_PATH . '/partials/' . $partial . '.php';
    
    // Vérifier si le partial existe
    if (file_exists($partial_file)) {
        require $partial_file;
    }
}

/**
 * Affiche les messages flash
 */
function flash_messages() {
    if (isset($_SESSION['flash_messages'])) {
        foreach ($_SESSION['flash_messages'] as $type => $messages) {
            if (is_array($messages)) {
                foreach ($messages as $message) {
                    echo "<div class='alert alert-$type'>$message</div>";
                }
            } else {
                echo "<div class='alert alert-$type'>$messages</div>";
            }
        }
        unset($_SESSION['flash_messages']);
    }
} 