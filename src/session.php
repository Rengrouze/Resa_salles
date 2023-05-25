<?php

// if there is 
session_start();
// if session is auth_admin destroy it
if (isset($_SESSION['auth-admin'])) {
    session_destroy();
    header('Location: ../public/login.php');
    exit();
}



if (isset($_SESSION['auth'])) {
    $username = $_COOKIE['username'];
}