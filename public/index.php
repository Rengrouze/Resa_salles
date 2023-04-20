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
        <a class="text-decoration-none card-title text-white h3" href="../public/info.php?room=3">Plus d'info</a>
         
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
          <h5 class="card-title text-white">Contactez-nous</h5>
          
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
    <div class="col-md-7">
      <h2 class="mt-4 mb-4">Informations</h2>
      <hr class="bg-dark">
      <article class="d-flex align-items-center mb-4">
        <img src="https://via.placeholder.com/150x150" class="img-fluid mr-4 article-img" alt="...">
        <div class="pl-4">
          <h3>Titre d'article</h3>
          <p>blablablablablablabla</p>
        </div>
      </article>
      <article class="d-flex align-items-center mb-4">
        <img src="https://via.placeholder.com/150x150" class="img-fluid mr-4 article-img" alt="...">
        <div class="pl-4">
          <h3>Titre d'article</h3>
          <p>blablablablablablabla</p>
        </div>
      </article>
      <article class="d-flex align-items-center mb-4">
        <img src="https://via.placeholder.com/150x150" class="img-fluid mr-4 article-img" alt="...">
        <div class="pl-4">
          <h3>Titre d'article</h3>
          <p>blablablablablablabla</p>
        </div>
      </article>
      <article class="d-flex align-items-center mb-4">
        <img src="https://via.placeholder.com/150x150" class="img-fluid mr-4 article-img" alt="...">
        <div class="pl-4">
          <h3>Titre d'article</h3>
          <p>blablablablablablabla</p>
        </div>
      </article>
      <article class="d-flex align-items-center mb-4">
        <img src="https://via.placeholder.com/150x150" class="img-fluid mr-4 article-img" alt="...">
        <div class="pl-4">
          <h3>Titre d'article</h3>
          <p>blablablablablablabla</p>
        </div>
      </article>
    </div>
    <!-- END OF Article section -->
    <!-- Quick Book Section -->
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
          <tr>
            <td>23 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>25 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>27 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>28 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>29 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>30 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>1 mai 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
        
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
          <tr>
            <td>24 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>26 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>28 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>30 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>2 mai 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>4 mai 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>6 mai 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
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
          <tr>
            <td>23 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>25 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>27 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>28 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>29 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>30 avril 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
          <tr>
            <td>1 mai 2023</td>
            <td><button class="btn btn-primary">Réserver</button></li></td>
          </tr>
        </tbody>
      </table>
    </div>


    <!-- END OF Quick Book Section -->
  </div>
</div>
<!-- END OF Split section -->



<?php
render('footer');