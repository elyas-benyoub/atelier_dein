<?php

namespace App;

class Account {
    private string $password;

    /**
     * Set the value of password
     *
     * @return  void
     */ 
    public function setPassword($password): void
    {
        if (!preg_match('/[$*%]/', $password)) 
            throw new \Exception('Le mot de passe doit etre plus complexe');
        $this->password = $password;
    }
}