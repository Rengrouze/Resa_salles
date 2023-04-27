<?php

require '../src/bootstrap.php';


//changer href by looking at the option in the url
$option = $_GET['option'] ?? 'room-info';


if ($option === 'room-info') {
    $textOption = 'Voir les informations';
} else {
    $textOption = 'Vérifier les disponibilités';
}




render('header', ['title' => 'Accueil', 'script' => 'index.js']);

?>

<!-- Content -->


<div class="container-fluid bg-light pt-4 pb-4">
  <div class="row">
    <div class="col-md-4 mt-3">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-img-overlay bg-primary">
          
          <p class="card-text  ">Salle 1</p>
        </div>
        <div class="card-overlay text-white">
    <a class="text-decoration-none card-title text-white h3 mr-3" href="../public/<?=$option ?>.php?room=room1"><?= $textOption ?> </a>
   
        </div>

      </div>
    </div>
    <div class="col-md-4 mt-3">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-img-overlay bg-primary">
       
          <p class="card-text  ">Salle 2</p>
        </div>
        <div class="card-overlay text-white ">
        <a class="text-decoration-none card-title text-white h3" href="../public/<?=$option ?>.php?room=room2"><?= $textOption ?></a>
         
        </div>
      </div>
    </div>
    <div class="col-md-4 mt-3">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-img-overlay bg-primary">
          
          <p class="card-text  ">Salle 3</p>
        </div>
        <div class="card-overlay text-white">
    <a class="text-decoration-none card-title text-white h3 mr-3" href="../public/<?=$option ?>.php?room=room3"><?= $textOption ?></a>
   
        </div>

      </div>
    </div>
  </div>
</div>


<!-- END OF card section -->

<?php

render('footer');

?>