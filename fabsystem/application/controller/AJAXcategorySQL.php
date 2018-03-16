<?php
include '../framework/db.php';

if (isset($_POST['status']) && isset($_POST['cat_id']) && isset($_POST['cat_name'])){

  if($_POST['status'] == "add"){

    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    $sql = "SELECT * FROM food_categories WHERE category_id= $cat_id";
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){

      echo "Main category has been created before";

    }else{

      $sql = "INSERT INTO food_categories(category_name) VALUES ('$cat_name');";
      $result = mysqli_query($conn, $sql);

      echo "New category created";

    }
  }
}

if (isset($_POST['status']) && isset($_POST['cat_id'])){

  if($_POST['status'] == "delete"){

    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);

    $sql = "SELECT * FROM food_subcategories WHERE category_id= $cat_id";
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      echo "Please clear all subcategories to remove this main category";
    }else {
      $sql = "DELETE FROM food_categories
      WHERE category_id = $cat_id";

      $result = mysqli_query($conn, $sql);

      echo "Main category removed";
    }
  }
}


 ?>
