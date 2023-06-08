<?php
require '../src/bootstrap.php';
require '../src/adminSession.php';

render_admin('header', ['title' => 'Liste Salles', 'script' => 'index.js']);
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
                            placeholder="Trouver une salle">
                    </div><!-- /.input-group -->
                </header><button type="button" class="btn btn-primary btn-floated position-absolute" data-toggle="modal"
                    data-target="#clientNewModal" title="Add new client"><i class="fa fa-plus"></i></button>
                <!-- board -->
                <div class="board p-0 perfect-scrollbar">
                    <!-- .list-group -->
                    <div class="list-group list-group-flush list-group-divider border-top" data-toggle="radiolist">
                        <!-- .list-group-item -->

                        <?php

                        use Calendar\Rooms;
                        use Calendar\Bookings;
                        use Calendar\Clients;
                        use Calendar\Photos;

                        $rooms = new Rooms(get_pdo());


                        $allRooms = $rooms->getRooms();
                       

                       //if allRooms is empty, display a message
                        if (empty($allRooms)) {

                      
                            echo "Aucune salle n'a été trouvée";
                            $noRoom = true;
                           
                        } else 
                        {
                            $noRoom = false;

                        }

                       
                       



                        ?>
                        <?php if ($noRoom === false): ?>

                        <?php foreach ($allRooms as $room): ?>

                        <?php $initial = $room->getName()[0];
                            // if it is the first loop AND there is no GET parameter, set the first client to active and launch the updateClientDetails function
                        
                            if (!isset($_GET['id']) && $room === reset($allRooms)) {
                                $active = 'active';
                            } elseif (isset($_GET['id']) && $room->getId() === $_GET['id']) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            
                      

                            ?>
                        <div class="list-group-item <?= $active ?>" data-toggle="sidebar" data-sidebar="show">
                            <a href="#" class="stretched-link" onclick="updateRoomDetails(<?= $room->getId() ?>)"></a>
                            <!-- .list-group-item-figure -->
                            <div class="list-group-item-figure">
                                <div class="tile tile-circle bg-blue">
                                    <?= $initial ?>
                                </div>
                            </div><!-- /.list-group-item-figure -->
                            <!-- .list-group-item-body -->
                            <div class="list-group-item-body">
                                <h4 class="list-group-item-title">
                                    <?= $room->getName(); ?>
                                </h4>
                                <p class="list-group-item-text">
                                <?=$room->getAddress();?>, <?= $room->getLocation() ?>
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
                    $room = $rooms->getRoom($id);
                } else {
                    $room = $rooms->getFirstRoom();
                }




                ?>
                <div class="sidebar-section sidebar-section-fill" id="clientDetailsTabs">
                    <h1 class="page-title">
                        <i class="far fa-building text-muted mr-2"></i>
                        <?= $room->getName(); ?>
                    </h1>
                    <p class="text-muted"> <?=$room->getAddress();?>,
                        <?= $room->getLocation(); ?>
                    </p>
                    <!-- .nav-scroller -->
                    <div class="nav-scroller border-bottom">
                        <!-- .nav-tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab"
                                    href="#client-billing-contact">Informations et options</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#client-projects">Reservations en
                                    attente</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#client-invoices">Reservations validées</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#client-expenses">Photos</a>
                            </li>
                        </ul><!-- /.nav-tabs -->
                    </div><!-- /.nav-scroller -->
                    <?php
                    // Vérifier si le paramètre "photos" est présent dans l'URL
                    if (isset($_GET['photos'])) {
                        $photosStatus = $_GET['photos'];

                        // Vérifier la valeur du paramètre "photos"
                        if ($photosStatus === 'added' || $photosStatus === 'updated' || $photosStatus === 'deleted') {
                            // Si la valeur est "added", définir la classe active sur le tab-pane correspondant
                            $tabPaneClass = 'tab-pane fade show active';
                            $defaultTabPaneClass = 'tab-pane fade';
                        } else {
                            // Autres cas de valeur du paramètre "photos"
                            $tabPaneClass = 'tab-pane fade';
                            $defaultTabPaneClass = 'tab-pane fade show active';
                        }
                    } else {
                        // Aucun paramètre "photos" présent dans l'URL
                        $tabPaneClass = 'tab-pane fade';
                        $defaultTabPaneClass = 'tab-pane fade show active';
                    }
                    ?>
                    <!-- .tab-content -->
                    <div class="tab-content pt-4" id="clientDetailsTabs">
                        <!-- .tab-pane -->
                        <div class="<?= $defaultTabPaneClass ?>" id="client-billing-contact" role="tabpanel"
                            aria-labelledby="client-billing-contact-tab">
                            <!-- .card -->
                            <div class="card">
                                <!-- .card-body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 id="client-billing-contact-tab" class="card-title"> Adresse </h2>
                                        <button type="button" class="btn btn-link" data-toggle="modal"
                                            data-target="#clientBillingEditModal">modifier</button>
                                    </div>
                                    <address> <?=$room->getAddress();?> <br><?=$room->getAddressComplement();?>
                                        <br>


                                        <?=$room->getPostalCode();?>,
                                        <?= $room->getCity(); ?><br>

                                    </address>
                                    <!-- TODO : ADD COUNTRY IN SQL-->
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                            <!-- .card -->
                            <div class="card mt-4">
                                <!-- .card-body -->
                                <div class="card-body">
                                    <h2 class="card-title">Informations</h2>
                                    <div>
                                        <!-- description -->
                                        <p class="card-text">
                                            Description : <?= $room->getDescription(); ?>
                                        </p>
                                        <p><i class="fas fa-ruler"></i> <strong>Taille:</strong>
                                            <?= $room->getSize() ?>
                                            m²
                                        </p>
                                        <p><i class="fas fa-users"></i> <strong>Capacité:</strong>
                                            <?= $room->getCapacity() ?> personnes
                                        </p>

                                        <p><i class="fas fa-chair"></i> <strong>Chaises:</strong>
                                            <?= $room->getSeats(); ?>
                                        </p>


                                        <p><i class="fas fa-euro-sign"></i> <strong>Tarif:</strong>
                                            <?= $room->getPrice() ?> €/jour
                                        </p>
                                        <p><strong>Options:</strong></p>
                                        <ul class="list-unstyled">
                                            <?php foreach ($room->getOptions() as $option => $value): ?>
                                            <li>
                                                <i class="<?= $value ? 'fas fa-check' : 'fas fa-times' ?>"></i>
                                                <?= $option ?>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>


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


                                <div class="table-responsive">
                                    <!-- .table -->
                                    <?php

                                            $bookings = new Bookings(get_pdo());
                                            $clients = new Clients(get_pdo());
                                            if (!isset($_GET['id'])) {
                                                $roomId = $rooms->getFirstId(); // Use getFirstId() to get the first ID in the database
                                                $allUnvalidatedEvents = $bookings->getAllUnValidatedEventsByRoom($roomId);
                                                $allValidatedEvents = $bookings->getAllValidatedEventsByRoom($roomId);
                                            } else {
                                                $roomId = $_GET['id'];
                                                $allUnvalidatedEvents = $bookings->getAllUnValidatedEventsByRoom($roomId);
                                                $allValidatedEvents = $bookings->getAllValidatedEventsByRoom($roomId);
                                            }

                                            
                                            ?>
                                    <table class="table">
                                        <!-- thead -->
                                        <thead>
                                            <tr>
                                                <th style="min-width:260px"> Motif de la Réservation </th>
                                                <th> Client ayant réservé </th>
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
                                            echo '<div class="alert alert-info">Aucune réservation n\'a été effectuée pour cette salle</div>';
                                        }
                                        ?>
                                            <?php foreach ($allUnvalidatedEvents as $event): ?>
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

                                                $clientName = $clients->findClientNameById($event->getIdClient());

                                               ?>

                                            <!-- tr -->


                                            <tr>
                                                <td class="align-middle text-truncate">
                                                    <a href="#"
                                                        class="tile bg-pink text-white mr-2"><?= $reasonInitals?></a> <a
                                                        href="unvalidated-events.php?id=<?=$event->getId()?>"><?= $event->getReason();?></a>
                                                </td>
                                                <td class="align-middle"> <a
                                                        href="clients?id=<?=$event->getIdClient()?>"><?=$clientName?></a>
                                                </td>
                                                <td class=" align-middle"> <?= $days;?> </td>
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

                                                <th> Date de la reservation </th>
                                                <th> Prix </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead><!-- /thead -->
                                        <?php
                                        if (empty($allValidatedEvents && $allUnvalidatedEvents)) {
                                            echo '<div class="alert alert-info">Aucune réservation n\'a été effectuée pour cette salle</div>';
                                        }
                                        ?>
                                        <?php foreach ($allValidatedEvents as $event): ?>
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

                                                $clientName = $clients->findClientNameById($event->getIdClient());

                                               ?>
                                        <!-- tbody -->
                                        <tbody>
                                            <!-- tr -->

                                            <tr>
                                                <td class="align-middle text-truncate">
                                                    <a href="#"
                                                        class="tile bg-pink text-white mr-2"><?= $reasonInitals?></a> <a
                                                        href="#"><?= $event->getReason();?></a>
                                                </td>
                                                <td class="align-middle"> <a
                                                        href="clients?id=<?=$event->getIdClient()?>"><?=$clientName?></a>
                                                </td>
                                                <td class=" align-middle"> <?= $days;?> </td>
                                                <td class="align-middle"><?=$bookingDay?></td>

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
              

<!-- Tab-pane "client-expenses" avec la classe active si le paramètre "photos" est présent avec la valeur "added" -->
<div class="<?= $tabPaneClass ?>" id="client-expenses" role="tabpanel" aria-labelledby="client-expenses-tab">
 
    <!-- .card -->
    <div class="card">
    <!-- .card-header -->
    
    <!-- /.card-header -->
    <!-- .card-body -->
    <div class="card-body">
        <!-- Section de la galerie pour les miniatures -->
        <div class="gallery-thumbnails">
            <h4>Miniature</h4>
            <hr>
            <!-- Images des miniatures -->
            <?php
            $photos = new Photos(get_pdo());
            $minPhoto = $photos->getIdMinPhotoByRoomId($roomId);
            $roomPhotos = $photos->getPhotosByRoom($roomId);
            ?>

            <?php if ($minPhoto) : ?>
                <div class="thumbnail">
                    <img src="../public/images/room_images/<?=$roomId?>/min/<?=$minPhoto->getId();?>" alt="Miniature 1" class="img-fluid img-thumbnail thumbnail-image">
                    <style>
                        .thumbnail-image {
                            max-width: 250px;
                        }
                    </style>

<div class="thumbnail-actions">
                    <a href="delete-photo.php?id=<?=$minPhoto->getId()?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette miniature ?')">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                </div>
            <?php else : ?>
                <div class="thumbnail">
                    <button class="btn btn-sm btn-secondary add-thumbnail " type="button" data-toggle="modal" data-target="#newMinModal">
                        <i class="fa fa-plus"></i> Ajouter
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Section de la galerie pour toutes les photos -->
       <!-- Section de la galerie pour toutes les photos -->
<!-- Section de la galerie pour toutes les photos -->
        <!-- Section de la galerie pour toutes les photos -->
            <div class="gallery-photos">
                <h4>Toutes les photos</h4>
                <hr>
                <!-- Images des photos -->
                <div class="row">
                    <?php $photoCount = count($roomPhotos); ?>
                    <?php for ($i = 0; $i < $photoCount; $i++) : ?>
                        <?php $photo = $roomPhotos[$i]; ?>
                        <div class="col-md-3">
                            <div class="photo">
                                <img src="../public/images/room_images/<?=$roomId?>/<?=$photo->getId();?>.jpg" alt="Photo <?=$photo->getId();?>" class="img-fluid img-thumbnail thumbnail-image">
                                <div class="photo-actions mb-2 mt-2">
                            <a href="delete-photo.php?id=<?=$photo->getId()?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                            </div>
                        </div>

                        <?php if (($i + 1) % 4 === 0 && $i < $photoCount - 1) : ?>
                            </div><div class="row">
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

            <!-- Bouton pour ajouter une photo -->
                <?php $remainingPhotos = 10 - count($roomPhotos); ?>
                <?php if ($remainingPhotos > 0) : ?>
                    <div class="photo">
                        <button class="btn btn-lg btn-secondary add-photo" type="button" data-toggle="modal" data-target="#addPhotoModal">
                            <i class="fa fa-plus"></i> Ajouter
                        </button>
                        <?php if ($remainingPhotos < 10) : ?>
                            <br>
                            <small>Reste <?= $remainingPhotos ?> photo<?= $remainingPhotos > 1 ? 's' : '' ?></small>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                        </div>



                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                </div>
        <!-- /.tab-pane -->



                    </div><!-- /.tab-content -->
                </div><!-- /.sidebar-section -->
            </div><!-- /.page-sidebar -->
           
            <!-- Keep in mind that modals should be placed outsite of page sidebar -->



   <!-- .modal -->
   
            <!-- /.modal -->


         

            <!-- .modal -->
            <div class="modal fade" id="newMinModal" tabindex="-1" role="dialog" aria-labelledby="newMinModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newMinModalLabel">Choisir l'image de la miniature</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="add-min-photo.php" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?=$room->getId()?>">
                                <!-- just a file input  -->
                                <input type="file" name="photo" id="photo">
                                <input type="hidden" name="min" value="1">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPhotoModalLabel">Ajouter des photos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="add-photos.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?=$room->getId()?>">
                    <!-- File input for selecting multiple photos -->
                    <div class="form-group">
                        <label for="photos">Sélectionner les photos</label>
                        <input type="file" name="photos[]" id="photos" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>



            <!-- .modal -->
            <form id="clientBillingEditForm" action="update_room.php" name="clientBillingEditForm" method="post">
                
                <?php
                // check if there is an id in the url if not ignore
                if (isset($_GET['id'])) {
                    $room = $rooms->getRoom($_GET['id']);
                }
              
                ?>

<div class="modal fade" id="clientBillingEditModal" tabindex="-1" role="dialog"
                    aria-labelledby="clientBillingEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <input type="hidden" name="id" value="<?=$room->getId()?>">
                            <div class="modal-header">
                                <h6 id="clientBillingEditModalLabel" class="modal-title inline-editable">
                                    <span class="sr-only">Nom de la salle</span>
                                    <input type="text" class="form-control form-control-lg" value="<?= $room->getName(); ?>"
                                        placeholder="Nom de la salle" required id="name" name="name">
                                </h6>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <input type="text" id="address" class="form-control" required value="<?= $room->getAddress(); ?>" name="address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_complement">Complément d'adresse</label>
                                <input type="text" id="address_complement" class="form-control" value="<?= $room->getAddressComplement(); ?>" name="address_complement">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postal_code">Code Postal</label>
                                <input type="text" id="postal_code" required class="form-control" value="<?= $room->getPostalCode(); ?>" name="postal_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Ville</label>
                                <input type="text" id="city" required class="form-control" value="<?= $room->getCity(); ?>" name="city">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="capacity">Capacité</label>
                                <input type="number" id="capacity" class="form-control" required value="<?= $room->getCapacity(); ?>" name="capacity">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="seats">Places assises</label>
                                <input type="number" id="seats" class="form-control" required value="<?= $room->getSeats(); ?>" name="seats">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" required name="description"><?= $room->getDescription(); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagePath">Chemin de l'image</label>
                                <input type="text" id="imagePath" class="form-control" required value="<?= $room->getImagePath(); ?>" name="imagePath">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" id="price" class="form-control" required value="<?= $room->getPrice(); ?>" name="price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Emplacement</label>
                                <input type="text" id="location" class="form-control" required value="<?= $room->getLocation(); ?>" name="location">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="size">Taille</label>
                                <input type="number" id="size" class="form-control" required value="<?= $room->getSize(); ?>" name="size">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="equipment">Équipements</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="projector" value="1" name="projector" <?= $room->getProjector() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="projector">Projecteur</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wifi" value="1" name="wifi" <?= $room->getWifi() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="wifi">Wifi</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="coffee" value="1" name="coffee" <?= $room->getCoffee() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="coffee">Café</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="water" value="1" name="water" <?= $room->getWater() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="water">Eau</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="paperboard" value="1" name="paperboard" <?= $room->getPaperboard() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="paperboard">Paperboard</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tv" value="1" name="tv" <?= $room->getTv() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="tv">TV</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="toilets" value="1" name="toilets" <?= $room->getToilets() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="toilets">Toilettes</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="parking" value="1" name="parking" <?= $room->getParking() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="parking">Parking</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="disabledAccess" value="1" name="disabledAccess" <?= $room->getDisabledAccess() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="disabledAccess">Accès handicapé</label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="airConditioning" value="1" name="airConditioning" <?= $room->getAirConditioning() ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="airConditioning">Climatisation</label>
                                </div>
                                
                            </div>
                        </div>   
                        

                        </div>  
                                
                               
                                    
                              
                    </div>
                    <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                <a href="delete-room.php?id=<?= $room->getId(); ?>" class="btn btn-danger">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php endif; ?>
            <form id="clientNewForm" action="create-room.php" name="clientNewForm" method="post">
                <div class="modal fade" id="clientNewModal" tabindex="-1" role="dialog"
                    aria-labelledby="clientNewModalLabel" aria-hidden="true">
                    <!-- .modal-dialog -->
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <h6 id="clientBillingEditModalLabel" class="modal-title inline-editable">
                                    <span class="sr-only">Nom de la salle</span>
                                    <input type="text" class="form-control form-control-lg" value=""
                                        placeholder="Nom de la salle" required id="name" name="name">
                                </h6>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <input type="text" id="address" class="form-control" required value="" name="address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_complement">Complément d'adresse</label>
                                <input type="text" id="address_complement" class="form-control" value="" name="address_complement">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postal_code">Code Postal</label>
                                <input type="text" id="postal_code" required class="form-control" value="" name="postal_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Ville</label>
                                <input type="text" id="city" required class="form-control" value="" name="city">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="capacity">Capacité</label>
                                <input type="number" id="capacity" class="form-control" required value="" name="capacity">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="seats">Places assises</label>
                                <input type="number" id="seats" class="form-control" required value="" name="seats">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" required name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagePath">Chemin de l'image</label>
                                <input type="text" id="imagePath" class="form-control" required value="" name="imagePath">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" id="price" class="form-control" required value="" name="price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Emplacement</label>
                                <input type="text" id="location" class="form-control" required value="" name="location">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="size">Taille</label>
                                <input type="number" id="size" class="form-control" required value="" name="size">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="equipment">Équipements</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="projector" value="1" name="projector" >
                                    <label class="form-check-label" for="projector">Projecteur</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wifi" value="1" name="wifi" >
                                    <label class="form-check-label" for="wifi">Wifi</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="coffee" value="1" name="coffee" >
                                    <label class="form-check-label" for="coffee">Café</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="water" value="1" name="water" >
                                    <label class="form-check-label" for="water">Eau</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="paperboard" value="1" name="paperboard" >
                                    <label class="form-check-label" for="paperboard">Paperboard</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tv" value="1" name="tv" >
                                    <label class="form-check-label" for="tv">TV</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="toilets" value="1" name="toilets" >
                                    <label class="form-check-label" for="toilets">Toilettes</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="parking" value="1" name="parking" >
                                    <label class="form-check-label" for="parking">Parking</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="disabledAccess" value="1" name="disabledAccess" >
                                    <label class="form-check-label" for="disabledAccess">Accès handicapé</label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="airConditioning" value="1" name="airConditioning" >
                                    <label class="form-check-label" for="airConditioning">Climatisation</label>
                                </div>
            
                            </div>
                        </div>   
                        
            
                        </div>  
                                
                               
                                    
                              
                        </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Créer une salle</button>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div><!-- /.modal-dialog -->
                </div>
            </form><!-- /.modal -->

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
                                        <input type="tel" id="cnPhone" class="form-control" placeholder="Phone">
                                        <label for="cnPhone">Phone</label>
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