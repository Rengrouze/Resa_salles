<?php
require '../src/bootstrap.php';
require '../src/adminSession.php';

use Calendar\Rooms;
use Calendar\Photos;

$rooms = new Rooms(get_pdo());
$photos = new Photos(get_pdo());
$allRooms = $rooms->getRooms();

render_admin('header', ['title' => 'Choisir une salle', 'script' => 'index.js']);
render_admin('asidemenu');
?>

<main class="app-main">
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
                    <a href="../admin/manual-booking.php?room=<?= $room->getId() ?>" class="card border-0 bg-transparent text-white">
                        <div class="card-img-wrapper">
                            <img src="<?= $photoLink ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body bg-primary">
                            <h5 class="card-title"><?= $room->getName() ?></h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<style>
    .card-img-wrapper {
        height: 350px;
        overflow: hidden;
        position: relative;
    }

    .card-img-wrapper img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .card-body {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 0.5rem;
    }
</style>

<?php
render_admin('footer');
?>
