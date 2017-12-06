<?php
  require_once("db/db.php");
  require_once("classes/Cart.php");
  $cart = new Cart();
  session_start();

  if(!empty($_POST['action'])){
    switch ($_POST['action']) {

      case "add":
        $p_id = $_POST["p_id"];
        $cart->add_to_cart($p_id);
        echo $cart->get_total_qty();
      break;

      case "remove":
        $p_id = $_POST["p_id"];
        $count = count($_SESSION['cart']);
        $total = "";
        $q_total = "";
        $cart->remove_item($p_id);
        if($count>1){
          $total = $cart->get_total();
          $q_total = $cart->get_total_qty();
        }
        echo json_encode(array("total" => $total,"q_total" => $q_total));
      break;

      case "add_one":
        $p_id = $_POST["p_id"];
        $cart->add_to_cart($p_id);
        echo json_encode(array("one_total" => $cart->get_one_total($p_id),"total" => $cart->get_total(),"q_total" => $cart->get_total_qty()));
      break;

      case "remove_one":
        $p_id = $_POST["p_id"];
        $get_one_total = "";
        $one_total = $_SESSION['cart'][$p_id];
        $cart->remove_one($p_id);
        if($one_total>1) $get_one_total=$cart->get_one_total($p_id);
        echo json_encode(array("one_total" => $get_one_total,"total" => $cart->get_total(),"q_total" => $cart->get_total_qty()));
      break;

      case "empty":
        $cart->empty_cart();
      break;
    }
  }
?>
