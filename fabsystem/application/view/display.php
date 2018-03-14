<?php
$connect = mysqli_connect("localhost", "root", "", "fabsystem");
$query = "SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id JOIN customers on orders.customer_id = customers.customer_id JOIN order_status on orders.status_id = order_status.status_id order by order_time DESC";
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Display</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
  <body>
    <div  class="container" style="width:100% ;" >
      <h3 align="center">MONITOR SCREEN</h3>
      <ul >
      <li ><img src="chef.png" width="50px"></li>
      <li ><img src="serve.png" width="50px"></li>
      <li ><img src="bike.png" width="50px" ></li>
      <li ><img src="tick.png" width="50px"></li>
      <li ><img src="minus.png" width="50px"></li>
    </ul>
      <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon">Search</span>
        <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
      </div>
      </div>

    <br />
    <div id="result"></div>
    </div>

        <table id="first" class="table table-bordered">
          <tr><thead>
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
          </thead></tr>


          <?php

        while ($row = mysqli_fetch_assoc($result)) {
           ?>
           <tr>
             <th id="head"><?php echo $row['order_id'] ;?></th>
             <th><?php echo $row['order_id'] ;?></th>
             <th><?php echo $row['customer_name'] ;?></th>
             <th><?php echo $row['customer_address'] ;?></th>
             <th><?php echo $row['order_time'] ;?></th>
             <th><?php echo $row['delivery_time'] ;?></th>
             <th><?php echo $time = date_diff(new DateTime($row['order_time']), new DateTime($row['delivery_time']))->format('%h hours and %i minutes') ;?></th>
             <th><?php echo $row['order_gross'] ;?></th>
             <th><?php echo $row['order_discount'] ;?></th>
             <th><?php echo $row['order_delivery'] ;?></th>
             <th><?php echo $nett= $row['order_delivery']+$row['order_gross']-$row['order_discount'];?></th>
             <th><?php echo $row['rider_name'] ;?></th>
              <td><?php echo $row['status_id'] ;?></td>
           </tr>

           <?php

       }
         ?>
        </table>

      </div>
    </div>

  </body>
</html>

<div id="dataModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Employee detail</h4>
      </div>
        <div class="modal-body" id="employee_detail" >

        </div>
      <div class="modal-footer">
         <button type="button" class="btn btn_default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>


  $(document).ready(function(){
    setInterval(function() {
      $(this).load('display.php')
    }, 3000);
  });
/*
    $(document).ready(function(){
    $('.view_data').click(function(){
      var email = $(this).attr("user_email");

      $.ajax({
        url:"select.php",
        method:"post",
        data:{email:email},
        success:function(data){
          $('#employee_detail').html(data);
          $('#dataModal').modal("show");

        }
      });


    });
  }); */
  $(document).ready(function(){


   function load_data(query)
   {
    $.ajax({
     url:"fetch.php",
     method:"POST",
     data:{query:query},
     success:function(data)
     {
      $('#result').html(data);
     }
    });
   }
   $('#search_text').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      // load search result and hide table
     load_data(search);
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



</script>
