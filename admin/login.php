<?php
require '../src/bootstrap.php';
session_start();
use Admin\Admins;


$validator = new \App\Validator();


$errors = [];
$admin = null;
//in case a normal user tries to access the admin login page
if (isset($_SESSION['auth'])) {
    // destroy the session
    session_destroy();
    header('Location: ../public/login.php');
    exit();

}

if (isset($_SESSION['auth-admin'])) {
    header('Location: ../admin/index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    session_destroy();
    var_dump($data);

    $validator = new Admin\AdminValidator();
    $errors = $validator->validates($_POST);
    var_dump($errors);
    if (empty($errors)) {
        // ask the database if the user exists with the email and password

        $admins = new Admins(get_pdo());

        try {


            $admin = $admins->connectAdminAccount($data['username'], $data['password']);

            var_dump($admin);



            if (isset($admin)) {
                // if the user exists, log him in
                echo "test2";

                session_start();
                $_SESSION['auth-admin'] = $admin;
                header('Location: index.php');
                exit();
            } else {
                // if the user does not exist, show an error
                $errors['login'] = "Identifiant ou mot de passe incorrect";
            }
        } catch (\Exception $e) {
            $errors['login'] = "Identifiant ou mot de passe incorrect";
        }
    } else {
        $errors['login'] = "Identifiant ou mot de passe incorrect";
    }
}


render_admin('header', ['title' => 'Mon compte', 'script' => 'index.js']);
?>
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6">
            <h2 class="text-center">Mode Admin</h2>
            <form method="post">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" class="form-control" required id="username" name="username"
                        placeholder="Entrez votre nom d'utilisateur">

                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form-control" required id="password" name="password"
                        placeholder="Entrez votre mot de passe">

                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php
render_admin('footer');
?>