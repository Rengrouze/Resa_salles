<?php
require '../src/bootstrap.php';
require '../src/MailController/mail-controller.php';


use App\{
    AccountsActivate,
};

$accountsActivate = new AccountsActivate(get_pdo());

$email = $_GET['email'];

$accountsActivate->delete($email);
$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);
$expires = date("U") + 1800;
$url = "http://resasite/public/validate-account.php?selector=" . $selector . "&validator=" . bin2hex($token);

$hashedToken = password_hash($token, PASSWORD_DEFAULT);

$data = [
    'email' => $email,
    'selector' => $selector,
    'token' => $hashedToken,
    'expires' => $expires
];

$accountActivate = $accountsActivate->hydrate(new \App\AccountActivate(), $data);
$accountsActivate->create($accountActivate);
$destinataire = $email;
$objet = "Validation de votre compte";
$contenu = "Bonjour, veuillez cliquer sur le lien suivant pour valider votre compte : $url";
sendmail($objet, $contenu, $destinataire);



render('header', ['title' => 'Mail en attente de validation', 'script' => 'index.js']);

?>
<div class="container">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Un e-mail a été envoyé à l'adresse suivante :
                <?= $email ?>
            </h5>
            <p class="card-text">Veuillez valider votre compte en cliquant sur le lien.</p>
            <a href="waiting-validation.php?email=<?= $email?>" class="btn btn-primary">Vous n'avez rien reçu ? Renvoyer
                le mail.</a>
        </div>
    </div>
</div>
<?php render('footer'); ?>