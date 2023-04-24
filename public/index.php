<?php

require '../src/bootstrap.php';




render('header', ['title' => 'Accueil', 'script' => 'index.js']);
?>
<!-- Content -->
<!-- Carousel  -->
<?php
render('carousel', 
[
  'imagePath' => 'index', 
  'firstSlideTitle' => 'Salle 1',
  'firstSlideParagraph' => "blablabla Salle 1",
  'secondSlideTitle' => 'Salle 2',
  'secondSlideParagraph' => "blablabla Salle 2",
  'thirdSlideTitle' => 'Salle 3',
  'thirdSlideParagraph' => "blablabla Salle 3"
]);
?>

<!-- END OF Carousel  -->








<!-- card section -->
<div class="container-fluid bg-dark pt-4 pb-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-img-overlay bg-primary">
          
          <p class="card-text  ">Description de nos salles.</p>
        </div>
        <div class="card-overlay text-white">
    <a class="text-decoration-none card-title text-white h3 mr-3" href="../public/room-info.php?room=1">Salle 1</a>
    <a class="text-decoration-none card-title text-white h3 mr-3" href="../public/room-info.php?room=2">Salle 2</a>
    <a class="text-decoration-none card-title text-white h3" href="../public/room-info.php?room=3">Salle 3</a>
</div>

      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-img-overlay bg-primary">
       
          <p class="card-text  ">Informations pratiques.</p>
        </div>
        <div class="card-overlay text-white ">
        <a class="text-decoration-none card-title text-white h3" href="../public/info.php">Plus d'info</a>
         
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-img-overlay bg-primary">
          
          <p class="card-text  ">Contactez-nous.</p>
        </div>
        <div class="card-overlay text-white ">
          <a class="text-decoration-none card-title text-white h3" href="../public/contact.php">Formulaire de contact</a>
          
        </div>
      </div>
    </div>
  </div>
</div>

<!-- END OF card section -->

<!-- Split section -->
    
<div class="container-fluid bg-light">
  <div class="row">
     <!-- Articles section -->
    <?php 
    render('articles');
    ?>
    <!-- END OF Article section -->
    <!-- Quick Book Section -->
    <?php
    render('quickbook');
    ?>


    <!-- END OF Quick Book Section -->
  </div>
</div>
<!-- END OF Split section -->



<?php
render('footer');