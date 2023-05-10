<?php

use Calendar\Rooms;

require '../src/bootstrap.php';
$roomId = $_GET['room'];
$rooms = new Rooms(get_pdo());
$room = $rooms->getRoom($roomId);


$translation = array(
  'projector' => 'projecteur',
  'wifi' => 'Réseau wifi',
  'coffee' => 'machine à café',
  'water' => 'eau',
  'paperboard' => 'paperboard',
  'tv' => 'télévision',
  'toilets' => 'toilettes',
  'parking' => 'parking',
  'disabledAccess' => 'accès aux personnes à mobilité réduite',
  'airConditioning' => 'climatisation'
  
);
$icons = [
  'projector' => 'video',
  'wifi' => 'wifi',
  'coffee' => 'coffee',
  'water' => 'tint',
  'paperboard' => 'chalkboard',
  'tv' => 'tv',
  'toilets' => 'toilet-paper',
  'parking' => 'parking',
  'disabledAccess' => 'wheelchair',
  'airConditioning' => 'snowflake'
  // ajoutez les autres options ici
];



render('header', ['title' => $room->getName(), 'script' => 'index.js', 'style' => 'calendar.css']);

?>


<!-- Content -->
<section class="room-details">
  <div class="row">
    <div class="col-md-6">
    <div id="carouselExampleControls" class="carousel slide  d-md-block" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../public/images/carousel/<?= $room->getId()?>/1.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="../public/images/carousel/<?= $room->getId()?>/2.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="../public/images/carousel/<?= $room->getId()?>/3.jpg" class="d-block w-100" alt="...">
     
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
    <div class="col-md-6">
      <h1><?= $room->getName()?> - <?= $room->getLocation()?></h1>
      <p><?= $room->getDescription()?></p>
      <h3>Caractéristiques</h3>
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Localisation :</td>
            <td><?= $room->getLocation() ?></td>
          </tr>
          <tr>
            <td>Capacité :</td>
            <td><?= $room->getCapacity() ?> Personnes</td>
          </tr>
          <tr>
            <td>Nombre de sièges :</td>
            <td><?= $room->getSeats() ?> Chaises disponibles</td>
          </tr>
          <tr>
            <td>Taille :</td>
            <td><?= $room->getSize() ?>m²</td>
          </tr>
          <tr>
            <td>Prix/jour :</td>
            <td><?= $room->getPrice() ?>€</td>
          </tr>
        </tbody>
      </table>
      <h3>Matériel disponibles :</h3>
<?php 
$options = $room->getOptions(); 
$leftColumnOptions = array_slice($options, 0, count($options)/2);
$rightColumnOptions = array_slice($options, count($options)/2);
?>
<div class="row">
  <div class="col-md-6">
    <ul class="list-unstyled">
      <?php foreach ($leftColumnOptions as $optionName => $optionValue) : ?>
        <?php if ($optionValue) : ?>
          <li><i class="fas fa-<?= $icons[$optionName] ?>"></i> <?= ucfirst($translation[$optionName]) ?></li>
        <?php endif ?>
      <?php endforeach ?>
    </ul>
  </div>
  <div class="col-md-6">
    <ul class="list-unstyled">
      <?php foreach ($rightColumnOptions as $optionName => $optionValue) : ?>
        <?php if ($optionValue) : ?>
          <li><i class="fas fa-<?= $icons[$optionName] ?>"></i> <?= ucfirst($translation[$optionName]) ?></li>
        <?php endif ?>
      <?php endforeach ?>
    </ul>
  </div>
</div>

</section>



<!-- make a big separator with a title "Reserver cette salle" -->
<div class="section-separator ml-2" style="margin-left: 10px;">
  
  <div class="border-top mb-4"></div>
  <h2 class="section-title">Réserver cette salle</h2>
</div>

<?php 
render('calendar', ['room' => $room]);?>

<?php
render('footer');
?>

