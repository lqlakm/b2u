<?php
if (!$db_connection->connect_errno) {

  $query = $db_connection->query("UPDATE productorder SET Status=$status, ModifiedDate=now() WHERE OrderID=$orderID");

  if ($query) {
       echo("success query <br/>");
       header("location:order.php");
  }
  else {echo("error");}

}
?>
