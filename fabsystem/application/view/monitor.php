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

$query = "SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id JOIN order_status on orders.status_id = order_status.status_id order by order_time DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8"><meta http-equiv="refresh" content="60" >
    <title>Monitor</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/monitor.css">
    </head>
  <body>
    <div  id ="container" >
      <h3 class="header" align="center">MONITOR SCREEN</h3>
      <div>
        <div id="input-group">    
              <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
              <form class="date">
                Date:<input id="date_picker" type="date" name="date" value="<?php echo date('Y-m-d');  ?>">
              </form

          </div></div>
        </div>


      <div id="result">
    </div>
    <a href="#" class="float" id="menu-share">
<i class="fa fa-navicon my-float" ></i>
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
  <div class="">
    TotalNett: <span id="subtotal_id"></span> <br>
    TotalDelivery: <span id="totalDelivery"></span>
  </div>
</html>

<script src="../../public/js/monitor.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
