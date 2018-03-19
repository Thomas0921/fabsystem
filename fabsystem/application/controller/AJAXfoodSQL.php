<?php
include '../framework/db.php';

if (isset($_POST['cat_id']) && isset($_POST['subcat_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){

  $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
  $subcat_id = mysqli_real_escape_string($conn, $_POST['subcat_id']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);

  $sql = "INSERT INTO foods(food_id, food_name, food_description, food_price, subcategory_id)
  VALUES (NULL, '$name', '$description', '$price', '$subcat_id');";

  $result = mysqli_query($conn, $sql);

  echo "New food added";
}

if (isset($_POST['update_food_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){

    $update_food_id = mysqli_real_escape_string($conn, $_POST['update_food_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

     $sql = "UPDATE foods
     SET food_name = '".$name."',
     food_description = '".$description."',
     food_price = '".$price."'
     WHERE food_id ='".$update_food_id."'
     ";

    $result = mysqli_query($conn, $sql);

    echo "Food's detail updated";
}

if (isset($_POST['delete_food_id'])){

  $delete_food_id = mysqli_real_escape_string($conn, $_POST['delete_food_id']);

  $sql = "DELETE FROM foods
  WHERE food_id ='$delete_food_id'
  ";

  $result = mysqli_query($conn, $sql);

  echo "Food deleted";
}


 ?>
