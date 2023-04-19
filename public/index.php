<?php

require '../src/bootstrap.php';




render('header', ['title' => 'Accueil']);
?>

<!-- Content -->
<!-- first navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-light">
	<div class="container-fluid">
		<div class="navbar-text mr-auto">
			<p class="d-inline-block m-0 mr-3"><i class="fas fa-phone"></i> 01 23 45 67 89</p>
			<p class="d-inline-block m-0 mr-3"><i class="fas fa-envelope"></i> contact@example.com</p>
			
		</div>
		<div class="navbar-text">
			<a href="#"><i class="fas fa-user"></i> Mon compte</a>
		</div>
	</div>
</nav>
<!-- END OF first navbar -->

<!-- second navbar -->

<nav class="navbar navbar-expand-md navbar-light bg-light" style="height: 80px;">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a class="navbar-brand" href="#">
      <img src="chemin/vers/logo.png" alt="Logo de l'entreprise" style="height: 50px;">
    </a>
    <div class="d-flex align-items-center">
      <ul class="navbar-nav mr-3">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Nos salles
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Salle 1</a>
            <a class="dropdown-item" href="#">Salle 2</a>
            <a class="dropdown-item" href="#">Salle 3</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Infos pratiques</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Contactez-nous</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-primary" href="#">Vérifier la disponibilité d'une salle</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- END OF second navbar -->
<!-- Carousel  -->

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../public/images/carousel/salle_1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h5>Nom de la salle 1</h5>
        <p>Description de la salle 1</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../public/images/carousel/salle_2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h5>Nom de la salle 2</h5>
        <p>Description de la salle 2</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../public/images/carousel/salle_3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h5>Nom de la salle 3</h5>
        <p>Description de la salle 3</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



<!-- END OF Carousel  -->
<!-- card section -->
<div class="container-fluid bg-dark py-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title mb-0">Nos salles</h5>
          <p class="card-text">Description de nos salles.</p>
        </div>
        <div class="card-img-overlay">
          <a href="#" class="stretched-link"></a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title mb-0">Info pratiques</h5>
          <p class="card-text">Informations pratiques.</p>
        </div>
        <div class="card-img-overlay">
          <a href="#" class="stretched-link"></a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 bg-transparent text-white">
        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title mb-0">Contactez-nous</h5>
          <p class="card-text">Contactez-nous.</p>
        </div>
        <div class="card-img-overlay">
          <a href="#" class="stretched-link"></a>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- END OF card section -->


<?php
render('footer');