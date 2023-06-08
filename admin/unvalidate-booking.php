<?php

use Calendar\Bookings;
use Calendar\Rooms;
use Calendar\Clients;

require '../src/bootstrap.php';
require '../src/adminSession.php';

try {
    // get the id of the event
    $id = $_GET['id'];
    $bookings = new Bookings(get_pdo());
    $bookings->unconfirmEventAndAssociatedBookings($id);

    require '../src/MailController/mail-controller.php';

    // Retrieve event information for email
    $event = $bookings->getEventById($id);
    $id_room = $event->getRoomId();
    $id_client = $event->getIdClient();

    $rooms = new Rooms(get_pdo());
    $room = $rooms->getRoom($id_room);

    $clients = new Clients(get_pdo());
    $client = $clients->findClientById($id_client);

    $destinataire = $client->getEmail();
    $objet = "Annulation de votre réservation";
    $contenu = "Nous vous informons que votre réservation pour la salle " . $room->getName() . " a été annulée.\n\nNous vous prions de nous excuser pour ce désagrément et restons à votre disposition pour toute information supplémentaire.\n\nCordialement,\nL'équipe de ResaSite";

    sendmail($objet, $contenu, $destinataire);

    header('Location: unvalidated-events.php?id=' . $id);
} catch (Exception $e) {
    // Handle any exceptions here
    echo "An error occurred: " . $e->getMessage();
}
?>
