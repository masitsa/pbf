
        <!-- Jasny -->
        <link href="<?php echo base_url();?>assets/jasny/jasny-bootstrap.css" rel="stylesheet">		
        <script type="text/javascript" src="<?php echo base_url();?>assets/jasny/jasny-bootstrap.js"></script> 
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
                                <button type="button" class="btn btn-circle-active btn-circle">1</button>
                                <p>Airline</p>
                            </div>
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-default btn-circle">2</button>
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
						echo form_open_multipart($this->uri->uri_string(), $attributes);
					?>
                    	<div class="row">
                        	<div class="col-md-6 first">
                            	<div class="form-group">
                                    <label for="airline_name" class="col-sm-4 control-label">Airline <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_name_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="airline_name" placeholder="<?php echo $airline_name_error;?>" onFocus="this.value = '<?php echo $airline_name;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="airline_name" placeholder="Airline" value="<?php echo $airline_name;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="air_operator_certificate" class="col-sm-4 control-label">Air Operator's Certificate <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                            //case of an input error
                                            if(!empty($air_operator_certificate_error))
                                            {
                                                ?>
                                                <input type="text" class="form-control alert-danger" name="air_operator_certificate" placeholder="<?php echo $air_operator_certificate;?>" onFocus="this.value = '<?php echo $air_operator_certificate;?>';">
                                                <?php
                                            }
                                            
                                            else
                                            {
                                                ?>
                                                <input type="text" class="form-control" name="air_operator_certificate" placeholder="AOC Number" value="<?php echo $air_operator_certificate;?>">
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="airline_phone" class="col-sm-4 control-label">Phone <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_phone_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="airline_phone" placeholder="<?php echo $airline_phone_error;?>" onFocus="this.value = '<?php echo $airline_phone;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="airline_phone" placeholder="Phone" value="<?php echo $airline_phone;?>">
                                                <?php
											}
										?>
                                        <span class="info">This will be displayed to visitors of your page</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="airline_email" class="col-sm-4 control-label">Email <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_email_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="airline_email" placeholder="<?php echo $airline_email_error;?>" onFocus="this.value = '<?php echo $airline_email;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="airline_email" placeholder="Email" value="<?php echo $airline_email;?>">
                                                <?php
											}
										?>
                                        <span class="info">This will be displayed to visitors of your page</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="airline_summary" class="col-sm-4 control-label">Summary
                                        <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($airline_summary_error))
											{
												?>
                                                <textarea class="form-control alert-danger" name="airline_summary" onFocus="this.value = '<?php echo $airline_summary;?>';" placeholder="<?php echo $airline_summary_error;?>"></textarea>
                                                <?php
											}
											
											else
											{
												?>
                                                <textarea class="form-control" name="airline_summary" placeholder="Summary"><?php echo $airline_summary;?></textarea>
                                                <?php
											}
										?>
                                    </div>
                                </div>
                            </div>
                            
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="airline_logo" class="col-sm-4 control-label">Logo</label>
                                    <?php echo $airline_logo_error;?>
                                    <div class="col-sm-8">
                                    	<div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="">
                                                <img src="<?php echo $airline_logo_location;?>" class="img-responsive">
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-grey"><span class="fileinput-new">Default Image</span><span class="fileinput-exists">Change</span><input type="file" name="airline_logo" ></span>
                                                <a href="#" class="btn btn-grey fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row center-align">
                            <div class="col-sm-12">
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