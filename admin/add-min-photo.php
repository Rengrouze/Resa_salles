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
        // Si ce n'est pas une extension valide, convertir en JPG
        $image = imagecreatefromstring(file_get_contents($fileInfo['tmp_name']));
        $newFileName = $lastInsertId . '.jpg';
        $targetDirectory = '../public/images/room_images/' . $roomId . '/min/';
        $targetPath = $targetDirectory . $newFileName;

        // Vérifier si le répertoire existe, sinon le créer
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) {
                throw new Exception('Failed to create directory');
            }
        }

        // Enregistrer l'image convertie en JPG
        imagejpeg($image, $targetPath, 100);
        imagedestroy($image);
    } else {
        $roomId = $_POST['id'];
        $minValue = isset($_POST['min']) ? intval($_POST['min'], 10) : 0;

        $photo = $photos->hydratePhoto(new \Calendar\Photo(), ['id_room' => $roomId, 'min' => $minValue]);
        $lastInsertId = $photos->addPhoto($photo);

        $newFileName = $lastInsertId . '.jpg'; // Changer l'extension en JPG
        $targetDirectory = '../public/images/room_images/' . $roomId . '/min/';
        $targetPath = $targetDirectory . $newFileName;

        // Vérifier si le répertoire existe, sinon le créer
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) {
                throw new Exception('Failed to create directory');
            }
        }

        if (!move_uploaded_file($fileInfo['tmp_name'], $targetPath)) {
            throw new Exception('Error moving the file');
        }
    }

    header('Location: rooms.php?id=' . $roomId . "&photos=added");
} catch (Exception $e) {
    echo $e->getMessage();
}
