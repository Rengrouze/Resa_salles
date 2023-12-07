<?php

use Calendar\Photos;
use Calendar\Rooms;

require '../src/bootstrap.php';

$photos = new Photos(get_pdo());
$rooms = new Rooms(get_pdo());

try {
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Error uploading the file1');
    }

    $fileInfo = $_FILES['photo'];

    $roomId = $_POST['id'];

    $newFileName = uniqid() . '.jpg'; // Générer un nom de fichier unique avec l'extension JPG
    $targetDirectory = '../public/images/room_images/' . $roomId . '/min/temp/';
    $targetPath = $targetDirectory . $newFileName;

    // Vérifier si le répertoire existe, sinon le créer
    if (!is_dir($targetDirectory)) {
        if (!mkdir($targetDirectory, 0777, true)) {
            throw new Exception('Failed to create directory');
        }
    }

    if (!move_uploaded_file($fileInfo['tmp_name'], $targetPath)) {
        throw new Exception('Error moving the file2');
    }

    // Redirection vers la page de traitement d'image
    header('Location: http://resasite/traitement-image/accueil_photo.php?roomId=' . $roomId . '&filename=' . $newFileName);
} catch (Exception $e) {
    echo $e->getMessage();
}
