<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
	<link rel="stylesheet" href="../css/schedule-reset.css"> <!-- CSS reset -->
  	<link rel="stylesheet" href="../css/schedule-style.css">
  	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  	<script src="../js/modernizr.js"></script>
  	<script src="../js/main.js"></script>
</head>
<body>
	<div class="cd-schedule loading">
		<div class="timeline">
			<ul>
				<li><span>06:00</span></li>
				<li><span>07:00</span></li>
				<li><span>08:00</span></li>
				<li><span>09:00</span></li>
				<li><span>10:00</span></li>
				<li><span>11:00</span></li>
				<li><span>12:00</span></li>
				<li><span>13:00</span></li>
				<li><span>14:00</span></li>
				<li><span>15:00</span></li>
				<li><span>16:00</span></li>
				<li><span>17:00</span></li>
				<li><span>18:00</span></li>
				<li><span>19:00</span></li>
				<li><span>20:00</span></li>
				<li><span>21:00</span></li>
				<li><span>22:00</span></li>
				<li><span>23:00</span></li>
			</ul>
		</div>

		<div class="events">
			<ul>
				<?php
					session_start();
					require_once("../login/db.php");
					$result = $mydb->query("SELECT * FROM schedule s, login l WHERE l.Username='".$_SESSION["username"]."' AND l.EmployeeID = s.EmployeeID;");
					$all = mysqli_fetch_array($result);
					                  
					$main = "SELECT s.StartTime, s.EndTime FROM shift s, schedule sc WHERE sc.EmployeeID=".$all["EmployeeID"]."";
					$sun = mysqli_fetch_array($mydb->query($main." AND sc.Sunday=s.ShiftCode"));
					$mon = mysqli_fetch_array($mydb->query($main." AND sc.Monday=s.ShiftCode"));
					$tue = mysqli_fetch_array($mydb->query($main." AND sc.Tuesday=s.ShiftCode"));
					$wed = mysqli_fetch_array($mydb->query($main." AND sc.Wednesday=s.ShiftCode"));
					$thu = mysqli_fetch_array($mydb->query($main." AND sc.Thursday=s.ShiftCode"));
					$fri = mysqli_fetch_array($mydb->query($main." AND sc.Friday=s.ShiftCode"));
					$sat = mysqli_fetch_array($mydb->query($main." AND sc.Saturday=s.ShiftCode"));


                  echo "
                  	<li class='events-group'>
                      <div class='top-info'><span>Monday</span></div>
                      <ul>
                        <li class='single-event' data-start='".$mon["StartTime"]."' data-end='".$mon["EndTime"]."' data-content='event-abs-circuit' data-event='event-1'>
                          <a href='#0'>
                            <em class='event-name'>Monday Shift</em>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class='events-group'>
                      <div class='top-info'><span>Tuesday</span></div>
                      <ul>
                        <li class='single-event' data-start='".$tue["StartTime"]."' data-end='".$tue["EndTime"]."' data-content='event-abs-circuit' data-event='event-2'>
                          <a href='#0'>
                            <em class='event-name'>Tuesday Shift</em>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class='events-group'>
                      <div class='top-info'><span>Wednesday</span></div>
                      <ul>
                        <li class='single-event' data-start='".$wed["StartTime"]."' data-end='".$wed["EndTime"]."' data-content='event-abs-circuit' data-event='event-3'>
                          <a href='#0'>
                            <em class='event-name'>Wednesday Shift</em>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class='events-group'>
                      <div class='top-info'><span>Thursday</span></div>
                      <ul>
                        <li class='single-event' data-start='".$thu["StartTime"]."' data-end='".$thu["EndTime"]."' data-content='event-abs-circuit' data-event='event-4'>
                          <a href='#0'>
                            <em class='event-name'>Thursday Shift</em>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class='events-group'>
                      <div class='top-info'><span>Friday</span></div>
                      <ul>
                        <li class='single-event' data-start='".$fri["StartTime"]."' data-end='".$fri["EndTime"]."' data-content='event-abs-circuit' data-event='event-1'>
                          <a href='#0'>
                            <em class='event-name'>Friday Shift</em>
                          </a>
                        </li>
                      </ul>
                    </li>
                  ";
                ?>
              </ul>
            </div>
			<div class="event-modal">
				<header class="header">
					<div class="content">
						<span class="event-date"></span>
						<h3 class="event-name"></h3>
					</div>
					<div class="header-bg"></div>
				</header>

				<div class="body">
					<div class="event-info"></div>
					<div class="body-bg"></div>
				</div>

				<a href="#0" class="close">Close</a>
			</div>
		<div class="cover-layer"></div>
	</div>
</body>
</html>