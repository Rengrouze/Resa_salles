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
    var_dump($data);
    $validator = new Calendar\ForgotValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        // ask the database if the user exists with the email and password
        $clients = new Clients(get_pdo());

        try {
            $clientExist = $clients->findClientByMail($_POST['email']);
            var_dump($clientExist);
            if ($clientExist === true) {
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);

                $url = "http://localhost:8000/public/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

                $expires = date("U") + 1800;
                $pwdResets = new PwdResets(get_pdo());
                $pwdResets->delete($_POST['email']);

                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                // create a data array to hydrate the pwdReset object
                $data2 = [
                    'email' => $_POST['email'],
                    'selector' => $selector,
                    'token' => $hashedToken,
                    'expires' => $expires
                ];
                var_dump($data);
                die();
                $pwdReset = $pwdResets->hydrate(new \App\PwdReset(), $data2);
                $pwdResets->create($pwdReset);



            }
            // generate a token

            // save the token in the database


        } catch (\Exception $e) {
            $errors['login'] = "Aucun compte n'est associé à cet email" . $e->getMessage();
        }

    }



}