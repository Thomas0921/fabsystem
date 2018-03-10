<?php

  include '../framework/db.php';
  session_start();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu Page</title>
    <link rel="stylesheet" href="../../public/css/menu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="order-box" style="background-color: rgb(255, 121, 121)">
      <h1>Food Ordered</h1>
      <div>
        <ul class="show-cart">

        </ul>
      </div>
      <button type="button" id="clear_cart">Clear Cart</button>
      <button type="button" id="send_to_kitchent">Send To Kitchen</button>
    </div>
    <div class="food-box" style="background-color: rgb(237, 236, 106);">
      <h1>Food Menu</h1>
      <div class="wrapper">
        <div class="tabs">
          <?php
            $sql = "SELECT * FROM food_categories";
            $result = mysqli_query($conn, $sql);

            if($result ->num_rows > 0){
              while($row = $result ->fetch_assoc()){
                echo '<a class="click-cat" href="#" category_id='.$row['category_id'].'>'.$row['category_name'].'</a>';
                echo ' ';
              }
            }
           ?>
        </div>
        <div class="sub-tabs">

        </div>
        <div class="content">

        </div>
      </div>
    </div>

    <div class="description-box" style="background-color: rgb(122, 180, 238);">
      <h1>Description</h1>
      <ul class="show-description">

      </ul>
    </div>
    <div class="customer-box" style="background-color: rgb(125, 213, 156);">
      <h1>Customer's Detail</h1>
      <form class="customer-form" action="index.html" method="post">
        <input type="text" name="name" value="" placeholder="Name">
        <input type="text" name="contact" value="" placeholder="Contact">
        <input type="text" name="address" value="" placeholder="Address">
        <input type="text" name="discount" value="" placeholder="Discount">
        <input type="text" name="delivery_cost" value="" placeholder="Delivery Cost">
        <input type="text" name="receipt_no" value="" placeholder="Receipt No.">
      </form>
      <h2>Total: RM<span id="total-cart"></span></h2>
    </div>

  </body>
  <script src="../../public/js/menu.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
