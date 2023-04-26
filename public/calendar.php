<?php
// is session started? if no redirect to login page
require('../src/calendar.php');




render('header', ['title' => 'Salle 1', 'script' => 'index.js', 'style' => 'calendar.css']);

?>



<div class="container-fluid d-flex flex-row mx-auto mt-5 mb-4 ">
    <div class="container calendar-container">
        
           
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
                            <div>
                                <a href="calendar.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>&room=<?= $roomOption; ?>"
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
                                    <td class="no-click <?= $isTopLeft ? 'corner-top-left' : ''; ?> <?= $isTopRight ? 'corner-top-right' : ''; ?>">
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
                                        <td class="<?= $date->format('Y-m-d'); ?> <?= $isaPastDayFromToday ? 'past-day' : '' ?> <?= $month->withinMonth($date) ? '' : 'calendar__overmonth'; ?> <?= $isToday ? 'is-today' : ''; ?> <?= $isBusy ? 'is-busy' : ''; ?> <?= $isBusyTemp ? 'is-busy-temp' : ''; ?><?= $isBottomLeft ? 'corner-bottom-left' : ''; ?> <?= $isBottomRight ? 'corner-bottom-right' : ''; ?> calendar-date">
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
                    <div class="mt-3">
                    <button id="validate" class="btn btn-primary d-md-none">Valider</button>
                    </div>
                
                
           
    </div>

    <!-- second section -->
    <div class="container mt-4 d-none d-md-block">
  <div class="card">
    <div class="card-header">
      Dates sélectionnées pour la salle <?= $roomOption; ?>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>
            <tr>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="date-list" style="max-height:50vh; overflow-y:auto;">
        <table class="table mb-0">
          <tbody id="date-list">
        <!--    <tr>
              <td>25/04/2023</td>
              <td><button class="btn btn-sm btn-danger">Supprimer</button></td>
            </tr> -->
            
           
            <!-- plus de lignes ici -->
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <button id="validate" class="btn btn-primary">Valider</button>
    </div>
  </div>
</div>









</div>
    <script src="../src/App/navigate_calendar.js"></script>


<?php
render('footer');

