<?php

use Calendar\{
    Clients,
};

use App\{
    PwdResets,
};

$validator = new \App\Validator();

$pwdResets = new PwdResets(get_pdo());

require '../src/MailController/mail-controller.php';




$errors = [];


// check if the user is already logged in
if (isset($_SESSION['auth'])) {
    header('Location: /public/index.php');
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];




    $validator = new Calendar\ForgotValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        // ask the database if the user exists with the email and password
        $clients = new Clients(get_pdo());

        try {


            $clientExist = $clients->findClientByMail($_POST['email']);


            if ($clientExist == true) {
                $pwdResets->delete($email);
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);
                $url = "http://resasite/public/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

                $expires = date("U") + 1800;






                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                // create a data array to hydrate the pwdReset object
                $data = [
                    'email' => $email,
                    'selector' => $selector,
                    'token' => $hashedToken,
                    'expires' => $expires
                ];

                $pwdReset = $pwdResets->hydrate(new \App\PwdReset(), $data);


                $pwdResets->create($pwdReset);


                $destinataire = $email;
                $objet = "Réinitialisation de votre mot de passe";
                $contenu = '<p> Bonjour nous avons reçu une demande de réinitialisation de votre mot de passe, si vous n\'êtes pas à l\'origine de cette demande, vous pouvez ignorer ce mail </p> <br> <p> Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : <a href="' . $url . '">' . $url . '</a> </p> <br> <p> Ce lien est valable 30 minutes </p> <br> <p> Cordialement, </p> <br> <p> L\'équipe de RésaSite </p>';
                sendmail($objet, $contenu, $destinataire);
                $success['sent'] = "Un mail de réinitialisation de mot de passe vous a été envoyé. Si au bout de 30 minutes vous n'avez toujours rien reçu, vérifiez vos spams ou cliquez une nouvelle fois sur le bouton.";


            }
            // generate a token

            // save the token in the database


        } catch (\Exception $e) {
            $errors['login'] = "Aucun compte n'est associé à cet email" . $e->getMessage();
        }

    }



}