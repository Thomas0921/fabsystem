<?php

  include '../framework/db.php';

  if(isset($_POST["name"])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $sql = "SELECT * FROM food_add_on
    WHERE add_on_code LIKE '%".$name."%'
    OR add_on_name LIKE '%".$name."%' LIMIT 5";

    $result = mysqli_query($conn, $sql);

    $output = "";

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){

        $output = '<option value="'.$row['add_on_code'].'-'.$row['add_on_name'].'-'.$row['category_id'].'"></option>';

        echo $output;
      }
    }
  }


 ?>
