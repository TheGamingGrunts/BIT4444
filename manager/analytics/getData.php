<?php
require_once("db.php");

$sql = "SELECT JobCode As Department, PunchID-EmployeeID As HoursWorked From punchdata WHERE PunchID < 30000";


$result = $mydb->query($sql);

$data = array();
for($x=0; $x<mysqli_num_rows($result); $x++) {
  $data[] = mysqli_fetch_assoc($result);
}

echo json_encode($data);
?>
