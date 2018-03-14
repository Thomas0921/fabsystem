<?php
$connect = mysqli_connect("localhost", "root", "", "fabsystem");
$output ='';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
               SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id JOIN customers on orders.customer_id = customers.customer_id JOIN order_status on orders.status_id = order_status.status_id
               WHERE order_id LIKE '%".$search."%'
               OR order_id LIKE '%".$search."%'
               OR customer_name LIKE '%".$search."%'
               OR customer_address LIKE '%".$search."%'
               OR order_time LIKE '%".$search."%'
               OR delivery_time LIKE '%".$search."%'
               OR order_gross LIKE '%".$search."%'
               OR order_discount LIKE '%".$search."%'
               OR order_delivery LIKE '%".$search."%'
               OR rider_name LIKE '%".$search."%'
               OR status_name LIKE '%".$search."%'
            ";

          }
          $result = mysqli_query($connect, $query);
          if($result ->num_rows > 0)
          {
           $output .= '
            <div class="table-responsive">
             <table class="table table bordered">
             <tr>
             <th>ID</th>
             <th>OrderNo</th>
             <th>Name</th>
             <th>Address</th>
             <th>OrderTime</th>
             <th>DeliveryTime</th>
             <th>Nett</th>
             <th>Gross</th>
             <th>Disc</th>
             <th>Delivery</th>
             <th>Nett</th>
             <th>Rider</th>
             <th>Status</th>
             </tr>
             ';

           while($row = mysqli_fetch_array($result))
           {
            $output .= '
            <tr>
             <td>'.$row["order_id"].'</td>
             <td>'.$row["order_id"].'</td>
             <td>'.$row["customer_name"].'</td>
             <td>'.$row["customer_address"].'</td>
             <td>'.$row["order_time"].'</td>
             <td>'.$row["delivery_time"].'</td>
             <td>'.$time = date_diff(new DateTime($row['order_time']), new DateTime($row['delivery_time']))->format('%h hours and %i minutes').'</td>
             <td>'.$row["order_gross"].'</td>
             <td>'.$row["order_discount"].'</td>
             <td>'.$row["order_delivery"].'</td>
             <td>'.$nett=$row["order_delivery"]+$row["order_gross"]-$row["order_discount"].'</td>
             <td>'.$row["rider_name"].'</td>
             <th>'.$row["status_id"].'</th>
            </tr>
            ';
           }
           echo $output;
          }
          else
          {
           echo 'Data Not Found';
          }


 ?>
<script type="text/javascript">

$(document).ready(function(){
      //Iterate through each of the rows
       $('tr').each(function(){
         //Check the value of the last <td> element in the row (trimmed to ignore white-space)
         if($(this).find('th').text().trim() === "1"){
             //Set the row to green
             $(this).css('background','#ffe800');
         }
         if ($(this).find('th').text().trim() === "2") {
           $(this).css('background','#37d726');
         }
         if ($(this).find('th').text().trim() === "3") {
           $(this).css('background','#0775c8');
         }
         if ($(this).find('th').text().trim() === "4") {
           $(this).css('background','#a0a0a0');
         }
         if ($(this).find('th').text().trim() === "5") {
           $(this).css('background','gray');
         }
       });
   });
</script>
