<?php
  include '../framework/db.php';

if (isset($_POST['send_to_kitchen'])){

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $discount = mysqli_real_escape_string($conn, $_POST['discount']);
  $delivery_cost = mysqli_real_escape_string($conn, $_POST['delivery_cost']);
  $bill_no = mysqli_real_escape_string($conn, $_POST['bill_no']);
  $total_cost = mysqli_real_escape_string($conn, $_POST['total_cost']);
  $order_content = mysqli_real_escape_string($conn, $_POST['order_content']);

  $sql = "INSERT INTO orders (order_id, customer_name, customer_contact, customer_address, order_content,
    order_time, delivery_time, closed_time, order_gross, order_discount, order_delivery, bill_no, rider_id, status_id)
    VALUES ('NULL', '$name','$contact', '$address', '$order_content',
      NOW(), '0000-00-00 00:00:00', '0000-00-00 00:00:00', '$total_cost', '$discount', '$delivery_cost', '$bill_no', '1', '1');";

  $result = mysqli_query($conn, $sql);
  
  header("Location: ../view/menu.php?insert=success");
  exit();
}


 ?>
