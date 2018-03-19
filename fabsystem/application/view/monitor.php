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

      <h2 class="header" align="center">MONITOR SCREEN</h2>

        <div id="input-group">
              <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
        </div>
        <form class="date">
         &nbsp;&nbsp;&nbsp;  Date:<input id="date_picker" type="date" name="date" value="<?php echo date('Y-m-d');  ?>">
        </form>



      <div id="result">
      </div>


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
<div>
  <table id="tb" width="90%">
    <thead hidden>
      <th class="ID" width="2.55%">ID</th>
      <th width="5%">BillNo</th>
      <th width="5%">Name</th>
      <th width="20%">Address</th>
      <th width="5%">OrderTime</th>
      <th width="5%">DeliveryTime</th>
      <th width="5%">ClosedTime</th>
      <th width="5%">Duration</th>
      <th width="5%">Gross(RM)</th>
      <th width="5%">Disc(RM)</th>
      <th width="5%">Delivery(RM)</th>
      <th width="5%">Nett(RM)</th>
      <th width="5%">Rider</th>
      <th width="5%">Status</th>
    </tr>
    </thead>

  <td id="tbr">
    <th width="2.55%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
    <th width="20%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
    <th width="5%"></th>
    <th width="5%"></th>
    <th width="5%"></th>
    <th width="5%">TotalDelivery: <p id="totalDelivery"></p></th>
    <th width="5%"></th>
    <th width="5%">TotalNett: <p id="subtotal_id"></p></th>
    <th width="5%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
  </td>
  </table>

  </div>

</html>

<script src="../../public/js/monitor.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
