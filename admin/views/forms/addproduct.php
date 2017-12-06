<?php
  require_once '../db/db.php';
  require_once 'classes/AddProduct.php';
  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  $c_query =  $db_connection->query("SELECT CategoryID,CategoryName FROM category");
  $s_query =  $db_connection->query("SELECT SupplierID,SName FROM supplier");
  $add_product = new AddProduct();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>Add Product - B2U Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/admin.b2u.style.css" rel="stylesheet">
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
  <body>
    <div class="content">
      <?php include ("views/navbar.php");?>

          <div  class="body-content container-fluid">
            <div class="container-fluid">
              <div  class="page-header">

                <h2>Add Product</h2>
              </div>
              <!-- Content Here -->
              <?php
                  if ($add_product->errors) {
                      foreach ($add_product->errors as $error) {
                          echo "<div class='alert alert-danger text-center'>";
                          echo $error;
                          echo "</div>";
                      }
                  }
                  if ($add_product->messages) {
                      foreach ($add_product->messages as $message) {
                          echo "<div class='alert alert-success text-center'>";
                          echo $message;
                          echo "</div>";
                      }
                  }
                ?>
              <div class="row-fluid bootstrap-iso">
                <form class="form-horizontal" method="post" name="addproduct" enctype="multipart/form-data">

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField"  for="p_name">Product Name<span class="asteriskField">  *</span></label>
                  <div class="col-sm-6">
                    <input class="form-control" id="p_name" name="p_name" type="text" required/>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField"  for="brandName">Brand Name<span class="asteriskField">  *</span></label>
                  <div class="col-sm-6">
                    <input class="form-control" id="brandName" name="brandName" type="text" required/>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField"  for="p_color">Color<span class="asteriskField">  *</span></label>
                  <div class="col-sm-6">
                    <input class="form-control" id="p_color" name="p_color" type="text" required/>
                  </div>
                 </div>


                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField"  for="p_price">Price<span class="asteriskField">  *</span></label>
                  <div class="col-sm-6">
                    <input class="form-control" id="p_price" name="p_price" type="number" min="1" required/>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField"  for="p_stock">Quantity<span class="asteriskField">  *</span></label>
                  <div class="col-sm-6">
                    <input class="form-control" id="p_stock" name="p_stock" type="number" min="1" required/>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3" for="p_image">Product Image</label>
                  <div class="col-sm-6">
                   <div class="input-group">
                     <label class="btn btn-default btn-custom" for="img-file-selector">
                        <input name="p_image" id="img-file-selector" type="file" style="display:none" onchange="file_upload_name()" accept="image/*">
                        Browse Image
                    </label>&nbsp;
                    <h5 class="label label-default" id="upload-file-info"></h5>
                   </div>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField" for="p_category">Category<span class="asteriskField"> *</span></label>
                  <div class="col-sm-6">
                   <select class="select form-control" id="p_category" name="cat_id">
                    <option value="0">- Choose Category -</option>
              				<?php while($row = mysqli_fetch_assoc($c_query)){
                            echo "<option value='".$row['CategoryID']."'>".$row['CategoryName']."</option>";
                        }
                      ?>
                   </select>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField" for="p_supplier">Supplier<span class="asteriskField"> *</span></label>
                  <div class="col-sm-6">
                   <select class="select form-control" id="p_supplier" name="supp_id">
                    <option value="0">- Choose Supplier -</option>
                    <?php while($row = mysqli_fetch_assoc($s_query)){
                          echo "<option value='".$row['SupplierID']."'>".$row['SName']."</option>";
                      }
                    ?>
                   </select>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField" for="p_description">Description</label>
                  <div class="col-sm-6">
                   <textarea class="form-control" id="p_description" name="p_description" type="text" rows="5" style="resize:none;"></textarea>
                   <br/>
                   <div style="float:right;">
                   <button class="btn btn-custom btn-md" name="addProduct" type="submit">Add New Product</button>
                    </div>
                  </div>
                 </div>
                 <br/>
                </form>
              </div>

              <!-- Content -->
            </div>
          </div>
          <div class="container-fluid content-footer">
            &copy; 2017 B2U online store
          </div>
    </div>
  </body>

<script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script>
    $('#nav-product').addClass('active');
    function file_upload_name() {
      $('#upload-file-info').html($('#img-file-selector[type=file]').val().split('\\').pop());
    }
  </script>

</html>
