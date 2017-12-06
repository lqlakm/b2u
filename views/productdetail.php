<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="B2U Online Store">
    <meta name="author" content="aungkominn">

    <title>B2U - Product</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/b2u-style.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
      include("views/navbar.php");

      $query = $db_connection->query("SELECT * FROM product WHERE ProductID=".$p_id)->fetch_object();
      $rand_query = $db_connection->query("SELECT * FROM product WHERE ProductID!= ".$p_id." ORDER BY RAND() LIMIT 3");

    ?>

    <div class="container content">
      <div class="page-header">
        <h2><?php echo $query->PName;?></h2>
      </div>

<style>

.img-detail{
  max-width: 700px;
  max-height: 740px;
}
  .borderless{
    border: none;

  }
  .des-part{
    color: #ab7aff;
    margin-top: 50px;
    font-size: 17px;
  }
  .info-part{
    color: #ab7aff;
    margin-top: 50px;
    margin-right: -10px;
    font-size: 17px;
  }

  .description{
    word-break:break-all;
  }
</style>
      <div class="row">
        <div class=" col-md-8 well invisible-well">
          <div class="row">
            <div class="col-md-12">
                <img class="img-detail img-thumbnail" src="admin/productimages/<?php echo $query->PImage;?>" />
            </div>
            <?php
              $c_query = $db_connection->query("SELECT CategoryName FROM category WHERE CategoryID=".$query->CategoryID)->fetch_object();
             ?>

              <div class="col-md-4 info-part">
                <ul class="list-group">
                  <li class="list-group-item borderless">Name: <?php echo $query->PName;?></li>
                  <li class="list-group-item borderless">Price: <?php echo $query->Price;?></li>
                  <li class="list-group-item borderless">BrandName: <?php echo $query->BrandName;?></li>
                  <li class="list-group-item borderless">Color: <?php echo $query->Color;?></li>
                  <li class="list-group-item borderless">Category: <?php echo $c_query->CategoryName;?></li>
                  <li class="list-group-item borderless"><a class='btn btn-default btn-custom' role='button' onClick='add_to_cart(<?php echo $p_id;?>)' onfocus='this.blur()'>Add to Cart</a></li>
                </ul>
              </div>

              <div class="col-md-8 des-part">
                  <div class="">Description :<hr/></div>
                  <div class="description">
                    <?php echo $query->PDescription;?>
                  </div>
              </div>

          </div>
        </div>

        <div class="col-md-4 row-fluid">
          <div class="page-header"><h4>Products You May Like</h4></div>
          <div class="row" style="padding-left:10px;">


          <?php
            while($row = mysqli_fetch_array($rand_query)){
              $id = $row['ProductID'];
              $img = $row['PImage'];
              $name = $row['PName'];
              $price = $row['Price'];

              echo "<div class='thumbnail col-sm-8'>";
              echo "<img src='admin/productimages/$img'>";
              echo "<div class='caption'>";
              echo "<h4><a href='product.php?p_id=$id'>".$name."</a></h4>";
              echo "<a href='#.' class='btn btn-default btn-sm btn-custom' role='button' onClick='add_to_cart($id)' onfocus='this.blur()'>Add to Cart</a>";
              echo "</p>".$price." Ks.</p>";
              echo "</div></div>";
            }
           ?>
          </div>

        </div>

      </div>
    </div>
  </div>

    <!-- Footer -->
    <?php include("views/footer.php"); ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script>
    function add_to_cart(p_id){
      $.ajax( {
        url: "cartaction.php",
        data: "action=add&p_id="+p_id,
        type: "POST",
        success: function(data){
          $(".badge").fadeOut(100);
          $(".badge").fadeIn(200).html(data);
        },
        error:function (){
          alert("can't add to cart. Unknown error.");
        }
    });
    }
    </script>
</body>

</html>
