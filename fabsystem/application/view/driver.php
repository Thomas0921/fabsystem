<?php
include '../framework/db.php';
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Driver</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/driver.css">


  </head>
  <body>
    <h2 style="text-align:center">Driver View</h2>
    <?php
    $query = "SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id WHERE status_id = 2 OR status_id = 3 order by order_id ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
     ?>

    <div class="columns">
      <ul class="price">
        <li class="header"><?php echo $row['order_id'];?></li>
        <li class="content">
          <div class="qr" data-id ="<?php echo $row['order_id'];?>" ><?php echo $row['customer_address']; ?></div>
        </li>
        <p id="value">  <?php $row['status_id']; ?> </p>
        <li> <?php echo $row['rider_name']; ?></li>
        <li> <button id="btn_ready" data-id="<?php echo $row['order_id'] ?>">Deliver</button></li>
        <li> <button id="btn_complete" data-id="<?php echo $row['order_id'] ?>">Completed</button></li>
      </ul>
    </div>
  <?php
  }
   ?>
  </body>
</html>

<script>
$("#btn_ready").on('click',function(){
  var order_id = $(this).attr('data-id');
  alert(order_id);
   $.ajax({
     type: 'POST',
     url: '../controller/AJAXDriverStatusUpdate.php', // will change to other php when done
     data: {
       order_id:order_id,
     },
     success: function (data) {
       alert(data);
       location.reload();
     }
 });
});

$("#btn_complete").on('click',function(){
  var order_id = $(this).attr('data-id');
  alert(order_id);
   $.ajax({
     type: 'POST',
     url: '../controller/AJAXDriverStatusUpdate.php', // will change to other php when done
     data: {
       order_id:order_id,
     },
     success: function (data) {
       alert(data);
       location.reload();
     }
 });
});


$(".qr").each(function() {
  var id = $(this).attr("data-id");
  generate_qrcode($(this).text(), $(this));
});

function generate_qrcode(sample, identifier){
  var input = sample.replace(/\,/g,' ');
  var url = input.replace(/\ /g, '%20');
  var sample = 'http://maps.google.com/maps?q='+ url +'"target="_blank"';
    $.ajax({
    type: 'POST',
    url: '../controller/code.php',
    data : {sample:sample},
    success: function(code){
      console.log(code);
      $(identifier).html(code);
      }
    });
  }


</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
