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
    <meta charset="utf-8"><meta http-equiv="refresh" content="60" >
    <!-- to fit perfectly in mobile version -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/rider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
   <!--floating button -->
   <div class="helper-floating-button">
     <a href="#" class="float" id="menu-share">
       <i class="fa fa-home my-float" style="font-size:30px;"></i>
     </a>
    <ul class="icon">

      <li class="btn">
        <a class="btnlink" href="monitor.php">
          <div class="label-container" style="position:absolute; bottom: 288px;">
            <div class="label-text">Monitor Page</div>
            <i class="fa fa-play label-arrow"></i>
          </div>
          <i class="fa fa-desktop my-float" style="font-size:20px;"></i>
        </a>
      </li>
      <li class="btn">
        <a class="btnlink" href="menu.php">
          <div class="label-container" style="position:absolute; bottom: 224px;">
            <div class="label-text">Menu Page</div>
            <i class="fa fa-play label-arrow"></i>
          </div>
          <i class="fa fa-edit my-float" style="font-size:20px;"></i>
        </a>
      </li>
      <li class="btn">
        <a class="btnlink" href="kitchen.php">
          <div class="label-container" style="position:absolute; bottom: 158px;">
            <div class="label-text">Kitchen Page</div>
            <i class="fa fa-play label-arrow"></i>
          </div>
          <i class="fa fa-cutlery my-float" style="font-size:20px;"></i>
        </a>
      </li>
      <li class="btn">
        <a class="btnlink" href="rider.php">
          <div class="label-container" style="position:absolute; bottom: 96px;">
            <div class="label-text">Rider Page</div>
            <i class="fa fa-play label-arrow"></i>
          </div>
          <i class="fa fa-motorcycle my-float" style="font-size:20px;"></i>
        </a>
      </li>
      <li class="btn">
        <a class="btnlink" href="../../helper/loginsystem/logout.php">
          <div class="label-container">
            <div class="label-text">Logout</div>
            <i class="fa fa-play label-arrow"></i>
          </div>
          <i class="fa fa-sign-out my-float" style="font-size:20px;"></i>
        </a>
      </li>
    </ul>
   </div>

  </body>
</html>

<script src ="../../public/js/rider.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
