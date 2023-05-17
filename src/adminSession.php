<?php

// if there is 
session_start();

use Admin\{
    Admins,
};

$clients = new Admins(get_pdo());

if (!isset($_SESSION['auth-admin'])) {
    header('Location: login.php?forbidden=1');
}