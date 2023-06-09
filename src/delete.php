<?php

require '../src/bootstrap.php';


use Calendar\{
    Bookings,
    Clients,
    Rooms
};

session_start();

$events = new Bookings(get_pdo());
$rooms = new Rooms(get_pdo());
$clients = new Clients(get_pdo());


// Vérifier si l'ID de l'événement est passé dans l'URL
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // get user info with the id of the event
    $event = $events->getEventById($eventId);
    $clientId = $event->getIdClient();
    $client = $clients->findClientById($clientId);
    $clientEmail = $client->getEmail();

    // get room info with the id of the event
    $roomId = $event->getRoomId();
    $room = $rooms->getRoom($roomId);

    $days = $event->getDays();

    $days = explode(',', $days);

    $daysForDisplay = $days;



    array_walk($daysForDisplay, function (&$day) {
        $date = new DateTime($day);
        $day = $date->format('d/m/Y');
    });

    require '../src/MailController/mail-controller.php';

    $destinataire = $client->getEmail();
    $objet = "Confirmation de l'annulation de votre réservation";
    $contenu = "Bonjour " . $clientName . ",<br>
    Nous avons bien reçu votre demande d'annulation de réservation pour la salle " . $room->getName() . " pour les jours suivants : " . implode(", ", $daysForDisplay) . ".<br>
    Nous vous confirmons que votre demande d'annulation a été prise en compte avec succès.<br>
    Votre réservation a été annulée.<br>
    Si vous avez des questions ou besoin d'une assistance supplémentaire, n'hésitez pas à nous contacter.<br>
    Nous vous remercions de votre compréhension et espérons vous revoir prochainement.<br>
    L'équipe de ResaSite";

    sendmail($objet, $contenu, $destinataire);

    // Appeler la fonction de suppression de l'événement
    $events->deleteEventAndBookings($eventId);


    // Rediriger vers la page de récapitulatif après la suppression
    header('Location: ../public/profile.php?delete=success');
    exit();
}

?>