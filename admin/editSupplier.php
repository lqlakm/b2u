<?php
      require_once("../db/db.php");
      require_once("classes/AdminLogin.php");
      $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      $login = new AdminLogin();
      $supp_id = 0;

      if ($login->isAdminLoggedIn() == true) {
          if(isset($_GET['supp_id'])){
            if(!empty($_GET["supp_id"])){
              $supp_id = $_GET['supp_id'];
              $results = $db_connection->query("SELECT * FROM supplier where SupplierID=".$supp_id);
              if (mysqli_num_rows($results) > 0) {
                include("views/forms/updatesupplier.php");
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
