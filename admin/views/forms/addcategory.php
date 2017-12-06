<?php
  require_once 'classes/AddCategory.php';
  $add_category = new AddCategory();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>Add Category - B2U Admin</title>
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

                <h2>Add Category</h2>
              </div>
              <!-- Content Here -->
              <?php
                  if ($add_category->errors) {
                      foreach ($add_category->errors as $error) {
                          echo "<div class='alert alert-danger text-center'>";
                          echo $error;
                          echo "</div>";
                      }
                  }
                  if ($add_category->messages) {
                      foreach ($add_category->messages as $message) {
                          echo "<div class='alert alert-success text-center'>";
                          echo $message;
                          echo "</div>";
                      }
                  }
                ?>
              <div class="row-fluid bootstrap-iso">
                <form class="form-horizontal" method="post" name="addproduct" enctype="multipart/form-data">

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField"  for="cat_name">Category Name<span class="asteriskField">  *</span></label>
                  <div class="col-sm-6">
                    <input class="form-control" id="cat_name" name="cat_name" type="text" required/>
                  </div>
                 </div>

                 <div class="form-group ">
                  <label class="control-label col-sm-3 requiredField" for="remark">Remark</label>
                  <div class="col-sm-6">
                   <textarea class="form-control" id="remark" name="remark" type="text" rows="5" style="resize:none;"></textarea>
                   <br/>
                   <div style="float:right;">
                   <button class="btn btn-custom btn-md" name="addcategory" type="submit">Add New Category</button>
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
    $('#nav-category').addClass('active');
  </script>

</html>
