<?php
// create_room.php

require '../src/bootstrap.php';
use Calendar\Rooms;

// Include the necessary files and initialize any required dependencies

// Retrieve the form data
$data = $_POST;
var_dump($data);

// Create an instance of the Rooms class
$rooms = new Rooms(get_pdo());

// Create a new instance of Room

// Set default values for checkboxes if they are not checked
$checkboxes = ['projector', 'wifi', 'coffee', 'water', 'paperboard', 'tv', 'toilets', 'parking', 'disabledAccess', 'airConditioning'];
foreach ($checkboxes as $checkbox) {
    if (!isset($data[$checkbox])) {
        $data[$checkbox] = 0;
    }
}

// Hydrate the Room object with the form data
$room = $rooms->hydrateRoom(new \Calendar\Room(), $data);


var_dump($room);
// Call the createRoom function
try {
    $newId=$rooms->createRoom($room);
    // Room created successfully
    // Redirect to the room page with the id of the created room
    header('Location: /admin/rooms.php?id=' . $newId);
} catch (\Exception $e) {
    // Handle the exception
    $errorMessage = $e->getMessage();
    var_dump($errorMessage);
    
    // You can redirect or show an error message here
}
