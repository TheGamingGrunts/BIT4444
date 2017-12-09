<?php
require_once("db.php");

$sql = "SELECT Title As Department, SUM((TIME_TO_SEC(TIMEDIFF(TimeOut,TimeIn))/60/60)) As HoursWorked From punchdata LEFT JOIN department ON punchdata.JobCode = department.JobCode GROUP BY Title";


$result = $mydb->query($sql);

$data = array();
for($x=0; $x<mysqli_num_rows($result); $x++) {
  $data[] = mysqli_fetch_assoc($result);
}

echo json_encode($data);
?>
