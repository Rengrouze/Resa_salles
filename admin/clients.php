<?php
require '../src/bootstrap.php';
require '../src/adminSession.php';

render_admin('header', ['title' => 'Mon compte', 'script' => 'index.js']);
render_admin('asidemenu');
?>
<!-- .app-main -->
<main class="app-main">
    <!-- .wrapper -->
    <div class="wrapper">
        <!-- .page -->
        <div class="page has-sidebar has-sidebar-fluid has-sidebar-expand-xl">
            <!-- .page-inner -->
            <div class="page-inner page-inner-fill position-relative">
                <header class="page-navs bg-light shadow-sm">
                    <!-- .input-group -->
                    <div class="input-group has-clearable">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i
                                    class="fa fa-times-circle"></i></span></button> <label class="input-group-prepend"
                            for="searchClients"><span class="input-group-text"><span
                                    class="oi oi-magnifying-glass"></span></span></label> <input type="text"
                            class="form-control" id="searchClients" data-filter=".board .list-group-item"
                            placeholder="Trouver un client">
                    </div><!-- /.input-group -->
                </header><button type="button" class="btn btn-primary btn-floated position-absolute" data-toggle="modal"
                    data-target="#clientNewModal" title="Add new client"><i class="fa fa-plus"></i></button>
                <!-- board -->
                <div class="board p-0 perfect-scrollbar">
                    <!-- .list-group -->
                    <div class="list-group list-group-flush list-group-divider border-top" data-toggle="radiolist">
                        <!-- .list-group-item -->

                        <?php

                        use Calendar\Clients;

                        $clients = new Clients(get_pdo());

                        $allClients = $clients->findAllClients();
                        // check in the url if get id is set
                       


                        ?>

                        <?php foreach ($allClients as $client): ?>

                        <?php $initial = $client->getBusiness()[0];
                          // if it is the first loop AND there is no GET parameter, set the first client to active and launch the updateClientDetails function
                          
                            if (!isset($_GET['id']) && $client === reset($allClients)) {
                                $active = 'active';
                            } elseif (isset($_GET['id']) && $client->getId() === $_GET['id']) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                        

                           ?>
                        <div class="list-group-item <?=$active?>" data-toggle="sidebar" data-sidebar="show">
                            <a href="#" class="stretched-link"
                                onclick="updateClientDetails(<?= $client->getId() ?>)"></a>
                            <!-- .list-group-item-figure -->
                            <div class="list-group-item-figure">
                                <div class="tile tile-circle bg-blue"> <?= $initial ?> </div>
                            </div><!-- /.list-group-item-figure -->
                            <!-- .list-group-item-body -->
                            <div class="list-group-item-body">
                                <h4 class="list-group-item-title"> <?= $client->getBusiness(); ?> </h4>
                                <p class="list-group-item-text"><?= $client->getAddress(); ?>, <?= $client->getCity() ?>
                                </p>
                            </div><!-- /.list-group-item-body -->
                        </div><!-- /.list-group-item -->

                        <?php endforeach; ?>






                        <!-- .list-group-item 
                        <div class="list-group-item">
                            .list-group-item-body 
                            <div class="list-group-item-body text-center py-4">
                                 .spinner 
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div> /.spinner 
                            </div>/.list-group-item-body 
                        </div>/.list-group-item -->
                    </div><!-- /.list-group -->
                </div><!-- /board -->
            </div><!-- /.page-inner -->
            <!-- .page-sidebar -->
            <div class="page-sidebar bg-light">
                <!-- .sidebar-header -->
                <header class="sidebar-header d-xl-none">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <a href="#" onclick="Looper.toggleSidebar()"><i
                                        class="breadcrumb-icon fa fa-angle-left mr-2"></i>Back</a>
                            </li>
                        </ol>
                    </nav>
                </header><!-- /.sidebar-header -->
                <!-- .sidebar-section -->

                <?php 
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $client = $clients->findClientById($id);
                } else {
                    $client = $clients->getFirstClient();
                }
                
                
                $creationDay = $client->getCreationDay()->format('d/m/Y');

                ?>
                <div class="sidebar-section sidebar-section-fill" id="clientDetailsTabs">
                    <h1 class="page-title">
                        <i class="far fa-building text-muted mr-2"></i> <?= $client->getBusiness(); ?> - Compte créé le
                        <?= $creationDay ?>
                    </h1>
                    <p class="text-muted"> <?= $client->getAddress()?>, <?=$client->getCity();?></p>
                    <!-- .nav-scroller -->
                    <div class="nav-scroller border-bottom">
                        <!-- .nav-tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#client-billing-contact">Adresse
                                    et contact</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#client-projects">Reservations en
                                    attente</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#client-invoices">Reservations validées</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#client-expenses">Factures</a>
                            </li>
                        </ul><!-- /.nav-tabs -->
                    </div><!-- /.nav-scroller -->
                    <!-- .tab-content -->
                    <div class="tab-content pt-4" id="clientDetailsTabs">
                        <!-- .tab-pane -->
                        <div class="tab-pane fade show active" id="client-billing-contact" role="tabpanel"
                            aria-labelledby="client-billing-contact-tab">
                            <!-- .card -->
                            <div class="card">
                                <!-- .card-body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 id="client-billing-contact-tab" class="card-title"> Adresse de facturation
                                        </h2>
                                        <button type="button" class="btn btn-link" data-toggle="modal"
                                            data-target="#clientBillingEditModal">modifier</button>
                                    </div>
                                    <address> <?= $client->getAddress()?><br> <?php 
                                    //if there is an address complement, display it
                                    if ($client->getAddressComplement() != '' || $client->getAddressComplement() != null) {
                                        echo $client->getAddressComplement() . '<br>';
                                    }
                                    ?>


                                        <?=$client->getCity();?>, <?=$client->getPostalCode();?><br>
                                        <?= $client->getCountry()?> <br>
                                        SIRET : <?= $client->getSiret()?>
                                    </address>
                                    <!-- TODO : ADD COUNTRY IN SQL-->
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                            <!-- .card -->
                            <div class="card mt-4">
                                <!-- .card-body -->
                                <div class="card-body">
                                    <h2 class="card-title"> Contacts </h2><!-- .table-responsive -->
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="min-width: 678px">
                                            <thead>
                                                <tr>
                                                    <th> Nom </th>
                                                    <th> Email </th>
                                                    <th> Téléphone </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="align-middle"> <?= $client->getFirstName();?>
                                                        <?= $client->getName()?> </td>
                                                    <td class="align-middle"> <?= $client->getEmail();?> </td>
                                                    <td class="align-middle"> <?= $client->getPhone();?> </td>
                                                    <td class="align-middle text-right">
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                            data-toggle="modal" data-target="#clientContactEditModal"><i
                                                                class="fa fa-pencil-alt"></i> <span
                                                                class="sr-only">Edit</span></button> <button
                                                            type="button" class="btn btn-sm btn-icon btn-secondary"><i
                                                                class="far fa-trash-alt"></i> <span
                                                                class="sr-only">Remove</span></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- /.table-responsive -->
                                </div><!-- /.card-body -->
                                <?php
                                
                                ?>
                                <!-- .card-footer -->
                                <div class="card-footer">
                                    <a href="#clientContactNewModal" class="card-footer-item" data-toggle="modal"><i
                                            class="fa fa-plus-circle mr-1"></i> Add contact</a>
                                </div><!-- /.card-footer -->
                            </div><!-- /.card -->
                        </div><!-- /.tab-pane -->
                        <!-- .tab-pane -->

                        <!-- .tab-pane -->
                        <div class="tab-pane fade" id="client-projects" role="tabpanel"
                            aria-labelledby="client-projects-tab">
                            <!-- .card -->
                            <div class="card">
                                <!-- .card-header -->
                                <div class="card-header d-flex">
                                    <!-- .dropdown -->
                                    <div class="dropdown">
                                        <!-- <button type="button" class="btn btn-secondary" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><i
                                                class="fas fa-filter mr-1"></i> All (3) <i
                                                class="fa fa-caret-down"></i></button>  .dropdown-menu 
                                        <div class="dropdown-menu stop-propagation">
                                            <h6 id="client-projects-tab" class="dropdown-header"> Projects </h6><label
                                                class="custom-control custom-radio"><input type="radio"
                                                    class="custom-control-input" name="clientProjectFilter" value="0"
                                                    checked> <span class="custom-control-label">All (3)</span></label>
                                            <label class="custom-control custom-radio"><input type="radio"
                                                    class="custom-control-input" name="clientProjectFilter" value="1">
                                                <span class="custom-control-label">On Going (1)</span></label> <label
                                                class="custom-control custom-radio"><input type="radio"
                                                    class="custom-control-input" name="clientProjectFilter" value="2">
                                                <span class="custom-control-label">Completed (2)</span></label> <label
                                                class="custom-control custom-radio"><input type="radio"
                                                    class="custom-control-input" name="clientProjectFilter" value="3">
                                                <span class="custom-control-label">Archived (0)</span></label>
                                        </div> /.dropdown-menu -->
                                    </div><!-- /.dropdown -->
                                    <button type="button" class="btn btn-primary ml-auto">Ajouter manuellement une
                                        réservation</button>
                                </div><!-- /.card-header -->
                                <!-- .table-responsive -->

                                <?php 

                                use Calendar\Bookings;
                                use Calendar\Rooms;

                                $bookings = new Bookings(get_Pdo());
                                $rooms = new Rooms(get_Pdo());

                                if (!isset($_GET['id'])) {
                                    $clientId = $clients->getFirstId(); // Use getFirstId() to get the first ID in the database
                                    $allUnvalidatedEvents = $bookings->getAllUnValidatedEventsByClient($clientId);
                                    $allValidatedEvents = $bookings->getAllValidatedEventsByClient($clientId);
                                } else {
                                    $clientId = $_GET['id'];
                                    $allUnvalidatedEvents = $bookings->getAllUnValidatedEventsByClient($clientId);
                                    $allValidatedEvents = $bookings->getAllValidatedEventsByClient($clientId);
                                }
                                

                                

                              
                                
                            
                                

                                ?>
                                <div class="table-responsive">
                                    <!-- .table -->
                                    <table class="table">
                                        <!-- thead -->
                                        <thead>
                                            <tr>
                                                <th style="min-width:260px"> Motif de la Réservation </th>
                                                <th> Salle réservée </th>
                                                <th> Jours de la réservation </th>
                                                <th> Date de la reservation </th>
                                                <th> Prix </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead><!-- /thead -->
                                        <!-- tbody -->
                                        <tbody>
                                            <?php
                                        if (empty($allUnvalidatedEvents) && empty($allValidatedEvents)) {
                                            echo '<div class="alert alert-info">Aucune réservation n\'a été effectuée pour ce client</div>';
                                        }
                                        ?>
                                            <!-- tr -->

                                            <?php foreach($allUnvalidatedEvents as $event): ?>


                                            <?php  $reasonInitals = $event->getReason()[0]; 
                                               $roomName = $rooms->getRoomNameById($event->getRoomId());
                                              
                                               $days = explode(',', $event->getDays());
                                                $formattedDates = array();

                                                foreach ($days as $day) {
                                                    $formattedDates[] = date('d/m/Y', strtotime($day));
                                                }

                                                if (count($formattedDates) > 4) {
                                                    $remainingDays = count($formattedDates) - 4;
                                                    $daysToDisplay = array_slice($formattedDates, 0, 4);
                                                    $days = implode(' - ', $daysToDisplay) . " ... et {$remainingDays} jours";
                                                } else {
                                                    $days = implode(' - ', $formattedDates);
                                                }

                                                
                                               
                                                
                                                $bookingDay = date('d/m/Y', strtotime($event->getBookingDay()));

                                                

                                               ?>
                                            <tr>
                                                <td class="align-middle text-truncate">
                                                    <a href="#"
                                                        class="tile bg-pink text-white mr-2"><?= $reasonInitals?></a> <a
                                                        href="#"><?= $event->getReason();?></a>
                                                </td>
                                                <td class="align-middle"> <?=$roomName?> </td>
                                                <td class="align-middle"> <?= $days;?> </td>
                                                <td class="align-middle"><?=$bookingDay?></td>

                                                <td class="align-middle">
                                                    <span class="badge badge-warning"><?= $event->getTotalPrice(); ?> €
                                                        TTC</span>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span
                                                                class="sr-only">Actions</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <div class="dropdown-arrow mr-n1"></div><button
                                                                class="dropdown-item" type="button">Edit</button>
                                                            <button class="dropdown-item" type="button">Delete</button>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr><!-- /tr -->
                                            <?php endforeach; ?>

                                        </tbody><!-- /tbody -->
                                    </table><!-- /.table -->
                                </div><!-- /.table-responsive -->
                            </div><!-- /.card -->
                        </div><!-- /.tab-pane -->
                        <!-- .tab-pane -->
                        <div class="tab-pane fade" id="client-invoices" role="tabpanel"
                            aria-labelledby="client-invoices-tab">
                            <!-- .card -->
                            <div class="card">
                                <!-- .card-header -->
                                <div class="card-header d-flex">
                                    <!-- .dropdown -->

                                    <button type="button" class="btn btn-primary ml-auto">TODO : Export excel</button>
                                </div><!-- /.card-header -->
                                <!-- .table-responsive -->
                                <div class="table-responsive">
                                    <!-- .table -->
                                    <table class="table">
                                        <!-- thead -->
                                        <thead>
                                            <tr>
                                                <th style="min-width:260px"> Motif de la Réservation </th>
                                                <th> Salle réservée </th>
                                                <th> Jours de la réservation </th>
                                                <th> Nombres de jours </th>
                                                <th> Prix </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead><!-- /thead -->
                                        <!-- tbody -->
                                        <tbody>
                                            <!-- tr -->
                                            <?php
                                        if (empty($allUnvalidatedEvents) && empty($allValidatedEvents)) {
                                            echo '<div class="alert alert-info">Aucune réservation n\'a été effectuée pour ce client</div>';
                                        }
                                        ?>
                                            <?php foreach($allValidatedEvents as $event): ?>


                                            <?php  $reasonInitals = $event->getReason()[0]; 
                                               $roomName = $rooms->getRoomNameById($event->getRoomId());
                                              
                                               $days = explode(',', $event->getDays());
                                               $formattedDates = array();

                                               foreach ($days as $day) {
                                                   $formattedDates[] = date('d/m/Y', strtotime($day));
                                               }

                                               if (count($formattedDates) > 4) {
                                                   $remainingDays = count($formattedDates) - 4;
                                                   $daysToDisplay = array_slice($formattedDates, 0, 5);
                                                   $days = implode(' - ', $daysToDisplay) . " ... et {$remainingDays} jours";
                                               } else {
                                                   $days = implode(' - ', $formattedDates);
                                               }

                                               
                                               ?>
                                            <tr>
                                                <td class="align-middle text-truncate">
                                                    <a href="#"
                                                        class="tile bg-pink text-white mr-2"><?= $reasonInitals?></a> <a
                                                        href="#"><?= $event->getReason();?></a>
                                                </td>
                                                <td class="align-middle"> <?=$roomName?> </td>
                                                <td class="align-middle"> <?= $days;?> </td>
                                                <td class="align-middle"> <?= $event->getNumberOfDays();?> </td>
                                                <td class="align-middle">
                                                    <span class="badge badge-success"><?= $event->getTotalPrice(); ?> €
                                                        TTC</span>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span
                                                                class="sr-only">Actions</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <div class="dropdown-arrow mr-n1"></div><button
                                                                class="dropdown-item" type="button">Edit</button>
                                                            <button class="dropdown-item" type="button">Delete</button>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr><!-- /tr -->
                                            <?php endforeach; ?>

                                        </tbody><!-- /tbody -->
                                    </table><!-- /.table -->
                                </div><!-- /.table-responsive -->
                            </div><!-- /.card -->
                        </div><!-- /.tab-pane -->
                        <!-- .tab-pane -->
                        <div class="tab-pane fade" id="client-expenses" role="tabpanel"
                            aria-labelledby="client-expenses-tab">
                            <!-- .card -->
                            <div class="card">
                                <!-- .card-header -->
                                <div class="card-header d-flex">
                                    <!-- .dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><span>This Year</span> <i
                                                class="fa fa-fw fa-caret-down"></i></button> <!-- .dropdown-menu -->
                                        <div class="dropdown-menu dropdown-menu-md stop-propagation">
                                            <div class="dropdown-arrow"></div><!-- .custom-control -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input"
                                                    id="clientExpensesDateFilter0" name="clientExpensesDateFilter"
                                                    value="0"> <label class="custom-control-label"
                                                    for="clientExpensesDateFilter0">Last 7 days</label>
                                            </div><!-- /.custom-control -->
                                            <!-- .custom-control -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input"
                                                    id="clientExpensesDateFilter1" name="clientExpensesDateFilter"
                                                    value="1"> <label class="custom-control-label"
                                                    for="clientExpensesDateFilter1">Last 3 days</label>
                                            </div><!-- /.custom-control -->
                                            <!-- .custom-control -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input"
                                                    id="clientExpensesDateFilter2" name="clientExpensesDateFilter"
                                                    value="2"> <label class="custom-control-label"
                                                    for="clientExpensesDateFilter2">This month</label>
                                            </div><!-- /.custom-control -->
                                            <!-- .custom-control -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input"
                                                    id="clientExpensesDateFilter3" name="clientExpensesDateFilter"
                                                    value="3"> <label class="custom-control-label"
                                                    for="clientExpensesDateFilter3">Last month</label>
                                            </div><!-- /.custom-control -->
                                            <!-- .custom-control -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input"
                                                    id="clientExpensesDateFilter4" name="clientExpensesDateFilter"
                                                    value="4" checked> <label class="custom-control-label"
                                                    for="clientExpensesDateFilter4">This year</label>
                                            </div><!-- /.custom-control -->
                                        </div><!-- /.dropdown-menu -->
                                    </div><!-- /.dropdown -->
                                    <button id="client-expenses-tab" type="button" class="btn btn-primary ml-auto">Add
                                        expense</button>
                                </div><!-- /.card-header -->
                                <!-- .table-responsive -->
                                <div class="table-responsive">
                                    <!-- .table -->
                                    <table class="table">
                                        <!-- thead -->
                                        <thead>
                                            <tr>
                                                <th> Date </th>
                                                <th> Amount </th>
                                                <th style="min-width:200px"> Vendor </th>
                                                <th></th>
                                                <th> Category </th>
                                                <th></th>
                                            </tr>
                                        </thead><!-- /thead -->
                                        <!-- tbody -->
                                        <tbody>
                                            <!-- tr -->
                                            <tr>
                                                <td class="align-middle"> 04/11/2019 </td>
                                                <td class="align-middle"> $360.00 </td>
                                                <td class="align-middle"> Facebook, Inc. </td>
                                                <td class="align-middle">
                                                    <i class="fa fa-paperclip text-muted"></i>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge text-white bg-purple">Campaign</span>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span
                                                                class="sr-only">Actions</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <div class="dropdown-arrow mr-n1"></div><button
                                                                class="dropdown-item" type="button">Edit</button>
                                                            <button class="dropdown-item" type="button">Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr><!-- /tr -->
                                            <!-- tr -->
                                            <tr>
                                                <td class="align-middle"> 09/15/2019 </td>
                                                <td class="align-middle"> $49.00 </td>
                                                <td class="align-middle"> Adobe Systems </td>
                                                <td class="align-middle">
                                                    <i class="fa fa-paperclip text-muted"></i>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge text-white bg-orange">Other</span>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span
                                                                class="sr-only">Actions</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <div class="dropdown-arrow mr-n1"></div><button
                                                                class="dropdown-item" type="button">Edit</button>
                                                            <button class="dropdown-item" type="button">Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr><!-- /tr -->
                                            <!-- tr -->
                                            <tr>
                                                <td class="align-middle"> 10/11/2019 </td>
                                                <td class="align-middle"> $610.00 </td>
                                                <td class="align-middle"> InVisionApp, Inc. </td>
                                                <td class="align-middle">
                                                    <i class="fa fa-paperclip text-muted"></i>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge text-white bg-pink">Design</span>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span
                                                                class="sr-only">Actions</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <div class="dropdown-arrow mr-n1"></div><button
                                                                class="dropdown-item" type="button">Edit</button>
                                                            <button class="dropdown-item" type="button">Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr><!-- /tr -->
                                        </tbody><!-- /tbody -->
                                    </table><!-- /.table -->
                                </div><!-- /.table-responsive -->
                            </div><!-- /.card -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.sidebar-section -->
            </div><!-- /.page-sidebar -->
            <!-- Keep in mind that modals should be placed outsite of page sidebar -->
            <!-- .modal -->
            <form id="clientNewForm" name="clientNewForm">
                <div class="modal fade" id="clientNewModal" tabindex="-1" role="dialog"
                    aria-labelledby="clientNewModalLabel" aria-hidden="true">
                    <!-- .modal-dialog -->
                    <div class="modal-dialog" role="document">
                        <!-- .modal-content -->
                        <div class="modal-content">
                            <!-- .modal-header -->
                            <div class="modal-header">
                                <h6 id="clientNewModalLabel" class="modal-title inline-editable">
                                    <span class="sr-only">Client name</span> <input type="text"
                                        class="form-control form-control-lg" placeholder="E.g. Stilearning, Inc."
                                        required="">
                                </h6>
                            </div><!-- /.modal-header -->
                            <!-- .modal-body -->
                            <div class="modal-body">
                                <!-- .form-row -->
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cnContactName">Contact name</label> <input type="text"
                                                id="cnContactName" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cnContactEmail">Contact email</label> <input type="email"
                                                id="cnContactEmail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cnStreet">Street</label> <input type="text" id="cnStreet"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cnSuite">Suite</label> <input type="text" id="cnSuite"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cnZip">Zip</label> <input type="text" id="cnZip"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cnCountry">Country</label> <select id="cnCountry"
                                                class="custom-select d-block w-100">
                                                <option value=""> Choose... </option>
                                                <option> United States </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cnCity">City</label> <select id="cnCity"
                                                class="custom-select d-block w-100">
                                                <option value=""> Choose... </option>
                                                <option> San Francisco </option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- /.form-row -->
                            </div><!-- /.modal-body -->
                            <!-- .modal-footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button> <button type="button"
                                    class="btn btn-light" data-dismiss="modal">Close</button>
                            </div><!-- /.modal-footer -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </form><!-- /.modal -->
            <!-- .modal -->
            <form id="clientBillingEditForm" action="update_client.php" name="clientBillingEditForm" method="post">

                <?php
                // check if there is an id in the url if not ignore
                if (isset($_GET['id'])) {
                    $client = $clients->findClientById($_GET['id']);
                }
                
                ?>

                <div class="modal fade" id="clientBillingEditModal" tabindex="-1" role="dialog"
                    aria-labelledby="clientBillingEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <input type="hidden" name="id" value="<?= $client->getId(); ?>">
                            <div class="modal-header">
                                <h6 id="clientBillingEditModalLabel" class="modal-title inline-editable">
                                    <span class="sr-only">Entreprise</span>
                                    <input type="text" class="form-control form-control-lg"
                                        value="<?= $client->getBusiness(); ?>" placeholder="Nom de l'entreprise"
                                        required id="business" name="business">
                                </h6>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Adresse</label>
                                            <input type="text" id="adress" class="form-control" required
                                                value="<?= $client->getAddress(); ?>" name="address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_complement">Complément d'adresse</label>
                                            <input type="text" id="ceSuite" class="form-control"
                                                value="<?= $client->getAddressComplement(); ?>"
                                                name="address_complement">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postal_code">Code Postal</label>
                                            <input type="text" id="postal_code" required class="form-control"
                                                value="<?= $client->getPostalCode(); ?>" name="postal_code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">Ville</label>
                                            <input type="text" id="city" required class="form-control"
                                                value="<?= $client->getCity(); ?>" name="city">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Pays</label>
                                            <input type="text" id="country" required class="form-control"
                                                value="<?= $client->getCountry(); ?>" name="country">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="siret">Siret</label>
                                            <input type="text" id="siret" class="form-control" required
                                                value="<?= $client->getSiret(); ?>" name="siret">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- .modal -->
            <form id="clientContactNewForm" name="clientContactNewForm">

                <div class="modal fade" id="clientContactNewModal" tabindex="-1" role="dialog"
                    aria-labelledby="clientContactNewModalLabel" aria-hidden="true">
                    <!-- .modal-dialog -->
                    <div class="modal-dialog" role="document">
                        <!-- .modal-content -->
                        <div class="modal-content">
                            <!-- .modal-header -->
                            <div class="modal-header">
                                <h6 id="clientContactNewModalLabel" class="modal-title inline-editable">
                                    <span class="sr-only">Contact name</span> <input type="text"
                                        class="form-control form-control-lg" placeholder="Name (e.g. John Doe)"
                                        required="">
                                </h6>
                            </div><!-- /.modal-header -->
                            <!-- .modal-body -->
                            <div class="modal-body">
                                <!-- .form-group -->
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="email" id="cnEmail" class="form-control" placeholder="Email"
                                            required=""> <label for="cnEmail">Email</label>
                                    </div>
                                </div><!-- /.form-group -->
                                <!-- .form-group -->
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="tel" id="cnPhone" class="form-control" placeholder="Phone"> <label
                                            for="cnPhone">Phone</label>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.modal-body -->
                            <!-- .modal-footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button> <button type="button"
                                    class="btn btn-light" data-dismiss="modal">Close</button>
                            </div><!-- /.modal-footer -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </form><!-- /.modal -->
            <!-- .modal -->
            <form id="clientContactEditForm" method="post" action="update_client.php" name="clientContactEditForm">
                <?php
                // check if there is an id in the url if not ignore
                if (isset($_GET['id'])) {
                    $client = $clients->findClientById($_GET['id']);
                }
             
                ?>
                <input type="hidden" name="id" value="<?= $client->getId(); ?>">
                <div class="modal fade" id="clientContactEditModal" tabindex="-1" role="dialog"
                    aria-labelledby="clientContactEditModalLabel" aria-hidden="true">
                    <!-- .modal-dialog -->
                    <div class="modal-dialog" role="document">
                        <!-- .modal-content -->
                        <div class="modal-content">
                            <!-- .modal-header -->
                            <div class="modal-header">
                                <h6 id="clientContactEditModalLabel" class="modal-title inline-editable">
                                    <span class="sr-only">Nom prénom</span>
                                    <input type="text" name="firstname" class="form-control form-control-lg"
                                        value="<?=$client->getFirstName()?>" placeholder="Prénom" required="">
                                    <input type="text" name="name" class="form-control form-control-lg"
                                        value="<?=$client->getName()?>" placeholder="Nom" required="">
                                </h6>
                            </div><!-- /.modal-header -->

                            <!-- .modal-body -->
                            <div class="modal-body">
                                <!-- .form-group -->
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="email" name="email" class="form-control"
                                            value="<?=$client->getEmail()?>" placeholder="Email" required=""> <label
                                            for="mail">Email</label>
                                    </div>
                                </div><!-- /.form-group -->
                                <!-- .form-group -->
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="tel" id="phone" name="phone" class="form-control" required
                                            value="<?=$client->getPhone()?>" placeholder="Phone"> <label
                                            for="phone">Téléphone</label>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.modal-body -->
                            <!-- .modal-footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Modifier</button> <button type="button"
                                    class="btn btn-light" data-dismiss="modal">Fermer</button>
                            </div><!-- /.modal-footer -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </form><!-- /.modal -->
        </div><!-- /.page -->
    </div><!-- /.wrapper -->
</main><!-- /.app-main -->
</div><!-- /.app -->
<!-- BEGIN BASE JS -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/popper.js/umd/popper.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
<!-- BEGIN PLUGINS JS -->
<script src="assets/vendor/pace-progress/pace.min.js"></script>
<script src="assets/vendor/stacked-menu/js/stacked-menu.min.js"></script>
<script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/vendor/sortablejs/Sortable.min.js"></script> <!-- END PLUGINS JS -->
<!-- BEGIN THEME JS -->
<script src="assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
<script src="assets/javascript/test.js"></script> <!-- END THEME JS -->
</body>

</html>