		<!-- Join  -->
        <div class="grey-background div-head">
        	<div class="container">
        		<div class="">
                	<div class="divider-line"></div>
                	<h1 class="center-align">Airline Sign Up</h1>
                	<div class="divider-line" style="margin-bottom:2%;"></div>
                    
                    <!-- Steps -->
                    <div class="stepwizard">
                        <div class="stepwizard-row">
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-default btn-circle">1</button>
                                <p>Airline</p>
                            </div>
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-circle-active btn-circle">2</button>
                                <p>About You</p>
                            </div>
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
                                <p>Review</p>
                            </div> 
                        </div>
                    </div>
                    <!-- End: Steps -->
                    
                	<?php
                    	$attributes = array(
										'class' => 'form-horizontal',
										'role' => 'form',
									);
						echo form_open($this->uri->uri_string(), $attributes);
					?>
                    	<div class="row">
                        	<div class="col-md-6 first">
                            	<div class="form-group">
                                    <label for="airline_user_first_name" class="col-sm-3 control-label">First Name <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_user_first_name_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="airline_user_first_name" placeholder="<?php echo $airline_user_first_name_error;?>" onFocus="this.value = '<?php echo $airline_user_first_name;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="airline_user_first_name" placeholder="First Name" value="<?php echo $airline_user_first_name;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="airline_user_last_name" class="col-sm-3 control-label">Last Name <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_user_last_name_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="airline_user_last_name" placeholder="<?php echo $airline_user_last_name_error;?>" onFocus="this.value = '<?php echo $airline_user_last_name;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="airline_user_last_name" placeholder="Last Name" value="<?php echo $airline_user_last_name;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="airline_user_phone" class="col-sm-3 control-label">Phone <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_user_phone_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="airline_user_phone" placeholder="<?php echo $airline_user_phone_error;?>" onFocus="this.value = '<?php echo $airline_user_phone;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="airline_user_phone" placeholder="Phone" value="<?php echo $airline_user_phone;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                            </div>
                            
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="airline_user_email" class="col-sm-3 control-label">Email <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_user_email_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="airline_user_email" placeholder="<?php echo $airline_user_email_error;?>" onFocus="this.value = '<?php echo $airline_user_email;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="airline_user_email" placeholder="Email" value="<?php echo $airline_user_email;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="airline_user_password" class="col-sm-3 control-label">Password <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_user_password_error))
											{
												?>
                                                <input type="password" class="form-control alert-danger" name="airline_user_password" placeholder="<?php echo $airline_user_password_error;?>" onFocus="this.value = '<?php echo $airline_user_password;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="password" class="form-control" name="airline_user_password" placeholder="Password" value="<?php echo $airline_user_password;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password" class="col-sm-3 control-label">Confirm Password <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($confirm_password_error))
											{
												?>
                                                <input type="password" class="form-control alert-danger" name="confirm_password" placeholder="<?php echo $confirm_password_error;?>" onFocus="this.value = '<?php echo $confirm_password;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row center-align">
                            <div class="col-sm-12">
                                <span class="go-back"><a href="<?php echo site_url().'airline/sign-up/airline-details'?>">Go Back</a></span>
                                <button type="submit" class="btn btn-red">Continue</button>
                                <p>already have an account?</p>
                                <a href="<?php echo site_url('airline/sign-in');?>">Sign In</a>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
        <!-- End Join -->