<?php

namespace Calendar;

class Photos
{

    private $pdo;


    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function getPhotosByRoom(int $id_room)
{
    // Exclude where min = 1
    $query = $this->pdo->prepare('SELECT * FROM photos WHERE id_room = :id_room AND min = 0');
    $query->execute(['id_room' => $id_room]);
    $query->setFetchMode(\PDO::FETCH_CLASS, Photo::class);
    $result = $query->fetchAll();
    return $result;
}




    public function getPhoto(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM photos WHERE id = :id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Photo::class);
        $result = $query->fetch(\PDO::FETCH_CLASS);
        return $result;
    }

    public function deletePhoto(Photo $photo)
{
    $query = $this->pdo->prepare('DELETE FROM photos WHERE id = :id');
    $query->execute(['id' => $photo->getId()]);

    // Vérifier si c'est une miniature ou non
    $isMin = $photo->getMin() == 1;

    // Supprimer l'image du dossier correspondant
    $roomId = $photo->getIdRoom();
    $filename = $photo->getId() . '.jpg';
    $path = '../public/images/room_images/' . $roomId . '/' . ($isMin ? 'min/' : '') . $filename;
   

    if (file_exists($path)) {
        unlink($path);
    }
}

   


    public function deletePhotosByRoom(int $id_room)
    {
        $query = $this->pdo->prepare('DELETE FROM photos WHERE id_room = :id_room');
        $query->execute(['id_room' => $id_room]);
    }

    public function hydratePhoto(Photo $photo, array $data)
    {
        $photo->setRoomId($data['id_room']);
    
        // Vérifier si la clé 'min' existe dans le tableau $data
        // et si elle n'est pas vide, sinon définir la valeur par défaut à 0
        $min = isset($data['min']) && $data['min'] !== '' ? $data['min'] : 0;
        $photo->setMin($min);
    
        return $photo;
    }
    


    public function addPhoto(Photo $photo)
    {
        $query = $this->pdo->prepare('INSERT INTO photos (id_room, min) VALUES (:id_room, :min)');
        $query->execute([
            'id_room' => $photo->getIdRoom(),
            'min' => $photo->getMin()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function makeMin(Photo $photo)
    {
        $query = $this->pdo->prepare('UPDATE photos SET min = 1 WHERE id = :id');
        $query->execute(['id' => $photo->getId()]);
    }

    public function makeNotMin(Photo $photo)
    {
        $query = $this->pdo->prepare('UPDATE photos SET min = 0 WHERE id = :id');
        $query->execute(['id' => $photo->getId()]);
    }

    public function getIdMinPhotoByRoomId(int $id_room)
    {
        $query = $this->pdo->prepare('SELECT id FROM photos WHERE id_room = :id_room AND min = 1');
        $query->execute(['id_room' => $id_room]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Photo::class);
        $result = $query->fetch(\PDO::FETCH_CLASS);
        return $result;
        
    }

    public function getMinPhotoById(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM photos WHERE id = :id AND min = 1');
        $query->execute(['id' => $id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Photo::class);
        $result = $query->fetch(\PDO::FETCH_CLASS);
        return $result;
    }
    public function countPhotosByRoom(int $id_room): int
{
    // do not count min = 1
    $query = $this->pdo->prepare('SELECT COUNT(*) FROM photos WHERE id_room = :id_room AND min = 0');
    $query->execute(['id_room' => $id_room]);
    $result = $query->fetchColumn();
    return intval($result);
}





}
