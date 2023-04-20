




<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../public/images/carousel/<?= $imagePath?>/1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h5><?=$firstSlideTitle ?? 'Titre de diapo 1'?></h5>
        <p><?=$firstSlideParagraph ?? 'Paragraphe de diapo 1'?></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../public/images/carousel/<?= $imagePath?>/2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
      <h5><?=$secondSlideTitle ?? 'Titre de diapo 2'?></h5>
        <p><?=$secondSlideParagraph ?? 'Paragraphe de diapo 2'?></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../public/images/carousel/<?= $imagePath?>/3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
      <h5><?=$thirdSlideTitle ?? 'Titre de diapo 3'?></h5>
        <p><?=$thirdSlideParagraph ?? 'Paragraphe de diapo 2'?></p>
      </div>
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