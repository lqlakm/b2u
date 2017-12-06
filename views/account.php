<?php
    require_once("db/db.php");
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $c_id = $_SESSION["c_id"];
    $query = $db_connection->query("select * from customer where CustomerID=".$c_id);
    $result_row = $query->fetch_object();

?>
<style>
        .cp  {background-color: #ece2ff;}
        .cph h3,i,a, a:active, a:focus{color:#9a63f9;}
        .cph i,a:hover{color:#caacff;}
        .hidden{display: none;}
        .cinfo-list{margin-top:-5px; margin-bottom: -15px;}
        .cinfo-list .list-group-item:first-child {border-top: 0px !important; border-radius: 0!important; }
        .cinfo-list .list-group-item:last-child { border-bottom: 0px !important; border-radius: 0!important;}
        .cinfo-list li { background: #ece2ff; border-left: 0px; border-right: 0px; color:#9a63f9;}
        .cinfo-list li:nth-child(odd) { background: #fff; border-left: 0px; border-right: 0px;}
        .cinfo-list .chlabel{border-right: 1px solid #9a63f9;}
        .modal-changepw h3,i{color:#9a63f9;};
</style>
<h2 id="clr-title" class="page-header" style="color: #ab7aff;">Customer Information</h2>
<?php
    if ($update->errors) {
        foreach ($update->errors as $error) {
            echo "<div class='alert alert-danger col-sm-10'>";
            echo $error;
            echo "</div>";
        }
    }
    if ($update->messages) {
        foreach ($update->messages as $message) {
            echo "<div class='alert alert-success col-sm-10'>";
            echo $message;
            echo "</div>";
        }
    }
  ?>
<div  class="row-fluid">
    <div class="col-md-8">
        <div class="panel cp">
            <div class="cphead panel-heading">
                <b class="panel-title" style="color:#ab7aff; font-size: 20px;">Account Information</b>
                <a  href="#" style="float:right;" title="Edit Your Account"><i id="cedit" class="fa fa-pencil-square-o fa-lg"></i></a>
                <a  href="#" style="float:right;" title="Close"><i id="cclose" class="fa fa-times fa-lg hidden"></i></a>
            </div>
                        <!--panel body start -->
            <div class="panel-body">

                        <!-- Info List -->
                <ul id ="cinfos" class="list-group cinfo-list">
                    <li class="row list-group-item"><span class="chlabel col-xs-2">Name</span>
                        <span id="ci_name" class="col-xs-6"><?php echo $result_row->Name;?></span>
                    </li>

                    <li class="row list-group-item"><span class="chlabel col-xs-2">Date of Birth</span>
                        <span id="ci_dob" class="col-xs-6"><?php echo $result_row->DoB;?></span>
                    </li>

                    <li class="row list-group-item"><span class="chlabel col-xs-2">Gender</span>
                        <span id="ci_gender" class="col-xs-6"><?php echo $result_row->Gender;?></span>
                    </li>

                    <li class="row list-group-item"><span class="chlabel col-xs-2">Email</span>
                        <span id="ci_email" class="col-xs-6"><?php echo $result_row->Email;?></span>
                    </li>

                    <li class="row list-group-item"><span class="chlabel col-xs-2">Phone</span>
                        <span id="ci_phone" class="col-xs-6"><?php echo $result_row->Phone;?></span>
                    </li>

                    <li class="row list-group-item"><span class="chlabel col-xs-2">Address</span>
                        <span id="ci_address" class="col-xs-6"><?php echo $result_row->Address;?></span>
                    </li>

                    <li class="row list-group-item">
                        <span style ="float:right;"><a href ="account.php?logout">Log out</a></span>
                    </li>
                </ul>
                        <!-- Info list end -->
                        <!-- edit input form -->
                        <div id="cinputs" class="bootstrap-iso hidden">
                                <form class="form-horizontal" method="post">
                                <ul class="list-group cinfo-list">
                                    <li class="form-group list-group-item">
                                        <label class="control-label col-sm-3 requiredField" for="c_name">Name : </label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="c_name" name="c_name" type="text" required/>
                                        </div>
                                    </li>

                                    <li class="form-group list-group-item">
                                        <label class="control-label col-sm-3 requiredField" for="c_email">Email : </label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="c_email" name="c_email" type="email" required/>
                                        </div>
                                    </li>

                                    <li class="form-group list-group-item">
                                        <label class="control-label col-sm-3 requiredField" for="c_dob">Date of Birth</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="c_dob" name="c_dob" type="date"/>
                                        </div>
                                    </li>

                                    <li class="form-group list-group-item">
                                        <label class="control-label col-sm-3 requiredField" for="c_gender">Gender</label>
                                        <div class="col-sm-6">
                                            <select class="select form-control" id="c_gender" name="c_gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                           </select>
                                        </div>
                                    </li>

                                    <li class="form-group list-group-item">
                                        <label class="control-label col-sm-3 requiredField" for="c_phone">Phone</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="c_phone" name="c_phone" type="text" required/>
                                        </div>
                                    </li>

                                    <li class="form-group list-group-item">
                                        <label class="control-label col-sm-3 requiredField" for="c_address">Address</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="c_address" name="c_address" type="text" required/>
                                        </div>
                                    </li>
                                    <li class="row list-group-item">
                                        <span><a href="" name="changepw" data-toggle="modal" data-target="#changepwmodel">Change Password</a></span>
                                        <span style ="float:right;"><button class="btn btn-md btn-custom" name="update" type="submit">Update</button></span>
                                    </li>

                                </ul>
                            </form>

                            </div>

                      </div>
                      <!--panel body end -->

                    <div class="modal fade" id="changepwmodel" tabindex="-1" role="dialog" aria-labelledby="pwmodal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header modal-changepw">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                            <h3 class="modal-title" id="pwmodal">Change Password</h3>
                          </div>
                          <form method="post">
                          <div class="modal-body bootstrap-iso">
                              <div class="form-group">
                                <label for="c_pw" class="form-control-label">New Password:</label>
                                <input type="password" class="form-control" id="c_pw" name="c_pw">
                              </div>
                              <div class="form-group">
                                <label for="c_repw" class="form-control-label">Retype New Password:</label>
                                <input type="password" class="form-control" id="c_repw" name="c_repw">
                              </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-custom-alert" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-custom" type="submit" name="changePW">Update</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                  <div class="panel panel-default">
                      <div class="panel-heading" style="color: #ab7aff;">
                          <h5><i class="fa fa-history" aria-hidden="true"></i> Order History</h5>
                      </div>
                      <!-- /.panel-heading -->

                      <?php
                      function get_date($date){
                          $dstring = explode("-", $date);
                          return $dstring[2]." / ".$dstring[1]." / ".$dstring [0];
                      }

                      function get_product_info($order_id)
                      {
                        $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        $query = $db_connection->query("SELECT PName, Qty, Price FROM `orderdetail` INNER JOIN product USING(ProductID) WHERE OrderID =".$order_id);
                        $s="";
                        while ($row = mysqli_fetch_array($query)) {
                          $s = $s.$row['PName'] . " (".$row['Price']." Ks.) x ".$row['Qty']."<br/>" ;
                        }
                        return $s;
                      }

                        function get_total($order_id)
                        {
                          $info = array();
                          $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                          $result = $db_connection->query("SELECT SUM(product.Price*orderdetail.Qty) as totalprice, SUM(orderdetail.Qty) as totalqty
                                                            FROM orderdetail INNER JOIN product USING(ProductID) WHERE OrderID =".$order_id);
                          $total = $result->fetch_row();
                          $info[] =  $total[0];
                          $info[] =  $total[1];
                          return $info;
                        }

                        $o_results = $db_connection->prepare("SELECT OrderID, OrderDate, Status FROM productorder WHERE CustomerID=".$c_id);
                        $o_results->execute();
                      	$o_results->bind_result($order_id, $o_date, $status);
                       ?>
                      <div class="panel-body" style="max-height:500px; width:auto;">
                          <ul class="order-history">
                            <?php
                              while($o_results->fetch()){
                                $total = get_total($order_id);
                                $p_info =  get_product_info($order_id);
                                $o_date = get_date($o_date);
                                  echo "<li class='left clearfix history-list'>";
                                  echo "<div class='clearfix'>";
                                  echo "<div class='header'>";
                                  echo "<strong class='primary-font'>
                                  <a href='#.' id='popover' data-content='$p_info' data-html='true' title='Order Detail Information'>
                                  Order No. #000".$order_id."</a>";
                                  if($status == 1) echo " <span class='label label-success'>Delivered</span> ";
                                  echo "</strong>";
                                  echo "<small class='pull-right text-muted' title='Order Date'>";
                                  echo "<i class='fa fa-calendar-o'></i> ".$o_date;
                                  echo "</small>";
                                  echo "<small class='pull-right text-muted' title='Delivery Date'>";
                                  echo "<i class='fa fa-clock-o'></i> ".$o_date;
                                  echo "</small>";
                                  echo "</div>";
                                  echo "<h5>Total Quantity : $total[1]</h5>";
                                  echo "<h5>Total Price : $total[0] Ks.</h5>";
                                  echo "</div>";
                                  echo "</li>";
                              }
                             ?>
                          </ul>
                      </div>
                      <!-- /.panel-body -->

                      <div class="panel-footer">
                      </div>
                    </div>
              </div>
</div>
