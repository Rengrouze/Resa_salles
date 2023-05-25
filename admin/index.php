<?php
require '../src/bootstrap.php';
require '../src/adminSession.php';
render_admin('header', ['title' => 'Mon compte', 'script' => 'index.js']);



use Calendar\{
    Clients,
    Bookings,
    Rooms
};

$clients = new Clients(get_pdo());
$rooms = new Rooms(get_pdo());
$bookings = new Bookings(get_pdo());




?>
<div class="container-fluid">
<div class="row">
        <div class="col-lg-2 col-md-3">
            <ul class="nav flex-column nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="clients-tab" data-toggle="tab" href="#clients" role="tab"
                        aria-controls="clients" aria-selected="true">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="salles-tab" data-toggle="tab" href="#salles" role="tab"
                        aria-controls="salles" aria-selected="false">Salles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="attente-tab" data-toggle="tab" href="#attente" role="tab"
                        aria-controls="attente" aria-selected="false">Réservations en attente de validation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reservations-tab" data-toggle="tab" href="#reservations" role="tab"
                        aria-controls="reservations" aria-selected="false">Réservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin"
                        aria-selected="false">Utilisateurs admin</a>
                </li>
            </ul>
            <a class="btn btn-danger mt-4" href="../src/logout.php">Déconnexion</a>
        </div>
        <div class="col-10">
            <div class="tab-content mt-4" id="myTabsContent">
                <div class="tab-pane fade show active" id="clients" role="tabpanel" aria-labelledby="clients-tab">
                    <h4>Clients</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Entreprise</th>
                                <th scope="col">SIRET</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Complément d'adresse</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Code postal</th>
                                <th scope="col">Compte activé</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allClients = $clients->findAllClients();
                            ?>
                            <?php foreach ($allClients as $client): ?>
                                <tr>
                                    <th scope="row">
                                        <?= $client->getId() ?>
                                    </th>
                                    <td>
                                        <?= $client->getName() ?>
                                    </td>
                                    <td>
                                        <?= $client->getFirstName() ?>
                                    </td>
                                    <td>
                                        <?= $client->getEmail() ?>
                                    </td>
                                    <td>
                                        <?= $client->getPhone() ?>
                                    </td>
                                    <td>
                                        <?= $client->getBusiness() ?>
                                    </td>
                                    <td>
                                        <?= $client->getSiret() ?>
                                    </td>
                                    <td>
                                        <?= $client->getAddress() ?>
                                    </td>
                                    <td>
                                        <?= $client->getAddressComplement() ?>
                                    </td>
                                    <td>
                                        <?= $client->getCity() ?>
                                    </td>
                                    <td>
                                        <?= $client->getPostalCode() ?>
                                    </td>
                                    <td>
                                        <?= $client->getActivated() ?>
                                    </td>


                                </tr>
                            <?php endforeach ?>

                            <!-- Contenu du tableau pour la section "Clients" -->
                    </table>
                </div>
                <div class="tab-pane fade" id="salles" role="tabpanel" aria-labelledby="salles-tab">
                    <h4>Salles</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom de la salle</th>
                                <th scope="col">Capacité</th>
                                <th scope="col">Siège</th>
                                <th scope="col">Description</th>
                                <th scope="col">Prix par jour en €</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Taille en m²</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allRooms = $rooms->getRooms();
                            ?>
                            <?php foreach ($allRooms as $room): ?>
                                <tr>
                                    <th scope="row">
                                        <?= $room->getId() ?>
                                    </th>
                                    <td>
                                        <?= $room->getName() ?>
                                    </td>
                                    <td>
                                        <?= $room->getCapacity() ?>
                                    </td>
                                    <td>
                                        <?= $room->getSeats() ?>
                                    </td>
                                    <td>
                                        <?= $room->getDescription() ?>
                                    </td>
                                    <td>
                                        <?= $room->getPrice() ?> €
                                    </td>
                                    <td>
                                        <?= $room->getLocation() ?>
                                    </td>
                                    <td>
                                        <?= $room->getSize() ?> m²
                                    </td>
                                    <td>
                                        <a href="editRoom.php?id=<?= $room->getId() ?>" class="btn btn-primary">Modifier</a>
                                        <a href="deleteRoom.php?id=<?= $room->getId() ?>"
                                            class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                            <!-- Contenu du tableau pour la section "Salles" -->
                    </table>
                </div>
                <div class="tab-pane fade" id="attente" role="tabpanel" aria-labelledby="attente-tab">
                    <h4>Réservations en attente de validation</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Client</th>
                                <th scope="col">Salle</th>
                                <th scope="col">Jours</th>
                                <th scope="col">Motif</th>
                                <th scope="col">Nombre de Jours</th>
                                <th scope="col">Prix Total</th>
                                <th scope="col">Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allTemporaryEvents = $bookings->getAllTemporaryEvents();
                            ?>
                            <?php foreach ($allTemporaryEvents as $temporaryEvent): ?>
                                <tr>
                                    <td>
                                        <?= $temporaryEvent->getId() ?>
                                      
                                    </td>
                                    <td>
                                        <?= $clientName = $clients->findClientNameById($temporaryEvent->getIdClient()) ?>
                                      

                                    </td>
                                    <td>
                                        <?= $roomName = $rooms->getRoomNameById($temporaryEvent->getRoomId()) ?>
                                    <td>
                                        <?= $temporaryEvent->getDays() ?>
                                    </td>
                                    <td>
                                        <?= $temporaryEvent->getReason() ?>
                                    </td>
                                    <td>
                                        <?= $temporaryEvent->getNumberOfDays() ?>
                                    </td>
                                    <td>
                                        <?= $temporaryEvent->getTotalPrice() ?> €
                                    </td>
                                    <td>
                                        <a href="editBooking.php?id=<?= $temporaryEvent->getId() ?>"
                                            class="btn btn-primary">Modifier</a>
                                        <a href="deleteBooking.php?id=<?= $temporaryEvent->getId() ?>"
                                            class="btn btn-danger">Supprimer</a>
                                            <a href="../admin/validate-booking.php?id=<?= $temporaryEvent->getId() ?>"
                                            class="btn btn-success">Valider</a>
                                    </td>
                                    


                                </tr>
                            <?php endforeach ?>

                            <!-- Contenu du tableau pour la section "Réservations" -->
                    </table>
                </div>
                <div class="tab-pane fade" id="reservations" role="tabpanel" aria-labelledby="reservations-tab">
               
                    <h4>Réservations</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Client</th>
                                <th scope="col">Salle</th>
                                <th scope="col">Jours</th>
                                <th scope="col">Motif</th>
                                <th scope="col">Nombre de Jours</th>
                                <th scope="col">Prix Total</th>
                                <th scope="col">Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allEvents = $bookings->getAllNonTemporaryEvents();
                            ?>
                            <?php foreach ($allEvents as $event): ?>
                                <tr>
                                    <td>
                                        <?= $event->getId() ?>
                                    </td>
                                    <td>
                                        <?= $clientName = $clients->findClientNameById($event->getIdClient()) ?>
                                    </td>
                                    <td>
                                        <?= $roomName = $rooms->getRoomNameById($event->getRoomId()) ?>
                                    </td>
                                    <td>
                                        <?= $event->getDays() ?>
                                    </td>
                                    <td>
                                        <?= $event->getReason() ?>
                                    </td>
                                    <td>
                                        <?= $event->getNumberOfDays() ?>
                                    </td>
                                    <td>
                                        <?= $event->getTotalPrice() ?> €
                                    </td>
                                    <td>
                                        <a href="editBooking.php?id=<?= $event->getId() ?>"
                                            class="btn btn-primary">Modifier</a>
                                        <a href="deleteBooking.php?id=<?= $event->getId() ?>"
                                            class="btn btn-danger">Supprimer</a>

                                        <a href="../admin/unvalidate-booking.php?id=<?= $event->getId() ?>"
                                            class="btn btn-warning">Annuler</a>
                                
                                    </td>
                                   
                                </tr>
                            <?php endforeach ?>

                            <!-- Contenu du tableau pour la section "Réservations" -->
                        <!-- Contenu du tableau pour la section "Réservations en attente de validation" -->
                    </table>
                </div>
                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <h4>Utilisateurs admin</h4>
                    <table class="table">
                        <!-- Contenu du tableau pour la section "Utilisateurs admin" -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php render_admin('footer'); ?>