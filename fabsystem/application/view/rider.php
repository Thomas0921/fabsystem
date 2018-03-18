<?php
include '../framework/db.php';
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8"><meta http-equiv="refresh" content="60" >
    <title>Rider</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/rider.css">


  </head>
  <body>
    <h2 style="text-align:center">Rider View</h2>

    <button class="btn-edit" type="button" name="button">Pencil</button>
    <div class="popup-bg">
      <div class="popup-main">
        <div class="close-popup" title="Close this popup">
          <p>X</p>
        </div>
        <div class="popup-content">
          <div class="add_rider_div" style="">
            <input list="datalist-rider" autocomplete="off" name ="datalist_rider" placeholder="Rider Name" id="datalist-rider-id">
            <datalist class="datalist_searchRider" id="datalist-rider">
              <?php
                $sql = "SELECT * FROM riders WHERE rider_id != 1";
                $result = mysqli_query($conn, $sql);

                if($result ->num_rows > 0){
                  while($row = $result ->fetch_assoc()){
                    echo '<option value="'.$row['rider_name'].'" data-id="'.$row['rider_id'].'"></option>';
                  }
                }
               ?>
            </datalist>
            <button type="button" id="btn_add_rider" name="add_rider">+</button>
            <button type="button" id="btn_update_rider" name="add_rider">Edit</button>
            <button type="button" id="btn_delete_rider" name="delete_rider">-</button><br>
            <input hidden id="editRiderInput" type="text" name="" value="">
            <button hidden id="editRiderButton" type="button" name="button">Update</button>
          </div><!-- add_condition_div -->
        </div>
      </div>
    </div>

    <?php
    $query = "SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id WHERE status_id = 2 OR status_id = 3 order by order_id ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
     ?>

    <div class="columns" id="col_<?php echo $row['order_id'];?>" data-id="<?php echo $row['order_id'];?>" >
      <ul class="price">
        <li class="header"><?php echo $row['bill_no'];?></li>
        <li class="content">
          <div class="qr" data-id ="<?php echo $row['order_id'];?>" ><?php echo $row['customer_address']; ?></div>
        </li>
        <p hidden id="value" data-id="<?php echo $row['order_id']; ?>"><?php echo $row['status_id']; ?></p>
        <li>
          <input list="datalist-rider" autocomplete="off" placeholder="Rider Name" class="datalist-rider-id-input">
          <p id="rider_name_p"><?php echo $row['rider_name']; ?></p>
        </li>
        <li>
          <button class="btn_delivery" data-id="<?php echo $row['order_id']; ?>">Deliver</button>
          <button class="btn_complete" data-id="<?php echo $row['order_id']; ?>">Completed</button>
        </li>
      </ul>
    </div>
  <?php
  }
   ?>
  </body>
</html>

<script src ="../../public/js/rider.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
