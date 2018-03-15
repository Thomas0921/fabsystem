<?php

  include '../framework/db.php';

  if(isset($_POST["name"])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sql = "SELECT * FROM foods WHERE food_name LIKE '%".$name."%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        echo '<option value="'.$row['food_name'].'" data-id="'.$row['food_id'].'"></option>';
        echo ' ';
      }
    }
  }


 ?>
