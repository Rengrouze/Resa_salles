<?php

namespace App;

class PwdReset
{
    private $pwdResetId;

    private $pwdResetEmail;

    private $pwdResetSelector;

    private $pwdResetToken;

    private $pwdResetExpires;

    public function setEmail($email)
    {
        $this->pwdResetEmail = $email;
    }

    public function setSelector($selector)
    {
        $this->pwdResetSelector = $selector;
    }

    public function setToken($token)
    {
        $this->pwdResetToken = $token;
    }

    public function setExpires($expires)
    {
        $this->pwdResetExpires = $expires;
    }

    public function getId()
    {
        return $this->pwdResetId;
    }

    public function getEmail()
    {
        return $this->pwdResetEmail;
    }

    public function getSelector()
    {
        return $this->pwdResetSelector;
    }

    public function getToken()
    {
        return $this->pwdResetToken;
    }

    public function getExpires()
    {
        return $this->pwdResetExpires;
    }

}