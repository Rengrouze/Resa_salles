</main>
<footer class="bg-light py-4 p-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5>Espace client</h5>
                <ul class="list-unstyled">
                    <?php 
          if (isset($_SESSION['auth'])) {
            echo '<li><a href="#">Mon compte</a></li>
            <li><a href="#">Mes réservations</a></li>
            <li><a href="../src/logout.php">Me déconnecter</a></li>';
          } else {
            echo '<li><a href="../public/login.php">Se connecter</a></li>
            <li><a href="../public/signup.php">S\'inscrire</a></li>';
          }
          ?>

                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Navigation du site</h5>
                <ul class="list-unstyled">
                    <li><a href="../public/roompicker.php?option=room-info">Descriptions de nos salles</a></li>
                    <li><a href="../public/info.php">Infos pratiques</a></li>
                    <li><a href="../public/roompicker.php?option=calendar">Calendrier de réservation</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Nous contacter</h5>
                <ul class="list-unstyled">
                    <li>Cdo formation</li>
                    <li>4 rue du couvent</li>
                    <li>41200, Millançay</li>
                    <li><a href="mailto:contact@cdo-formation.fr?subject=Renseignement location salle"><i
                                class="fas fa-envelope"></i> contact@cdo-formation.fr</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Contactez-nous</h5>
                <ul class="list-unstyled">
                    <li><a href="tel:+33254960260"><i class="fas fa-phone"></i> Numéro de téléphone : 02 54 96 02 60</a>
                    </li>
                    <li><a href="#"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                    <li><a href="#"><i class="fab fa-telegram-plane"></i> Telegram</a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="bg-secondary">
    <div class="container text-center">
        <span class="text-muted">© 2023 Cdo-formation. Tous droits réservés.</span>
    </div>
</footer>

<style>
footer {
    border-top: 2px solid #ccc;
    position: relative;
    bottom: 0;
    width: 100%;
}

ul.list-unstyled li a {
    text-decoration: none;
    color: #333;
    display: block;
    padding: 0.25rem 0;
}

ul.list-unstyled li a:hover {
    text-decoration: underline;
}
</style>




<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>

</html>