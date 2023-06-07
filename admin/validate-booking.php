<?php

use Calendar\Bookings;

require '../src/bootstrap.php';
require '../src/adminSession.php';

// get the id of the event
$id = $_GET['id'];
$bookings = new Bookings(get_pdo());
$bookings->confirmEventAndAssociatedBookings($id);
header('Location: validated-events.php?id=' . $id);