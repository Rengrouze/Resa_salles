<?php 
            // get all the rooms from the database and display them in the dropdown menu
            use Calendar\{
                Client,
                Rooms
            };
            require_once '../src/Calendar/Client.php';
            $pdo = get_pdo();
            $rooms = new Rooms($pdo);

            $allRooms = $rooms->getRooms();
            if (isset($_SESSION['auth'])) {
                $client = $_SESSION['auth'];
                $username = $_COOKIE['username'];
            }
  
            // get the username in the cookie
   
            // get the client id from the database
            