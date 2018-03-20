<?php
include '../framework/db.php';

if (isset($_POST['add_addon_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){

  $add_addon_id = mysqli_real_escape_string($conn, $_POST['add_addon_id']);
  $addon_name = mysqli_real_escape_string($conn, $_POST['name']);
  $addon_description = mysqli_real_escape_string($conn, $_POST['description']);
  $addon_price = mysqli_real_escape_string($conn, $_POST['price']);

  $sql = "INSERT INTO food_add_on(add_on_id, add_on_name, add_on_description, add_on_price, category_id)
  VALUES (NULL, '$addon_name', '$addon_description', '$addon_price', '$add_addon_id');";

  $result = mysqli_query($conn, $sql);

  echo "New add on added";
}

if (isset($_POST['update_addon_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){

    $update_addon_id = mysqli_real_escape_string($conn, $_POST['update_addon_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

     $sql = "UPDATE food_add_on
     SET add_on_name = '".$name."',
     add_on_description = '".$description."',
     add_on_price = '".$price."'
     WHERE add_on_id ='".$update_addon_id."'
     ";

    $result = mysqli_query($conn, $sql);

    echo "Add on's detail updated";
}

if (isset($_POST['delete_addon_id'])){

  $delete_addon_id = mysqli_real_escape_string($conn, $_POST['delete_addon_id']);

  $sql = "DELETE FROM food_add_on
  WHERE add_on_id ='$delete_addon_id'
  ";

  $result = mysqli_query($conn, $sql);

  echo "Add on deleted";
}


 ?>
