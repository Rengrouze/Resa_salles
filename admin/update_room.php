<?php
// update_room.php

require '../src/bootstrap.php';
use Calendar\Rooms;

// Include the necessary files and initialize any required dependencies

// Retrieve the form data
$id = $_POST['id'];



// Initialize an empty array to store the non-empty fields
$data = [];



// Iterate through the $_POST array and add non-empty fields to the $data array
foreach ($_POST as $key => $value) {
    if (!empty($value)) {
        $data[$key] = $value;
    }
}


// Create an instance of the Rooms class
$rooms = new Rooms(get_pdo());

// Call the updateRoom function
try {
    $rooms->updateRoom($id, $data);
    // Room updated successfully
    // Redirect to the room page with the id of the updated room
    header('Location: /admin/rooms.php?id=' . $id);
} catch (\Exception $e) {
    // Handle the exception
    $errorMessage = $e->getMessage();
    
    
    // You can redirect or show an error message here
}
