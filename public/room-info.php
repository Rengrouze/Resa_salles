<?php

require '../src/bootstrap.php';
$room = $_GET['room'];
require '../src/custom/carousel.php';
require '../src/custom/info_card.php';



render('header', ['title' => 'Salle 1', 'script' => 'index.js']);
?>

<!-- Content -->
<!-- Carousel  -->
<?php
// get the room from the url


render('carousel', 
[
  'imagePath' => $room, 
  'firstSlideTitle' => $firstSlideTitle,
  'firstSlideParagraph' => $firstSlideParagraph,
  'secondSlideTitle' => $secondSlideTitle,
  'secondSlideParagraph' => $secondSlideParagraph,
  'thirdSlideTitle' => $thirdSlideTitle,
  'thirdSlideParagraph' => $thirdSlideParagraph
]);

render('info_card', [
  'sectionImagePath1' => $room,
  'sectionTitle1' => $sectionTitle1,
  'sectionParagraph1' => $sectionParagraph1,
  'sectionTitle2' => $sectionTitle2,
  'sectionParagraph2' => $sectionParagraph2,
  'sectionTitle3' => $sectionTitle3,
  'sectionParagraph3' => $sectionParagraph3,
]);
?>


<?php
render('footer');
?>

