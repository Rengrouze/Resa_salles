<?php

require '../src/bootstrap.php';

render('header', ['title' => 'Accueil', 'script' => 'index.js']);

?>


<section class="container mt-4">
  <div class="row">
    <div class="col-md-6 animate__animated animate__fadeInLeft">
      <img src="https://via.placeholder.com/600x400" alt="Placeholder image" class="img-fluid">
    </div>
    <div class="col-md-6 animate__animated animate__fadeInRight">
      <h2 class="mb-4">Titre de la section</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-md-6 order-md-2 animate__animated animate__fadeInLeft">
      <img src="https://via.placeholder.com/600x400" alt="Placeholder image" class="img-fluid">
    </div>
    <div class="col-md-6 order-md-1 animate__animated animate__fadeInRight">
      <h2 class="mb-4">Titre de la section</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
    </div>
  </div>
    <div class="row mt-5">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
        <img src="https://via.placeholder.com/600x400" alt="Placeholder image" class="img-fluid">
        </div>
        <div class="col-md-6 animate__animated animate__fadeInRight">
        <h2 class="mb-4">Titre de la section</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
        </div>
  <div class="row mt-5 mb-5">
    <div class="col-md-12 text-center animate__animated animate__fadeIn">
      <a href="../public/signup.php" class="btn btn-primary btn-lg">Créer un compte</a>
    </div>
  </div>
</section >

<?php

render('footer');

?>