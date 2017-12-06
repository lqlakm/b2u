<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>B2U - Shop</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/b2u-style.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
      require_once("db/db.php");
      $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      include("views/navbar.php");
    ?>

    <div class="container content">
      <div class="row">
        <div class=" col-md-3 invisible-well well">
          <div class="panel panel-default shop-side-panel bootstrap-iso">
            <div class="panel-heading">
              <h2 class="panel-title">Search Products</h2>
            </div>
            <div class="input-group">
              <input id="searchkey-txt" type="text" class="form-control search-input" placeholder="Enter a keyword ..." maxlength="25">
              <span class="input-group-btn">
                  <button class="btn btn-default search-input-btn" type="button" onclick="search_result()" onfocus="blur()">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
              </span>
            </div>
          </div>

          <div class="panel panel-default shop-side-panel">
            <div class="panel-heading">
              <h2 class="panel-title" id ="category">Categories</h2>
            </div>
            <div class="list-group cat-list">
              <a id="c-list-item" href="#" class="list-group-item active" onclick='fetch_product("all")'>All</a>
              <?php
                  $cat_query = $db_connection->query("SELECT * FROM category");
                  while($row = mysqli_fetch_array($cat_query)){
                      echo"<a id='categoryid-".$row['CategoryID']."' href='#' class='list-group-item' name='".$row['CategoryID']."' onclick='fetch_product(".$row['CategoryID'].")'>"
                            .$row['CategoryName'].
                          "</a>";
                  }
              ?>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <center>
            <div class="loading">
              <div class="lds-dual-ring"><div></div>
            </div></div>
          </center>

          <div id="search-results" class='fetch_result'></div>
          <div id="r-all" class='fetch_result'></div>
          <?php
              $cat_query = $db_connection->query("SELECT * FROM category");
              while($row = mysqli_fetch_array($cat_query)){
                  echo "<div class='fetch_result' id='r-".$row['CategoryID']."'></div>";
              }
           ?>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include("views/footer.php"); ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/shop.js"> </script>
</body>

</html>
