<?php
      require_once("../db/db.php");
      require_once("classes/AdminLogin.php");
      $login = new AdminLogin();

      if ($login->isAdminLoggedIn() == true) {
          include("views/product.php");
      } else {
          include("views/forms/loginform.php");
      }
?>
