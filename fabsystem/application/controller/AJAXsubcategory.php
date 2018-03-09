<?php
include '../framework/db.php';

  $output = '';

  if(isset($_POST["id"])){
    $sql = "SELECT foods.food_id, foods.food_name, foods.food_description, foods.food_price, food_subcategories.subcategory_id, food_subcategories.subcategory_name FROM foods JOIN food_subcategories ON foods.subcategory_id = food_subcategories.subcategory_id WHERE foods.subcategory_id=".$_POST['id'];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
          echo '<a class="add-to-cart hover-detail" href="#" data-id="'.$row['food_id'].'" data-name="'.$row['food_name'].'" data-price="'.$row['food_price'].'" >'.$row['food_name'].'</a>';
        echo ' ';
      }
      echo $output;
    }
   }

 ?>
 <script src="../../public/js/menu.js"></script>
