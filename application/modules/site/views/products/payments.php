        
<!-- Join  -->
<div class="grey-background div-head">
    <div class="container">
        <div class="divider-line"></div>
        <h1 class="center-align">All Flights</h1>
        <div class="divider-line" style="margin-bottom:2%;"></div>
  
        <div class="row">
        
        	<?php echo $this->load->view('products/left_navigation');?>
        
            <!--right column-->
            <div class="col-sm-9 col-md-9">
                <?php echo $this->load->view('products/breadcrumbs');?>
                <div class="main">
                	<?php
                    	$validation_errors = validation_errors();
						
						if(!empty($validation_errors))
						{
							echo '<div class="alert alert-danger center-align">'.$validation_errors.'</div>';
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
						
							echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form'));
							echo form_hidden('type', 'MERCHANT');
							//echo form_hidden('reference', '001');
							$flight_data = $flight->row();
					?>
                    	<div class="row">
                        	<div class="center-align">
                            	<h4>Please fill in your details to complete your payment</h4>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-4 control-label">First Name</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="first_name" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-sm-4 control-label">Last Name</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                    	<input type="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number" class="col-sm-4 control-label">Phone</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone_number" placeholder="Phone">
                                    </div>
                                </div>
                        	</div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="col-sm-4 control-label">Amount</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="amount" placeholder="Amount" value="<?php echo $flight_data->flight_price;?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="seats" class="col-sm-4 control-label">Seats</label>
                                    <div class="col-sm-8">
                                    	<input type="text" class="form-control" name="seats" placeholder="Seats" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-4 control-label">Description</label>
                                    <div class="col-sm-8">
                                    	<textarea class="form-control" name="description" placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="center-align">
                            	<button class="btn btn-primary" type="submit">Confirm Booking</button>
                            </div>
                            
                        <!--<table class="table table-condensed table-striped">
                            <tr>
                                <td>Amount:</td>
                                <td><input type="text" name="amount" value="5000" />
                                (in Kshs)
                                </td>
                            </tr>
                            <tr>
                                <td>Type:</td>
                                <td><input type="text" name="type" value="MERCHANT" readonly="readonly" />
                                (leave as default - MERCHANT)
                                </td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td><input type="text" name="description" value="Order Description" /></td>
                            </tr>
                            <tr>
                                <td>Reference:</td>
                                <td><input type="text" name="reference" value="001" />
                                (the Order ID )
                                </td>
                            </tr>
                            <tr>
                                <td>Shopper's First Name:</td>
                                <td><input type="text" name="first_name" value="John" /></td>
                            </tr>
                            <tr>
                                <td>Shopper's Last Name:</td>
                                <td><input type="text" name="last_name" value="Doe" /></td>
                            </tr>
                            <tr>
                                <td>Shopper's Email Address:</td>
                                <td><input type="text" name="email" value="john@yahoo.com" /></td>
                            </tr>
                            <tr>
                                <td>Shopper's Phone Number:</td>
                                <td><input type="text" name="phone_number" value="0774834466" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Make Payment" /></td>
                            </tr>
                        </table>-->
                    <?php 
						echo form_close();
						}
					?>
                </div>
            </div>
    	</div>
    </div>
</div>
<!-- End Join -->