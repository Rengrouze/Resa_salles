<?php

require '../src/bootstrap.php';
require '../src/session.php'; 

render('header', ['title' => 'Accueil', 'script' => 'index.js']);

?>

<div class="container mt-4 mb-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
        <h2> Contactez-nous </h2>
      <form method="post" action="#">
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="nom">Nom de l'entreprise :</label>
          <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
          <label for="tel">Numéro de téléphone de l'entreprise :</label>
          <input type="tel" class="form-control" id="tel" name="tel" required>
        </div>
        <div class="form-group">
          <label for="message">Message :</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <div class="form-group">
          <label for="captcha">Veuillez recopier le texte de l'image :</label>
          <img src="captcha.php" alt="Captcha" id="captcha">
          <input type="text" class="form-control" id="captcha-input" name="captcha-input" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
      </form>
    </div>
  </div>
</div>



<?php

render('footer');

?>
