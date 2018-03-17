<?php
include '../framework/db.php';
session_start();

$query = "SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id JOIN order_status on orders.status_id = order_status.status_id order by order_time DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Monitor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../public/css/monitor.css">
  </head>
  <body>
    <div  class="container" style="width:100% ;" >
      <h3 align="center">MONITOR SCREEN</h3>
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">Search</span>
          <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
        </div>
      </div>
      <form action="../controller/fetch.php">
        Date:
        <input id="date_picker" type="date" name="date">
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
