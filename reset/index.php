<?php
	session_start();
	if (isset($_SESSION["login"])){
		Header("Location:..");
	}
	$username = "";
	$error = false;
	$validated = false;
	if(isset($_POST["reset"])){
	    if(isset($_POST["username"])) $username=$_POST["username"];

	    if(empty($username)) {
	      $error=true;
		}

	    if(!$error){
			require_once("../login/db.php");
			$result = $mydb->query("SELECT ed.EmailAddress FROM employeedata ed, login l WHERE l.username='".$username."';");
			$row = mysqli_fetch_array($result);
			if ($row["EmailAddress"] != ""){
				//send email to reset password - WE WILL NOT IMPLEMENT THIS PART
				$validated = true;
				echo "<script>alert('A password reset email has been sent to the email address provided');</script>";
			}
			
		    if($validated) {
		        Header("Location:../login/");
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
		<script src="../js/pace.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/pace.css">
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
										echo "<span style='color: red;'>Please enter your username</span>";
									}
								?>
							</div>
							<br>						
							<table>
								<tr>
									<td><button type="submit" formmethod="post" name="reset" class="btn btn-primary" action="PHP FILE">Reset</button></td>
									<?php
										if (isset($_POST["reset"]) && !$validated && !$error){
											echo "<span style='color: red;'>Invalid username</span>";
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