<?php
use Calendar\{
    Month,
    Bookings
};

$pdo = get_pdo();

$month = new Month();
$bookings = new Bookings($pdo);

//get all free days of the month from tommorow to the Seven next days with getNextAvailableDays()
$freeDaysRoom1 = $bookings->getNextAvailableDays("room1");
$freeDaysRoom2 = $bookings->getNextAvailableDays("room2");
$freeDaysRoom3 = $bookings->getNextAvailableDays("room3");



?>





<div class="col-md-5">
  <h2 class="mt-4 mb-4">Disponibilités</h2>
  <hr class="bg-dark">
  <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="salle1-tab" data-toggle="tab" href="#salle1" role="tab" aria-controls="salle1" aria-selected="true">Salle 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="salle2-tab" data-toggle="tab" href="#salle2" role="tab" aria-controls="salle2" aria-selected="false">Salle 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="salle3-tab" data-toggle="tab" href="#salle3" role="tab" aria-controls="salle3" aria-selected="false">Salle 3</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="salle1" role="tabpanel" aria-labelledby="salle1-tab">
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Reservation rapide</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($freeDaysRoom1 as $day): ?>
    <?php $date = new DateTime($day); ?>
    <tr>
        <td><?= $date->format('d ') . $month->getMonthName($date) . $date->format(' Y') ?></td>
        <td><a class="btn btn-primary" href="../public/validate-booking.php?days=<?= $day?>&room=room1">Réserver</a></td>
        
    </tr>
<?php endforeach; ?>
    </tbody>
</table>

    </div>
    <div class="tab-pane fade" id="salle2" role="tabpanel" aria-labelledby="salle2-tab">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Reservation rapide</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($freeDaysRoom2 as $day): ?>
    <?php $date = new DateTime($day); ?>
    <tr>
        <td><?= $date->format('d ') . $month->getMonthName($date) . $date->format(' Y') ?></td>
        <td><a class="btn btn-primary" href="../public/validate-booking.php?days=<?= $day?>&room=room2">Réserver</a></td>
    </tr>
<?php endforeach; ?>
         
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="salle3" role="tabpanel" aria-labelledby="salle3-tab">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Reservation rapide</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($freeDaysRoom3 as $day): ?>
    <?php $date = new DateTime($day); ?>
    <tr>
        <td><?= $date->format('d ') . $month->getMonthName($date) . $date->format(' Y') ?></td>
        <td><a class="btn btn-primary" href="../public/validate-booking.php?days=<?= $day?>&room=room3">Réserver</a></td>
    </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </div>