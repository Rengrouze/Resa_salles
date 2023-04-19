<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquyery -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
 <!-- link to css -->
    <link rel="stylesheet" href="../public/css/index.css">
        

    
   <title>
    <?= $title ?? 'Resa Site'; ?>
    </title>
    <script>
$(document).ready(function(){
    $('.dropdown-toggle').on('mouseenter', function(){
        $(this).parent().addClass('show');
        $(this).attr('aria-expanded', true);
        $(this).next('.dropdown-menu').addClass('show');
    });

    $('.dropdown-toggle').on('mouseleave', function(){
        var dropdownMenu = $(this).next('.dropdown-menu');
        setTimeout(function(){
            if(!dropdownMenu.is(':hover')){
                dropdownMenu.removeClass('show');
                $(this).parent().removeClass('show');
                $(this).attr('aria-expanded', false);
            }
        }, 500);
    });

    $('.dropdown-menu').on('mouseenter', function(){
        $(this).addClass('show');
        $(this).prev('.dropdown-toggle').attr('aria-expanded', true);
    });

    $('.dropdown-menu').on('mouseleave', function(){
        $(this).removeClass('show');
        $(this).prev('.dropdown-toggle').attr('aria-expanded', false);
    });
});

</script>

</head>
<body>
    
