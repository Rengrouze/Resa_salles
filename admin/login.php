<?php
require '../src/bootstrap.php';

render_admin('header', ['title' => 'Mon compte', 'script' => 'index.js']);
?>
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6">
            <h2 class="text-center">Mode Admin</h2>
            <form>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" class="form-control" id="username" placeholder="Entrez votre nom d'utilisateur">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php
render_admin('footer');
?>