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
  <title>TimeClock | Settings</title>
  <!-- Bootstrap core CSS-->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/button.css">
    <script src="../js/pace.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/pace.css">
  <link rel="stylesheet" type="text/css" href="../css/profile.css">
      <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
          <a class="nav-link" href="../hours">
            <i class="fa fa-fw fa-clock-o"></i>
            <span class="nav-link-text">My Hours</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Account">
          <a class="nav-link" href="">
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
        <li class="breadcrumb-item active">My Account</li>
        <li id="clock" class="pull-right"></li>
      </ol>
      <div>
        <div >
          <div class="col-md-7 ">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 >User Profile</h4>
              </div>
              <div class="panel-body">
                <div class="box box-info">
                  <div class="box-body">
                    <div class="col-sm-6">
                      <div  align="center">
                        <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 
                        <input id="profile-image-upload" class="hidden" type="file">
                        <div style="color:#999;" >click here to change profile image</div>
                        <!--Upload Image Js And Css-->
                      </div>
                      <br>
                      <!-- /input-group -->
                    </div>
                    <div class="col-sm-6">
                      <h4 style="color:#00b1b1;"><?php echo $_SESSION['first']." ".$_SESSION['last'];?></h4>
                      <span>
                        <!--<p>Aspirant</p> INSERT RANK/TITLE HERE-->
                      </span>
                    </div>
                    <div class="clearfix"></div>
                    <hr style="margin:5px 0 5px 0;">
                    <div class="col-sm-5 col-xs-6 title " >First Name:</div>
                    <div class="col-sm-7 col-xs-6 "><?php echo $_SESSION['first']?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 title " >Last Name:</div>
                    <div class="col-sm-7"> <?php echo $_SESSION['last'];?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 title " >Email:</div>
                    <div class="col-sm-7"></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 title " >Password:</div>
                    <div class="col-sm-7"></div>
                    <div class="clearfix"></div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
            </div>
          </div>
          <script>
            $(function() {
            $('#profile-image1').on('click', function() {
            $('#profile-image-upload').click();
            });
            });       
          </script> 
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

    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../js/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <!-- Toggle between fixed and static navbar-->
    <script src="../js/clock.js"></script>
  </div>
</body>

</html>
