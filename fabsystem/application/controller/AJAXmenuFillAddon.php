<?php

  include '../framework/db.php';

  if(isset($_POST["add_on_id"])){

    $sql = "SELECT * FROM food_add_on WHERE add_on_id =".$_POST["add_on_id"];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
         echo $row['add_on_name'].",".$row['add_on_description'].",".$row['add_on_price'];
      }
    }
  }


 ?>
