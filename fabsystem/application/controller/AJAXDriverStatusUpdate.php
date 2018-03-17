<?php
 include '../framework/db.php';

if(isset($_POST['order_id'])){

  $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
  $sql  = "UPDATE orders SET status_id = 3 WHERE order_id = $order_id";
  $result = mysqli_query($conn, $sql);

}

if(isset($_POST['order_id'])){
  $data = "SELECT * FROM orders JOIN order_status ON orders.status_id = order_status.status_id";
  $result = mysqli_query($conn, $data);

  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['status_id'] == 3) {
      $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
      $sql  = "UPDATE orders SET status_id = 4 WHERE order_id = $order_id";
    }
    else {
      echo "FAILED UPDATE!!!";
    }
    }
  }
 ?>
