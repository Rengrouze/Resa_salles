<?php

require '../src/bootstrap.php';
require '../src/session.php';
use Calendar\Rooms;
use Calendar\Photos;

$rooms = new Rooms(get_pdo());
$photos = new Photos(get_pdo());
$allRooms = $rooms->getRooms();

// Changer href en fonction de l'option dans l'URL
$option = $_GET['option'] ?? 'room-info';

if ($option === 'room-info') {
    $textOption = 'Voir les informations';
} else {
    $textOption = 'Vérifier les disponibilités';
}

render('header', ['title' => 'Accueil', 'script' => 'index.js']);

?>

<!-- Content -->

<div class="container-fluid bg-light pt-4 pb-4">
    <div class="row">
        <?php foreach ($allRooms as $room): ?>
            <?php
            $photo = $photos->getIdMinPhotoByRoomId($room->getId());

            if ($photo === false) {
                $photoLink = 'https://via.placeholder.com/350x150';
            } else {
                $photoLink = '../public/images/room_images/' . $room->getId() . '/min/' . $photo->getId() . '.jpg';
            }
            ?>
            <div class="col-md-4 mt-3">
                <div class="card border-0 bg-transparent text-white">
                    <div class="card-img-wrapper">
                        <img src="<?= $photoLink ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="card-img-overlay bg-primary">
                        <p class="card-text">
                            <?= $room->getName() ?>
                        </p>
                    </div>
                    <div class="card-overlay text-white">
                        <a class="text-decoration-none card-title text-white h3 mr-3" href="../public/room-info.php?room=<?= $room->getId() ?>"><?= $textOption ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .card-img-wrapper {
        height: 350px;
        overflow: hidden;
    }

    .card-img-wrapper img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
</style>

<!-- END OF card section -->

<?php

render('footer');

?>
