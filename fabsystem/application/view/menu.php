<?php

  include '../framework/db.php';
  session_start();

  if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
  }
  else {
      // Makes it easier to read
      $first_name = $_SESSION['first_name'];
      $last_name = $_SESSION['last_name'];
      $email = $_SESSION['email'];
      $active = $_SESSION['active'];
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu Page</title>
    <link rel="stylesheet" href="../../public/css/menu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <a href="../../helper/loginsystem/logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
    <div class="container">
      <div class="left_content">
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

        <div class="cancelled-box" style="background-color: rgb(255, 111, 219)">
          <h1>Cancel Ongoing Order</h1>
          <div class="searchOrder_containter">

            <h5>Search the order you want to cancel</h5>
            <h6 class="notice"></h6>
            <input class="searchOrder" list="datalist_search_order" type="datalist" id="datalist-order-id" name="" value="">
            <datalist class="datalist_searchOrder" id="datalist_search_order">
              <!-- Will get the options by ajax -->
            </datalist>
            <button id="btn-cancel-order" type="button" name="button">Cancel</button>
          </div>

        </div>
      </div>
      <div class="right_content">
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

                  <div class="add_food_div">
                    <div class="search_containter">

                      <h5>Search the food you want to change</h5>
                      <h6 class="notice"></h6>
                      <input class="searchFood" list="datalist_search" type="datalist" name="" value="">
                      <datalist class="datalist_searchFood" id="datalist_search">
                        <!-- Will get the options by ajax -->
                      </datalist>
                    </div>

                    <form class="form-add-food" action="../controller/subcategorySQL.php" method="post">
                      <h6 class="form-notice-food"></h6>
                      <input list="datalist-cat" autocomplete="off" name ="datalist_cat" placeholder="Category Name" id="datalist-cat-id">
                      <datalist class="datalist_searchFood" id="datalist-cat">
                        <?php
                          $sql = "SELECT * FROM food_categories";
                          $result = mysqli_query($conn, $sql);

                          if($result ->num_rows > 0){
                            while($row = $result ->fetch_assoc()){
                              echo '<option value="'.$row['category_name'].'" data-id="'.$row['category_id'].'"></option>';
                            }
                          }
                         ?>
                      </datalist>
                      <button type="button" id="btn_add_category" name="add_subcategory">+</button>
                      <button type="button" id="btn_delete_category" name="minus_subcategory">-</button><br>
                      <input list="datalist-subcat" placeholder="Subcategory Name" id="datalist-subcat-id">
                      <datalist id="datalist-subcat" class="ajax-subcat">
                        <!-- will get from AJAXmenuSearchSubcategory.php -->
                      </datalist>
                      <button type="button" id="btn_add_subcategory" name="add_subcategory">+</button>
                      <button type="button" id="btn_delete_subcategory" name="minus_subcategory">-</button><br>
                      <input id="food_name" type="text" name="food_name" value="" placeholder="Food Name"><br>
                      <textarea id="food_description" name="food_description" rows="5" cols="26" placeholder="Description"></textarea><br>
                      <input id="food_price" type="number" name="food_price" value="" min="0" step="0.01" placeholder="Price"><br>
                      <button type="button" id="btn-add-food" name="btn-add-food">Add</button>
                      <button style="display:none;" type="button" id="btn-update-food" name="btn-update-food">Update</button>
                      <button style="display:none;" type="button" id="btn-delete-food" name="btn-delete-food">Delete</button><br>
                    </form>
                  </div>

                  <div class="add_addon_div" hidden>
                    <div class="search_containter">

                      <h5>Search the add on you want to change</h5>
                      <h6 class="notice"></h6>
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
                    </div>

                    <form class="form-add-addon" action="../controller/AJAXaddonSQL.php" method="post" >
                      <h6 class="form-notice-addon"></h6>
                      <input list="datalist-cat" name ="datalist_cat" placeholder="Category Name" id="datalist-addon-cat-id">
                      <datalist id="datalist-cat">
                        <!-- this datalist will use the list from new food datalist -->
                      </datalist>
                      <input id="addon_name" type="text" name="addon_name" value="" placeholder="Addon Name"><br>
                      <textarea id="addon_description" name="addon_description" rows="5" cols="26" placeholder="Description"></textarea><br>
                      <input id="addon_price" type="number" name="addon_price" value="" min="0" step="0.01" placeholder="Price"><br>
                      <button type="button" id="btn-add-addon" name="btn-add-addon">Add</button>
                      <button style="display:none;" type="button" id="btn-update-addon" name="btn-update-addon">Update</button>
                      <button style="display:none;" type="button" id="btn-delete-addon" name="btn-delete-addon">Delete</button><br>
                    </form>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="right_lower_div">

        </div>
        <div class="description-box" style="background-color: rgb(122, 180, 238);">
          <h1>Description</h1>
          <ul class="show-description">

          </ul>
        </div>
        <div class="customer-box" style="background-color: rgb(125, 213, 156);">
          <h1>Customer's Detail</h1>
          <form id="customer-form-id" class="customer-form" action="../controller/menuSendOrder.php" method="post">
            <input type="text" id="input_name" name="name" value="" placeholder="Name" required><br>
            <input type="text" id="input_contact" name="contact" value="" placeholder="Contact" required><br>
            <input type="text" id="input_address" name="address" value="" placeholder="Address" required><br>
            <div class="total-minus">
              <input id="discount" type="number" old-value="0" name="discount" placeholder="Discount" required>
            </div>
            <div class="total-add">
              <input id="delivery_cost" type="number" old-value="0" name="delivery_cost" placeholder="Delivery Cost" required>
            </div>
            <input type="text" id="bill_no" name="bill_no" value="" placeholder="Bill Number" required><br>
            <div class="checkbox-condition">
              <?php
                $sql = "SELECT * FROM food_condition";
                $result = mysqli_query($conn, $sql);

                if($result ->num_rows > 0){
                  while($row = $result ->fetch_assoc()){
                    echo '<input class="hover-condition" type="checkbox" data-id="'.$row['condition_id'].'" condition-price="'.$row['condition_price'].'">'.$row['condition_name'];
                  }
                }
               ?>
            </div>
            <div class="total-add">
              <input id="checkbox_others_cost" type="checkbox" condition-price=""> Others
              <input id="others_cost" type="number" min="0" old-value="0" placeholder="Cost value" disabled>
              <input id="hidden_order" type="hidden" name="order_content" required>
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
                <div class="add_condition_div" style="">
                  <div class="search_containter">

                    <h5>Search the condition you want to change</h5>
                    <h6 class="notice"></h6>
                    <input class="searchCondition" list="datalist_search_condition" type="datalist" name="" value="">
                    <datalist class="datalist_searchCondition" id="datalist_search_condition">
                      <?php
                        $sql = "SELECT * FROM food_condition";
                        $result = mysqli_query($conn, $sql);

                        if($result ->num_rows > 0){
                          while($row = $result ->fetch_assoc()){
                            echo '<option value="'.$row['condition_name'].'" data-id="'.$row['condition_id'].'"></option>';
                          }
                        }
                       ?>
                    </datalist>
                  </div>

                  <form class="form-add-condition" action="../controller/AJAXconditionSQL.php" method="post">
                    <h6 class="form-notice-condition"></h6>
                    <input id="condition_name" type="text" name="condition_name" value="" placeholder="Condition Name"><br>
                    <textarea id="condition_description" name="condition_description" rows="5" cols="26" placeholder="Description"></textarea><br>
                    <input id="condition_price" type="number" name="condition_price" value="" min="0" step="0.01" placeholder="Price"><br>
                    <button type="button" class="btn-add-condition" name="btn-add-condition">Add</button>
                    <button style="display:none;" type="button" class="btn-update-condition" name="btn-update-condition">Update</button>
                    <button style="display:none;" type="button" class="btn-delete-condition" name="btn-delete-condition">Delete</button><br>
                  </form>
                </div><!-- add_condition_div -->
            </div><!-- popup-content-cus -->
          </div> <!-- popup-main-cus -->
        </div><!-- popup-bg-cus -->
      </div><!-- right_content -->
    </div> <!-- container -->
    <!--floating button -->
    <a href="#" class="float" id="menu-share">
   <i class="fa fa-navicon my-float" ><img src="../../public/image/home.png" width="5px" alt=""> </i>
   </a>
   <ul>
   <li><a href="monitor.php">
   <i class="fa fa-desktop my-float"></i>
   </a></li>
   <li><a href="menu.php">
   <i class="fa fa-edit my-float"></i>
   </a></li>
   <li><a href="kitchen.php">
   <i class="fa fa-cutlery my-float"></i>
   </a></li>
   <li><a href="rider.php">
   <i class="fa fa-motorcycle my-float"></i>
   </a></li>
   <li><a href="../../helper/loginsystem/logout.php">
   <i class="fa fa-sign-out my-float"></i>
   </a></li>
   </ul>
  </body>
  <script src="../../public/js/menu.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
