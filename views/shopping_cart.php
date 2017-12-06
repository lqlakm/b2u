<div class="shopping-cart">
  <h3 class="page-header cart-header">Shopping Cart :</h3>

  <div class="table-responsive">

  <table class="table table-striped table-hover table-curved" id="cart-table">
    <thead class="thead-default">
        <th class="text-center">#</th>
        <th class="text-center">Product</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Unit Price</th>
        <th class="text-center">Price</th>
        <th class="text-center"></th>
    </thead>

  <?php
      $total  = 0;$counter = 0;
      foreach($_SESSION['cart'] as $id => $qty):
        $counter += 1;
        $result = $db_connection->query("SELECT ProductID, PName, price FROM product WHERE ProductID='$id'");
        $row = mysqli_fetch_assoc($result);
        $total += $row['price'] * $qty;
  ?>
    <tr data-id="<?php echo $row['ProductID'] ?>">
      <td class="text-center"><?php echo $counter; ?></td>
      <td class="text-center"><?php echo $row['PName'] ?></td>
      <td class="text-center" class="qty-cell">
        <button class="btn btn-sm btn-action add-one" onfocus='this.blur()'><i class="fa fa-plus" aria-hidden="true"></i></button>
        <span style="padding:10px;"><?php echo  "$qty"  ?></span>
        <button class="btn btn-sm btn-action remove-one" onfocus='this.blur()'><i class="fa fa-minus" aria-hidden="true"></i></button>
      </td>
      <td class="text-center"><?php echo $row['price'] ?> Ks.</td>
      <td class="text-center p_price"><?php echo $row['price'] * $qty ?> Ks.</td>
      <td class="text-center">
        <button class="btn btn-sm btn-action remove_item" onfocus='this.blur()'><i class="fa fa-times-circle" aria-hidden="true"></i></button>
      </td>
    </tr>
  <?php endforeach; ?>

  <tfoot>
    <td colspan="2" align="left">
      <button class="btn btn-sm btn-action empty-cart" onfocus='this.blur()'><i class="fa fa-trash-o" aria-hidden="true"></i>  Empty Cart</button>
    </td>
    <td class="text-center">
      <b>Total Qty: </b><span class="qtotal"><?php echo $cart->get_total_qty(); ?></span>
    </td><td></td>
      <td class="text-center ">
      <b>Total: </b><span class="ptotal"><?php echo $total; ?> Ks.</span>
    </td><td></td>
  </tfoot>

  </table>
</div>
  <style>
    #req_login,#req_login a{color:#ab7aff;}
    #req_login a:hover{color: #D6BEFF;}
    .btn-action{background-color: transparent;line-height: 0;}
    .btn-action:hover{color: #A28CCF;}
    .btn-action:active{color: #7D30FB;background-color: transparent; border: none; outline: none; box-shadow: 0;}
  </style>

  <h3 class="page-header cart-header">Check out: </h3>
  <?php
    if($is){
      if (!empty($_SESSION['c_name']) && ($_SESSION['customer_logged_in'] == 1))
        include("views/checkout_form.php");
      else
        echo "<span id='req_login'><h4><u><a href='account.php' title='Login from Account Page'>Login</a></u> to check out and make order.</h4></span>";
    }
  ?>
  <br/><br/>

</div>
