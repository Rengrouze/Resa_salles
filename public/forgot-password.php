<?php

require '../src/bootstrap.php';
require '../src/session.php'; 
require '../src/form/forgot.php';

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
            <?php if (isset($success['sent'])): ?>
            <div class="alert alert-success">
                <?= $success['sent']; ?>
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
                                <?= $errors['email']; ?>
                            </small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mt-3">
                            <input type="hidden" name="mode" value="connect">
                            <button type="submit" class="btn btn-primary">Envoyer un e-mail</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


<?php render('Footer'); ?>