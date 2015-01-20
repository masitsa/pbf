<?php
	
	$airplane_options = '';
	if($airplane_types->num_rows() > 0)
	{
		foreach($airplane_types->result() as $res)
		{
			if($res->airplane_type_id == $airplane_type_id)
			{
				$airplane_options .= '<option value="'.$res->airplane_type_id.'" selected>'.$res->airplane_type_name.'</option>';
			}
			
			else
			{
				$airplane_options .= '<option value="'.$res->airplane_type_id.'">'.$res->airplane_type_name.'</option>';
			}
		}
	}
	
	//destinations
	$destinations = '';
	if($active_airports->num_rows() > 0)
	{
		foreach($active_airports->result() as $res)
		{
			if($res->airport_id == $destination)
			{
				$destinations .= '<option value="'.$res->airport_id.'" selected>'.$res->airport_name.'</option>';
			}
			
			else
			{
				$destinations .= '<option value="'.$res->airport_id.'">'.$res->airport_name.'</option>';
			}
		}
	}
	
	//sources
	$sources = '';
	if($active_airports->num_rows() > 0)
	{
		foreach($active_airports->result() as $res)
		{
			if($res->airport_id == $source)
			{
				$sources .= '<option value="'.$res->airport_id.'" selected>'.$res->airport_name.'</option>';
			}
			
			else
			{
				$sources .= '<option value="'.$res->airport_id.'">'.$res->airport_name.'</option>';
			}
		}
	}
	
	//Airlines
	$airline_options = '';
	if($active_airlines->num_rows() > 0)
	{
		foreach($active_airlines->result() as $res)
		{
			$airline_options .= '<option value="'.$res->airline_id.'">'.$res->airline_name.'</option>';
		}
	}
	
	$flight_type_options = '';
	if($active_flight_types->num_rows() > 0)
	{
		foreach($active_flight_types->result() as $res)
		{
			$flight_type_options .= '<li><a href="'.site_url().'flights/'.$res->flight_type_name.'/'.$res->flight_type_id.'">'.$res->flight_type_name.'</a></li>';
		}
	}
	
	$trip_type_options = '';
	if($active_trip_types->num_rows() > 0)
	{
		foreach($active_trip_types->result() as $res)
		{
			if($res->trip_type_id == $trip_type_id)
			{
				$trip_type_options .= '<option value="'.$res->trip_type_id.'" selected>'.$res->trip_type_name.'</option>';
			}
			
			else
			{
				$trip_type_options .= '<option value="'.$res->trip_type_id.'">'.$res->trip_type_name.'</option>';
			}
		}
	}
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.date.css" id="theme_date">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.time.css" id="theme_time">
        <!-- Join  -->
        <div class="grey-background div-head">
        	<div class="container">
        		<div class="charter_quote">
                	<div class="divider-line"></div>
                	<h1 class="center-align">Charter Quote</h1>
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
                    
                    <h4 class="center-align">Flight Details</h4>
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
                                    <label for="destination" class="col-sm-4 control-label">Arrival <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($destination_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="destination" placeholder="<?php echo $destination_error;?>" onFocus="this.value = '<?php echo $destination;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                    	 		<input type="text" class="form-control" name="destination" placeholder="Destination" value="<?php echo $destination;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                            	<div class="form-group">
                                    <label for="airline_name" class="col-sm-4 control-label">Departure</label>
                                    <div class="col-sm-8">
                                         <input type="text" class="form-control" name="source" placeholder="Source" value="<?php echo $source;?>">
                                    </div>
                                </div>
                               	<!--<div class="form-group">
                                    <label for="air_operator_certificate" class="col-sm-4 control-label">Airline</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="airline_id">
                                        	<option value="">-Select Airline-</option>
                                        	<?php echo $airline_options;?>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="air_operator_certificate" class="col-sm-4 control-label">Passengers</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="passengers" placeholder="Passengers" value="<?php echo $passengers;?>">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-4 control-label">Departure Date</label>
                                    <div class="col-sm-4">
                                    	<input type="text" class="form-control fieldset__input js__datepicker" name="date_from" placeholder="Departure" value="<?php echo $date_from;?>">
                                    </div>
                                    <div class="col-sm-4">
                                    	<input type="text" class="form-control fieldset__input js__datepicker" name="date_to" placeholder="Arrival">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="air_operator_certificate" class="col-sm-4 control-label">Trip Type</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="trip_type_id">
                                        	<option value="">-Select Trip Type-</option>
                                        	<?php echo $trip_type_options;?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="air_operator_certificate" class="col-sm-4 control-label">Plane Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="airplane_type_id">
                                            <option value="">-Select Plane Type-</option>
                                            <?php echo $airplane_options;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-4 control-label">Description</label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($description_error))
											{
												?>
                                                <textarea class="form-control alert-danger" name="description" onFocus="this.value = '<?php echo $description;?>';" placeholder="<?php echo $description_error;?>"></textarea>
                                                <?php
											}
											
											else
											{
												?>
                                                <textarea class="form-control" name="description" placeholder="Description"><?php echo $description;?></textarea>
                                                <?php
											}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="center-align">Your Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                    <label for="sender_name" class="col-sm-4 control-label">Name <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($sender_name_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="sender_name" placeholder="<?php echo $sender_name_error;?>" onFocus="this.value = '<?php echo $sender_name;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="sender_name" placeholder="Name" value="<?php echo $sender_name;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="sender_email" class="col-sm-4 control-label">Email <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($sender_email_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="sender_email" placeholder="<?php echo $sender_email_error;?>" onFocus="this.value = '<?php echo $sender_email;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="sender_email" placeholder="Email" value="<?php echo $sender_email;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="sender_phone" class="col-sm-4 control-label">Phone <span class="info">*</span></label>
                                    <div class="col-sm-8">
                                    	<?php
											//case of an input error
                                        	if(!empty($sender_phone_error))
											{
												?>
                                                <input type="text" class="form-control alert-danger" name="sender_phone" placeholder="<?php echo $sender_phone_error;?>" onFocus="this.value = '<?php echo $sender_phone;?>';">
                                                <?php
											}
											
											else
											{
												?>
                                                <input type="text" class="form-control" name="sender_phone" placeholder="Phone" value="<?php echo $sender_phone;?>">
                                                <?php
											}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-md-offset-4">
                                <div class="form-group">
                                    <label for="sender_phone" class="col-sm-4 control-label">Receive email alerts?</label>
                                    <div class="col-sm-4">
                                        <input type="radio" name="email_alert" value="0" checked="checked" /> No
                                        <input type="radio" name="email_alert" value="1" /> Yes
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row center-align">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-red">Request Quote</button>
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