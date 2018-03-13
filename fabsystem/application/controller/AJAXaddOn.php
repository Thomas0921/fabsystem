<?php
include '../framework/db.php';

  $output = '';

  if(isset($_POST["id"])){
    $sql = "SELECT food_add_on.add_on_id, food_add_on.add_on_name, food_add_on.add_on_price FROM food_add_on JOIN food_categories ON food_add_on.category_id = food_categories.category_id WHERE food_add_on.category_id=".$_POST["id"];
    $result = mysqli_query($conn, $sql);

    if($result ->num_rows > 0){
      while($row = $result ->fetch_assoc()){
        $output .= '<a class="addon-to-cart hover-addon-detail" href="#" condition-id='.$row['add_on_id'].' condition-name='.$row['add_on_name'].' condition-price='.$row['add_on_price'].'>'.$row['add_on_name'].'</a>';
        $output .=  ' ';
      }
      echo $output;
    }
   }

 ?>
 <script src="../../public/js/menu.js"></script>
