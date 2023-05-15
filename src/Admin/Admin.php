<?php

namespace Admin;

class Admin
{

    private $id;
    private $username;
    private $password;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hash;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPasswordHash()
    {
        return $this->password;
    }

}