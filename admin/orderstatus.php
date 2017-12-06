<?php
      require_once("../db/db.php");
      require_once("classes/AdminLogin.php");
      $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      $login = new AdminLogin();
      $orderID = 0;

      if ($login->isAdminLoggedIn() == true) {
        if(isset($_GET['orderID']) && isset($_GET['s'])){
              if(!empty($_GET["orderID"]) || !empty($_GET["s"])){
                $orderID = $_GET['orderID'];
                $status = $_GET['s'];
                $results = $db_connection->query("SELECT * FROM productorder where orderID=".$orderID);
                if (mysqli_num_rows($results) == 0) {
                  include("views/error404.php");
                }else if($_GET['s']!=1 && $_GET['s']!=0){
                  include("views/error404.php");
                }
                else{
                  include("views/orderstatus.php");
                }
              }else{
                include("views/error404.php");
              }
        }else include("views/error404.php");
      } else {
          include("views/forms/loginform.php");
      }
?>
