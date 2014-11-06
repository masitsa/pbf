
<div class="subscribe">

	<div class="container">
    	<h2 class="wow zoomInUp">Reset your password</h2>
        
        <div style="text-align:center; margin-bottom:20px;">
            Don't have an account?<br/>
            <a href="<?php echo site_url().'sign-up';?>">Sign Up</a>
        </div>
      
      <div class="center-align">
    			<?php
                $error2 = $this->session->userdata('front_error_message');
				$success = $this->session->userdata('front_success_message');
				if(!empty($error2))
				{
					?>
						<div class="alert alert-danger">
							<p>
								<?php 
									echo $error;
									$this->session->unset_userdata('front_error_message');
								?>
							</p>
						</div>
					<?php
				}
				
				if(!empty($success))
				{
					?>
						<div class="alert alert-success">
							<p>
								<?php 
									echo $success;
									$this->session->unset_userdata('front_success_message');
								?>
							</p>
						</div>
					<?php
				}
				?>
            </div>
      
      <div class="login-form login">
      
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
          <!-- Login form -->
          <?php 
          echo form_open($this->uri->uri_string(),"class='form-horizontal'"); 
          ?>
          <div class="widget-head"><p> To reset your password, enter the email address you use to sign in to site. We will then send you a new password. </p> </div>
            <!-- Email -->
            <div class="form-group">
                <i class="icon-envelope"></i>
                <input  type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <!-- Remember me checkbox and sign in button -->
              <div class="form-actions">
                  <!--<label class="checkbox pull-left">
                      <div class="checker">
                        <span>
                         <input class="uniform" type="checkbox" name="remember">
                        </span>
                      </div>
                      Remember me
                  </label>-->
                  <button class="submit btn btn-primary pull-right" type="submit">
                      Reset Password
                      <i class="icon-angle-right"></i>
                  </button>
              </div>
            <br />
          <?php echo form_close();?>
        </div>
    </div>
</div>