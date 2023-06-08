<?php

require '../src/bootstrap.php';
require '../src/adminSession.php';

use Calendar\Bookings;
use Calendar\Rooms;
use Calendar\Clients;

try {
    // get the id of the event
    $id = $_GET['id'];
    $bookings = new Bookings(get_pdo());
    
    // with the id of the event, get the room and the client
    $event = $bookings->getEventById($id);
    $id_room = $event->getRoomId();
    $id_client = $event->getIdClient();
    
    $rooms = new Rooms(get_pdo());
    $room = $rooms->getRoom($id_room);
    
    $clients = new Clients(get_pdo());
    $client = $clients->findClientById($id_client);
    
    
    

    // get the days of the event
    $days = $event->getDays();
    // destructure the string into an array
    $days = explode(',', $days);
    
    $daysForDisplay = $days;
    // format the days for display to d/m/Y
    foreach ($daysForDisplay as $key => $day) {
        $daysForDisplay[$key] = date('d/m/Y', strtotime($day));
    }


    require '../src/MailController/mail-controller.php';
    
    $destinataire = $client->getEmail();
    $objet = "Confirmation de votre réservation";
    $contenu = "Nous confirmons votre demande de réservation pour la salle " . $room->getName() . " pour les jours suivants : " . implode(", ", $daysForDisplay) . ".\n\nUne facture détaillée vous sera envoyée prochainement par e-mail.\n\nNous vous remercions de votre confiance.\n\nCordialement,\nL'équipe de ResaSite";
  
    $bookings->confirmEventAndAssociatedBookings($id);
    sendmail($objet, $contenu, $destinataire);

    header('Location: validated-events.php?id=' . $id);
} catch (Exception $e) {
    // Handle any exceptions here
    echo "An error occurred: " . $e->getMessage();
}
?>
