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
 
<link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
      aspectRatio: 370/252,
      onSelect: updateCoords

    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Merci de séléctionner la zone et appuyer sur recadrer.');
    return false;
  };

</script>


</head>
<body>

<div class="container">
  <div class="row">
    <div class="span12">
      <div class="jc-demo-box">

        <div class="page-header">
          <ul class="breadcrumb first">         
              <li> <h3>Téléchargez la photo à recadrer</h3> 
                <span class="divider">/</span>
              </li>            
          </ul>          
        </div>


        <div class="row">
          <?php 
          if (!isset($_FILES['photo']['tmp_name']))
          {?>

          <div class="col-lg-6">
        <!-- This is the image we're attaching Jcrop to --> 
        <!-------------------------------------------->
              <?php
     
              if(isset($_GET['image']))
              {
//On va chercher l'image dans le dossier avec le nom en base de données
                ?>

                <img src="../../images/formation/<?=$_GET['image']?>" width="400"/>
                <?php
              }

              if(!isset($_POST['image']))
              {?>
        
        <!-------------------------------------------->
          
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="photo" required> 
                    <br><br>      
                    <input type="submit" value="Télécharger votre image" class="btn btn-large btn-inverse">
                </form>
            <?php } ?>
          </div>
            <?php 
              }?>
          <div class="col-lg-6">
              <?php
            if (isset($_FILES['photo']['tmp_name']))
            {
              $extension = strtolower(strrchr($_FILES['photo']['name'], '.'));

                if ($extension == '.jpg' || $extension == '.jpeg')
                {

                  //je stocke mon image avec les vrais valeur dans le dossier origine
                  copy($_FILES['photo']['tmp_name'], 'origine/'.$_FILES['photo']['name']);
          
                   
                  // Je redimensionne mon image pour avoir une visibilité propre sur l'afficher à encadrer
                  $taille = getimagesize($_FILES['photo']['tmp_name']);
                  //var_dump($taille);
                  $largeur = $taille[0]; // correspond à weight
                  $hauteur = $taille[1]; // correspond à hight                  
                  $largeur_miniature = 500;
                  $hauteur_miniature = $hauteur / $largeur * $largeur_miniature;
                  $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
                  //var_dump($im);
                  // Determination de coefficient e fonction de la taille d'iage d'origine
                  $xw=$largeur/$largeur_miniature;
                  $yh=$hauteur/$hauteur_miniature;
                  

                  $im_miniature = imagecreatetruecolor($largeur_miniature
                  , $hauteur_miniature);    
                  imagecopyresampled($im_miniature, $im, 0, 0, 0, 0, $largeur_miniature, $hauteur_miniature, $largeur, $hauteur);
                  imagejpeg($im_miniature, 'temporaire/'.$_FILES['photo']['name'], 90);
                  echo '<img src="temporaire/' . $_FILES['photo']['name'] . '" id="cropbox">';

                   $form=
                        '<form  method="post" onsubmit="return checkCoords();">
                    
                          <input type="hidden" id="image" name="image" />
                          <input type="hidden" id="x" name="x" />
                          <input type="hidden" id="y" name="y" />
                          <input type="hidden" id="w" name="w" />
                          <input type="hidden" id="h" name="h" />
                          <input type="hidden" id="xw" name="xw" value="'.$xw.'" />
                          <input type="hidden" id="yh" name="yh" value="'.$yh.'" />
                        
                          <input type="hidden" name="nom" value="' . $_FILES['photo']['name'] . '" />
                          <input type="hidden" name="error" value=" " />
                          <input type="hidden" name="size" value=" " />
                          <input type="hidden" name="tmp_name" value=" " />

                          <input type="submit" value="Recader" class="btn btn-large btn-inverse" />
                          <input type="button" value="Annuler" onclick="location=../formations.php>"  class="btn btn-large btn-inverse"/>
                          </form>'; 
                        echo($form);
                }
                else
                {
                  echo('<p style="color : red">Please choose a .jpeg or .jpg extension for your image</br></p>');
                  //On va chercher dans le dossier et la base de données
                  ?>
                  <img src="../../images/formation/<?=$_GET['image']?>"/>
                  <form method="post" enctype="multipart/form-data">
                      <input type="file" name="photo" required>       
                      <input type="submit" value="charger la photo" class="btn btn-large btn-inverse">
                  </form>
                  <?php 

                }

            }
        

            if(isset($_POST['image']))
            {
                  
              $im_php = imagecreatefromjpeg('origine/'.$_POST['nom']);
              $size = min(imagesx($im_php), imagesy($im_php));
               
              $im_php = imagecrop($im_php,

              [
                'x' => $_POST['x']*$_POST['xw'],
                'y' => $_POST['y']*$_POST['yh'],
                'width' => ($_POST['w']*$_POST['xw'])+$_POST['x'],
                'height' => ($_POST['h']*$_POST['yh'])+$_POST['y']
              ]);
             
              $id=$_GET['id'];
              $nexTaille=($_POST['w']*$_POST['xw'])+$_POST['x'];
              //var_dump($nexTaille);
              $im_php = imagescale($im_php,$nexTaille);
              //On va chercher dans le dossier et la base de données sur deux lignes
              imagejpeg($im_php, '../../images/formation/'.$_POST['nom'], 90);
              echo '<img src="../../images/formation/'.$_POST['nom'].'" width="400">
              <p></p>
              <a href="../controller/controller-formation.php?form=ajouterPhoto&id='.$id.'&photo='.$_POST['nom'].'" class="btn btn-primary btn-icon-split btn-sm">
                          <span class="icon text-white-50">
                            <i class="fas fa-flag"></i>
                          </span>
                          <span class="text">Insérer l\'image</span>
                        </a>
              <a href="../equipe.php" class="btn btn-primary btn-icon-split btn-sm">
                          <span class="icon text-white-50">
                            <i class="fas fa-flag"></i>
                          </span>
                          <span class="text">Anuler l\'insertion</span>
                        </a>
              ';

            }?>    

          </div>
        </div>

      </div>
    </div>
  </div>
</div>


</body>

</html>