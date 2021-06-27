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

  function insert($_sq){
    global $connection;
    if($connection->query($_sq)){
      header("Refresh: 0; URL=https://faisalmvc.github.io/Test/index.html");
    }else{
      echo "There is a problem ". $connection->error ." go back and try agine litter.";
    }
  }
  $connection->close();
?>
