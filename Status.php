<?php
	require_once("login/db.php");
	$result = $mydb -> query("SELECT st.Name, s.LastDate, s.LastTime FROM login l, employeedata ed, status s, statustype st WHERE l.Username ='".$_SESSION["username"]."'AND l.EmployeeID = ed.EmployeeID AND ed.EmployeeID = s.EmployeeID AND s.StatusCode = st.StatusCode");

	$count = 0;
	while($row = mysqli_fetch_array($result)){
		$count++;
		echo "<script>document.getElementById('status').innerHTML = '".$row["Name"]."'</script>";
		echo "<script>document.getElementById('stattime').innerHTML = Date.parse('".$row["LastDate"]." ".$row["LastTime"]."')</script>";	
	}

	if ($count == 0){
		echo "<script>document.getElementById('status').innerHTML = 'Clocked Out'</script>";
		echo "<script>document.getElementById('stattime').innerHTML = 'No Punch Data'</script>";	
	}
?>