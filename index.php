<?php
/**
* This file displays the staff and manager homepages to the users with the
* correct permissions.
*
* Framework used:
* UserSpice 5
* An Open Source PHP User Management System by the UserSpice Team at http://UserSpice.com
*
* @author James Bradford and Hongkang Liang
* @version 19/04/2020
*/

if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'/users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}
if ($user->isLoggedIn()) {
  require_once $abs_us_root.$us_url_root.'staff/includes/staff_functions.php';
  require_once $abs_us_root.$us_url_root.'managers/includes/manager_functions.php';
  require_once $abs_us_root.$us_url_root.'includes/imports.php';
  ?>
  <!-- Import CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo $us_url_root ?>includes/custom_css.css" />
</head>

<!--  IMPORT MODALS -->
<?php require_once $abs_us_root.$us_url_root.'managers/includes/modals/modal_add_shift.php'; ?>
<!-- IMPORT MESSAGES -->
<?php require_once $abs_us_root.$us_url_root.'managers/includes/manager_messages.php'; ?>

<!-- Body -->
<body onload="successMsg()">

  <!--Page Containers-->
  <div id="page-wrapper">
    <div class="container">

      <!--Staff Calendar Script-->
      <?php if (hasPerm([1])) { ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          if (window.innerWidth < 800) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
              plugins: [ 'interaction', 'timeGrid', 'dayGrid' ],
              defaultView: 'timeGridThreeDay',
              views: {
                timeGridThreeDay: {
                  type: 'timeGrid',
                  duration: { days: 3 },
                  buttonText: '3 day'
                }
              },
              header: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,timeGridThreeDay'
              },
              navLinks: true, // can click day/week names to navigate views
              editable: true,
              eventLimit: true, // allow "more" link when too many events
              events: [
                <?php foreach ( getUserShifts() as $s ) { ?>
                  {
                    title: '<?php echo getFullNameFromShiftID($s->id) ?>',
                    start: '<?php echo $s->start_date ?>',
                    end: '<?php echo date("Y-m-d", strtotime("$s->end_date+1 day")); ?>',
                    url: 'staff/shift_view.php?shiftid=<?php echo $s->id ?>'
                  },
                  <?php } ?>
                ],
                eventColor: '#000000'
              });
            } else {
              var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid' ],
                header: {
                  left: 'prevYear,prev,next,nextYear today',
                  center: 'title',
                  right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                  <?php foreach ( getUserShifts() as $s ) { ?>
                    {
                      title: '<?php echo getFullNameFromShiftID($s->id) ?>',
                      start: '<?php echo $s->start_date ?>',
                      end: '<?php echo date("Y-m-d", strtotime("$s->end_date+1 day")); ?>',
                      url: 'staff/shift_view.php?shiftid=<?php echo $s->id ?>'
                    },
                    <?php } ?>
                  ],
                  eventColor: '#000000'
                });
              }
              calendar.render();
            });
            </script>
            <!--Staff Calendar Script-->

            <!--Staff Page-->
            <h1>Employee Area</h1>
            <hr/>
            <a class="btn btn-primary" href="staff-guide.pdf">Help</a>
            <hr/>
            <div id="calendar"></div>
            <?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
            <!--Staff Page-->

          <?php } else if (hasPerm([3])) { ?>
            <!--Manager Calender Script-->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
              var calendarEl = document.getElementById('calendar');
              if (window.innerWidth < 800) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                  plugins: [ 'interaction', 'timeGrid', 'dayGrid' ],
                  defaultView: 'timeGridThreeDay',
                  views: {
                    timeGridThreeDay: {
                      type: 'timeGrid',
                      duration: { days: 3 },
                      buttonText: '3 day'
                    }
                  },
                  header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridThreeDay'
                  },
                  navLinks: true, // can click day/week names to navigate views
                  editable: true,
                  eventLimit: true, // allow "more" link when too many events
                  events: [
                    <?php foreach ( getAllShifts() as $s ) { ?>
                      {
                        title: '<?php echo getFullNameFromShiftID($s->id) ?>',
                        start: '<?php echo $s->start_date ?>',
                        end: '<?php echo date("Y-m-d", strtotime("$s->end_date+1 day")); ?>',
                        url: 'managers/shift_view.php?shiftid=<?php echo $s->id ?>'
                      },
                      <?php } ?>
                    ],
                    eventColor: '#000000'
                  });
                } else {
                  var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'interaction', 'dayGrid' ],
                    header: {
                      left: 'prevYear,prev,next,nextYear today',
                      center: 'title',
                      right: 'dayGridMonth,dayGridWeek,dayGridDay'
                    },
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: [
                      <?php foreach ( getAllShifts() as $s ) { ?>
                        {
                          title: '<?php echo getFullNameFromShiftID($s->id) ?>',
                          start: '<?php echo $s->start_date ?>',
                          end: '<?php echo date("Y-m-d", strtotime("$s->end_date+1 day")); ?>',
                          url: 'managers/shift_view.php?shiftid=<?php echo $s->id ?>'
                        },
                        <?php } ?>
                      ],
                      eventColor: '#000000'
                    });
                  }
                  calendar.render();
                });
                </script>
                <!--Manager Calendar Script-->

                <!--Manager Page-->
                <h1>Manager Area</h1><hr/>

                <div class="row">
                  <div class="col-sm-12">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addShift">+ Add Shift</button>
                    <a href="<?php echo $us_url_root ?>managers/algorithm.php?redirect=1" class="btn btn-primary">Generate Rota</a>
                    <a class="btn btn-primary" href="manager-guide.pdf">Help</a>
                  </div>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-sm-12">
                    <div id="calendar"></div>
                  </div>
                </div>
              <?php }
              require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
              <!--Manager Page-->

              <!--Page Containers-->
            </div>
          </div>

          <!--If user is not logged in redirect to login page-->
        <?php } else { header('Location: usersc/login.php');} ?>

          <!-- Import Scripts -->
          <script src="<?php echo $us_url_root ?>includes/date_picker.js" type="text/javascript"></script>
          <script src="<?php echo $us_url_root ?>includes/scripts.js" type="text/javascript"></script>
          <script src="<?php echo $us_url_root ?>managers/includes/manager_scripts.js" type="text/javascript"></script>
