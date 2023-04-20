<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquyery -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
 <!-- link to css -->
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="../public/css/<?= $style ?? ''?>">
        

    
   <title>
    <?= $title ?? 'Resa Site'; ?>
    </title>
    <script src="../public/js/<?= $script?>"></script>




</head>
<body>
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
          <a class="nav-link" href="../public/index.php">Accueil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Nos salles
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../public/room-info.php?room=room1">Salle 1</a>
            <a class="dropdown-item" href="../public/room-info.php?room=room2">Salle 2</a>
            <a class="dropdown-item" href="../public/room-info.php?room=room3">Salle 3</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../public/info.php">Infos pratiques</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../public/contact.php">Contactez-nous</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-primary" href="../public/roompicker.php?option=calendar">Vérifier la disponibilité d'une salle</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- END OF second navbar -->
