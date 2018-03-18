<?php

  include '../framework/db.php';

  if(isset($_POST["name"])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $sql = "SELECT order_id, customer_name, orders.status_id, order_status.status_name
    FROM orders JOIN order_status ON orders.status_id= order_status.status_id
    WHERE customer_name LIKE '%".$name."%'
    AND orders.status_id!=5
    AND orders.status_id!=4
    LIMIT 5";

    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        echo '<option value="'.$row['customer_name'].' - '.$row['status_name'].'" data-id="'.$row['order_id'].'" status-id="'.$row['status_id'].'" status_name="'.$row['status_name'].'"></option>';
        echo ' ';
      }
    }
  }


 ?>
