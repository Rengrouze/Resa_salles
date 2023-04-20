<?php

require '../src/bootstrap.php';




render('header', ['title' => 'Salle 1', 'script' => 'index.js']);
?>

<!-- Content -->
<!-- Carousel  -->
<?php
// get the room from the url
$room = $_GET['room'];
render('carousel', 
[
  'imagePath' => $room, 
  'firstSlideTitle' => 'Salle 1',
  'firstSlideParagraph' => "blablabla Salle 1",
  'secondSlideTitle' => 'Salle 2',
  'secondSlideParagraph' => "blablabla Salle 2",
  'thirdSlideTitle' => 'Salle 3',
  'thirdSlideParagraph' => "blablabla Salle 3"
]);


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
      <a href="../public/calendar.php?room-options=1" class="btn btn-primary btn-lg">Vérifier les disponibilités</a>
    </div>
  </div>
</section >

<?php
render('footer');
?>

