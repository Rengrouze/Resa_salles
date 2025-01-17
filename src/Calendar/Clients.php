<?php

namespace Calendar;

class Clients
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // find a client with his mail and password
    public function find(string $email, string $password)
    {

        $statement = $this->pdo->prepare("SELECT * FROM clients WHERE email = :email");
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Client::class);
        $result = $statement->fetch();
        //compate the password
        if ($result === false) {
            // return an error message for the user
            throw new \Exception("Aucun compte ne correspond à ces identifiants");
        }
        if (password_verify($password, $result->getPassword())) {
            return $result;
        } else {
            throw new \Exception("Aucun compte ne correspond à ces identifiants");
        }


        //  $statement->execute(['email' => $email, 'password' => $password]);
        //  $statement->setFetchMode(\PDO::FETCH_CLASS, Client::class);
        // $result = $statement->fetch();
        //if ($result === false) {
        // return an error message for the user
        //     throw new \Exception("Aucun compte ne correspond à ces identifiants");
        // }

    }


    public function hydrate(Client $client, array $data)
    {
        $client->setName($data['name']);
        $client->setFirstname($data['firstname']);
        $client->setEmail($data['email']);
        //hash the password
        $client->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));

        $client->setPhone($data['phone']);
        $client->setBusiness($data['business']);
        $client->setSiret($data['siret']);
        $client->setAddress($data['address']);
        $client->setAddressComplement($data['address_complement']);
        $client->setPostalCode($data['postal_code']);
        $client->setCity($data['city']);
        $client->setCountry($data['country']);
        
        return $client;
    }



    public function create(Client $client)
    {
        $statement = $this->pdo->prepare("INSERT INTO clients (name, firstname, email, password, phone, business, siret, address,address_complement, city, postal_code, country) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->execute([

            $client->getName(),
            $client->getFirstname(),
            $client->getEmail(),
            $client->getPassword(),
            $client->getPhone(),
            $client->getBusiness(),
            $client->getSiret(),
            $client->getAddress(),
            $client->getAddressComplement(),
            $client->getCity(),
            $client->getPostalCode(),
            $client->getCountry(),
            
        ]);
        // return (bool) $statement->rowCount();
        // once the client is created, return the id of the client
        return $this->pdo->lastInsertId();
    }

    //find a client with his email (in case of forgot password)
    public function findClientByMail(string $email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM clients WHERE email = :email");
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Client::class);
        $result = $statement->fetch();
        if ($result === false) {
            // return an error message for the user
            throw new \Exception("Aucun compte ne correspond à cette adresse mail");
        }
        // if the client exists, return a boolean
        return true;
    }

    public function activateClient(string $email)
    {
        $statement = $this->pdo->prepare("UPDATE clients SET activated = 1 WHERE email = :email");
        $statement->execute(['email' => $email]);
        // after the client is activated, return a boolean
        return true;


    }

    public function updatePassword(string $email, string $password)
    {


        $statement = $this->pdo->prepare("UPDATE clients SET password = :password WHERE email = :email");
        $statement->execute(['email' => $email, 'password' => $password]);

        // if change has a problem, return an error message for the user
        if ($statement === false) {
            throw new \Exception("Impossible de mettre à jour le mot de passe");
        }
        // if the password is updated, return a boolean
        return true;
    }

    // ADMIN COMMANDS   
    public function findAllClients()
{
    $statement = $this->pdo->query("SELECT * FROM clients ORDER BY id ASC");
    $statement->setFetchMode(\PDO::FETCH_CLASS, Client::class);
    $clients = $statement->fetchAll();
    return $clients;
}


    public function findClientById(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM clients WHERE id = :id");
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Client::class);
        $result = $statement->fetch();
        if ($result === false) {
            // return an error message for the user
            throw new \Exception("Aucun compte ne correspond à cet identifiant");
        }
        return $result;
    }
    public function findClientNameById (int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM clients WHERE id = :id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();
        if ($result === false) {
            // return an error message for the user
            throw new \Exception("Aucun compte ne correspond à cet identifiant");
        }
        // only return the full name of the client
        return $result['name'] . ' ' . $result['firstname'];
    }
    
    public function countClients()
    {
        $statement = $this->pdo->query("SELECT COUNT(*) as count FROM clients");
        $result = $statement->fetch();
        $count = $result['count']; // Extract the count value using the alias
        return $count;
    }

    public function getFirstClient()
    {
        $statement = $this->pdo->query("SELECT * FROM clients ORDER BY id ASC LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, Client::class);
        $result = $statement->fetch();
        if ($result === false) {
            // return an error message for the user
            throw new \Exception("Aucun compte ne correspond à cet identifiant");
        }
        return $result;
    }
    public function getFirstId()
    {
        $statement = $this->pdo->query("SELECT * FROM clients ORDER BY id ASC LIMIT 1");
        $result = $statement->fetch();
        if ($result === false) {
            // return an error message for the user
            throw new \Exception("Aucun compte ne correspond à cet identifiant");
        }
        return $result['id'];
    }
    public function updateClient($id, $data)
    {
        $fields = [];
        $params = ['id' => $id];

        foreach ($data as $key => $value) {
            if ($key === 'address_complement') {
                // Include address_complement even if it's empty
                $fields[] = "$key = :$key";
                $params[$key] = $value;
            } elseif (!empty($value)) {
                $fields[] = "$key = :$key";
                $params[$key] = $value;
            }
        }

        $sql = "UPDATE clients SET " . implode(", ", $fields) . " WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        if ($statement->rowCount() === 0) {
            throw new \Exception("Client not found or no changes were made");
        }

        return true;
    }


    



}