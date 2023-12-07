<?php
// https://youtu.be/MttSRUarA6g
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP recadrer l'image avant telechargement</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
</head>

<style>
    img{
        display : block;
        width: auto;
        height: auto;
        max-width: 100%;

    }
    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 900px;
        width: 900px;
    }

    #output{
        margin: 0 5px;
      
    }
</style>
<body>
<?php

// get in the url the roomId and the filename
$roomId = $_GET['roomId'];
$filename = $_GET['filename'];
?>
<div class="container">
    <div>
        <img src="/public/images/room_images/<?=$roomId?>/min/temp/<?=$filename?>" alt="" id="image">
        <button id="cropImageButton"></button>
    </div>
    <img src="" alt="" id="output">
</div>

<script>
const image = document.getElementById('image');
const cropper = new Cropper(image, {
    aspectRatio: 1 / 1,
    crop(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
    },
});
  
</script>
</body>
</html>