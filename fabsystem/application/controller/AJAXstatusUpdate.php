<?php
 include '../framework/db.php';

if(isset($_POST['order_id'])){

  $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
  $sql  = "UPDATE orders SET status_id = 2 WHERE order_id = $order_id";
  $result = mysqli_query($conn, $sql);

}
 ?>
