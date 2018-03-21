<?php
include '../framework/db.php';

  if(isset($_POST['btn_ready']) && isset($_POST['order_id']) ){


    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style media="all">

    th.titlerow{
      border: none;
    }

    dl, dt, dd {
      cursor: pointer;
      position: relative;
      list-style-type: none;
      text-align: left;
      padding: 4px;
      background: white;
      font-size: 17px;
      transition: 0.2s;
      }

      div.head{
        font-size: 17px;
      }

    dt button.delete-item dd button.delete-item{
      display: none;
    }

    dd{
     margin-left: 20px;
    }

    .delete-item, .delete-addon{
      display: none;
    }

<<<<<<< HEAD
    #display_total_food{
      display: block;
      float:right;
    }
    #display_total_addon{
      display: block;
      float:right;
    }

=======
    p{
      font-size: 17px;
    }

    tfoot{
      font-size: 17px;
    }
    
>>>>>>> 2a2abaeaeb3362cf2a8fe77adabbd8fe99ae4b04
    </style>

  </head>
  <body>

    <?php
    $sql = "SELECT * FROM orders WHERE order_id= $order_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
     ?>

    <div class="print_content">
        <center><h3>Jio Makan</h3></center>
        <center> ------------------------------------------<br> </center>
        <div class = "head" >
          Bill No. : <?php echo $row['bill_no']; ?>  <br>
          Serve By : Admin  <br>
          Date: <?php echo $row['order_time']; ?> <br>
        </div>
        <center> ------------------------------------------<br> </center>
          <table class="table table-bordered">


            <thead class = "titlerow">
                <td>Qty &nbsp; Descriptio <div style="float:right; padding-right: 5px;">Total</div></td>
            </thead>
<<<<<<< HEAD


            <td>
              <?php
              echo $row['order_content'];
              ?>
            </td>

=======
            <tr>
              <?php
              echo $row['order_content'];
               ?>
            </tr>
>>>>>>> 2a2abaeaeb3362cf2a8fe77adabbd8fe99ae4b04




            <center> ------------------------------------------<br></center>
<<<<<<< HEAD


=======
            <p>DISCOUNT: <?php echo $row['order_discount']; ?><br>
              TOTAL: <?php echo $row['order_gross']; ?></p>
            <tfoot>
              <?php echo $row['customer_address']; ?><br>
              <?php echo $row['customer_contact']; ?> <br>
            </tfoot>
>>>>>>> 2a2abaeaeb3362cf2a8fe77adabbd8fe99ae4b04
          </table>
          <div class="">
            Discount: <?php echo $row['order_discount']; ?> <br>
            Total: <?php echo $row['order_gross']; ?>
          </div>
          <tfoot>
            Address: <?php echo $row['customer_address']; ?><br>
            Contact: <?php echo $row['customer_contact']; ?> <br>
          </tfoot>
          <center><p>Thanks for supporting</p></center>
          <center>www.jiomakan.com</center>
        </div>
      </body>

    <?php
  } // end of php while loop
   ?>

</html>
<?php
} // end of php while loop
?>

 <script type="text/javascript">
   window.print();

   $("dt").each(function(){
     var total_food = $(this).attr("total_each_food");
     $(this).children("#display_total_food").text(total_food);
   });
   $("dd").each(function(){
     var total_addon = $(this).attr("total_each_addon");
     $(this).children("#display_total_addon").text(total_addon);
   });
 </script>