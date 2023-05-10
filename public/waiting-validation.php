<?php
require '../src/bootstrap.php';
require '../src/MailController/mail-controller.php';

$email = $_GET['email'];

$destinataire = $email;
$objet = "Validation de votre compte";
$contenu = "Bonjour, veuillez cliquer sur le lien suivant pour valider votre compte : http://localhost:8000/validate-account.php?email=$email";
sendmail($objet, $contenu, $destinataire);



render('header', ['title' => 'Mail en attente de validation', 'script' => 'index.js']);

?>
<div class="container">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Un e-mail a été envoyé à l'adresse suivante :</h5>
            <p class="card-text">Veuillez valider votre compte.</p>
        </div>
    </div>
</div>
<?php render('footer'); ?>