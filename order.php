<?php
  session_start();
  if(isset($_SESSION['order_finished'])){
    if ($_SESSION['order_finished'] == 1){
      include("views/orderdelivery.php");
    }
    else header("location: shop.php");
  }else header("location: shop.php");

 ?>
