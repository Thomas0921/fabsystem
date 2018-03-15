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
    order_time, delivery_time, order_gross, order_discount, order_delivery, bill_no, rider_id, status_id)
    VALUES (NULL, '$name','$contact', '$address', '$order_content', NOW(), '0000-00-00 00:00:00',
    '$total_cost', '$discount', '$delivery_cost', '$bill_no', '1', '1');"

  $result = mysqli_query($conn, $sql);

}

if (isset($_POST['add_category'])){

    $datalist_cat = mysqli_real_escape_string($conn, $_POST['datalist_cat']);

    $sql = "INSERT INTO categories(category_id, category_name)
    VALUES (NULL, '$datalist_cat')";

    $result = mysqli_query($conn, $sql);
}

if (isset($_POST['minus_category'])){

  $datalist_cat = mysqli_real_escape_string($conn, $_POST['datalist_cat']);

  $sql = "DELETE INTO categories
  WHERE category_name = '$datalist_cat'";

  $result = mysqli_query($conn, $sql);

}

if (isset($_POST['btn-add-addon'])){

    // datalist havent know which category id inserted
    $datalist_cat = mysqli_real_escape_string($conn, $_POST['datalist_cat']);
    $addon_name = mysqli_real_escape_string($conn, $_POST['addon_name']);
    $addon_description = mysqli_real_escape_string($conn, $_POST['addon_description']);
    $addon_price = mysqli_real_escape_string($conn, $_POST['addon_price']);

    $sql = "INSERT INTO food_add_on(addon_id, addon_name, addon_description, addon_price, category_id)
    VALUES (NULL, '$addon_name', '$addon_description', '$addon_price', '$datalist_cat' )";

    $result = mysqli_query($conn, $sql);
}

 ?>
