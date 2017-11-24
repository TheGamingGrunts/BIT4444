            <?php
              require_once("login/db.php");
              $result = $mydb->query("SELECT a.AlertID, a.Time, a.AlertTitle, t.AlertName, a.AlertMessage FROM alerts a, alerttype t, login WHERE login.Username ='".$_SESSION["username"]."'AND login.EmployeeID = a.EmployeeID AND a.AlertType = t.AlertCode ORDER BY a.Time");
              $notification = false;
              $warning = false;
              $success = false;
              $count = 0;
              while($row = mysqli_fetch_array($result)){
                if ($count < 5){
                  if ($row["AlertName"] == "Success"){
                    $notification = true;
                    $success = true;
                    echo "<a class='dropdown-item' href='#''>
                          <span class='text-success'>
                            <strong>
                            <i class='fa fa-thumbs-up fa-fw'></i>".$row['AlertTitle']."</strong>
                          </span>
                          <span class='small float-right text-muted'>".$row['Time']."</span>
                          <div class='dropdown-message small'>".$row['AlertMessage']."</div>
                          </a>
                          <div class='dropdown-divider'></div>";
                  }elseif ($row["AlertName"] == "Warning") {
                    $notification = true;
                    $warning = true;
                    echo "<a class='dropdown-item' href='#''>
                          <span class='text-danger'>
                            <strong>
                            <i class='fa fa-thumbs-down fa-fw'></i>".$row['AlertTitle']."</strong>
                          </span>
                          <span class='small float-right text-muted'>".$row['Time']."</span>
                          <div class='dropdown-message small'>".$row['AlertMessage']."</div>
                          </a>
                          <div class='dropdown-divider'></div>";
                  }
                  $count++;
                }
              }
              if ($notification){
                if($success && !$warning){
                  echo "<script>document.getElementById('wrapper').classList.remove('text-warning');</script>";
                  echo "<script>document.getElementById('wrapper').classList.add('text-success');</script>";
                }elseif ($warning && !$success) {
                  echo "<script>document.getElementById('wrapper').classList.remove('text-warning')</script>";
                  echo "<script>document.getElementById('wrapper').classList.add('text-danger');</script>";
                }
                echo "<script>document.getElementById('notification').style.display = '';</script>";
              }else{
                echo "<a class='dropdown-item' href='#''><div class='dropdown-message small'>None :)</div></a>";
              }
            ?>