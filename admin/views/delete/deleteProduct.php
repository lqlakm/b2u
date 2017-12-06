<?php
if (!$db_connection->connect_errno) {

  $re_query = $db_connection->query("select PImage from product where ProductID = $p_id");
  $query = $db_connection->query("DELETE FROM product where ProductID = $p_id");

  $result_row = $re_query->fetch_object();
  if ($query) {
             echo("delete success query <br/>");
             unlink("productimages"."/".$result_row->PImage);
             echo("file deleted");
             header("location:product.php");
         }
  else {
            echo("error");
  }

}

 ?>
