<?php
    // if category_id is not set, send back to menu.php
    if(!isset($_GET['category_id'])){
      header("Location: menu.php");
    }
    // Select all foods which belong to the selected category
    $food_sql = "SELECT food_subcategories.subcategory_id, food_subcategories.subcategory_name, food_categories.category_name FROM food_subcategories JOIN food_categories ON food_subcategories.category_id = food_categories.category_id WHERE food_subcategories.category_id=".$_GET['category_id']；
    $result = mysqli_query($conn, $food_sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        echo '<a href="menu.php?subcategory_id='.$row['subcategory_id'].'">'.$row['subcategory_name'].'</a>';
        echo ' ';
      }
    }

 ?>
