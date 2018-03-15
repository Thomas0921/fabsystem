<?php

  include '../framework/db.php';

  if(isset($_POST["condition_id"])){

    $sql = "SELECT * FROM food_condition WHERE condition_id =".$_POST["condition_id"];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
         echo $row['condition_name'].",".$row['condition_description'].",".$row['condition_price'];
      }
    }
  }


 ?>
