<?php
require '../src/bootstrap.php';

render_admin('header', ['title' => 'Mon compte', 'script' => 'index.js']);

if (!isset($_SESSION['auth-admin'])) {
    header('Location: login.php');
    exit();
}

use Calendar\{
    Clients,
    Bookings,
    Rooms
};

echo "test";