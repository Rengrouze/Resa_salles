<?php

// if there is 
session_start();
if (isset($_SESSION['auth'])) {
    $username = $_COOKIE['username'];
}