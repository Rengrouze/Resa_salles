<?php 
            // get all the rooms from the database and display them in the dropdown menu
            use Calendar\{
                
                Rooms
            };
            $pdo = get_pdo();
            $rooms = new Rooms($pdo);
            $allRooms = $rooms->getRooms();
            