<?php

require '../src/bootstrap.php';
require '../src/session.php';
require '../src/form/signup.php';



render('Header', ['title' => 'Créer un compte', 'script' => 'index.js']);

?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Connexion</div>
                <div class="card-body">


                    <form id="register-form" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name"
                                    value="<?= isset($data['name']) ? h($data['name']) : '' ?>" name="name" required>
                                <?php if (isset($errors['name'])): ?>
                                    <small class="form-text text-muted">
                                        <?= $errors['name']; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname">Prénom</label>
                                <input type="text" class="form-control" id="firstname"
                                    value="<?= isset($data['firstname']) ? h($data['firstname']) : '' ?>"
                                    name="firstname" required>
                                <?php if (isset($errors['firstname'])): ?>
                                    <small class="form-text text-muted">
                                        <?= $errors['firstname']; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"
                                value="<?= isset($data['email']) ? h($data['email']) : '' ?>" name="email" required>
                            <?php if (isset($errors['email'])): ?>
                                <small class="form-text text-muted">
                                    <?= $errors['email']; ?>
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
                        <div class="form-group">
                            <label for="password_confirm">Confirmation du mot de passe</label>
                            <input type="password" class="form-control" id="password_confirm"
                                value="<?= isset($data['password_confirm']) ? h($data['password_confirm']) : '' ?>"
                                name="password_confirm" required>
                            <?php if (isset($errors['password_confirm'])): ?>
                                <small class="form-text text-muted">
                                    <?= $errors['password_confirm']; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" class="form-control" id="phone"
                                value="<?= isset($data['phone']) ? h($data['phone']) : '' ?>" name="phone" required>
                            <?php if (isset($errors['phone'])): ?>
                                <small class="form-text text-muted">
                                    <?= $errors['phone']; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="business">Entreprise</label>
                            <input type="text" class="form-control" id="business"
                                value="<?= isset($data['business']) ? h($data['business']) : '' ?>" name="business"
                                required>
                            <?php if (isset($errors['business'])): ?>
                                <small class="form-text text-muted">
                                    <?= $errors['business']; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="siret">SIRET</label>
                            <input type="text" class="form-control" id="siret"
                                value="<?= isset($data['siret']) ? h($data['siret']) : '' ?>" name="siret" required>
                            <?php if (isset($errors['siret'])): ?>
                                <small class="form-text text-muted">
                                    <?= $errors['siret']; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <input type="text" class="form-control" id="address"
                                value="<?= isset($data['address']) ? h($data['address']) : '' ?>" name="address"
                                required>
                            <?php if (isset($errors['address'])): ?>
                                <small class="form-text text-muted">
                                    <?= $errors['address']; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="address_complement">Complément d'adresse</label>
                            <input type="text" class="form-control" id="address_complement"
                                value="<?= isset($data['address_complement']) ? h($data['address_complement']) : '' ?>"
                                name="address_complement">
                            <?php if (isset($errors['address'])): ?>
                                <small class="form-text text-muted">
                                    <?= $errors['address']; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="postal_code">Code postal</label>
                                <input type="text" class="form-control" id="postal_code"
                                    value="<?= isset($data['postal_code']) ? h($data['postal_code']) : '' ?>"
                                    name="postal_code" required>
                                <?php if (isset($errors['postal_code'])): ?>
                                    <small class="form-text text-muted">
                                        <?= $errors['postal_code']; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-8">
                                <label for="city">Ville</label>
                                <input type="text" class="form-control" id="city"
                                    value="<?= isset($data['city']) ? h($data['city']) : '' ?>" name="city" required>
                                <?php if (isset($errors['city'])): ?>
                                    <small class="form-text text-muted">
                                        <?= $errors['city']; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mt-3"><input type="hidden" name="mode" value="register">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                            <button type="button" class="btn btn-link" id="btn-switch-to-login">Se connecter</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Basculer vers le formulaire de connexion    
    $('#btn-switch-to-login').click(function () {
        window.location.href = "login.php";
    });
</script>

<?php
render('footer');