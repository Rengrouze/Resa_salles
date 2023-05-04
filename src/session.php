<?php

// if there is 
session_start();

use Calendar\{
    Clients,
};

$clients = new Clients(get_pdo());

if (isset($_SESSION['auth'])) {
    $username = $_COOKIE['username'];
}