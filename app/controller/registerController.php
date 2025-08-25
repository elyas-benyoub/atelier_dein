<?php
 echo "Hello " . htmlspecialchars($_GET["login"]);

require_once "../model/User.php";
$user = new User();

$login = $_GET['login'];
$password = $_GET['password'];
$email = $_GET['email'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];


$data = $user->register($login, $password, $email, $firstname, $lastname);
var_dump($data);


?>
