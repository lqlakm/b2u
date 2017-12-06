<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>B2U - Category</title>
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
                <a href="addCategory.php" class="btn btn-default btn-custom text-right" style="float:right;"><i class="fa fa-plus-square-o fa-lg" aria-hidden="true"></i> Add New</a>
                <h2>Categories for Products</h2>
              </div>

              <center>
                <div class="loading">
                  <div class="lds-dual-ring"><div></div>
                </div></div>
              </center>
              <div class="categories_row"></div>

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
  $('#nav-category').addClass('active');
  $(document).ready(fetch_category());

  function fetch_category(){
     $(".loading").show();
     setTimeout(function() {
         $(".categories_row").load("views/fetchaction/fetchCategories.php");
         $(".loading").hide();
         $(".categories_row").on( "click", ".pagination a", function (){
             var page = $(this).attr("data-page");
             $(".categories_row").load("views/fetchaction/fetchCategories.php",{"page":page});
         });
     },300);
 }
</script>

</html>
