<?php
include '../framework/db.php';

if (isset($_POST['btn-add-condition'])){

  $condition_name = mysqli_real_escape_string($conn, $_POST['condition_name']);
  $condition_description = mysqli_real_escape_string($conn, $_POST['condition_description']);
  $condition_price = mysqli_real_escape_string($conn, $_POST['condition_price']);

  $sql = "INSERT INTO food_condition(condition_id, condition_name, condition_description, condition_price)
  VALUES (NULL, '$condition_name', '$condition_description', '$condition_price');";

  $result = mysqli_query($conn, $sql);
  header("Location: ../view/menu.php?newcondition=added");
  exit();
}

if (isset($_POST['update_condition_id'])){

    $condition_id = mysqli_real_escape_string($conn, $_POST['update_condition_id']);
    $condition_name = mysqli_real_escape_string($conn, $_POST['condition_name']);
    $condition_description = mysqli_real_escape_string($conn, $_POST['condition_description']);
    $condition_price = mysqli_real_escape_string($conn, $_POST['condition_price']);

    $sql = "UPDATE food_condition
    SET condition_name = '".$condition_name."',
    condition_description = '".$condition_description."',
    condition_price = '".$condition_price."'
    WHERE condition_id ='".$condition_id."'
    ";

    $result = mysqli_query($conn, $sql);
    header("Location: ../view/menu.php?condition=updated");
    exit();
}

if (isset($_POST['delete_condition_id'])){

  $condition_id = mysqli_real_escape_string($conn, $_POST['delete_condition_id']);

  $sql = "DELETE FROM food_condition
  WHERE condition_id ='$condition_id'
  ";

  $result = mysqli_query($conn, $sql);
  header("Location: ../view/menu.php?condition=deleted");
  exit();
}


 ?>
