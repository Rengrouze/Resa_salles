<?php
require '../src/bootstrap.php';
require '../src/adminSession.php';
require('../src/calendar.php');

use Calendar\Rooms;


$rooms = new Rooms(get_pdo());
// if get room is not set, redirect to room-picker.php
if (!isset($_GET['room'])) {
    header('Location: room-picker.php');
    exit();
}
$room = $rooms->getRoom($_GET['room']);


render_admin('header', ['title' => 'Reservation manuelle', 'style' => 'calendar.css']);
render_admin('asidemenu');
?>

<main class="app-main">
<div class="container">
    tet
</div>
</main>


<?php
render_admin('footer');
?>
