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
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/button.css">
    <script src="../js/pace.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/pace.css">
  <link rel="stylesheet" type="text/css" href="../css/settings.css">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/paper/bootstrap.min.css">
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Schedule">
          <a class="nav-link" href="../schedule">
            <i class="fa fa-fw fa-calendar"></i>
            <span class="nav-link-text">My Schedule</span>
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
        <div class="">
            <!-- UI - X Starts -->
            <div class="ui-67">
            
              <!-- Head Starts -->
              <div class="ui-head bg-lblue">
                <!-- Details -->
                <div class="ui-details">
                  <!-- Name -->
                  <h3 id="name-header"><?php echo $_SESSION["first"]." ".$_SESSION["last"];?></h3>
                  <!-- Designation -->
                  <h4><?php echo $_SESSION["title"].", ".$_SESSION["dept"];?></h4>
                </div>
                <!-- Image -->
                <div class="ui-image">
                  <!-- User Image -->
                  <img src="https://api.adorable.io/avatars/285/abott@adorable.png" alt="Profile Picture" class="img-responsive" width="100" height="100">
                </div>
              </div>
              <!-- Head Ends -->
              
              <!-- Content Starts -->
              <div class="ui-content">

                <div class="row">
                  
                  <div class="col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 acc-col">
                    <section>
                      <h3>Contact Information</h3>

                      <?php
                        require_once("../login/db.php");
                        $result = $mydb->query("SELECT ed.LastName AS last, ed.FirstName AS first, ed.EmailAddress, ed.Phone, ed.Address, ed.City, ed.State, ed.Zip FROM employeedata ed, login WHERE login.username ='".$_SESSION["username"]."' AND login.EmployeeID = ed.EmployeeID");
                        $row = mysqli_fetch_array($result);
                        $last = $row["last"];
                        $first = $row["first"];
                        $email = $row["EmailAddress"];
                        $address = $row["Address"];
                        $phone = $row["Phone"];
                        $city = $row["City"];
                        $state = $row["State"];
                        $zip = $row["Zip"];
                      ?>
                      <form class="ng-pristine ng-valid" action="index.php">
                        <div class="row">
                           <div class="col-sm-6">
                            <label class="control-label">First Name:</label>
                              <input type="text" class="form-control" id="first" name="first" value=<?php echo "'$first'";?>>
                          </div>   
                          <div class="col-sm-6">
                            <label class="control-label">Last Name:</label>
                              <input type="text" class="form-control" id="last" name="last" value=<?php echo "'$last'";?>>
                          </div>               
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <label class="control-label">Email:</label>
                              <input type="email" class="form-control" id="email" name="email" value=<?php echo "'$email'";?>>
                          </div>
                          <div class="col-sm-6">
                            <label class="control-label">Phone Number:</label>
                              <input type="text" class="form-control" id="phone" name="phone" value=<?php echo "'$phone'";?>>
                          </div>  
                        </div>

                        <div class="row">
                          <div class="col-sm-4">
                            <label class="control-label">Address:</label>
                              <input type="text" class="form-control" id="address" name="address" value=<?php echo "'$address'";?>>
                          </div>
                          <div class="col-sm-4">
                            <label class="control-label">City:</label>
                              <input type="text" class="form-control" id="city" name="city" value=<?php echo "'$city'";?>>
                          </div> 

                          <div class="col-sm-2">
                            <label class="control-label">State/Province:</label>
                              <input type="text" class="form-control" id="state" name="state" value=<?php echo "'$state'";?>>
                          </div> 

                          <div class="col-sm-2">
                            <label class="control-label">Zip Code:</label>
                              <input type="number" class="form-control" id="zip" name="zip" value=<?php echo "'$zip'";?>>
                          </div> 
                        </div>
                        <div class="col-sm-12">
                          <div class="btn-div">
                            <button type="submit" formmethod="post" name="updateInfo" class="btn btn-primary pull-right">Update</button>
                          </div>
                        </div>
                        <?php
                          if(isset($_POST["updateInfo"])){
                            require_once("../login/db.php");
                            $mydb->query("UPDATE employeedata ed, login l SET ed.FirstName='".$_POST["first"]."', ed.LastName='".$_POST["last"]."', ed.EmailAddress='".$_POST["email"]."', ed.Phone='".$_POST["phone"]."', ed.Address='"
                              .$_POST["address"]."', ed.City='".$_POST["city"]."', ed.State='".$_POST["state"]."', ed.Zip=".$_POST["zip"]." WHERE l.username='".$_SESSION["username"]."' AND l.EmployeeID=ed.EmployeeID;");
                            echo "<script>alert('Contact Information Updated Successfully!');</script>";
                          }
                        ?>
                        </form>   
                    </section>

                  <section>
                    <h3>Change Password</h3>
                    <form role="form">
                      <div class="row">
                        <div class="col-sm-12">
                          <label class="control-label">Password:</label>
                          <div>
                            <input type="password" class="form-control" id="pass1" name="pass1">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <label class="control-label">Confirm:</label>
                          <div>
                            <input type="password" class="form-control" id="pass2" name="pass2">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="btn-div">
                            <button type="submit" formmethod="post" name="updatePass" class="btn btn-primary pull-right">Update</button>
                          </div>
                        </div>          
                      </div>
                      <?php
                        if (isset($_POST["updatePass"])){
                          if ($_POST["pass1"] != "" && $_POST["pass2"] != ""){
                            if ($_POST["pass1"] == $_POST["pass2"]){
                              require_once("../login/db.php");
                              $mydb->query("UPDATE login l SET l.Password='".password_hash($_POST["pass1"], PASSWORD_DEFAULT)."' WHERE l.username='".$_SESSION["username"]."';");
                              echo "<script>alert('Password Updated Successfully!');</script>";
                            }else{
                              echo "
                                <div class='col-sm-12'>
                                    <p class='text-danger'>Password fields must match!</p>      
                                </div>
                            ";
                            }
                          }else{
                            echo "
                            <div class='col-sm-12'>
                                <p class='text-danger'>Password fields cannot be blank!</p>      
                            </div>
                            ";
                          }
                        }
                      ?>
                    </form>  
                  </section>
                  </div>
                  <!-- col-8 -->
                </div>

              </div>
              <!-- Content Ends -->
            </div>
            <!-- UI - X Ends -->
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
