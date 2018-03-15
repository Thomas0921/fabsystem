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
      <button type="button" id="clear_addon_cart">Clear Add on Cart</button>
      <button type="submit" name="send_to_kitchen" id="send_to_kitchen" form="customer-form-id" >Send To Kitchen</button>
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
                echo '<a class="click-cat"
                href="menu.php?category_id='.$row['category_id'].'"
                >'.$row['category_name'].'</a>';
                echo ' ';
              }
            }
           ?>
        </div>
        <div class="sub-tabs">
          <?php
          $output = '';

          if(isset($_GET["category_id"])){
            $sql = "SELECT food_subcategories.subcategory_id,
            food_subcategories.subcategory_name,
            food_categories.category_id,
            food_categories.category_name
            FROM food_subcategories JOIN food_categories
            ON food_subcategories.category_id = food_categories.category_id
            WHERE food_subcategories.category_id=".$_GET["category_id"];

            $result = mysqli_query($conn, $sql);

            if($result ->num_rows > 0){
              while($row = $result ->fetch_assoc()){
                $output .= '<a class="click-subcat"
                href="menu.php?subcategory_id='.$row['subcategory_id'].'&category_id='.$row['category_id'].'"
                >'.$row['subcategory_name'].'</a>';
                $output .=  ' ';
              }
              echo $output;
            }
           }
           ?>
        </div>
        <div class="content">
          <?php
          $output = '';

          if(isset($_GET["subcategory_id"])){
            $sql = "SELECT foods.food_id,
            foods.food_name,
            foods.food_description,
            foods.food_price,
            food_subcategories.subcategory_id,
            food_subcategories.subcategory_name
            FROM foods JOIN food_subcategories ON
            foods.subcategory_id = food_subcategories.subcategory_id
            WHERE foods.subcategory_id=".$_GET['subcategory_id'];

            $result = mysqli_query($conn, $sql);

            if($result ->num_rows > 0){
              while($row = $result ->fetch_assoc()){
                $output .= '<a class="add-to-cart hover-detail"
                href="#" data-id="'.$row['food_id'].'"
                data-name="'.$row['food_name'].'"
                data-price="'.$row['food_price'].'"
                >'.$row['food_name'].'</a>';
                $output .=  ' ';
              }
              echo $output;
            }
           }
           ?>
        </div>
        <div class="addon-tabs">
          <?php
          $output = '';

          if(isset($_GET["category_id"])){
            $sql = "SELECT food_add_on.add_on_id,
            food_add_on.add_on_name,
            food_add_on.add_on_price,
            food_add_on.category_id
            FROM food_add_on JOIN food_categories ON
            food_add_on.category_id = food_categories.category_id
            WHERE food_add_on.category_id=".$_GET["category_id"];

            $result = mysqli_query($conn, $sql);

            if($result ->num_rows > 0){
              while($row = $result ->fetch_assoc()){
                $output .= '<a class="addon-to-cart hover-addon-detail" href="#"
                addon-id='.$row['add_on_id'].'
                addon-name="'.$row['add_on_name'].'"
                addon-price='.$row['add_on_price'].'
                category-id = '.$row['category_id'].'
                >'.$row['add_on_name'].'</a>';
                $output .=  ' ';
              }
              echo $output;
            }
           }
           ?>
        </div>
      </div>
      <div class="">
        <button class="btn-edit" type="button" name="button">Pencil</button>
        <div class="popup-bg">
          <div class="popup-main">
            <div class="close-popup" title="Close this popup">
              <p>X</p>
            </div>
            <div class="popup-content">

              <div class="edit-box">
                <button class="btn-new-food" type="button" name="button">New Food</button>
                <button class="btn-new-addon" type="button" name="button">New Add On</button>
              </div>

              <div class="add_food_div" style="">
                <div class="search_containter">
                  <h5>Search the food you want to change</h5>
                  <input class="searchFood" list="datalist_search" type="datalist" name="" value="">
                  <datalist class="datalist_searchFood" id="datalist_search">

                  </datalist>
                </div>
                <form class="form-add-food" action="../controller/menuSendOrder.php" method="post">
                  <input list="datalist-cat" name ="datalist_cat" placeholder="Category Name" id="datalist-cat-id">
                  <datalist class="datalist_searchFood" id="datalist-cat">
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
                  <button type="submit" name="add_category" onclick="return  confirm('do you want to add? Y/N')">+</button>
                  <button type="submit" name="minus_category" onclick="return  confirm('do you want to delete? Y/N')">-</button><br>
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

              <div class="add_addon_div" hidden>
                <div class="search_containter">
                  <h5>Search the add on you want to change</h5>
                  <input class="searchAddon" list="datalist_search_addon" type="datalist" name="" value="">
                  <datalist class="datalist_searchAddon" id="datalist_search_addon">
                    <?php
                    $sql = "SELECT * FROM food_add_on";
                    $result = mysqli_query($conn, $sql);

                    if($result ->num_rows > 0){
                      while($row = $result ->fetch_assoc()){
                        echo '<option value="'.$row['add_on_name'].'" data-id="'.$row['add_on_id'].'"></option>';
                        echo ' ';
                      }
                    }
                     ?>
                  </datalist>
                  <h6 class="notice"></h6>
                </div>
                <form class="form-add-addon" action="../controller/menuSendOrder.php" method="post" >
                  <input list="datalist-cat" name ="datalist_cat" placeholder="Category Name" id="datalist-cat-id">
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
                  <input type="text" name="addon_name" value="" placeholder="Addon Name"><br>
                  <textarea name="addon_description" rows="5" cols="26" placeholder="Description"></textarea><br>
                  <input type="number" name="addon_price" value="" min="0" step="0.01" placeholder="Price"><br>
                  <button type="submit" name="btn-add-addon">Add</button><br>
                </form>
              </div>
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
      <form id="customer-form-id" class="customer-form" action="../controller/menuSendOrder.php" method="post">
        <input type="text" name="name" value="" placeholder="Name" required><br>
        <input type="text" name="contact" value="" placeholder="Contact" required><br>
        <input type="text" name="address" value="" placeholder="Address" required><br>
        <div class="total-minus">
          <input id="discount" type="number" old-value="0" name="discount" placeholder="Discount" required>
        </div>
        <div class="total-add">
          <input id="delivery_cost" type="number" old-value="0" name="delivery_cost" placeholder="Delivery Cost" required>
        </div>
        <input type="text" name="bill_no" value="" placeholder="bill_no" required><br>
        <div class="checkbox-condition">
          <?php
            $sql = "SELECT * FROM food_condition";
            $result = mysqli_query($conn, $sql);

            if($result ->num_rows > 0){
              while($row = $result ->fetch_assoc()){
                echo '<input class="hover-condition" type="checkbox" data-id="'.$row['condition_id'].'" condition-price="'.$row['condition_price'].'">'.$row['condition_name'];
                echo ' ';
              }
            }
           ?>
        </div>
        <div class="total-add">
          <input id="checkbox_others_cost" type="checkbox" condition-price=""> Others
          <input id="others_cost" type="number" min="0" old-value="0" placeholder="Cost value" disabled>
          <input id="hidden_order" type="text" name="order_content" required>
        </div>
        <h2>Total: RM<input type="text" id="total-cart" name="total_cost" ></h2>
      </form>

      <button class="btn-edit-cus" type="button" name="button">Pencil</button>
      <div class="popup-bg-cus">
        <div class="popup-main-cus">
          <div class="close-popup-cus" title="Close this popup">
            <p>X</p>
          </div>
          <div class="popup-content-cus">
            <div class="edit-box-cus">
              <button class="btn-add-cus" type="button" name="button">Add</button>
              <button class="btn-edit-cus" type="button" name="button">Edit</button>
              <button class="btn-delete-cus" type="button" name="button">Delete</button>
            </div>
            <h2>Condition to your delivery</h2>
            <form class="form-add-food-cus" action="" method="post">
              <input list="datalist-con" name="" placeholder="Condition Name" id="datalist-con-id">
              <datalist id="datalist-con">
                <?php
                  $sql = "SELECT * FROM food_condition";
                  $result = mysqli_query($conn, $sql);

                  if($result ->num_rows > 0){
                    while($row = $result ->fetch_assoc()){
                      echo '<option value='.$row['condition_name'].' data-id="'.$row['condition_id'].'"></option>';
                      echo ' ';
                    }
                  }
                 ?>
              </datalist><br>
              <input type="text" name="" value="" placeholder="Condition Name"><br>
              <textarea name="name" rows="5" cols="26" placeholder="Description"></textarea><br>
              <input type="number" name="" value="" min="0" step="0.01" placeholder="Price"><br>
              <button type="submit" name="btn-add-food">Add</button><br>
            </form>
        </div>
      </div>
    </div>

  </body>
  <script src="../../public/js/menu.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
