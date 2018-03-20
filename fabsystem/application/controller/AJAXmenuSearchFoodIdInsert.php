<?php

  include '../framework/db.php';

  if(isset($_POST["input"])){

    $input = mysqli_real_escape_string($conn, $_POST['input']);

    $sql = "SELECT * FROM foods JOIN food_subcategories
    ON foods.subcategory_id = food_subcategories.subcategory_id
    WHERE food_code = '$input'";

    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){

        echo $row['food_id'].",".$row['food_name'].",".$row['food_price'].",".$row['category_id'];

      }

    }
  }


 ?>
