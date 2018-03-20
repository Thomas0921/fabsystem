<?php

  include '../framework/db.php';

  if(isset($_POST["input"])){

    $input = mysqli_real_escape_string($conn, $_POST['input']);

    $sql = "SELECT * FROM orders
    WHERE customer_contact LIKE '%".$input."%'";

    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){

        echo $row['customer_name'].",".$row['customer_address'];

      }

    }
  }


 ?>
