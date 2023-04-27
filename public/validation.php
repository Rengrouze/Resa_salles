<?php
require '../src/bootstrap.php';



render ('header', ['title' => 'Reserver un créneau', 'script' => 'index.js']);
require '../src/validate-booking.php';

?>
<div class="container mt-2 mb-4 d-flex flex-row justify-content-between">
    <div class="col-md-6">
        <div class="w-100">
            <h2>Informations du client</h2>
            <ul class="list-group">
                <li class="list-group-item">Nom :
                    <?= $client->getName(); ?>
                </li>
                <li class="list-group-item">Prénom :
                    <?= $client->getFirstName(); ?>
                </li>
                <li class="list-group-item">Email :
                    <?= $client->getEmail(); ?>
                </li>
                <li class="list-group-item">Téléphone :
                    <?= $client->getPhone(); ?>
                </li>
                <li class="list-group-item">Entreprise :
                    <?= $client->getBusiness(); ?>
                </li>
                <li class="list-group-item">SIRET :
                    <?= $client->getSiret(); ?>
                </li>
                <li class="list-group-item">Adresse :
                    <?= $client->getAddress(); ?>
                </li>
                <li class="list-group-item">Ville :
                    <?= $client->getCity(); ?>
                </li>
                <li class="list-group-item">Code postal :
                    <?= $client->getPostalCode(); ?>
                </li>
                <input type="hidden" name="client_id"
                        value="<?= $client->getId(); ?>">
            </ul>
        </div>
        <form method="post" action="">
            <!-- Convertir la div en un formulaire -->
            <div >
                <h2>Informations de réservation</h2>
                <ul class="list-group">
                    <?php foreach ($daysForDisplay as $index => $day): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                Jour
                                <?= $index + 1 ?> :
                                <?= $day; ?>
                            </div>
                            <div>
                                <span>
                                    <?= $price ?> €
                                </span> <!-- Prix à droite avec badge Bootstrap -->
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <h4 class="text-right mt-3">Prix total :
                    <?= $price * $daysCount ?> €
                </h4> <!-- Prix total en dessous de la liste -->

                <!-- Champs d'entrée cachés et lisibles seulement -->
                <div class="row">
                    <input type="hidden" name="idClient" value="<?= $client->getId() ?>">
                </div>
                <input type="hidden" name="numberOfDays" value="<?= $daysCount ?>" readonly>
                <input type="hidden" name="days" value="<?= implode(',', $days) ?>" readonly>
                <input type="hidden" name="totalPrice" value="<?= $price * $daysCount ?>" readonly>
                <input type="hidden" name="temporary" value="1">
                <!-- Champ d'entrée caché pour l'ID du client -->
                <label for="reason">Motif de la réservation :</label>
                <div class="row">   <input type="text" name="reason" required placeholder="Formation, séminaire, etc..."></div>
            

                <div class="d-flex flex-row justify-content-between">
                <button type="submit" class="btn btn-primary mt-3">Réserver</button>
                <!-- Bouton de soumission du formulaire -->
                <a href="/public/index.php" class="btn btn-secondary mt-3 d-block">Retour</a>
                </div>
                
            </div>
        </form>
        </div>
        <div class="col-md-6">
            <h4 class="text-center">Une fois validé comment se passe la suite ?</h4>
            <p class="text-center">Une fois validé, les dates que vous avez choisi seront bloqué pendant 48h (sauf cas particulier) vous recevrez un mail de confirmation avec un devis. Vous devrez confirmer votre reservation à partir de votre compte ou du lien dans le mail de confirmation</p>

        </div>
</div>


<?php

render ('footer');

