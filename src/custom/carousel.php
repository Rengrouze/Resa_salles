<?php
switch ($room) {
    case 'room1':
        $firstSlideTitle = 'Idéale pour formations';
        $firstSlideParagraph = '70m², vidéoprojecteur, paperboard, wifi, 30 personnes';
        $secondSlideTitle = 'Équipée pour présentations';
        $secondSlideParagraph = 'Écran de projection, système audio, micro, wifi, 30 personnes';
        $thirdSlideTitle = 'Fonctionnelle pour réunions';
        $thirdSlideParagraph = 'Paperboard, wifi, prises électriques, 30 personnes';
        break;
    case 'room2':
        $firstSlideTitle = 'Lumineuse pour formations';
        $firstSlideParagraph = '50m², grandes fenêtres, vidéoprojecteur, paperboard, wifi, 20 personnes';
        $secondSlideTitle = 'Modulable pour réunions';
        $secondSlideParagraph = 'Tables/chaises modulables, écran de projection, système audio, micro, 20 personnes';
        $thirdSlideTitle = 'Confortable pour formations';
        $thirdSlideParagraph = 'Sièges confortables, wifi, paperboard, 20 personnes';
        break;
    case 'room3':
        $firstSlideTitle = 'Équipée pour événements';
        $firstSlideParagraph = 'Grand écran de projection, système audio, micro, wifi, 50 personnes';
        $secondSlideTitle = 'Spacieuse pour réunions';
        $secondSlideParagraph = '100m², paperboard, vidéoprojecteur, wifi, 50 personnes';
        $thirdSlideTitle = 'Moderne pour formations';
        $thirdSlideParagraph = 'Mobilier moderne/ergonomique, wifi, paperboard, 50 personnes';
        break;
        default:
        // Invalid room, redirect to index.php
        header('Location: index.php');
        exit();
}


?>