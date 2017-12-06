<?php
      require_once("../db/db.php");
      require_once("classes/AdminLogin.php");
      $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      $login = new AdminLogin();
      $cat_id = 0;
      if ($login->isAdminLoggedIn() == true) {
        if(isset($_GET["categoryID"])){
          if(!empty($_GET["categoryID"])){
            $cat_id = $_GET['categoryID'];
            $results = $db_connection->query("SELECT * FROM category where CategoryID=".$cat_id);
            if (mysqli_num_rows($results) > 0) {
              include("views/delete/deleteCategory.php");
            }else{
               include("views/error404.php");
            }
          }else{
             include("views/error404.php");
          }
        }else  include("views/error404.php");
      } else {
          include("views/forms/loginform.php");
      }
?>
