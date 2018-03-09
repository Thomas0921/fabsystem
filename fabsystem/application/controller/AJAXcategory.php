<?php
include '../framework/db.php';

  $output = '';

  if(isset($_POST["id"])){
    $sql = "SELECT food_subcategories.subcategory_id, food_subcategories.subcategory_name, food_categories.category_id, food_categories.category_name FROM food_subcategories JOIN food_categories ON food_subcategories.category_id = food_categories.category_id WHERE food_subcategories.category_id=".$_POST["id"];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        echo '<a class="click-subcat" href="#" subcategory_id='.$row['subcategory_id'].'>'.$row['subcategory_name'].'</a>';
        echo ' ';
      }
      echo $output;
    }
   }

 ?>
 <script src="../../public/js/menu.js"></script>
