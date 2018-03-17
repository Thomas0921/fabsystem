<?php
include '../framework/db.php';

if (isset($_POST['status']) && isset($_POST['rider_id']) && isset($_POST['rider_name'])){

  if($_POST['status'] == "add"){

    $rider_id = mysqli_real_escape_string($conn, $_POST['rider_id']);
    $rider_name = mysqli_real_escape_string($conn, $_POST['rider_name']);

    $sql = "SELECT * FROM riders WHERE rider_id= $rider_id";
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){

      echo "This rider's record has been created before";

    }else{

      $sql = "INSERT INTO riders(rider_name) VALUES ('$rider_name');";
      $result = mysqli_query($conn, $sql);

      echo "New rider's record created";

    }
  }
}

if (isset($_POST['status']) && isset($_POST['rider_id']) && isset($_POST['rider_name'])){

  if($_POST['status'] == "update"){

    $rider_id = mysqli_real_escape_string($conn, $_POST['rider_id']);
    $rider_name = mysqli_real_escape_string($conn, $_POST['rider_name']);

    $sql = "UPDATE riders
    SET rider_name = '$rider_name'
    WHERE rider_id = $rider_id";

    $result = mysqli_query($conn, $sql);

    echo "Rider's record updated";

  }
}

if (isset($_POST['status']) && isset($_POST['rider_id'])){

  if($_POST['status'] == "delete"){

    $rider_id = mysqli_real_escape_string($conn, $_POST['rider_id']);

    $sql = "DELETE FROM riders
    WHERE rider_id = $rider_id";

    $result = mysqli_query($conn, $sql);

    echo "Rider's record removed";

  }
}


 ?>
