<?php
$connect = mysqli_connect("localhost", "root", "", "fabsystem");
$query = "SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id JOIN order_status on orders.status_id = order_status.status_id order by order_time DESC";
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Monitor</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    thead {
      display: block;
    }
    tbody {
      display: block;
      height: 450px;       /* Just for the demo          */
      overflow-y: auto;    /* Trigger vertical scroll    */
      overflow-x: hidden;  /* Hide the horizontal scroll */
    }
    </style>
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
      <form action="/fetch.php">
        Date:
        <input id="date_picker" type="date" name="date">
      </form>

      <br />
      <div id="result">

      <!--</div>

      <div class="table-responsive" >
        <table id="first" class="table table-bordered scrollingTable" >
          <thead>
          <tr>
            <th width="5%">ID</th>
            <th width="5%">OrderID</th>
            <th width="5%">Name</th>
            <th width="20%">Address</th>
            <th width="5%">OrderTime</th>
            <th width="5%">DeliveryTime</th>
            <th width="5%">Duration</th>
            <th width="5%">Gross(RM)</th>
            <th width="5%">Disc(RM)</th>
            <th width="5%">Delivery(RM)</th>
            <th width="5%">Nett(RM)</th>
            <th width="5%">Rider</th>
            <th width="5%">Status</th>
          </tr>
          </thead>
          <span id="val"></span>
          <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
           ?>
           <tr>
             <th id="head" width="5%"><?php echo $row['order_id'] ;?></th>
             <th width="5%"><?php echo $row['order_id'] ;?></th>
             <th width="5%"><?php echo $row['customer_name'] ;?></th>
             <th width="20%"><?php echo $row['customer_address'] ;?></th>
             <th width="5%"><?php echo $row['order_time'] ;?></th>
             <th width="5%"><?php echo $row['delivery_time'] ;?></th>
             <th width="5%"><?php echo $time = date_diff(new DateTime($row['order_time']), new DateTime($row['delivery_time']))->format('%h hours and %i minutes') ;?></th>
             <th width="5%"><?php echo $row['order_gross'] ;?></th>
             <th width="5%"><?php echo $row['order_discount'] ;?></th>
             <th width="5%"><?php echo $row['order_delivery'] ;?></th>
             <th class="nettSum" width="5%"><?php echo $nett= $row['order_delivery']+$row['order_gross']-$row['order_discount'];?></th>
             <th width="5%"><?php echo $row['rider_name'] ;?></th>
              <td hidden><?php echo $row['status_id'] ;?></td>
              <th width="5%"><?php echo $row['status_name'] ;?></th>
           </tr>
          <?php
           }
          ?>
          </tbody>
        </table>
      </div>

    </div> <!--End of container-->
  </body>
  <footer>
    <div class="">
      Subtotal: <span id="subtotal_id"></span>
    </div>
  </footer>
</html>


<script>
  $(document).ready(function(){
    function load_data(query, date)
  {
    $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{
       query:query,
       date:date
         },
    success:function(data)
      {
      $('#result').html(data);
      }
    });
  }
    $('#search_text').keyup(function(){
    var search = $(this).val();
    var date = $("#date_picker").val();
    console.log(search);
    console.log(date);
    if(search != '')
    {
      // load search result and hide table
     load_data(search, date);
     $("#first").hide();

    }
    else
    {
      // when no search result and show table
      $('#result').html("");
      $("#first").show();
    }
   });
  });

  $(document).ready(function(){
        //Iterate through each of the rows
         $('tr').each(function(){
           //Check the value of the last <td> element in the row (trimmed to ignore white-space)
           if($(this).find('td').text().trim() === "1"){
               //Set the row to green
               $(this).css('background','#ffe800');
           }
           if ($(this).find('td').text().trim() === "2") {
             $(this).css('background','#37d726');
           }
           if ($(this).find('td').text().trim() === "3") {
             $(this).css('background','#0775c8');
           }
           if ($(this).find('td').text().trim() === "4") {
             $(this).css('background','#a0a0a0');
           }
           if ($(this).find('td').text().trim() === "5") {
             $(this).css('background','gray');
           }
         });
     });
          var sum = 0;
          $('#first .nettSum').each(function()
      {
          sum += parseFloat($(this).html());

      });
        $('#subtotal_id').html(sum);

        $('#date_picker').on("change", function(){
        $("#first").hide();
        var query = $("#search_text").val();
        var date = $(this).val();
        
      $.ajax({
       url:"fetch.php",
       method:"POST",
       data:{
         query:query,
         date:date
       },
       success:function(data)
       {
        $('#result').html(data);
       }
      });
    });
</script>
