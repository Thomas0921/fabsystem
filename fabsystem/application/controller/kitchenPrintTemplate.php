<?php

if(isset($_POST['order_id'])){

  $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

  $sql = "SELECT * FROM orders WHERE order_id= $order_id";
  $result = mysqli_query($conn, $sql);

  if($result ->num_rows > 0){
    while($row = $result ->fetch_assoc()){
      ?>

      <!DOCTYPE html>
      <html lang="en" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title>Print Reciept</title>
        </head>
        <body>
          $
        </body>
      </html>



      <?php
    }
  }
}

 ?>
