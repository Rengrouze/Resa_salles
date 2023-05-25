<?php

require '../src/bootstrap.php';
require '../src/session.php';
use Calendar\Rooms;

$rooms = new Rooms(get_pdo());
$allRooms = $rooms->getRooms();

//changer href by looking at the option in the url
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
            <div class="col-md-4 mt-3">
                <div class="card border-0 bg-transparent text-white">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
                    <div class="card-img-overlay bg-primary">
                        <p class="card-text">
                            <?= $room->getName() ?>
                        </p>
                    </div>
                    <div class="card-overlay text-white">
                        <a class="text-decoration-none card-title text-white h3 mr-3"
                            href="../public/room-info.php?room=<?= $room->getId() ?>"><?= $textOption ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<!-- END OF card section -->

<?php

render('footer');

?>