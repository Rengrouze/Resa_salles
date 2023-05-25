<?php
require '../src/session.php'; 
require '../src/bootstrap.php';




render('header', ['title' => 'Accueil', 'script' => 'index.js']);
?>
<section class="container-fluid bg-light py-5">
  <div class="container">
    <h1 class="display-4 text-center mb-5">Réservez votre salle de réunion ou de formation</h1>
    <p class="lead text-center">Bienvenue sur notre site de réservation de salles de réunion et de formation. Nous proposons des salles adaptées à vos besoins pour vous permettre de tenir des réunions, des formations et bien plus encore. Réservez dès maintenant en quelques clics !</p>
  </div>
</section>

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