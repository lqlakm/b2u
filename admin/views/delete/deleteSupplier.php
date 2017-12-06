<?php
if (!$db_connection->connect_errno) {

  $query = $db_connection->query("DELETE FROM supplier where SupplierID = $supp_id");

  if ($query) {
             echo("delete success query <br/>");
             header("location:supplier.php");
         }
  else {
            echo("error");
  }

}

 ?>
