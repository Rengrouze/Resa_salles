<?php

use Calendar\Photos;
use Calendar\Rooms;

require '../src/bootstrap.php';

$photos = new Photos(get_pdo());
$rooms = new Rooms(get_pdo());


try {
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Error uploading the file');
    }

    $fileInfo = $_FILES['photo'];

  

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $fileExtension = strtolower(pathinfo($fileInfo['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        throw new Exception('Invalid file extension');
    }

    $roomId = $_POST['id'];

    $minValue = isset($_POST['min']) ? intval($_POST['min'], 10) : 0;

    $photo = $photos->hydratePhoto(new \Calendar\Photo(), ['id_room' => $roomId, 'min' => $minValue]);



    $lastInsertId = $photos->addPhoto($photo);
    

    $newFileName = $lastInsertId . '.' . $fileExtension;
    $targetPath = '../public/images/room_images/' . $roomId . '/min/' . $newFileName;

    if (!move_uploaded_file($fileInfo['tmp_name'], $targetPath)) {
        throw new Exception('Error moving the file');
    }

    
    header('Location: rooms.php?id=' . $roomId."&photos=added");
} catch (Exception $e) {
    echo $e->getMessage();
}
