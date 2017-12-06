<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>B2U - Order</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/admin.b2u.style.css" rel="stylesheet">
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
  <body>
    <div class="content">
      <?php include 'views/navbar.php'; ?>

          <div  class="body-content container-fluid">
            <div class="container-fluid">
              <div  class="page-header">
                <h2>Order and Delivery Status</h2>
                <span style="color:#D0D0D0;">Click on total quantity number to see order products information</span>
              </div>

              <center>
                <div class="loading">
                  <div class="lds-dual-ring"><div></div>
                </div></div>
              </center>
              <div class="orders_row"></div>

            </div>
          </div>
          <div class="container-fluid content-footer">
            &copy; <?php echo date('Y')?> B2U online store
          </div>
    </div>
  </body>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
  $('#nav-order').addClass('active');


  function popover() {
      $("a[id=popover]").popover({placement:"left",trigger:"focus"});
  }

  $(document).ready(fetch_category());

  function fetch_category(){
     $(".loading").show();
     setTimeout(function() {
         $(".orders_row").load("views/fetchaction/fetchOrders.php");
         $(".loading").hide();
         $(".orders_row").on( "click", ".pagination a", function (){
             var page = $(this).attr("data-page");
             $(".orders_row").load("views/fetchaction/fetchOrders.php",{"page":page});
         });
     },300);
 }
</script>

</html>
