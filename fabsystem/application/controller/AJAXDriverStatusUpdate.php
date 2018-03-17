<?php
 include '../framework/db.php';

if(isset($_POST['order_id'])){
  if($_POST['status'] == "ready"){

      $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
      $sql  = "UPDATE orders SET status_id = 3 WHERE order_id = $order_id";
      $result = mysqli_query($conn, $sql);

      echo "Record updated to 3";

  }
}

if(isset($_POST['order_id'])){
  if($_POST['status'] == "delivering"){

        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
        $sql  = "UPDATE orders SET status_id = 4 WHERE order_id = $order_id";
        $result = mysqli_query($conn, $sql);

        echo "Record updated to 4";

      }
}
 ?>
