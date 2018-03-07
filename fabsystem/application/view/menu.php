<?php

  include '../framework/db.php';
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu Page</title>
  </head>
  <body>
    <div class="food-box">

    </div>
    <div class="customer-box" style="background-color: rgb(125, 213, 156);">
      <h1>Customer's Detail</h1>
      <form class="customer-form" action="index.html" method="post">
        <input type="text" name="name" value="" placeholder="Name">
        <input type="text" name="contact" value="" placeholder="Contact">
        <input type="text" name="address" value="" placeholder="Address">
      </form>
      <h2>Total:</h2>
    </div>
  </body>
</html>
