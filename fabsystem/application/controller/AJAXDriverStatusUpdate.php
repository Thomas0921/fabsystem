<?php
 include '../framework/db.php';

if(isset($_POST['status']) && isset($_POST['order_id']) && isset($_POST['rider_id'])){

  if($_POST['status'] == "delivering"){

      $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
      $rider_id = mysqli_real_escape_string($conn, $_POST['rider_id']);

      $sql  = "UPDATE orders
      SET status_id = 3 ,
      delivery_time = NOW(),
      rider_id = $rider_id
      WHERE order_id = $order_id";

      $result = mysqli_query($conn, $sql);

      echo "Record updated to 3";

  }
}

if(isset($_POST['status']) &&  isset($_POST['order_id'])){

  if($_POST['status'] == "completed"){

        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

        $sql  = "UPDATE orders
        SET status_id = 4 ,
        closed_time = NOW()
        WHERE order_id = $order_id";

        $result = mysqli_query($conn, $sql);

        echo "Record updated to 4";

      }
}
 ?>
