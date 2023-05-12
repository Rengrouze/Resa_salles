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

        return $pwdReset;
    }


    public function create(PwdReset $pwdReset)
    {
        $statement = $this->pdo->prepare("INSERT INTO pwdresets (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (:email, :selector, :token, :expires)");
        $statement->execute([
            'email' => $pwdReset->getEmail(),
            'selector' => $pwdReset->getSelector(),
            'token' => $pwdReset->getToken(),
            'expires' => $pwdReset->getExpires()
        ]);
    }




    public function delete(string $email)
    {
        $statement = $this->pdo->prepare("DELETE FROM pwdresets WHERE pwdResetEmail='$email'");
        $statement->execute();
    }
    public function mailAlreadySent(string $email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM pwdresets WHERE pwdResetEmail = :email");
        $statement->execute(['email' => $email]);
        $result = $statement->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function validateToken(string $selector, $today)
    {
        $statement = $this->pdo->prepare("SELECT * FROM pwdresets WHERE pwdResetSelector = :selector AND pwdResetExpires >= :today");
        $statement->execute(['selector' => $selector, 'today' => $today]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, PwdReset::class);

        $result = $statement->fetch();
        if ($result) {
            return $result;
        } else {
            return false;
        }


    }

}