<?php
require '../src/bootstrap.php';
require '../src/adminSession.php';
require('../src/calendar.php');

use Calendar\Rooms;
use Calendar\Bookings;




$rooms = new Rooms(get_pdo());
$bookings = new Bookings(get_pdo());



// if get room is not set, redirect to room-picker.php
// if get room or days is not set, redirect to room-picker.php
if (!isset($_GET['room']) || !isset($_GET['days'])) {
    header('Location: room-picker.php');
    exit();
}

$room = $rooms->getRoom($_GET['room']);
$days = $_GET['days'];

// create an array from the days string
$days = explode(',', $days);




// if room is not found, redirect to room-picker.php
if (!$room) {
    header('Location: room-picker.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // check in the db if there is a fakeClient if not create one
    $fakeClient = $bookings->getFakeClient();
    if (!$fakeClient) {
        $fakeClient = $bookings->createFakeClient();
    }

    
    // create a fake event in the db
    $fakeEvent = $bookings->createFakeEvent($fakeClient->getId(), $room->getId());
    // create a fake booking in the db for each day
    foreach ($days as $day) {
        $bookings->createFakeBooking($fakeEvent->getId(), $day);
    }
    // redirect to the calendar
    header('location: index.php');
}



render_admin('header', ['title' => 'Reservation manuelle', 'style' => 'calendar.css']);
render_admin('asidemenu');
?>

<main class="app-main">
<div class="container">
<form method="POST" action="">
    <h4 class="mt-4">Vous vous apprêtez à bloquer les jours suivants pour la salle <?= $room->getName(); ?>:</h4>
    <table>
        <thead>
            <tr>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($days as $day): ?>
                <tr>
                    <td><?= $day; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <label for="reason">Motif du blocage</label>
    <input type="text" name="reason"></input>
    <button type="submit">Confirmer</button>
</form>
</div>
</main>


<?php
render_admin('footer');
?>
