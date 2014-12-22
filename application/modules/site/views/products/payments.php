<?php
	$options = '';
	if($traveller_types->num_rows() > 0)
	{
		foreach($traveller_types->result() as $res)
		{
			$options .= '<option value="'.$res->traveller_type_id.'">'.$res->traveller_type_name.'</option>';
		}
	}
?>
<!-- Join  -->
<div class="grey-background div-head">
    <div class="container">
        <div class="divider-line"></div>
        <h1 class="center-align">Book Flight</h1>
        <div class="divider-line" style="margin-bottom:2%;"></div>
  
        <div class="row">
        
        	<?php echo $this->load->view('products/left_navigation');?>
        
            <!--right column-->
            <div class="col-sm-9 col-md-9">
                <?php echo $this->load->view('products/breadcrumbs');?>
                <div class="main">
                	<?php
						
						if(!empty($payments_error))
						{
							echo '<div class="alert alert-danger center-align">'.$payments_error.'</div>';
						}
						
						if(!empty($iframe))
						{
							?>
                            <iframe src="<?php echo $iframe;?>" width="100%" height="700px"  scrolling="no" frameBorder="0">
                                <p>Browser unable to load iFrame</p>
                            </iframe>
                            <?php
						}
						
						else
						{
							//echo form_hidden('reference', '001');
							$flight_data = $flight->row();
							$source = $flight_data->source;
							$destination = $flight_data->destination;
							$flight_date = $flight_data->flight_date;
							$airline_id = $flight_data->airline_id;
							$flight_departure_time = $flight_data->flight_departure_time;
							$flight_arrival_time = $flight_data->flight_arrival_time;
							$year = date('Y',strtotime($flight_date));
							$month = date('M',strtotime($flight_date));
							$day = date('jS',strtotime($flight_date));
							$flight_departure_time = date('H:i a',strtotime($flight_departure_time));
							$flight_arrival_time = date('H:i a',strtotime($flight_arrival_time));
							
							//get source & destination names
							if($airports_query->num_rows() > 0)
							{
								foreach($airports_query->result() as $res)
								{
									$airport_id = $res->airport_id;
									
									if($airport_id == $source)
									{
										$source = $res->airport_name;
									}
									
									if($airport_id == $destination)
									{
										$destination = $res->airport_name;
									}
								}
							}
							echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form'));
							echo form_hidden('type', 'MERCHANT');
							echo form_hidden('amount', $flight_data->flight_price);
							echo form_hidden('description', 'Flight from '.$source.' '.$flight_departure_time.' to '.$destination.' '.$flight_arrival_time.' on '.$day.' '.$month.' '.$year);
					?>
                        
                    	<div class="row">
                        	<div class="center-align">
                            	<h4>Please fill in your details to complete your payment</h4>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-4 control-label">First Name</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name');?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-sm-4 control-label">Last Name</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo set_value('last_name');?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                    	<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
                                    </div>
                                </div>
                        	</div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number" class="col-sm-4 control-label">Phone</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone_number" placeholder="Phone" value="<?php echo set_value('phone_number');?>">
                                    </div>
                                </div>
                            	<div class="form-group">
                                    <label for="source" class="col-sm-4 control-label">Traveller Type</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="traveller_type_id">
                                        	<option value="">----Select Traveller Type----</option>
                                        	<?php echo $options;?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="seats" class="col-sm-4 control-label">Seats</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="seats" placeholder="Seats" value="1" value="<?php echo set_value('seats');?>">
                                    </div>
                                </div>
                                
                                <!--<div class="form-group">
                                    <label for="description" class="col-sm-4 control-label">Description</label>
                                    <div class="col-sm-8">
                                    	<textarea class="form-control" name="description" placeholder="Description"><?php echo set_value('description');?></textarea>
                                    </div>
                                </div>-->
                            </div>
                		</div>
                            
                        <div class="center-align">
                            <button class="btn btn-primary" type="submit">Confirm Booking</button>
                        </div>
                        <?php echo form_close();?>
                        
                    	<div class="row">
                        	<div class="col-md-6">
                                <div class="center-align">
                                    <h4>About Flight</h4>
                                </div>
                                
                                <table class="table table-condensed table-striped">
                                	<tr>
                                    	<th>Source:</th>
                                    	<td><?php echo $source;?></td>
                                    </tr>
                                	<tr>
                                    	<th>Destination:</th>
                                    	<td><?php echo $destination;?></td>
                                    </tr>
                                	<tr>
                                    	<th>Departure Time:</th>
                                    	<td><?php echo $day;?> <?php echo $month;?> at <?php echo $flight_departure_time;?></td>
                                    </tr>
                                	<tr>
                                    	<th>Arrival Time:</th>
                                    	<td><?php echo $day;?> <?php echo $month;?> at <?php echo $flight_arrival_time;?></td>
                                    </tr>
                                	<tr>
                                    	<th>Available Seats:</th>
                                    	<td><?php echo $flight_data->flight_seats;?></td>
                                    </tr>
                                </table>
                        	</div>
                            
                            <div class="col-md-6">
                                <div class="center-align">
                                    <h4>About <?php echo $flight_data->airline_name;?></h4>
                                </div>
                                
                                <img src="<?php echo $airline_logo_location.$flight_data->airline_thumb;?>" style="float:left; margin:0 5px 0 0;">
                                <p style="text-align:justify;"><?php echo $flight_data->airline_summary;?></p>
                                
                                <div class="row">
                                	<div class="col-md-8">
                                    	<i class="fa fa-envelope"></i> <?php echo $flight_data->airline_email;?>
                                    </div>
                                    
                                	<div class="col-md-4">
                                    	<i class="fa fa-phone"></i> <?php echo $flight_data->airline_phone;?>
                                    </div>
                                </div>
                                
                                <!-- <div class="center-align">
                                    <h4>Contact <?php echo $flight_data->airline_name;?></h4>
                                </div>
                                <?php 
								$attributes = array('class' => 'form-horizontal', 'role' => 'form');
								echo form_open('contact-airline/'.$flight_id, $attributes);
									$errors = $this->session->userdata('contact_error');
									if(!empty($errors))
									{
										echo '
										<div class="alert alert-danger">
											'.$errors.'
										</div>
										';
										$this->session->unset_userdata('contact_error');
									}
								?>
                                <div class="form-group">
                                    <label for="sender_name" class="col-sm-4 control-label">Your Name</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" id="sender_name" placeholder="Name">
                                    	<div id="name_error"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sender_email" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" id="sender_email" placeholder="Email">
                                    	<div id="email_error"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sender_phone" class="col-sm-4 control-label">Phone</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" id="sender_phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="airline_contact_message" class="col-sm-4 control-label">Message</label>
                                    <div class="col-sm-8">
                                    	<textarea class="form-control" id="airline_contact_message" placeholder="Message"></textarea>
                                    	<div id="message_error"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                    	<button type="button" class="btn btn-primary contact_airline">Send</button>
                                    </div>
                                </div>
                                <?php echo form_close();?> -->
							</div>
						</div>
                    <?php 
						}
					?>
            </div>
    	</div>
    </div>
</div>
<!-- End Join -->
<script type="text/javascript">
	//Activate merchant
	var config_url = '<?php echo site_url();?>';
	$(document).on("click","button.send_message",function()
	{
		var airline_message = $('#airline_message').val();
		var airline_id = '<?php echo $airline_id;?>';
		
		if (airline_message != '') 
		{
			var data_url = config_url+'site/send_comment/'+airline_id;
			
			$.ajax({
				type:'POST',
				url: data_url,
				dataType: 'text',
				data: { message: airline_message },
				success:function(data)
				{
					//on success
					if(data == 'true')
					{
						$('#merchant'+retail_store_id).removeClass("danger");
						$('#merchant'+retail_store_id).addClass("success");
						$('#span'+retail_store_id).removeClass("glyphicon-thumbs-up");
						$('#span'+retail_store_id).addClass("glyphicon-thumbs-down");
					}
					
					else
					{
						alert(data);
					}
				},
				error: function(xhr, status, error) {
					//alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
					alert(error);
				}
			});
		}
		
		else
		{
			$('#error').html("<div class='alert alert-danger'>Please compose a message before sending</div>");
		}
		
		return false;
	});
	
	$(document).on("click","button.contact_airline",function()
	{
		var sender_name = $('#sender_name').val();
		var sender_email = $('#sender_email').val();
		var sender_phone = $('#sender_phone').val();
		var airline_message = $('#airline_contact_message').val();
		
		var airline_id = '<?php echo $airline_id;?>';
		
		if (sender_name != '') 
		{
			if (sender_email != '') 
			{
				if (airline_message != '') 
				{
					var data_url = config_url+'site/contact_airline/'+airline_id;
					
					$.ajax({
						type:'POST',
						url: data_url,
						dataType: 'text',
						data: { name: sender_name, email: sender_email, phone: sender_phone, message: airline_message},
						success:function(data)
						{
							//on success
							if(data == 'true')
							{
								$('#merchant'+retail_store_id).removeClass("danger");
								$('#merchant'+retail_store_id).addClass("success");
								$('#span'+retail_store_id).removeClass("glyphicon-thumbs-up");
								$('#span'+retail_store_id).addClass("glyphicon-thumbs-down");
							}
							
							else
							{
								alert(data);
							}
						},
						error: function(xhr, status, error) {
							//alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
							alert(error);
						}
					});
					$('#email_error').html("");
				}
				
				else
				{
					$('#message_error').html("<div class='alert alert-danger'>Please compose a message before sending</div>");
				}
				$('#name_error').html("");
			}
			
			else
			{
				$('#email_error').html("<div class='alert alert-danger'>Please enter your email address</div>");
			}
		}
		
		else
		{
			$('#name_error').html("<div class='alert alert-danger'>Please enter your name</div>");
		}
		
		return false;
	});
</script>