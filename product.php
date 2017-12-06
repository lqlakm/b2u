<?php
  require_once("db/db.php");
  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $p_id = 0;

  if(isset($_GET['p_id'])){
    if(!empty($_GET['p_id'])){
      $p_id = $_GET['p_id'];
      $results = $db_connection->query("SELECT * FROM product where ProductID=".$p_id);
      if (mysqli_num_rows($results) > 0) {
        include("views/productdetail.php");
      }else{
         echo "Invalid ID";
      }
    }else{
      echo "Invalid Link";
    }
  }else{
    echo "Error 404";
  }
 ?>
