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
    }

    public function createRoom(Room $room): void
    {
        $query = $this->pdo->prepare('INSERT INTO rooms (name, capacity, seats, description, imagePath, price, location, size, projector, wifi, coffee, water, paperboard, tv, toilets, parking, disabledAccess, airConditioning) VALUES (:name, :capacity, :seats, :description, :imagePath, :price, :location, :size, :projector, :wifi, :coffee, :water, :paperboard, :tv, :toilets, :parking, :disabledAccess, :airConditioning)');
        $query->execute([
            'name' => $room->getName(),
            'capacity' => $room->getCapacity(),
            'seats' => $room->getSeats(),
            'description' => $room->getDescription(),
            'imagePath' => $room->getImagePath(),
            'price' => $room->getPrice(),
            'location' => $room->getLocation(),
            'size' => $room->getSize(),
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
    }

    public function updateRoom(Room $room): void
    {
        $query = $this->pdo->prepare('UPDATE rooms SET name = :name, capacity = :capacity, seats = :seats, description = :description, imagePath = :imagePath, price = :price, location = :location, size = :size, projector = :projector, wifi = :wifi, coffee = :coffee, water = :water, paperboard = :paperboard, tv = :tv, toilets = :toilets, parking = :parking, disabledAccess = :disabledAccess, airConditioning = :airConditioning WHERE id = :id');
        $query->execute([
            'id' => $room->getId(),
            'name' => $room->getName(),
            'capacity' => $room->getCapacity(),
            'seats' => $room->getSeats(),
            'description' => $room->getDescription(),
            'imagePath' => $room->getImagePath(),
            'price' => $room->getPrice(),
            'location' => $room->getLocation(),
            'size' => $room->getSize(),
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
    }

    public function deleteRoom(Room $room): void
    {
        $query = $this->pdo->prepare('DELETE FROM rooms WHERE id = :id');
        $query->execute([
            'id' => $room->getId()
        ]);
    }

}