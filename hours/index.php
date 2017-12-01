<?php
  session_start();
  if (!isset($_SESSION["login"])){
    Header("Location:../login");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TimeClock | My Hours</title>
  <!-- Bootstrap core CSS-->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/button.css">
  <script src="../js/pace.js"></script>
  <script src="../js/date.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/pace.css">
</head>

<body class="fixed-nav sticky-footer bg-light sidenav-toggled" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <img src="../images/logo-maroon.png" style="height: 5%; width: 5%;">
    <a class="navbar-brand" href="../" style="padding-left: 10px;">TimeClock</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="../">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Hours">
          <a class="nav-link" href="">
            <i class="fa fa-fw fa-clock-o"></i>
            <span class="nav-link-text">My Hours</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Schedule">
          <a class="nav-link" href="../schedule">
            <i class="fa fa-fw fa-calendar"></i>
            <span class="nav-link-text">My Schedule</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Account">
          <a class="nav-link" href="../settings/">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">My Account</span>
          </a>
        </li>
        <?php
          require_once("../Sidebar.php");
        ?>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <!--<i class="fa fa-fw fa-circle"></i>-->
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span id="wrapper" class="indicator text-warning d-none d-lg-block">
              <i id="notification" class="fa fa-fw fa-circle" style="display: none;"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            
            <?php
              require_once("../alerts.php");
            ?>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../">TimeClock</a>
        </li>
        <li class="breadcrumb-item active">My Hours</li>
        <li id="clock" class="pull-right"></li>
      </ol>
      <div class="card card-body">
        <div class="col-12 text-center">
          <form name="punch">
            <button id="in" type="submit" formmethod="post" name="in" class="btn btn-success btn-circle btn-xl"><i class="fa fa-check"></i><h5>In</h5></button>
            <button id="break" type="submit" formmethod="post" name="break" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-chain-broken"></i><h5>Break</h5></button>
            <button id="out" type="submit" formmethod="post" name="out" class="btn btn-danger btn-circle btn-xl"><i class="fa fa-times"></i><h5>Out</h5></button>
            <br>
            <br>
            <div><h1 id="status"></h1></div>
            <div><h5 id="stattime"></h5></div>
            <?php
              require("../Status.php");

              if (isset($_POST["in"])){
                if ($_SESSION["status_name"] == "Clocked In"){
                  echo "<script>alert('You are already clocked in!');</script>";
                }else{
                  $punchid = mt_rand(10000, 99999); //generate random punch ID
                  //Insert punch data into punchdata table
                  $mydb->query("INSERT INTO `punchdata` (`PunchID`, `EmployeeID`, `ModificationID`, `JobCode`, `DateIn`, `TimeIn`, `DateOut`, `TimeOut`, `Break`) VALUES (".$punchid.
                    ", (SELECT ed.EmployeeID FROM employeedata ed, login l WHERE l.username ='".$_SESSION["username"].
                      "' AND l.EmployeeID = ed.EmployeeID), NULL, (SELECT d.JobCode FROM department d, login l, employeedata ed WHERE l.username='"
                      .$_SESSION["username"]."' AND l.EmployeeID = ed.EmployeeID AND ed.DeptCode = d.JobCode), CURDATE(), CURTIME(), NULL, NULL, NULL);");
                 $result = $mydb->query("SELECT pd.DateIn, pd.TimeIn FROM punchdata pd WHERE pd.PunchID=".$punchid.";"); //get date in and out from most recent punch using the PunchID
                 $row = mysqli_fetch_array($result);

                 //Update status table
                 $mydb->query("INSERT INTO `status` (`EmployeeID`, `PunchID`, `StatusCode`, `LastDate`, `LastTime`) VALUES ((SELECT ed.EmployeeID FROM employeedata ed, login l WHERE l.username='".$_SESSION["username"]."' AND l.EmployeeID = ed.EmployeeID),"
                  .$punchid.", 1, DATE('".$row["DateIn"]."'), TIME('"
                  .$row["TimeIn"]."')) ON DUPLICATE KEY UPDATE `PunchID`= ".$punchid.", `StatusCode`= 1, `LastDate`=DATE('".$row["DateIn"]."'), `LastTime`=TIME('".$row["TimeIn"]."');");
                 $_SESSION["status_name"] = "Clocked In"; //update session
                }
              }elseif (isset($_POST["out"])) { //TODO
                if ($_SESSION["status_name"] == "Clocked Out"){
                  echo "<script>alert('You are already clocked out!');</script>";
                }else{
                  $row = mysqli_fetch_array($mydb->query("SELECT s.PunchID FROM status s, login l, employeedata ed WHERE l.Username='".$_SESSION["username"]."' AND l.EmployeeID = ed.EmployeeID AND ed.EmployeeID = s.EmployeeID;"));
                  $punchid = $row["PunchID"];
                  $mydb->query("UPDATE punchdata SET `DateOut`= CURDATE(), `TimeOut`= CURTIME() WHERE `PunchID`=".$punchid.";");
                  $mydb->query("UPDATE status SET `StatusCode`= 3, `LastDate`=(SELECT DateOut FROM punchdata pd WHERE pd.PunchID=".$punchid."), `LastTime`=(SELECT TimeOut FROM punchdata pd WHERE pd.PunchID=".$punchid.") WHERE status.EmployeeID=(SELECT EmployeeID FROM login l WHERE l.Username='".$_SESSION["username"]."');");
                  $_SESSION["status_name"] = "Clocked Out";
                }
              }elseif (isset($_POST["break"])) { //TODO
                if ($_SESSION["status_name"] == "On Break"){
                  echo "<script>alert('You are currently on break!');</script>";
                }else{
                  //break
                }
              }
              require("../Status.php");
            ?>
          </form>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> My Hours</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Job Title</th>
                  <th>Department</th>
                  <th>Rate</th>
                  <th>Hours</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Job Title</th>
                  <th>Department</th>
                  <th>Rate</th>
                  <th>Hours</th>
                </tr>
              </tfoot>
              <tbody>
                  <?php

                    require_once("../login/db.php");
                    $result = $mydb->query("SELECT pd.DateIn, pd.TimeIn, pd.DateOut, pd.TimeOut, jt.JobTitle, d.Title as 'Dept', jt.JobSalary, TIMESTAMPDIFF(SECOND, CONCAT(pd.DateIn,' ', pd.TimeIn), CONCAT(pd.DateOut,' ', pd.TimeOut))/3600.0 AS 'Hours' FROM punchdata pd, login, employeedata ed, jobtype jt, department d WHERE login.Username ='".$_SESSION['username']."' AND login.EmployeeID = pd.EmployeeID AND pd.EmployeeID = ed.EmployeeID AND ed.JobType = jt.JobID AND ed.DeptCode = d.JobCode");
                    
                    while($row = mysqli_fetch_array($result)){
                      echo "<tr><td>".$row["DateIn"]." ".$row["TimeIn"]."</td><td>".$row["DateOut"]." ".$row["TimeOut"]."</td><td>".$row["JobTitle"]."</td><td>".$row["Dept"]."</td><td>".$row["JobSalary"]."</td><td>".$row["Hours"]."</td></tr>";
                    }
                  ?>
              </tbody>
            </table>
          </div>
      </div>
      <!-- Blank div to give the page height to preview the fixed vs. static navbar-->
      <div style="height: 100px;"></div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright 2017 © Daniel Slutsky, Kyle Chong, Quinn Johnson</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">            
            <form name="logout" action="../logout.php" method="POST">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" formmethod="post" type="submit" name="submit" value="submit">Logout</button>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../js/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../js/datatables/jquery.dataTables.js"></script>
    <script src="../js/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <script src="../js/clock.js"></script>
  </div>
</body>
</html>
