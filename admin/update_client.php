<?php
// update_client.php

require '../src/bootstrap.php';
use Calendar\Clients;
// Include the necessary files and initialize any required dependencies

// Retrieve the form data
$id = $_POST['id'];

// Initialize an empty array to store the non-empty fields
$data = [];

// Iterate through the $_POST array and add non-empty fields to the $data array

foreach ($_POST as $key => $value) {
    if ($key === 'address_complement') {
        // Handle exception for address_complement field
        $data[$key] = $value;
    } elseif (!empty($value)) {
        $data[$key] = $value;
    }
}



// Create an instance of the Clients class
$clients = new Clients(get_pdo());

// Call the updateClient function
try {
    $clients->updateClient($id, $data);
    // Client updated successfully
    // Redirect to the client page with the id of the updated client
    header('Location: /admin/clients.php?id=' . $id);
} catch (\Exception $e) {
    // Handle the exception
    $errorMessage = $e->getMessage();
    // You can redirect or show an error message here
}
