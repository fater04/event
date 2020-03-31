<?php

use app\DefaultApp\DefaultApp as app;

if (!\app\DefaultApp\Models\Utilisateur::session()) {
    \app\DefaultApp\DefaultApp::redirection('login');
} else {
    if (\app\DefaultApp\Models\Utilisateur::session_valeur() != null) {

        $user = new \app\DefaultApp\Models\Utilisateur();
        $u0 = $user->rechercher($_SESSION['utilisateur']);
        $check = \app\DefaultApp\Models\Setting::checkConfig($u0->getId());
        if ($_SESSION['remember'] == 'ok') {
            $cookie_name = "utilisateur";
            $cookie_value = $_SESSION['utilisateur'];
            setcookie($cookie_name, $cookie_value, time() + ((3600 * 24) * 30), "/", "event.bioshaiti.net", true, true);

            $cookie_name1 = "pseudo";
            $cookie_value1 = $_SESSION['pseudo'];
            setcookie($cookie_name1, $cookie_value1, time() + ((3600 * 24) * 30), "/", "event.bioshaiti.net", true, true);


            $cookie_name2 = "role";
            $cookie_value2 = $_SESSION['role'];
            setcookie($cookie_name2, $cookie_value2, time() + ((3600 * 24) * 30), "/", "event.bioshaiti.net", true, true);

        }


    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>B-EVENT - <?php if (isset($titre)) echo $titre ;?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- third party css -->
    <link href="<?= app::autre('assets/libs/datatables/dataTables.bootstrap4.css')?>" rel="stylesheet"
        type="text/css" />
    <link href="<?= app::autre('assets/libs/datatables/responsive.bootstrap4.css')?>" rel="stylesheet"
        type="text/css" />
    <link href="<?= app::autre('assets/libs/datatables/buttons.bootstrap4.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?= app::autre('assets/libs/datatables/select.bootstrap4.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?= app::autre('assets/libs/fullcalendar/fullcalendar.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?= app::autre('assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.css')?>" rel="stylesheet"
        type="text/css" />
    <!-- third party css end -->
    <link href="<?= app::autre('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?= app::autre('assets/css/icons.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?= app::autre('assets/css/app.min.css')?>" rel="stylesheet" type="text/css" />


    <style>
    #preloader {
        position: fixed;
        z-index: 9999;
        background: url('public/images/load.gif') 50% 50% no-repeat;
        top: 0px;
        left: 0px;
        height: 100%;
        width: 100%;
        cursor: wait;
    }
    </style>
</head>
<!-- collapsed side-bar ---- > -->
<!-- color topbar------class="topbar-dark topbar-light" -->
<!-- color sidebar--------- class="left-side-menu-dark left-side-menu-light"  -->
<!-- box layout ----------class="enlarged boxed-layout" data-keep-enlarged="true" -->
<!-- -- small sidebar -------------class="left-side-menu-sm"---------- -->


<body    <?php if ($u0->getRole() == 'registrant') { ?> class="left-side-menu-dark enlarged" data-keep-enlarged="true"  <?php   }else{ ?> class="left-side-menu-dark "<?Php } ?>>
    <div id="preloader"></div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <!-- <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                      
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="#" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-secondary">
                                    <i class="mdi mdi-heart"></i>
                                </div>
                                <p class="notify-details">Carlos Crouch liked
                                    <b>Admin</b>
                                    <small class="text-muted">13 days ago</small>
                                </p>
                            </a>
                        </div>

                        <a href="javascript:void(0);"
                            class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li> -->

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <?php if ($u0->getPhoto() != "n/a") { ?>
                        <img src="<?= $u0->getPhoto() ?>" alt="user-image" class="rounded-circle">
                        <?php } else { ?>
                        <img src="public/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                        <?php } ?>
                        <span class="pro-user-name ml-1">
                            <?=$u0->getPseudo() ?> <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("profile") ?>"
                            class="dropdown-item notify-item">
                            <i class="remixicon-account-circle-line"></i>
                            <span>Profile</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="remixicon-settings-3-line"></i>
                            <span>Settings</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("change-password") ?>"
                            class="dropdown-item notify-item">
                            <i class="fa fa-edit"></i> <span> Password</span>
                        </a>
                        <!-- item-->
                        <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("logout") ?>"
                            class="dropdown-item notify-item">
                            <i class="remixicon-logout-box-line"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>





            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.html" class="logo text-center">
                    <span class="logo-lg">
                        <strong style="font-size:28px"><i class="mdi mdi-calendar-multiple-check"></i>
                            <span>B-EVENT</span> </strong>
                    </span>
                    <span class="logo-sm">
                        <strong style="font-size:28px"><i class="mdi mdi-calendar-multiple-check"></i></strong>
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
    
        <div class="left-side-menu" >

            <div class="slimscroll-menu">

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul class="metismenu" id="side-menu">


                        <li>
                            <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("Home") ?>" class="waves-effect">
                                <i class="ti-home"></i><span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ti-user"></i> <span>Participant</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a
                                        href="<?= \app\DefaultApp\DefaultApp::genererUrl("ajouter-participant") ?>">Ajouter</a>
                                </li>
                                <li>
                                    <a
                                        href="<?= \app\DefaultApp\DefaultApp::genererUrl("all-participant") ?>">Lister</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ti-user"></i> <span>Registrant</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a
                                        href="<?= \app\DefaultApp\DefaultApp::genererUrl("add-registrant") ?>">Ajouter</a>
                                </li>
                                <li><a href="<?= \app\DefaultApp\DefaultApp::genererUrl("all-registrant") ?>">Lister</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("configuration") ?>"
                                class="waves-effect">
                                <i class="ti-settings"></i><span> Configuration </span>
                            </a>
                        </li>
                        <?php if ($check != '0' || $u0->getRole() == "admin") { ?>
                        
                            <?php if ($u0->getRole() != 'registrant') { ?> 
                        <li>
                            <a href="javascript: void(0);" class="waves-effect" data-toggle="modal"
                                data-target="#con-close-modal">
                                <i class="fa fa-envelope"></i><span> Send Globale</span>
                            </a>
                        </li>

                        <?php } } ?>
                        <li>
                            <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("event") ?>" class="waves-effect ">
                                <i class="ti-calendar"></i><span> Evennement </span>
                            </a>
                        </li>
                        <?php if ($u0->getRole() == "admin") { ?>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ti-user"></i> <span>Utilisateur</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="<?= \app\DefaultApp\DefaultApp::genererUrl("add-user") ?>">Ajouter</a>
                                </li>
                                <li><a href="<?= \app\DefaultApp\DefaultApp::genererUrl("all-user") ?>">Lister</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("logs") ?>" class="waves-effect ">
                                <i class="ti-list"></i><span> Log</span>
                            </a>
                        </li>
                        <?php } ?>




                        <!-- <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="remixicon-mail-open-line"></i>
                                <span> SMS </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="#">add</a>
                                </li>
                                <li>
                                    <a href="#">Read sms</a>
                                </li>
                                <li>
                                    <a href="#">Compose compose</a>
                                </li>
                            </ul>
                        </li> -->


                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>

        </div>
      
        <!-- Left Sidebar End -->

        <!-- Start Page Content here -->
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">B-EVENT</a></li>
                                        <li class="breadcrumb-item active"><?php if (isset($titre)) echo $titre ;?></li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?php if (isset($titre)) echo $titre ;?></h4>
                            </div>
                        </div>
                    </div>





                    <div class="offset-md-4 col-md-4" id="erreur"><?php if (isset($erreur)) {
                        echo $erreur;
                    } ?></div>
                    <?php if (isset($contenue)) {
                    echo $contenue;
                } ?>
                </div>

            </div>
            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            &copy<?= date("Y")?> <span class="mdi mdi-calendar-multiple-check"></span> B-EVENT <span>
                                powered by <a href="https://www.bioshaiti.com">BIOS</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right  d-none d-sm-block">
                                Version 1.1.0

                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- End Page Content here -->

        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Envoyer Un Message a tous les Participants (es)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="post" id="globale_send">
                        <div class="modal-body p-4">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="field-7" class="control-label">Evennement</label>
                                    <select name="event" class="form-control" required>
                                        <?php
                                             $event0 = new \app\DefaultApp\Models\Event;
                                            $e0 = $event0->lister();
                                         foreach ($e0 as $e00) { ?>
                                        <option value="<?= $e00->getId() ?>"> <?= $e00->getTitre() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Message</label>
                                        <textarea class="form-control" name="message" rows="5"
                                            placeholder="Write something..." required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="globale">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Send <span
                                    class="fa fa-send"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <script src="<?= app::autre('assets/js/vendor.min.js')?>"></script>
    <script src="<?= app::autre('assets/libs/jquery-knob/jquery.knob.min.js')?>"></script>
    <script src="<?= app::autre('assets/libs/peity/jquery.peity.min.js')?>"></script>
    <script src="<?= app::autre('assets/libs/jquery-sparkline/jquery.sparkline.min.js')?>"></script>
    <script src="<?= app::autre('assets/js/pages/dashboard-1.init.js')?>"></script>
    <script src="<?= app::autre('assets/js/app.min.js')?>"></script>

    <!--------------------table data ------------>
    <script src="<?php echo app::autre("assets/libs/datatables/jquery.dataTables.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/dataTables.bootstrap4.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/dataTables.buttons.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/buttons.bootstrap4.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/jszip.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/pdfmake.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/vfs_fonts.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/buttons.html5.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/buttons.print.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/dataTables.keyTable.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/dataTables.responsive.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/responsive.bootstrap4.min.js") ?>"></script>
    <script src="<?=app::autre("assets/libs/datatables/dataTables.select.min.js") ?>"></script>

    <!-- ------------calendar-------------- -->
    <script src="<?=app::autre("plugins/moment.js") ?>"></script>
    <script src="<?=app::autre("plugins/fullcalendar/fullcalendar.min.js") ?>"></script>
    <script src="<?=app::js("jquery.fullcalendar") ?>"></script>
    <script src="<?=app::autre("plugins/bootstrap-inputmask/bootstrap-inputmask.min.js") ?>"></script>
    <script src="<?=app::autre("plugins/moment.js") ?>"></script>
    <script src="<?=app::autre("plugins/fullcalendar/fullcalendar.min.js") ?>"></script>
    <script src="<?=app::js("jquery.fullcalendar") ?>"></script>
    <script src="<?=app::autre("plugins/bootstrap-inputmask/bootstrap-inputmask.min.js") ?>"></script>

    <!-----------chart----------------->
    <script src="<?=app::autre('assets/libs/apexcharts/apexcharts.min.js')?>"></script>
    <?php if (isset($listerE)) {
    ?>
    <script>
    var chart;
    options = {
        chart: {
            height: 235,
            type: "donut"
        },
        series: [<?php if (isset($listerE)) { foreach ($listerE as $ev1) {?>
                                <?=\app\DefaultApp\Models\Participant::countP($ev1->getId())?>,
                                <?php }  } ?> ],
        legend: {
            show: !0,
            position: "bottom",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: !1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: -10
        },
        labels: [<?php if (isset($listerE)) { foreach ($listerE as $ev1) {?>
                        "<?= $ev1->getTitre() ?>",
                        <?php }  } ?> ],
        colors: [<?php if (isset($listerE)) { foreach ($listerE as $ev1) {?>
                        "<?php echo "#".substr(md5(rand()), 0, 6);  ?>",
                        <?php }  } ?> ],
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 210
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (chart = new ApexCharts(document.querySelector("#apex-pie-2"), options)).render();
    </script>
    <?php } ?>

    <?php if (isset($lisevent)) {
    ?>

    <script>
    ! function($) {
        "use strict";

        var CalendarApp = function() {
            this.$body = $("body")
            this.$modal = $('#event-modal'),
                this.$event = ('#external-events div.external-event'),
                this.$calendar = $('#calendar'),
                this.$saveCategoryBtn = $('.save-category'),
                this.$categoryForm = $('#add-category form'),
                this.$extEvents = $('#external-events'),
                this.$calendarObj = null
        };
        /* on drop */
        CalendarApp.prototype.onDrop = function(eventObj, date) {
                var $this = this;
                // retrieve the dropped element's stored Event Object
                var originalEventObject = eventObj.data('eventObject');
                var $categoryClass = eventObj.attr('data-class');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                if ($categoryClass)
                    copiedEventObject['className'] = [$categoryClass];
                // render the event on the calendar
                $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    eventObj.remove();
                }
            },
            /* on click on event */
            CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                var $this = this;
                var form = $("<form></form>");
                form.append("<label>Description</label>");
                form.append("<div class='input-group'><textarea class='form-control' rows='5'>" + calEvent.description +
                    "</textarea></div>");
                $this.$modal.modal({
                    backdrop: 'static'
                });
                $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body')
                    .empty().prepend(form).end().find('.delete-event').unbind('click').click(function() {
                        $this.$calendarObj.fullCalendar('removeEvents', function(ev) {
                            return (ev._id == calEvent._id);
                        });
                        $this.$modal.modal('hide');
                    });
                $this.$modal.find('form').on('submit', function() {
                    calEvent.title = form.find("input[type=text]").val();
                    $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                    $this.$modal.modal('hide');
                    return false;
                });
            },
            /* on select */
            CalendarApp.prototype.onSelect = function(start, end, allDay) {


            },
            CalendarApp.prototype.enableDrag = function() {}
        /* Initializing */
        CalendarApp.prototype.init = function() {
                this.enableDrag();
                /*  Initialize the calendar  */
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var form = '';
                var today = new Date($.now());


                var defaultEvents = [ <?php foreach($lisevent as $ev) { ?> {

                            title: '<?= $ev->getTitre() ?>',
                            description: '<?= $ev->getDescription()?>',
                            start: new Date('<?= $ev->getDateDebut()?>'),
                            className: 'bg-purple'
                        } <?php echo ",";
                    } ?>
                ];
                var $this = this;
                $this.$calendarObj = $this.$calendar.fullCalendar({
                    slotDuration: '00:15:00',
                    /* If we want to split day time each 15minutes */
                    minTime: '08:00:00',
                    defaultView: 'month',
                    handleWindowResize: true,
                    height: $(window).height() - 200,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: defaultEvents,
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    drop: function(date) {
                        $this.onDrop($(this), date);
                    },
                    select: function(start, end, allDay) {
                        $this.onSelect(start, end, allDay);
                    },
                    eventClick: function(calEvent, jsEvent, view) {
                        $this.onEventClick(calEvent, jsEvent, view);
                    },

                });
            },

            //init CalendarApp
            $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

    }(window.jQuery),

    //initializing CalendarApp
    function($) {
        "use strict";
        $.CalendarApp.init()
    }(window.jQuery);
    </script>
    <?php } ?>
    <!----custom----->
    <script src="<?php echo app::js("fater") ?>"></script>
    <script type="text/javascript">
    $(document).ready(function() {

        $(".alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
        $('#datatable').DataTable({
            lengthChange: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        orthogonal: 'export'
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        orthogonal: 'export'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        orthogonal: 'export'
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        orthogonal: 'export'
                    }
                }
            ]
        });
    });
    </script>
     <?php if ($u0->getRole() == 'registrant') { ?> 
     <script>
      $(".left-side-menu a").click(function(e) {
   e.preventDefault();
 });
<?php } ?>
      </script>
</body>

</html>