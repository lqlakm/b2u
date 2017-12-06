<?php
      require_once("../db/db.php");
      require_once("classes/AdminLogin.php");
      $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      $login = new AdminLogin();
      $p_id = 0;

      if ($login->isAdminLoggedIn() == true) {
        if(isset($_GET['p_id'])){
            if(!empty($_GET["p_id"])){
              $p_id = $_GET['p_id'];
              $results = $db_connection->query("SELECT * FROM product where ProductID=".$p_id);
              if (mysqli_num_rows($results) > 0) {
                include("views/delete/deleteProduct.php");
              }else{
                include("views/error404.php");
              }
            }else{
              include("views/error404.php");
            }
        }else include("views/error404.php");
      } else {
          include("views/forms/loginform.php");
      }
?>
