<?php

class User {
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $password;
    private $id;

    public function connect($login, $password) {
        $this->login = $login;
        $this->password = $password;
    }
}

