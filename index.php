<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>Brought to you - E-Commerce</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/b2u-style.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>


<body>
  <?php
    require_once("db/db.php");
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    include 'views/navbar.php';
  ?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('img/img1.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('img/img2.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('img/img3.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('img/img4.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">
        <div class="col-lg-12">
                <h1 class="page-header">Welcome to B2U Online Store</h1>
          </div>

        <!-- Services Section -->
       <section class="service-box">
            <div class="container">
                <div class="row">
                    <div id="service-box" class="col-sm-4">
                        <div  class="box">
                            <h3>Complete Collection</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id pulvinar magna. Aenean accumsan iaculis lorem, nec sodales lectus auctor tempor.</p>
                        </div>
                    </div>
                    <div id="service-box" class="col-sm-4">
                        <div class="box">
                            <h3>Delivery Service</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id pulvinar magna. Aenean accumsan iaculis lorem, nec sodales lectus auctor tempor.</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box">
                            <h3>Fully Refund</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id pulvinar magna. Aenean accumsan iaculis lorem, nec sodales lectus auctor tempor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br/><br/>


        <div class="row">

          <div class="col-lg-12">
                  <h2 id = "customheader" class="page-header"><span>Latest Products</span></h2>
          </div>
          <?php
              $cat_query = $db_connection->query("SELECT * FROM `product` ORDER by ProductID DESC LIMIT 6");
              while($row = mysqli_fetch_array($cat_query)){

                $p_id = $row['ProductID'];
          			$p_image = 'admin/productimages/'.$row['PImage'];
                $p_name = $row['PName'];
                $p_price = $row['Price'];

                echo "<div class='col-sm-6 col-md-4'>
                            <div class='thumbnail'>";
                      echo "<img src='$p_image'/>";
                     	echo "<div class='caption'>";
                      echo "<h4><a href='product.php?p_id=$p_id'>".$p_name."</a></h4>";
                      echo "<a class='btn btn-default btn-sm' role='button' onClick='add_to_cart($p_id)' onfocus='this.blur()'>Add to Cart</a>";
                      echo "</p>".$p_price." Ks.</p>";
                echo "</div></div></div>";

              }
          ?>
    </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Our Main Features</h2>
            </div>
            <div class="col-md-6" style="color:#A759FF;">
                <p>Our e-commerce presents:</p>
                <ul>
                    <li>To service customers a variety of collection at our website</li>
                    <li>To be able to easily save money and compare prices from website to website</li>
                    <li>To enable to buy  head-to-toes wear of the couples in the same website</li>
                    <li>To save time and energy of the customers, going around the shops </li>
                </ul>
                <br/>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8" style="color:#9B54D4;">
                    <p>
                      Anything to tell Us? Get in touch with us now.
                    </p>
                      <a href="tel:959-1111-1111" style="padding-right:10px;" ><b style="color:#9B54D4;"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i> 959-1111-1111</b></a>
                      <a href="mailto:lql.aungkominn@gmail.com?subject=feedback_b2u" style="padding-right:10px;color:#9B54D4;"><b><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i> mail@mail.com</b></span>
                      <a href="https://maps.google.com/?q=Yangon" style="color:#9B54D4;"><b><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> Yangon</b></a>
                  </br/>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-custom btn-block" href="mailto:lql.aungkominn@gmail.com?subject=feedback_b2u">Email Us</a>
                </div>
            </div>
        </div>
        <hr>


    </div>
    <!-- Footer -->
    <footer>
        <?php include 'views/footer.php';?>
    </footer>
    <!-- /.container -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $('#nav-home').addClass("active");
    $('.carousel').carousel({
        interval: 2000
    })

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
