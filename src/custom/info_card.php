



<?php

switch ($room) {
    case 'room1':
        $sectionTitle1 = 'Une grande salle';
        $sectionParagraph1 = 'La salle 1 est une salle gigantesque, avec une capacité d\'accueil de plus de 20 personnes. Elle est équipée de tout le nécessaire pour vos événements les plus importants. Ses grandes baies vitrées vous offriront une vue imprenable sur la ville.';
        $sectionTitle2 = 'Salle de réunion';
        $sectionParagraph2 = 'La salle de réunion adjacente est idéale pour vos réunions en petit comité. Elle peut accueillir jusqu\'à 20 personnes et est équipée d\'un tableau blanc, d\'un vidéoprojecteur et d\'une connexion Wi-Fi haut débit.';
        $sectionTitle3 = 'Salle de détente';
        $sectionParagraph3 = 'Pour vos moments de détente, nous vous proposons une salle dédiée équipée d\'un billard, d\'une table de ping-pong et d\'un baby-foot. Un espace convivial pour vos pauses entre deux réunions ou pour vos soirées détente.';
        break;
    case 'room2':
        $sectionTitle1 = 'Salle de conférence';
        $sectionParagraph1 = 'La salle 2 est une salle de conférence équipée de tout le nécessaire pour vos événements professionnels. Elle peut accueillir jusqu\'à 20 personnes et dispose d\'un système de sonorisation, d\'un vidéoprojecteur, d\'un écran géant et d\'une connexion Wi-Fi haut débit.';
        $sectionTitle2 = 'Salle de réunion';
        $sectionParagraph2 = 'La salle de réunion adjacente est idéale pour vos réunions en petit comité. Elle peut accueillir jusqu\'à 20 personnes et est équipée d\'un tableau blanc, d\'un vidéoprojecteur et d\'une connexion Wi-Fi haut débit.';
        $sectionTitle3 = 'Salle de restauration';
        $sectionParagraph3 = 'Pour vos pauses déjeuner ou vos cocktails, nous vous proposons une salle dédiée équipée d\'un bar, d\'un buffet et d\'un espace lounge. Un lieu convivial pour vos moments de détente.';
        break;
    case 'room3':
        $sectionTitle1 = 'Salle de réunion';
        $sectionParagraph1 = 'La salle 3 est une salle de réunion équipée de tout le nécessaire pour vos réunions en petit comité. Elle peut accueillir jusqu\'à 20 personnes et est équipée d\'un tableau blanc, d\'un vidéoprojecteur et d\'une connexion Wi-Fi haut débit.';
        $sectionTitle2 = 'Salle de détente';
        $sectionParagraph2 = 'Pour vos moments de détente, nous vous proposons une salle dédiée équipée d\'un billard, d\'une table de ping-pong et d\'un baby-foot. Un espace convivial pour vos pauses entre deux réunions ou pour vos soirées détente.';
        $sectionTitle3 = 'Salle de conférence';
        $sectionParagraph3 = 'La salle de conférence adjacente est idéale pour vos événements professionnels. Elle peut accueillir jusqu\'à 20 personnes et dispose d\'un système de sonorisation, d\'un vidéoprojecteur, d\'un écran géant et d\'une connexion Wi-Fi haut débit.';
        break;

 
    default:
        // Invalid room, redirect to index.php
        header('Location: index.php');
        exit();
}


