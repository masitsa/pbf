
<div class="subscribe">

	<div class="container">
    	
        <div class="center-align">
        	<h2>Create a School Account</h2>
            
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
    	<div class="row login-form register">
        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            	<h3 style="margin-top:0px;">School Details</h3>
                <p>Used to verify your school</p>
                <!-- School Name -->
                <div class="form-group">
                    <i class="icon-user"></i>
                    <input type="text" class="form-control" name="school_name" placeholder="School Name" value="<?php echo set_value('school_name');?>" required>
                </div>
                <!-- User Name -->
                <div class="form-group">
                    <i class="icon-group"></i>
                    <input type="text" class="form-control" name="school_district" placeholder="School District" value="<?php echo set_value('school_district');?>" required>
                </div>
                <!-- State -->
                <div class="form-group">
                    <i class="icon-edit-sign"></i>
                    <select name="state_id" class="form-control" required>
                        <option value="select">Select State</option>
                        <?php
                        foreach($states as $res)
                        {
                        	if($res->state_id == set_value('state_id'))
							{
								echo '<option value="'.$res->state_id.'" selected>'.$res->state_name.'</option>';
							}
							else
							{
								echo '<option value="'.$res->state_id.'">'.$res->state_name.'</option>';
							}
                        }
                        ?>
                    </select>
                </div>
                <!-- Email -->
                <div class="form-group">
                    <i class="icon-envelope"></i>
                    <input type="text" class="form-control" name="email" placeholder="Official Email" value="<?php echo set_value('email');?>" required>
                </div>
                <!-- Password -->
                <div class="form-group">
                    <i class="icon-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
            </div>
            
        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            	<h3 style="margin-top:0px;">User Details</h3>
                <p>This account will be used by all your students</p>
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
                  <input type="text" class="form-control" name="uname" placeholder="Username" value="<?php echo set_value('uname');?>" required>
                </div>
                <!-- Password -->
                <div class="form-group">
                  <i class="icon-lock"></i>
                  <input type="password" class="form-control" name="school_password" placeholder="School Password" required>
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