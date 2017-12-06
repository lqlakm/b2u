<?php
  $c_id = $_SESSION['c_id'];
  $query = $db_connection->query("select * from customer where CustomerID=".$c_id);
  $result_row = $query->fetch_object();
  $c_name = $result_row->Name;
  $c_address = $result_row->Address;

  $today = date('Y-m-d');
  $default_ddate = date('Y-m-d', strtotime("+2 days"));
 ?>

<div class="bootstrap-iso well invisible-well">
  <form class="form-horizontal" method="post" name="loginform" action="view_cart.php">
    <div class="form-group row">
      <label class="control-label col-sm-3 requiredField" for="c_name">Name : </label>
      <div class="col-sm-6">
          <input class="form-control" id="c_name" name="c_name" type="text" value="<?php echo $c_name; ?>" disabled/>
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-sm-3 requiredField" for="d_date">Delivery Date : </label>
      <div class="col-sm-6">
          <input class="form-control" id="d_date" name="d_date" type="date" value="<?php echo $default_ddate;?>" min="<?php echo $today;?>"required/>
          <span>(*default: 2 Days from Today)</span>
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-sm-3 requiredField" for="c_address">Address : </label>
      <div class="col-sm-6">
          <textarea class="form-control" id="c_address" name="c_address" type="text" rows="5" style="resize:none;" required><?php echo $c_address;?></textarea>
      </div>
    </div>
    <div class="col-sm-8">
      <span style='float:right;' class="checkout-span">
        <button class="btn btn-custom" name="checkout" type="submit">Check out</button>
      </span>
    </div>
  </form>
</div>
