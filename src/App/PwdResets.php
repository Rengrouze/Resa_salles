<?php

namespace App;

class PwdResets
{


    private $pdo;


    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function hydrate(PwdReset $pwdReset, array $data)
    {
        $pwdReset->setEmail($data['email']);
        $pwdReset->setSelector($data['selector']);
        $pwdReset->setToken($data['token']);
        $pwdReset->setExpires($data['expires']);
    }


    public function create(PwdReset $pwdReset)
    {
        $statement = $this->pdo->prepare("INSERT INTO pwdResets (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)");
        $statement->execute([
            'pwdResetEmail' => $pwdReset->getEmail(),
            'pwdResetSelector' => $pwdReset->getSelector(),
            'pwdResetToken' => $pwdReset->getToken(),
            'pwdResetExpires' => $pwdReset->getExpires()
        ]);
    }



    public function delete(string $email)
    {
        $statement = $this->pdo->prepare("DELETE FROM pwdResets WHERE pwdResetEmail=$email");
        $statement->execute();
    }
}