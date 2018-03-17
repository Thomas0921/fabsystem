<?php
include '../framework/db.php';
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Driver</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/driver.css">


  </head>
  <body>
    <h2 style="text-align:center">Driver View</h2>
    <?php

    $query = "SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id WHERE status_id = 2 OR status_id = 3 order by order_id ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
     ?>

    <div class="columns" id="col_<?php echo $row['order_id'];?>" data-id="<?php echo $row['order_id'];?>" >
      <ul class="price">
        <li class="header"><?php echo $row['order_id'];?></li>
        <li class="content">
          <div class="qr" data-id ="<?php echo $row['order_id'];?>" ><?php echo $row['customer_address']; ?></div>
        </li>
        <p id="value" data-id="<?php echo $row['order_id']; ?>"><?php echo $row['status_id']; ?></p>
        <li><?php echo $row['rider_name']; ?></li>
        <li><button class="btn_delivery" data-id="<?php echo $row['order_id']; ?>">Deliver</button></li>
        <li><button class="btn_complete" data-id="<?php echo $row['order_id']; ?>">Completed</button></li>
      </ul>
    </div>
  <?php
  }
   ?>
  </body>
</html>

<script src ="../../public/js/driver.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
