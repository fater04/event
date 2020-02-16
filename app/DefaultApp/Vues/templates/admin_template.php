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
<html>
<head>
    <title>B-EVENT ~ <?php if (isset($titre)) echo $titre ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="<?php echo app::autre("plugins/bootstrap-datepicker/bootstrap-datepicker.min.css") ?>" rel="stylesheet">
    <link href="<?php echo app::autre("plugins/bootstrap-datepicker/daterangepicker.css") ?>" rel="stylesheet">
    <link href="<?php echo app::autre("plugins/fullcalendar/fullcalendar.min.css") ?>" rel="stylesheet">
    <link href="<?php echo app::autre("plugins/custombox/custombox.min.css") ?>" rel="stylesheet">
    <link href="<?php echo app::autre("plugins/datatables/dataTables.bootstrap4.min.css") ?>" rel="stylesheet">
    <link href="<?php echo app::autre("plugins/datatables/buttons.bootstrap4.min.css") ?>" rel="stylesheet">
    <link href="<?php echo app::autre("plugins/switchery/switchery.min.css") ?>" rel="stylesheet">
    <link href="<?php echo app::autre("plugins/jquery-circliful/css/jquery.circliful.css") ?>" rel="stylesheet">
    <link href="<?php echo app::css("bootstrap.min") ?>" rel="stylesheet">
    <link href="<?php echo app::css("icons") ?>" rel="stylesheet">
    <link href="<?php echo app::css("style") ?>" rel="stylesheet">
    <script src="<?php echo app::js("modernizr.min") ?>"></script>
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


<body class="fixed-left">
<div id="preloader"></div>
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="#" class="logo"><i class="mdi mdi-calendar-multiple-check"></i><span>&nbsp;B-EVENT</span></a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">

                <li class="list-inline-item notification-list hide-phone">
                    <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                        <i class="mdi mdi-crop-free noti-icon"></i>
                    </a>
                </li>
                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                       href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <?php if ($u0->getPhoto() != "n/a") { ?>
                            <img src="<?= $u0->getPhoto() ?>" alt="user" class="rounded-circle">
                        <?php } else { ?>
                            <img src="public/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="text-overflow">
                                <small>Welcome ! <?= $u0->getPseudo() ?></small>
                            </h5>
                        </div>

                        <!-- item-->
                        <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("profile") ?>"
                           class="dropdown-item notify-item">
                            <i class="mdi mdi-account"></i> <span>Profile</span>
                        </a>


                        <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("change-password") ?>"
                           class="dropdown-item notify-item">
                            <i class="fa fa-edit"></i> <span> Password</span>
                        </a>

                        <!-- item-->
                        <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("logout") ?>"
                           class="dropdown-item notify-item">
                            <i class="mdi mdi-logout"></i> <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
            </ul>

        </nav>

    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <?php if ($u0->getRole() != 'registrant') { ?>
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <li>
                            <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("Home") ?>"
                               class="waves-effect waves-primary">
                                <i class="ti-home"></i><span> Dashboard </span>
                            </a>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect waves-primary">
                                <i class="ti-user"></i> <span>Participant</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li><a href="<?= \app\DefaultApp\DefaultApp::genererUrl("ajouter-participant") ?>">Ajouter</a>
                                </li>
                                <li>
                                    <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("all-participant") ?>">Lister</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect waves-primary">
                                <i class="ti-user"></i> <span>Registrant</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("add-registrant") ?>">Ajouter</a>
                                </li>
                                <li><a href="<?= \app\DefaultApp\DefaultApp::genererUrl("all-registrant") ?>">Lister</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("configuration") ?>"
                               class="waves-effect waves-primary">
                                <i class="ti-settings"></i><span> Configuration </span>
                            </a>
                        </li>
                        <?php if ($check != '0' || $u0->getRole() == "admin") { ?>
                            <li>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#con-close-modal"
                                   class="waves-effect waves-primary">
                                    <i class="fa fa-envelope"></i><span> Send Globale</span>
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="<?= \app\DefaultApp\DefaultApp::genererUrl("event") ?>"
                               class="waves-effect waves-primary">
                                <i class="ti-calendar"></i><span> Evennement </span>
                            </a>
                        </li>
                        <?php if ($u0->getRole() == "admin") { ?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary">
                                    <i class="ti-user"></i> <span>Utilisateur</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="<?= \app\DefaultApp\DefaultApp::genererUrl("add-user") ?>">Ajouter</a>
                                    </li>
                                    <li><a href="<?= \app\DefaultApp\DefaultApp::genererUrl("all-user") ?>">Lister</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>


                    </ul>


                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php } ?>
    <!-- Left Sidebar End -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                <!-- Page-Title -->

                <?php if (isset($entete)) {
                    echo $entete;
                } ?>
                <div class="offset-md-4 col-md-4" id="erreur"><?php if (isset($erreur)) {
                        echo $erreur;
                    } ?></div>
                <?php if (isset($contenue)) {
                    echo $contenue;
                } ?>
            </div>
        </div>
        <footer class="footer">
            &copy<?php echo date("Y"); ?> <i class="mdi mdi-calendar-multiple-check"></i> B-EVENT<span
                    class="hide-phone"> ~ powered by <a href="https://www.bioshaiti.net"
                                                        target="_blank">BIOS</a></span>
        </footer>

    </div>

    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Envoyer Message</h4>
                </div>
                <form method="post" id="globale_send">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="field-7" class="control-label">Evennement</label>
                                <select name="event" class="form-control" required>
                                    <?php
                                    $event0 = new \app\DefaultApp\Models\Event;
                                    $e0 = $event0->lister();
                                    foreach ($e0 as $e00) { ?>
                                        ?>
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
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Send <span
                                    class="fa fa-send"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<script>
    var resizefunc = [];
</script>
<script src="<?php echo app::js("jquery.min") ?>"></script>
<script src="<?php echo app::js("popper.min") ?>"></script>
<script src="<?php echo app::js("bootstrap.min") ?>"></script>
<script src="<?php echo app::js("detect") ?>"></script>
<script src="<?php echo app::js("fastclick") ?>"></script>
<script src="<?php echo app::js("jquery.slimscroll") ?>"></script>
<script src="<?php echo app::js("jquery.blockUI") ?>"></script>
<script src="<?php echo app::js("waves") ?>"></script>
<script src="<?php echo app::js("wow.min") ?>"></script>
<script src="<?php echo app::js("jquery.nicescroll") ?>"></script>
<script src="<?php echo app::js("jquery.scrollTo.min") ?>"></script>
<script src="<?php echo app::autre("plugins/switchery/switchery.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/jquery.waypoints.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/jquery.counterup.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/jquery-circliful/js/jquery.circliful.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/jquery-ui/jquery-ui.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/jquery.sparkline.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/skycons.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/dataTables.bootstrap4.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/dataTables.buttons.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/buttons.bootstrap4.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/jszip.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/pdfmake.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/vfs_fonts.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/buttons.html5.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/buttons.print.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/dataTables.keyTable.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/dataTables.responsive.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/responsive.bootstrap4.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/datatables/dataTables.select.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/moment.js") ?>"></script>
<script src="<?php echo app::autre("plugins/fullcalendar/fullcalendar.min.js") ?>"></script>
<script src="<?php echo app::js("jquery.fullcalendar") ?>"></script>
<script src="<?php echo app::autre("plugins/bootstrap-inputmask/bootstrap-inputmask.min.js") ?>"></script>
<?php if (isset($lisevent)) {
    ?>

    <script>
        !function ($) {
            "use strict";

            var CalendarApp = function () {
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
            CalendarApp.prototype.onDrop = function (eventObj, date) {
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
                CalendarApp.prototype.onEventClick = function (calEvent, jsEvent, view) {
                    var $this = this;
                    var form = $("<form></form>");
                    form.append("<label>Description</label>");
                    form.append("<div class='input-group'><textarea class='form-control' rows='5'>" + calEvent.description + "</textarea></div>");
                    $this.$modal.modal({
                        backdrop: 'static'
                    });
                    $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
                        $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                            return (ev._id == calEvent._id);
                        });
                        $this.$modal.modal('hide');
                    });
                    $this.$modal.find('form').on('submit', function () {
                        calEvent.title = form.find("input[type=text]").val();
                        $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                        $this.$modal.modal('hide');
                        return false;
                    });
                },
                /* on select */
                CalendarApp.prototype.onSelect = function (start, end, allDay) {


                },
                CalendarApp.prototype.enableDrag = function () {
                }
            /* Initializing */
            CalendarApp.prototype.init = function () {
                this.enableDrag();
                /*  Initialize the calendar  */
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var form = '';
                var today = new Date($.now());


                var defaultEvents = [
                    <?php    foreach ($lisevent as $ev) { ?>
                    {

                        title: '<?= $ev->getTitre() ?>',
                        description: '<?= $ev->getDescription()?>',
                        start: new Date('<?= $ev->getDateDebut()?>'),
                        className: 'bg-purple'
                    } <?php echo ",";} ?>  ];
                var $this = this;
                $this.$calendarObj = $this.$calendar.fullCalendar({
                    slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
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
                    drop: function (date) {
                        $this.onDrop($(this), date);
                    },
                    select: function (start, end, allDay) {
                        $this.onSelect(start, end, allDay);
                    },
                    eventClick: function (calEvent, jsEvent, view) {
                        $this.onEventClick(calEvent, jsEvent, view);
                    },

                });
            },

                //init CalendarApp
                $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

        }(window.jQuery),

//initializing CalendarApp
            function ($) {
                "use strict";
                $.CalendarApp.init()
            }(window.jQuery);

    </script>
<?php } ?>
<script src="<?php echo app::autre("plugins/custombox/custombox.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/custombox/legacy.min.js") ?>"></script>
<script src="<?php echo app::js("parsley.min") ?>"></script>
<script src="<?php echo app::autre("plugins/notifications/notify.min.js") ?>"></script>
<script src="<?php echo app::autre("plugins/notifications/notify-metro.js") ?>"></script>

<script src="<?php echo app::autre("plugins/chart.js/Chart.bundle.min.js") ?>"></script>
<script type="text/javascript">

    !function ($) {
        "use strict";

        var ChartJs = function () {
        };

        ChartJs.prototype.respChart = function (selector, type, data, options) {
            //default config
            Chart.defaults.global.defaultFontColor = "rgba(255,255,255,0.5)";
            // get selector by context
            var ctx = selector.get(0).getContext("2d");
            // pointing parent container to make chart js inherit its width
            var container = $(selector).parent();

            // enable resizing matter
            $(window).resize(generateChart);

            // this function produce the responsive Chart JS
            function generateChart() {
                // make chart width fit with its container
                var ww = selector.attr('width', $(container).width());
                switch (type) {
                    case 'Line':
                        new Chart(ctx, {type: 'line', data: data, options: options});
                        break;
                    case 'Doughnut':
                        new Chart(ctx, {type: 'doughnut', data: data, options: options});
                        break;
                    case 'Pie':
                        new Chart(ctx, {type: 'pie', data: data, options: options});
                        break;
                    case 'Bar':
                        new Chart(ctx, {type: 'bar', data: data, options: options});
                        break;
                    case 'Radar':
                        new Chart(ctx, {type: 'radar', data: data, options: options});
                        break;
                    case 'PolarArea':
                        new Chart(ctx, {data: data, type: 'polarArea', options: options});
                        break;
                }
                // Initiate new chart or Redraw

            };
            // run function - render chart at first load
            generateChart();
        },
            //init
            ChartJs.prototype.init = function () {
                //donut chart
                var donutChart = {
                    labels: [
                        <?php if (isset($listerE)) { foreach ($listerE as $ev1) {?>
                        "<?= $ev1->getTitre() ?>",
                        <?php }  } ?>

                    ],
                    datasets: [
                        {
                            data: [<?php if (isset($listerE)) { foreach ($listerE as $ev1) {?>
                                <?=\app\DefaultApp\Models\Participant::countP($ev1->getId())?>,
                                <?php }  } ?>],
                            backgroundColor: [
                                "#3bafda",
                                "#26c6da",
                                "#00b19d"
                            ],
                            hoverBackgroundColor: [
                                "#3bafda",
                                "#26c6da",
                                "#00b19d"
                            ],
                            hoverBorderColor: "#fff"
                        }]
                };
                this.respChart($("#doughnut"), 'Doughnut', donutChart);


            },
            $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

    }(window.jQuery),

//initializing
        function ($) {
            "use strict";
            $.ChartJs.init()
        }(window.jQuery);
</script>

<script src="<?php echo app::js("fater") ?>"></script>
<script src="<?php echo app::js("jquery.dashboard") ?>"></script>
<script src="<?php echo app::js("jquery.core") ?>"></script>
<script src="<?php echo app::js("jquery.app") ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
        $('.circliful-chart').circliful();

        // BEGIN SVG WEATHER ICON
        if (typeof Skycons !== 'undefined') {
            var icons = new Skycons(
                {"color": "#3bafda"},
                {"resizeClear": true}
                ),
                list = [
                    "clear-day", "clear-night", "partly-cloudy-day",
                    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                    "fog"
                ],
                i;

            for (i = list.length; i--;)
                icons.set(list[i], list[i]);
            icons.play();
        }
        ;

</script>
<script type="text/javascript">
    $(document).ready(function () {

        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
        $('#datatable').DataTable({
            lengthChange: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {orthogonal: 'export'}
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {orthogonal: 'export'}
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {orthogonal: 'export'}
                }, {
                    extend: 'excel',
                    exportOptions: {orthogonal: 'export'}
                }
            ]
        });
    });

</script>

</body>
</html>
