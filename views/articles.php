<?php
use Calendar\{
  Rooms,
};

$pdo = get_pdo();

$rooms = new Rooms($pdo);

//get all rooms

$rooms = $rooms->getRooms();









?>


<div class="col-md-7">
  <h2 class="mt-4 mb-4">Nos salles</h2>
  <p class="text-muted">Trouvez la salle qui vous convient</p>
  <hr class="bg-dark">

  <?php foreach ($rooms as $room): ?>
   <div class="card mb-4">
    <div class="row no-gutters">
      <div class="col-md-4">
        <div style="height: 100%; overflow: hidden;">
          <img src="https://via.placeholder.com/150x150" class="card-img img-fluid" alt="..." style="height: 100%; object-fit: cover;">
        </div>
      </div>
      <div class="col-md-8">
        <div class="card-body h-100 d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title mb-2"><?= $room->getName()?></h5>
            <p class="card-text"><i class="fas fa-map-marker-alt"></i> Emplacement : <?= $room->getLocation()?></p>
            <div class="row mb-3">
              <div class="col-6">
                <p class="card-text"><i class="fas fa-ruler-combined"></i> Taille : <?= $room->getSize()?>m²</p>
                <p class="card-text"><i class="fas fa-user-friends"></i> Capacité : <?= $room->getCapacity()?> personnes</p>
                <p class="card-text"><i class="fas fa-chair"></i> Places assises : <?= $room->getSeats()?></p>
              </div>
              <div class="col-6">
              <?php 
                  $options = $room->getOptions();
                  $visibleOptions = array_slice($options, 0, 4); // show only the first 4 options
                ?>
                <?php foreach ($visibleOptions as $optionName => $optionValue): ?>
                  <?php if ($optionValue == 1): ?>
                    <p class="card-text"><i class="fas fa-<?= $optionName ?>"></i> <?= ucfirst($optionName) ?></p>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php if (count($options) > 4): ?>
                  <a class="btn btn-link" href="../public/room-info.php?<?=$room->getId()?>">Voir plus</a>
                  <div class="additional-options d-none">
                    <?php foreach (array_slice($options, 4) as $optionName => $optionValue): ?>
                      <?php if ($optionValue == 1): ?>
                        <p class="card-text"><i class="fas fa-<?= $optionName ?>"></i> <?= ucfirst($optionName) ?></p>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0"><span class=""><?=$room->getPrice()?>€/jour</span></h6>
            <a href="../public/calendar.php?room=<?=$room->getId()?>" class="btn btn-primary">Vérifier les disponibilités</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <!-- Répétez la structure de la carte pour chaque salle -->
</div>



