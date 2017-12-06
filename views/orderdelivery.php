<?php
  require_once('db/db.php');

  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  $order_id = $_SESSION['prev_order_id'];
  $c_id = $_SESSION['c_id'];

  $c_query = $db_connection->query("SELECT * FROM customer WHERE CustomerID=".$c_id);
  $c_row = $c_query->fetch_object();
  $c_name = $c_row->Name;
  $c_phone = $c_row->Phone;

  $order_query = $db_connection->query("SELECT * FROM productorder WHERE OrderID=".$order_id);
  $order_row = $order_query->fetch_object();
  $d_address = $order_row->Address;
  $d_date = $order_row->DeliveryDate;
  $order_date = $order_row->OrderDate;

  $order_detail_query = $db_connection->query("SELECT product.PName, product.Price, orderdetail.Qty FROM `orderdetail` INNER JOIN product USING(ProductID) WHERE OrderID=".$order_id);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>B2U - Order Receipt</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/b2u-style.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Nav menu top -->
    <?php include("views/navbar.php"); ?>
<style>
  .order-receipt-well{
    background-color: #F4F5FF;
    color: #7A4DC8;
  }
  .table-striped>tbody>tr:nth-child(odd)>td,
  .table-striped>tbody>tr:nth-child(odd)>th {
   background-color: #E6E2FF;
  }
  .fa{
    padding-right: 7px;
  }
</style>
		<!-- Content body -->
    <div class="container content">
      <h3 class="page-header" style="color:#ab7aff;">Order Receipt: </h3>
        <div  class="alert alert-success text-center">Order Submitted. Your goods will be delivered soon.</div>

        <div class="well order-receipt-well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="text-left">
                        <strong><?php echo $c_name;?></strong>
                        <br/><i class="fa fa-phone" aria-hidden="true"></i><?php echo $c_phone;?>
                        <br/><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $d_address;?><br>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p><i>Order No. #000<?php echo $order_id;?></i></p>
                    <p><i>Date: <?php echo $order_date;?></i></p>
                </div>
            </div>

            <div class="row">
                <div class="text-center">
                    <br/><h2>Order Receipt</h2><br/>
                </div>
                <div class="text-left col-xs-8">
                  <h5><i>Delivery Date: <?php echo $d_date; ?></i></h5>
                </div>

                <table class="table-responsive table-striped table">
                    <thead>
                        <tr>
                            <th>Products</th>
                            <th>#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $total = 0;
                        while ($row = mysqli_fetch_assoc($order_detail_query)) {
                            $i_total = $row['Price'] * $row['Qty'];
                            $total += $i_total;
                            echo "<tr>";
                            echo "<td class='col-md-9'><em>".$row['PName']."</em></h4></td>";
                            echo "<td class='col-md-1 text-center'>".$row['Qty']."</td>";
                            echo "<td class='col-md-1 text-center'>".$row['Price']." Ks.</td>";
                            echo "<td class='col-md-1 text-center'>".$i_total." Ks.</td>";
                            echo "</tr>";
                        }
                      ?>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td class="text-right">
                              <p><strong>Subtotal: </strong></p>
                              <p><strong>Tax: </strong></p></td>
                            <td class="text-left">
                              <p><strong><?php echo $total;?> Ks.</strong></p>
                              <p><strong>0  Ks.</strong></p>
                            </td>
                        </tr>
                        <tfoot>
                            <td></td><td></td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center"><h4><strong><?php echo $total;?>Ks.</strong></h4></td>
                        </tfoot>
                    </tbody>
                </table>
                <div>
                  <h3 style="text-align:center;">Thanks for using our service.</h3>
                </div>
          </div>
        </div>

    </div>

    <!-- Footer -->
		<?php include("views/footer.php"); ?>

		<!-- 		JAVASCRIPT		 -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
