<?php
// delete-room.php

require '../src/bootstrap.php';
use Calendar\Rooms;
use Calendar\Bookings;

// Include the necessary files and initialize any required dependencies

// Retrieve the room ID from the query parameters
$roomId = $_GET['id'];

// Create an instance of the Rooms class
$rooms = new Rooms(get_pdo());
$bookings = new Bookings(get_pdo());

// Retrieve the room object from the database based on the ID
$room = $rooms->getRoom($roomId);

if ($room) {
    // Call the deleteRoom function
    $rooms->deleteRoom($room);
    //also delete every booking associated with this room
    $bookings->deleteEventAndBookingByRoom($roomId);

    // Room deleted successfully
    // Redirect to the rooms page
    header('Location: /admin/rooms.php');
} else {
    // Room not found
    // Handle the error
    // Redirect or show an error message
    echo "Room not found.";
}
