<?php

  include '../framework/db.php';

  if(isset($_POST["food_id"])){

    $sql = "SELECT * FROM foods WHERE food_id =".$_POST["food_id"];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
         echo $row['food_name'].",".$row['food_description'].",".$row['food_price'];
      }
    }
  }


 ?>
