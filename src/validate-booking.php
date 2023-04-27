<?php
$days = $_GET['days'] ?? null;
if (!$days) {
    e404();
}


// destructure the string into an array
$days = explode(',', $days);

$daysForDisplay = $days;



array_walk($daysForDisplay, function (&$day) {
    $date = new DateTime($day);
    $day = $date->format('d/m/Y');
});

//ask the db if theses days are already booked
$bookings = new \Calendar\Bookings(get_pdo());
$bookedDays = $bookings->getBookedDays($days);
// if there are booked days
if (!empty($bookedDays)) {
    // convert the booked days to a string
    header('Location: /public/index.php?error=1');
}
// count how many days are selected
$daysCount = count($days);

$client = $_SESSION['auth'];
// if client ID is null ask the db for id


// Prix par jour
$price = 200; // Mettez le prix par jour souhaité ici



// if there is posted data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get the data

    //ask the db again if theses days are already booked
    $bookings = new \Calendar\Bookings(get_pdo());
    $bookedDays = $bookings->getBookedDays($days);
    // if there are booked days
    if (!empty($bookedDays)) {
        // convert the booked days to a string
        header('Location: /public/index.php?error=1');
    }


    $data = $_POST;


    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($data);
    if (empty($errors)) {
        // create the event
        $events = new \Calendar\Bookings(get_pdo());
        $event = $events->hydrateEvent(new \Calendar\Event(), $data);

        //create event return an id save it
        $eventId = $events->createEvent($event);
        //add the eventID to the data
        $data['idBookings'] = $eventId;


        // change days from a string to an array
        $days = explode(',', $data['days']);
        // convert Eeach day to a DateTime object

        // put the days back into the data by the name day
        $data['day'] = $days;


        //remove unneeded data
        unset($data['idClient']);
        unset($data['numberOfDays']);
        unset($data['reason']);
        unset($data['totalPrice']);
        unset($data['days']);

        //change the order of the data, day first, then temporary, then idBookings
        $data = array_merge(['day' => $data['day']], ['temporary' => $data['temporary']], ['idBookings' => $data['idBookings']]);


        // loop through the days
        //for each day create a booking with the event id and the day
        foreach ($days as $day) {
            $data['day'] = $day;

            $booking = $events->hydrateBooking(new \Calendar\Booking(), $data);

            $events->createBooking($booking);
        }

        // redirect to the index with a success message
        header('Location: /public/profile.php?success=1');
        exit();




    }


    // validate the data

}

