<?php

class User {
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $password;
    private $id;

    public function connect($login, $password) {
        $this -> login = $login;
        $this -> password = $password;

        return [
            $login
        ];
    }

    public function register($login, $password, $email, $firstname, $lastname) {
        $this -> login = $login;
        $this -> password = $password;
        $this -> email = $email;
        $this -> firstname = $firstname;
        $this -> lastname = $lastname;
        
        return [
            $login,
            $email,
            $firstname,
            $lastname
        ];
    }
}
