<div class="row">
      <div class="col-lg-12">
          <h2 id="clr-title" class="page-header" style="color: #ab7aff;">Customer Login</h2>
      </div>

      <div class="col-md-12">
      <div class="panel with-nav-tabs">

          <div class="panel-heading">
                  <ul class="nav nav-tabs">
                      <li id="login-tab"class="active"><a href="#logintab" data-toggle="tab">LOGIN</a></li>
                      <li id="reg-tab"><a href="#regtab" data-toggle="tab">REGISTRATION</a></li>
                  </ul>
          </div>

          <div class="panel-body">
              <div class="tab-content">
                  <!-- LOGIN TAB -->
                  <div class="tab-pane fade in active" id="logintab">

                      <!-- form start -->
                      <div class="bootstrap-iso">
                           <div class="container">

                            <div class="row justify-content-center">
                             <div class="col-sm-12">

                              <div class="formden_header">
                               <h2>Login Form</h2>
                               <p>Login in your account with your email and password</p>
                              </div>
                              <br/>

                              <?php

                              if ($login->errors) {
                                  foreach ($login->errors as $error) {
                                      echo "<div class='alert alert-danger col-sm-10'>";
                                      echo $error;
                                      echo "</div>";
                                  }
                              }

                              if ($login->messages) {
                                  foreach ($login->messages as $message) {
                                      echo "<div class='alert alert-success col-sm-10'>";
                                      echo $message;
                                      echo "</div>";
                                  }
                              }

                              ?>
                              <form class="form-horizontal" method="post" name="loginform" action="account.php">
                               <div class="form-group">
                                <label class="control-label col-sm-3 requiredField" for="c_email">Email<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                  <input class="form-control" id="email" name="c_email" type="text" required/>
                                 </div>
                                </div>
                               </div>

                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField" for="c_password">Password<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                  <input class="form-control" id="c_phone" name="c_password" type="password" required/>

                                 </div>
                                 <br/>
                                 <div style="float:left;">
                                  <a href="#">Forget Password?</a>
                                  </div>
                                 <div style="float:right;">
                                 <button class="btn btn-custom btn-md" name="login" type="submit">Login</button>
                                  </div>
                                </div>
                               </div>

                               <br/>

                              </form>

                             </div>
                            </div>
                           </div>

                      </div>
                      <!-- form end-->
                  </div>
                  <!-- Login tab end -->

                  <!-- REG TAB -->
                  <div class="tab-pane fade" id="regtab">
                      <!-- form start -->
                      <div class="bootstrap-iso">
                           <div class="container">

                            <div class="row justify-content-center">
                             <div class="col-sm-12">

                              <div class="formden_header">
                               <h2>Registration Form</h2>
                               <p>Complete the following form to start our services</p>
                              </div>
                              <br/>
                              
                              <form class="form-horizontal" method="post" action="account.php" name="registerform">

                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField"  for="c_name">Name<span class="asteriskField">  *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                  <input class="form-control" id="c_name" name="c_name" type="text" required/>
                                 </div>
                                </div>
                               </div>

                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField" for="c_email">Email<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                  <input class="form-control" id="c_email" name="c_email" type="text" required/>
                                 </div>
                                </div>
                               </div>

                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField" for="c_password_new">Password<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                  <input class="form-control" id="c_password_new" name="c_password_new" type="password" required/>
                                 </div>
                                </div>
                               </div>


                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField" for="c_password_repeat">Retype Password<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                  <input class="form-control" id="c_password_repeat" name="c_password_repeat" type="password" required/>
                                 </div>
                                </div>
                               </div>

                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField" for="c_phone">Phone<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                  <input class="form-control" id="c_phone" name="c_phone" type="text" required/>
                                 </div>
                                </div>
                               </div>

                               <div class="form-group ">
                                <label class="control-label col-sm-3" for="c_dob">Date of Birth</label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                  <input class="form-control" id="c_dob" name="c_dob" placeholder="DD/MM/YYYY" type="Date" required/>
                                 </div>
                                </div>
                               </div>

                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField" for="c_gender">Gender<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <select class="select form-control" id="c_gender" name="c_gender">
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  <option value="Other">Other</option>
                                 </select>
                                </div>
                               </div>

                               <div class="form-group ">
                                <label class="control-label col-sm-3 requiredField" for="c_address">Address<span class="asteriskField"> *</span></label>
                                <div class="col-sm-6">
                                 <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                  <input class="form-control" id="c_address" name="c_address" type="text" required/>
                                 </div>
                                 <br/>
                                 <div style="float:right;">
                                 <button class="btn btn-custom btn-md" name="register" type="submit">Register</button>
                                  </div>
                                </div>
                               </div>
                               <br/>


                              </form>

                             </div>
                            </div>
                           </div>

                      </div>
                      <!-- form end-->
                  </div>
                  <!--reg tab end -->



              </div>
          </div>
      </div>
      </div>
</div>
