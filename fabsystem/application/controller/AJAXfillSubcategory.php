<?php

  include '../framework/db.php';

  if(isset($_POST["cat_id"])){

    $output = "";
    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);

    $sql = "SELECT * FROM food_subcategories WHERE category_id LIKE '%".$cat_id."%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        $output .= '<option value="'.$row['subcategory_name'].'" data-id="'.$row['subcategory_id'].'"></option>';
      }
    }
    echo $output;
  }


 ?>
