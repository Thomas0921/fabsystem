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
      <div class="">
        <button class="edit" type="button" name="button">Pencil</button>
        <div class="edit-box" style="display: none;">
          <button class="btn-add" type="button" name="button">Add</button>
          <button class="btn-edit" type="button" name="button">Edit</button>
          <button class="" type="button" name="button">Delete</button>
        </div>
        <div class="popup-bg">
          <div class="popup-main">
            <div class="close-popup" title="Close this popup">
              <p>X</p>
            </div>
            <div class="popup-content">
              <h2>Add food to your menu</h2>
              <form class="form-add-food" action="" method="post">
                <input list="datalist-cat" placeholder="Category Name" id="datalist-cat-id">
                <datalist id="datalist-cat">
                  <?php
                    $sql = "SELECT * FROM food_categories";
                    $result = mysqli_query($conn, $sql);

                    if($result ->num_rows > 0){
                      while($row = $result ->fetch_assoc()){
                        echo '<option value='.$row['category_name'].' data-id="'.$row['category_id'].'"></option>';
                        echo ' ';
                      }
                    }
                   ?>
                </datalist>
                <button type="button" name="button">+</button>
                <button type="button" name="button">-</button><br>
                <input list="datalist-subcat" placeholder="Subcategory Name">
                <datalist id="datalist-subcat" class="ajax-subcat">

                </datalist>
                <button type="button" name="button">+</button>
                <button type="button" name="button">-</button><br>
                <input type="text" name="" value="" placeholder="Food Name"><br>
                <textarea name="name" rows="5" cols="26" placeholder="Description"></textarea><br>
                <input type="number" name="" value="" min="0" step="0.01" placeholder="Price"><br>
                <button type="submit" name="btn-add-food">Add</button><br>
              </form>
            </div>
          </div>
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
        <input type="text" name="name" value="" placeholder="Name"><br>
        <input type="text" name="contact" value="" placeholder="Contact"><br>
        <input type="text" name="address" value="" placeholder="Address"><br>
        <input type="text" name="discount" value="" placeholder="Discount">
        <input type="text" name="delivery_cost" value="" placeholder="Delivery Cost">
        <input type="text" name="receipt_no" value="" placeholder="Receipt No.">
        <div class="checkbox-condition">
          <?php
            $sql = "SELECT * FROM food_condition";
            $result = mysqli_query($conn, $sql);

            if($result ->num_rows > 0){
              while($row = $result ->fetch_assoc()){
                echo '<input type="checkbox" condition-price="'.$row['condition_price'].'">'.$row['condition_name'];
                echo ' ';
              }
            }
           ?>
        </div>
        <input id="checkbox_others_cost" type="checkbox" condition-price=""> Others
        <input id="others_cost" type="number" min="0" placeholder="Others cost" disabled>
      </form>
      <h2>Total: RM<span id="total-cart"></span></h2>
    </div>

  </body>
  <script src="../../public/js/menu.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
