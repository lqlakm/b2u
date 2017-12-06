<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>B2U - Admin Login</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/admin.b2u.style.css" rel="stylesheet">
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
  <body>


  <div class="login-form">
    <h2 class="text-center page-header">B2U Admin Login </h2>

    <div class="bootstrap-iso">
          <div class="row-fluid" >
            <form class="form-horizontal" method="post" name="loginform" action="index.php">

             <div class="form-group col-md-12">
              <label class="control-label col-sm-3 requiredField" for="admin_name">Username<span class="asteriskField"> *</span></label>
              <div class="col-sm-8  ">
               <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input class="form-control" id="admin_name" name="admin_name" type="text" required autofocus/>
               </div>
              </div>
             </div>

             <div class="form-group col-md-12">
              <label class="control-label col-sm-3 requiredField" for="admin_password">Password<span class="asteriskField"> *</span></label>
              <div class="col-sm-8">
               <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-key"></i></div>
                <input class="form-control" id="admin_password" name="admin_password" type="password" required/>
               </div>
               <br/>
               <div style="float:right;">
               <button class="btn btn-custom btn-md" name="admin_login" type="submit">Login</button>
              </div>

                <?php
                if ($login->errors) {
                    foreach ($login->errors as $error) {
                        echo "<div id='alert-d' class='alert alert-danger' style='float:left;'>".$error."</div>";
                    }
                }
                if ($login->messages) {
                    foreach ($login->messages as $message) {
                        echo "<div id='alert-S' class='alert alert-success' style='float:left;' >".$message."</div>";
                    }
                }
                ?>
              </div>
             </div>
             <br/>

            </form>

          </div>
  </div>
  </body>
  <script src="../js/jquery.js"></script>
  <script>

    $('.alert').fadeOut(1000 , function(){
        remove();
    });
  </script>
</html>
