<!-- Join  -->
        <div class="grey-background div-head">
        	<div class="container">
                <div class="divider-line"></div>
                <h1 class="center-align">Reset your password</h1>
                <div class="divider-line" style="margin-bottom:2%;"></div>
        		
                	<!-- Login Errors -->
                    <?php
                    $error = validation_errors();
					if(!empty($error)){
                    	echo '<div class="center-align alert alert-danger"> Oh snap! '.$error.'</div>';
					}
					if(!empty($error2)){
                    	echo '<div class="center-align alert alert-danger"> Oh snap! '.$error2.'</div>';
					}
					echo form_open($this->uri->uri_string(), array("class" => 'form-horizontal', 'role' => 'form', 'style' => 'margin-top: 20px;'));
					?>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-3">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Email <span class="info">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row center-align">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-red">Reset Password</button>
                            <p>Don't have an account?</p>
                            <a href="<?php echo site_url().'airline/sign-up/airline-details';?>">Sign Up</a>
                        </div>
                    </div>
                  <?php echo form_close();?>
            </div>
        </div>
        <!-- End Join -->