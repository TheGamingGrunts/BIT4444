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
  <title>TimeClock | Edit Schedule</title>
  <!-- Bootstrap core CSS-->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="https://instructure-uploads.s3.amazonaws.com/account_45110000000000001/attachments/4984875/favicon.ico" />
  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/button.css">
    <script src="../../js/pace.js"></script>
  <link rel="stylesheet" type="text/css" href="../../css/pace.css">
  <link href="../../css/select2.min.css" rel="stylesheet" />
      <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>

<body class="fixed-nav sticky-footer bg-light sidenav-toggled" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <img src="../../images/logo-maroon.png" style="height: 5%; width: 5%;">
    <a class="navbar-brand" href="../" style="padding-left: 10px;">TimeClock</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="../../">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Hours">
          <a class="nav-link" href="../../hours">
            <i class="fa fa-fw fa-clock-o"></i>
            <span class="nav-link-text">My Hours</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Schedule">
          <a class="nav-link" href="../../schedule">
            <i class="fa fa-fw fa-calendar"></i>
            <span class="nav-link-text">My Schedule</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Account">
          <a class="nav-link" href="../../settings">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">My Account</span>
          </a>
        </li>
        <?php
          $_GET["manager"] = true;
          require_once("../../Sidebar.php");
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
              require_once("../../alerts.php");
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
          <a href="../../">TimeClock</a>
        </li>
        <li class="breadcrumb-item active">Edit Schedule</li>
        <li id="clock" class="pull-right"></li>
      </ol>
      <div>
        <div class="text-center center-block">
          <h1>Edit Schedule</h1>
          <br>
          <div class="container">
            <form class="col-6 col-md-4 pull-left" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="input-group">
                <input name="search" class="form-control" type="text" placeholder="Search employees...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit" formmethod="post" name="go">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
            <form class="pull-right" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Monday</label>
                  <div class="col-sm-7">
                    <input type="number" class="form-control" id="mon" name="mon">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Tuesday</label>
                  <div class="col-sm-7">
                    <input type="number" class="form-control" id="tues" name="tues">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Wednesday</label>
                  <div class="col-sm-7">
                    <input type="number" class="form-control" id="wed" name="wed">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Thursday</label>
                  <div class="col-sm-7">
                    <input type="number" class="form-control" id="thurs" name="thurs">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Friday</label>
                  <div class="col-sm-7">
                    <input type="number" class="form-control" id="fri" name="fri">
                  </div>
                </div>
                <button type="submit" formmethod="post" name="edit" class="btn btn-primary" action="PHP FILE">Submit Changes</button>
            </form>
          </div>
        </div>
        <?php
        //testing
          if (isset($_POST["go"])){
            require_once("../../login/db.php");
            $search = explode(" ", $_POST["search"]);
            $result = $mydb->query("SELECT * FROM schedule WHERE schedule.EmployeeID = (SELECT ed.EmployeeID FROM employeedata ed WHERE (ed.LastName LIKE '".$search[0]."' AND ed.FirstName LIKE '".$search[1].
              "') OR (ed.LastName LIKE '".$search[1]."' AND ed.FirstName LIKE '".$search[0]."'))");
            $row = mysqli_fetch_array($result);
            $_SESSION["empid"] = $row["EmployeeID"];
            echo "<script>document.getElementById('mon').value='".$row["Monday"]."';</script>";
            echo "<script>document.getElementById('tues').value='".$row["Tuesday"]."';</script>";
            echo "<script>document.getElementById('wed').value='".$row["Wednesday"]."';</script>";
            echo "<script>document.getElementById('thurs').value='".$row["Thursday"]."';</script>";
            echo "<script>document.getElementById('fri').value='".$row["Friday"]."';</script>";
            //echo "<script>alert('".$_POST["search"]."');</script>";
            for($i=0; $i<13; $i++){
              echo "<br>";
            }
            echo "
            <hr>
            <div style='height: 600px;'>
              <iframe src='../../schedule/schedule.php?manager=true' scrolling='yes' frameborder='0' style='position: relative; height: 100%; width: 100%;'></iframe>
            </div>
            ";
          }
          if (isset($_POST["edit"])){
            require_once("../../login/db.php");
            $mydb->query("UPDATE schedule s SET s.Monday=".$_POST["mon"].", s.Tuesday=".$_POST["tues"].", s.Wednesday=".$_POST["wed"].", s.Thursday=".$_POST["thurs"].", s.Friday=".$_POST["fri"]." WHERE s.EmployeeID=".$_SESSION["empid"].";");
          }
        ?>
        <!--Must be in iFrame, otherwise will screw up whole page style-->
        <!--<div style="height: 600px;">
          <iframe src="../../schedule/schedule.php" scrolling="yes" frameborder="0" style="position: relative; height: 100%; width: 100%;"></iframe>
        </div>-->
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
            <form name="logout" action="../../logout.php" method="POST">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" formmethod="post" type="submit" name="submit" value="submit">Logout</button>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>

    <script src="../../js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../js/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <!-- Toggle between fixed and static navbar-->
    <script src="../../js/clock.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
    <script src="../../js/select2.min.js"></script>
    <script type="text/javascript">
      $(".myselect").select2();
    </script>
    <script type="text/javascript">
      $("search").on("change", function(){
        var conceptName = $("#search").find(":selected").text();
        alert(conceptName);

      })
    </script>
  </div>
</body>
</html>
