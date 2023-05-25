<?php

require '../src/bootstrap.php';
require '../src/session.php';
require '../src/MailController/mail-controller.php';

use Calendar\{
    Clients,
};
use App\{
    AccountsActivate,
};

$accountsActivate = new AccountsActivate(get_pdo());
$selector = $_GET['selector'];
$validator = $_GET['validator'];

if (empty($selector) || empty($validator)) {
    e404();
    exit();
} elseif (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {

    $selector = h($selector);
    $validator = h($validator);

} else {
    e404();
    exit();
}

$currentDate = date('U');
$accountActivate = $accountsActivate->validateToken($selector, $currentDate);

if ($accountActivate == false) {
    $error = "Token non valide. Vous devez soumettre une nouvelle demande de validation de compte.";
} else {
    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin, $accountActivate->getToken());
    if ($tokenCheck === false) {
        $error = "Vous devez soumettre une nouvelle demande de validation de compte.";
    } elseif ($tokenCheck === true) {
        $tokenEmail = $accountActivate->getEmail();

        $clients = new Clients(get_pdo());
        $client = $clients->findClientByMail($tokenEmail);
        if ($client == false) {
            $error = "Une erreur est survenue.";
        } else {
            $clients->activateClient($tokenEmail);
            $accountsActivate->delete($tokenEmail);

            $destinataire = $tokenEmail;
            $objet = "Validation de votre compte";
            $contenu = "Votre compte a bien été validé. Vous pouvez désormais vous connecter.";
            sendmail($objet, $contenu, $destinataire);

        }
    }
}






render('header', ['title' => 'Mail en attente de validation', 'script' => 'index.js']);

?>
<div class="container">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Merci d'avoir validé votre email.</h5>
            <p class="card-text">Vous pouvez désormais vous connecter.</p>
        </div>
    </div>
</div>
<?php render('footer'); ?>