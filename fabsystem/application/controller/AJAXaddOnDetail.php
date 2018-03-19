<?php
include '../framework/db.php';

  $output = '';

  if(isset($_POST["id"])){
    $sql = "SELECT add_on_description, add_on_price FROM food_add_on WHERE add_on_id=".$_POST['id'];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        $output .= "<li class='description-content'>";
        $output .= $row['add_on_description'];
        $output .= "</li>";
        $output .= "<li>";
        $output .= "Price:";
        $output .= "</li>";
        $output .= "<li class='price-content'>";
        $output .= $row['add_on_price'];
        $output .= "</li>";
      }
      echo $output;
    }
   }

 ?>
