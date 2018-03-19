<?php
include '../framework/db.php';

if (isset($_POST['status']) && isset($_POST['cat_id']) && isset($_POST['subcat_id']) && isset($_POST['subcat_name'])){

  if($_POST['status'] == "add"){

    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $subcat_id = mysqli_real_escape_string($conn, $_POST['subcat_id']);
    $subcat_name = mysqli_real_escape_string($conn, $_POST['subcat_name']);

    $sql = "SELECT * FROM food_subcategories WHERE subcategory_id= $subcat_id";
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){

      echo "Subcategory has been created before";

    }else {

        $sql = "INSERT INTO food_subcategories(subcategory_id, subcategory_name, category_id)
        VALUES (NULL, '$subcat_name', '$cat_id');";

        $result = mysqli_query($conn, $sql);

        echo "New subcategory created";
      }
  }
}

if (isset($_POST['status']) && isset($_POST['subcat_id'])){

  if($_POST['status'] == "delete"){

    $subcat_id = mysqli_real_escape_string($conn, $_POST['subcat_id']);

    $sql = "SELECT * FROM foods WHERE subcategory_id= '.$subcat_id.'";
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      echo "Please clear all foods record to remove this subcategory";
    }else {
      $sql = "DELETE FROM food_subcategories
      WHERE subcategory_id = '$subcat_id'";

      $result = mysqli_query($conn, $sql);

      echo "Subcategory removed";
    }
  }
}
