<?php
require '../src/bootstrap.php';

render ('header', ['title' => 'Mon compte', 'script' => 'index.js']);

if (!isset($_SESSION['auth-admin'])) {
    header('Location: ../public/admin/login.php');
    exit();
}

use Calendar\{
    Clients,
    Bookings,
    Rooms
};

echo "test";