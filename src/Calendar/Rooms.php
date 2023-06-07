<?php

namespace Calendar;

class Rooms
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getRooms(): array
    {
        $query = $this->pdo->query('SELECT * FROM rooms');
        $rooms = $query->fetchAll(\PDO::FETCH_CLASS, Room::class);
        return $rooms;
    }

    public function getRoom(int $id): Room
    {
        $query = $this->pdo->query("SELECT * FROM rooms WHERE id = $id");
        $query->setFetchMode(\PDO::FETCH_CLASS, Room::class);
        $result = $query->fetch();
        if ($result === false) {
            throw new \Exception('Aucune salle ne correspond à cet ID');
        }
        return $result;
    }
    public function getRoomNameById(int $id): string
    {
        $query = $this->pdo->query("SELECT name FROM rooms WHERE id = $id");
        $query->setFetchMode(\PDO::FETCH_CLASS, Room::class);
        $result = $query->fetch();
        if ($result === false) {
            throw new \Exception('Aucune salle ne correspond à cet ID');
        }
        return $result->getName();
    }


    public function hydrateRoom(Room $room, array $data)
    {
        $room->setName($data['name']);
        $room->setCapacity($data['capacity']);
        $room->setSeats($data['seats']);
        $room->setDescription($data['description']);
        $room->setImagePath($data['imagePath']);
        $room->setPrice($data['price']);
        $room->setLocation($data['location']);
        $room->setSize($data['size']);
        $room->setAddress($data['address']);
        $room->setAddressComplement($data['address_complement']);
        $room->setPostalCode($data['postal_code']);
        $room->setCity($data['city']);
        $room->setProjector($data['projector']);
        $room->setWifi($data['wifi']);
        $room->setCoffee($data['coffee']);
        $room->setWater($data['water']);
        $room->setPaperboard($data['paperboard']);
        $room->setTv($data['tv']);
        $room->setToilets($data['toilets']);
        $room->setParking($data['parking']);
        $room->setDisabledAccess($data['disabledAccess']);
        $room->setAirConditioning($data['airConditioning']);

        return $room;
    }

    public function createRoom(Room $room)
    {
        $query = $this->pdo->prepare('INSERT INTO rooms (name, capacity, seats, description, imagePath, price, location, size, address, address_complement, postal_code, city, projector, wifi, coffee, water, paperboard, tv, toilets, parking, disabledAccess, airConditioning) VALUES (:name, :capacity, :seats, :description, :imagePath, :price, :location, :size, :address,:address_complement,:postal_code,:city, :projector, :wifi, :coffee, :water, :paperboard, :tv, :toilets, :parking, :disabledAccess, :airConditioning)');
        $query->execute([
            'name' => $room->getName(),
            'capacity' => $room->getCapacity(),
            'seats' => $room->getSeats(),
            'description' => $room->getDescription(),
            'imagePath' => $room->getImagePath(),
            'price' => $room->getPrice(),
            'location' => $room->getLocation(),
            'size' => $room->getSize(),
            'address' => $room->getAddress(),
            'address_complement' => $room->getAddressComplement(),
            'postal_code' => $room->getPostalCode(),
            'city' => $room->getCity(),
            'projector' => $room->getProjector(),
            'wifi' => $room->getWifi(),
            'coffee' => $room->getCoffee(),
            'water' => $room->getWater(),
            'paperboard' => $room->getPaperboard(),
            'tv' => $room->getTv(),
            'toilets' => $room->getToilets(),
            'parking' => $room->getParking(),
            'disabledAccess' => $room->getDisabledAccess(),
            'airConditioning' => $room->getAirConditioning()
        ]);
        // return the id of the created room
        return $this->pdo->lastInsertId();

    }

    public function updateRoom($id, $data): void
{
    $fields = [];
    $params = ['id' => $id];

    // Définir les valeurs par défaut des champs de la salle à 0
    $defaultValues = [
        'projector',
        'wifi',
        'coffee',
        'water',
        'paperboard',
        'tv',
        'toilets',
        'parking',
        'disabledAccess',
        'airConditioning'
    ];
    foreach ($defaultValues as $field) {
        $fields[] = "$field = :$field";
        $params[$field] = 0;
    }

    foreach ($data as $key => $value) {
        if ($key === 'address_complement') {
            // Inclure address_complement même s'il est vide
            $fields[] = "$key = :$key";
            $params[$key] = $value;
        } elseif (!empty($value)) {
            $fields[] = "$key = :$key";
            $params[$key] = $value;
        } else {
            $fields[] = "$key = :$key";
            $params[$key] = 0;
        }
    }

    $sql = "UPDATE rooms SET " . implode(", ", $fields) . " WHERE id = :id";
    $statement = $this->pdo->prepare($sql);
    $statement->execute($params);

    if ($statement->rowCount() === 0) {
        throw new \Exception("Room not found or no changes were made");
    }
}





    

    public function deleteRoom(Room $room): void
    {
        $query = $this->pdo->prepare('DELETE FROM rooms WHERE id = :id');
        $query->execute([
            'id' => $room->getId()
        ]);
    }
    public function countRooms()
    {
        $statement = $this->pdo->query("SELECT COUNT(*) as count FROM rooms");
        $result = $statement->fetch();
        $count = $result['count']; // Extract the count value using the alias
        return $count;
    }
    public function getFirstRoom()
    {
        $query = $this->pdo->query("SELECT * FROM rooms LIMIT 1");
        $query->setFetchMode(\PDO::FETCH_CLASS, Room::class);
        $result = $query->fetch();
        if ($result === false) {
            throw new \Exception('Aucune salle ne correspond à cet ID');
        }
        return $result;
    }
    
    public function getFirstId()
    {
        $query = $this->pdo->query("SELECT id FROM rooms LIMIT 1");
        $query->setFetchMode(\PDO::FETCH_CLASS, Room::class);
        $result = $query->fetch();
        if ($result === false) {
            throw new \Exception('Aucune salle ne correspond à cet ID');
        }
        return $result->getId();
    }

}