<?php
session_start();

// if cookie is set, delete it
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600);
}


session_destroy();

header('Location: ../public/index.php');