<?php
include '../framework/db.php';

  $output = '';

  if(isset($_POST["id"])){
    $sql = "SELECT food_description, food_price FROM foods WHERE food_id=".$_POST['id'];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        $output .= "<li>";
        $output .= $row['food_description'];
        $output .= "</li>";
        $output .= "<li>";
        $output .= $row['food_price'];
        $output .= "</li>";
      }
      echo $output;
    }
   }

 ?>
