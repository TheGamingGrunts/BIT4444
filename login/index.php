<?php
	$username="";
	$password="";
	//$name = "";
	$error = false;
	$loginOK = null;

	if(isset($_POST["login"])){
    if(isset($_POST["username"])) $username=$_POST["username"];
    if(isset($_POST["password"])) $password=$_POST["password"];

    if(empty($username) || empty($password)) {
      $error=true;
	}

    if(!$error){
      //check username and password with the database record
      require_once("db.php");
      $sql = "select password from login where username='$username'";
      $result = $mydb->query($sql);

      $row=mysqli_fetch_array($result);
      if ($row){
        if(strcmp($password, $row["password"]) ==0 ){
          $loginOK=true;
          //$result = $mydb->query("select concat(last, first) as name from employeedata where employeedata.id = login.id");
          //$name = $row["name"];
        } else {
          $loginOK = false;
        }
      }

      if($loginOK) {
        session_start();
        $_SESSION["username"] = $username;
       // $_SESSION["empname"] = $name;
        Header("Location:..");
      }
    }
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>TimeClock | Login</title>
		<style type="text/css"></style>
		<link rel="stylesheet" href="..\css\bootstrap.min.css">
		<link rel="stylesheet" href="..\css\login.css">
		<script type="text/javascript"></script>
		<link rel="shortcut icon" type="image/x-icon" href="https://instructure-uploads.s3.amazonaws.com/account_45110000000000001/attachments/4984875/favicon.ico" />
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<!--<script src="..\js\login.js" type="text/javascript"></script>-->
	</head>
	<body>
		<br>
		<br>
		<br>
		<div class="container jumbotron">	
			<div class="row align-items-center vdivide">
				<div class="col-6 col-sm-6 text-center"><img class="center-block" src="..\images\logo-maroon.png"></div>
				<div class="col-6 col-md-4">
					<div class="card card-body">
						<form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="form-group ">	
								<label>Username</label>
								<input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter your username" value="<?php
						          if(!empty($username)){
						            echo $username;
						          }
						        ?>">
								<?php
									if (empty($username) && $error){
										echo "<span style='color: red;'>Please enter username</span>"; //add error class
									}
								?>
							</div>
							<div class="form-group">
								<label>Password</label>
							  	<input type="password" class="form-control" id="password" name="password" placeholder="Password" >
							  	<?php
									if (empty($password) && $error){
										echo "<span style='color: red;'>Please enter a password</span>"; //add error class
									}
								?>
							</div>
							<a href=""><small id="emailHelp" class="form-text text-muted">Forgot your password?</small></a>
							<br>						
							<table>
								<tr>
									<td><button type="submit" formmethod="post" name="login"class="btn btn-primary" action="PHP FILE">Login</button></td>
									<?php
										if(!$loginOK){
											echo "<td><span style='color: red;' hidden>Invalid login credentials</span></td>";
										}
									?>
								</tr>
							</table>	
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>