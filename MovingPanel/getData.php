<?php
  $host = "localhost";
  $userName = "root";
  $password = "";
  $dbName = "control";

  $connection = new mysqli($host ,$userName ,$password ,$dbName);
  if($connection->connect_error){
      die('Error'. $connection->connect_error);
  }
  $statment1 = "SELECT direction FROM moving_control
               WHERE id = (SELECT MAX(id) from moving_control)";

  $result1 = $connection->query($statment1);

  if($result1->num_rows > 0){
    while ($row = $result1->fetch_assoc()) {
      echo $row["direction"] ." ";
    }
  }

  $connection->close();             


?>
