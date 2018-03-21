<?php

  include '../framework/db.php';

  if(isset($_POST["input"])){

    $input = mysqli_real_escape_string($conn, $_POST['input']);

    $sql = "SELECT * FROM memberships
    WHERE membership_contact =$input";

    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){

        echo $row['membership_name'].",".$row['membership_contact'].",".$row['membership_id'];

      }

    }
  }


 ?>
