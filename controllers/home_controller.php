<?php
// Contrôleur pour la page d'accueil

/**
 * Page d'accueil
 */
function home_index() {
    $medias = get_all_medias();

    
    $data = [
        'title' => 'Accueil',
        'message' => 'Bienvenue sur votre application PHP MVC !',
        'medias'=> $medias,
    ];
    
    load_view_with_layout('home/index', $data);
}

/**
 * Page à propos
 */
function home_about() {
    $data = [
        'title' => 'À propos',
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.'
    ];
    
    load_view_with_layout('home/about', $data);
}

/**
 * Page contact
 */
function home_contact() {
    $data = [
        'title' => 'Contact'
    ];
    
    if (is_post()) {
        $name = clean_input(post('name'));
        $email = clean_input(post('email'));
        $message = clean_input(post('message'));
        
        // Validation simple
        if (empty($name) || empty($email) || empty($message)) {
            set_flash('error', 'Tous les champs sont obligatoires.');
        } elseif (!validate_email($email)) {
            set_flash('error', 'Adresse email invalide.');
        } else {
            // Ici vous pourriez envoyer l'email ou sauvegarder en base
            set_flash('success', 'Votre message a été envoyé avec succès !');
            redirect('home/contact');
        }
    }
    
    load_view_with_layout('home/contact', $data);
} 


/**
 * Page profile
 */
function home_profile() {
    $data = [
        'title' => 'Profile',
        'message' => 'Bienvenue sur votre profil',
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.'
    ];
    
    load_view_with_layout('home/profile', $data);
} 

/**
 * Page test
 */
function home_test() {
    $data = [
        'title' => 'Page test',
        'message' => 'Bienvenue sur votre page test',
    ];
    
    load_view_with_layout('home/test', $data);
} 