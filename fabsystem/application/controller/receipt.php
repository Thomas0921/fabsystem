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

    <style media="screen">

    dl, dt, dd {
      cursor: pointer;
      position: relative;
      list-style-type: none;
      text-align: left;
      padding: 4px;
      background: white;
      font-size: 18px;
      transition: 0.2s;
      font-size: 25px;
    }

    dd{
     margin-left: 20px;
    }

    .delete-item, .delete-addon{
      display: none;
    }

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
            <tbody>
              <tr>

                <td>Qty</td>
                <td>Description</td>
                <td>Total</td>
              </tr>
              <tr>
                <?php

                echo  $row['order_content'];

                 ?>
                <td></td>
                <td></td>
                <td></td>
              </tr>


            </tbody>
            <center> ------------------------------------------<br></center>
            TOTAL: <?php echo $row['order_gross']; ?>
            <tfoot>
              <?php echo $row['customer_address']; ?><br>
              <?php echo $row['customer_contact']; ?> <br>
            </tfoot>
          </table>
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
 </script>
