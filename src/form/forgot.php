<?php
use Calendar\{
    Clients,
};

use App\{
    PwdResets,
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
    $validator = new Calendar\ForgotValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        // ask the database if the user exists with the email and password
        $clients = new Clients(get_pdo());

        try {
            $client = $clients->findClientByMail($_POST['email']);
            if ($client) {
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);

                $url = "http://localhost:8000/public/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

                $expires = date("U") + 1800;
                $pwdResets = new PwdResets(get_pdo());
                $pwdResets->delete($_POST['email']);

                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                // create a data array to hydrate the pwdReset object
                $data = [
                    'email' => $_POST['email'],
                    'selector' => $selector,
                    'token' => $hashedToken,
                    'expires' => $expires
                ];

                $pwdReset = $pwdResets->hydrate(new \App\PwdReset(), $data);


            }
            // generate a token

            // save the token in the database


        } catch (\Exception $e) {
            $errors['login'] = "Identifiant ou mot de passe incorrect";
        }

    }



}