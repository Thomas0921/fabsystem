<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php

$conn = mysqli_connect("localhost", "root", "", "fabsystem");
$output ='';
if(isset($_POST["query"]) && isset($_POST["date"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $date = mysqli_real_escape_string($conn, $_POST["date"]);
 $query = "
               SELECT * FROM orders JOIN riders on orders.rider_id = riders.rider_id JOIN order_status on orders.status_id = order_status.status_id
               WHERE (order_id LIKE '%".$search."%' AND order_time LIKE '%".$date."%')
               OR (customer_name LIKE '%".$search."%' AND order_time LIKE '%".$date."%')
               OR (customer_address LIKE '%".$search."%' AND order_time LIKE '%".$date."%')
               OR (order_gross LIKE '%".$search."%' AND order_time LIKE '%".$date."%')
               OR (order_discount LIKE '%".$search."%' AND order_time LIKE '%".$date."%')
               OR (order_delivery LIKE '%".$search."%' AND order_time LIKE '%".$date."%' )
               OR (rider_name LIKE '%".$search."%' AND order_time LIKE '%".$date."%')
               OR (status_name LIKE '%".$search."%' AND order_time LIKE '%".$date."%') order by order_time desc
            ";

          }
          $result = mysqli_query($conn, $query);
          if($result ->num_rows > 0)
          {
           $output .= '
            <div class="table-responsive">
             <table id="first" class="table table bordered">
             <thead>
             <tr>
             <th width="5%">ID</th>
             <th width="5%">OrderID</th>
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
             </tr></thead>
             <tbody>
             ';

           while($row = mysqli_fetch_array($result))
           {
            $output .= '
            <tr>
             <td width="5%">'.$row["order_id"].'</td>
             <td width="5%">'.$row["order_id"].'</td>
             <td width="5%">'.$row["customer_name"].'</td>
             <td width="20%">'.$row["customer_address"].'</td>
             <td width="5%">'.$row["order_time"].'</td>
             <td width="5%">'.$row["delivery_time"].'</td>
             <td width="5%">'.$row["closed_time"].'</td>
             <td width="5%">'.$time = date_diff(new DateTime($row['order_time']), new DateTime($row['closed_time']))->format('%h hours and %i minutes').'</td>
             <td width="5%">'.$row["order_gross"].'</td>
             <td width="5%">'.$row["order_discount"].'</td>
             <td class="netDelivery" width="5%">'.$row["order_delivery"].'</td>
             <td class="nettSum2" width="5%">'.$nett=$row["order_delivery"]+$row["order_gross"]-$row["order_discount"].'</td>
             <td width="5%">'.$row["rider_name"].'</td>
             <th hidden>'.$row["status_id"].'</th>
             <td width="5%">'.$row["status_name"].'</td>
            </tr>
            ';
          }
           $output .= '</tbody></table>
                       </div>';
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

   var sum = 0;
   $('#first .nettSum2').each(function()
    {
      sum += parseFloat($(this).html());
    });
    $('#subtotal_id').html(sum);

    var sum = 0;
    $('#first .netDelivery').each(function()
     {
       sum += parseFloat($(this).html());
     });
     $('#totalDelivery').html(sum);
</script>
