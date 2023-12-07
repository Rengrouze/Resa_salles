<?php

use Calendar\Photos;
use Calendar\Rooms;

require '../src/bootstrap.php';
$photos = new Photos(get_pdo());
$rooms = new Rooms(get_pdo());
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si la requête est une requête POST, alors c'est la demande d'upload
    $roomId = $_POST['roomId'];
    $filename = $_POST['filename'];
    $imageData = $_POST['image'];

    // Convertir l'image base64 en fichier image
    $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
    $photo = $photos->hydratePhoto(new \Calendar\Photo(), ['id_room' => $roomId, 'min' => 1]);
    $lastInsertId = $photos->addPhoto($photo);
    // Chemin où vous souhaitez sauvegarder l'image mise à jour
    $newImagePath = "../public/images/room_images/$roomId/min/$lastInsertId.png";
    // Écrire l'image sur le disque
    file_put_contents($newImagePath, $decodedImage);
    $tempImagePath = __DIR__ . "/public/images/room_images/$roomId/min/temp/$filename";
    unlink($tempImagePath);
    header('Location: http://resasite/admin/rooms.php');
} else {
    // Si la requête n'est pas une requête POST, alors c'est la demande de la page HTML
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>PHP recadrer l'image avant téléchargement</title>

        <style>
            img {
                display: block;
                width: auto;
                height: auto;
                max-width: 100%;
            }

            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 900px;
                width: 100%;
            }

            .imgDisplay {
                width: 50%;
            }

            #output {
                margin: 0 5px;
            }
        </style>
    </head>

    <body>

        <?php
        // get in the url the roomId and the filename
        $roomId = $_GET['roomId'];
        $filename = $_GET['filename'];
        ?>

        <div class="container">
            <div class="imgDisplay">
                <img src="/public/images/room_images/<?= $roomId ?>/min/temp/<?= $filename ?>" alt="" id="image">
                <button id="cropImageButton">Crop Image</button>
            </div>
            <div class="imgDisplay"> <img src="" alt="" id="output"></div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js" integrity="sha512-Zt7blzhYHCLHjU0c+e4ldn5kGAbwLKTSOTERgqSNyTB50wWSI21z0q6bn/dEIuqf6HiFzKJ6cfj2osRhklb4Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cropper/1.0.1/jquery-cropper.js" integrity="sha512-7H4tikIFoyAdYD31w/uNYvvAUL6gyunWXLwTQ7ZXkyjD+brw+PfJpLxFkANnbkKnSJzU89YpnF3fJKbpvV+QYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cropper/1.0.1/jquery-cropper.min.js" integrity="sha512-V8cSoC5qfk40d43a+VhrTEPf8G9dfWlEJgvLSiq2T2BmgGRmZzB8dGe7XAABQrWj3sEfrR5xjYICTY4eJr76QQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            var $image = $('#image');

            $image.cropper({
                aspectRatio: 1,
                crop: function(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                }
            });

            // Get the Cropper.js instance after initialized
            var cropper = $image.data('cropper');
            document.getElementById('cropImageButton').addEventListener('click', function() {
                var croppedImage = cropper.getCroppedCanvas().toDataURL("image/png");

                // Envoyer l'image croppée au serveur
                $.ajax({
                    type: 'POST',
                    url: 'accueil_photo.php', // Mettez le nom de ce fichier PHP
                    data: {
                        roomId: <?= $roomId ?>,
                        filename: 'nouveau_nom_image.png', // Vous pouvez utiliser le même nom ou en générer un nouveau
                        image: croppedImage
                    },
                    success: function(response) {
                        console.log('Image mise à jour avec succès !');
                        // Vous pouvez ajouter ici d'autres actions si nécessaire
                    },
                    error: function(error) {
                        console.error('Erreur lors de la mise à jour de l\'image :', error);
                    }
                });
            });
        </script>
    </body>

    </html>
<?php } ?>