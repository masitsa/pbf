
<div class="subscribe">

	<div class="container">
    	
        <div class="center-align">
        	<h2>Create a Teacher Account</h2>
            
            <p style="color:#b94a48;">All fields are required</p>
            <p>Already have an account?<br/><a href="<?php echo site_url().'sign-in';?>">Sign In</a></p>
            
            <!-- Login Errors -->
			<?php
            $validation_errors = validation_errors();
            if(!empty($validation_errors)){
                echo '<div class="alert alert-danger">'.$validation_errors.'</div>';
            }
            if(isset($error)){
                echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            ?>
        </div>
        
        <!-- Login form -->
		<?php 
        	echo form_open($this->uri->uri_string(),"class='form-horizontal'"); 
        ?>
    	<div class="row login-form login register">
        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
                  <!-- Name -->
                  <div class="form-group">
                      <i class="icon-user"></i>
                      <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name');?>" required>
                  </div>
                  <!-- User Name -->
                  <div class="form-group">
                      <i class="icon-group"></i>
                      <input type="text" class="form-control" name="other_names" placeholder="Last Name" value="<?php echo set_value('other_names');?>" required>
                  </div>
                  <!-- Email -->
                  <div class="form-group">
                      <i class="icon-envelope"></i>
                      <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email');?>" required>
                  </div>
                  <!-- Password -->
                  <div class="form-group">
                      <i class="icon-lock"></i>
                      <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                  <!-- Remember me checkbox and sign in button -->
                  <div class="form-actions">
                      <!--<label class="checkbox w-auto pull-left">
                          <div class="checker">
                        <span>
                         <input class="uniform" type="checkbox" name="remember">
                        </span>
                          </div>
                          Accept Terms & Conditions
                      </label> -->
                      <div class="pull-right">
                          <button class="submit btn btn-success" type="submit">
                              Register
                          </button>
                      </div>
                  </div>

              </div>
          </div>
          <?php echo form_close();?>
      </div>
  </div>