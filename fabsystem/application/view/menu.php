<?php

  include '../framework/db.php';
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu Page</title>
    <link rel="stylesheet" href="../../public/css/menu.css">
    <script src="../../public/js/menu.js"></script>
  </head>
  <body>
    <div class="food-box" style="background-color: rgb(237, 236, 106);">
      <h1>Food Menu</h1>
      <div class="wrapper">
        <div class="tabs">
          <button class="tab" onclick ="openMe('rice')" type="button" name="button">Rice</button>
          <button class="tab" onclick ="openMe('indo')" type="button" name="button">Indo</button>
        </div>
        <div id = "rice" class="sub-tabs">
          <button class="tab" onclick ="openMe2('chicken')" type="button" name="button">Chicken</button>
          <button class="tab" onclick ="openMe2('fish')" type="button" name="button">Fish</button>
          <button class="tab" onclick ="openMe2('prawn')" type="button" name="button">Prawn</button>
          <button class="tab" onclick ="openMe2('sotong')" type="button" name="button">Sotong  </button>
        </div>
        <div id = "indo" class="sub-tabs">
          <button class="tab "type="button" name="button">Fried Rice</button>
          <button class="tab "type="button" name="button">Fish</button>
        </div>
        <div id = "chicken" class="content">
          <a href="#">Curry Chicken Rice</a>
          <a href="#">Mamee Chicken Rice</a>
        </div>
        <div id = "fish" class="content">
          <a href="#">Curry fish Rice</a>
          <a href="#">Mamee fish Rice</a>
        </div>
      </div>

      <form class="" action="index.html" method="post">
        <button type="button" name="add">Add</button>
        <button type="button" name="edit">Edit</button>
        <button type="button" name="delete">Delete</button>
      </form>
    </div>
    <div class="description-box" style="background-color: rgb(122, 180, 238);">
      <h1>Description</h1>
    </div>
    <div class="customer-box" style="background-color: rgb(125, 213, 156);">
      <h1>Customer's Detail</h1>
      <form class="customer-form" action="index.html" method="post">
        <input type="text" name="name" value="" placeholder="Name">
        <input type="text" name="contact" value="" placeholder="Contact">
        <input type="text" name="address" value="" placeholder="Address">
        <input type="text" name="discount" value="" placeholder="Discount">
      </form>
      <h2>Total:</h2>
    </div>

  </body>
</html>
