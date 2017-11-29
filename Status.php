<?php
	require_once("login/db.php");
	$result = $mydb -> query("SELECT st.Name, s.LastDate, s.LastTime FROM login l, employeedata ed, status s, statustype st WHERE l.Username ='".$_SESSION["username"]."'AND l.EmployeeID = ed.EmployeeID AND ed.EmployeeID = s.EmployeeID AND s.StatusCode = st.StatusCode");

	while($row = mysqli_fetch_array($result)){
		echo "<script>document.getElementById('status').innerHTML = '".$row["Name"]."'</script>";
		echo "<script>document.getElementById('stattime').innerHTML = Date.parse('".$row["LastDate"]." ".$row["LastTime"]."')</script>";	
	}
?>