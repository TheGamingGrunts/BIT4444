<?php
  session_start();
  if (!isset($_SESSION["login"])){
    Header("Location:../../login");
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
  <title>TimeClock | Edit Hours</title>
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
        <li class="breadcrumb-item active">Edit Hours</li>
        <li id="clock" class="pull-right"></li>
      </ol>
      <div>
        <div class="text-center center-block">
          <h1>Edit Hours</h1>
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
            <div class="card mb-3">
              <div id="tablename" class="card-header"><i class="fa fa-table"></i> Edit Hours</div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>PunchID</th>
                        <th>Job Code</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Rate</th>
                        <th>Hours</th>
                      </tr>
                    </thead>
                    <!--<tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Employee ID</th>
                        <th>Date In</th>
                        <th>Time In</th>
                        <th>Department</th>
                      </tr>
                    </tfoot>-->
                    <tbody>
                      <?php
                        if (isset($_POST["go"])){
                          require_once("../../login/db.php");
                          $search = explode(" ", $_POST["search"]);
                          $result = $mydb->query("SELECT ed.EmployeeID, ed.LastName, ed.FirstName FROM employeedata ed WHERE (ed.LastName LIKE '".$search[0]."' AND ed.FirstName LIKE '".$search[1].
                            "') OR (ed.LastName LIKE '".$search[1]."' AND ed.FirstName LIKE '".$search[0]."')");
                          $row1 = mysqli_fetch_array($result);
                          echo "<script>document.getElementById('tablename').innerHTML=' ".$row1["FirstName"]."&#8217;s Hours';</script>";
                          $result2 = $mydb->query("SELECT DISTINCT pd.PunchID, pd.DateIn, pd.TimeIn, pd.DateOut, pd.TimeOut, jt.JobTitle, d.Title as 'Dept', jt.JobSalary, TIMESTAMPDIFF(SECOND, CONCAT(pd.DateIn,' ', pd.TimeIn), CONCAT(pd.DateOut,' ', pd.TimeOut))/3600.0 AS 'Hours' FROM punchdata pd, login, employeedata ed, jobtype jt, department d WHERE pd.EmployeeID=".$row1["EmployeeID"]." AND pd.EmployeeID = ed.EmployeeID AND ed.JobType = jt.JobID AND ed.DeptCode = d.JobCode");
                          $count = 0;
                          while($row = mysqli_fetch_array($result2)){
                            $count++;
                            echo "<tr><td>".$row["PunchID"]."</td><td>".$row["Dept"]."</td><td>".$row["DateIn"]." ".$row["TimeIn"]."</td><td>".$row["DateOut"]." ".$row["TimeOut"]."</td><td>".$row["JobSalary"]."</td><td>".$row["Hours"]."</td><tr>"; 
                          }

                          if ($count == 0){
                            echo "<tr><td class='text-danger'>No hours on record <i class='fa fa-frown-o' aria-hidden='true'></i></td></tr>";
                          }

                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
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
            <form name="logout" action="../../logout.php" method="POST">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" formmethod="post" type="submit" name="submit" value="submit">Logout</button>
            </form>
          </div>
        </div>
        </div>
      </div>
      <div class="modal fade" id="edit">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Punch</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Date In</label>
                  <div class="col-10">
                    <input class="form-control" type="date" value="2011-08-19" id="date-in">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Time In</label>
                  <div class="col-10">
                    <input class="form-control" type="time" value="13:45:00" id="time-in">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Date Out</label>
                  <div class="col-10">
                    <input class="form-control" type="date" value="2011-08-19" id="date-out">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Time Out</label>
                  <div class="col-10">
                    <input class="form-control" type="time" value="13:45:00" id="time-out">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-text-input" class="col-2 col-form-label">Comment</label>
                  <div class="col-10">
                    <input class="form-control" type="text" value="" id="comment">
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="missedin" value="1"> Missed In
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="missedout" value="2"> Missed Out
                  </label>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" name="update">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <?php 
        if (isset($_POST["update"])){
          
        }
      ?>
    </div>
  </div>
      <script src="../../js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../js/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../../js/datatables/jquery.dataTables.js"></script>
    <script src="../../js/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../../js/sb-admin-datatables.min.js"></script>
    <!-- Custom scripts for this page-->
    <!-- Toggle between fixed and static navbar-->
    <script src="../../js/clock.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
    <script src="../../js/select2.min.js"></script>
    <script>
      $('#dataTable').find('tr').click( function(){
        $('#edit').modal('show'); 
        var c1 = $(this).find('td:nth-child(1)').text();
        var c2 = $(this).find('td:nth-child(2)').text();
        var c3 = $(this).find('td:nth-child(3)').text();
        var c4 = $(this).find('td:nth-child(4)').text();
        var c5 = $(this).find('td:nth-child(5)').text();
        var c6 = $(this).find('td:nth-child(6)').text();
        var dateinsplit = c3.split(" ");
        var dateoutsplit = c4.split(" ");
        $("#date-in").val(dateinsplit[0]);
        $("#time-in").val(dateinsplit[1]);
        $("#date-out").val(dateoutsplit[0]);
        $("#time-out").val(dateoutsplit[1]);
      });
    </script>
  </div>
</body>
</html>
