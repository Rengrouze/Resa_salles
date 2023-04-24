




<section class="container mt-4">
  <div class="row">
    <div class="col-md-6 animate__animated animate__fadeInLeft">
      

<img src="<?php echo isset($sectionImagePath1) ? '../public/images/info_card/' . $sectionImagePath1 . '/1' : 'https://via.placeholder.com/600x400'; ?>" alt="Placeholder image" class="img-fluid">

    </div>
    <div class="col-md-6 animate__animated animate__fadeInRight">
      <h2 class="mb-4"><?= $sectionTitle1 ??'Section 1' ?></h2>
      <p><?= $sectionParagraph1 ?? 'Remplir le paragraphe'?></p>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-md-6 order-md-2 animate__animated animate__fadeInLeft">
      <img src="<?php echo isset($sectionImagePath1) ? '../public/images/info_card/' . $sectionImagePath1 . '/2' : 'https://via.placeholder.com/600x400'; ?>" alt="Placeholder image" class="img-fluid">
    </div>
    <div class="col-md-6 order-md-1 animate__animated animate__fadeInRight">
      <h2 class="mb-4"><?= $sectionTitle2 ??'Section 2' ?></h2>
      <p><?= $sectionParagraph2 ?? 'Remplir le paragraphe'?></p>
    </div>
  </div>
    <div class="row mt-5">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
        <img src="<?php echo isset($sectionImagePath1) ? '../public/images/info_card/' . $sectionImagePath1 . '/3' : 'https://via.placeholder.com/600x400'; ?>" alt="Placeholder image" class="img-fluid">
        </div>
        <div class="col-md-6 animate__animated animate__fadeInRight">
        <h2 class="mb-4"><?= $sectionTitle3 ??'Section 3' ?></h2>
        <p><?= $sectionParagraph3 ?? 'Remplir le paragraphe'?></p>
        </div>
  <div class="row mt-5 mb-5">
    <div class="col-md-12 text-center animate__animated animate__fadeIn">
      <a href="../public/calendar.php?room-options=1" class="btn btn-primary btn-lg">Vérifier les disponibilités</a>
    </div>
  </div>
</section >