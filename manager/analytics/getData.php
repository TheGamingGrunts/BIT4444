<?php
require_once("../../login/db.php");

$sql = "SELECT d.Title As `Department`, SUM((TIME_TO_SEC(TIMEDIFF(pd.TimeOut,pd.TimeIn))/60/60)) As `HoursWorked` From punchdata pd LEFT JOIN department d ON pd.JobCode = d.JobCode GROUP BY `Department`";


$result = $mydb->query($sql);

$data = array();
for($x=0; $x<mysqli_num_rows($result); $x++) {
  $data[] = mysqli_fetch_assoc($result);
}

echo json_encode($data);
?>