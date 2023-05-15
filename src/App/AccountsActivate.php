<?php

namespace App;

class AccountsActivate
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function hydrate(AccountActivate $accountActivate, array $data)
    {
        $accountActivate->setEmail($data['email']);
        $accountActivate->setSelector($data['selector']);
        $accountActivate->setToken($data['token']);
        $accountActivate->setExpires($data['expires']);

        return $accountActivate;
    }

    public function create(AccountActivate $accountActivate)
    {
        $statement = $this->pdo->prepare("INSERT INTO accountactivate (accountActivateEmail, accountActivateSelector, accountActivateToken, accountActivateExpires) VALUES (:email, :selector, :token, :expires)");
        $statement->execute([
            'email' => $accountActivate->getEmail(),
            'selector' => $accountActivate->getSelector(),
            'token' => $accountActivate->getToken(),
            'expires' => $accountActivate->getExpires()
        ]);
    }

    public function delete(string $email)
    {
        $statement = $this->pdo->prepare("DELETE FROM accountactivate WHERE accountActivateEmail='$email'");
        $statement->execute();
    }

    public function mailAlreadySent(string $email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM accountactivate WHERE accountActivateEmail = :email");
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
        $statement = $this->pdo->prepare("SELECT * FROM accountactivate WHERE accountActivateSelector = :selector AND accountActivateExpires >= :today");
        $statement->execute(['selector' => $selector, 'today' => $today]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, AccountActivate::class);
        $result = $statement->fetch();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


}