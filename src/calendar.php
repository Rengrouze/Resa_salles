<?php
require '../src/bootstrap.php';

use Calendar\{
    Month,
    Bookings
};

$pdo = get_pdo();
$roomOption= $_GET['room'] ?? null;
$bookings = new Bookings($pdo);
// get all busy days of the month with getBookingsBetweenByDay
$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay();
$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();

$end = $start->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');

//create an array with the name of the day using days in the month class
$days = $month->days;

$daysBooked = $bookings->getBookingsBetween($start, $end);

// create an array wich contains all the busy days where temporary = 0
$busyDays = [];
$busyDaysTemp = [];
foreach ($daysBooked as $day) {

    if ($day->getTemporary() == 0) {
        $busyDays[] = $day->getDay()->format('Y-m-d');
    }
}
//create another array wich contains all the busy days where temporary = 1
foreach ($daysBooked as $day) {
    if ($day->getTemporary() == 1) {
        $busyDaysTemp[] = $day->getDay()->format('Y-m-d');
    }
}


/*
foreach ($daysBooked as $day) {
$busyDays[] = $day->getDay()->format('Y-m-d');
}*/
