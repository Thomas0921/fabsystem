<?php
include '../framework/db.php';

  $output = '';

  if(isset($_POST["id"])){
    $sql = "SELECT condition_description, condition_price FROM food_condition WHERE condition_id=".$_POST['id'];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        $output .= "<li class='description-content'>";
        $output .= $row['condition_description'];
        $output .= "</li>";
        $output .= "<li class='price-title'>";
        $output .= "Price:";
        $output .= "</li>";
        $output .= "<li class='price-content'>";
        $output .= $row['condition_price'];
        $output .= "</li>";
      }
      echo $output;
    }
   }

 ?>
