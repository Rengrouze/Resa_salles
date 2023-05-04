<?php
use Calendar\{
    Month,
    Bookings,
    Rooms
};

$pdo = get_pdo();

$month = new Month();
$bookings = new Bookings($pdo);
$rooms = new Rooms($pdo);

//get all room

$allRooms = $rooms->getRooms();
// for each room use getNextAvailableDays() to get the next 7 days available by room
foreach ($allRooms as $room) {
    $freeDays[$room->getId()] = $bookings->getNextAvailableDays($room->getId());
}

//get all free days of the month from tommorow to the Seven next days with getNextAvailableDays()





?>





<div class="col-md-5">
  <h2 class="mt-4 mb-4">Réservation rapide</h2>
  <p class="text-muted">Réserver une salle pour une journée</p>
  <hr class="bg-dark">

  

  <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
  <?php //for each room generate a tab
  foreach ($allRooms as $room): ?>
    <li class="nav-item">
      <a class="nav-link" id="salle<?=$room->getId()?>-tab" data-toggle="tab" href="#salle<?=$room->getId()?>" role="tab" aria-controls="salle<?=$room->getId()?>" aria-selected="true"><?= $room->getName()?></a>
    </li>
  <?php endforeach; ?>
    
  </ul>

  <div class="tab-content" id="myTabContent">
  <?php //for each room generate a tab
  foreach ($allRooms as $room): ?>

    <div class="tab-pane fade<?php if ($room === reset($allRooms)) echo ' show active'; ?>" id="salle<?=$room->getId()?>" role="tabpanel" aria-labelledby="salle<?=$room->getId()?>-tab">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Prix</th>
            <th>Réservation rapide</th>
          </tr>
        </thead>
        <tbody>

          <!-- for each room generate a table with the next 7 days available -->
          <?php foreach ($freeDays[$room->getId()] as $day): ?>
          <?php $date = new DateTime($day); ?>
          <tr>
            <td><?= $date->format('d ') . $month->getMonthName($date) . $date->format(' Y') ?></td>
            <td><?= $room->getPrice()?>€</td>
            <!-- if the user is not logged in, desactivate the button -->
            <?php if (isset($_SESSION['auth']) ): ?>
            <td><a class="btn btn-primary" href="../public/validate-booking.php?days=<?= $day?>&room=<?= $room->getId() ?>">Réserver</a></td>
            <?php else: ?>
            <td><a class="btn btn-secondary" href="../public/login.php">Connectez-vous pour reserver</a></td>
            <?php endif; ?>

          </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  <?php endforeach; ?>
</div>
