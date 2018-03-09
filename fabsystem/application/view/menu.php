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
                echo '<a href="menu.php?category_id='.$row['category_id'].'">'.$row['category_name'].'</a>';
                echo ' ';
              }
            }
           ?>
        </div>
        <div class="sub-tabs">
          <?php
          if(isset($_GET['category_id'])){

            // Select all foods which belong to the selected category
            $sub_sql = "SELECT food_subcategories.subcategory_id, food_subcategories.subcategory_name, food_categories.category_id, food_categories.category_name FROM food_subcategories JOIN food_categories ON food_subcategories.category_id = food_categories.category_id WHERE food_subcategories.category_id=".$_GET['category_id'];
            $result = mysqli_query($conn, $sub_sql);

            if($result ->num_rows > 0){
              while($row = $result ->fetch_assoc()){
                echo '<a href="menu.php?category_id='.$row['category_id'].'&subcategory_id='.$row['subcategory_id'].'">'.$row['subcategory_name'].'</a>';
                echo ' ';
              }
            }
          }
           ?>
        </div>
        <div class="content">
          <?php
          if(isset($_GET['subcategory_id'])){
            // Select all foods which belong to the selected category
            $food_sql = "SELECT foods.food_id, foods.food_name, foods.food_description, foods.food_price, food_subcategories.subcategory_id, food_subcategories.subcategory_name FROM foods JOIN food_subcategories ON foods.subcategory_id = food_subcategories.subcategory_id WHERE foods.subcategory_id=".$_GET['subcategory_id'];
            $result = mysqli_query($conn, $food_sql);

            if($result ->num_rows > 0){
              echo '<ul>';
              while($row = $result ->fetch_assoc()){
                echo '<li>';
                echo '<a class="add-to-cart" href="#" data-id="'.$row['food_id'].'" data-name="'.$row['food_name'].'" data-price="'.$row['food_price'].'" >'.$row['food_name'].'</a>';
                echo '</li>';
              }
              echo '</ul>';
            }
          }
          ?>
        </div>
      </div>
    </div>

    <div class="description-box" style="background-color: rgb(122, 180, 238);">
      <h1>Description</h1>
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
