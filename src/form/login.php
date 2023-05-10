<?php
use Calendar\{
    Clients,
};

$validator = new \App\Validator();


$errors = [];


// check if the user is already logged in
if (isset($_SESSION['auth'])) {
    header('Location: /public/index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;
    $validator = new Calendar\LoginValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        // ask the database if the user exists with the email and password
        $clients = new Clients(get_pdo());

        try {
            $client = $clients->find($_POST['email'], $_POST['password']);
            if (isset($client)) {

                // check first if client has activated his account
                if ($client->getActivated() == 0) {
                    $errors['login'] = "Votre compte n'est pas encore activé, vous avez normalement reçu un mail de confirmation, si vous n'avez pas recu le mail : </br> <a href='/public/waiting-validation.php?email=" . $client->getEmail() . "'> Cliquez ici pour le recevoir à nouveau </a>";
                    return;
                }


                // if the user exists, log him in
                session_start();
                $_SESSION['auth'] = $client;

                $username = $client->getName() . ' ' . $client->getFirstname();

                setcookie('username', $username, time() + 365 * 24 * 3600, null, null, false, true);

                header('Location: /public/index.php');
                exit();
            } else {
                // if the user does not exist, show an error
                $errors['login'] = "Identifiant ou mot de passe incorrect";
            }
        } catch (\Exception $e) {
            $errors['login'] = "Identifiant ou mot de passe incorrect";
        }

    }



}