<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Traitement image</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <link rel="stylesheet" href="css/demos.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
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
                                <span class="divider">/</span>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <?php
                        if (!isset($_FILES['photo']['tmp_name'])) {
                            ?>
                            <div class="col-lg-6">
                                <?php
                                if (isset($_GET['filename'])) {
                                    // Afficher l'image temporaire à recadrer
                                    echo '<img src="../public/images/room_images/' . $roomId . '/min/temp/' . $_GET['filename'] . '" id="cropbox">';
                                }
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if (!isset($_POST['image'])) {
                                    ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="file" name="photo" required>
                                        <br><br>
                                        <input type="submit" value="Télécharger votre image" class="btn btn-large btn-inverse">
                                    </form>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-lg-12">
                                <?php
                                $extension = strtolower(strrchr($_FILES['photo']['name'], '.'));

                                if ($extension == '.jpg' || $extension == '.jpeg') {
                                    // Déplacer l'image temporaire vers le dossier approprié
                                    $targetDirectory = '../public/images/room_images/' . $roomId . '/min/temp/';
                                    $targetPath = $targetDirectory . $_FILES['photo']['name'];

                                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
                                        echo '<img src="' . $targetPath . '" id="cropbox">';
                                        echo '<form method="post" onsubmit="return checkCoords();">';
                                        echo '<input type="hidden" id="image" name="image" />';
                                        echo '<input type="hidden" id="x" name="x" />';
                                        echo '<input type="hidden" id="y" name="y" />';
                                        echo '<input type="hidden" id="w" name="w" />';
                                        echo '<input type="hidden" id="h" name="h" />';
                                        echo '<input type="hidden" id="xw" name="xw" value="' . $xw . '" />';
                                        echo '<input type="hidden" id="yh" name="yh" value="' . $yh . '" />';
                                        echo '<input type="hidden" name="nom" value="' . $_FILES['photo']['name'] . '" />';
                                        echo '<input type="hidden" name="error" value="" />';
                                        echo '<input type="hidden" name="size" value="" />';
                                        echo '<input type="hidden" name="tmp_name" value="" />';
                                        echo '<input type="submit" value="Recadrer" class="btn btn-large btn-inverse" />';
                                        echo '<input type="button" value="Annuler" onclick="location=\'../formations.php\'" class="btn btn-large btn-inverse" />';
                                        echo '</form>';
                                    } else {
                                        echo '<p style="color: red;">Erreur lors du déplacement du fichier</p>';
                                    }
                                } else {
                                    echo '<p style="color: red;">Veuillez choisir une image au format .jpeg ou .jpg</p>';
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#cropbox').Jcrop({
                aspectRatio: 1920 / 800,
                onSelect: updateCoords
            });
        });

        function updateCoords(c) {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        };

        function checkCoords() {
            if (parseInt($('#w').val())) return true;
            alert('Merci de sélectionner la zone et appuyer sur recadrer.');
            return false;
        };
    </script>
</body>

</html>