<?php

require '../src/bootstrap.php';
require '../src/session.php'; 
require '../src/form/login.php';

render('Header', ['title' => 'Se connecter', 'script' => 'index.js']);
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if (isset($errors['login'])): ?>
            <div class="alert alert-danger">
                <?= $errors['login']; ?>
            </div>
            <?php endif; ?>
            <?php if (isset($_GET['newpwd'])): ?>
            <div class="alert alert-success">
                Votre mot de passe a été réinitialisé avec succès !
            </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">Connexion</div>
                <div class="card-body">
                    <form id="login-form" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= isset($data['email']) ? h($data['email']) : '' ?>" required>
                            <?php if (isset($errors['email'])): ?>
                            <small class="form-text text-muted">
                                <?= $errors['name']; ?>
                            </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password"
                                value="<?= isset($data['password']) ? h($data['password']) : '' ?>" name="password"
                                required>
                            <?php if (isset($errors['password'])): ?>
                            <small class="form-text text-muted">
                                <?= $errors['password']; ?>
                            </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mt-3">
                            <input type="hidden" name="mode" value="connect">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                            <a href="/public/forgot-password.php" class="btn btn-link">Mot de passe oublié ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div>
                    <h2>Vous n'avez pas encore de compte ?</h2>
                    <p>Créez-le ici !</p>
                    <button type="button" class="btn btn-primary" id="btn-switch-to-register">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Cacher le formulaire d'inscription au chargement de la page

    // Basculer vers le formulaire d'inscription
    $('#btn-switch-to-register').click(function() {
        //go to signup.php
        window.location.href = "signup.php";

    });


});
</script>
<?php render('Footer'); ?>