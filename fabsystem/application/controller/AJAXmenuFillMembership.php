<?php

  include '../framework/db.php';

  if(isset($_POST["membership_id"])){

    $sql = "SELECT * FROM memberships WHERE membership_id =".$_POST["membership_id"];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
         echo $row['membership_name'].",".$row['membership_address'].",".$row['membership_contact'];
      }
    }
  }


 ?>
