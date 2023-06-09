<?php

use Calendar\Photos;
use Calendar\Rooms;

require '../src/bootstrap.php';

$photos = new Photos(get_pdo());
$rooms = new Rooms(get_pdo());

try {
    if (!isset($_FILES['photos']) || !is_array($_FILES['photos'])) {
        throw new Exception('No files uploaded');
    }

    $fileInfoList = $_FILES['photos'];

    $roomId = $_POST['id'];

    $totalPhotos = $photos->countPhotosByRoom($roomId);

    if ($totalPhotos >= 10) {
        throw new Exception('Maximum number of photos exceeded');
    }

    foreach ($fileInfoList['tmp_name'] as $index => $tmpName) {
        $fileInfo = [
            'name' => $fileInfoList['name'][$index],
            'type' => $fileInfoList['type'][$index],
            'tmp_name' => $tmpName,
            'error' => $fileInfoList['error'][$index],
            'size' => $fileInfoList['size'][$index],
        ];

        if ($fileInfo['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error uploading file: ' . $fileInfo['name']);
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($fileInfo['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            // Si ce n'est pas une extension valide, convertir en JPG
            $image = imagecreatefromstring(file_get_contents($fileInfo['tmp_name']));
            $newFileName = $lastInsertId . '.jpg';
            $targetDirectory = '../public/images/room_images/' . $roomId . '/';
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
            $photo = $photos->hydratePhoto(new \Calendar\Photo(), ['id_room' => $roomId]);
            $lastInsertId = $photos->addPhoto($photo);

            $newFileName = $lastInsertId . '.jpg'; // Changer l'extension en JPG
            $targetDirectory = '../public/images/room_images/' . $roomId . '/';
            $targetPath = $targetDirectory . $newFileName;

            // Vérifier si le répertoire existe, sinon le créer
            if (!is_dir($targetDirectory)) {
                if (!mkdir($targetDirectory, 0777, true)) {
                    throw new Exception('Failed to create directory');
                }
            }

            if (!move_uploaded_file($fileInfo['tmp_name'], $targetPath)) {
                throw new Exception('Error moving file: ' . $fileInfo['name']);
            }
        }
    }

    header('Location: rooms.php?id=' . $roomId . "&photos=added");
} catch (Exception $e) {
    echo $e->getMessage();
}
