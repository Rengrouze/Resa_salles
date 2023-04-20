<?php
// is session started? if no redirect to login page
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




render('header', ['title' => 'Salle 1', 'script' => 'index.js', 'style' => 'calendar.css']);

?>

<section class="section bg-light" id="next">


    <div class="container calendar-container">
        <div class="row flex-col justify-content-center">
            <div class="col-lg-8 flex-row">


                <div>
                    <div class="calendar" id="calendar">

                        <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
                            <h1 class="verdana">
                                <?= $month->toString(); ?>
                            </h1>
                            <!--  <?php if (isset($_GET['success'])): ?>
                                    <div class="container">
                                        <div class="alert alert-success">
                                            L'événement a bien été ajouté
                                        </div>
                                        <?php endif; ?>-->
                            <div><a href="calendar.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>"
                                    class="btn btn-primary previous-month ">&lt;</a>
                                <a href="calendar.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>"
                                    class="btn btn-primary next-month ">&gt;</a>
                            </div>

                        </div>




                        <table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
                            <tr>
                                <?php foreach ($days as $k => $day):
                                    // check if the cell is at the top left corner
                                    $isTopLeft = $k === 0 && $weeks === 5;
                                    // check if the cell is at the top right corner
                                    $isTopRight = $k === 6 && $weeks === 5;

                                    ?>
                                    <td
                                        class="no-click <?= $isTopLeft ? 'corner-top-left' : ''; ?> <?= $isTopRight ? 'corner-top-right' : ''; ?>">
                                        <div class="d-none d-lg-inline font-weight-bold">
                                            <?= $day; ?>
                                        </div>
                                        <div class=" d-lg-none">
                                            <?= mb_substr($day, 0, 1); ?>
                                        </div>
                                    </td>
                                <?php endforeach; ?>

                            </tr>
                            <?php for ($i = 0; $i < $weeks; $i++): ?>
                                <tr>


                                    <?php foreach ($month->days as $k => $day):
                                        $date = $start->modify("+" . ($k + $i * 7) . "days");

                                        $isToday = date('Y-m-d') === $date->format('Y-m-d');
                                        // check if the day is in the busyDays array
                                        $isBusy = in_array($date->format('Y-m-d'), $busyDays);
                                        $isBusyTemp = in_array($date->format('Y-m-d'), $busyDaysTemp);
                                        $isaPastDayFromToday = $date->format('Y-m-d') <= date('Y-m-d');


                                        // check if the cell is at the bottom left corner
                                        $isBottomLeft = $k === 0 && $i === $weeks - 1;
                                        // check if the cell is at the bottom right corner
                                        $isBottomRight = $k === 6 && $i === $weeks - 1;
                                        ?>
                                        <td
                                            class="<?= $date->format('Y-m-d'); ?> <?= $isaPastDayFromToday ? 'past-day' : '' ?> <?= $month->withinMonth($date) ? '' : 'calendar__overmonth'; ?> <?= $isToday ? 'is-today' : ''; ?> <?= $isBusy ? 'is-busy' : ''; ?> <?= $isBusyTemp ? 'is-busy-temp' : ''; ?><?= $isBottomLeft ? 'corner-bottom-left' : ''; ?> <?= $isBottomRight ? 'corner-bottom-right' : ''; ?>">
                                            <div
                                                class="<?= $date->format('Y-m-d'); ?> circle <?= $isBusy ? 'is-busy' : ''; ?> <?= $isBusyTemp ? 'is-busy-temp' : ''; ?> ">
                                                <a class="<?= $date->format('Y-m-d'); ?> calendar__day prevent-default"
                                                    href="add.php?date=<?= $date->format('Y-m-d'); ?>">
                                                    <?= $date->format('d'); ?>
                                                </a>
                                            </div>

                                        </td>
                                    <?php endforeach; ?>

                                </tr>
                            <?php endfor; ?>
                        </table>


                    </div>
                </div>
                <div class="text-center mt-3">
                    <button id="validate" class="btn btn-primary ">Valider</button>
                </div>

            </div>


        </div>
    </div>
    </div>
    <script src="../src/App/navigate_calendar.js"></script>


</section>

