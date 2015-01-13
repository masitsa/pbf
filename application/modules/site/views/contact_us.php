
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.date.css" id="theme_date">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.time.css" id="theme_time">
        <!-- Join  -->
        <div class="grey-background div-head">
        	<div class="container">
        		<div class="charter_quote">
                	<div class="divider-line"></div>
                	<h1 class="center-align">Contact Us</h1>
                	<div class="divider-line" style="margin-bottom:2%;"></div>
                    
                    <?php
                    	$success = $this->session->userdata('charter_quote_success_message');
						$error = $this->session->userdata('charter_quote_error_message');
						
						if(!empty($success))
						{
							echo '<div class="alert alert-success center-align">'.$success.'</div>';
							$this->session->unset_userdata('charter_quote_success_message');
						}
						
						if(!empty($error))
						{
							echo '<div class="alert alert-danger center-align">'.$error.'</div>';
							$this->session->unset_userdata('charter_quote_error_message');
						}
					?>
                    
                  
                    <?php
                    	$attributes = array(
										'class' => 'form-horizontal',
										'role' => 'form',
									);
						echo form_open($this->uri->uri_string(), $attributes);
					?>
                    	<div class="row">
                        	<div class="col-md-6 first">
                        		<div class="row" style="margin-bottom: 10px;">
                        		  <h3 class="center-align">Send Message</h3>
                        		</div>
                        		 <div class="row">
	                            	<div class="form-group">
	                                    <label for="destination" class="col-sm-4 control-label">First Name <span class="info">*</span></label>
	                                    <div class="col-sm-8">
	                                    		<input type="text" class="form-control fieldset__input" name="first_name" placeholder="First Name *">
	                                    </div>
	                                </div>
	                            	<div class="form-group">
	                                    <label for="airline_name" class="col-sm-4 control-label">Last Name <span class="info">*</span></label>
	                                    <div class="col-sm-8">
	                                        <input type="text" class="form-control fieldset__input" name="last_name" placeholder="Last Name *">
	                                    </div>
	                                </div>
	                               	<div class="form-group">
	                                    <label for="air_operator_certificate" class="col-sm-4 control-label">Email Address <span class="info">*</span></label>
	                                    <div class="col-sm-8">
	                                    	<input type="text" class="form-control fieldset__input" name="date_from" placeholder="Email Address *">
	                                    </div>
	                                </div>
	                                 <div class="form-group">
	                                    <label class="col-sm-4 control-label">Message <span class="info">*</span></label>
	                                    <div class="col-sm-8">
	                                    	  <textarea class="form-control" name="message" placeholder="Message *"></textarea>
	                                    </div>
	                                </div>
	                             </div>
                                 <div class="row center-align">
		                            <div class="col-sm-12">
		                                <button type="submit" class="btn btn-red">Send Message</button>
		                            </div>
		                        </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="row" style="margin-bottom: 10px;">
                        		  <h3 class="center-align">Contact Details</h3>
                        		</div>
                                <div class="contact-info">
	                              <p> <i class="fa fa-phone"></i> <span class="col-sm-4 info">Phone :</span> +254 721 991 399 </p>
	                              <p> <i class="fa fa-envelope-o"></i> <span class=" col-sm-4 info">Email Address :</span> info@privatebushflights.com </p>
	                              <p> <i class="fa fa-location-arrow"></i> <span class="col-sm-4 info">Address :</span> 123456, Nairobi, 00200</p>
                                </div>
                            </div>
                        </div>
                       
                       
                        
                       
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
        <!-- End Join -->

<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.date.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.time.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>demo/scripts/demo.js"></script>