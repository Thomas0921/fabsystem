<?php
include '../framework/db.php';

if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['contact'])){

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);

  $sql = "INSERT INTO memberships(membership_id, membership_name, membership_address, membership_contact)
  VALUES (NULL, '$name', '$address', '$contact');";

  $result = mysqli_query($conn, $sql);

  echo "New membership added";
}

if (isset($_POST['update_membership_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){

    $update_membership_id = mysqli_real_escape_string($conn, $_POST['update_membership_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

     $sql = "UPDATE memberships
     SET membership_name = '".$name."',
     membership_address = '".$address."',
     membership_contact = '".$contact."'
     WHERE membership_id ='".$update_membership_id."'
     ";

    $result = mysqli_query($conn, $sql);

    echo "Membership's detail updated";

}

if (isset($_POST['delete_membership_id'])){

  $delete_membership_id = mysqli_real_escape_string($conn, $_POST['delete_membership_id']);

  $sql = "DELETE FROM memberships
  WHERE membership_id ='$delete_membership_id'
  ";

  $result = mysqli_query($conn, $sql);

  echo "Membership deleted";
}


 ?>
