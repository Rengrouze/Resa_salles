<?php

require '../src/bootstrap.php';

use Calendar\{
    Bookings,
    Clients
};

session_start();

$events = new Bookings(get_pdo());
$clients = new Clients(get_pdo());

// Vérifier si l'ID de l'événement est passé dans l'URL
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];
    // Appeler la fonction de suppression de l'événement
    $events->deleteEventAndBookings($eventId);
    // Rediriger vers la page de récapitulatif après la suppression
    header('Location: ../public/profile.php?delete=success');
    exit();
}

?>