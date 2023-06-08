<?php

use Calendar\Photos;


require '../src/bootstrap.php';

$photos = new Photos(get_pdo());

if (isset($_GET['id'])) {
    $photoId = $_GET['id'];
    $photo = $photos->getPhoto($photoId);

    if ($photo) {
        $photos->deletePhoto($photo);
        // Redirection vers la page rooms.php
        header('Location: rooms.php?photos=deleted');
        exit();
    }
}

// En cas d'erreur ou si l'ID de la photo n'est pas spécifié, rediriger vers la page rooms.php
header('Location: rooms.php?photos=error');
exit();
