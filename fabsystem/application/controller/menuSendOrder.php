<?php

if (isset($_POST['send_to_kitchen'])){

  include '../framework/db.php';

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $discount = mysqli_real_escape_string($conn, $_POST['discount']);
  $delivery_cost = mysqli_real_escape_string($conn, $_POST['delivery_cost']);
  $total_cost = mysqli_real_escape_string($conn, $_POST['total_cost']);
  $order_content = mysqli_real_escape_string($conn, $_POST['order_content']);
}

 ?>
