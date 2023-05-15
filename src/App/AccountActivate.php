<?php

namespace App;

class AccountActivate
{
    private $accountActivateId;

    private $accountActivateEmail;

    private $accountActivateSelector;

    private $accountActivateToken;

    private $accountActivateExpires;

    public function setEmail($email)
    {
        $this->accountActivateEmail = $email;
    }

    public function setSelector($selector)
    {
        $this->accountActivateSelector = $selector;
    }

    public function setToken($token)
    {
        $this->accountActivateToken = $token;
    }

    public function setExpires($expires)
    {
        $this->accountActivateExpires = $expires;
    }

    public function getId()
    {
        return $this->accountActivateId;
    }

    public function getEmail()
    {
        return $this->accountActivateEmail;
    }

    public function getSelector()
    {
        return $this->accountActivateSelector;
    }

    public function getToken()
    {
        return $this->accountActivateToken;
    }

    public function getExpires()
    {
        return $this->accountActivateExpires;
    }


}