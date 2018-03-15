<?php

  include '../framework/db.php';

  if(isset($_POST["id"])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sql = "SELECT * FROM foods WHERE food_id =".$_POST["id"];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        $_SESSION['food_name'] = $row['food_name'];
        $_SESSION['food_description'] = $row['food_description'];
        $_SESSION['food_price'] = $row['food_price'];
      }
      $sql = "SELECT category_id, subcategory_name FROM subcategories WHERE subcategory_id =".$row['subcategory_id'];
      $result = mysqli_query($conn, $sql);
      if($result ->num_rows > 0){
        while($row = $result ->fetch_assoc()){
          $_SESSION['subcategory_name'] = $row['subcategory_name'];
          $_SESSION['category_id'] = $row['category_id'];
        }
      }
    }
  }


 ?>
