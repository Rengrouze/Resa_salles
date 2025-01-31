<?php
require '../src/bootstrap.php';


require '../src/session.php'; 

render('header', ['title' => 'Mon compte', 'script' => 'index.js']);


if (!isset($_SESSION['auth'])) {
    header('Location: ../public/login.php');
    exit();
}

use Calendar\{
    Clients,
    Bookings,
    Rooms
};

$events = new Bookings(get_pdo());
$clients = new Clients(get_pdo());
$rooms = new Rooms(get_pdo());
// 

$client = $_SESSION['auth'];
$id = $client->getId();
$allUnValidatedEvents = $events->getAllUnValidatedEventsByClient($id);
$allValidatedEvents = $events->getAllValidatedEventsByClient($id);



?>

<!-- Content -->
<div class="container mb-5 mt-3">
    <div class="col-md-6">
        <h2>Informations du client</h2>
        <ul class="list-group">
            <li class="list-group-item">Nom :
                <?= $client->getName(); ?>
            </li>
            <li class="list-group-item">Prénom :
                <?= $client->getFirstName(); ?>
            </li>
            <li class="list-group-item">Email :
                <?= $client->getEmail(); ?>
            </li>
            <li class="list-group-item">Téléphone :
                <?= $client->getPhone(); ?>
            </li>
            <li class="list-group-item">Entreprise :
                <?= $client->getBusiness(); ?>
            </li>
            <li class="list-group-item">SIRET :
                <?= $client->getSiret(); ?>
            </li>
            <li class="list-group-item">Adresse :
                <?= $client->getAddress(); ?>
            </li>
            <li class="list-group-item">Ville :
                <?= $client->getCity(); ?>
            </li>
            <li class="list-group-item">Code postal :
                <?= $client->getPostalCode(); ?>
            </li>
            <li class="list-group-item">Pays :
                <?= $client->getCountry(); ?>
            </li>
            <input type="hidden" name="client_id" value="<?= $client->getId(); ?>">
        </ul>
    </div>
    <div class="container mt-5">
        <!-- Afficher le message de succès si présent -->
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success" role="alert">
                <?= $successMessage ?>
            </div>
        <?php endif; ?>
        <h1>Vos réservations en attente de validation</h1>
        <div class="table-responsive">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Salle</th>
                        <th>Jours</th>
                        <th>Motif</th>
                        <th>Nombre de Jours</th>
                        <th>Prix Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allUnValidatedEvents as $event): ?>


                        <tr>
                            <td>
                                <?php $roomId = $event->getRoomId(); ?>


                                <?= $rooms->getRoomNameById($roomId); ?>
                            </td>
                            <td>
                                <?php
                                $days = explode(',', $event->getDays());
                                $firstDay = date('d/m/Y', strtotime($days[0]));
                                $lastDay = date('d/m/Y', strtotime(end($days)));
                                echo $firstDay . ' - ' . $lastDay;
                                ?>
                            </td>
                            <td>
                                <?= $event->getReason() ?>
                            </td>
                            <td>
                                <?php
                                $daysCount = count(explode(',', $event->getDays()));
                                echo $daysCount;
                                ?>
                            </td>
                            <td>
                                <?= $event->getTotalPrice() ?> €
                            </td>
                            <td>
                                <a href="confirmbooking.php?id=<?= $event->getId() ?>" class="btn btn-primary btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <a href="../src/delete.php?id=<?= $event->getId() ?>" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="container mt-5">
            <!-- Afficher le message de succès si présent -->
            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success" role="alert">
                    <?= $successMessage ?>
                </div>
            <?php endif; ?>
            <h1>Vos réservations validées</h1>
            <div class="table-responsive">
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Salle</th>
                            <th>Jours</th>
                            <th>Motif</th>
                            <th>Nombre de Jours</th>
                            <th>Prix Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allValidatedEvents as $event): ?>


                            <tr>
                                <td>
                                    <?php $roomId = $event->getRoomId(); ?>


                                    <?= $rooms->getRoomNameById($roomId); ?>
                                </td>
                                <td>
                                    <?php
                                    $days = explode(',', $event->getDays());
                                    $firstDay = date('d/m/Y', strtotime($days[0]));
                                    $lastDay = date('d/m/Y', strtotime(end($days)));
                                    echo $firstDay . ' - ' . $lastDay;
                                    ?>
                                </td>
                                <td>
                                    <?= $event->getReason() ?>
                                </td>
                                <td>
                                    <?php
                                    $daysCount = count(explode(',', $event->getDays()));
                                    echo $daysCount;
                                    ?>
                                </td>
                                <td>
                                    <?= $event->getTotalPrice() ?> €
                                </td>
                                <td>
                                    <!-- make a mail button -->
                                    <a href="mailto:<?= $client->getEmail(); ?>" class="btn btn-primary btn-sm"><i
                                            class="fas fa-envelope"></i></a>
                                    <a href="../src/delete.php?id=<?= $event->getId() ?>" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i></a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="index.php" class="btn btn-primary mt-4"><i class="fas fa-arrow-left"></i> Retour à l'Accueil</a>
        </div>


        <!-- end content -->

        <?php
        render('footer');