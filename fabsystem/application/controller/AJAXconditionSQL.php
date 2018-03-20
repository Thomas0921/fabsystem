<?php
include '../framework/db.php';

if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){

  $condition_name = mysqli_real_escape_string($conn, $_POST['name']);
  $condition_description = mysqli_real_escape_string($conn, $_POST['description']);
  $condition_price = mysqli_real_escape_string($conn, $_POST['price']);

  $sql = "INSERT INTO food_condition(condition_id, condition_name, condition_description, condition_price)
  VALUES (NULL, '$condition_name', '$condition_description', '$condition_price');";

  $result = mysqli_query($conn, $sql);

  echo "New condition added";
}

if (isset($_POST['update_condition_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){

    $condition_id = mysqli_real_escape_string($conn, $_POST['update_condition_id']);
    $condition_name = mysqli_real_escape_string($conn, $_POST['name']);
    $condition_description = mysqli_real_escape_string($conn, $_POST['description']);
    $condition_price = mysqli_real_escape_string($conn, $_POST['price']);

     $sql = "UPDATE food_condition
     SET condition_name = '".$condition_name."',
     condition_description = '".$condition_description."',
     condition_price = '".$condition_price."'
     WHERE condition_id ='".$condition_id."'
     ";

    $result = mysqli_query($conn, $sql);

    echo "Condition's detail updated";

}

if (isset($_POST['delete_condition_id'])){

  $condition_id = mysqli_real_escape_string($conn, $_POST['delete_condition_id']);

  $sql = "DELETE FROM food_condition
  WHERE condition_id ='$condition_id'
  ";

  $result = mysqli_query($conn, $sql);

  echo "Condition deleted";
}


 ?>
