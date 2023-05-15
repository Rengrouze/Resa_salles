<?php

namespace Admin;

class Admins
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function hydrate(Admin $admin, array $data)
    {
        $admin->setUsername($data['username']);
        $admin->setPassword($data['password']);

        return $admin;
    }

    public function create(Admin $admin)
    {
        $statement = $this->pdo->prepare("INSERT INTO admin (adminUsername, adminPassword) VALUES (:username, :password)");
        $statement->execute([
            'username' => $admin->getUsername(),
            'password' => $admin->getPasswordHash()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update(Admin $admin)
    {
        $statement = $this->pdo->prepare("UPDATE admin SET adminUsername = :username, adminPassword = :password WHERE adminId = :id");
        $statement->execute([
            'username' => $admin->getUsername(),
            'password' => $admin->getPasswordHash(),
            'id' => $admin->getId()
        ]);
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM admin WHERE adminId = :id");
        $statement->execute(['id' => $id]);
    }

    public function findAll()
    {
        $statement = $this->pdo->query("SELECT * FROM admin");
        $statement->setFetchMode(\PDO::FETCH_CLASS, Admin::class);
        $admins = $statement->fetchAll();
        return $admins;
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM admin WHERE adminId = :id");
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Admin::class);
        $admin = $statement->fetch();
        return $admin;
    }

    public function findUsername(string $username)
    {
        $statement = $this->pdo->prepare("SELECT * FROM admin WHERE adminUsername = :username");
        $statement->execute(['username' => $username]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Admin::class);
        $admin = $statement->fetch();
        return $admin;
    }

}