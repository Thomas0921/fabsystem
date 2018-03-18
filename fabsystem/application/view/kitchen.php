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
    <title>Kitchen</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/kitchen.css">
  </head>
<body>
<a href="../../helper/loginsystem/logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
  <h2 style="text-align:center">Kitchen View</h2>

  <?php
  $query = "SELECT * FROM orders WHERE status_id = 1 order by order_id ASC";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
   ?>

  <div class="columns" id="col_<?php echo $row['order_id'] ;?>">
    <ul class="price">
      <li class="header"><?php echo $row['order_id'] ;?></li>
      <li class="content"><?php echo $row['order_content'] ;?></li>
      <p id="value">  <?php $row['status_id']; ?> </p>
      <li> <button class="btn_ready" data-id="<?php echo $row['order_id'] ?>">Ready</button></li>
    </ul>
  </div>
<?php
}
 ?>
  </body>
</html>

<script src="../../public/js/kitchen.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
