<?php
require '../src/bootstrap.php';
use Calendar\{
    Clients,
};
use App\{
    PwdResets,
};


require '../src/MailController/mail-controller.php';

$validator = new \App\Validator();

$pwdResets = new PwdResets(get_pdo());

$selector = $_GET['selector'];
$validator = $_GET['validator'];

if (empty($selector) || empty($validator)) {
    e404();
    exit();
} else {
    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
        $selector = h($selector);
        $validator = h($validator);
    } else {
        e404();
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($selector) || empty($validator)) {
        header('Location: /public/index.php');
        exit();
    } else {
        // validate data
        $formValidator = new Calendar\ResetPasswordValidator();
        $errors = $formValidator->validates($_POST);
        if (empty($errors)) {
            $currentDate = date('U');

            $pwdReset = $pwdResets->validateToken($selector, $currentDate);


            if ($pwdReset == false) {
                $error = "Token non valide. Vous devez soumettre une nouvelle demande de réinitialisation de mot de passe.";
            } else {
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin, $pwdReset->getToken());
                if ($tokenCheck === false) {
                    $error = "Vous devez soumettre une nouvelle demande de réinitialisation de mot de passe.";
                } elseif ($tokenCheck === true) {
                    $tokenEmail = $pwdReset->getEmail();

                    $clients = new Clients(get_pdo());
                    $client = $clients->findClientByMail($tokenEmail);
                    if ($client == false) {
                        $error = "Une erreur est survenue.";
                    } else {
                        $newPwd = $_POST['new_password'];
                        $confirmPwd = $_POST['confirm_password'];
                        if ($newPwd !== $confirmPwd) {
                            $error = "Les mots de passe ne correspondent pas.";
                        } else {

                            $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);

                            $clients->updatePassword($tokenEmail, $hashedPwd, );
                            $pwdResets->delete($tokenEmail);

                            $destinataire = $tokenEmail;
                            $objet = "Votre mot de passe a été réinitialisé";
                            $contenu = "Bonjour, Votre mot de passe a été réinitialisé avec succès. Vous pouvez désormais vous connecter avec votre nouveau mot de passe. Si vous n'êtes pas à l'origine de cette demande, veuillez contacter le service client. Cordialement, L'équipe ResaSite.";

                            sendmail($objet, $contenu, $destinataire);
                            header('Location: /public/login.php?newpwd=1');
                            exit();
                        }
                    }


                }


            }

        } else {
            $error = "Une erreur est survenue 1.";
        }
    }
}




render('header', ['title' => 'Reinitialiser votre mot de passe', 'script' => 'index.js']);

?>
<div class="container">
    <div class="card text-center">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success" role="alert">
                    Votre mot de passe a été réinitialisé avec succès.
                </div>
            <?php endif; ?>
            <h3 class="card-title">Réinitialiser votre mot de passe</h3>
            <form method="POST" action="">
                <input type="hidden" name="selector" value="<?= $selector ?>">
                <input type="hidden" name="validator" value="<?= $validator ?>">
                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="new_password" name="new_password"
                        placeholder="Nouveau mot de passe." required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                        placeholder="Confirmez votre mot de passe." required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Réinitialiser le mot de passe</button>
            </form>
        </div>
    </div>
</div>
<?php render('footer'); ?>