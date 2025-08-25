<?php
 echo "Hello " . htmlspecialchars($_GET["login"]);

// relier au fichier user.php
require_once "../model/User.php";
// var $user qui contient la classe User
$user = new User();

// recupérer les données du tableau GET
$login = $_GET['login'];
$password = $_GET['password'];
$email = $_GET['email'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];

// appeler la fonction
$data = $user->register($login, $password, $email, $firstname, $lastname);
//tableau
var_dump($data);


?>
