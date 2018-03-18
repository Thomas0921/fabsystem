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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/monitor.css">
    </head>
  <body>
    <a href="../../helper/loginsystem/logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
    <div  class="container" >
      <h3 align="center">MONITOR SCREEN</h3>
      <div>
        <div class="input-group">
          <span class="input-group-addon">Search</span>
          <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
          </div></div>
        </div>
        <form class="date">
          Date:<input id="date_picker" type="date" name="date" value="<?php echo date('Y-m-d');  ?>">
        </form>

      <div id="result">
    </div>
  </body>
  <div class="">
    TotalNett: <span id="subtotal_id"></span> <br>
    TotalDelivery: <span id="totalDelivery"></span>
  </div>
</html>

<script src="../../public/js/monitor.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
