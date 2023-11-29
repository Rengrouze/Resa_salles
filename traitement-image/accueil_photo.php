<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Traitement image</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css">
    <script src="https://unpkg.com/jcrop"></script>

    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="jc-demo-box">
                    <div class="page-header">
                        <ul class="breadcrumb first">
                            <li>
                                <h3>Téléchargez la photo à recadrer</h3>
                                c v <span class="divider">/</span>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            // Récupérer les informations de l'image de base depuis la base de données
                            $roomId = $_GET['roomId'];
                            $filename = $_GET['filename']; // À adapter selon la structure de ta base de données
                            
                            // Assure-toi que $roomId et $filename sont correctement définis
                            // Récupère les autres informations nécessaires depuis la base de données si nécessaire
                            
                            // Afficher l'image à recadrer
                            echo '<img src="../public/images/room_images/' . $roomId . '/min/temp/' . $filename . '" id="target">';

                            // Forme le formulaire de recadrage
                            echo '<form method="post" onsubmit="return checkCoords();">';
                            echo '<input type="hidden" id="image" name="image" />';
                            echo '<input type="hidden" id="x" name="x" />';
                            echo '<input type="hidden" id="y" name="y" />';
                            echo '<input type="hidden" id="w" name="w" />';
                            echo '<input type="hidden" id="h" name="h" />';
                            // ... (autres champs cachés nécessaires) ...
                            echo '<input type="submit" value="Recadrer" class="btn btn-large btn-inverse" />';
                            echo '<input type="button" value="Annuler" onclick="location=\'../formations.php\'" class="btn btn-large btn-inverse" />';
                            echo '</form>';
                            ?>
                            </form>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var jcrop;

        function updateCoords(c) {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        }

        function checkCoords() {
            // Vérifier si les coordonnées sont valides
            if (parseInt($('#w').val())) {
                // Soumettre le formulaire si les coordonnées sont valides
                return true;
            }
            alert('Merci de sélectionner la zone et appuyer sur recadrer.');
            return false;
        }

        // Attacher Jcrop à l'image cible
        jcrop = Jcrop.attach('target', {
            onSelect: updateCoords
        });
    </script>
</body>

</html>