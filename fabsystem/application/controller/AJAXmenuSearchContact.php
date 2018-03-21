<?php

  include '../framework/db.php';

  if(isset($_POST["input"])){


    $input = mysqli_real_escape_string($conn, $_POST['input']);

    $sql = "SELECT * FROM memberships
    WHERE membership_contact LIKE '%".$input."%' AND membership_id !=0 LIMIT 5";

    $result = mysqli_query($conn, $sql);

    $output = "";

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){

        $output = '<option value="'.$row['membership_contact'].'"></option>';

        echo $output;
      }

    }
  }


 ?>
