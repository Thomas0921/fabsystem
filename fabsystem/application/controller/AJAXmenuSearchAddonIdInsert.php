<?php

  include '../framework/db.php';

  if(isset($_POST["input"])){

    $input = mysqli_real_escape_string($conn, $_POST['input']);

    $sql = "SELECT * FROM food_add_on
    WHERE add_on_name = '$input'";

    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){

        echo $row['add_on_id'].",".$row['add_on_name'].",".$row['add_on_price'];

      }

    }
  }


 ?>
