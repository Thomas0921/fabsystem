<?php
include '../framework/db.php';

if (isset($_POST['cat_name'])){

  $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

  $sql = "INSERT INTO food_categories(category_id, category_name)
  VALUES (NULL, '$datalist_cat')";

  $result = mysqli_query($conn, $sql);
}

if (isset($_POST['edit']) && isset($_POST['cat_id']) && isset($_POST['cat_name'])){

  $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
  $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

  $sql = "UPDATE food_categories
  SET category_name = '".$cat_name."'
  WHERE category_id ='".$cat_id."'
  ";

  $result = mysqli_query($conn, $sql);
}

if (isset($_POST['cat_id'])){

  $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);

  $sql = "DELETE FROM food_categories
  WHERE category_id = '$cat_id'";

  $result = mysqli_query($conn, $sql);
}


 ?>
