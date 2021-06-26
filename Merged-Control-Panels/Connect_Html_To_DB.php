<?php

  $host = "localhost";
  $userName = "root";
  $password = "";
  $dbName = "control";
  $connection = new mysqli($host, $userName, $password, $dbName);

  if(isset($_POST["forward"])){
    $sql ="INSERT INTO moving_control (direction) values('f')";
    insert($sql);
  }else if(isset($_POST["backward"])){
    $sql ="INSERT INTO moving_control (direction) values('b')";
    insert($sql);
  }else if(isset($_POST["left"])){
    $sql ="INSERT INTO moving_control (direction) values('l')";
    insert($sql);
  }else if(isset($_POST["right"])){
    $sql ="INSERT INTO moving_control (direction) values('r')";
    insert($sql);
  }else if(isset($_POST["stop"])){
    $sql ="INSERT INTO moving_control (direction) values('s')";
    insert($sql);
  }

  if(isset($_POST["Save"])) {

    $_motor1 =  $_POST["Motor1"];
    $_motor2 =  $_POST["Motor2"];
    $_motor3 =  $_POST["Motor3"];
    $_motor4 =  $_POST["Motor4"];
    $_motor5 =  $_POST["Motor5"];
    $_motor6 =  $_POST["Motor6"];

    $sql_1 = "INSERT INTO arm_angle (m1, m2, m3, m4, m5, m6)
            values ('$_motor1', '$_motor2', '$_motor3', '$_motor4', '$_motor5', '$_motor6') ";
    $sql_2 = "INSERT INTO run_arm (isWorking)
            values('false')";

    if($connection->query($sql_1) && $connection->query($sql_2)){
      echo "<h2>Done the record have been saved!</h2> <h3>just wait 3 seconds then you will get back to control page</h3>";
      header("Refresh: 3; URL=http://127.0.0.1/MergedPage/Arm&Moving_ControlPanel.html");
    }else{
      echo "There is a problem ". $connection->error;
    }

    } else if(isset($_POST["Run"])) {

    $query = "SELECT * FROM arm_angle";
    $result = mysqli_query($connection,$query);

    if ($result) { // this command check if there any record in the data base or not if not then it can't run the arm.
      if (mysqli_num_rows($result) > 0) {
        $query_2 = "INSERT INTO run_arm (isWorking)
                      values(true)";
        if($connection->query($query_2)){
          echo '<h2>Done now it\'s working</h2>';
          echo "<h3>Just wait 3 seconds then you will get back to control page</h3>";
          header("Refresh: 3; URL=http://127.0.0.1/MergedPage/Arm&Moving_ControlPanel.html");
        }
        } else {
          echo '<h2>You need to save the motors angle first then you can run it.</h2>';
          echo "<h3>Just wait 3 seconds then you will get back to control page</h3>";
          header("Refresh: 3; URL=http://127.0.0.1/MergedPage/Arm&Moving_ControlPanel.html");
        }
      } else {
        echo 'Error: '.mysql_error();
      }
      $connection->close();
    }


    function insert($_sq){
    global $connection;
    if($connection->query($_sq)){
      header("Refresh: 0; URL=http://127.0.0.1/MergedPage/Arm&Moving_ControlPanel.html");
    }else{
      echo "There is a problem ". $connection->error ." go back and try agine litter.";
    }
  }

?>
