<?php

require '../src/bootstrap.php';

use Calendar\{
    Clients,
};


$email = $_GET['email'];

$clients = new Clients(get_pdo());
$clients->activateClient($email);


render('header', ['title' => 'Mail en attente de validation', 'script' => 'index.js']);

?>
<div class="container">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Merci d'avoir validé votre email</h5>
            <p class="card-text">Vous pouvez désormais vous connecter</p>
        </div>
    </div>
</div>
<?php render('footer'); ?>