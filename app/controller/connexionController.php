<?php

/* on requiert une seule fois; les deux point c'est 
** l'action de revenir en arrière sur le dossier parent entre slash
** et appeler le fichier tous ça entre guillemet double
*/

require_once "../model/User.php";

$login = $_GET['username'];
$password = $_GET['password'];

/*
** on enregistre les données du formulaire
** à travers la variable GET qui sert de véhicule
*/

$user = new User();
/*on instancie un nouvel utilisateur avec la class User*/

$data = $user->connect($login, $password);
/*
** on appelle la methode (fonction) connect() pour connecter l'utilisateur
** la methode renvoie des donnees (datas, message...).
*/

var_dump($data); // afficher et verifier les donnees dans le navigateur
?>


