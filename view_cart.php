<?php
  require_once("db/db.php");
  require_once("classes/Cart.php");
  require_once("classes/Order.php");
  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  session_start();
  $cart = new Cart();

  $is = false;
  $style = "";
  $order = new Order();

  if ($_SESSION['order_finished'] == 1){
    header("location: order.php");
  }
  if(isset($_SESSION['cart'])) {
    $is=true;
    $style = "style='display:none;'";
  } else {
    $is=false;
    $style = "style='display:block;'";
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>B2U - Shopping Cart</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/b2u-style.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Nav menu top -->
    <?php include("views/navbar.php"); ?>

		<!-- Content body -->
    <div class="container content">
      <div class="well text-center empty-cart-alert invisible-well" <?php echo $style; ?>>
        <i class="fa fa-shopping-cart fa-5x " aria-hidden="true"></i>
        <h3>
          <p>Empty Shopping Cart :(</p><br/>
          <p>Add some items from <a href="shop.php"><b>Shop</b></a>.</p>
        </h3>
      </div>
        <?php if($is) include("views/shopping_cart.php");?>
    </div>

    <!--  FOOTER  -->
		<?php include("views/footer.php"); ?>

		<!-- 		JAVASCRIPT		 -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/cart.js"></script>

</body>

</html>
