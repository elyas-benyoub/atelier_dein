<?php
require_once "../model/User.php";
$login = $_GET['username'];
$password = $_GET['password'];
$user = new User();
$data = $user->connect($login, $password);
var_dump($data);
?>


