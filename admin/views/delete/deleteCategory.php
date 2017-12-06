<?php
if (!$db_connection->connect_errno) {

  $query = $db_connection->query("DELETE FROM category where CategoryID = $cat_id");

  if ($query) {
             echo("delete success query <br/>");
             header("location:category.php");
         }
  else {
            echo("error");
  }
}

 ?>
