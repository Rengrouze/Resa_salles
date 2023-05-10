<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- jquyery -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <!-- link to css -->
  <link rel="stylesheet" href="../public/css/index.css">
  <link rel="stylesheet" href="../public/css/<?= $style ?? '' ?>">



  <title>
    <?= $title ?? 'Resa Site'; ?>
  </title>
  <script src="../public/js/<?= $script ?>"></script>




</head>

<body>

  <?php require '../src/session.php'; ?>
  <?php require '../src/header.php'; ?>
  <header>
    <!-- first navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-light">
      <div class="container-fluid">
        <div class="navbar-text mr-auto">
          <p class="d-inline-block m-0 mr-lg-3"><a href="tel:+33254960260"><i class="fas fa-phone"></i> 02 54
              96 02 60</a></p>
          <p class="d-inline-block m-0 mr-lg-3"><a
              href="mailto:contact@cdo-formation.fr?subject=Renseignement location salle"><i
                class="fas fa-envelope"></i> contact@cdo-formation.fr</a></p>
        </div>
        <div class="navbar-text">
          <?php
          // if the user is connected get his username from the cookies and display it
          if (isset($_SESSION['auth'])) {
            echo '<p class="d-inline-block m-0 mr-lg-3">Bonjour ' . $username;
            '</p>';
            echo '<a href="../public/profile.php" class="btn btn-primary mx-2">Mon compte</a>';
            echo '<a href="../src/logout.php" class="btn btn-danger mx-2">Déconnexion</a>';
          } else if (isset($_SESSION['auth-admin'])) {
            echo '<p class="d-inline-block m-0 mr-lg-3">Bonjour Admin' . $username;
            '</p>';
            echo '<a href="../public/profile.php" class="btn btn-primary mx-2">Mon compte</a>';
            echo '<a href="../src/logout.php" class="btn btn-danger mx-2">Déconnexion</a>';
          } else {
            echo '<a href="../public/login.php" class="btn btn-primary mx-2"><i class="fas fa-user"></i> Se connecter</a>';
          }
          ?>

        </div>
      </div>
    </nav>
    <!-- END OF first navbar -->

    <!-- second navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <div class="navbar-container container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="../public/index.php">
          <img src="../public/images/logo/logo.jpg" alt="Logo de l'entreprise" style="height: 50px;">
          Cdo formation - Location
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  flex-row-reverse" id="navbarContent">
          <ul class="navbar-nav align-items-stretch">
            <li class="nav-item">
              <a class="nav-link" href="../public/index.php">Accueil</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Nos salles
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach ($allRooms as $room): ?>
                  <a class="dropdown-item" href="../public/room-info.php?room=<?= $room->getId() ?>"><?= $room->getName(); ?></a>
                <?php endforeach; ?>

              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../public/info.php">Infos pratiques</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../public/contact.php">Contactez-nous</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="../public/roompicker.php?option=calendar">Vérifier la
                disponibilité d'une salle</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>





    <!-- END OF second navbar -->
  </header>
  <main>